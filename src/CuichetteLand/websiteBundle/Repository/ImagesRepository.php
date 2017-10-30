<?php

namespace CuichetteLand\websiteBundle\Repository;

/**
 * ImagesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ImagesRepository extends \Doctrine\ORM\EntityRepository
{
	public function getmainpicture($id)
	{
		$query = $this -> _em -> createQuery('SELECT i.nomImage FROM CuichetteLandwebsiteBundle:Images i WHERE i.idProduit = :idProduit AND i.imagePrincipale = :main');
		$query->setParameter('idProduit', $id);
		$query->setParameter('main', "1");
		return $query->getResult();
	}
}
