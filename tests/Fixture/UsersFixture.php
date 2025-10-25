<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'id' => 2,
                'name' => 'donia khairallah',
                'email' => 'khairallahdonia05@gmail.com',
                'password' => '$2y$12$sZBD.NKdy0EaPOgE9lTLauUTploHTdcdAKcDMcXc2j3urAoquVF5y',
                'role' => '',
            ],
        ];
        parent::init();
    }
}
