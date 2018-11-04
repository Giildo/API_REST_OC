<?php

// src/AppBundle/Repository/ArticleRepository.php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT * FROM AppBundle:Article'
            )
            ->getResult();
    }
}
