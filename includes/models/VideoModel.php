<?php


class VideoModel {
    
    /**
     * Get all videos from database
     * @param type $extra
     * @return array
     */
    public function get($extra='') {
        $videos= array();
        System::Get('db')->Execute("SELECT * FROM `youtube` {$extra}");
        if (System::Get('db')->AffectedRows()>0)
            $videos= System::Get('db')->GetRows();
        return $videos;
    }
    
    /**
     * Get one video from database by ID
     * @param type $id
     * @return type
     */
    public function getById($id) {
        $id= (int)$id;
        $video= $this->get("WHERE `id` = $id");
        return $video[0];
    }
    
    /**
     * Add new video to database
     * @param type $data
     * @return boolean
     */
    public function add($data){
        if (System::Get('db')->insert('youtube',$data))
                return TRUE;
        return FALSE;
    }
    
    /**
     * Update one video of specific ID in database
     * @param type $id
     * @param type $data
     * @return boolean
     */
    public function update($id,$data){
        if(System::Get('db')->Update('youtube',$data,"WHERE `id` = $id"))
            return TRUE;
        return FALSE;
    }
    
    /**
     * Delete one video of specific ID in database
     * @param type $id
     * @return boolean
     */
    public function delete($id){
        $id= (int) $id;
        if (System::Get('db')->Delete('youtube',"WHERE `id` = $id"))
            return TRUE;
        return FALSE;
    }
}
