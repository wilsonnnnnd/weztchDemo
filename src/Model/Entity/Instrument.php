<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Instrument Entity
 *
 * @property int $id
 * @property int|null $cust_id
 * @property string|null $type
 * @property string|null $model
 * @property string|null $brand
 * @property string|null $serial_number
 * @property string|null $country
 * @property string|null $year
 * @property string|null $image
 * @property string|null $image_dir
 * @property \Cake\I18n\FrozenTime|null $last_serviced
 * @property string|null $description
 */
class Instrument extends Entity
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
        'type' => true,
        'model' => true,
        'brand' => true,
        'serial_number' => true,
        'country' => true,
        'year' => true,
        'image' => true,
        'image_dir' => true,
        'last_serviced' => true,
        'description' => true,
        'customer' => true,
    ];

    //get the full name of instrument
    protected function _getCustName()
    {
        return $this->customer->type_name.'`s '.$this->year.' '.$this->brand.' '.$this->model;
    }


    protected function _getInstrumentName()
    {
        return $this->year.' '.$this->brand.' '.$this->model;
    }

    protected function _getCust_Idq()
    {
        return strval($this->cust_id);
    }


    protected function _getDateName()
    {
        if ($this->last_serviced == null){return $this->last_serviced;}
        if ($this->last_serviced != null){return $this->last_serviced->i18nFormat('dd/MM/yyyy');}
    }

}
