<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GestionProjetsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GestionProjetsTable Test Case
 */
class GestionProjetsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GestionProjetsTable
     */
    protected $GestionProjets;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.GestionProjets',
        'app.Personnels',
        'app.Projets',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('GestionProjets') ? [] : ['className' => GestionProjetsTable::class];
        $this->GestionProjets = $this->getTableLocator()->get('GestionProjets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->GestionProjets);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\GestionProjetsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\GestionProjetsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
