<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;

/**
 * GestionProjets Controller
 *
 * @property \App\Model\Table\GestionProjetsTable $GestionProjets
 */
class GestionProjetsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->GestionProjets->find('all')
            ->contain(['Personnels', 'Projets', 'Taches']);
        $gestionProjets = $this->paginate($query);

        $this->set(compact('gestionProjets'));
    }

    /**
     * View method
     *
     * @param string|null $id Gestion Projet id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gestionProjet = $this->GestionProjets->get($id, contain: ['Personnels', 'Projets', 'Taches']);
        $this->set(compact('gestionProjet'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
public function add()
{
    $gestionProjet = $this->GestionProjets->newEmptyEntity();

    $projets = $this->GestionProjets->Projets->find('list', ['keyField' => 'id', 'valueField' => 'nom']);
    $personnels = $this->GestionProjets->Personnels->find('list');

    if ($this->request->is('post')) {
        // Only patch the fields that exist in your table
        $gestionProjet = $this->GestionProjets->patchEntity($gestionProjet, $this->request->getData(), [
            'associated' => ['Personnels']
        ]);

        // Debug errors if save fails
        if ($this->GestionProjets->save($gestionProjet)) {
            $this->Flash->success(__('The gestion projet has been saved.'));
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('The gestion projet could not be saved. Please, try again.'));
            debug($gestionProjet->getErrors()); // <- useful for debugging
        }
    }

    $this->set(compact('gestionProjet', 'projets', 'personnels'));
}



    /**
     * Edit method
     *
     * @param string|null $id Gestion Projet id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gestionProjet = $this->GestionProjets->get($id, ['contain' => ['Personnels']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $gestionProjet = $this->GestionProjets->patchEntity($gestionProjet, $this->request->getData(), ['associated' => ['Personnels']]);

            if ($this->GestionProjets->save($gestionProjet)) {
                $this->Flash->success(__('The gestion projet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gestion projet could not be saved. Please, try again.'));
        }
        $projets = $this->GestionProjets->Projets->find('list');
        $personnels = $this->GestionProjets->Personnels->find('list');
        $taches = $this->GestionProjets->Taches->find('list');
        $this->set(compact('gestionProjet', 'projets', 'personnels', 'taches'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Gestion Projet id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gestionProjet = $this->GestionProjets->get($id);
        if ($this->GestionProjets->delete($gestionProjet)) {
            $this->Flash->success(__('The gestion projet has been deleted.'));
        } else {
            $this->Flash->error(__('The gestion projet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
