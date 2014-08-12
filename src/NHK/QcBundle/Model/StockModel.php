<?php
namespace NHK\QcBundle\Model;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
class StockModel
{
    private $_em = null;
    public function __construct(EntityManager $em){
        $this->_em = $em;
    }

    public function edit($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = " UPDATE qc_operation T
                    SET T.workerno = '".$array['workerno']."',
                        T.fullname = '".$array['fullname']."',
                        T.sex = '".$array['sex']."',
                        T.datecreated = '".date('Y-m-d H:i:s')."',
                        T.usercreated = 'Hung Truong'
                WHERE T.id = ".$array['id'];
        $cn->executeQuery($sql);
    }
}