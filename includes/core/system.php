<?php

class System{
 
    //objects array
    private static $objects = array();
    
    /**
     * store objects
     * @param type $index
     * @param type $value
     */
    public static function Store($index,$value){
        self::$objects[$index] = $value;
    }
    
    /**
     * get objects
     * @param type $index
     * @return type
     */
    public static function Get($index){
        return self::$objects[$index];
    }
    
    public static function RedirectTo($location)
    {
        if(!headers_sent()) {
            //If headers not sent yet... then do php redirect
            header("Location: $location");
            exit;
        } else {
            //If headers are sent... do javascript redirect... if javascript disabled, do html redirect.
            $red    =  '<script type="text/javascript">';
            $red   .=  'window.location.href="'.$location.'";';
            $red   .=  '</script>';
            echo $red;

            /*---------- HTML Meta Refresh ---------*/
            $meta  =  '<noscript>';
            $meta .= '<meta http-equiv="refresh" content="0;url='.$location.'" />';
            $meta .= '</noscript>';
            echo $meta;
            exit;
        }

    }
}