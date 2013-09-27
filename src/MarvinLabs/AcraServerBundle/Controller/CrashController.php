<?php

namespace MarvinLabs\AcraServerBundle\Controller;

use Doctrine\ORM\Mapping\Entity;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use MarvinLabs\AcraServerBundle\Entity\Crash;
use MarvinLabs\AcraServerBundle\DataFixtures\LoadFixtureData;

class CrashController extends Controller
{
	// TODO Disable in PROD environment
// 	public function generateTestDataAction()
// 	{	
//   		$doctrine = $this->getDoctrine()->getManager();
		
//   		$fixtureDataLoader = new LoadFixtureData();
//   		$fixtures = $fixtureDataLoader->load($doctrine);

//   		return new Response( var_dump($fixtures) );
// 	}
	
	/**
	 * Add a crash to the DB and send a notification to the crash admin
	 * 
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
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
				$crash
			);
   		
		return new Response( '' );
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
    	$crash->setUserComment($requestData->get('USER_COMMENT', null));
    	$crash->setUserEmail($requestData->get('USER_EMAIL', null));
    	
    	$tmpDateTime = new \DateTime( $requestData->get('USER_APP_START_DATE', null) );
    	$crash->setUserAppStartDate($tmpDateTime);

    	$tmpDateTime = new \DateTime( $requestData->get('USER_CRASH_DATE', null) );
    	$crash->setUserCrashDate($tmpDateTime);
    	
    	return $crash;
    }
}
