<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;

/**
 * Taches Controller
 *
 * @property \App\Model\Table\TachesTable $Taches
 */
class TachesController extends AppController
{
    public function index()
    {
        $query = $this->Taches->find()
            ->contain(['Gestionprojets' => ['Projets', 'Personnels']]);
        $taches = $this->paginate($query);
        $this->set(compact('taches'));
    }

    public function view($id = null)
    {
        $tach = $this->Taches->get($id, ['contain' => ['Gestionprojets' => ['Projets', 'Personnels']]]);
        $this->set(compact('tach'));
    }

    public function add()
    {
        $tach = $this->Taches->newEmptyEntity();

        $gestionprojetsTable = TableRegistry::getTableLocator()->get('GestionProjets');

        $gestionprojetsEntities = $gestionprojetsTable->find()
            ->contain(['Projets'])   // join with Projects to get names
            ->all()
            ->toArray();

        $gestionprojets = [];
        $projectBounds = [];

        foreach ($gestionprojetsEntities as $gp) {
            $gestionprojets[$gp->id] = $gp->projet->nom; // This is the displayed name
            $projectBounds[$gp->id] = [
                'min' => $gp->projet->date_debut->format('Y-m-d'),
                'max' => $gp->projet->date_fin->format('Y-m-d')
            ];
        }

        $this->set(compact('gestionprojets', 'projectBounds'));


        if ($this->request->is('post')) {
            $tach = $this->Taches->patchEntity($tach, $this->request->getData());
            // you can set default gain if needed
            if ($tach->progres === null) {
                $tach->progres = 0;
            }
            if ($this->Taches->save($tach)) {
                $this->Flash->success(__('The task has been saved.'));
                return $this->redirect(['action' => 'index']);
                
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }

        $this->set(compact('tach', 'gestionprojets', 'projectBounds'));
    }

    public function edit($id = null)
    {
        $tach = $this->Taches->get($id);

        $gestionProjetsTable = TableRegistry::getTableLocator()->get('GestionProjets');
        $gestionprojetsEntities = $gestionProjetsTable->find()
            ->contain(['Projets'])
            ->all()
            ->toArray();

        $gestionprojets = [];
        $projectBounds = [];
        foreach ($gestionprojetsEntities as $gp) {
            if (!$gp->projet) continue;
            $gestionprojets[$gp->id] = $gp->projet->nom;
            $projectBounds[$gp->id] = [
                'min' => $gp->projet->date_debut->format('Y-m-d'),
                'max' => $gp->projet->date_fin->format('Y-m-d')
            ];
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $tach = $this->Taches->patchEntity($tach, $this->request->getData());
            if ($this->Taches->save($tach)) {
                $this->Flash->success(__('The task has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }

        $this->set(compact('tach', 'gestionprojets', 'projectBounds'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tach = $this->Taches->get($id);
        if ($this->Taches->delete($tach)) {
            $this->Flash->success(__('The task has been deleted.'));
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
