<?php

namespace AppBundle\Entity\Interfaces;


/**
 * @ORM\Entity
 * @ORM\Table()
 */
interface ArticleInterface extends OutputObjectInterface
{
    public function getId();

    public function getTitle();

    public function getContent();

    public function update(
        $title,
        $content
    );
}