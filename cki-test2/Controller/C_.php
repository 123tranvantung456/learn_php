<?php
  session_start();  
  include_once("../Model/M_.php");
  include_once("../Model/E_.php");
  include_once("../Model/E_1.php");
  include_once("../Model/M_1.php");

  class C_{
    private $model;
    private $model1;
    public function __construct(){
      $this->model = new M_();
      $this->model1 = new M_1();
      $this->handleAction();
    }

    public function handleAction(){

      if(isset($_GET['action'])){
        $action = $_GET['action'];
        switch($action){
          case 'login-failed':
            $this->loginFailed();
            break;  
          case 'login':
            $this->login();
            break;  
          case 'logout':
            $this->logout();
            break;
          case 'list':
            $this->listAll();
            break;    
          case 'search':
            $this->search();  
          case 'add':
              $this->add();
              break;
          case 'update':
              $this->update();
              break;
          case 'updatepost':
              $this->updateSubmit();
              break;    
          case 'delete':
              $this->delete();
              break;
          case 'check-exist-one' :
              $this->checkExist(); 
              break;   
          default:
              echo "Hành động không hợp lệ.";
              break;
            }
      }else {
        $this->listAll();
      }
    }

    public function login(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userLogin =  $this->model->login($username, $password);
        echo $userLogin->getOne();
        if($userLogin){  
          $_SESSION['user'] = $userLogin->getOne();
          header("Location: ../Controller/C_.php?action=search");
          exit();
        }else{
          header("Location: ../Controller/C_.php?action=login-failed");
        }
      } else{
        include_once("../View/Login.php"); 
      }
    }

    public function logout(){
      session_destroy();
      header("Location: ../Controller/C_.php?action=login");
      exit();
    }

    public function loginFailed(){
      include_once("../View/Invalid.php");
    }

    public function listAll(){
      // $this->checkLogin();

      // input search
      // if (isset($_GET['search'])) {
      //   $two = $_GET['search'];
      // }
      // else {
      //   $two="";
      // }
      // $beans = $this->model->search($two);

      // form  search
      $searchType = isset($_GET['searchType']) ? $_GET['searchType'] : '';
      $data = isset($_GET['data']) ? $_GET['data'] : '';
      $beans = $this->model->search1($searchType, $data);
      include_once("../View/List.php");
    }

    public function search(){
      // $this->checkLogin();
      $searchType = isset($_GET['searchType']) ? $_GET['searchType'] : '';
      $data = isset($_GET['data']) ? $_GET['data'] : '';
      $beans = $this->model->search1($searchType, $data);
      include_once("../View/List.php");
    }

    public function add(){
      // $this->checkLogin();
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $one = $_POST['one'];
        $two = $_POST['two'];
        $three = $_POST['three'];
        $four = $_POST['four'];
        $five = $_POST['five'];
        $six = $_POST['six'];
        $bean = new E_($one, $two, $three, $four, 
          new E_1($five, ""), $six
        );
        $this->model->Add($bean);
        header("Location: ../Controller/C_.php?action=list");
        exit();
      } else{
        $bean1s = $this->model1->getAll();
        include_once("../View/Add.php");
      }
    }

    public function update(){
      // $this->checkLogin();
      if (isset($_GET['one'])) {
        $one = $_GET['one'];
        $bean = $this->model->getDetail($one);
        $bean1s = $this->model1->getAll();
        if ($bean) {
          include_once("../View/Update.php");
        } else {
            echo "not found.";
        }
      }
    }

    public function updateSubmit()
    {
      // $this->checkLogin();
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $one = $_POST['one'];
        $two = $_POST['two'];
        $three = $_POST['three'];
        $four = $_POST['four'];
        $five = $_POST['five'];
        $six = $_POST['six'];
        $bean = new E_($one, $two, $three, $four, 
          new E_1($five, ""), $six
        );
        $this->model->update($bean);
        header("Location: ../Controller/C_.php?action=list");
        exit();
      } else {
      include_once("../View/Update.php");
      }   
    }

    public function delete(){
      // $this->checkLogin();
      if (isset($_GET['one'])) {
        $one = $_GET['one'];
        $this->model->delete($one);
        header("Location: ../Controller/C_.php?action=list");
        exit();
    }
    }

    public function checkExist() {
      // $this->checkLogin();
      if (isset($_GET['one'])) {
          $one = $_GET['one'];
          $isExists = $this->model->checkExists($one);
          if($isExists){
            echo "exists";
          } else {
              echo "not_exists";
          }
      }
  }

    private function checkLogin() {
      if (!isset($_SESSION['user'])) {
          header("Location: ../Controller/C_.php?action=login");
          exit();
      }
    }
    
  }

  new C_();
?>