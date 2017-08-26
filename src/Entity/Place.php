<?php

namespace LaDecadanse\Entity;

class Place extends \Ladecadanse\Entity\Entity
{
    protected $idLieu;
    protected $parent;
    protected $author; 
    protected $statut; // enum('actif', 'inactif', 'ancien')
    
    protected $nom;
    protected $adress;
    protected $disctrict;
    protected $localite_id;
    protected $region;
    
    protected $localization; // lat, lng
    protected $categories; //'bistrot','salle','restaurant','cinema','theatre','galerie','boutique','musee','autre'
    protected $created;
    protected $modified;
    
    protected $type; // complex, venue, room
 
    protected $organizers; // Organizer
    private $events; // Event    
    
    static public $types = ['complex', 'venue', 'room'];


    /**
    telephone
    photo1
    photo2
    logo
    URL
    email
    determinant
     */


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
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    public function getAuthor()
    {
        return $this->author;
    }
    
    public function setAuthor(User $author) {
        $this->author = $author;
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

    /**
     * Set presentation
     *
     * @param string $presentation
     * @return Place
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get presentation
     *
     * @return string
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Place
     */
    public function setAddresse($address)
    {
        $this->addresse = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddresse()
    {
        return $this->addresse;
    }

    /**
     * Set district
     *
     * @param string $district
     * @return Place
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

      /**
     * Set addressDetails
     *
     * @param string addressDetails
     * @return Place
     */
    public function setAddressDetails($addressDetails)
    {
        $this->addressDetails = $addressDetails;

        return $this;
    }

    /**
     * Get addressDetails
     *
     * @return string
     */
    public function getAddressDetails()
    {
        return $this->addressDetails;
    }

      /**
     * Set city
     *
     * @param string city
     * @return Place
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

        /**
     * Set localization
     *
     * @param string localization
     * @return Place
     */
    public function setLocalization($localization)
    {
        $this->localization = $localization;

        return $this;
    }

    /**
     * Get localization
     *
     * @return string
     */
    public function getLocalization()
    {
        return $this->localization;
    }

    /**
     * Set availability
     *
     * @param string $availability
     * @return Event
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;

        return $this;
    }

    /**
     * Get availability
     *
     * @return string
     */
    public function getAvailability()
    {
        return $this->availability;
    }
}
