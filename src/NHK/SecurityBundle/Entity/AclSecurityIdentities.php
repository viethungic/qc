<?php

namespace NHK\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclSecurityIdentities
 */
class AclSecurityIdentities
{
    /**
     * @var string
     */
    private $identifier;

    /**
     * @var boolean
     */
    private $username;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set identifier
     *
     * @param string $identifier
     * @return AclSecurityIdentities
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get identifier
     *
     * @return string 
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set username
     *
     * @param boolean $username
     * @return AclSecurityIdentities
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return boolean 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
