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
use NHK\QcBundle\Model\SetupDataModel;

class SetupDataController extends Controller implements DomainObjectInterface
{
    public function indexAction(){
        $model = new SetupDataModel($this->getDoctrine()->getManager());
        $arrayReturn = array('shapes'=>$model->getAll());
        return $this->render('NHKQcBundle:SetupData:index.html.php',$arrayReturn);
    }

    public function addAction(){
        $model = new SetupDataModel($this->getDoctrine()->getManager());
        $array['shapserialno'] = $this->getRequest()->request->get('shapserialno');
        $model->addShape($array);
        $arrayReturn = array();
        return $this->render('NHKQcBundle:SetupData:index.html.php',$arrayReturn);
    }
    
    
    public function getObjectIdentifier(){
        return __CLASS__;
    }
}
