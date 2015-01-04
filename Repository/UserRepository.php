<?php
namespace Landmarx\Bundle\UserBundle\Repository;


class UserRepository extends \Landmarx\Bundle\CoreBundle\Doctrine\ODM\MongoDB\DocumentRepository
{
    public function findAllOrderedByLastname()
    {
        return $this->createQueryBuilder()
            ->sort('lastname', 'ASC')
            ->getQuery()
            ->execute();
    }
}
