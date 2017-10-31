<?php
require_once (MODELS.'UsersModel.php');
class UsersController {
    
    private $usersModel;
    
    public function __construct(UsersModel $usersModel) {
        $this->usersModel= $usersModel;
    }
    
    /*---------------------Admin Area---------------------*/
    /**
     * Get all the users from database and view them in the users.html page
     */
    public function getAllUsers(){
        $users= $this->usersModel->get();
        System::Get('tpl')->assign('users',$users);
        System::Get('tpl')->draw('users');
    }
    
    /**
     * Add new user
     */
    public function addUser(){
        if (isset($_POST['AddUser'])){
            // Variables
            $name       = $_POST['name'];
            $username   = $_POST['username'];
            $password   = password($_POST['password']);
            $email      = $_POST['email'];
            $admin      = $_POST['admin'];
            
            // Validation
            
            // data array
            $data= array(
            'name'      => $name,
            'username'  => $username,
            'password'  => $password,
            'email'     => $email,
            'is_admin'  => $admin
            );
            
            // insert
            if($this->usersModel->add($data)){
                System::Get('tpl')->assign('message','User has been added successfully.');
                System::Get('tpl')->draw('success');
            }  else {
                System::Get('tpl')->assign('message','Unexpectedly an error has been occured, the user hasn\'t been added.');
                System::Get('tpl')->draw('error');
            }
        }  else {
            System::Get('tpl')->draw('adduser');
        }
    }
    
    /**
     * Update existing user
     */
    public function updateUser(){
        if(isset($_POST['UpdateUser'])){
            // Confirming update
            // Variables
            $id         = 0;
            $id         = $_POST['id'];
            $name       = $_POST['name'];
            $username   = $_POST['username'];
            $email      = $_POST['email'];
            $admin      = $_POST['admin'];
            
            // Validation
            
            // Data array
            $data= array(
                'name'      => $name,
                'username'  => $username,
                'email'     => $email,
                'is_admin'  => $admin
            );
            
            // Update
            if ($this->usersModel->update($id, $data)){
                System::Get('tpl')->assign('message','User has been updated successfully.');
                System::Get('tpl')->draw('success');
            }  else {
                System::Get('tpl')->assign('message','User hasn\'t been updated.');
                System::Get('tpl')->draw('error');
            }
        }  else {
            // View update page and the user to be updated
            $id= 0;
            if (isset($_GET['id'])&& (int)$_GET['id']){
                $id= $_GET['id'];
                $user= $this->usersModel->getById($id);
                if (count($user)>0){
                    System::Get('tpl')->assign($user);
                    System::Get('tpl')->draw('updateUser');
                }  else {
                    System::Get('tpl')->assign('message','User is not found.');
                    System::Get('tpl')->draw('error');
                }
            }  else {
            System::Get('tpl')->assign('message','Invalid ID, No user chosen.');
            System::Get('tpl')->draw('error');
            }
        }
    }

     /**
     * Delete existing user
     */
    public function deleteUser(){
        $id= 0;
        if ($id= $_GET['id']&& (int)$_GET['id']){
            $id= $_GET['id'];
            if ($this->usersModel->delete($id)){
                System::Get('tpl')->assign('message','User has been deleted successfully.');
                System::Get('tpl')->draw('success');
            }  else {
                System::Get('tpl')->assign('message','User is not found.');
                System::Get('tpl')->draw('error');
            }
        }  else {
            System::Get('tpl')->assign('message','Invalid id, No user chosen.');
            System::Get('tpl')->draw('error');
        }
    }
    
    /**
     * Accommplish the login operation of a user then redirect him to the index.php [the home of control panel page] after checking his info Vs. info in the database
     */
    public function login(){
        System::Get('tpl')->assign('error','');
        if (isset($_POST['login'])){
            // Variables
            $username= $_POST['username'];
            $password= $_POST['password'];
            // Validation
            
            // Check database
            if ($this->usersModel->login($username, password($password))){
                $userData= $this->usersModel->getUserInfo();
                $_SESSION['username']   = $userData['username'];
                $_SESSION['admin']      = $userData['is_admin'];
                System::RedirectTo('index.php');
            }  else {
                System::Get('tpl')->assign('error','Invalid Data');
                System::Get('tpl')->draw('login');
            }
        }  else {
            System::Get('tpl')->draw('login');
        }
    }
}
