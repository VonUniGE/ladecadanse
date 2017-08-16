<?php
// configurer si néc. début de header.inc.php et comportements.inc.php
# Added by PorCus comme un goret 
date_default_timezone_set('Europe/Berlin');

require_once('params.php');
 
$CONF_maxfilesize = 2097152; // 2 Mo

$glo_mimes_documents_acceptes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png", "image/x-png",
 "application/pdf",
"application/msword",
 "text/richtext", "application/rtf", "image/svg+xml","application/gzip",
"application/zip", "multipart/x-zip", "multipart/x-gzip", "application/x-tar");

$glo_mimes_images_acceptees = array("image/jpeg", "image/pjpeg", "image/gif", "image/png", "image/x-png");

$mimes_images_acceptes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png", "image/x-png");

$mimes_documents_acceptes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png", "image/x-png",
 "application/pdf",
"application/msword", "application/msexcel",
 "text/richtext", "application/rtf", "image/svg+xml","application/gzip",
"application/zip", "multipart/x-zip", "multipart/x-gzip", "application/x-tar");


$glo_moisF = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
$glo_annee_max = 2020;

//mots clef pour le header html
$indexMotsClef = array("soirées","soirée","soir","nuit","fête","party","parties","genève","geneve","sortir","sorties",
"festival","festivals","musique","concerts","agenda","culture","culturel","alternatif","squats","bars","flyer",
"flyers","cinéma","ciné");

$glo_categories_lieux = array('bistrot' => 'bistrot', 'salle' => 'salle', 'restaurant' => 'restaurant', 'cinema' => 'cinéma',  'theatre' => 'théâtre', 'galerie' => 'galerie', 'boutique' => 'boutique', 'musee' => 'musée', 'autre' => 'autre');

$glo_tab_genre = array("fête" => "fêtes", "cinéma" => "ciné", "théâtre" => "théâtre", "expos" => "expos", "divers" => "divers");

$statuts_evenement = array('actif', 'complet', 'annule', 'inactif');
$statuts_lieu = array('actif',  'ancien', 'inactif');
$statuts_breve = array('actif', 'inactif');
$glo_statuts_personne = array('demande', 'actif', 'inactif');


$glo_tab_quartiers2 = 
        [
            "ge" =>
            ["Champel", "Charmilles", "Centre", "Cornavin", "Grottes","Jonction", "Nations", "Pâquis", "Petit-Saconnex", "Saint-Gervais", "Saint-Jean", "Servette"]
            
        ];
 
$glo_tab_quartiers_hors_geneve = array("Nyon", "Vaud", "France", "autre");
$glo_tab_ailleurs = ["rf" => "France", "hs" => "Autre"];


$actions = array("ajouter", "insert", "update", "editer");

$g_mauvais_mdp = 
array('123456',
'password',
'soleil',
'genève',
'coucou',
'boubou',
'bonheur',
'vacances',
'doudou',
'papillon',
'bonjour',
'cheval',
'capitainne',
'Mathilde',
'caramel',
'garfield',
'friends',
'simba12',
'reslabol',
'shaka00',
'1254321',
'xydney',
'caline',
'licorne',
'mjdc10435410',
'280195',
'freesurf',
'musique',
'jfdodolaure',
'333333',
'rochet88',
'jennifer',
'motdepasse',
'maison',
'123soleil',
'chocolat',
'123123',
'nicolas',
'888888',
'othello1',
'carpediem',
'multipass',
'berocl69',
'166459',
'sofia10mag',
'chonchon',
'Camille',
'joelle',
'654321',
'12345678',
'qwertz',
'12345',
'football',
'ladecadanse',
'111111',
'abc123'
); 

$glo_regions = array("ge" => "Genève", "vd" => "Vaud", "fr" => "Fribourg", "rf" => "France", "hs" => "Autre");


require_once('visuel.php');

$glo_auj = date("Y-m-d");
$auj = date("Y-m-d");
$glo_auj_6h = date("Y-m-d", time() - 14400);

require_once($rep_librairies.'usine.php');
require_once($rep_librairies.'dates.php');
require_once($rep_librairies.'presentation.php');

session_start();

$remote_addr = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING);


// par défaut
if (empty($_SESSION['region']))
    $_SESSION['region'] = 'ge';

// à l'aide du cookie ou de l'IP
if (!empty($_COOKIE['ladecadanse_region']))
{
    $_SESSION['region'] = $_COOKIE['ladecadanse_region'];
}

$get['region'] = filter_input(INPUT_GET, "region", FILTER_SANITIZE_STRING);

if (array_key_exists($get['region'], $glo_regions))
{        
    $_SESSION['region'] = $get['region'];
    setcookie("ladecadanse_region", $get['region'], time() + 36000, '');  /* , 'ladecadanse.darksite.ch' */    
    
}
 
$url_query_region = '';
$url_query_region_et = '';
$url_query_region_1er = '';
$get['region'] = '';
if ($_SESSION['region'] != 'ge')
{
    $url_query_region = 'region='.$_SESSION['region'];    
    $url_query_region_et = 'region='.$_SESSION['region']."&amp;";    
    $url_query_region_1er = '?region='.$_SESSION['region'];
    $get['region'] = $_SESSION['region'];
   
}