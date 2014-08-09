<?php
namespace NHK\QcBundle\Model;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
class WorkerModel
{
    private $_em = null;
    public function __construct(EntityManager $em){
        $this->_em = $em;
    }

    public function getAll(){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = "SELECT * FROM qc_worker WHERE delif = 0";
        $rs=$cn->fetchAll($sql);
        return $rs;
    }

    public function getById($id){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = "SELECT * FROM qc_worker WHERE id = $id AND delif = 0";
        $rs=$cn->fetchAll($sql);
        return $rs;
    }

    public function getBySN($workerserialno){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = "SELECT * FROM qc_worker WHERE workerserialno = '$workerserialno' AND delif = 0";
        $rs=$cn->fetchAll($sql);
        return $rs;
    }

    public function getBySNAndDiffId($workerserialno, $id){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = "SELECT * FROM qc_worker WHERE workerserialno = '$workerserialno' AND id <> $id AND delif = 0";
        $rs=$cn->fetchAll($sql);
        return $rs;
    }

    public function add($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $cn->insert('qc_worker',
            array(
                'workerno' => $array['workerno'],
                'fullname' => $array['fullname'],
                'sex' => $array['sex'],
                'datecreated' => date('Y-m-d'),
                'usercreated' => 'Nam Pham',
            ));
    }

    public function edit($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = " UPDATE qc_worker T
                    SET T.workerno = '".$array['workerno']."',
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
        $sql = " UPDATE qc_worker T
                    SET T.delif = 1
                WHERE T.id = ".$array['id'];
        $cn->executeQuery($sql);
    }
}