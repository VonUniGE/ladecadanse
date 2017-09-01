<?php

namespace Ladecadanse\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

use Ladecadanse\Entity\Event;
use Ladecadanse\Entity\User;

class EventVoter extends Voter
{
    const ADD = 'add';
    const EDIT   = 'edit';
    
    public function supports($attribute, $subject)
    {
        if (!($subject instanceof Event))
        {
            return false;
        }
        
        if (!in_array($attribute, array(self::ADD, self::EDIT)))
        {
            return false;
        }
        
        return true;
    }    
    
    protected function voteOnAttribute($attribute, $event, TokenInterface $token)
    {
        $user = $token->getUser();
 
        if (!($user instanceof User)) {
            return false;
        }

        switch ($attribute) {
            case self::ADD:
                return $this->canAdd($event, $user);
            case self::EDIT:
                return $this->canEdit($event, $user);
        }     
        


        return false;

    }      
 
    private function canAdd(\Ladecadanse\Entity\Event $event, User $user)
    {
        if ($user->hasRole('ROLE_SUPERADMIN') || $user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_EDITOR') || $user->hasRole('ROLE_ACTOR')) {
            return true;
        }        
        
        return false;
    }

    private function canEdit(\Ladecadanse\Entity\Event $event, User $user)
    {       
        $event_users_managers = array();
        $event_organizers = $event->getOrganizers();
        
        // TODO membres des organisateurs liés à l'even
        foreach ($event_organizers as $organizer)
        {
            $event_users_managers = array_merge($event_users_managers, $manager->getMembers()->toArray());
        }
        
        // TODO membres des organisateurs du lieu de l'even
        $event_users_place_managers = array();
        $place_managers = $event->getPlace()->getManagers();
        
        foreach ($place_managers->toArray() as $manager)
        {
            $event_users_place_managers = array_merge($event_users_place_managers, $manager->getMembers()->toArray());
        }
        
        // TODO membres du lieu de l'even

        // au moins éditeur, auteur; membre du lieu de l'even ou membre d'un des orga de l'even
        if (
        ($user->hasRole('ROLE_SUPERADMIN') || $user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_EDITOR')) ||
        $user == $event->getAuthor() ||
        ( $user->hasRole('ROLE_ACTOR') && (in_array($user, $event_users_managers, true) || in_array($user, $event_users_place_managers, true)))
        )
        {
            //dump($user);
            return true;
        }
    }    
    
}
