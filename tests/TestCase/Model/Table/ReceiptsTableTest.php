<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReceiptsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReceiptsTable Test Case
 */
class ReceiptsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReceiptsTable
     */
    protected $Receipts;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
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
        $config = $this->getTableLocator()->exists('Receipts') ? [] : ['className' => ReceiptsTable::class];
        $this->Receipts = $this->getTableLocator()->get('Receipts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Receipts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ReceiptsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
