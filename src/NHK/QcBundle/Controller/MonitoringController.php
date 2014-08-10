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

class MonitoringController extends Controller implements DomainObjectInterface
{
    public function indexAction(){
        $model = new MonitoringModel($this->getDoctrine()->getManager());
        $arrayReturn = array('items'=>$model->getAll(), 'itemsPerLine'=>7);
        return $this->render('NHKQcBundle:Monitoring:monitoring.html.php',$arrayReturn);
    }

    public function editAction(){
        $model = new MonitoringModel($this->getDoctrine()->getManager());
        $array['id'] = $this->getRequest()->request->get('id');
        if(!count($model->getBySNAndDiffId($array['Monitoringno'], $array['id']))) {
            $model->edit($array);
        } else {
            return new Response('Exist');
        }
        return new Response('OK');
    }

    public function getObjectIdentifier(){
        return __CLASS__;
    }
}
