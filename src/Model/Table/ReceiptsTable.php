<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Receipts Model
 *
 * @method \App\Model\Entity\Receipt newEmptyEntity()
 * @method \App\Model\Entity\Receipt newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Receipt[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Receipt get($primaryKey, $options = [])
 * @method \App\Model\Entity\Receipt findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Receipt patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Receipt[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Receipt|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Receipt saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Receipt[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Receipt[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Receipt[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Receipt[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ReceiptsTable extends Table
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

        $this->setTable('receipts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');


//        $this->addBehavior('Josegonzalez/Upload.Upload', [
//            // You can configure as many upload fields as possible,
//            // where the pattern is `field` => `config`
//            //
//            // Keep in mind that while this plugin does not have any limits in terms of
//            // number of files uploaded per request, you should keep this down in order
//            // to decrease the ability of your users to block other requests.
//            'image' => ['fields' => ['dir' => 'image']]
//        ]);
//







        // $this->addBehavior('Proffer.Proffer', [
        //     'image' => [	// The name of your upload field
        //         'root' => WWW_ROOT . 'files', // Customise the root upload folder here, or omit to use the default
        //         'dir' => 'image_dir',	// The name of the field to store the folder
        //         'thumbnailSizes' => [ // Declare your thumbnails
        //             'square' => [	// Define the prefix of your thumbnail
        //                 'w' => 200,	// Width
        //                 'h' => 200,	// Height
        //                 'jpeg_quality'	=> 100
        //             ],
        //             'portrait' => [		// Define a second thumbnail
        //                 'w' => 100,
        //                 'h' => 300
        //             ],
        //         ],
        //         'thumbnailMethod' => 'gd'	// Options are Imagick or Gd
        //     ]
        // ]);
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
            ->scalar('receipt_no')
            ->maxLength('receipt_no', 50)
            ->allowEmptyString('receipt_no');

        $validator
            ->decimal('total_price')
            ->requirePresence('total_price', 'create')
            ->maxLength('total_price', 10)
            ->notEmptyString('total_price');

        $validator
            ->decimal('shipping')
            ->maxLength('shipping', 10)
            ->allowEmptyString('shipping');

        $validator
            ->decimal('gst')
            ->maxLength('gst', 10)
            ->allowEmptyString('gst');

        $validator
            ->decimal('discount')
            ->maxLength('discount', 10)
            ->allowEmptyString('discount');

        $validator
            ->date('date')
            ->notEmptyDate('date');

        $validator
            ->scalar('purchase_method')
            ->maxLength('purchase_method', 100)
            ->allowEmptyString('purchase_method');

        $validator
            ->scalar('purchase_source')
            ->maxLength('purchase_source', 100)
            ->allowEmptyString('purchase_source');

        $validator
            ->scalar('job_type')
            ->maxLength('job_type', 100)
            ->allowEmptyString('job_type');

        $validator
            ->scalar('receipt_type')
            ->maxLength('receipt_type', 100)
            ->allowEmptyString('receipt_type');



        $validator
        ->allowEmptyString('image');

            $validator->add('image', 'mimeType', [
                'rule' => ['mimeType', ['image/jpg','image/jpeg','image/png']],
                'message' => 'Incorrect file type'
            ]);

            $validator->add('image', 'fileSize', [
                'rule' => ['fileSize', '<=', '2mb'],
                'message' => 'Please insert file less than 2mb'
            ]);

        $validator
            ->scalar('description')
            ->maxLength('description', 500)
            ->allowEmptyString('description');

        return $validator;
    }



}
