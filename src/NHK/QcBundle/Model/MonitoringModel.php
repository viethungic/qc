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

    public function getBySNAndDiffId($machineid, $id){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = "SELECT * FROM qc_operation WHERE machineid = $machineid AND id <> $id AND delif = 0";
        $rs=$cn->fetchAll($sql);
        return $rs;
    }

    public function add($id){
        $em = $this->_em;
        $cn = $em->getConnection();
        $cn->insert('qc_operation',
            array(
                'machineid' => $id,
                'datecreated' => date('Y-m-d H:i:s'),
                'usercreated' => 'Hung Truong',
            ));
    }

    public function editMachine($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = " UPDATE qc_operation T
                    SET T.machineid = ".$array['machineid']."
                WHERE T.id = ".$array['id'];
        $cn->executeQuery($sql);
    }

    public function editShape($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = " UPDATE qc_operation T
                    SET T.shapeid = ".$array['shapeid']."
                WHERE T.id = ".$array['id'];
        $cn->executeQuery($sql);
    }

    public function editWorker($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = " UPDATE qc_operation T
                    SET T.workerno = '".$array['workerno']."'
                WHERE T.id = ".$array['id'];
        $cn->executeQuery($sql);
    }
}