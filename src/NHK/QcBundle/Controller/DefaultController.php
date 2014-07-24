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

class DefaultController extends Controller implements DomainObjectInterface 
{
    public function indexAction()
    {
        /** Get Encoder */
        $encoder = new MessageDigestPasswordEncoder('md5',false);
        $em = $this->getDoctrine()->getManager();
        $factory = $this->get('security.encoder_factory');
        /**  
        
        
        $user = new \NHK\SecurityBundle\Entity\User(); // $em->getRepository('NHKSecurityBundle:User')->find(1);
        $encoder = $factory->getEncoder($user);
        $password = $encoder->encodePassword('anhyeuem', $user->getSalt());
        $user->setPassword($password);
        $user->setUsername('viethungic');
        $user->setEmail('email@gmail.com');
        $em->persist($user);
        $em->flush();
        */
        /*
        $classMetadata = new ClassMetadata("NHK\SecurityBundle\Entity\User");
        $userProvider = new \NHK\SecurityBundle\Entity\UserRepository($em,$classMetadata);
        $newUser = $userProvider->createUser();
        $encoder = $factory->getEncoder($newUser);
        $password = $encoder->encodePassword('123', $newUser->getSalt());
        $newUser->setPassword($password);
        $newUser->setUsername('admin');
        $newUser->setEmail('admin@gmail.com');
        $em->persist($newUser);
        $em->flush();
        */
        //var_dump($userProvider);
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Unable to access this page!');
        }
        $securityContext = $this->get('security.context');
        /** @var Symfony\Component\Security\Core\User\UserInterface */
        $user = $this->get('security.context')->getToken()->getUser();
        
        //echo $this->get('security.context')->getToken()->getUser()->getUsername();
        $name = "QC Project";
        
        /** ------------------------------------- Access Control Lists ------------------------------------- */
        /** Permissions */
        $maskBuilder = new MaskBuilder();
        $maskBuilder->add(MaskBuilder::MASK_VIEW);
        $maskBuilder->add(MaskBuilder::MASK_EDIT);
        $mask = $maskBuilder->get();
        
        /** Phan quyen theo user */
        $securityId = UserSecurityIdentity::fromAccount($user);
        /** Phan quyen theo ROLE */
        $securityIdentity = new RoleSecurityIdentity("ROLE_ADMIN");
        
        /** ACL provider */ 
        $aclProvider = $this->get('security.acl.provider');
        /** Class Resource Identiy */
        $objectIdentity = new ObjectIdentity('class',__CLASS__);
        
        try{
            /** Find ACL */
            $acl = $aclProvider->findAcl($objectIdentity);   
            foreach($acl->getObjectAces() as $index => $ace) {
                $aceSecurityId = $ace->getSecurityIdentity();
                /** user permission */
                if($aceSecurityId ->equals($securityId)) {
                    //$acl->updateObjectAce($index,$mask);
                    continue;
                }elseif($aceSecurityId ->equals($securityIdentity)) {/** role permission */
                    $acl->updateObjectAce($index,$mask);
                    continue;
                }
                //$acl->insertObjectAce($securityId,$mask);
                $acl->insertObjectAce($securityIdentity,$mask);
            }
        }catch (AclNotFoundException $e){/** If not, create a new */
            /** creating the ACL */
            $acl = $aclProvider->createAcl($objectIdentity);
            //$acl->insertObjectAce($securityId, $mask);
            $acl->insertObjectAce($securityIdentity, $mask);
        }
        $aclProvider->updateAcl($acl);
        
        var_dump($securityContext->isGranted('VIEW',__CLASS__));
        return $this->render('NHKQcBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function getObjectIdentifier(){
        return __CLASS__;
    }
}
