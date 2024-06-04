<?php

namespace App\Security\Voter;
use App\Entity\Service;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class ServiceVoter extends Voter
{
    const EDIT = 'SERVICE_EDIT';
    const DELETE = 'SERVICE_DELETE';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $service): bool
    {
        if(!in_array($attribute, [self::EDIT, self::DELETE])){
            return false;
        }
        if(!$service instanceof Service){
            return false;
        }
        return true;

        // return in_array($attribute, [self::EDIT, self::DELETE]) && $product instanceof Products;
    }

    protected function voteOnAttribute($attribute, $service, TokenInterface $token): bool
    {
        // we retrieve the user from the token
        $user = $token->getUser();

        if(!$user instanceof UserInterface) return false;

        // we check if the user is admin
        if($this->security->isGranted('ROLE_ADMIN')) return true;

        // we check the permissions
        switch($attribute){
            case self::EDIT:
                // we check if the user can edit
                return $this->canEdit();
                break;
            case self::DELETE:
                // we check if the user can delete
                return $this->canDelete();
                break;
        }
    }

    private function canEdit(){
        return $this->security->isGranted('ROLE_EMPLOYE');
    }
    private function canDelete(){
        return $this->security->isGranted('ROLE_ADMIN');
    }
}