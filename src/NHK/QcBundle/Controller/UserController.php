<?php

namespace NHK\QcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Acl\Model\DomainObjectInterface;

use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\Security\Acl\Exception\AclNotFoundException;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Doctrine\ORM\Mapping\ClassMetadata;
use NHK\QcBundle\Model\UserModel;

class DefaultController extends Controller implements DomainObjectInterface 
{
    public function indexAction(){
        $user = new \NHK\QcBundle\Model\UserModel($this->getDoctrine()->getManager());
    }
    
    
    public function getObjectIdentifier(){
        return __CLASS__;
    }
}
