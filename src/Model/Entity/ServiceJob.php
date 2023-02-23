<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ServiceJob Entity
 *
 * @property int $id
 * @property int|null $inst_id
 * @property int|null $quo_id
 * @property int|null $task_id
 * @property string|null $estimated_time
 * @property \Cake\I18n\FrozenTime|null $date_started
 * @property \Cake\I18n\FrozenTime|null $date_completed
 * @property string|null $time_taken
 * @property string|null $jobs_performed
 * @property string|null $description
 * @property int|null $status
 *
 * @property \App\Model\Entity\Instrument $instrument
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Quote $quote
 */
class ServiceJob extends Entity
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
        'inst_id' => true,
        'quo_id' => true,
        'estimated_time' => true,
        'date_started' => true,
        'date_completed' => true,
        'time_taken' => true,
        'jobs_performed' => true,
        'description' => true,
        'status' => true,
        'instrument' => true,
        'quote' => true,
    ];

    protected function _getJobName()
    {
        return $this->instrument->year.' '.$this->instrument->brand.' '.$this->instrument->model.' ('.$this->date_started->i18nFormat('dd/MM/yyyy').')';
    }

    protected function _getCustomerName()
    {
        return $this->instrument->customer->type_name;
    }





    protected function _getDateName()
    {
        if ($this->date_completed == null){return $this->date_completed;}
        if ($this->date_completed != null){return $this->date_completed->i18nFormat('dd/MM/yyyy');}
    }

    protected function _getEstHours()
    {
        if ($this->estimated_time == null){return null;}
        else return $this->estimated_time." Hours";
    }

    protected function _getActHours()
    {
        if ($this->time_taken == null){return null;}
        else return $this->time_taken." Hours";
    }


}
