<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Inventory Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $part_no
 * @property string|null $retail_price
 * @property string|null $type
 * @property string|null $brand
 * @property string|null $description
 */
class Inventory extends Entity
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
        'name' => true,
        'part_no' => true,
        'retail_price' => true,
        'type' => true,
        'brand' => true,
        'description' => true,
    ];

    protected function _getInvCate(){
        return $this->brand." ".$this->name." ".$this->type;
    }

    protected function _getFullId()
    {
        return strval($this->id);
    }
}
