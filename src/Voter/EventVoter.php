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
        $event_organizers = $event->getOrganizers();

        // membres des organisateurs liés à l'even        
        $event_organizers_users = [];
        foreach ($event_organizers as $organizer)
        {
            $event_organizers_users = array_merge($event_organizers_users, $organizer->getMembers());
        }
        
        if (!empty($event->getPlace()))
        {
            // membres des organisateurs du lieu de l'even
            $place_organizers = $event->getPlace()->getOrganizers();      
            //TODO ôter doublons
            $event_place_organizers_users = [];
            foreach ($place_organizers as $organizer)
            {
                $event_place_organizers_users = array_merge($event_place_organizers_users, $organizer->getMembers());
            }
        
            // membres du lieu de l'even
            $event_place_users = $event->getPlace()->getMembers();            
        }

        
        // au moins éditeur, auteur; membre du lieu de l'even ou membre d'un des orga de l'even
        if (
        ($user->hasRole('ROLE_SUPERADMIN') || $user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_EDITOR')) ||
        $user == $event->getAuthor() ||
        ( $user->hasRole('ROLE_ACTOR') && (in_array($user, $event_organizers_users) || in_array($user, $event_place_organizers_users) || in_array($user, $event_place_users)))
        )
        {
            return true;
        }
    }    
    
}
