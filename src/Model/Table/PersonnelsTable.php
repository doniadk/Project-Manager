<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Personnels Model
 *
 * @property \App\Model\Table\FonctionsTable&\Cake\ORM\Association\BelongsTo $Fonctions
 * @property \App\Model\Table\GestionProjetsTable&\Cake\ORM\Association\HasMany $GestionProjets
 *
 * @method \App\Model\Entity\Personnel newEmptyEntity()
 * @method \App\Model\Entity\Personnel newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Personnel> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Personnel get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Personnel findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Personnel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Personnel> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Personnel|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Personnel saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Personnel>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Personnel>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Personnel>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Personnel> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Personnel>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Personnel>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Personnel>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Personnel> deleteManyOrFail(iterable $entities, array $options = [])
 */
class PersonnelsTable extends Table
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

        $this->setTable('personnels');
        $this->setDisplayField('nom');
        $this->setPrimaryKey('id');

        $this->belongsTo('Fonctions', [
            'foreignKey' => 'fonction_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('GestionProjets', [
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
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('adresse')
            ->maxLength('adresse', 255)
            ->requirePresence('adresse', 'create')
            ->notEmptyString('adresse');

        $validator
            ->scalar('telephone')
            ->maxLength('telephone', 255)
            ->requirePresence('telephone', 'create')
            ->notEmptyString('telephone');

        $validator
            ->integer('fonction_id')
            ->notEmptyString('fonction_id');

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
        $rules->add($rules->existsIn(['fonction_id'], 'Fonctions'), ['errorField' => 'fonction_id']);

        return $rules;
    }
}
