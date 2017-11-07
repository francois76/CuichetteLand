<?php

namespace CuichetteLand\websiteBundle\Repository;

/**
 * testRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class userRepository extends \Doctrine\ORM\EntityRepository
{
		public function getIdFromlogin($login)
	{
		$query = $this -> _em -> createQuery('SELECT u.id FROM CuichetteLandwebsiteBundle:User u WHERE u.mail = :mail  ');
		$query->setParameter('mail', $login);
		return $query->getResult();
	}
	
	public function getLoginFromId($Id)
	{
		$query = $this -> _em -> createQuery('SELECT u.mail FROM CuichetteLandwebsiteBundle:User u WHERE u.id = :id  ');
		$query->setParameter('id', $Id);
		return $query->getResult();
	}
	
	
}
