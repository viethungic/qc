<?php
namespace NHK\QcBundle\Model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
class MenuModel
{
    private $_em = null;
    private $_request = null;
    private $_router = null;
    private $_routeName = '';
    public function __construct(EntityManager $em, Request $request, Router $router, $routeName){
        $this->_em = $em;
        $this->_request = $request;
        $this->_router = $router;
        $this->_routeName = $routeName;
    }
    
    public function getMenu(){
        $results = $this->_em->getRepository('NHKSecurityBundle:QcResource')->findBy(array('status'=>1));
        $menu = $this->getMenuHtml(0,$results);
        return $menu;
    }
    
    private function getMenuHtml($parentId = 0, $menuList, $hs =0){
        if($hs == 0)
        $html = '<ul class="nav navbar-nav" style="">';
        else
        $html = '<ul class="dropdown-menu" style="">';

        foreach($menuList as $m){
            $path = $this->getPath($m->getId(),$menuList);
            if($m->getParentId() == $parentId){
                $href = $this->_router->generate($m->getRoute());
                if($this->_routeName != $m->getRoute()){
                    $active = '';
                }else{
                    $active = 'active';
                }
                if($hs == 0){
                    $html .= '<li class ="classic-menu-dropdown '.$active.'">';
                    if(count($path) > 0)
                    $html .= '<a  data-toggle="dropdown" data-hover="dropdown" data-close-others="true" href="'.$href.'">'.$m->getRouteName().'</a>';
                    else    
                    $html .= '<a href="'.$href.'">'.$m->getRouteName().'</a>';
                }
                else{
                    if(count($path) > 0){
                        $html .= '<li class ="dropdown-submenu">';    
                    }else{
                        $html .= '<li>';
                    }    
                    $html .= '<a href="">'.$m->getRouteName().'</a>';
                }
                $html .= $this->getMenuHtml($m->getId(),$menuList,1);
                $html .= '</li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }
    
    private function getPath($id = 0, $menuList){
        $path = array();
        foreach($menuList as $m){
            if($m->getParentId() == $id){
                $path[]= $m->getId() ;
                $path[]= $this->getPath($m->getId(),$menuList);
            }
        }
        return $path;
    }
}