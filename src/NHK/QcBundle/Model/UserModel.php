<?php
namespace NHK\QcBundle\Model;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
class UserModel
{
    private $_em = null;
    public function __construct(EntityManager $em){
        $this->_em = $em;
    }
    
    public function getUserType(){
        $em = $this->_em;
        $roles = $em->getRepository('NHKSecurityBundle:Role')->findAll();
        return $roles;
    }
    
    public function getUserList(){
        $em = $this->_em;
        $users = $em->getRepository('NHKSecurityBundle:User')->findAll();
        return $users;
    }
    
    public function addUser($params){
        $em = $this->_em;
        
        $username = $params['username'];
        $roles    = $params['roles'];
        $password = '123';
        $user = new \NHK\SecurityBundle\Entity\User();
        $encoder = new MessageDigestPasswordEncoder('md5',false);
        $password = $encoder->encodePassword($password, $user->getSalt());
        $user->setPassword($password);
        $user->setUsername($username);
        $user->setEmail('email@gmail.com');
        $em->persist($user);
        $em->flush();
    }
}