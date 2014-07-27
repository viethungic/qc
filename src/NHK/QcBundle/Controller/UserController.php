<?php

namespace NHK\QcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Acl\Model\DomainObjectInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use NHK\QcBundle\Model\UserModel;

class UserController extends Controller implements DomainObjectInterface 
{
    public function indexAction(){
        $user = new \NHK\QcBundle\Model\UserModel($this->getDoctrine()->getManager());
        $arrayReturn = array();
        return $this->render('NHKQcBundle:User:user.html.php',$arrayReturn);
    }
    
    
    public function getObjectIdentifier(){
        return __CLASS__;
    }
}
