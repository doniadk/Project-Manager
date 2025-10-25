<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Personnels Controller
 *
 * @property \App\Model\Table\PersonnelsTable $Personnels
 */
class PersonnelsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Personnels->find()
            ->contain(['Fonctions']);
        $personnels = $this->paginate($query);

        $this->set(compact('personnels'));
    }

    /**
     * View method
     *
     * @param string|null $id Personnel id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $personnel = $this->Personnels->get($id, contain: ['Fonctions',
         'GestionProjets'=>['Personnels', 'Projets']
        ]);
        $this->set(compact('personnel'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $personnel = $this->Personnels->newEmptyEntity();
        if ($this->request->is('post')) {
            $personnel = $this->Personnels->patchEntity($personnel, $this->request->getData());
            if ($this->Personnels->save($personnel)) {
                $this->Flash->success(__('The personnel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The personnel could not be saved. Please, try again.'));
        }
        $fonctions = $this->Personnels->Fonctions->find('list', limit: 200)->all();
        $this->set(compact('personnel', 'fonctions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Personnel id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $personnel = $this->Personnels->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $personnel = $this->Personnels->patchEntity($personnel, $this->request->getData());
            if ($this->Personnels->save($personnel)) {
                $this->Flash->success(__('The personnel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The personnel could not be saved. Please, try again.'));
        }
        $fonctions = $this->Personnels->Fonctions->find('list', limit: 200)->all();
        $this->set(compact('personnel', 'fonctions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Personnel id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $personnel = $this->Personnels->get($id);
        if ($this->Personnels->delete($personnel)) {
            $this->Flash->success(__('The personnel has been deleted.'));
        } else {
            $this->Flash->error(__('The personnel could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
