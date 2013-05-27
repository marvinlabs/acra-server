<?php

namespace MarvinLabs\AcraServerBundle\Controller;

use Doctrine\ORM\Mapping\Entity;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use MarvinLabs\AcraServerBundle\Controller\IAcraServerController;
use MarvinLabs\AcraServerBundle\Entity\Crash;
use MarvinLabs\AcraServerBundle\DataFixtures\LoadFixtureData;

class DefaultViewController extends Controller implements IAcraServerController
{

    /**
     * Get the common paramaters to pass to the views
     */
    public function getViewParameters($additionalParameters=array()) {
    	return array_merge( array(
    			'applications' => $this->getApplications()
    		), $additionalParameters);
    }
    
    public function getApplications() 
    {
    	return $this->applications;	
    }
    
    // --------------------------------------------------------------------------------------
    // IAcraServerController implementation

    public function setApplications($applications)
    {
    	$this->applications = $applications;
    }
    
    /** @var array */
    private $applications;
}
