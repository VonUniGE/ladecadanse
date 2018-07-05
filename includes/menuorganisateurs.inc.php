<?php


$categoriesVal = array("bistrot", "cinéma", "restaurant", "salle", "galerie", "théâtre", "boutique", "musée", "autre");


$de = "0";
$vers = "l";

$tab_statuts = array("actif", "inactif", "ancien");
$get['statut'] = "actif";
if (isset($_GET['statut']))
{
	$get['statut'] = verif_get($_GET['statut'], "enum", 1, $tab_statuts);
}

$tab_vues = array("az", "genre");
if (isset($_GET['vue']))
{
	$get['vue'] = verif_get($_GET['vue'], "enum", 1, $tab_vues);

	if($get['vue'] != "az")
	{
		$de = "0";
		$vers = "z";
	}
}
else
{
	$get['vue'] = "az";
}


$tab_tranches = array_merge(array("ak", "lz", "tout"), $categoriesVal);
//printr($tab_tranches);

if (isset($_GET['tranche']))
{

	$get['tranche'] = verif_get($_GET['tranche'], "enum", 1, $tab_tranches);

	if ($get['vue'] == "az")
	{


		if ($get['tranche'] == "ak")
		{
			$de = "0";
			$vers = "l";
		}
		else if ($get['tranche'] == "lz")
		{
			$de = "l";
			$vers = "z";
		}
		else if ($get['tranche'] == "tout")
		{
			$de = "0";
			$vers = "z";
		}
	}
	else if ($get['vue'] == "genre")
	{
	}
	else if ($get['vue'] == "quartier")
	{

	}

}
else
{
	if ($get['vue'] == "az")
	{
		$get['tranche'] = "ak";
	}
	else if ($get['vue'] == "genre")
	{
		$get['tranche'] = "collectif";
	}
}

$url_tranche = "&amp;tranche=".$get['tranche'];

$url_idOrganisateur = "";
if (isset($get['idO']))
{
	$url_idOrganisateur = "&amp;idO=".$get['idO'];
}

$aff_menulieux = '<div id="menu_lieux">';

/*
$aff_menulieux .= '
<ul id="selon">
	<li';
	if ($get['vue'] == "az") { $aff_menulieux .= " class=\"ici\""; }
	$aff_menulieux .= '><a href="'.$_SERVER['PHP_SELF'].'?statut='.$get['statut'].'&amp;vue=az'.$url_idOrganisateur.'" title="Liste alphabétique">A-Z</a></li><li';
	//if ($get['vue'] == "genre") { $aff_menulieux .= " class=\"ici\""; }
	//$aff_menulieux .= '><a href="'.$_SERVER['PHP_SELF'].'?statut='.$get['statut'].'&amp;vue=genre'.$url_idOrganisateur.'" title="Liste par genre">genre</a></li>';
//$aff_menulieux .= '</ul>
		<div class="spacer"><!-- --></div>';
*/
			$sql_vue = "";

			if ($get['vue'] == "az")
			{
				$aff_menulieux .= '
				<ul id="tranches">
				<li';
				if ($get['tranche'] == "ak") { $aff_menulieux .= " class=\"ici\""; }
				$aff_menulieux .= '><a href="'.$_SERVER['PHP_SELF'].'?'.$url_query_region_et.'statut='.$get['statut'].'&amp;vue=az'.$url_idOrganisateur.'&amp;tranche=ak" title="Liste alphabétique">a-k</a></li>
				<li';
				if ($get['tranche'] == "lz") { $aff_menulieux .= " class=\"ici\""; }
				$aff_menulieux .= '><a href="'.$_SERVER['PHP_SELF'].'?'.$url_query_region_et.'statut='.$get['statut'].'&amp;vue=az'. $url_idOrganisateur.'&amp;tranche=lz" title="Liste alphabétique">l-z</a></li>
				<li';
				if ($get['tranche'] == "tout") { $aff_menulieux .= " class=\"ici\""; }
				$aff_menulieux .= '><a href="'.$_SERVER['PHP_SELF'].'?'.$url_query_region_et.'statut='.$get['statut'].'&amp;vue=az'.$url_idOrganisateur.'&amp;tranche=tout" title="Liste alphabétique">tout</a></li>
				</ul>';

				$sql_vue = "AND TRIM(LEADING 'l\'' FROM (TRIM(LEADING 'les ' FROM (TRIM(LEADING 'la ' FROM (TRIM(LEADING 'le ' FROM LOWER(nom)))))))) >=  LOWER('".$de."%')";

				if ($get['tranche'] == 'ak')
				{
				$sql_vue .= "AND TRIM(LEADING 'l\'' FROM (TRIM(LEADING 'les ' FROM (TRIM(LEADING 'la ' FROM (TRIM(LEADING 'le ' FROM lower(nom)))))))) <= LOWER('".$vers."%')";
				}
			}
			else if ($get['vue'] == "genre")
			{
				$aff_menulieux .= "
				<form action=\"".$_SERVER['PHP_SELF']."\" method=\"get\">
				<fieldset>
				<input type=\"hidden\" name=\"vue\" value=\"genre\" />
				<input type=\"hidden\" name=\"idO\" value=\"".$get['idO']."\" />
				<input type=\"hidden\" name=\"statut\" value=\"".$get['statut']."\" />
				<select name=\"tranche\" onChange=\"javascript:this.form.submit();\">";
				foreach ($categoriesVal as $c)
				{


					$aff_menulieux .= "<option value=\"".$c."\"";
					if ($c == $get['tranche'])
					{
						$aff_menulieux .= " selected=\"selected\"";
					}
					$aff_menulieux .= ">".$c."</option>";
				}
				$aff_menulieux .= "</select><input class=\"submit\" type=\"submit\" value=\"ok\" size=\"1\" />

				</fieldset></form>";

				$sql_vue .= "AND categorie LIKE '%".$get['tranche']."%'";

			}

	$aff_menulieux .= '<div class="spacer"><!-- --></div>';
	$aff_menulieux .= '<table summary="Menu des organisateurs"><tr><th>';


		$aff_menulieux .= '</th>
		<th>&nbsp;</th>
		<th><img src="'.$IMGicones .'calendar.png" title="Nombre d\'événements agendés" alt="icone des événements" /></th></tr>';

/*
* Requète SQL vers table 'lieu' selon choix de listage (AK ou LZ) et pour les lieux
* actif ou non
*/

$sql_menu = "
SELECT idOrganisateur, nom, presentation
FROM organisateur
WHERE statut='".$get['statut']."' ".$sql_vue."
ORDER BY TRIM(LEADING 'l\'' FROM (TRIM(LEADING 'les ' FROM (TRIM(LEADING 'la ' FROM (TRIM(LEADING 'le ' FROM lower(nom)))))))) COLLATE utf8_general_ci";

$req = $connector->query($sql_menu);

$nb_lieux = $connector->getNumRows($req);

$pair = 0;
$prec = "";
$url_prec = "";
$url_suiv = "";
$nomDuLieu = "";
$id_passe = 0;

while (list ($id, $nom, $presentation) = mysqli_fetch_row($req))
{
	$nb_evenements = 0;
	$aumoins1des = "";

	$nomDuLieu = $nom;

	// Précision pour dire si le lieu a une ou plusieurs presentations
/*     if ($presentation != '')
	{
       $aumoins1des = "*";
    } */

	$sql_even = "SELECT titre FROM evenement, evenement_organisateur WHERE evenement.idEvenement=evenement_organisateur.idEvenement AND idOrganisateur=".$id." AND dateEvenement >= '".date("Y-m-d")."' AND statut='actif'";

	//echo $sql_even;

    $req_even = $connector->query($sql_even);
	// Précision pour dire si le lieu a une ou plusieurs presentations

    $nb_evenements = $connector->getNumRows($req_even);




	$aff_menulieux .=  "<tr ";
	if ($id == $get['idO'])
	{
		$aff_menulieux .=  "id=\"ici\"";

		$url_prec = $prec;
		$id_passe = 1;
	}
	else if ($pair % 2 != 0)
	{
		$aff_menulieux .=  "class=\"impair\"";
	}



	$aff_menulieux .= ">
	<td><a href=\"".$url_site."organisateur.php?".arguments_URI($get, array("idO", "type_description"))."&amp;idO=".$id."\">";

	if (preg_match("/^(Le |La |Les |L')(.*)/", $nomDuLieu, $matches))
	{
		$aff_menulieux .= $matches[2];
		$aff_menulieux .= '<span style="font-size:1em">, '.$matches[1].'</span>';
	}
	else
	{
		$aff_menulieux .= $nomDuLieu;
	}

	$aff_menulieux .= "</a></td>
	<td class=\"nb_desc_lieu\">".$aumoins1des."</td>";
	$nb_aff = "";
	if ($nb_evenements > 0)
	{
		$nb_aff = $nb_evenements;
	}
	$aff_menulieux .= "
	<td class=\"nb_even_lieu\">".$nb_aff."</td>
	</tr>";




	$prec = "organisateur.php?vue=".$get['vue']."&amp;idO=".$id.$url_tranche."";

	if ($id_passe && $url_suiv == "" && $id != $get['idO'])
	{
 		if ($pair != ($nb_lieux))
		{
			$url_suiv = $prec;
		}
	}
	$pair++;

}

/* $aff_menulieux .= $url_prec." ".$url_suiv;
$aff_menulieux .= count($tab_noms_low); */
/*
$nomDuLieu = "";
while ($tab_lieux = $connector->fetchArray($req_lieux))
{

	$nb_evenements = 0;
	$aumoins1des = "";
    $req_des = $connector->query("SELECT idLieu FROM descriptionlieu WHERE idLieu=".$tab_lieux['idLieu']);

	$nomDuLieu = securise_string($tab_lieux['nom']);

	// Précision pour dire si le lieu a une ou plusieurs descriptions
    if ($connector->getNumRows($req_des) > 0)
	{
       $aumoins1des = "*";
    }

	$sql_even = "SELECT titre FROM evenement WHERE idLieu=".$tab_lieux['idLieu']." AND dateEvenement > '".date("Y-m-d")."'";

	//echo $sql_even;

    $req_even = $connector->query($sql_even);
	// Précision pour dire si le lieu a une ou plusieurs descriptions

    $nb_evenements = $connector->getNumRows($req_even);


	echo "<tr ";
	if ($pair % 2 != 0)
	{
		echo "class=\"impair\"";
	}
	echo "><td><a href=\"lieu.php?idL=".$tab_lieux['idLieu']."\">".$nomDuLieu."</a></td><td>".$aumoins1des."</td><td>".$nb_evenements."</td>
	</tr>";




	$pair++;

	}  */
	$aff_menulieux .= "
	<tr><td></td></tr>
		</table>


	</div>";

?>
<!-- Fin menu_lieux -->