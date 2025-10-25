<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Projets Model
 *
 * @property \App\Model\Table\GestionProjetsTable&\Cake\ORM\Association\HasMany $GestionProjets
 *
 * @method \App\Model\Entity\Projet newEmptyEntity()
 * @method \App\Model\Entity\Projet newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Projet> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Projet get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Projet findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Projet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Projet> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Projet|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Projet saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Projet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Projet>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Projet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Projet> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Projet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Projet>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Projet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Projet> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProjetsTable extends Table
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

        $this->setTable('projets');
        $this->setDisplayField('nom');
        $this->setPrimaryKey('id');

        $this->hasMany('GestionProjets', [
            'foreignKey' => 'projet_id',
        ]);

        $this->belongsToMany('Personnels', [
            'foreignKey' => 'projet_id',
            'targetForeignKey' => 'personnel_id',
            'joinTable' => 'gestion_projets_personnels',
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
            ->scalar('nom')
            ->maxLength('nom', 255)
            ->requirePresence('nom', 'create')
            ->notEmptyString('nom');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->date('date_debut')
            ->requirePresence('date_debut', 'create')
            ->notEmptyDate('date_debut');

        $validator
            ->date('date_fin')
            ->requirePresence('date_fin', 'create')
            ->notEmptyDate('date_fin');

        return $validator;
    }
}
