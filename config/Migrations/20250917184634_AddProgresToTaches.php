<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddProgresToTaches extends BaseMigration
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
        $table = $this->table('taches');
        $table->addColumn('progres', 'decimal', [
            'default' => null,
            'null' => false,
            'precision' => 10,
            'scale' => 2,
        ]);
        $table->addIndex([
            'progres',
        
            ], [
            'name' => 'BY_PROGRES',
            'unique' => false,
        ]);
        $table->update();
    }
}
