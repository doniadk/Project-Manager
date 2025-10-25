<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjetsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjetsTable Test Case
 */
class ProjetsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjetsTable
     */
    protected $Projets;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Projets',
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
        $config = $this->getTableLocator()->exists('Projets') ? [] : ['className' => ProjetsTable::class];
        $this->Projets = $this->getTableLocator()->get('Projets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Projets);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\ProjetsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
