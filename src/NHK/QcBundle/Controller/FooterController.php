<?php

namespace NHK\QcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FooterController extends Controller
{
    public function indexAction()
    {
        $arrayRender =  array();
        return $this->render('NHKQcBundle:Footer:index.html.php',$arrayRender);
    }
}
