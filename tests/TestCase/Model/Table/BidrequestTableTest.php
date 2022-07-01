<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BidrequestTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BidrequestTable Test Case
 */
class BidrequestTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BidrequestTable
     */
    public $Bidrequest;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bidrequest',
        'app.biditems',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Bidrequest') ? [] : ['className' => BidrequestTable::class];
        $this->Bidrequest = TableRegistry::get('Bidrequest', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bidrequest);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
