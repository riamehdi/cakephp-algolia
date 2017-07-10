<?php

namespace Algolia\Utility\Algolia;


use AlgoliaSearch\Index;

class AlgoliaSdkClient implements Client
{
    /**
     * @var Index
     */
    private $index;

    public function __construct($appId, $apiKey, $index)
    {
        $client = new \AlgoliaSearch\Client($appId, $apiKey);
        $this->index = $client->initIndex($index);
    }

    public function saveObject(array $object)
    {
        return $this->index->saveObject($object);
    }

    public function saveObjects(array $objects)
    {
        return $this->index->saveObjects($objects);
    }

    public function deleteObject($objectId)
    {
        return $this->index->deleteObject($objectId);
    }

    public function setIndexSettings(array $settings)
    {
        return $this->index->setSettings($settings);
    }

    public function getIndexSettings()
    {
        return $this->index->getSettings();
    }

}
