<?php
namespace NHK\QcBundle\Model;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
class MonitoringModel
{
    private $_em = null;
    public function __construct(EntityManager $em){
        $this->_em = $em;
    }

    public function getAll(){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = "SELECT o.*, s.shapserialno, m.machineserialno  FROM qc_operation o INNER JOIN qc_machine m ON o.machineid = m.id INNER JOIN qc_shape s ON o.shapeid = s.id WHERE o.delif = 0 AND s.delif = 0 AND m.delif = 0";
        $rs=$cn->fetchAll($sql);
        return $rs;
    }

    public function getById($id){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = "SELECT * FROM qc_operation WHERE id = $id AND delif = 0";
        $rs=$cn->fetchAll($sql);
        return $rs;
    }

    public function getBySN($Monitoringno){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = "SELECT * FROM qc_operation WHERE Monitoringno = '$Monitoringno' AND delif = 0";
        $rs=$cn->fetchAll($sql);
        return $rs;
    }

    public function add($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $cn->insert('qc_operation',
            array(
                'Monitoringno' => $array['Monitoringno'],
                'fullname' => $array['fullname'],
                'sex' => $array['sex'],
                'datecreated' => date('Y-m-d'),
                'usercreated' => 'Nam Pham',
            ));
    }

    public function edit($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = " UPDATE qc_operation T
                    SET T.Monitoringno = '".$array['Monitoringno']."',
                        T.fullname = '".$array['fullname']."',
                        T.sex = '".$array['sex']."',
                        T.datecreated = '".date('Y-m-d')."',
                        T.usercreated = 'Nam Pham'
                WHERE T.id = ".$array['id'];
        $cn->executeQuery($sql);
    }

    public function delete($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = " UPDATE qc_operation T
                    SET T.delif = 1
                WHERE T.id = ".$array['id'];
        $cn->executeQuery($sql);
    }
}