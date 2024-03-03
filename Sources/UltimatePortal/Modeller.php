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

    function alertWarning(?string $title, string $message):string {
        global $settings;
        return '
        <div class="up-alert up-bg-warning up-flex">
		    <img alt="" src="'.$settings['default_images_url'].'/ultimate-portal/download/stop.png"/>
            <div class="up-alert-body">
                '. (!empty($title) ? '<div class="up-alert-title">'. $title .'</div>' : '') .'
		        <div class="up-alert-message">'. $message .'</div>
            </div>
	    </div>';
    }
}