<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Personnel Entity
 *
 * @property int $id
 * @property string $nom
 * @property string $email
 * @property string $adresse
 * @property string $telephone
 * @property int $fonction_id
 *
 * @property \App\Model\Entity\Fonction $fonction
 * @property \App\Model\Entity\GestionProjet[] $gestion_projets
 */
class Personnel extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'nom' => true,
        'email' => true,
        'adresse' => true,
        'telephone' => true,
        'fonction_id' => true,
        'fonction' => true,
        'gestion_projets' => true,
    ];
}
