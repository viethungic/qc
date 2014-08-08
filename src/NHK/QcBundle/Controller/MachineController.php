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
use NHK\QcBundle\Model\MachineModel;

class MachineController extends Controller implements DomainObjectInterface
{
    public function indexAction(){
        $model = new MachineModel($this->getDoctrine()->getManager());
        $arrayReturn = array('items'=>$model->getAll());
        return $this->render('NHKQcBundle:Machine:machine.html.php',$arrayReturn);
    }

    public function addAction(){
        $model = new MachineModel($this->getDoctrine()->getManager());
        $array['machineserialno'] = $this->getRequest()->request->get('machineserialno');
        $array['manufacture'] = $this->getRequest()->request->get('manufacture');
        $model->addShape($array);
        return new Response('OK');
    }

    public function editAction(){
        $model = new MachineModel($this->getDoctrine()->getManager());
        $array['machineserialno'] = $this->getRequest()->request->get('machineserialno');
        $array['manufacture'] = $this->getRequest()->request->get('manufacture');
        $array['id'] = $this->getRequest()->request->get('id');
        $model->editShape($array);
        return new Response('OK');
    }

    public function deleteAction(){
        $model = new MachineModel($this->getDoctrine()->getManager());
        $array['id'] = $this->getRequest()->request->get('id');
        $model->deleteShape($array);
        return new Response('OK');
    }

    public function getObjectIdentifier(){
        return __CLASS__;
    }
}
