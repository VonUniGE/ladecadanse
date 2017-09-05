<?php

namespace Ladecadanse\Entity;

class Place extends \Ladecadanse\Entity\Entity
{
    protected $id;
    //protected $parent;
    protected $author; // User 
    protected $status; // enum('actif', 'inactif', 'ancien')
    
//    protected $type; // complex, venue, room
//    static public $types = ['complex', 'venue', 'room'];
    
    protected $members; // User 
    protected $organizers; // Organizer
    
    protected $nom;
    protected $adresse;
    protected $quartier ;
    protected $localite_id;
    protected $region;
//    protected $lat;
//    protected $lng;
//    protected $horaire_general;   
   protected $categories; //'bistrot','salle','restaurant','cinema','theatre','galerie','boutique','musee','autre'
//    protected $telephone;
//    protected $URL;
//    protected $email;
//    protected $determinant;   
    protected $created;
    protected $modified;

    
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
    
    public function setAuthor(User $author) {
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
    
    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }    
    
    /**
     * @param string $name
     * @return Place
     */
    public function setNom($name)
    {
        $this->nom = $name;

        return $this;
    }    
    

    /**
     * Set address
     *
     * @param string $address
     * @return Place
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set district
     *
     * @param string $district
     * @return Place
     */
    public function setQuartier($quartier)
    {
        $this->quartier = $quartier;

        return $this;
    }

    /**
     * Get district
     *
     * @return string
     */
    public function getQuartier()
    {
        return $this->quartier;
    }
    
      /**
     * Set city
     *
     * @param string city
     * @return Place
     */
    public function setLocalite_id($localite_id)
    {
        $this->localite_id = $localite_id;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getLocalite_id()
    {
        return $this->localite_id;
    }
    
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    public function getRegion()
    {
        return $this->region;
    }    
    
   /**
     * Set category
     *
     * @param string $category
     * @return Place
     */
    public function setCategory($category)
    {
        $this->categories[] = $category;

        return $this;
    }

   /**
     * Set categories
     *
     * @param array $categories
     * @return Place
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    public function removeCategory($category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
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
