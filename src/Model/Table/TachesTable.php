<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Taches Model
 *
 * @property \App\Model\Table\GestionProjetsTable&\Cake\ORM\Association\BelongsTo $Gestionprojets
 *
 * @method \App\Model\Entity\Tach newEmptyEntity()
 * @method \App\Model\Entity\Tach newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Tach> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tach get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Tach findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Tach patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Tach> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tach|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Tach saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Tach>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tach>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tach>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tach> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tach>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tach>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tach>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tach> deleteManyOrFail(iterable $entities, array $options = [])
 */
class TachesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('taches');
        $this->setDisplayField('titre');
        $this->setPrimaryKey('id');

        $this->belongsTo('Gestionprojets', [
            'foreignKey' => 'gestionprojet_id',
            'joinType' => 'INNER',
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
            ->scalar('titre')
            ->maxLength('titre', 255)
            ->requirePresence('titre', 'create')
            ->notEmptyString('titre');

        $validator
            ->scalar('date_debut')
            ->maxLength('date_debut', 255)
            ->requirePresence('date_debut', 'create')
            ->notEmptyString('date_debut');

        $validator
            ->scalar('date_fin')
            ->maxLength('date_fin', 255)
            ->requirePresence('date_fin', 'create')
            ->notEmptyString('date_fin');

        $validator
            ->integer('gestionprojet_id')
            ->notEmptyString('gestionprojet_id');

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
        $rules->add($rules->existsIn(['gestionprojet_id'], 'Gestionprojets'), ['errorField' => 'gestionprojet_id']);

        return $rules;
    }
}
