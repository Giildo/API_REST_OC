<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\OutputObjectInterface;

class ArticleList implements OutputObjectInterface
{
    /**
     * @var array|Article[]
     */
    private $articles;

    /**
     * ArticleList constructor.
     * @param Article[]|array $articles
     */
    public function __construct($articles)
    {
        $this->articles = $articles;
    }

    /**
     * @return Article[]|array
     */
    public function getArticles()
    {
        return $this->articles;
    }
}
