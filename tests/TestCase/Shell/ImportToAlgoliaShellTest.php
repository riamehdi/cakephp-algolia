<?php
namespace Algolia\Test\TestCase\Shell;

use Algolia\Shell\ImportToAlgoliaShell;
use Algolia\Utility\Algolia\InMemoryClient;
use Cake\TestSuite\TestCase;

/**
 * App\Shell\ImportToAlgoliaShell Test Case
 */
class ImportToAlgoliaShellTest extends TestCase
{

    /**
     * ConsoleIo mock
     *
     * @var \Cake\Console\ConsoleIo|\PHPUnit_Framework_MockObject_MockObject
     */
    public $io;

    /**
     * Test subject
     *
     * @var \App\Shell\ImportToAlgoliaShell
     */
    public $ImportToAlgolia;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->io = $this->getMock('Cake\Console\ConsoleIo');
        $this->ImportToAlgolia = new ImportToAlgoliaShell($this->io);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ImportToAlgolia);

        parent::tearDown();
    }

    /**
     * Test main method
     *
     * @return void
     */
    public function testMain()
    {
        $inMemoryClient = new InMemoryClient();

        $this->ImportToAlgolia->setAlgoliaClient($inMemoryClient);
        $this->ImportToAlgolia->main();

        $this->assertEquals(2, count($inMemoryClient->objects));
        $this->assertEquals(['title', 'description'], $inMemoryClient->getIndexSettings()['attributesToIndex']);
    }
}