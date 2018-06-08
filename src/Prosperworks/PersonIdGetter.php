<?php

namespace App\Prosperworks;

use App\Prosperworks\Requester;
use App\Resource;

class PersonIdGetter implements IdGetterInterface
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
     * {@inheritDoc}
     *
     * Warning: Person names are not unique
     */
    public function getIdByName(string $name): ?int
    {
        $uri        = 'people/search';
        $postFields =   "{\n \"name\":\"{$name}\"\n}";

        $personDataList = json_decode($this->requester->getResponse($uri, $postFields), true);

        try {
            return reset($personDataList)['id'];
        } catch (\Exception $e) {
            echo 'No such person: '.$name,  $e->getMessage(), "\n";
        }
    }
}
