<?php

namespace Ladecadanse\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

use Ladecadanse\Entity\Organizer;
use Ladecadanse\Entity\User;


class OrganizerVoter extends Voter
{
    const ADD = 'add';
    const EDIT   = 'edit';

    public function supports($attribute, $subject)
    {
    
        if (!($subject instanceof Organizer))
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
    protected function voteOnAttribute($attribute, $organizer, TokenInterface $token)
    {    
        $user = $token->getUser();
 
        if (!($user instanceof User)) {
            return false;
        }

        switch ($attribute) {
            case self::ADD:
                return $this->canAdd($organizer, $user);
            case self::EDIT:
                return $this->canEdit($organizer, $user);
        }
    }    

    private function canAdd(\Ladecadanse\Entity\Organizer $organizer, User $user)
    {
        if ($user->hasRole('ROLE_SUPERADMIN') || $user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_EDITOR')) {
            return true;
        }        
        
        return false;
    }

    private function canEdit(\Ladecadanse\Entity\Organizer $organizer, User $user)
    {       
//        var_dump($user);
//        var_dump($organizer->getAuthor());
        // admin ou sup, auteur ou membre de ce même manager
        if (($user->hasRole('ROLE_SUPERADMIN') || $user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_EDITOR')) || $user->getId() === $organizer->getAuthor()->getId() || $organizer->hasMember($user)) {
    
            return true;
        }        
        
        return false;
    }
    
}
