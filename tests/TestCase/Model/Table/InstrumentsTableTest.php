<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InstrumentsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InstrumentsTable Test Case
 */
class InstrumentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InstrumentsTable
     */
    protected $Instruments;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Instruments',
        'app.Customers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Instruments') ? [] : ['className' => InstrumentsTable::class];
        $this->Instruments = $this->getTableLocator()->get('Instruments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Instruments);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\InstrumentsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\InstrumentsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
