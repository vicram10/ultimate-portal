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

    function printBlockAdmin(array $block){
        global $txt, $context;
        $slug = $block['slug']; // it's the position
        $model = '
        <span class="floatleft">'. $block['title'] .'</span>
        <span class="floatright">
            <select name="'.$block['position_form'].'">';
            foreach(['left','center','right'] as $position){
                $model .= '
                <option value="'. $position .'"'. ($position == $slug ? ' selected' : '') .'>
                    '.$txt['ultport_blocks_'.$position].'
                </option>';

            }	
            $model .= '
            </select>
            <select name="'.$block['progressive_form'].'">
                <option value="'. $block['progressive'] .'">'. $block['progressive'] .'</option>
                '. $context[$slug.'-progoption'] .'
            </select>
            '. $this->getGreatCheckbox(name:$block['active_form'],value:'checked',isChecked:$block['active']) .'
        </span>';

        return $model;
    }

    function getGreatCheckbox(string $name, string $value, bool $isChecked = false, ?string $id = null):string{
        return '
        <span class="up-checkbox" style="padding-left:10px;padding-right:10px;">
            <input type="checkbox" '. ($id ? 'id="'.$id.'"' : null) .' name="'. $name .'" class="up-checkbox-input" '.($isChecked ? 'checked="checked"' : '').' value="'.$value.'" />
        </span>';
    }
}