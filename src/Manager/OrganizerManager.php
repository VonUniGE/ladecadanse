<?php

namespace Ladecadanse\Manager;

use Ladecadanse\Entity\Organizer;

class OrganizerManager extends Manager
{
    public function findAll() {
        $sql = "select * from organisateur WHERE statut='actif' ORDER BY date_ajout DESC";
        $result = $this->db->fetchAll($sql);
        // Convert query result to an array of domain objects
        $o = [];
        foreach ($result as $row) {
            $o[$row['idOrganisateur']] = $this->buildDomainObject($row);
        }
       
        return $o;
    }
    
    public function find($id) {
        $sql = "select * from organisateur WHERE idOrganisateur=$id";
        $result = $this->db->fetchAll($sql);
 
        return $this->buildDomainObject($result[0]);
    } 

    
    public function buildDomainObject(array $row)
    {
        $organizer = new Organizer($row);

        // TODO: 
        // author (1 : User)
        // members (0-5 : User) utile partout
        // places (0-5 : Place) utile dans admin
        
        return $organizer;

    }
}