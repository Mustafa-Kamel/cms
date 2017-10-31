<?php


class ArticlesCatsModel{
    
    /**
     * Get All Categories
     * @return array
     */
    public function get($extra=''){
        $cats = array();
        System::Get('db')->Execute("SELECT * FROM `articles_cats` {$extra}");
        if(System::Get('db')->AffectedRows()>0)
            $cats = System::Get ('db')->GetRows();
        return $cats;
    }
    
    /**
     * Get One category
     * @param type $cid
     * @return type
     */
    public function get_by_id($cid) {
        $cid= (int)$cid;
        $cat= $this->get("WHERE `cid`=$cid");
        return $cat[0];
    }
    
    /**
     * Add Category
     * @param type $data
     * @return boolean  true if the item is successfully inserted
     */
    public function add($data){
        if (System::Get('db')->Insert('articles_cats',$data))
                return TRUE;
        return FALSE;
        
    }
    
    /**
     * Update Category
     * @param type $cid
     * @param type $data
     * @return boolean  true if the item is successfully updated
     */
    public function update($cid,$data){
        $cid= (int)$cid;
        if (System::Get('db')->Update('articles_cats',$data,"WHERE `cid`= $cid"))
            return TRUE;
        return FALSE;
    }
    
    /**
     * Delete category
     * @param type $cid
     * @return boolean  true if the item is successfully deleted
     */
    public function delete($cid){
        $cid= (int)$cid;
        if (System::Get('db')->Delete('articles',"WHERE `cid`=$cid"))
            return TRUE;
        return FALSE;
    }
}