<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TachesFixture
 */
class TachesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'titre' => 'Lorem ipsum dolor sit amet',
                'date_debut' => 'Lorem ipsum dolor sit amet',
                'date_fin' => 'Lorem ipsum dolor sit amet',
                'gestionprojet_id' => 1,
            ],
        ];
        parent::init();
    }
}
