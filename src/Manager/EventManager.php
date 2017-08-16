<?php

namespace Ladecadanse\Manager;

use Ladecadanse\Entity\Event;

class EventManager extends Manager
{
    private $organizerManager;    
    private $venueManager;    

    public function setOrganizerManager(OrganizerManager $organizerManager)
    {
        $this->organizerManager = $organizerManager;
    }
    
    public function setVenueManager(VenueManager $venueManager)
    {
        $this->venueManager = $venueManager;
    }    
    
    public function findAllToday() {
        $sql = "select * from evenement WHERE dateEvenement = '2017-06-23' ORDER BY dateAjout DESC ";
        $result = $this->db->fetchAll($sql);

        $events = [];
        foreach ($result as $row) {
            $events[$row['idevenement']] = $this->buildDomainObject($row);
        }
  
        return $events;
    }
    
    public function findAllByOrganizer($organizerId) {
        
        $sql = "select * from evenement e, evenement_organisateur eo WHERE e.idevenement=eo.idEvenement AND eo.idOrganisateur = $organizerId ORDER BY dateAjout DESC ";
        $result = $this->db->fetchAll($sql);

        $events = [];
        foreach ($result as $row) {
            $events[$row['idevenement']] = $this->buildDomainObject($row);
        }
  
        return $events;        
        // TODO
//        // art_id is not selected by the SQL query
//
//        // The article won't be retrieved during domain objet construction
//
//        $sql = "select com_id, com_content, com_author from t_comment where art_id=? order by com_id";
//
//        $result = $this->getDb()->fetchAll($sql, array($articleId));
//
//
//        // Convert query result to an array of domain objects
//
//        $comments = array();
//
//        foreach ($result as $row) {
//
//            $comId = $row['com_id'];
//
//            $comment = $this->buildDomainObject($row);
//
//            // The associated article is defined for the constructed comment
//
//            $comment->setArticle($article);
//
//            $comments[$comId] = $comment;
//
//        }
//
//        return $comments;
    }    
    
    // TODO: findAllByDay(Date d)
    
    public function find($id) {
        $sql = "select * from evenement where idevenement = ?";
        $row = $this->getDb()->fetchAssoc($sql, [$id]);

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No event matching id " . $id);
    }
    
    public function buildDomainObject(array $row)
    {
        $event = new Event($row);     
        
//        if (array_key_exists('idLieu', $row)) {         
//            $venue = $this->venueManager->find($row['idLieu']);
//            $event->setVenue($venue);
//        } 
        
        // TODO: 
        // organizers (env 0-3) utiles dans fiche, admin
        // place (0-1) utile partout
        // author (1 User) 
        
        return $event;  
    }
}