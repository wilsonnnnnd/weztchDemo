<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ServiceJobsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ServiceJobsTable Test Case
 */
class ServiceJobsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ServiceJobsTable
     */
    protected $ServiceJobs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ServiceJobs',
        'app.Instruments',
        'app.Quotes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ServiceJobs') ? [] : ['className' => ServiceJobsTable::class];
        $this->ServiceJobs = $this->getTableLocator()->get('ServiceJobs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ServiceJobs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ServiceJobsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ServiceJobsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
