<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Invoice Entity
 *
 * @property int $id
 * @property int $cust_id
 * @property int $job_id
 * @property string|null $heading
 * @property \Cake\I18n\FrozenTime $invoice_date
 * @property \Cake\I18n\FrozenTime|null $payment_date
 * @property string $total_due
 * @property string $amount_due
 * @property string|null $gst
 * @property string|null $description
 * @property int|null $status
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\ServiceJob $service_job
 */
class Invoice extends Entity
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
        'job_id' => true,
        'heading' => true,
        'invoice_date' => true,
        'payment_date' => true,
        'total_due' => true,
        'amount_due' => true,
        'gst' => true,
        'description' => true,
        'status' => true,
        'customer' => true,
        'service_job' => true,
    ];
    protected function _getInvoiceName()
    {
        return $this->customer->type_name. '`s Invoice';
    }

    protected function _getDateName()
    {
        if ($this->payment_date == null){return $this->payment_date;}
        if ($this->payment_date != null){return $this->payment_date->i18nFormat('dd/MM/yyyy');}
    }

    protected function _getJobDateName()
    {
        if ($this->service_job->date_completed == null){return $this->service_job->date_completed;}
        if ($this->service_job->date_completed != null){return $this->service_job->date_completed->i18nFormat('dd/MM/yyyy');}
    }
}
