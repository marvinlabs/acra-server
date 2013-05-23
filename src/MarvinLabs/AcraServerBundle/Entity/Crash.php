<?php

namespace MarvinLabs\AcraServerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Crashes
 *
 * @ORM\Table(name="acra_crash")
 * @ORM\Entity(repositoryClass="MarvinLabs\AcraServerBundle\Entity\CrashRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Crash
{
	public static $STATUS_NEW 		= 0;
	public static $STATUS_FIXED 	= 1;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="issue_id", type="string", length=32, nullable=false)
     */
    private $issueId;

    /**
     * @var string
     *
     * @ORM\Column(name="report_id", type="text", nullable=false)
     */
    private $reportId;

    /**
     * @var string
     *
     * @ORM\Column(name="app_version_code", type="text", nullable=false)
     */
    private $appVersionCode;

    /**
     * @var string
     *
     * @ORM\Column(name="app_version_name", type="text", nullable=false)
     */
    private $appVersionName;

    /**
     * @var string
     *
     * @ORM\Column(name="package_name", type="text", nullable=false)
     */
    private $packageName;

    /**
     * @var string
     *
     * @ORM\Column(name="file_path", type="text", nullable=true)
     */
    private $filePath;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_model", type="text", nullable=true)
     */
    private $phoneModel;

    /**
     * @var string
     *
     * @ORM\Column(name="android_version", type="text", nullable=true)
     */
    private $androidVersion;

    /**
     * @var string
     *
     * @ORM\Column(name="build", type="text", nullable=true)
     */
    private $build;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="text", nullable=true)
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="product", type="text", nullable=true)
     */
    private $product;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_mem_size", type="integer", nullable=true)
     */
    private $totalMemSize;

    /**
     * @var integer
     *
     * @ORM\Column(name="available_mem_size", type="integer", nullable=true)
     */
    private $availableMemSize;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_data", type="text", nullable=true)
     */
    private $customData;

    /**
     * @var string
     *
     * @ORM\Column(name="stack_trace", type="text", nullable=true)
     */
    private $stackTrace;

    /**
     * @var string
     *
     * @ORM\Column(name="initial_configuration", type="text", nullable=true)
     */
    private $initialConfiguration;

    /**
     * @var string
     *
     * @ORM\Column(name="crash_configuration", type="text", nullable=true)
     */
    private $crashConfiguration;

    /**
     * @var string
     *
     * @ORM\Column(name="display", type="text", nullable=true)
     */
    private $display;

    /**
     * @var string
     *
     * @ORM\Column(name="user_comment", type="text", nullable=true)
     */
    private $userComment;

    /**
     * @var string
     *
     * @ORM\Column(name="user_app_start_date", type="text", nullable=true)
     */
    private $userAppStartDate;

    /**
     * @var string
     *
     * @ORM\Column(name="user_crash_date", type="text", nullable=true)
     */
    private $userCrashDate;

    /**
     * @var string
     *
     * @ORM\Column(name="dumpsys_meminfo", type="text", nullable=true)
     */
    private $dumpsysMeminfo;

    /**
     * @var string
     *
     * @ORM\Column(name="dropbox", type="text", nullable=true)
     */
    private $dropbox;

    /**
     * @var string
     *
     * @ORM\Column(name="logcat", type="text", nullable=true)
     */
    private $logcat;

    /**
     * @var string
     *
     * @ORM\Column(name="eventslog", type="text", nullable=true)
     */
    private $eventslog;

    /**
     * @var string
     *
     * @ORM\Column(name="radiolog", type="text", nullable=true)
     */
    private $radiolog;

    /**
     * @var string
     *
     * @ORM\Column(name="is_silent", type="text", nullable=true)
     */
    private $isSilent;

    /**
     * @var string
     *
     * @ORM\Column(name="device_id", type="text", nullable=true)
     */
    private $deviceId;

    /**
     * @var string
     *
     * @ORM\Column(name="installation_id", type="text", nullable=true)
     */
    private $installationId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="text", nullable=true)
     */
    private $userEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="device_features", type="text", nullable=true)
     */
    private $deviceFeatures;

    /**
     * @var string
     *
     * @ORM\Column(name="environment", type="text", nullable=true)
     */
    private $environment;

    /**
     * @var string
     *
     * @ORM\Column(name="settings_global", type="text", nullable=true)
     */
    private $settingsGlobal;

    /**
     * @var string
     *
     * @ORM\Column(name="settings_system", type="text", nullable=true)
     */
    private $settingsSystem;

    /**
     * @var string
     *
     * @ORM\Column(name="settings_secure", type="text", nullable=true)
     */
    private $settingsSecure;

    /**
     * @var string
     *
     * @ORM\Column(name="shared_preferences", type="text", nullable=true)
     */
    private $sharedPreferences;

    /**
     * @var string
     *
     * @ORM\Column(name="media_codec_list", type="text", nullable=true)
     */
    private $mediaCodecList;

    /**
     * @var string
     *
     * @ORM\Column(name="thread_details", type="text", nullable=true)
     */
    private $threadDetails;

    /**
     * @var string
     *
     * @ORM\Column(name="application_log", type="text", nullable=true)
     */
    private $applicationLog;

    /**
     * Constructor
     */
    public function __construct()
    {
    	$this->setCreatedAt(new \DateTime(null, new \DateTimeZone('UTC')));
    	$this->setStatus(self::$STATUS_NEW);
    }

    /**
     * Set threadDetails
     *
     * @param string $threadDetails
     * @return Crash
     */
    public function setThreadDetails($threadDetails)
    {
        $this->threadDetails = $threadDetails;
    
        return $this;
    }

    /**
     * Get threadDetails
     *
     * @return string
     */
    public function getThreadDetails()
    {
        return $this->threadDetails;
    }

    /**
     * Set applicationLog
     *
     * @param string applicationLog
     * @return Crash
     */
    public function setApplicationLog($applicationLog)
    {
        $this->applicationLog = $applicationLog;
    
        return $this;
    }

    /**
     * Get applicationLog
     *
     * @return string
     */
    public function getApplicationLog()
    {
        return $this->applicationLog;
    }

    /**
     * Set mediaCodecList
     *
     * @param string $createdAt
     * @return Crash
     */
    public function setMediaCodecList($mediaCodecList)
    {
        $this->mediaCodecList = $mediaCodecList;
    
        return $this;
    }

    /**
     * Get mediaCodecList
     *
     * @return string
     */
    public function getMediaCodecList()
    {
        return $this->mediaCodecList;
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

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Crash
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Crash
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatusAsString()
    {
        switch ($this->status) {
        	case self::$STATUS_NEW: 	return 'new';
        	case self::$STATUS_FIXED: 	return 'new';
        	default: 					return 'unknwown';
        }
    }

    /**
     * Set issueId
     *
     * @param string $issueId
     * @return Crash
     */
    public function setIssueId($issueId)
    {
        $this->issueId = $issueId;
    
        return $this;
    }

    /**
     * Get issueId
     *
     * @return string 
     */
    public function getIssueId()
    {
        return $this->issueId;
    }

    /**
     * Set reportId
     *
     * @param string $reportId
     * @return Crash
     */
    public function setReportId($reportId)
    {
        $this->reportId = $reportId;
    
        return $this;
    }

    /**
     * Get reportId
     *
     * @return string 
     */
    public function getReportId()
    {
        return $this->reportId;
    }

    /**
     * Set appVersionCode
     *
     * @param string $appVersionCode
     * @return Crash
     */
    public function setAppVersionCode($appVersionCode)
    {
        $this->appVersionCode = $appVersionCode;
    
        return $this;
    }

    /**
     * Get appVersionCode
     *
     * @return string 
     */
    public function getAppVersionCode()
    {
        return $this->appVersionCode;
    }

    /**
     * Set appVersionName
     *
     * @param string $appVersionName
     * @return Crash
     */
    public function setAppVersionName($appVersionName)
    {
        $this->appVersionName = $appVersionName;
    
        return $this;
    }

    /**
     * Get appVersionName
     *
     * @return string 
     */
    public function getAppVersionName()
    {
        return $this->appVersionName;
    }

    /**
     * Set packageName
     *
     * @param string $packageName
     * @return Crash
     */
    public function setPackageName($packageName)
    {
        $this->packageName = $packageName;
    
        return $this;
    }

    /**
     * Get packageName
     *
     * @return string 
     */
    public function getPackageName()
    {
        return $this->packageName;
    }

    /**
     * Set filePath
     *
     * @param string $filePath
     * @return Crash
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    
        return $this;
    }

    /**
     * Get filePath
     *
     * @return string 
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * Set phoneModel
     *
     * @param string $phoneModel
     * @return Crash
     */
    public function setPhoneModel($phoneModel)
    {
        $this->phoneModel = $phoneModel;
    
        return $this;
    }

    /**
     * Get phoneModel
     *
     * @return string 
     */
    public function getPhoneModel()
    {
        return $this->phoneModel;
    }

    /**
     * Set androidVersion
     *
     * @param string $androidVersion
     * @return Crash
     */
    public function setAndroidVersion($androidVersion)
    {
        $this->androidVersion = $androidVersion;
    
        return $this;
    }

    /**
     * Get androidVersion
     *
     * @return string 
     */
    public function getAndroidVersion()
    {
        return $this->androidVersion;
    }

    /**
     * Set build
     *
     * @param string $build
     * @return Crash
     */
    public function setBuild($build)
    {
        $this->build = $build;
    
        return $this;
    }

    /**
     * Get build
     *
     * @return string 
     */
    public function getBuild()
    {
        return $this->build;
    }

    /**
     * Set brand
     *
     * @param string $brand
     * @return Crash
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    
        return $this;
    }

    /**
     * Get brand
     *
     * @return string 
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set product
     *
     * @param string $product
     * @return Crash
     */
    public function setProduct($product)
    {
        $this->product = $product;
    
        return $this;
    }

    /**
     * Get product
     *
     * @return string 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set totalMemSize
     *
     * @param integer $totalMemSize
     * @return Crash
     */
    public function setTotalMemSize($totalMemSize)
    {
        $this->totalMemSize = $totalMemSize;
    
        return $this;
    }

    /**
     * Get totalMemSize
     *
     * @return integer 
     */
    public function getTotalMemSize()
    {
        return $this->totalMemSize;
    }

    /**
     * Set availableMemSize
     *
     * @param integer $availableMemSize
     * @return Crash
     */
    public function setAvailableMemSize($availableMemSize)
    {
        $this->availableMemSize = $availableMemSize;
    
        return $this;
    }

    /**
     * Get availableMemSize
     *
     * @return integer 
     */
    public function getAvailableMemSize()
    {
        return $this->availableMemSize;
    }

    /**
     * Set customData
     *
     * @param string $customData
     * @return Crash
     */
    public function setCustomData($customData)
    {
        $this->customData = $customData;
    
        return $this;
    }

    /**
     * Get customData
     *
     * @return string 
     */
    public function getCustomData()
    {
        return $this->customData;
    }

    /**
     * Set stackTrace
     *
     * @param string $stackTrace
     * @return Crash
     */
    public function setStackTrace($stackTrace)
    {
        $this->stackTrace = $stackTrace;
    
        return $this;
    }

    /**
     * Get stackTrace
     *
     * @return string 
     */
    public function getStackTrace()
    {
        return $this->stackTrace;
    }

    /**
     * Get short stackTrace
     *
     * @return string 
     */
    public function getShortStackTrace()
    {
    	$lines = explode("\n", $this->getStackTrace());
    	$res = "";
    	
    	if (!empty($lines)) {
	    	foreach ($lines as $id => $line) {
	    		if (strpos($line, ": ") !== FALSE || strpos($line, $this->getPackageName()) !== FALSE
	    				|| strpos($line, "Error") !== FALSE || strpos($line, "Exception") !== FALSE) {
	    			$res .= $line . "\n";
	    		}
	    	}
	    	
	    	if (empty($res)) {
	    		$res = $lines[0];
	    	}
    	}
    	
    	
    	return $res;
    }
    
    function array_find($needle, $haystack)
    {
    	foreach ($haystack as $item)
    	{
    		if (strpos($item, $needle) !== FALSE)
    		{
    			return $item;
    			break;
    		}
    	}
    	return FALSE;
    }
    
    /**
     * Set initialConfiguration
     *
     * @param string $initialConfiguration
     * @return Crash
     */
    public function setInitialConfiguration($initialConfiguration)
    {
        $this->initialConfiguration = $initialConfiguration;
    
        return $this;
    }

    /**
     * Get initialConfiguration
     *
     * @return string 
     */
    public function getInitialConfiguration()
    {
        return $this->initialConfiguration;
    }

    /**
     * Set crashConfiguration
     *
     * @param string $crashConfiguration
     * @return Crash
     */
    public function setCrashConfiguration($crashConfiguration)
    {
        $this->crashConfiguration = $crashConfiguration;
    
        return $this;
    }

    /**
     * Get crashConfiguration
     *
     * @return string 
     */
    public function getCrashConfiguration()
    {
        return $this->crashConfiguration;
    }

    /**
     * Set display
     *
     * @param string $display
     * @return Crash
     */
    public function setDisplay($display)
    {
        $this->display = $display;
    
        return $this;
    }

    /**
     * Get display
     *
     * @return string 
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * Set userComment
     *
     * @param string $userComment
     * @return Crash
     */
    public function setUserComment($userComment)
    {
        $this->userComment = $userComment;
    
        return $this;
    }

    /**
     * Get userComment
     *
     * @return string 
     */
    public function getUserComment()
    {
        return $this->userComment;
    }

    /**
     * Set userAppStartDate
     *
     * @param string $userAppStartDate
     * @return Crash
     */
    public function setUserAppStartDate($userAppStartDate)
    {
        $this->userAppStartDate = $userAppStartDate;
    
        return $this;
    }

    /**
     * Get userAppStartDate
     *
     * @return string 
     */
    public function getUserAppStartDate()
    {
        return $this->userAppStartDate;
    }

    /**
     * Set userCrashDate
     *
     * @param string $userCrashDate
     * @return Crash
     */
    public function setUserCrashDate($userCrashDate)
    {
        $this->userCrashDate = $userCrashDate;
    
        return $this;
    }

    /**
     * Get userCrashDate
     *
     * @return string 
     */
    public function getUserCrashDate()
    {
        return $this->userCrashDate;
    }

    /**
     * Set dumpsysMeminfo
     *
     * @param string $dumpsysMeminfo
     * @return Crash
     */
    public function setDumpsysMeminfo($dumpsysMeminfo)
    {
        $this->dumpsysMeminfo = $dumpsysMeminfo;
    
        return $this;
    }

    /**
     * Get dumpsysMeminfo
     *
     * @return string 
     */
    public function getDumpsysMeminfo()
    {
        return $this->dumpsysMeminfo;
    }

    /**
     * Set dropbox
     *
     * @param string $dropbox
     * @return Crash
     */
    public function setDropbox($dropbox)
    {
        $this->dropbox = $dropbox;
    
        return $this;
    }

    /**
     * Get dropbox
     *
     * @return string 
     */
    public function getDropbox()
    {
        return $this->dropbox;
    }

    /**
     * Set logcat
     *
     * @param string $logcat
     * @return Crash
     */
    public function setLogcat($logcat)
    {
        $this->logcat = $logcat;
    
        return $this;
    }

    /**
     * Get logcat
     *
     * @return string 
     */
    public function getLogcat()
    {
        return $this->logcat;
    }

    /**
     * Set eventslog
     *
     * @param string $eventslog
     * @return Crash
     */
    public function setEventslog($eventslog)
    {
        $this->eventslog = $eventslog;
    
        return $this;
    }

    /**
     * Get eventslog
     *
     * @return string 
     */
    public function getEventslog()
    {
        return $this->eventslog;
    }

    /**
     * Set radiolog
     *
     * @param string $radiolog
     * @return Crash
     */
    public function setRadiolog($radiolog)
    {
        $this->radiolog = $radiolog;
    
        return $this;
    }

    /**
     * Get radiolog
     *
     * @return string 
     */
    public function getRadiolog()
    {
        return $this->radiolog;
    }

    /**
     * Set isSilent
     *
     * @param string $isSilent
     * @return Crash
     */
    public function setIsSilent($isSilent)
    {
        $this->isSilent = $isSilent;
    
        return $this;
    }

    /**
     * Get isSilent
     *
     * @return string 
     */
    public function getIsSilent()
    {
        return $this->isSilent;
    }

    /**
     * Set deviceId
     *
     * @param string $deviceId
     * @return Crash
     */
    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;
    
        return $this;
    }

    /**
     * Get deviceId
     *
     * @return string 
     */
    public function getDeviceId()
    {
        return $this->deviceId;
    }

    /**
     * Set installationId
     *
     * @param string $installationId
     * @return Crash
     */
    public function setInstallationId($installationId)
    {
        $this->installationId = $installationId;
    
        return $this;
    }

    /**
     * Get installationId
     *
     * @return string 
     */
    public function getInstallationId()
    {
        return $this->installationId;
    }

    /**
     * Set userEmail
     *
     * @param string $userEmail
     * @return Crash
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    
        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string 
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set deviceFeatures
     *
     * @param string $deviceFeatures
     * @return Crash
     */
    public function setDeviceFeatures($deviceFeatures)
    {
        $this->deviceFeatures = $deviceFeatures;
    
        return $this;
    }

    /**
     * Get deviceFeatures
     *
     * @return string 
     */
    public function getDeviceFeatures()
    {
        return $this->deviceFeatures;
    }

    /**
     * Set environment
     *
     * @param string $environment
     * @return Crash
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;
    
        return $this;
    }

    /**
     * Get environment
     *
     * @return string 
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Set settingsGlobal
     *
     * @param string $settingsGlobal
     * @return Crash
     */
    public function setSettingsGlobal($settingsGlobal)
    {
        $this->settingsGlobal = $settingsGlobal;
    
        return $this;
    }

    /**
     * Get settingsGlobal
     *
     * @return string 
     */
    public function getSettingsGlobal()
    {
        return $this->settingsGlobal;
    }

    /**
     * Set settingsSystem
     *
     * @param string $settingsSystem
     * @return Crash
     */
    public function setSettingsSystem($settingsSystem)
    {
        $this->settingsSystem = $settingsSystem;
    
        return $this;
    }

    /**
     * Get settingsSystem
     *
     * @return string 
     */
    public function getSettingsSystem()
    {
        return $this->settingsSystem;
    }

    /**
     * Set settingsSecure
     *
     * @param string $settingsSecure
     * @return Crash
     */
    public function setSettingsSecure($settingsSecure)
    {
        $this->settingsSecure = $settingsSecure;
    
        return $this;
    }

    /**
     * Get settingsSecure
     *
     * @return string 
     */
    public function getSettingsSecure()
    {
        return $this->settingsSecure;
    }

    /**
     * Set sharedPreferences
     *
     * @param string $sharedPreferences
     * @return Crash
     */
    public function setSharedPreferences($sharedPreferences)
    {
        $this->sharedPreferences = $sharedPreferences;
    
        return $this;
    }

    /**
     * Get sharedPreferences
     *
     * @return string 
     */
    public function getSharedPreferences()
    {
        return $this->sharedPreferences;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function computeIssueId() 
    {    	
    	$issueId = md5($this->getShortStackTrace());

    	global $kernel;
    	if ('AppCache' == get_class($kernel)) $kernel = $kernel->getKernel();
    	$kernel->getContainer()->get('logger')->warn('Computed issue id: ' . $issueId);
    	
    	$this->setIssueId($issueId);
    }
}