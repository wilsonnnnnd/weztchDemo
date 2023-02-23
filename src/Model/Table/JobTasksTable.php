<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * JobTasks Model
 *
 * @property \App\Model\Table\ServiceJobsTable&\Cake\ORM\Association\BelongsTo $ServiceJobs
 *
 * @method \App\Model\Entity\JobTask newEmptyEntity()
 * @method \App\Model\Entity\JobTask newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\JobTask[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\JobTask get($primaryKey, $options = [])
 * @method \App\Model\Entity\JobTask findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\JobTask patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\JobTask[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\JobTask|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JobTask saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JobTask[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\JobTask[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\JobTask[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\JobTask[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class JobTasksTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('job_tasks');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('ServiceJobs', [
            'foreignKey' => 'job_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->decimal('task_time')
            ->allowEmptyString('task_time');

        $validator
            ->decimal('task_cost')
            ->allowEmptyString('task_cost');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['job_id'], 'ServiceJobs'), ['errorField' => 'job_id']);

        return $rules;
    }
}
