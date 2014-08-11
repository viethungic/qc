<?php
namespace NHK\QcBundle\Model;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
class ResultModel
{
    private $_em = null;
    public function __construct(EntityManager $em){
        $this->_em = $em;
    }

    public function editFirstProduct($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = " UPDATE qc_operation T
                    SET T.gionhan = '".$array['gionhan']."',
                        T.giobaocao = '".$array['giobaocao']."',
                        T.ketqua = '".$array['ketqua']."'
                WHERE T.id = ".$array['id'];
        $cn->executeQuery($sql);
    }

    public function editResult($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = " UPDATE qc_operation T
                    SET T.sttcaykeo = '".$array['sttcaykeo']."'
                WHERE T.id = ".$array['id'];
        $cn->executeQuery($sql);
    }
}