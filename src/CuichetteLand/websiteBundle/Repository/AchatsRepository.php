<?php

namespace CuichetteLand\websiteBundle\Repository;

/**
 * AchatsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AchatsRepository extends \Doctrine\ORM\EntityRepository
{
	
	public function getAllProductChosen($user)
	{
		$query = $this -> _em -> createQuery('SELECT a FROM CuichetteLandwebsiteBundle:Achats a WHERE a.utilisateur = :utilisateur AND a.valide = :valide');
		$query->setParameter('utilisateur', $user->getID());
		$query->setParameter('valide', "0");
		return $query->getResult();
	}
	
	public function setChosenProductsAsValidate($user)
	{
		$query = $this -> _em -> createQuery('UPDATE CuichetteLandwebsiteBundle:Achats a SET a.valide = :valide WHERE a.valide = :invalide AND a.utilisateur = :utilisateur ');
		$query->setParameter('utilisateur', $user->getID());
		$query->setParameter('valide', "1");
		$query->setParameter('invalide', "0");
		return $query->getResult();
	}
	
	public function deleteAchat($id)
	{
		$query = $this -> _em -> createQuery('DELETE FROM CuichetteLandwebsiteBundle:Achats a WHERE a.id = :id ');
		$query->setParameter('id', $id);
		return $query->getResult();
	}
	
	public function getAchatFromId($id)
	{
		$query = $this -> _em -> createQuery('SELECT a FROM CuichetteLandwebsiteBundle:Achats a WHERE a.id = :id ');
		$query->setParameter('id', $id);
		return $query->getResult();
	}
}
