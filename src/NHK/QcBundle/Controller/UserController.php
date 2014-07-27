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
        $userModel = new \NHK\QcBundle\Model\UserModel($this->getDoctrine()->getManager());
        $userRoles = $userModel->getUserType();
        $userList = $userModel->getUserList();
        $arrayReturn = array(
            'userRoles' => $userRoles,
            'userList'  => $userList, 
        );
        return $this->render('NHKQcBundle:User:user.html.php',$arrayReturn);
    }
    
    public function addAction(){
        $roles = $this->getRequest()->request->get('roles');
        $username = $this->getRequest()->request->get('username');
        var_dump($roles);
        return new Response('OK');
    }
    
    public function getObjectIdentifier(){
        return __CLASS__;
    }
}
