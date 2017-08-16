<?php

namespace Ladecadanse\Entity;

class Event extends Entity
{
    /**
     * @var integer
     */
    protected $idevenement;
    
    protected $idLieu;   // Venue
    protected $idSalle; // Room
    protected $idPersonne; // author User

    protected $statut;
    protected $genre;
    protected $titre;
    protected $dateEvenement;
    protected $nomLieu;
    protected $adresse;
    protected $quartier;
    protected $localite_id;
    protected $region;
    protected $urlLieu;
    protected $horaire_debut;
    protected $horaire_fin;
    protected $horaire_complement;
    protected $description;
    protected $flyer;
    protected $image;
    protected $prix;
    protected $prelocations;
    protected $URL1;
    protected $URL2;
    protected $ref;
    protected $dateAjout;
    protected $date_derniere_modif;

    static public $status = ['actif', 'complet', 'annule', 'inactif'];  
    
    protected $author; // User
    protected $organizers; // Organizer
    protected $place; // Place
    
    public function getidevenement()
    {
        return $this->idevenement;
    }
    
    public function setidevenement($id)
    {
        $this->idevenement = $id;

        return $this;
    }

    public function getidLieu()
    {
        return $this->idLieu;
    }
    
    public function setidLieu($idLieu)
    {
        $this->idLieu = $idLieu;

        return $this;
    }
    
    public function getidSalle()
    {
        return $this->idSalle;
    }
    
    public function setidSalle($idSalle)
    {
        $this->idSalle = $idSalle;

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

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;

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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }   
    
    // ...

    public function setdate_derniere_modif($updated)
    {
        $this->date_derniere_modif = $updated;

        return $this;
    }

    public function getdate_derniere_modif()
    {
        return $this->date_derniere_modif;
    }

    
}
