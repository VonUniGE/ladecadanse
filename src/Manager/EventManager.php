<?php

namespace Ladecadanse\Manager;

use Ladecadanse\Entity\Event;

class EventManager extends Manager
{
    private $organizerManager;    
    private $venueManager;    
    private $userManager;    

    public function setOrganizerManager(OrganizerManager $organizerManager)
    {
        $this->organizerManager = $organizerManager;
    }
    
    public function setVenueManager(VenueManager $venueManager)
    {
        $this->venueManager = $venueManager;
    }
    
    public function setUserManager(UserManager $userManager) {
        $this->userManager = $userManager;
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
        
        $sql = "select * from event e, event_organizer eo WHERE e.id = eo.event_id AND eo.organizer_id = $organizerId ORDER BY created DESC ";
        $result = $this->db->fetchAll($sql);

        $events = [];
        foreach ($result as $row) {
            $events[$row['id']] = $this->buildDomainObject($row);
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
    

    public function save(Event $event) {
        
        // TODO: 
        $eventData = array(
            'idPersonne' => $event->getAuthor()->getId(),
            'idLieu' => $event->getIdLieu(),
            'statut' => $event->getStatut(),
            'category' => $event->getCategory(),
            'titre' => $event->getTitre(),
            'dateEvenement' => $event->getDateEvenement()
            );

        if ($event->getId()) {
            // The comment has already been saved : update it
            $this->getDb()->update('evenement', $eventData, array('id' => $event->getId()));
        } else {
            // The comment has never been saved : insert it
            $this->getDb()->insert('evenement', $eventData);
            // Get the id of the newly created comment and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $event->setId($id);
        }
    }    
    
    public function buildDomainObject(array $row)
    {
        $event = new Event($row);  
  
        // event author
        if (array_key_exists('user_id', $row)) {

            $user = $this->userManager->find($row['user_id']);
            $event->setAuthor($user);
        }

        // event organizers
        $organizers = $this->organizerManager->findByEvent($row['id']);
        $event->setOrganizers($organizers);  
        
        // TODO: 
        // place (0-1) utile partout        
//        if (array_key_exists('place_id', $row)) {         
//            $place = $this->placeManager->find($row['place_id']);
//            $event->setPlace($place);
//        } 
        

        
        return $event;  
    }
}