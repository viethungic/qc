<?php

namespace NHK\QcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HeaderController extends Controller
{
    public function indexAction($routeName)
    {
        $arrayRender =  array(
            'routeName' => $routeName,
        );
        return $this->render('NHKQcBundle:Header:index.html.php',$arrayRender);
    }
}
