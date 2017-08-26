<?php

namespace Ladecadanse\Entity;

class Organizer extends Entity
{
    /**
     * @var integer
     */
    protected $id;
    protected $author; // User     
    protected $status; // enum('actif', 'inactif', 'ancien') 
    protected $nom;
    protected $adresse;
    protected $region;
    protected $URL;
    protected $email;
    protected $presentation;
    protected $created;
    protected $modified;

//    protected $members; // User
//    protected $places; // Place
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }
    
    public function setAuthor($author)
    {
        $this->author = $author;

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

    public function getURL()
    {
        return $this->URL;
    }
    
    public function setURL($URL)
    {
        $this->URL = $URL;

        return $this;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }    
    
    public function getPresentation()
    {
        return $this->presentation;
    }

    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

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
