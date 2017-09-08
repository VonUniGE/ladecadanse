<?php

namespace Ladecadanse\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

use Ladecadanse\Entity\Place;
use Ladecadanse\Entity\User;

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

    /**
     * add : superadmin, admin, editor
     * edit : idem que add + auteur + membre du manager
     * 
     * @param string $attribute add, edit
     * @param Manager $organizer
     * @param TokenInterface $token
     * @return boolean
     */
    protected function voteOnAttribute($attribute, $place, TokenInterface $token)
    {    
        $user = $token->getUser();
 
        if (!($user instanceof User)) {
            return false;
        }

        switch ($attribute) {
            case self::ADD:
                return $this->canAdd($place, $user);
            case self::EDIT:
                return $this->canEdit($place, $user);
        }
    }    

    private function canAdd(\Ladecadanse\Entity\Place $place, User $user)
    {
        if ($user->hasRole('ROLE_SUPERADMIN') || $user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_EDITOR')) {
            return true;
        }        
        
        return false;
    }

    private function canEdit(\Ladecadanse\Entity\Place $place, User $user)
    {       
  
        // membres directs du lieu        
        $place_users = $place->getMembers();
        
        //dump($place_users);
        
        // tous les users pouvant y accéder, c-à-d tous les membres des managers associés à ce lieu
        $place_users_organizers = array();
        $place_organizers = $place->getOrganizers();
        
        //dump($place_organizers);
        
        $place_organizers_users = [];
        foreach ($place_organizers as $organizer)
        {
            $place_organizers_users = array_merge($place_organizers_users, $organizer->getMembers());
        }


        // admin ou sup, auteur ou acteur, membre d'un des managers du lieu
        if ( (($user->hasRole('ROLE_SUPERADMIN') || $user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_EDITOR')) 
                || ($user->hasRole('ROLE_ACTOR') && in_array($user, $place_users)) ) 
                || ($user->hasRole('ROLE_ACTOR') && in_array($user, $place_organizers_users))
                )
                {
           
            return true;
        }

        return false;        
        
    }
       
}
