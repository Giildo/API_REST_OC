<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\InputObjectInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ArticleDTO implements InputObjectInterface
{
    /**
     * @var string
     *
     * @Assert\Type(type="string")
     * @Assert\NotNull(message="Le titre doit être renseigné.")
     * @Assert\Length(
     *     max="100",
     *     maxMessage="Votre titre ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    public $title;

    /**
     * @var string
     *
     * @Assert\Type(type="string")
     * @Assert\NotNull(message="L'article doit contenir un texte.")
     * @Assert\Length(
     *     min="5",
     *     minMessage="Le contenu de votre article doit avoir au moin {{ limit }} caractères."
     * )
     */
    public $content;

    /**
     * ArticleDTO constructor.
     * @param string $title
     * @param string $content
     */
    public function __construct(
        $title,
        $content
    ) {
        $this->title = $title;
        $this->content = $content;
    }
}
