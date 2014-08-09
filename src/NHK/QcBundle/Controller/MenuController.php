<?php

namespace NHK\QcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use NHK\QcBundle\Model\MenuModel;

class MenuController extends Controller
{
    public function indexAction($routeName)
    {      
        $router = $this->get('router');
        $menuModel = new MenuModel($this->getDoctrine()->getManager(),$this->getRequest(),$router, $routeName);
        $menu = $menuModel->getMenu();
        $arrayRender =  array(
            'menu' => $menu
        );
        return $this->render('NHKQcBundle:Menu:index.html.php',$arrayRender);
    }
}
