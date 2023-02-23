<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * JobTask Entity
 *
 * @property int $id
 * @property int|null $job_id
 * @property string $name
 * @property string|null $task_time
 * @property string|null $task_cost
 * @property string|null $description
 *
 * @property \App\Model\Entity\ServiceJob $service_job
 */
class JobTask extends Entity
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
        'job_id' => true,
        'name' => true,
        'task_time' => true,
        'task_cost' => true,
        'description' => true,
        'service_job' => true,
    ];
}
