<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateProjets extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('projets');
        $table->addColumn('nom', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('date_debut', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('date_fin', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
