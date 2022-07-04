<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Bidrequest;
use Cake\Event\Event;
use Exception;

class AuctionController extends AuctionBaseController
{
  //デフォルトテーブルを使わない
  public $useTable = false;

  //初期化処理
  public function initialize()
  {
    parent::initialize();
    $this->loadComponent('paginator');
    //必要なモデルをすべてロード
    $this->loadModel('Users');
    $this->loadModel('Biditems');
    $this->loadModel('Bidrequest');
    $this->loadModel('Bidinfo');
    $this->loadModel('Bidmessages');
    //ログインしているユーザー情報をauthuserに設定
    $this->set('authuser', $this->Auth->user());
    //レイアウトをauctionに変更
    $this->viewBuilder()->setLayout('auction');
  }

  //トップページ
  public function index()
  {
    //ページネーションでBiditemsを所得
    $auction = $this->paginate('Biditems', [
      'order' => ['endtime'=>'desc'],
      'limit' => 10]);
      $this->set(compact('auction'));
  }

  //商品情報の表示
  public function view($id = null)
  {
    //$idのBiditemsを取得
    $biditem = $this->Biditems->get($id, [
      'contain' => ['Users', 'Bidinfo', 'Bidinfo.users']
    ]);
    //オークション終了時の処理
    if($biditem->emdtime < new \DateTime('now') and $biditem->finished == 0){
      //finishedを1にして変更
      $biditem->finished = 1;
      $this->Biditems->save($biditem);
      //Bidinfoを作成する
      $bidinfo = $this->Bidinfo->newEntity();
      // Bidinfoのbiditem_idに$idを設定
      $bidinfo->biditem_id = $id;
      //最高金額のBidrequestを検索
      $bidrequest = $this->Bidrequests->find('all', [
        'conditions' => ['biditem_id'=>$id],
        'contain' => ['Users'],
        'order' => ['price'=>'desc']])->first();
        //Bidrequestが得られた時の処理
        if(!empty($bidrequest)){
          //Bidinfoの各種プロパティーを設定して保存する
          $bidinfo->user_id = $bidrequest->user->id;
          $bidinfo->user = $bidrequest->user;
          $bidinfo->price = $bidrequest->price;
          $this->Bidinfo->save($bidinfo);
        }
        //Biditemのbidinfoに＄bidinfoを設定
        $biditem->bidinfo = $bidinfo;
    }
    // Bidrequestsからbiditem_idが$idのものを取得
    $bidrequests = $this->Bidrequest->find('all', [
      'conditions' => ['biditem_id'=>$id],
      'contain' => ['Users'],
      'order' => ['price'=>'desc']])->toArray();
      //オブジェクト類をテンプレートように設定
      $this->set(compact('biditem', 'bidrequests'));
  }

  //出品する処理
  public function add()
  {
    //Biditemインスタンスを用意
    $biditem = $this->Biditems->newEntity();
    //Post送信時の処理
    if($this->request->is('post')) {
      //biditemにフォームの送信内容を反映
      $biditem = $this->Biditems->patchEntity($biditem, $this->request->getData());
      //$biditemに保存する
      if($this->Biditems->save($biditem)){
        //成功時のメッセージ
        $this->Flash->success(__('保存しました。'));
        //トップページに移動
        return $this->redirect(['action' => 'index']);
      }
      //失敗時のメッセージ
      $this->Flash->error(__('保存に失敗しました。もう一度入力してください。'));
    }
    //値の保管
    $this->set(compact('biditem'));
  }

  //入札時の処理
  public function bid($biditem_id = null)
  {
    //入札用のBidrequestインスタンスを用意
    $bidrequest = $this->Bidrequests->newEntity();
    //$bidrequestにbiditem_idとuser_idを設定
    $bidrequest->biditem_id = $biditem_id;
    $bidrequest->user_id = $this->Auth->user('id');
    //Post送信時の処理
    if($this->request->is('post')) {
      //bidrequestにフォームの送信内容を反映
      $bidrequest = $this->Bidrequests->patchEntity($bidrequest, $this->request->getData());
      //$bidrequestに保存する
      if($this->Bidrequests->save($bidrequest)){
        //成功時のメッセージ
        $this->Flash->success(__('入札を送信しました。'));
        //トップページに移動
        return $this->redirect(['action' => 'view', $biditem_id]);
      }
      //失敗時のメッセージ
      $this->Flash->error(__('入札に失敗しました。もう一度入力してください。'));
    }
    //　$biditem_idの＄Biditemを取得する
    $biditem = $this->Biditems->get($biditem_id);
    $this->set(compact('bidrequest', 'biditem'));
  }

  //落札者とのメッセージ
  public function msg($bidinfo_id = null)
  {
    // Bidmessageを新たに準備
    $bidmsg = $this->Bidmessages->newEntity();
      //Post送信時の処理
      if($this->request->is('post')) {
        //送信されたフォームで$bidmsgを更新
        $bidmsg = $this->Bidmessages->patchEntity($bidmsg, $this->request->getData());
        //$bidmsgを保存する
        if($this->Bidmessages->save($bidmsg)){
          //成功時のメッセージ
          $this->Flash->success(__('保存しました。'));
        }else {
          //失敗時のメッセージ
          $this->Flash->error(__('保存に失敗しました。もう一度入力してください。'));
        }
      }
      try { // $bidinfo_idからBidonfoを取得する
      $bidinfo = $this->Bidinfo->get($bidinfo_id, ['contain'=>['Biditems']]);
      } catch(Exception $e) {
        $bidinfo = null;
      }
      //Bidmessgeをbidinfo_idとuser_idで検索
      $bidmsgs = $this->Bidmessages->find('all',[
        'conditions'=>['bidinfo_id'=>$bidinfo_id],
        'contain'=>['Users'],
        'order'=>['created'=>'desc']]);
        $this->set(compact('bidnsgs','bidinfo','bidmsg'));
  }

  //落札情報の表示
  public function home() {
    //自分が落札したBidinfoをページネーションで取得
    $bidinfo = $this->paginate('Bidinfo', [
      'conditions'=>['Bidinfo.user_id'=>$this->Auth->user('id')],
      'contain'=>['Users', 'Biditems'],
      'order'=>['created'=>'desc'],
      'limit'=>10])->toArray();
      $this->set(compact('bidinfo'));
  }

  //出品情報の表示
  public function home2(){
    //自分が出品したBiditemをページネーションで取得
    $biditems = $this->paginate('Biditems', [
      'conditions'=>['Biditems.user_id'=>$this->Auth->user('id')],
      'contain'=>['Users', 'Bidinfo'],
      'order'=>['created'=>'desc'],
      'limit'=>10])->toArray();
      $this->set(compact('biditems'));
  }
}