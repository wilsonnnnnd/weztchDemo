<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parts Model
 *
 * @property \App\Model\Table\InventoriesTable&\Cake\ORM\Association\BelongsTo $Inventories
 * @property \App\Model\Table\ServiceJobsTable&\Cake\ORM\Association\BelongsTo $ServiceJobs
 * @property \App\Model\Table\ReceiptsTable&\Cake\ORM\Association\BelongsTo $Receipts
 *
 * @method \App\Model\Entity\Part newEmptyEntity()
 * @method \App\Model\Entity\Part newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Part[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Part get($primaryKey, $options = [])
 * @method \App\Model\Entity\Part findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Part patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Part[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Part|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Part saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Part[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Part[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Part[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Part[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PartsTable extends Table
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

        $this->setTable('parts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Inventories', [
            'foreignKey' => 'inv_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ServiceJobs', [
            'foreignKey' => 'job_id',
        ]);
        $this->belongsTo('Receipts', [
            'foreignKey' => 'rec_id',
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
            ->scalar('serial_no')
            ->maxLength('serial_no', 255)
            ->allowEmptyString('serial_no');

        $validator
            ->decimal('individual_price')
            ->allowEmptyString('individual_price');

        $validator
            ->integer('status')
            ->notEmptyString('status');

        $validator
            ->integer('quantity')
            ->notEmptyString('quantity');

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
        $rules->add($rules->existsIn(['inv_id'], 'Inventories'), ['errorField' => 'inv_id']);
        $rules->add($rules->existsIn(['job_id'], 'ServiceJobs'), ['errorField' => 'job_id']);
        $rules->add($rules->existsIn(['rec_id'], 'Receipts'), ['errorField' => 'rec_id']);

        return $rules;
    }
}
