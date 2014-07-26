<?php
namespace NHK\QcBundle\Model;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
class UserModel
{
    private $_em = null;
    public function __construct(EntityManager $em){
        $this->_em = $em;
    }
}