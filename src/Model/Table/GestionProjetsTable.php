<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GestionProjets Model
 *
 * @property \App\Model\Table\PersonnelsTable&\Cake\ORM\Association\BelongsTo $Personnels
 * @property \App\Model\Table\ProjetsTable&\Cake\ORM\Association\BelongsTo $Projets
 *
 * @method \App\Model\Entity\GestionProjet newEmptyEntity()
 * @method \App\Model\Entity\GestionProjet newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\GestionProjet> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GestionProjet get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\GestionProjet findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\GestionProjet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\GestionProjet> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\GestionProjet|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\GestionProjet saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\GestionProjet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\GestionProjet>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\GestionProjet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\GestionProjet> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\GestionProjet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\GestionProjet>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\GestionProjet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\GestionProjet> deleteManyOrFail(iterable $entities, array $options = [])
 */
class GestionProjetsTable extends Table
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

        $this->setTable('gestion_projets');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Personnels', [
            'foreignKey' => 'gestion_projet_id',
            'targetForeignKey' => 'personnel_id',
            'joinTable' => 'gestion_projets_personnels',
        ]);

        $this->hasMany('Taches', [
            'foreignKey' => 'gestionprojet_id',
        ]);


        $this->belongsTo('Projets', [
            'foreignKey' => 'projet_id',
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
            ->integer('projet_id')
            ->notEmptyString('projet_id');

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
        $rules->add($rules->existsIn(['projet_id'], 'Projets'), ['errorField' => 'projet_id']);

        return $rules;
    }
}
