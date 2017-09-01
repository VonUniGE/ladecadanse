<?php

namespace LaDecadanse\AppBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

use LaDecadanse\AppBundle\Entity\Place;
use LaDecadanse\UserBundle\Entity\User;

class PlaceVoter extends Voter
{
    const ADD = 'add';
    const EDIT   = 'edit';

    public function supports($attribute, $subject)
    {
        if (!($subject instanceof Place))
        {
            return false;
        }
        
        if (!in_array($attribute, array(self::ADD, self::EDIT)))
        {
            return false;
        }
        
        return true;
    }     
    
    protected function voteOnAttribute($attribute, $place, TokenInterface $token)
    {
    
        $user = $token->getUser();
        if (!($user instanceof User)) {
            return false;
        }
        
        if ($attribute === self::ADD && ($user->hasRole('ROLE_SUPER_ADMIN') || $user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_EDITOR')) ) {
            return true;
        }

        // tous les users pouvant y accéder, c-à-d tous les membres des managers associés à ce lieu
        $place_users_managers = array();
        $place_managers = $place->getManagers();
        
        foreach ($place_managers->toArray() as $manager)
        {
            $place_users_managers = array_merge($place_users_managers, $manager->getMembers()->toArray());
        }


        // admin ou sup, auteur ou acteur, membre d'un des managers du lieu
        if ($attribute === self::EDIT && (($user->hasRole('ROLE_SUPER_ADMIN') || $user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_EDITOR')) || $user === $place->getAuthor() || ($user->hasRole('ROLE_ACTOR') && in_array($user, $place_users_managers, true)) )) {
           
            return true;
        }

        return false;

    }     
    
}
