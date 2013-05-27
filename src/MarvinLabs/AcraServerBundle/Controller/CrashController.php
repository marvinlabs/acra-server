<?php

namespace MarvinLabs\AcraServerBundle\Controller;

use Doctrine\ORM\Mapping\Entity;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use MarvinLabs\AcraServerBundle\Entity\Crash;
use MarvinLabs\AcraServerBundle\DataFixtures\LoadFixtureData;

class CrashController extends Controller
{
	public function generateTestDataAction()
	{	
  		$doctrine = $this->getDoctrine()->getManager();
		
  		$fixtureDataLoader = new LoadFixtureData();
  		$fixtures = $fixtureDataLoader->load($doctrine);

  		return new Response( var_dump($fixtures) );
	}
	
	public function addAction()
	{	
    	$crash = $this->newCrashFromRequest($this->getRequest());

       	// Persist crash
  		$doctrine = $this->getDoctrine()->getManager();
		$doctrine->persist($crash);
   		$doctrine->flush();
   		
   		// Send notification email
		$this->sendNewCrashNotification(
				$this->get('mailer'),
				$this->get('twig'),
				$this->container->getParameter('notifications_from'),
				$this->container->getParameter('notifications_to'),
				$crashes[0]
			);
   		
		return new Response( '' );
	}

	public function listAction()
	{		 
		$request = $this->getRequest();
		
		$crashesPerPage = $this->container->getParameter('crashes_per_page');
		$currentPage = $request->query->get('page', 1);
		
		$doctrine = $this->getDoctrine()->getManager();
		
		$rep = $doctrine->getRepository('MLabsAcraServerBundle:Crash');
		
		// Count potential results
		$crashNum = $rep->createBaseListQueryBuilder()
				->select('count(c.id)')
				->getQuery()
				->getSingleScalarResult();
		
		// Get real results
		$crashes = $rep->createBaseListQueryBuilder()
				->select(null)
				->setFirstResult(($currentPage-1)*$crashesPerPage)
				->setMaxResults($crashesPerPage)
				->getQuery()
				->getResult();
		
		return $this->render('MLabsAcraServerBundle:Crash:list.html.twig', array(
				'crashes'   	=> $crashes,
				'crashNum'		=> $crashNum,
				'page'			=> $currentPage,
				'totalPages'	=> $crashNum / $crashesPerPage
			));
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

        return $this->render('MLabsAcraServerBundle:Crash:details.html.twig', array(
	            'crash'      => $crash,
	        ));
    }
    
    /**
     * Send an email notification about a new crash
     */
    private function sendNewCrashNotification($mailer, $twig, $from, $to, $crash)
    {
    	$message = \Swift_Message::newInstance()
	    	->setFrom($from)
	    	->setTo($to)
	    	->setSubject(sprintf(
	            	'[Acra Server] New crash for your application %s',
	    			$crash->getPackageName())
	    		)
	        ->setBody(
	            $twig
	    			->loadTemplate('MLabsAcraServerBundle:Notifications:crash_notification_body.html.twig')
	                ->render(array('crash' => $crash))
	            );
	    		
    	$mailer->send($message);
    }
    
    /**
     * Build a crash from the parameters passed to the request
     * 
     * @return \MarvinLabs\AcraServerBundle\Entity\Crash
     */
    private function newCrashFromRequest($request)
    {
    	$requestData = $request->request;
    	
    	$crash = new Crash();
    	$crash->setAndroidVersion($requestData->get('ANDROID_VERSION', null));
    	$crash->setAppVersionCode($requestData->get('APP_VERSION_CODE', null));
    	$crash->setAppVersionName($requestData->get('APP_VERSION_NAME', null));
    	$crash->setApplicationLog($requestData->get('APPLICATION_LOG', null));
    	$crash->setAvailableMemSize($requestData->get('AVAILABLE_MEM_SIZE', null));
    	$crash->setBrand($requestData->get('BRAND', null));
    	$crash->setBuild($requestData->get('BUILD', null));
    	$crash->setCrashConfiguration($requestData->get('CRASH_CONFIGURATION', null));
    	$crash->setCustomData($requestData->get('CUSTOM_DATA', null));
    	$crash->setDeviceFeatures($requestData->get('DEVICE_FEATURES', null));
    	$crash->setDeviceId($requestData->get('DEVICE_ID', null));
    	$crash->setDisplay($requestData->get('DISPLAY', null));
    	$crash->setDropbox($requestData->get('DROPBOX', null));
    	$crash->setDumpsysMeminfo($requestData->get('DUMPSYS_MEMINFO', null));
    	$crash->setEnvironment($requestData->get('ENVIRONMENT', null));
    	$crash->setEventsLog($requestData->get('EVENTSLOG', null));
    	$crash->setFilePath($requestData->get('FILE_PATH', null));
    	$crash->setInitialConfiguration($requestData->get('INITIAL_CONFIGURATION', null));
    	$crash->setInstallationId($requestData->get('INSTALLATION_ID', null));
    	$crash->setIsSilent($requestData->get('IS_SILENT', null));
    	$crash->setLogcat($requestData->get('LOGCAT', null));
    	$crash->setMediaCodecList($requestData->get('MEDIA_CODEC_LIST', null));
    	$crash->setPackageName($requestData->get('PACKAGE_NAME', null));
    	$crash->setPhoneModel($requestData->get('PHONE_MODEL', null));
    	$crash->setProduct($requestData->get('PRODUCT', null));
    	$crash->setRadioLog($requestData->get('RADIOLOG', null));
    	$crash->setReportId($requestData->get('REPORT_ID', null));
    	$crash->setSettingsGlobal($requestData->get('SETTINGS_GLOBAL', null));
    	$crash->setSettingsSecure($requestData->get('SETTINGS_SECURE', null));
    	$crash->setSettingsSystem($requestData->get('SETTINGS_SYSTEM', null));
    	$crash->setSharedPreferences($requestData->get('SHARED_PREFERENCES', null));
    	$crash->setStackTrace($requestData->get('STACK_TRACE', null));
    	$crash->setThreadDetails($requestData->get('THREAD_DETAILS', null));
    	$crash->setTotalMemSize($requestData->get('TOTAL_MEM_SIZE', null));
    	$crash->setUserAppStartDate($requestData->get('USER_APP_START_DATE', null));
    	$crash->setUserComment($requestData->get('USER_COMMENT', null));
    	$crash->setUserCrashDate($requestData->get('USER_CRASH_DATE', null));
    	$crash->setUserEmail($requestData->get('USER_EMAIL', null));
    	
    	return $crash;
    }
}
