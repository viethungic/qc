<?php

namespace NHK\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ResourceController extends Controller
{
    public function indexAction()
    {
        $routes = $this->getAllRouting();
        $this->saveRoutes();
        $resources = $this->getDoctrine()->getManager()->getRepository('NHKSecurityBundle:QcResource')->findAll();
        $arrayReturn = array(
            'resources' => $resources
        );
        return $this->render('NHKSecurityBundle:Resource:index.html.php', $arrayReturn);
    }
    
    public function getAllRouting(){
        /** @var $router \Symfony\Component\Routing\Router */
        $router = $this->container->get('router');
        /** @var $collection \Symfony\Component\Routing\RouteCollection */
        $collection = $router->getRouteCollection();
        $allRoutes = $collection->all();
    
        $routes = array();
    
        /** @var $params \Symfony\Component\Routing\Route */
        foreach ($allRoutes as $route => $params)
        {
            $defaults = $params->getDefaults();
    
            if (isset($defaults['_controller']))
            {
                $controllerAction = explode(':', $defaults['_controller']);
                $controller = $controllerAction[0];
    
                if (!isset($routes[$controller])) {
                    $routes[$controller] = array();
                }
    
                $routes[$controller][]= $route;
            }
        }
        return $routes;
    }
    
    public function saveRoutes(){
        $em = $this->getDoctrine()->getManager();
        $allRoutes = $this->getAllRouting();
        foreach($allRoutes as $controller => $routes){
            $parentId = 0;
            foreach($routes as $route){
                $resource = $em->getRepository('NHKSecurityBundle:QcResource')->findOneBy(array('controller'=>$controller,'route'=>$route));
                if($resource != NULL){/** Da co */
                
                }else{
                    if($parentId==0){
                        $level = 0;
                    }else{
                        $level = 1;
                    }
                    $resource = new \NHK\SecurityBundle\Entity\QcResource();
                    $resource->setController($controller);
                    $resource->setRoute($route);
                    $resource->setControllerName($controller);
                    $resource->setRouteName($route);
                    $resource->setParentId($parentId);
                    $resource->setStatus(0);
                    $resource->setLevel($level);
                    $em->persist($resource);
                    $em->flush();
                    $parentId = $resource->getId();
                }    
            }  
        }
       
    }
}
