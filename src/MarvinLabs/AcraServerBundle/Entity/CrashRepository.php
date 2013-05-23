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
}
