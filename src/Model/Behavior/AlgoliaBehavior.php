<?php
namespace Algolia\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Core\Configure;
use Algolia\Utility\Algolia\Client;
use Algolia\Utility\Algolia\AlgoliaSdkClient;

/**
 * Algolia behavior
 */
class AlgoliaBehavior extends Behavior
{
    
    protected $_defaultConfig = [
        'index' => ''
        // Other Algolia API key configuration
    ];

    protected $algoliaClient;

    public function afterSave($event, $entity)
    {
        // use client from tutorial link assuming that the index is set.
        $client = $this->getAlgoliaClient();
        
        // push to algolia
        $client->saveObject($entity->toArray());
    }
    
    public function afterDelete($event, $entity)
    {
        // use client from tutorial link assuming that the index is set.
        $client = $this->getAlgoliaClient();
        
        // Find the model's primary key, assuming a non-composite pk
        $schema = $this->getTable()->getPrimaryKey();
        
        // Remove from algolia
        $client->deleteObject($entity->get($primaryKey));
    }

    public function setAlgoliaClient(Client $client)
    {
        $this->algoliaClient = $client;
    }

    /**
     * @return Client
     */
    public function getAlgoliaClient()
    {
        if (null == $this->algoliaClient) {
            $this->algoliaClient =  new AlgoliaSdkClient(
                Configure::read('Algolia.appId'),
                Configure::read('Algolia.apiKey.backend'),
                Configure::read('Algolia.index')
            );
        }
        return $this->algoliaClient;
    }
}
