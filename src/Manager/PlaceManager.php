<?php

namespace Ladecadanse\Manager;

use Ladecadanse\Entity\Place;

class PlaceManager extends Manager
{
    /**
     * @var \Ladecadanse\Manager\UserManager
     */
    private $userManager;
    private $organizerManager;
    
    public function setUserManager(UserManager $userManager) {
        $this->userManager = $userManager;
    }

    public function setOrganizerManager(OrganizerManager $organizerManager) {
        $this->organizerManager = $organizerManager;
    }
    
    public function findAll() {
        $sql = "select * FROM place p, town t WHERE p.townId = t.id AND status='actif' ORDER BY created DESC";
        $result = $this->db->fetchAll($sql);
        // Convert query result to an array of domain objects
        $o = [];
        foreach ($result as $row) {
            $o[$row['id']] = $this->buildDomainObject($row);
        }
       
        return $o;
    }
    
    public function find($id) {
        $sql = "select * FROM place p, town t WHERE p.townId = t.id AND p.id=$id";
        $result = $this->db->fetchAll($sql);
 
        return $this->buildDomainObject($result[0]);
    } 
    
    public function buildDomainObject(array $row)
    {
        $place = new Place($row);

        // author
        if (array_key_exists('user_id', $row)) {
            // Find and set the associated author
            $user = $this->userManager->find($row['user_id']);
            $place->setAuthor($user);
        }
    
        // members
        $members = $this->userManager->findPlaceMembers($row['id']);
        $place->setMembers($members);
        
        // organizers
        $organizers = $this->organizerManager->findBYPlace($row['id']);
        $place->setOrganizers($organizers);       
        
        return $place;

    }
}