<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ServiceJobs Model
 *
 * @property \App\Model\Table\InstrumentsTable&\Cake\ORM\Association\BelongsTo $Instruments
 * @property \App\Model\Table\QuotesTable&\Cake\ORM\Association\BelongsTo $Quotes
 *
 * @method \App\Model\Entity\ServiceJob newEmptyEntity()
 * @method \App\Model\Entity\ServiceJob newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ServiceJob[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ServiceJob get($primaryKey, $options = [])
 * @method \App\Model\Entity\ServiceJob findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ServiceJob patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ServiceJob[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ServiceJob|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ServiceJob saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ServiceJob[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ServiceJob[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ServiceJob[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ServiceJob[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ServiceJobsTable extends Table
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

        $this->setTable('service_jobs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Instruments', [
            'foreignKey' => 'inst_id',
        ]);
        $this->belongsTo('Quotes', [
            'foreignKey' => 'quo_id',
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
            ->notEmptyString('id', 'create');

        $validator
            ->decimal('estimated_time')
            ->maxLength('estimated_time', 8)
            ->allowEmptyString('estimated_time');

        $validator
            ->date('date_started')
            ->notEmptyDate('date_started');

        $validator
            ->date('date_completed')
            ->allowEmptyDate('date_completed');

        $validator
            ->decimal('time_taken')
            ->maxLength('time_taken', 8)
            ->allowEmptyString('time_taken');

        $validator
            ->scalar('jobs_performed')
            ->maxLength('jobs_performed', 500)
            ->allowEmptyString('jobs_performed');


        $validator
            ->scalar('description')
            ->maxLength('description', 500)
            ->allowEmptyString('description');

        $validator
            ->integer('status')
            ->notEmptyString('status');

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
        $rules->add($rules->existsIn(['inst_id'], 'Instruments'), ['errorField' => 'inst_id']);
        $rules->add($rules->existsIn(['quo_id'], 'Quotes'), ['errorField' => 'quo_id']);

        return $rules;
    }
}
