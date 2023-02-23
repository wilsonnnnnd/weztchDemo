<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Part Entity
 *
 * @property int $id
 * @property int $inv_id
 * @property int|null $job_id
 * @property int|null $rec_id
 * @property int $quantity
 * @property string|null $serial_no
 * @property string|null $individual_price
 * @property string|null $markup
 * @property string|null $price_markup
 * @property string|null $status
 *
 * @property \App\Model\Entity\Inventory $inventory
 * @property \App\Model\Entity\ServiceJob $service_job
 * @property \App\Model\Entity\Receipt $receipt
 */
class Part extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'inv_id' => true,
        'job_id' => true,
        'rec_id' => true,
        'serial_no' => true,
        'quantity' => true,
        'individual_price' => true,
        'markup' => true,
        'price_markup' => true,
        'status' => true,
        'inventory' => true,
        'service_job' => true,
        'receipt' => true,
    ];

    protected function _getFullId()
    {
        return strval($this->id);
    }

}
