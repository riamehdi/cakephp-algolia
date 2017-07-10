<?php

namespace Algolia\Utility\Algolia;

interface Client
{
    public function setIndexSettings(array $settings);

    public function saveObject(array $object);

    public function saveObjects(array $objects);

    public function deleteObject($objectId);

    public function getIndexSettings();
}
