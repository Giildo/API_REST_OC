<?php

namespace AppBundle\Helpers;

use AppBundle\Helpers\Interfaces\JSONResponderInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;

class JSONResponder implements JSONResponderInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * JSONResponder constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function response(
        $object,
        $statusCode = Response::HTTP_OK,
        $headers = []
    ) {
        return new Response(
            $this->serializer->serialize($object, 'json'),
            $statusCode,
            (empty($headers) ? ['content-type' => self::OUTPUT_FORMAT] : $headers)
        );
    }
}
