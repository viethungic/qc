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
use NHK\QcBundle\Model\WorkerModel;

class WorkerController extends Controller implements DomainObjectInterface
{
    public function indexAction(){
        $model = new WorkerModel($this->getDoctrine()->getManager());
        $arrayReturn = array('items'=>$model->getAll());
        return $this->render('NHKQcBundle:Worker:worker.html.php',$arrayReturn);
    }

    public function addAction(){
        $model = new WorkerModel($this->getDoctrine()->getManager());
        $array['machineserialno'] = $this->getRequest()->request->get('machineserialno');
        $array['manufacture'] = $this->getRequest()->request->get('manufacture');
        if(!count($model->getBySN($array['machineserialno']))) {
            $model->add($array);
        } else {
            return new Response('Exist');
        }
        return new Response('OK');
    }

    public function editAction(){
        $model = new WorkerModel($this->getDoctrine()->getManager());
        $array['machineserialno'] = $this->getRequest()->request->get('machineserialno');
        $array['manufacture'] = $this->getRequest()->request->get('manufacture');
        $array['id'] = $this->getRequest()->request->get('id');
        if(!count($model->getBySNAndDiffId($array['machineserialno'], $array['id']))) {
            $model->edit($array);
        } else {
            return new Response('Exist');
        }
        return new Response('OK');
    }

    public function deleteAction(){
        $model = new WorkerModel($this->getDoctrine()->getManager());
        $array['id'] = $this->getRequest()->request->get('id');
        $model->delete($array);
        return new Response('OK');
    }

    public function getObjectIdentifier(){
        return __CLASS__;
    }
}
