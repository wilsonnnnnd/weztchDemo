<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Instruments Model
 *
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 *
 * @method \App\Model\Entity\Instrument newEmptyEntity()
 * @method \App\Model\Entity\Instrument newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Instrument[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Instrument get($primaryKey, $options = [])
 * @method \App\Model\Entity\Instrument findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Instrument patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Instrument[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Instrument|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Instrument saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Instrument[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Instrument[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Instrument[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Instrument[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class InstrumentsTable extends Table
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

        $this->setTable('instruments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');


//        $this->addBehavior('Proffer.Proffer', [
//            'image' => [	// The name of your upload field
//                'root' => WWW_ROOT . 'instrument_files', // Customise the root upload folder here, or omit to use the default
//                'dir' => 'image_dir',	// The name of the field to store the folder
//                'thumbnailSizes' => [ // Declare your thumbnails
//                    'square' => [	// Define the prefix of your thumbnail
//                        'w' => 200,	// Width
//                        'h' => 200,	// Height
//                        'jpeg_quality'	=> 100
//                    ],
//                    'portrait' => [		// Define a second thumbnail
//                        'w' => 100,
//                        'h' => 300
//                    ],
//                ],
//                'thumbnailMethod' => 'gd'	// Options are Imagick or Gd
//            ]
//        ]);

        $this->belongsTo('Customers', [
            'foreignKey' => 'cust_id',
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
            ->scalar('model')
            ->maxLength('model', 255)
            ->notEmptyString('model');

        $validator
            ->scalar('brand')
            ->maxLength('brand', 255)
            ->notEmptyString('brand');

        $validator
            ->scalar('type')
            ->maxLength('type', 255)
            ->notEmptyString('type');

        $validator
            ->scalar('year')
            ->maxLength('year', 4)
            ->allowEmptyString('year');

        $validator
            ->scalar('serial_number')
            ->maxLength('serial_number', 255)
            ->allowEmptyString('serial_number');

        $validator
            ->scalar('country')
            ->maxLength('country', 255)
            ->allowEmptyString('country');

        $validator
            ->date('last_serviced')
            ->allowEmptyDate('last_serviced');

        $validator
            ->scalar('description')
            ->maxLength('description', 500)
            ->allowEmptyString('description');

//       $validator
//       ->allowEmpty('image', s'update')
//       ->allowEmpty('image');
//
//        $validator
//            ->scalar('image_dir')
//            ->maxLength('image_dir', 255)
//            ->allowEmptyFile('image_dir');

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
        $rules->add($rules->existsIn(['cust_id'], 'Customers'), ['errorField' => 'cust_id']);

        return $rules;
    }
}
