<?php

namespace Ihk\BaseBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TagRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TagRepository extends EntityRepository
{
	public function findByCategoryId($id)
	{
		return $this->getEntityManager()
			->createQuery(
				'SELECT p FROM IhkBaseBundle:Tag p where p.categoryId ='.$id
			)
			->getResult();
	}
}
