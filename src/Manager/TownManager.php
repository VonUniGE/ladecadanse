<?php

namespace Ladecadanse\Manager;

class TownManager extends Manager
{
    /**
     * tout sauf "Autre"
     * @return array
     */
    public function findAll() {
        $sql = "SELECT * FROM town WHERE id != 1 ORDER BY region, name";
        $result = $this->db->fetchAll($sql);
        $r = [];
        foreach ($result as $row) {
            $r[$row['id']] = $row['name'];
        }
       
        return $r;
    }
    
    public function find($id) {
        $sql = "select * from town WHERE id=$id";
        
        $result = $this->db->fetchAll($sql);
 
        return $result[0];
    } 
    
    public function buildDomainObject(array $row)
    {
        return null;

    }
}