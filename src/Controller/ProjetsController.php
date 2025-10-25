<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Projets Controller
 *
 * @property \App\Model\Table\ProjetsTable $Projets
 */
class ProjetsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Projets->find();
        $projets = $this->paginate($query);

        $this->set(compact('projets'));
    }

    /**
     * View method
     *
     * @param string|null $id Projet id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projet = $this->Projets->get($id, contain: ['GestionProjets' => ['Personnels', 'Projets', 'Taches']]);
        $this->set(compact('projet'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projet = $this->Projets->newEmptyEntity();
        if ($this->request->is('post')) {
            $projet = $this->Projets->patchEntity($projet, $this->request->getData());
            if ($this->Projets->save($projet)) {
                $this->Flash->success(__('The projet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projet could not be saved. Please, try again.'));
        }
        $this->set(compact('projet'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Projet id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projet = $this->Projets->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projet = $this->Projets->patchEntity($projet, $this->request->getData());
            if ($this->Projets->save($projet)) {
                $this->Flash->success(__('The projet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projet could not be saved. Please, try again.'));
        }

        $personnels = $this->Projets->Personnels->find('list')->toArray();


        $this->set(compact('projet', 'personnels'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Projet id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projet = $this->Projets->get($id);
        if ($this->Projets->delete($projet)) {
            $this->Flash->success(__('The projet has been deleted.'));
        } else {
            $this->Flash->error(__('The projet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
