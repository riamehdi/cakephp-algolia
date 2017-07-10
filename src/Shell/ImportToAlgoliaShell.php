<?php
namespace Algolia\Shell;

use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\Console\ConsoleOptionParser;

use Algolia\Utility\Algolia\Client;
use Algolia\Utility\Algolia\AlgoliaSdkClient;


/**
 * ImportToAlgolia shell command.
 */
class ImportToAlgoliaShell extends Shell
{
    private $algoliaClient = null;

    /**
     * Gets the option parser instance and configures it.
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser->addOptions([
            'url' => ['help' => 'URL of the json ressource to index', 'required' => true]
        ]);

        return $parser;

    }

    public function main()
    {
        $this->out('Start importing to Algolia');

        if(!isset($this->params['url']) || $this->params['url'] === null) {
            $this->out('The --url param is missing');
            exit();
        }

        // Get data from Database
        $file = file_get_contents($this->params['url']);
        $objects = json_decode($file, true);

//        dd($objects);

        $this->getAlgoliaClient()->saveObjects($objects);

        $this->getAlgoliaClient()->setIndexSettings([
            'attributesToIndex' => array('title', 'description'),
//            'customRanking' => array('desc(commen_counts)')
        ]);

        $this->out('Finish importing to Algolia');
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
