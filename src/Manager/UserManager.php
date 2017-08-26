<?php

namespace Ladecadanse\Manager;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Ladecadanse\Entity\User;

class UserManager extends Manager implements UserProviderInterface
{
    /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The user id.
     *
     * @return \MicroCMS\Domain\User|throws an exception if no matching user is found
     */
    public function find($id) {
        $sql = "select * from personne where idPersonne=?";
        $row = $this->getDb()->fetchAssoc($sql, [$id]);

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No user matching id " . $id);
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $sql = "select * from personne where pseudo=?";
        $row = $this->getDb()->fetchAssoc($sql, [$username]);

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'Ladecadanse\Entity\User' === $class;
    }

    /**
     * Creates a User object based on a DB row.
     *
     * @param array $row The DB row containing User data.
     * @return \Ladecadanse\Entity\User
     */
    protected function buildDomainObject(array $row) {
        $user = new User();
        $user->setId($row['idPersonne']);
        $user->setUsername($row['pseudo']);
        $user->setPassword($row['mot_de_passe']);
        $user->setSalt($row['gds']);
        $user->setRole($row['role']);
        return $user;
    }
}