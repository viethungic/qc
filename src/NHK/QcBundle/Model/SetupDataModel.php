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
        $cn->insert('qc_shape',
            array(
                'shapserialno' => $array['shapserialno'],
                'congthuc' => $array['congthuc'],
                'sobo' => $array['sobo'],
                'socav' => $array['socav'],
                'cuongdolaodong' => $array['cuongdolaodong'],
                'trongluongphoi' => $array['trongluongphoi'],
                'kehoachgiaokeo' => $array['kehoachgiaokeo'],
                'donvitinh' => $array['donvitinh'],
                'tilechophep' => $array['tilechophep']
            ));
    }

    public function editShape($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = " UPDATE qc_shape T
                    SET T.shapserialno = '".$array['shapserialno']."',
                        T.congthuc = '".$array['congthuc']."',
                        T.sobo = '".$array['sobo']."',
                        T.socav = '".$array['socav']."',
                        T.cuongdolaodong = '".$array['cuongdolaodong']."',
                        T.trongluongphoi = '".$array['trongluongphoi']."',
                        T.kehoachgiaokeo = '".$array['kehoachgiaokeo']."',
                        T.donvitinh = '".$array['donvitinh']."',
                        T.tilechophep = '".$array['tilechophep']."'
                WHERE T.id = ".$array['id'];
        $cn->executeQuery($sql);
    }

    public function editQc($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = " UPDATE qc_shape T
                    SET T.thongsongoaiquan = '".$array['thongsongoaiquan']."',
                        T.hinhanhngoaiquan = '".$array['hinhanhngoaiquan']."',
                        T.docung = '".$array['docung']."',
                        T.kichthuoc = '".$array['kichthuoc']."',
                        T.yeucaukhac = '".$array['yeucaukhac']."'
                WHERE T.id = ".$array['id'];
        $cn->executeQuery($sql);
    }

    public function deleteShape($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = " UPDATE qc_shape T
                    SET T.delif = 1
                WHERE T.id = ".$array['id'];
        $cn->executeQuery($sql);
    }
}