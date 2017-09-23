<?php

namespace Ladecadanse\Manager;

use Ladecadanse\Entity\Organizer;

class OrganizerManager extends Manager
{
    /**
     * @var \Ladecadanse\Manager\UserManager
     */
    private $userManager;
    
    public function setUserManager(UserManager $userManager) {
        $this->userManager = $userManager;
    }
    
    public function findAll() {
        $sql = "select * from organizer WHERE status='actif' ORDER BY created DESC";
        $result = $this->db->fetchAll($sql);
        // Convert query result to an array of domain objects
        $o = [];
        foreach ($result as $row) {
            $o[$row['id']] = $this->buildDomainObject($row);
        }
       
        return $o;
    }
    
    public function find($id) {
        $sql = "select * from organizer WHERE id=$id";
        $result = $this->db->fetchAll($sql);
 
        return $this->buildDomainObject($result[0]);
    } 

    public function findByEvent($id) {
        $sql = "select organizer.* from organizer, event_organizer where organizer.id = event_organizer.organizer_id AND event_id=?";
        $rows = $this->getDb()->fetchAll($sql, [$id]);

        $organizers = [];
        if ($rows)
        {
            foreach ($rows as $row)
                $organizers[] = $this->buildDomainObject($row);
            

        }
        
        return $organizers;
    }   

    public function findByPlace($id) {
        $sql = "select organizer.* from organizer, place_organizer where organizer.id = place_organizer.organizer_id AND place_id=?";
        $rows = $this->getDb()->fetchAll($sql, [$id]);

        $organizers = [];
        if ($rows)
        {
            foreach ($rows as $row)
                $organizers[] = $this->buildDomainObject($row);
            

        }
        
        return $organizers;
    } 
    
    public function save(Organizer $organizer) {
       
        $organizerData = array(
            'user_id' => $organizer->getAuthor()->getId(),
            'status' => $organizer->getStatus(), // TODO: selon ROLE et on edit seulement
            'nom' => $organizer->getNom(),
            'URL' => $organizer->getURL(),
            'presentation' => $organizer->getPresentation()
            );

        if ($organizer->getId()) {
            $this->getDb()->update('organizer', $organizerData, array('id' => $organizer->getId()));
        } else {
            $this->getDb()->insert('organizer', $organizerData);
            $id = $this->getDb()->lastInsertId();
            $organizer->setId($id);
        }
    }        
    
    public function buildDomainObject(array $row)
    {
        /*
         * row : id, user_id, status, nom, adresse, region, URL, email, presentation, created, modified
         */
        $organizer = new Organizer($row);

        // author
        if (array_key_exists('user_id', $row)) {
            // Find and set the associated author
            $user = $this->userManager->find($row['user_id']);
            $organizer->setAuthor($user);
        }
      
        // members
        $members = $this->userManager->findOrganizerMembers($row['id']);
        $organizer->setMembers($members);
        
        return $organizer;

    }
}