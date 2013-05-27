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
		$qb = $this->createQueryBuilder('c')->orderBy('c.createdAt', 'DESC');
		return $qb;
	}
	
	/**
	 * Get the number of crashes per application
	 */
	public function findApplicationStatistics() {    	
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
    	$where = "c.status=:status";
    	$params = array( 'status' => Crash::$STATUS_NEW );
    	
    	if ($packageName!=null) {
    		$where .= ' AND c.packageName=:packageName';
    		$params['packageName'] = $packageName;
    	}
    	
    	$query = "SELECT c.issueId, "
        				. "GROUP_CONCAT(DISTINCT c.appVersionName) as appVersions, "
        				. "GROUP_CONCAT(DISTINCT c.androidVersion) as androidVersions, "
        				. "GROUP_CONCAT(DISTINCT c.packageName) as packageName, "
        				. "GROUP_CONCAT(DISTINCT c.status) as statuses, "
        				. "COUNT(c.id) as crashNum, "
        				. "MAX(c.createdAt) as latestCrashDate "
        			. "FROM MarvinLabs\AcraServerBundle\Entity\Crash c "
        			. "WHERE " . $where . " "
        			. "GROUP BY c.issueId "
        			. "ORDER BY c.createdAt DESC ";
    	    	
        return $this->getEntityManager()
        		->createQuery($query)
        		->setParameters($params)
        		->setMaxResults($limit)
            	->getResult();
    }
}
