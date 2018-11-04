<?php

namespace AppBundle\Helpers;

use AppBundle\Entity\ArticleDTO;
use AppBundle\Entity\Interfaces\OutputObjectInterface;
use AppBundle\Helpers\Interfaces\DeserializerHelperInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DeserializerHelper implements DeserializerHelperInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * DeserializerHelper constructor.
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * @param string $requestContent
     *
     * @return OutputObjectInterface|ArticleDTO|null
     */
    public function deserialize($requestContent)
    {
        $datas = $this->serializer->deserialize($requestContent, 'array', 'json');

        $dto = new ArticleDTO(
            $datas['title'],
            $datas['content']
        );

        if ($this->validator->validate($dto)) {
            return $dto;
        }

        return null;
    }
}
