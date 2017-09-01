<?php

namespace Ladecadanse\Entity;

class Organizer extends Entity
{
    /**
     * @var integer
     */
    protected $id;
    
    /**
     * à partir de user_id
     * 
     * @var User 
     */
    protected $author;
    
    /**
     *
     * @var array User
     */
    protected $members;    
    protected $status; // enum('actif', 'inactif', 'ancien')
    
    protected $nom;
    protected $adresse;
    protected $region;
    protected $URL;
    protected $email;
    protected $presentation;
    protected $created;
    protected $modified;

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
    
    public function setAuthor(User $author)
    {
        $this->author = $author;

        return $this;
    } 
    

    /**
     * 
     * @param \Ladecadanse\Entity\User $member
     * @return $this
     */
    public function addMember(User $member)
    {
        $this->members[] = $member;

        return $this;
    }

    /**
     * TODO
     * Remove member
     *
     * @param \LaDecadanse\UserBundle\Entity\User $member
     */
    public function removeMember(User $member)
    {
    }

    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param \Ladecadanse\Entity\User $member
     * @return boolean
     */
    public function hasMember(User $member)
    {
        //dump($this->members);
        
        return in_array($member, $this->members); // , true
    } 
    
    public function setMembers(array $members)
    {
        $this->members = $members;
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
