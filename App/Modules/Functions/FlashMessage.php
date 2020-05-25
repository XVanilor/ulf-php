<?php

/**
 *
 * Use the FlashMessage composer lib through a flash() function
 *
 */
if(!function_exists("flash")){
    function flash(){
        global $flash;
        if(!$flash)
            $flash = new \Plasticbrain\FlashMessages\FlashMessages();
        return $flash;
    }
}