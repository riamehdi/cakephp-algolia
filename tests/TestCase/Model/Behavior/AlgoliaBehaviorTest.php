<?php
namespace Algolia\Test\TestCase\Model\Behavior;

use Algolia\Model\Behavior\AlgoliaBehavior;
use Cake\TestSuite\TestCase;

/**
 * Algolia\Model\Behavior\AlgoliaBehavior Test Case
 */
class AlgoliaBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Algolia\Model\Behavior\AlgoliaBehavior
     */
    public $Algolia;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Algolia = new AlgoliaBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Algolia);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
