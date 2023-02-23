<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Quote Entity
 *
 * @property int $id
 * @property int $cust_id
 * @property string|null $heading
 * @property \Cake\I18n\FrozenTime|null $date
 * @property \Cake\I18n\FrozenDate|null $expiry
 * @property \Cake\I18n\FrozenDate|null $estimated_completion
 * @property string|null $estimated_total
 * @property string|null $estimated_cost
 * @property string|null $gst
 * @property string|null $description
 * @property string|null $items_required
 * @property int|null $status
 *
 * @property \App\Model\Entity\Customer $customer
 */
class Quote extends Entity
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
        'cust_id' => true,
        'heading' => true,
        'date' => true,
        'expiry' => true,
        'estimated_completion' => true,
        'estimated_total' => true,
        'estimated_cost' => true,
        'gst' => true,
        'description' => true,
        'items_required' => true,
        'status' => true,
        'customer' => true,
    ];

    protected function _getQuoteName()
    {
        return $this->customer->type_name . '`s Quote';
    }

    protected function _getStringCustid()
    {
        return strval($this->cust_id);
    }

    protected function _getPopMessage()
    {
        return $this->customer->type_name." (Date: ".$this->date.")";
    }





}
