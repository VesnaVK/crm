<?php

namespace App\Prosperworks\ResourceUtility;

use App\Prosperworks\Requester;

class DataLister
{
    /**
     * @var Requester
     */
    private $requester = null;

    /**
     * @param Requester $requester
     */
    public function __construct(Requester $requester)
    {
        $this->requester = $requester;
    }

    /**
     * Gets a list of data for all resources of a type.
     *
     * @return string
     */
    public function getResourceDataList(string $type): string
    {
        $uri        = $type.'/search';
        $postFields = "{\n  \"page_size\": 25,\n  \"sort_by\": \"name\"\n  \n}";

        return $this->requester->getResponse($uri, $postFields);
    }
}
