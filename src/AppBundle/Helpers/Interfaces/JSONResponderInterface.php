<?php

namespace AppBundle\Helpers\Interfaces;

use AppBundle\Entity\Interfaces\OutputObjectInterface;
use Symfony\Component\HttpFoundation\Response;

interface JSONResponderInterface
{
    const OUTPUT_FORMAT = 'application/json';

    /**
     * @param OutputObjectInterface $object
     * @param int|null $statusCode
     * @param array|null $headers
     *
     * @return Response
     */
    public function response(
        $object,
        $statusCode = 200,
        $headers = []
    );
}