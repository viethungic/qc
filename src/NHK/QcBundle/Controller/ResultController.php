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
use NHK\QcBundle\Model\MonitoringModel;
use NHK\QcBundle\Model\ResultModel;

class ResultController extends Controller implements DomainObjectInterface
{
    public function indexAction(){
        $model = new MonitoringModel($this->getDoctrine()->getManager());
        $arrayReturn = array('items'=>$model->getAll());
        return $this->render('NHKQcBundle:Result:result.html.php',$arrayReturn);
    }

    public function editAction(){
        $model = new ResultModel($this->getDoctrine()->getManager());
        $array['gionhan'] = $this->getRequest()->request->get('gionhan');
        $array['giobaocao'] = $this->getRequest()->request->get('giobaocao');
        $array['ketqua'] = $this->getRequest()->request->get('ketqua');
        $array['id'] = $this->getRequest()->request->get('id');
        $model->editFirstProduct($array);
        return new Response('OK');
    }

    public function editqcAction(){
        $model = new ResultModel($this->getDoctrine()->getManager());
        $array['sttcaykeo'] = $this->getRequest()->request->get('sttcaykeo');
        $array['id'] = $this->getRequest()->request->get('id');
        $model->editResult($array);
        return new Response('OK');
    }

    public function getObjectIdentifier(){
        return __CLASS__;
    }
}
