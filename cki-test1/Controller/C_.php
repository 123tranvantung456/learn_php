<?php
  // session_start();  
  include_once("../Model/M_.php");
  include_once("../Model/E_.php");
  include_once("../Model/E_1.php");
  include_once("../Model/M_1.php");

  class C_{
    private $model;
    private $model1;
    public function __construct(){
      $this->model = new M_();
      $this->modelRole = new M_1();
      $this->handleAction();
    }

    public function handleAction(){

      if(isset($_GET['action'])){
        $action = $_GET['action'];
        switch($action){
          case 'list':
            $this->listAll();
            break;
          case 'login-failed':
            $this->loginFailed();
            break;  
          case 'login':
            $this->login();
            break;  
          case 'logout':
            $this->logout();
            break;
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
          case 'check-exist' :
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

    public function listAll(){
      // $this->checkLogin();

      if (isset($_GET['search'])) {
        $name = $_GET['search'];
      }
      else {
        $name="";
      }
      
      $users = $this->model->searchUser($name);
      include_once("../View/UserList.php");
    }

    public function login(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userLogin =  $this->model->login($username, $password);
        if($userLogin){
          $_SESSION['user'] = serialize($userLogin);
          header("Location: ../Controller/C_User.php?action=list");
          exit();
        }else{
          header("Location: ../Controller/C_User.php?action=login-failed");
        }
      } else{
        include_once("../View/Login.php"); 
      }
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $roleId = 1;
        $user = new E_User($username, $password, $firstName, $lastName, 
          new E_Role($roleId, "")
        );
        $this->model->AddUser($user);
        header("Location: ../Controller/C_User.php?action=list");
        exit();
      } else{
        $roles = $this->modelRole->getAllRole();
        include_once("../View/Register.php");
      }
    }

    public function update(){
      $this->checkLogin();
      if (isset($_GET['username'])) {
        $username = $_GET['username'];
        $user = $this->model->getUserDetail($username);
        $roles = $this->modelRole->getAllRole();
        if ($user) {
          include_once("../View/Update.php");
        } else {
            echo "user not found.";
        }
      }
    }

    public function updateSubmit()
    {
      $this->checkLogin();
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $roleId = $_POST['roleId'];
        $user = new E_User($username, "", $firstName, $lastName, 
          new E_Role($roleId, "")
        );
        $this->model->updateUser($user);

        header("Location: ../Controller/C_User.php?action=list");
        exit();
      } else {
      include_once("../View/Update.php");
      }   
    }

    public function delete(){
      $this->checkLogin();
      if (isset($_GET['username'])) {
        $username = $_GET['username'];
        $this->model->deleteStudent($username);
        header("Location: ../Controller/C_User.php?action=list");
        exit();
    }
    }

    public function checkExist() {
      if (isset($_GET['username'])) {
          $username = $_GET['username'];
          $isExists = $this->model->checkUserExists($username);
          if($isExists){
            echo "exists";
          } else {
              echo "not_exists";
          }
      }
  }

    public function logout(){
      session_destroy();
      header("Location: ../Controller/C_User.php?action=login");
      exit();
    }

    public function loginFailed(){
      include_once("../View/Invalid.php");
    }

    private function checkLogin() {
      if (!isset($_SESSION['user'])) {
          header("Location: ../Controller/C_User.php?action=login");
          exit();
      }
    }
    
  }

  new C_User();
?>