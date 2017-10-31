<?php
require_once (MODELS.'videoModel.php');
class VideoController {
    private $videoModel;
    
    public function __construct(VideoModel $videoModel) {
        $this->videoModel= $videoModel;
    }
    
    public function addVideo(){
        if (isset($_POST['addVideo'])){
            // Variables
            $id=0;
            $title  =$_POST['title'];
            $desc   =$_POST['description'];
            $vid    =  $this->getVid($_POST['ytl']);
            
            // Validation
            // Data Array
            $data= array(
                'title' => $title,
                'desc'  => $desc,
                'vid'   => $vid
            );
            
            // Insert
            if ($this->videoModel->add($data)){
                System::Get('tpl')->assign('message','Video has been added successfully');
                System::Get('tpl')->draw('success');
            }  else {
                System::Get('tpl')->assign('message','Video hasn\'t been added');
            }
        }  else {
            System::Get('tpl')->draw('addvideo');
        }
    }
    
    public function updateVideo(){
        
    }
    
    public function deleteVideo(){
        
    }
    
    public function showAll(){
        $videos= $this->videoModel->get("ORDER BY `id` DESC");
        System::Get('tpl')->assign('videos',$videos);
        System::Get('tpl')->draw('videos');
    }

    public function showVideo(){
        
    }
            
    function getVid($video_id){

    // Did we get a URL?
    if ( FALSE !== filter_var( $video_id, FILTER_VALIDATE_URL ) )
    {

        // http://www.youtube.com/v/abcxyz123
        if ( FALSE !== strpos( $video_id, '/v/' ) )
        {
            list( , $video_id ) = explode( '/v/', $video_id );
        }

        // http://www.youtube.com/watch?v=abcxyz123
        else
        {
            $video_query = parse_url( $video_id, PHP_URL_QUERY );
            parse_str( $video_query, $video_params );
            $video_id = $video_params['v'];
        }

    }

    return $video_id;

}
}
