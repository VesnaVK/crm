<?php

namespace App\Prosperworks\ResourceUtility;

use App\Prosperworks\Requester;

/**
 * A class to update a resource name.
 *
 * Works only with resource types that
 *   - have a name and
 *   - support PUT
 * Namely: lead, people, companies, opportunities, projects, tasks
 */
class NameUpdater
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
     * Sets the name of the specified resource to the value provided.
     *
     * @param string $type
     * @param int    $id
     * @param string $newName
     */
    public function updateResourceName(string $type, int $id, string $newName)
    {
        $uri        = $type.'/'.$id;
        $postFields = "{\n\t\"name\":\"{$newName}\"\n}";

        $this->requester->getResponse($uri, $postFields, 'PUT');
    }
}
