<?php

namespace App\Prosperworks\ResourceUtility;

use App\Prosperworks\Requester;

/**
 * A class to make a resource that's related to another resource.
 */
class RelatedResourceMaker
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
     * Creates a resource of the specified type for the resource ID provided.
     *
     * Delays before returning because the resource isn't instantly available.
     * Adjust sleep time as needed for quicker performance
     *    but watch for "no such resource" kinds of errors.
     *
     * @param string $type The type of resource to create.
     * @param string $name The name for the new resource.
     * @param string $relationship The type of relationship to the original resource.
     * @param int    $id The ID of the original resource.
     */
    public function makeRelated(
        string $type,
        string $name,
        string $relationship,
        int $id
    ) {
        $postFields =   "{\n\t\"name\":\"{$name}\",\n\t\"{$relationship}\":\"{$id}\"\n}";

        $this->requester->getResponse($type, $postFields);
        sleep(5);
    }
}
