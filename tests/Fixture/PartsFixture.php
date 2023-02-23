<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PartsFixture
 */
class PartsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'inv_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'job_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rec_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'serial_no' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null],
        'quantity' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'individual_price' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'markup' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'price_markup' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'status' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'inv_key' => ['type' => 'index', 'columns' => ['inv_id'], 'length' => []],
            'job_key' => ['type' => 'index', 'columns' => ['job_id'], 'length' => []],
            'rec_key' => ['type' => 'index', 'columns' => ['rec_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'parts_ibfk_1' => ['type' => 'foreign', 'columns' => ['inv_id'], 'references' => ['inventories', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'parts_ibfk_2' => ['type' => 'foreign', 'columns' => ['job_id'], 'references' => ['service_jobs', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'parts_ibfk_3' => ['type' => 'foreign', 'columns' => ['rec_id'], 'references' => ['receipts', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_0900_ai_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'inv_id' => 1,
                'job_id' => 1,
                'rec_id' => 1,
                'quantity' => 1,
                'serial_no' => 'Lorem ipsum dolor sit amet',
                'individual_price' => 1.5,
                'markup' => 1,
                'price_markup' => 1.5,
                'status' => 1,
            ],
        ];
        parent::init();
    }
}
