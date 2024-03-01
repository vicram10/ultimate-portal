<?php

namespace UltimatePortal;

class Modeller extends CoreBase {
    function getDefaultImagesDir():string{
        global $settings;
        return $settings['default_theme_dir'] . '/' . basename($settings['default_images_url']);
    }
    function getStarImage(?int $star = null):?string {
        global $settings;
        
        $imagesDir = $this->getDefaultImagesDir();
        if ($star && file_exists($imagesDir.'/ultimate-portal/icons/'.$star.'.gif')){            
            return '<img src="'.$settings['default_images_url'].'/ultimate-portal/icons/'.$star.'.gif" width="22px" alt="" />';
        }
        return null;
    }
}