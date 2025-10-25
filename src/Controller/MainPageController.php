<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Dompdf\Dompdf;
use PhpParser\Node\Stmt\ElseIf_;
/**
 * MainPage Controller
 *
 */
class MainPageController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $date = $this->request->getQuery('date') ?? $this->request->getData('date');
        $export = $this->request->getData('export') ?? $this->request->getQuery('export');

        $gestionProjetsTable = TableRegistry::getTableLocator()->get('GestionProjets');

        if ($date) {
            // Filter projects whose start <= selected date <= end
            $projects = $gestionProjetsTable->find()
                ->contain(['Projets','Personnels', 'Taches'])
                ->matching('Projets', function ($q) use ($date) {
                    return $q->where([
                        'Projets.date_debut <=' => $date,
                        'Projets.date_fin >='   => $date
                    ]);
                })
                ->all();
        } else {
            $projects = [];
        }

        $this->set(compact('date', 'projects'));

        if ($this->request->is('post') && $export === 'excel') {
            $notes = $this->request->getData('notes');
            $this->exportExcel($projects, $date, $notes);
        }
        elseif ($this->request->is('post') && $export === 'pdf'){
            $notes = $this->request->getData('notes');
            $this->exportPdf($projects, $date, $notes);
        }
    }


    public function exportExcel($projects, $date, $notes) {

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="projects_' . $date . '.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');

        // Add BOM for UTF-8 compatibility in Excel
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // Header row
        fputcsv($output, ['Projet', 'Personnel', 'Taches', 'Remarques'], ';');

        foreach ($projects as $index => $projet) {
            // Join all personnel names with commas
            $personnelNames = !empty($projet->personnels)
            ? implode(', ', array_map(fn($p) => $p->nom, $projet->personnels))
            : '';

            $tachesNom = !empty($projet->taches)
            ? implode(', ', array_map(fn($t) => $t->titre, $projet->taches))
            : '';


            fputcsv($output, [
                $projet->projet->nom,
                $personnelNames,
                $tachesNom,
                $notes[$index] ?? ''
            ], ';');
        }

        fclose($output);
        exit;
    }



public function exportPdf($projects, $date, $notes) {
    $dompdf = new Dompdf();

    // Build HTML
    $html = "<h1>Projects Report - $date</h1>";
    $html .= "<table border='1' cellpadding='5' cellspacing='0' width='100%'>";
    $html .= "<tr><th>Project</th><th>Personnel</th><th>Taches</th><th>Notes</th></tr>";

    foreach ($projects as $index => $projet) {
        $personnelNames = !empty($projet->personnels)
            ? implode(', ', array_map(fn($p) => $p->nom, $projet->personnels))
            : '';

        $tachesNom = !empty($projet->taches)
            ? implode(', ', array_map(fn($t) => $t->titre, $projet->taches))
            : '';

        $note = $notes[$index] ?? '';
        $html .= "<tr>
                    <td>{$projet->projet->nom}</td>
                    <td>{$personnelNames}</td>
                    <td>{$tachesNom}</td>
                    <td>{$note}</td>
                  </tr>";
    }

    $html .= "</table>";

    // Load HTML into Dompdf
    $dompdf->loadHtml($html);

    // (Optional) Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF
    $dompdf->render();

    // Output as download
    $dompdf->stream("projects_$date.pdf", ["Attachment" => true]);
    exit;
}





    public function display()
{
    // Either render a view manually or redirect to index
    return $this->redirect(['action' => 'index']);
}


    /**
     * View method
     *
     * @param string|null $id Main Page id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mainPage = $this->MainPage->get($id, contain: []);
        $this->set(compact('mainPage'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mainPage = $this->MainPage->newEmptyEntity();
        if ($this->request->is('post')) {
            $mainPage = $this->MainPage->patchEntity($mainPage, $this->request->getData());
            if ($this->MainPage->save($mainPage)) {
                $this->Flash->success(__('The main page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The main page could not be saved. Please, try again.'));
        }
        $this->set(compact('mainPage'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Main Page id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mainPage = $this->MainPage->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mainPage = $this->MainPage->patchEntity($mainPage, $this->request->getData());
            if ($this->MainPage->save($mainPage)) {
                $this->Flash->success(__('The main page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The main page could not be saved. Please, try again.'));
        }
        $this->set(compact('mainPage'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Main Page id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mainPage = $this->MainPage->get($id);
        if ($this->MainPage->delete($mainPage)) {
            $this->Flash->success(__('The main page has been deleted.'));
        } else {
            $this->Flash->error(__('The main page could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
