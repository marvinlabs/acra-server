<?php

namespace MarvinLabs\AcraServerBundle\Controller;

use Doctrine\ORM\Mapping\Entity;

use Symfony\Component\HttpFoundation\Response;

use MarvinLabs\AcraServerBundle\Controller\DefaultViewController;
use MarvinLabs\AcraServerBundle\Entity\Crash;
use MarvinLabs\AcraServerBundle\DataFixtures\LoadFixtureData;

class IssueController extends DefaultViewController
{
	
	/**
	 * Render the main dashboard
	 */
	public function dashboardAction() {
		$doctrine = $this->getDoctrine()->getManager();
        $crashRepo = $doctrine->getRepository('MLabsAcraServerBundle:Crash');

		$crashes = $crashRepo->findLatestIssues();
		$applicationStatistics = $crashRepo->findApplicationStatistics();
        
		return $this->render('MLabsAcraServerBundle:Issue:dashboard.html.twig',  $this->getViewParameters(
        		array(
						'crashes'   				=> $crashes,
        				'applicationStatistics'		=> $applicationStatistics
					)));
	}
	
	/**
	 * Render the dashboard for a particular app
	 */
	public function appDashboardAction($packageName) {
		$doctrine = $this->getDoctrine()->getManager();
        $crashRepo = $doctrine->getRepository('MLabsAcraServerBundle:Crash');

		$crashes = $crashRepo->findLatestIssues($packageName);

		return $this->render('MLabsAcraServerBundle:Issue:app_dashboard.html.twig',  $this->getViewParameters(
        		array(
						'packageName'   	=> $packageName,
						'crashes'   		=> $crashes
					)));
	}
	
    /**
     * Show a crash details
     */
    public function detailsAction($id)
    {
        $doctrine = $this->getDoctrine()->getManager();
        $crash = $doctrine->getRepository('MLabsAcraServerBundle:Crash')->find($id);

        if (!$crash) {
            throw $this->createNotFoundException('Unable to find crash.');
        }

        return $this->render('MLabsAcraServerBundle:Issue:details.html.twig', $this->getViewParameters(
        		array(
	            		'crash'		=> $crash
	        		)));
    }
    
    // --------------------------------------------------------------------------------------
    // IAcraServerController implementation
    
    public function getApplications() 
    {
    	return $this->applications;	
    }

    public function setApplications($applications)
    {
    	$this->applications = $applications;
    }
    
    /** @var array */
    private $applications;
}
