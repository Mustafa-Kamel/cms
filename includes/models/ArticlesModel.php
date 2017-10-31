<?php

class ArticlesModel{
    
    /**
     * Get All Articles
     * @return array
     */
    public function get($extra=''){
        $articles = array();
        System::Get('db')->Execute("SELECT `articles`.*,`articles_cats`.`cname` FROM `articles` LEFT JOIN `articles_cats` ON `articles`.`cid`=`articles_cats`.`cid` {$extra}");
        if(System::Get('db')->AffectedRows()>0)
            $articles = System::Get ('db')->GetRows();
        return $articles;
    }
    
    /**
     * Get One Article
     * @param type $id
     * @return type
     */
    public function get_by_id($id) {
        $id= (int)$id;
        $article= $this->get("WHERE `articles`.`id`=$id");
        return $article[0];
    }
    
    /**
     * Get Articles by Category
     * @param type $cid
     * @return type
     */
    public function get_by_cat($cid){
        $cid= (int)$cid;
        return $this->get("WHERE `articles`.`cid`=$cid");
    }
    
    /**
     * Get limited number of Last Articles 
     * @param type $num
     * @return type
     */
    public function get_last($num){
        $num= (int)$num;
        return $this->get("ORDER BY `articles`.`id` DESC LIMIT $num");
    }
    
    /**
     * Add Article
     * @param type $data
     * @return boolean  true if the item is successfully inserted
     */
    public function add($data){
        if (System::Get('db')->Insert('articles',$data))
                return TRUE;
        return FALSE;
        
    }
    
    /**
     * Update Article
     * @param type $id
     * @param type $data
     * @return boolean  true if the item is successfully updated
     */
    public function update($id,$data){
        $id= (int)$id;
        if (System::Get('db')->Update('articles',$data,"WHERE `id`= $id"))
            return TRUE;
        return FALSE;
    }
    
    /**
     * Delete Article
     * @param type $id
     * @return boolean  true if the item is successfully deleted
     */
    public function delete($id){
        $id= (int)$id;
        if (System::Get('db')->Delete('articles',"WHERE `id`=$id"))
            return TRUE;
        return FALSE;
    }
}