<?php

namespace AppBundle\Helpers\Interfaces;

use AppBundle\Entity\Interfaces\OutputObjectInterface;

interface DeserializerHelperInterface
{
    /**
     * @param string $requestContent
     *
     * @return OutputObjectInterface
     */
    public function deserialize($requestContent);
}