<?php
namespace NHK\QcBundle\Model;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
class OrderModel
{
    private $_em = null;
    public function __construct(EntityManager $em){
        $this->_em = $em;
    }

    public function getAll(){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = "SELECT O.*, S.shapserialno FROM qc_order O INNER JOIN qc_shape S ON S.id = O.shapeid WHERE O.delif = 0 ORDER BY O.id DESC";
        $rs=$cn->fetchAll($sql);
        return $rs;
    }

    public function getById($id){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = "SELECT * FROM qc_order WHERE id = $id AND delif = 0";
        $rs=$cn->fetchAll($sql);
        return $rs;
    }

    public function add($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $cn->insert('qc_order',
            array(
                'shapeid' => $array['shapeid'],
                'soluongyeucau' => $array['soluongyeucau'],
                'soluonghoanthanh' => 0,
                'soluongconlai' => $array['soluongyeucau'],
                'ngaybatdau' => $array['ngaybatdau'],
                'ngayhoanthanh' => $array['ngayhoanthanh'],
                'trangthaihoanthanh' => 0,
                'datecreated' => date('Y-m-d H:i:s'),
                'usercreated' => 'Hung Truong',
            ));
    }

    public function edit($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = " UPDATE qc_order T
                    SET T.shapeid = '".$array['shapeid']."',
                        T.soluongyeucau = '".$array['soluongyeucau']."',
                        T.soluonghoanthanh = 0,
                        T.soluongconlai = '".$array['soluongyeucau']."',
                        T.ngaybatdau = '".$array['ngaybatdau']."',
                        T.ngayhoanthanh = '".$array['ngayhoanthanh']."',
                        T.trangthaihoanthanh = 0,
                        T.datecreated = '".date('Y-m-d H:i:s')."',
                        T.usercreated = 'Hung Truong'
                WHERE T.id = ".$array['id'];
        $cn->executeQuery($sql);
    }

    public function delete($array){
        $em = $this->_em;
        $cn = $em->getConnection();
        $sql = " UPDATE qc_order T
                    SET T.delif = 1
                WHERE T.id = ".$array['id'];
        $cn->executeQuery($sql);
    }
}