<?php

namespace Ladecadanse\Entity;

class Organizer extends Entity
{
    /**
     * @var integer
     */
    protected $idOrganisateur;
    
    protected $idPersonne; //User

    protected $statut; 
    protected $nom;
    protected $adresse;
    protected $region;
    protected $URL;
    protected $email;
    protected $telephone;
    protected $logo;
    protected $photo;
    protected $presentation;
    protected $date_ajout;
    protected $date_derniere_modif;

    protected $author; // User    
    protected $members; // User
    protected $places; // Place
    
    public function getIdOrganisateur()
    {
        return $this->idOrganisateur;
    }
    
    public function setIdOrganisateur($id)
    {
        $this->idOrganisateur = $id;

        return $this;
    }


    public function getidPersonne()
    {
        return $this->idPersonne;
    }
    
    public function setidPersonne($idPersonne)
    {
        $this->idPersonne = $idPersonne;

        return $this;
    } 
    
    public function getStatut()
    {
        return $this->statut;
    }
    
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }
    
    public function getNom()
    {
        return $this->nom;
    }
    
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }
   
    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getRegion()
    {
        return $this->region;
    }
    
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }


}
