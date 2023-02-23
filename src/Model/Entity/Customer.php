<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customer Entity
 *
 * @property int $id
 * @property string $type
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $gender
 * @property string|null $business
 * @property string|null $abn
 * @property string|null $email
 * @property string|null $phone_no
 * @property string|null $street
 * @property string|null $city
 * @property string|null $state
 * @property string|null $postcode
 * @property string|null $intro_method
 * @property string $preferred_contact
 * @property string|null $description
 * @property string|null $full_name
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Customer extends Entity
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
        'id' =>true,
        'type' => true,
        'first_name' => true,
        'last_name' => true,
        'gender' => true,
        'business' => true,
        'abn' => true,
        'phone_no' => true,
        'email' => true,
        'street' => true,
        'city' => true,
        'state' => true,
        'postcode' => true,
        'intro_method' => true,
        'preferred_contact' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
    ];

    protected function _getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    protected function _getFullId()
    {
        return strval($this->id);
    }

    protected function _getTypeName()
    {
        if ($this->type == "Individual"){return $this->full_name;}
        if ($this->type == "Business"){return $this->business;}
    }

    protected function _getContactName()
    {
        if ($this->preferred_contact == "Email"){return $this->email;}
        if ($this->preferred_contact == "Phone No"){return $this->phone_no;}
    }

    protected function _getAddressName()
    {
        return $this->street . '  ' . $this->city. '  ' . $this->state. '  ' . $this->postcode;
    }

   
}
