<?php
namespace NHK\QcBundle\Model;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
class SetupDataModel
{
    private $_em = null;
    public function __construct(EntityManager $em){
        $this->_em = $em;
    }

    public function getAll(){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = "SELECT * FROM qc_shape WHERE delif = 0";
        $rs=$cn->fetchAll($sql);
        return $rs;
    }

    public function addShape($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $cn->insert('qc_shape', array('shapserialno' => $array['shapserialno']));
    }
}