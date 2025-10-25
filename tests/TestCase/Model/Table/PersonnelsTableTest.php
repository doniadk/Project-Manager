<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PersonnelsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PersonnelsTable Test Case
 */
class PersonnelsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PersonnelsTable
     */
    protected $Personnels;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Personnels',
        'app.Fonctions',
        'app.GestionProjets',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Personnels') ? [] : ['className' => PersonnelsTable::class];
        $this->Personnels = $this->getTableLocator()->get('Personnels', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Personnels);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\PersonnelsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\PersonnelsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
