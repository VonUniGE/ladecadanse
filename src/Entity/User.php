<?php

namespace Ladecadanse\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class User extends Entity implements UserInterface
{
    /**
     * User id.
     *
     * @var integer
     */
    private $id;

    /**
     * User name.
     *
     * @var string
     */
    private $username;

    /**
     * User password.
     *
     * @var string
     */
    private $password;

    /**
     * Salt that was originally used to encode the password.
     *
     * @var string
     */
    private $salt;
 
    /**
     * Role.
     * Values : ROLE_USER or ROLE_ADMIN.
     *
     * @var string
     */
    private $role;

    protected $status; // enum('actif', 'inactif', 'ancien') 
    protected $nom;    
    protected $prenom;    
    protected $affiliation;    
    protected $region;    
    protected $email;   
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array($this->getRole());
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

    public function getPrenom()
    {
        return $this->prenom;
    }
    
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAffiliation()
    {
        return $this->affiliation;
    }
    
    public function setAffiliation($affiliation)
    {
        $this->affiliation = $affiliation;

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

    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    } 
    
    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        // Nothing to do here
    }
}