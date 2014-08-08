<?php
namespace NHK\QcBundle\Model;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
class MachineModel
{
    private $_em = null;
    public function __construct(EntityManager $em){
        $this->_em = $em;
    }

    public function getAll(){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = "SELECT * FROM qc_machine WHERE delif = 0";
        $rs=$cn->fetchAll($sql);
        return $rs;
    }

    public function addShape($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $cn->insert('qc_machine',
            array(
                'machineserialno' => $array['machineserialno'],
                'manufacture' => $array['manufacture'],
                'datecreated' => date('Y-m-d'),
                'usercreated' => 'Nam Pham',
            ));
    }

    public function editShape($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = " UPDATE qc_machine T
                    SET T.machineserialno = '".$array['machineserialno']."',
                        T.manufacture = '".$array['manufacture']."',
                        T.datecreated = '".date('Y-m-d')."',
                        T.usercreated = 'Nam Pham'
                WHERE T.id = ".$array['id'];
        $cn->executeQuery($sql);
    }

    public function deleteShape($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = " UPDATE qc_machine T
                    SET T.delif = 1
                WHERE T.id = ".$array['id'];
        $cn->executeQuery($sql);
    }
}