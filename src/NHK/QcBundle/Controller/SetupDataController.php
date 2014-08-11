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
use NHK\QcBundle\Model\SetupDataModel;

class SetupDataController extends Controller implements DomainObjectInterface
{
    public function indexAction(){
        $model = new SetupDataModel($this->getDoctrine()->getManager());
        $arrayReturn = array('shapes'=>$model->getAll());
        return $this->render('NHKQcBundle:SetupData:setupdata.html.php',$arrayReturn);
    }

    public function addAction(){
        $model = new SetupDataModel($this->getDoctrine()->getManager());
        $array['shapserialno'] = $this->getRequest()->request->get('shapserialno');
        $array['congthuc'] = $this->getRequest()->request->get('congthuc');
        $array['sobo'] = $this->getRequest()->request->get('sobo');
        $array['socav'] = $this->getRequest()->request->get('socav');
        $array['cuongdolaodong'] = $this->getRequest()->request->get('cuongdolaodong');
        $array['trongluongphoi'] = $this->getRequest()->request->get('trongluongphoi');
        $array['kehoachgiaokeo'] = $this->getRequest()->request->get('kehoachgiaokeo');
        $array['donvitinh'] = $this->getRequest()->request->get('donvitinh');
        $array['tilechophep'] = $this->getRequest()->request->get('tilechophep');
        if(!count($model->getBySN($array['shapserialno']))) {
            $model->addShape($array);
        } else {
            return new Response('Exist');
        }
        return new Response('OK');
    }

    public function editAction(){
        $model = new SetupDataModel($this->getDoctrine()->getManager());
        $array['shapserialno'] = $this->getRequest()->request->get('shapserialno');
        $array['congthuc'] = $this->getRequest()->request->get('congthuc');
        $array['sobo'] = $this->getRequest()->request->get('sobo');
        $array['socav'] = $this->getRequest()->request->get('socav');
        $array['cuongdolaodong'] = $this->getRequest()->request->get('cuongdolaodong');
        $array['trongluongphoi'] = $this->getRequest()->request->get('trongluongphoi');
        $array['kehoachgiaokeo'] = $this->getRequest()->request->get('kehoachgiaokeo');
        $array['donvitinh'] = $this->getRequest()->request->get('donvitinh');
        $array['tilechophep'] = $this->getRequest()->request->get('tilechophep');
        $array['id'] = $this->getRequest()->request->get('id');
        if(!count($model->getBySNAndDiffId($array['shapserialno'], $array['id']))) {
            $model->editShape($array);
        } else {
            return new Response('Exist');
        }
        return new Response('OK');
    }

    public function deleteAction(){
        $model = new SetupDataModel($this->getDoctrine()->getManager());
        $array['id'] = $this->getRequest()->request->get('id');
        $model->deleteShape($array);
        return new Response('OK');
    }

    public function editqcAction(){
        $model = new SetupDataModel($this->getDoctrine()->getManager());
        $array['thongsongoaiquan'] = $this->getRequest()->request->get('thongsongoaiquan');
        $array['hinhanhngoaiquan'] = $this->getRequest()->request->get('hinhanhngoaiquan');
        $array['docung'] = $this->getRequest()->request->get('docung');
        $array['kichthuoc'] = $this->getRequest()->request->get('kichthuoc');
        $array['yeucaukhac'] = $this->getRequest()->request->get('yeucaukhac');
        $array['id'] = $this->getRequest()->request->get('id');
        $model->editQc($array);
        return new Response('OK');
    }

    public function getObjectIdentifier(){
        return __CLASS__;
    }
}
