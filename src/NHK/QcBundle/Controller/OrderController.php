<?php

namespace NHK\QcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Acl\Model\DomainObjectInterface;

use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\Security\Acl\Exception\AclNotFoundException;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Component\HttpFoundation\Response;
use NHK\QcBundle\Model\OrderModel;
use NHK\QcBundle\Model\SetupDataModel;

class OrderController extends Controller implements DomainObjectInterface
{
    public function indexAction(){
        $model = new OrderModel($this->getDoctrine()->getManager());
        $arrayReturn = array('items'=>$model->getAll());
        return $this->render('NHKQcBundle:Order:order.html.php',$arrayReturn);
    }

    public function addAction(){
        $model = new OrderModel($this->getDoctrine()->getManager());
        $setupdata = new SetupDataModel($this->getDoctrine()->getManager());
        $shape = $setupdata->getBySN($this->getRequest()->request->get('shapserialno'));
        if (!count($shape)) {
            return new Response('Not Exist');
        }
        $array['shapeid'] = $shape[0]['id'];
        $array['soluongyeucau'] = $this->getRequest()->request->get('soluongyeucau');
        $array['ngaybatdau'] = $this->getRequest()->request->get('ngaybatdau');
        $array['ngayhoanthanh'] = $this->getRequest()->request->get('ngayhoanthanh');
        $model->add($array);
        return new Response('OK');
    }

    public function editAction(){
        $model = new OrderModel($this->getDoctrine()->getManager());
        $setupdata = new SetupDataModel($this->getDoctrine()->getManager());
        $shape = $setupdata->getBySN($this->getRequest()->request->get('shapserialno'));
        if (!count($shape)) {
            return new Response('Not Exist');
        }
        $array['shapeid'] = $shape[0]['id'];
        $array['soluongyeucau'] = $this->getRequest()->request->get('soluongyeucau');
        $array['ngaybatdau'] = $this->getRequest()->request->get('ngaybatdau');
        $array['ngayhoanthanh'] = $this->getRequest()->request->get('ngayhoanthanh');
        $array['id'] = $this->getRequest()->request->get('id');
        $model->edit($array);
        return new Response('OK');
    }

    public function deleteAction(){
        $model = new OrderModel($this->getDoctrine()->getManager());
        $array['id'] = $this->getRequest()->request->get('id');
        $model->delete($array);
        return new Response('OK');
    }

    public function getObjectIdentifier(){
        return __CLASS__;
    }
}
