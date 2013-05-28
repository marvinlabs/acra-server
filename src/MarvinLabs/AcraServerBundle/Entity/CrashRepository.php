<?php

namespace MarvinLabs\AcraServerBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CrashRepository
 */
class CrashRepository extends EntityRepository
{
	public function createBaseListQueryBuilder()
	{
		$qb = $this->createQueryBuilder('c')->orderBy('c.userCrashDate', 'DESC');
		return $qb;
	}
	
	/**
	 * Get some statistics for a particular application
	 */
	public function findApplicationVersionsStatistics($packageName, $limit=15) {    
    	$where = "c.status=:status ";
    	$params = array( 'status' => Crash::$STATUS_NEW );
    	
    	if ($packageName!=null) {
    		$where .= 'AND c.packageName=:packageName ';
    		$params['packageName'] = $packageName;
    	}
    	
    	$query = "SELECT c.packageName as packageName, "
    					. "c.appVersionCode as appVersionCode, "
    					. "c.appVersionName as appVersionName, "
    					. "COUNT(DISTINCT c.issueId) as issueNum, "
    					. "COUNT(DISTINCT c.id) as crashNum "
        			. "FROM MarvinLabs\AcraServerBundle\Entity\Crash c "
        			. "WHERE " . $where
        			. "GROUP BY c.packageName, c.appVersionCode, c.appVersionName "
        			. "ORDER BY c.appVersionName DESC, c.appVersionCode DESC ";
    	    	
        return $this->getEntityManager()
        		->createQuery($query)
        		->setParameters($params)
        		->setMaxResults($limit)
            	->getResult();
	}
	
	/**
	 * Get some statistics for a particular application
	 */
	public function findApplicationAndroidVersionsStatistics($packageName) {    	
    	$where = "c.status=:status ";
    	$params = array( 'status' => Crash::$STATUS_NEW );
    	
    	if ($packageName!=null) {
    		$where .= 'AND c.packageName=:packageName ';
    		$params['packageName'] = $packageName;
    	}
    	
    	$query = "SELECT c.packageName as packageName, "
    					. "c.androidVersion as androidVersion, "
    					. "COUNT(DISTINCT c.issueId) as issueNum, "
    					. "COUNT(DISTINCT c.id) as crashNum "
        			. "FROM MarvinLabs\AcraServerBundle\Entity\Crash c "
        			. "WHERE " . $where
        			. "GROUP BY c.packageName, c.androidVersion "
        			. "ORDER BY c.androidVersion DESC ";
    	    	
        return $this->getEntityManager()
        		->createQuery($query)
        		->setParameters($params)
            	->getResult();
	}
	
	/**
	 * Get some statistics for a particular application
	 */
	public function findApplicationTimeStatistics($packageName) {    	
    	$where = "1=1 ";
    	$params = array();
    	
    	if ($packageName!=null) {
    		$where .= 'AND c.packageName=:packageName ';
    		$params['packageName'] = $packageName;
    	}
    	
    	$query = "SELECT c.packageName as packageName, "
    					. "MIN(c.userCrashDate) as crashDate, "
    					. "YEAR(c.userCrashDate) as crashDateYear, "
    					. "MONTH(c.userCrashDate) as crashDateMonth, "
    					. "DAY(c.userCrashDate) as crashDateDay, "
    					. "COUNT(DISTINCT c.id) as crashNum "
        			. "FROM MarvinLabs\AcraServerBundle\Entity\Crash c "
        			. "WHERE " . $where
        			. "GROUP BY crashDateYear, crashDateMonth, crashDateDay "
        			. "ORDER BY crashDate ASC ";
    	
        return $this->getEntityManager()
        		->createQuery($query)
        		->setParameters($params)
            	->getResult();
	}
	
	/**
	 * Get some statistics for a particular application
	 */
	public function findApplicationsTimeStatistics() {    	
    	$query = "SELECT "
    					. "MIN(c.userCrashDate) as crashDate, "
    					. "YEAR(c.userCrashDate) as crashDateYear, "
    					. "MONTH(c.userCrashDate) as crashDateMonth, "
    					. "DAY(c.userCrashDate) as crashDateDay, "
    					. "COUNT(DISTINCT c.id) as crashNum "
        			. "FROM MarvinLabs\AcraServerBundle\Entity\Crash c "
        			. "GROUP BY crashDateYear, crashDateMonth, crashDateDay "
        			. "ORDER BY crashDate ASC ";
    	
        return $this->getEntityManager()
        		->createQuery($query)
            	->getResult();
	}
	
	/**
	 * Get some statistics for the registered applications
	 */
	public function findApplicationsStatistics() {    	
    	$query = "SELECT c.packageName as packageName, "
    					. "COUNT(DISTINCT c.issueId) as issueNum, "
    					. "COUNT(DISTINCT c.id) as crashNum "
        			. "FROM MarvinLabs\AcraServerBundle\Entity\Crash c "
        			. "GROUP BY c.packageName "
        			. "ORDER BY c.packageName ASC ";
    	    	
        return $this->getEntityManager()
        		->createQuery($query)
            	->getResult();
	}
	
	/**
	 * Get the number of issues per application
	 */
	public function findAllApplications() {    	
    	$query = "SELECT DISTINCT c.packageName as packageName "
        			. "FROM MarvinLabs\AcraServerBundle\Entity\Crash c "
        			. "ORDER BY c.packageName ASC ";
    	    	
        return $this->getEntityManager()
        		->createQuery($query)
            	->getResult();
	}
	
	/**
	 * Get the latest issues (crashes that are supposed to be similar)
	 *  
	 * @param string $packageName A package name to get only for this particular app or null
	 * @param number $limit The max number of issues to return
	 * 
	 * @return array
	 */
    public function findLatestIssues($packageName=null, $limit=10)
    {
    	$where = "c.status=:status ";
    	$params = array( 'status' => Crash::$STATUS_NEW );
    	
    	if ($packageName!=null) {
    		$where .= 'AND c.packageName=:packageName ';
    		$params['packageName'] = $packageName;
    	}
    	
    	$query = "SELECT c.issueId, "
        				. "GROUP_CONCAT(DISTINCT c.appVersionName) as appVersions, "
        				. "GROUP_CONCAT(DISTINCT c.androidVersion) as androidVersions, "
        				. "GROUP_CONCAT(DISTINCT c.packageName) as packageName, "
        				. "GROUP_CONCAT(DISTINCT c.status) as statuses, "
        				. "COUNT(c.id) as crashNum, "
        				. "MAX(c.userCrashDate) as latestCrashDate "
        			. "FROM MarvinLabs\AcraServerBundle\Entity\Crash c "
        			. "WHERE " . $where 
        			. "GROUP BY c.issueId "
        			. "ORDER BY c.userCrashDate DESC ";
    	    	
        return $this->getEntityManager()
        		->createQuery($query)
        		->setParameters($params)
        		->setMaxResults($limit)
            	->getResult();
    }
}
