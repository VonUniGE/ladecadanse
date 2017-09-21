<?php

namespace Ladecadanse\Entity;

class Event extends Entity
{
    /**
     * @var integer
     */
    protected $id;
   
    /**
     *
     * @var Place
     */
    protected $place;     
    protected $idSalle;     

    /**
     *
     * @var User
     */
    protected $author;
    
    /**
     *
     * @var array Organizer
     */
    protected $organizers; 
    
    /**
     *
     * @var string enum('actif', 'inactif', 'annule', 'complet')
     */
    protected $status;
    
    /**
     *
     * @var string fête, cinéma, théâtre, expos, divers
     */
    protected $category;
    protected $titre;
    protected $dateEvenement;
    
    protected $nomLieu;
    protected $adresse;
    protected $quartier;
    protected $townId;
    protected $townName;
    protected $townRegion;    
    protected $urlLieu;

    protected $description;
    protected $ref;    
    protected $horaireDebut;
    protected $horaire_fin;
    protected $horaire_complement;
    protected $prix;
    protected $prelocations;
   
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

    public function getPlace()
    {
        return $this->place;
    }
    
    public function setPlace($place)
    {
        $this->place = $place;

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
    
    /**
     * 
     * @param \Ladecadanse\Entity\Organizer $organizer
     * @return $this
     */
    public function addOrganizer(Organizer $organizer)
    {
        $this->organizers[] = $organizer;

        return $this;
    }

    /**
     * TODO
     * Remove member
     *
     * @param \Ladecadanse\Entity\Organizer $organizer
     */
    public function removeMember(Organizer $organizer)
    {
    }

    public function getOrganizers()
    {
        return $this->organizers;
    }

    /**
     * @param \Ladecadanse\Entity\Organizer $organizer
     * @return boolean
     */
    public function hasOrganizer(Organizer $organizer)
    {
        return in_array($organizer, $this->organizers); // , true
    } 
    
    public function setOrganizers(array $organizers)
    {
        $this->organizers = $organizers;
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
    
    public function getTownId()
    {
        return $this->townId;
    }

    public function setTownId($townId)
    {
        $this->townId = $townId;

        return $this;
    }     

    public function getTownName()
    {
        return $this->townName;
    }

    public function setTownName($townName)
    {
        $this->townName = $townName;

        return $this;
    }     
    
    public function getTownRegion()
    {
        return $this->townRegion;
    }

    public function setTownRegion($townRegion)
    {
        $this->townRegion = $townRegion;

        return $this;
    }         
    
    public function getUrlLieu()
    {
        return $this->urlLieu;
    }

    public function setUrlLieu($urlLieu)
    {
        $this->urlLieu = $urlLieu;

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

    public function getRef()
    {
        return $this->ref;
    }

    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }  
    
    public function getHoraireDebut()
    {
        return $this->horaireDebut;
    }
    
    public function setHoraireDebut($horaireDebut)
    {
        $this->horaireDebut = $horaireDebut;

        return $this;
    }

    public function getHoraire_fin()
    {
        return $this->horaire_fin;
    }
    
    public function setHoraire_fin($horaire_fin)
    {
        $this->horaire_fin = $horaire_fin;

        return $this;
    } 
    
    public function getHoraire_complement()
    {
        return $this->horaire_complement;
    }
    
    public function setHoraire_complement($horaire_complement)
    {
        $this->horaire_complement = $horaire_complement;

        return $this;
    }     
 
    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }   

    public function getPrelocations()
    {
        return $this->prelocations;
    }

    public function setPrelocations($prelocations)
    {
        $this->prelocations = $prelocations;

        return $this;
    }        
    
    public function getCreated()
    {
        return $this->created;
    }
    
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }  
    
    public function getModified()
    {
        return $this->modified;
    }
    
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }     
}
