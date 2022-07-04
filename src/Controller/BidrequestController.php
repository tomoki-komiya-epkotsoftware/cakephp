<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bidrequest Controller
 *
 * @property \App\Model\Table\BidrequestTable $Bidrequest
 *
 * @method \App\Model\Entity\Bidrequest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BidrequestController extends AuctionBaseController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Biditems', 'Users']
        ];
        $bidrequest = $this->paginate($this->Bidrequest);

        $this->set(compact('bidrequest'));
    }

    /**
     * View method
     *
     * @param string|null $id Bidrequest id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bidrequest = $this->Bidrequest->get($id, [
            'contain' => ['Biditems', 'Users']
        ]);

        $this->set('bidrequest', $bidrequest);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bidrequest = $this->Bidrequest->newEntity();
        if ($this->request->is('post')) {
            $bidrequest = $this->Bidrequest->patchEntity($bidrequest, $this->request->getData());
            if ($this->Bidrequest->save($bidrequest)) {
                $this->Flash->success(__('The bidrequest has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bidrequest could not be saved. Please, try again.'));
        }
        $biditems = $this->Bidrequest->Biditems->find('list', ['limit' => 200]);
        $users = $this->Bidrequest->Users->find('list', ['limit' => 200]);
        $this->set(compact('bidrequest', 'biditems', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bidrequest id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bidrequest = $this->Bidrequest->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bidrequest = $this->Bidrequest->patchEntity($bidrequest, $this->request->getData());
            if ($this->Bidrequest->save($bidrequest)) {
                $this->Flash->success(__('The bidrequest has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bidrequest could not be saved. Please, try again.'));
        }
        $biditems = $this->Bidrequest->Biditems->find('list', ['limit' => 200]);
        $users = $this->Bidrequest->Users->find('list', ['limit' => 200]);
        $this->set(compact('bidrequest', 'biditems', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bidrequest id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bidrequest = $this->Bidrequest->get($id);
        if ($this->Bidrequest->delete($bidrequest)) {
            $this->Flash->success(__('The bidrequest has been deleted.'));
        } else {
            $this->Flash->error(__('The bidrequest could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
