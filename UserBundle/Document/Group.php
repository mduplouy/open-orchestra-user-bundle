<?php

namespace OpenOrchestra\UserBundle\Document;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="group_document")
 */
class Group extends BaseGroup
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = array();
    }

    /**
     * @ODM\Id(strategy="auto")
     */
    protected $id;
}