<?php
namespace App\Model\Table;

use App\Model\Entity\ProductVersion;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductVersions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Products
 *
 * @method ProductVersion get($primaryKey, $options = [])
 * @method ProductVersion newEntity($data = null, array $options = [])
 * @method ProductVersion[] newEntities(array $data, array $options = [])
 * @method ProductVersion|bool save(EntityInterface $entity, $options = [])
 * @method ProductVersion patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method ProductVersion[] patchEntities($entities, array $data, array $options = [])
 * @method ProductVersion findOrCreate($search, callable $callback = null)
 */
class ProductVersionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('product_versions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->dateTime('version')
            ->requirePresence('version', 'create')
            ->notEmpty('version');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['product_id'], 'Products'));
        return $rules;
    }
}
