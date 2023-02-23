<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Customers Model
 *
 * @method \App\Model\Entity\Customer newEmptyEntity()
 * @method \App\Model\Entity\Customer newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Customer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Customer findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Customer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Customer|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomersTable extends Table
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

        $this->setTable('customers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('type')
            ->maxLength('type', 255)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 50)
            ->requirePresence('first_name', 'create')
            ->allowEmptyString('first_name')
            ->add('first_name', 'validFormat',[
                'rule' => array('custom', '/^[A-Za-z][A-Za-z\'\-]+([\ A-Za-z][A-Za-z\'\-]+)*/'),
                'message' => 'Please enter a valid name that shouldnt contain any special characters ' 
        ]);


        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 50)
            ->requirePresence('last_name', 'create')
            ->allowEmptyString('last_name')
            ->add('last_name', 'validFormat',[
                'rule' => array('custom', '/^[A-Za-z][A-Za-z\'\-]+([\ A-Za-z][A-Za-z\'\-]+)*/'),
                'message' => 'Please enter a valid name that shouldnt contain any special characters ' 
        ]);

        $validator
            ->scalar('gender')
            ->maxLength('gender', 10)
            ->requirePresence('gender', 'create')
            ->allowEmptyString('gender');

        $validator
            ->scalar('business')
            ->maxLength('business', 255)
            ->allowEmptyString('business');

        $validator
            ->integer('abn')
            ->maxLength('abn', 11)
            ->allowEmptyString('abn');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->allowEmptyString('email');


        // $validator
        //    ->scalar('phone_no')
        //    ->maxLength('phone_no', 10)
        //    ->requirePresence('phone_no', 'create');



        $validator
           ->scalar('phone_no')
           ->maxLength('phone_no', 12)
           ->requirePresence('phone_no', 'create')
           ->add('phone','valid',['rule'=>['custom','/(?<=^\+|^)[0-9]\d*/'],'message'=>'Invalid Phone Number']);



        $validator
            ->scalar('street')
            ->maxLength('street', 255)
            ->allowEmptyString('street');

        $validator
            ->scalar('city')
            ->maxLength('city', 255)
            ->allowEmptyString('city');

            $validator
            ->scalar('state')
            ->maxLength('state', 3)
            ->allowEmptyString('state')
            ->add('state', 'custom',[
                'rule' => function ($value, $context) {
                    if ($value == 'VIC' || $value == 'NSW' || $value == 'NT' || $value == 'QLD' || $value == 'TAS'
                        || $value == 'ACT' || $value == 'WA' || $value == 'SA') {
                        return true;
                    }

                    return false;
                },


                'message' => 'State must be: ACT, QLD, NSW, NT, SA, TAS, WA or VIC'
//
            ]);

//minimum length postcode is 3 integers ()

        $validator
            ->scalar('postcode')
            ->minLength('postcode', 3)
            ->maxLength('postcode', 4)
            ->add('hourly_hire_rate', 'custom',[
                'rule' => function ($value, $context) {
                    if ($value >= 200) {
                        return true;
                    }
//                    note that 200 is the LVR/PO box in ACT, it seems to be the lowest postcode in Australia
//                    note tat 9999 is the LVR/PO box in QLD, it seems to be the highest postcode in Australia
                    return false;
                },

                'message' => 'Please check your postcode and try again'
            ])
            ->allowEmptyString('postcode');

        $validator
            ->scalar('intro_method')
            ->maxLength('intro_method', 255)
            ->notEmptyString('intro_method');

        $validator
            ->scalar('preferred_contact')
            ->maxLength('preferred_contact', 255)
            ->notEmptyString('preferred_contact');

        $validator
            ->scalar('description')
            ->allowEmptyString('description')
            ->maxLength('description', 500);

        return $validator;
    }
}
