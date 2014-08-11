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
use NHK\QcBundle\Model\MachineModel;
use NHK\QcBundle\Model\SetupDataModel;

class MonitoringController extends Controller implements DomainObjectInterface
{
    public $itemsPerLine = 7;

    public function indexAction(){
        $model = new MonitoringModel($this->getDoctrine()->getManager());
        $arrayReturn = array('items'=>$model->getAll(), 'itemsPerLine'=>$this->itemsPerLine);
        return $this->render('NHKQcBundle:Monitoring:monitoring.html.php',$arrayReturn);
    }

    public function editAction(){
        $model = new MonitoringModel($this->getDoctrine()->getManager());
        $machine = new MachineModel($this->getDoctrine()->getManager());
        $setupdata = new SetupDataModel($this->getDoctrine()->getManager());
        $array['row'] = $this->getRequest()->request->get('row');
        $array['column'] = $this->getRequest()->request->get('column');

        $list = $model->getAll();
        if ($array['row'] == ceil(count($list)/$this->itemsPerLine))
            $totalItemPerLine = count($list) - ($array['row']-1)*$this->itemsPerLine;
        else
            $totalItemPerLine = $this->itemsPerLine;

        if ($array['column'] == 'M') {
            for ($i = 1; $i <= $totalItemPerLine; $i++) {
                $machineInfo = $machine->getBySN($this->getRequest()->request->get($i));
                $array['machineid'] = $machineInfo[0]['id'];
                $array['id'] = ($array['row']-1)*$this->itemsPerLine + $i;
                if(!count($model->getBySNAndDiffId($array['machineid'], $array['id']))) {
                    $model->editMachine($array);
                } else {
                    return new Response('Exist');
                }
            }
        } else if ($array['column'] == 'MSK') {
            for ($i = 1; $i <= $totalItemPerLine; $i++) {
                $shapeInfo = $setupdata->getBySN($this->getRequest()->request->get($i));
                $array['shapeid'] = $shapeInfo[0]['id'];
                $array['id'] = ($array['row']-1)*$this->itemsPerLine + $i;
                $model->editShape($array);
            }
        } else if ($array['column'] == 'MSCN') {
            for ($i = 1; $i <= $totalItemPerLine; $i++) {
                $array['workerno'] = $this->getRequest()->request->get($i);
                $array['id'] = ($array['row']-1)*$this->itemsPerLine + $i;
                $model->editWorker($array);
            }
        }
        return new Response('OK');
    }

    public function getObjectIdentifier(){
        return __CLASS__;
    }
}
