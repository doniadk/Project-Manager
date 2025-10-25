<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PersonnelsFixture
 */
class PersonnelsFixture extends TestFixture
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
                'nom' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'adresse' => 'Lorem ipsum dolor sit amet',
                'telephone' => 'Lorem ipsum dolor sit amet',
                'fonction_id' => 1,
            ],
        ];
        parent::init();
    }
}
