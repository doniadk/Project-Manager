<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tach Entity
 *
 * @property int $id
 * @property string $titre
 * @property string $date_debut
 * @property string $date_fin
 * @property int $gestionprojet_id
 *
 * @property \App\Model\Entity\GestionProjet $gestionprojet
 */
class Tach extends Entity
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
        'titre' => true,
        'date_debut' => true,
        'date_fin' => true,
        'gestionprojet_id' => true,
        'gestionprojet' => true,
        'progres' => true,
    ];
}
