<?php

namespace Ladecadanse\Entity;

class Event extends Entity
{
    /**
     * @var integer
     */
    protected $id;

    protected $user_id; 
    //protected $author; // User
    
    protected $place_id;     
    protected $idSalle;     
//    protected $place; // Place
//     
//    protected $organizers; // Organizer   
    
    protected $status;
    protected $category;
    protected $titre;
    protected $dateEvenement;
    protected $nomLieu;
    protected $adresse;
    protected $quartier;
    protected $localite_id;
    protected $region;
    protected $urlLieu;
    protected $horaire_debut;
//    protected $horaire_fin;
//    protected $horaire_complement;
    protected $description;
//    protected $prix;
//    protected $prelocations;
//    protected $ref;
    protected $created;
    protected $modified;

    public static $statuses = ['actif', 'complet', 'annule', 'inactif'];  

    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getUserId()
    {
        return $this->user_id;
    }
    
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    } 
    
    public function getAuthor()
    {
        return $this->author;
    }
    
    public function setAuthor(User $author) {
        $this->author = $author;
        return $this;
    }    

    public function getPlaceId()
    {
        return $this->place_id;
    }
    
    public function setPlaceId($place_id)
    {
        $this->place_id = $place_id;

        return $this;
    }    

    public function getIdSalle()
    {
        return $this->idSalle;
    }
    
    public function setIdSalle($idSalle)
    {
        $this->idSalle = $idSalle;

        return $this;
    }       
    
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
    
    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;

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
    
    public function getDateEvenement()
    {
        return $this->dateEvenement;
    }

    public function setDateEvenement($dateEvenement)
    {
        $this->dateEvenement = $dateEvenement;

        return $this;
    } 

    public function getNomLieu()
    {
        return $this->nomLieu;
    }

    public function setNomLieu($nomLieu)
    {
        $this->nomLieu = $nomLieu;

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

    public function getQuartier()
    {
        return $this->quartier;
    }

    public function setQuartier($quartier)
    {
        $this->quartier = $quartier;

        return $this;
    }
    
    public function getLocalite()
    {
        return $this->localite_id;
    }

    public function setLocalite($localite_id)
    {
        $this->localite_id = $localite_id;

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
       
    public function getHoraire_debut()
    {
        return $this->horaire_debut;
    }
    
    public function setHoraire_debut($horaire_debut)
    {
        $this->horaire_debut = $horaire_debut;

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
    
    public function getCreated()
    {
        return $this->created;
    }
    
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }   
}
