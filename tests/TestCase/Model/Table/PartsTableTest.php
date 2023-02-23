<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PartsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PartsTable Test Case
 */
class PartsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PartsTable
     */
    protected $Parts;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Parts',
        'app.Inventories',
        'app.ServiceJobs',
        'app.Receipts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Parts') ? [] : ['className' => PartsTable::class];
        $this->Parts = $this->getTableLocator()->get('Parts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Parts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PartsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PartsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
