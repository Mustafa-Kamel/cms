<?php


class UsersModel {
    
    private $userInfo= array();
    
    
    /**
     * Get all users from database
     * @param type $extra
     * @return array
     */
    public function get($extra=''){
        $users= array();
        System::Get('db')->Execute("SELECT * FROM `users` {$extra}");
        if (System::Get('db')->AffectedRows()>0)
            $users= System::Get('db')->GetRows();
        return $users;
    }
    
    /**
     * Get one user from database by ID
     * @param type $id
     * @return type
     */
    public function getById($id){
        $id= (int)$id;
        $user= $this->get("WHERE `id` = $id");
        return $user[0];
    }
    
    /**
     * Get all admins from database
     * @return array
     */
    public function getAdmin(){
        return $this->get("WHERE `is_admin` = 1");
    }
    
    /**
     * Add new user to database
     * @param type $data
     * @return boolean
     */
    public function add($data){
        if (System::Get('db')->Insert('users',$data))
                return TRUE;
        return FALSE;
    }
    
    /**
     * Update user info of specific ID in database
     * @param type $id
     * @param type $data
     * @return boolean
     */
    public function update($id,$data){
        if(System::Get('db')->Update('users',$data,"WHERE `id` = $id"))
            return TRUE;
        return FALSE;
    }
    
    /**
     * Update password of specific user by ID in database
     * @param type $id
     * @param type $password
     * @return boolean
     */
    public function resetPassword($id,$password){
        if(System::Get('db')->Update('users',array('password'=> $password),"WHERE `id` = $id"))
            return TRUE;
        return FALSE;
    }
    
    /**
     * Delete one user by ID from database
     * @param type $id
     * @return boolean
     */
    public function delete($id){
        $id= (int) $id;
        if (System::Get('db')->Delete('users',"WHERE `id` = $id"))
            return TRUE;
        return FALSE;
    }
    
    /**
     * Login user
     * Check if the user of given username and password is found in database
     * @param type $username
     * @param type $password
     * @return boolean
     */
    public function login($username,$password){
        $user= $this->get("WHERE `username`= '$username' AND `password`= '$password'");
        if(count($user)>0){
            $this->userInfo= $user[0];
            return TRUE;
        }
        return FALSE;
    }
    
    /**
     * Get user info from database
     * @return array
     */
    public function getUserInfo(){
        return $this->userInfo;
    }
}