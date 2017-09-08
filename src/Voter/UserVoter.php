<?php

namespace Ladecadanse\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

use Ladecadanse\Entity\User;


class UserVoter extends Voter
{
    const EDIT   = 'edit';

    public function supports($attribute, $subject)
    {
    
        if (!($subject instanceof User))
        {
            return false;
        }
        
        if (!in_array($attribute, array(self::EDIT)))
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
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {    
        $user = $token->getUser();
 
        if (!($subject instanceof User)) {
            return false;
        }

        switch ($attribute) {
            case self::EDIT:
                return $this->canEdit($subject, $user);
        }
    }    

    private function canEdit(\Ladecadanse\Entity\User $subject, User $user)
    {       
        
        if ($user->hasRole('ROLE_SUPERADMIN') || $user->hasRole('ROLE_ADMIN') || $subject->getId() === $user->getId()) {
            return true;
        }        
        
        return false;
    }
    
}
