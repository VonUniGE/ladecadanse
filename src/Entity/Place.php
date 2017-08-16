<?php

namespace LaDecadanse\Entity;

class Place extends \Ladecadanse\Entity\Entity
{

  
    protected $organizers; // Organizer
    private $events; // Event

    protected $idLieu;
    protected $idpersonne;
    protected $statut; // enum('actif', 'inactif', 'ancien')
    
    
    /**
 * idLieu
idpersonne
statut
nom
adresse
quartier
localite_id
region
lat
lng
horaire_general
horaire_evenement
entree
categorie // 'bistrot','salle','restaurant','cinema','theatre','galerie','boutique','musee','autre'
telephone
photo1
photo2
logo
URL
email
plan
acces_tpg
dateAjout
actif
determinant
date_derniere_modif
 */
    protected $author; // User
    
    /**
     * Add manager
     *
     * @param Manager $manager
     * @return Place
     */
    public function addManager(Manager $manager)
    {
        $this->managers[] = $manager;
        $manager->addPlace($this);
        
        return $this;
    }

    /**
     * Remove manager
     *
     * @param Manager $manager
     * @return Place
     */
    public function removeManager(Manager $manager)
    {
        // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
        $this->managers->removeElement($manager);
    }

    /**
     * Get manager
     *
     * @return ArrayCollection
     */
    public function getManagers()
    {
        return $this->managers;
    }

    public function setRegion(Region $region)
    {
        $this->region = $region;

        return $this;
    }

    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Place
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set namePrefix
     *
     * @param string $namePrefix
     * @return Place
     */
    public function setNamePrefix($namePrefix)
    {
        $this->namePrefix = $namePrefix;

        return $this;
    }

    /**
     * Get namePrefix
     *
     * @return string
     */
    public function getNamePrefix()
    {
        return $this->namePrefix;
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
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
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
     * Set postalCode
     *
     * @param string $postalCode
     * @return Place
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return integer
     */
    public function getPostalCode()
    {
        return $this->postalCode;
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Place
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
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

    /**
     * Add event
     *
     * @param \LaDecadanse\AppBundle\Entity\Event $event
     *
     * @return Place
     */
    public function addEvent(\LaDecadanse\AppBundle\Entity\Event $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \LaDecadanse\AppBundle\Entity\Event $event
     */
    public function removeEvent(\LaDecadanse\AppBundle\Entity\Event $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }
}
