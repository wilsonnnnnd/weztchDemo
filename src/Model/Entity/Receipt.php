<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Receipt Entity
 *
 * @property int $id
 * @property string|null $receipt_no
 * @property string $total_price
 * @property string|null $shipping
 * @property string|null $gst
 * @property string|null $discount
 * @property \Cake\I18n\FrozenTime|null $date
 * @property string|null $purchase_method
 * @property string|null $purchase_source
 * @property string|null $job_type
 * @property string|null $receipt_type
 * @property string|null $image
 * @property string|null $description
 * @var mixed|string
 */
class Receipt extends Entity
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
        'receipt_no' => true,
        'total_price' => true,
        'shipping' => true,
        'gst' => true,
        'discount' => true,
        'date' => true,
        'purchase_method' => true,
        'purchase_source' => true,
        'job_type' => true,
        'receipt_type' => true,
        'image' => true,
        'description' => true,
        'created' => true,
    ];


    protected function _getDateName()
    {
        if ($this->date == null){return $this->date;}
        if ($this->date != null){return $this->date->i18nFormat('dd/MM/yyyy');}
    }

    protected function _getReceiptName()
    {
        return "R".$this->id." | Date: ".$this->date->i18nFormat('dd/MM/yyyy');
    }
}
