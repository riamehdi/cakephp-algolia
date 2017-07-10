<?php

namespace Algolia\Utility\Algolia;


class InMemoryClient implements Client
{
    public $objects = [];

    public $settings = [];

    public function getIndexSettings()
    {
        return $this->settings;
    }

    public function setIndexSettings(array $settings)
    {
        $this->settings = $settings;
    }

    public function saveObject(array $object)
    {
        array_push($this->objects, $object);
    }

    public function saveObjects(array $objects)
    {
        $this->objects = array_merge($this->objects, $objects);
    }

    public function deleteObject($objectId)
    {
        foreach($this->objects as $i=>$object) {
            if ($object['objectId'] == $objectId) {
                unset($this->objects[$i]);
            }
        }
    }

}
