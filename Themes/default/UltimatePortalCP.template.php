<?php
/**
* @package Ultimate Portal
* @version 1.0.0
* @author vicram10
* @copyright 2024
*/

function template_preferences_main()
{
	global $context, $scripturl, $txt, $settings;
	global $ultimateportalSettings;

	//Header Main
	echo '
	<div class="cat_bar">
		<h3 class="catbg">
			', $txt['ultport_admin_preferences_title'] . ' - ' . $txt['ultport_preferences_title'] ,'
		</h3>				
	</div>
	<div class="information">	
		', $txt['main_description'] ,'
	</div>';
	//Rapid Links
	$rapidLinks = [
		'preferences' => [
			'url' => $scripturl .'?action=admin;area=preferences;sa=gral-settings;' . $context['session_var'].'=' . $context['session_id'],
			'image' => $settings['default_theme_url'] .'/images/ultimate-portal/admin-main/preferences.png',
			'title' => $txt['ultport_preferences_title'],
			'description' => $txt['ultport_admin_gral_settings_description'],
			'visible' => true,
		],
		'blocks' => [
			'url' => $scripturl .'?action=admin;area=ultimate_portal_blocks;' . $context['session_var'].'=' . $context['session_id'],
			'image' => $settings['default_theme_url'] .'/images/ultimate-portal/admin-main/blocks.png',
			'title' => $txt['main_blocks_title'],
			'description' => $txt['main_blocks_description'],
			'visible' => true,
		],		
		'user-posts' => [
			'url' => $scripturl .'?action=admin;area=user-posts;' . $context['session_var'].'=' . $context['session_id'],
			'image' => $settings['default_theme_url'] .'/images/ultimate-portal/admin-main/user-posts.png',
			'title' => $txt['main_user_posts_title'],
			'description' => $txt['main_user_posts_description'],
			'visible' => !empty($ultimateportalSettings['user_posts_enable']),
		],		
		'up-news' => [
			'url' => $scripturl .'?action=admin;area=up-news;' . $context['session_var'].'=' . $context['session_id'],
			'image' => $settings['default_theme_url'] .'/images/ultimate-portal/admin-main/news.png',
			'title' => $txt['main_news_title'],
			'description' => $txt['main_news_description'],
			'visible' => !empty($ultimateportalSettings['up_news_enable']),
		],
		'board-news' => [
			'url' => $scripturl .'?action=admin;area=board-news;' . $context['session_var'].'=' . $context['session_id'],
			'image' => $settings['default_theme_url'] .'/images/ultimate-portal/admin-main/board-news.png',
			'title' => $txt['main_bnews_title'],
			'description' => $txt['main_bnews_description'],
			'visible' => true,
		],
		'download' => [
			'url' => $scripturl .'?action=admin;area=download;' . $context['session_var'].'=' . $context['session_id'],
			'image' => $settings['default_theme_url'] .'/images/ultimate-portal/admin-main/download.png',
			'title' => $txt['main_download_title'],
			'description' => $txt['main_download_description'],
			'visible' => !empty($ultimateportalSettings['download_enable']),
		],
		'internal-page' => [
			'url' => $scripturl .'?action=admin;area=internal-page;' . $context['session_var'].'=' . $context['session_id'],
			'image' => $settings['default_theme_url'] .'/images/ultimate-portal/admin-main/internal-page.png',
			'title' => $txt['main_ipage_title'],
			'description' => $txt['main_ipage_description'],
			'visible' => !empty($ultimateportalSettings['ipage_enable']),
		],
		'up-affiliates' => [
			'url' => $scripturl .'?action=admin;area=up-affiliates;' . $context['session_var'].'=' . $context['session_id'],
			'image' => $settings['default_theme_url'] .'/images/ultimate-portal/admin-main/up-affiliates.png',
			'title' => $txt['main_affiliates_title'],
			'description' => $txt['main_affiliates_description'],
			'visible' => true,
		],
		'up-aboutus' => [
			'url' => $scripturl .'?action=admin;area=up-aboutus;' . $context['session_var'].'=' . $context['session_id'],
			'image' => $settings['default_theme_url'] .'/images/ultimate-portal/admin-main/up-aboutus.png',
			'title' => $txt['main_about_title'],
			'description' => $txt['main_about_description'],
			'visible' => !empty($ultimateportalSettings['about_us_enable']),
		],
		'up-faq' => [
			'url' => $scripturl .'?action=admin;area=up-faq;' . $context['session_var'].'=' . $context['session_id'],
			'image' => $settings['default_theme_url'] .'/images/ultimate-portal/admin-main/up-faq.png',
			'title' => $txt['main_faq_title'],
			'description' => $txt['main_faq_description'],
			'visible' => !empty($ultimateportalSettings['faq_enable']),
		],
	];

	echo '<fieldset class="windowbg">
		<legend>', $txt['ultport_admin_main_title'] ,'</legend>
		<div class="up-rapid-links">';
	foreach($rapidLinks as $link){
		if ($link['visible']){
			echo '
			<div>			
				<img src="', $link['image'] ,'" />
				<div class="up-link-title"><a href="', $link['url'] ,'">', $link['title'] ,'</a></div>
				<p>', $link['description'] ,'</p>
			</div>';
		}
	}
	echo '</div></fieldset>';
		
	//Credits
	echo '
	<div class="cat_bar">
		<h3 class="catbg">
			<img width="20" height="20" style="vertical-align:middle" alt="" src="', $settings['default_theme_url'] ,'/images/ultimate-portal/admin-main/credits.png" />&nbsp;', $txt['main_credits_title'] ,'
		</h3>
	</div>
	<p class="information">
		', $txt['main_credits_description'] ,'
	</p>';
		
}

//Show the Ultimate Portal - Area: Preferences / Section: Gral Settings
function template_preferences_gral_settings()
{
	global $context, $scripturl, $txt, $settings;
	global $ultimateportalSettings, $upCaller;
	$modeller = $upCaller->ssi()->getModeller();
	
	echo'
	<form method="post" action="', $scripturl, '?action=admin;area=preferences;sa=gral-settings" accept-charset="', $context['character_set'], '">								
		<div class="cat_bar">
			<h3 class="catbg"><img alt="',$txt['ultport_admin_gral_settings_sect_principal'],'" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/gral-settings.png"/>&nbsp;', $txt['ultport_admin_gral_settings_sect_principal'], '</h3>
		</div>
		<div class="windowbg noup">
			<dl class="settings">
				<dt>', $txt['ultport_admin_gral_settings_portal_enable'], '</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'ultimate_portal_enable',value:'on',isChecked:!empty($ultimateportalSettings['ultimate_portal_enable'])) ,'
				</dd>			
			</dl>
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_gral_settings_portal_title'], '
				</dt>
				<dd>
					<input type="text" name="ultimate_portal_home_title" size="50" maxlength="100" ',!empty($ultimateportalSettings['ultimate_portal_home_title']) ? 'value="'.$ultimateportalSettings['ultimate_portal_home_title'].'"' : '','/>
				</dd>
			</dl>	
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_gral_settings_favicons'], '
				</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'favicons',value:'on',isChecked:!empty($ultimateportalSettings['favicons'])) ,'

				</dd>
			</dl>
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_gral_settings_use_curve'], '
				</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'up_use_curve_variation',value:'on',isChecked:!empty($ultimateportalSettings['up_use_curve_variation'])) ,'
				</dd>
			</dl>
		</div>

		<div class="cat_bar" style="padding-top:10px;">
			<h3 class="catbg">
				<img alt="',$txt['ultport_admin_gral_settings_sect_view_portal'],'" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/view-portal.png"/>&nbsp;', $txt['ultport_admin_gral_settings_sect_view_portal'], '
			</h3>
		</div>
		<div class="windowbg noup">
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_gral_settings_height_col_left'] , '
				</dt>
				<dd>
					<input type="text" name="ultimate_portal_width_col_left" size="3" maxlength="4" ',!empty($ultimateportalSettings['ultimate_portal_width_col_left']) ? 'value="'.$ultimateportalSettings['ultimate_portal_width_col_left'].'"' : '','/>
				</dd>
			</dl>	
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_gral_settings_height_col_center'] , '
				</dt>
				<dd>
					<input type="text" name="ultimate_portal_width_col_center" size="3" maxlength="4" ',!empty($ultimateportalSettings['ultimate_portal_width_col_center']) ? 'value="'.$ultimateportalSettings['ultimate_portal_width_col_center'].'"' : '','/>
				</dd>
			</dl>	
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_gral_settings_height_col_right'] , '
				</dt>
				<dd>
					<input type="text" name="ultimate_portal_width_col_right" size="3" maxlength="4" ',!empty($ultimateportalSettings['ultimate_portal_width_col_right']) ? 'value="'.$ultimateportalSettings['ultimate_portal_width_col_right'].'"' : '','/>
				</dd>
			</dl>
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_gral_settings_enable_portal_col_left'], '
				</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'ultimate_portal_enable_col_left',value:'on',isChecked:!empty($ultimateportalSettings['ultimate_portal_enable_col_left'])) ,'
				</dd>
			</dl>					
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_gral_settings_enable_portal_col_right'], '
				</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'ultimate_portal_enable_col_right',value:'on',isChecked:!empty($ultimateportalSettings['ultimate_portal_enable_col_right'])) ,'
				</dd>
			</dl>					
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_gral_settings_enable_icons'], '
				</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'ultimate_portal_enable_icons',value:'on',isChecked:!empty($ultimateportalSettings['ultimate_portal_enable_icons'])) ,'
				</dd>
			</dl>					
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_gral_settings_icons_extention'], '
				</dt>
				<dd>
					<select name="ultimate_portal_icons_extention" size="1">';
					foreach(['.png', '.jpg', '.gif', '.bpm'] as $icon){
						echo '<option value="', $icon ,'" ' ,($ultimateportalSettings['ultimate_portal_icons_extention'] == $icon) ? 'selected="selected"' : '','>', $icon ,'</option>';
					}
					echo '
					</select>
				</dd>
			</dl>
		</div>

		<div class="cat_bar">
			<h3 class="catbg">
				<img alt="',$txt['ultport_admin_gral_settings_sect_view_forum'],'" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/view-forum.png"/>&nbsp;', $txt['ultport_admin_gral_settings_sect_view_forum'], '
			</h3>
		</div>
		<div class="windowbg noup">			
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_view_forum_enable_col_left'], '
				</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'up_forum_enable_col_left',value:'on',isChecked:!empty($ultimateportalSettings['up_forum_enable_col_left'])) ,'
				</dd>
			</dl>
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_view_forum_enable_col_right'], '
				</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'up_forum_enable_col_right',value:'on',isChecked:!empty($ultimateportalSettings['up_forum_enable_col_right'])) ,'
				</dd>
			</dl>	
			<div class="title_bar">
				<h3 class="titlebg">
					<img alt="',$txt['ultport_exconfig_title'],'" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/config.png"/>&nbsp;', $txt['ultport_exconfig_title'], '
				</h3>
			</div>
			<dl class="settings">
				<dt>
					', $txt['ultport_rso_title'], '
				</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'up_reduce_site_overload',value:'on',isChecked:!empty($ultimateportalSettings['up_reduce_site_overload'])) ,'
				</dd>
			</dl>				
			<dl class="settings">
				<dt>
					', $txt['ultport_collapse_left_right'], '
				</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'up_left_right_collapse',value:'on',isChecked:!empty($ultimateportalSettings['up_left_right_collapse'])) ,'
				</dd>
			</dl>
		</div>
		
		<div style="width:100%">			
			<input type="hidden" name="sc" value="', $context['session_id'], '" />
			<button type="submit" name="save" class="up-btn">
				<i class="bi bi-save"></i> ',$txt['ultport_button_save'],'
			</button>
		</div>
	</form>';

}

//Show the Ultimate Portal - Area: Preferences / Section: Lang Maintenance
function template_preferences_lang_maintenance()
{
	global $context, $scripturl, $txt, $settings, $upCaller;
	$modeller = $upCaller->ssi()->getModeller();

	echo $modeller->alertWarning(title:null, message: $txt['ultport_admin_lang_maintenance_warning']);

	echo '
	<form method="post" action="', $scripturl, '?action=admin;area=preferences;sa=lang-edit" accept-charset="', $context['character_set'], '">												
		<div class="cat_bar">
			<h3 class="catbg">
				<img alt="',$txt['ultport_admin_lang_maintenance_admin'],'" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/lang-edit.png"/> ', $txt['ultport_admin_lang_maintenance_admin'], '
			</h3>
		</div>
		<div class="windowbg noup">			
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_lang_maintenance_admin_edit_language'], '
				</dt>
				<dd>
					', $context['ult_port_langs'], '
				</dd>
			</dl>
			<div style="width:100%">				
				<span class="floatright">
					<input type="hidden" name="sc" value="', $context['session_id'], '" />
					<button type="submit" name="editing" class="up-btn">
						<i class="bi bi-floppy-fill"></i> ',$txt['ultport_button_edit'],'
					</button>
				</span>
			</div>
		</div>		
	</form>';

	//Duplicate Files?
	echo'
	<form style="margin-top: 20px;" method="post" action="', $scripturl, '?action=admin;area=preferences;sa=lang-edit" accept-charset="', $context['character_set'], '">												
		<div class="cat_bar">			
			<h3 class="catbg">
				<img alt="',$txt['lang_maintenance_duplicate_title'],'" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/copy.png"/>&nbsp;', $txt['lang_maintenance_duplicate_title'], '
			</h3>
		</div>
		<div class="windowbg noup">
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_select_lang_duplicate'], '
				</dt>
				<dd>
					', $context['ult_port_langs'], '
				</dd>
			</dl>
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_lang_duplicate_new'], '
				</dt>
				<dd>
					<input type="text" name="new_file" size="40" value="" />
				</dd>
			</dl>
			<div class="w-100">
				<span class="floatright">
					<input type="hidden" name="sc" value="', $context['session_id'], '" />
					<button type="submit" name="duplicate" class="up-btn">
						<i class="bi bi-plus-circle-fill"></i> ',$txt['ultport_button_add'],'
					</button>
				</span>
			</div>
		</div>
	</form>';
		
}

//Show the Ultimate Portal - Area: Preferences / Section: Lang Maintenance
function template_preferences_lang_edit()
{
	global $context, $scripturl, $txt, $settings;

	echo'
	<form method="post" action="', $scripturl, '?action=admin;area=preferences;sa=lang-edit" accept-charset="', $context['character_set'], '">												
		<div class="cat_bar">
			<h3 class="catbg">						
				<img alt="',$txt['ultport_admin_lang_maintenance_edit_info'],'" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/info.png"/>&nbsp;', $txt['ultport_admin_lang_maintenance_edit_info'], ' [', $context['file'] ,']
			</h3>
		</div>
		<div class="windowbg">			
			<div class="windowbg2 w-100">
				<textarea id="content" name="content" rows="20" cols="80" class="w-100">', $context['content_htmlspecialchars'] ,'</textarea>
			</div>			
			<div class="w-100" style="padding-top:10px;">	
				<input type="hidden" name="file" value="', $context['file'] ,'" />				
				<input type="hidden" name="sc" value="', $context['session_id'], '" />
				<button type="submit" name="save" class="up-btn" style="padding-left:5px;padding-right:5px;padding-bottom:5px;">
					<i class="bi bi-floppy-fill"></i> ',$txt['ultport_button_edit'],'
				</button>
			</div>
		</div>
	</form>';
	
}

//Show the Ultimate Portal - Area: Preferences / Section: Permissions Settings
function template_preferences_permissions_settings()
{
	global $context, $scripturl, $txt, $settings, $upCaller;

	echo	'
	<form method="post" action="', $scripturl, '?action=admin;area=preferences;sa=permissions-settings" accept-charset="', $context['character_set'], '">												
		<div class="cat_bar">
			<h3 class="catbg">
			<img alt="',$txt['ultport_admin_permissions_settings_title'],'" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/perm.png"/> ', $txt['ultport_admin_permissions_settings_title'], '
			</h3>		
		</div>
		<div class="windowbg noup">
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_perms_groups'], '
				</dt>			
				<dd>
					<select name="group">';
					foreach ($context['groups'] as $group){	
						echo '
						<option '. (!empty($group['selected']) ? $group['selected'] : '') .' value="'. $group['id_group'] .'">'. $group['group_name'] .'</option>';
					}	
					echo '
					</select>	
				</dd>
			</dl>
		</div>
		<div class="w-100">
			<input type="hidden" name="sc" value="', $context['session_id'], '" />											
			<button type="submit" name="view-perms" class="up-btn" style="padding-left:5px;padding-right:5px;padding-bottom:5px;">
				<i class="bi bi-floppy-fill"></i> ',$txt['ultport_button_edit'],'
			</button>
		</div>
	</form>';
	
	if (!empty($context['view-perms']))	
	{
		echo'
		<div style="padding-top:15px;">
			<form method="post" action="', $scripturl, '?action=admin;area=preferences;sa=permissions-settings" accept-charset="', $context['character_set'], '">												
				<div class="cat_bar">
					<h3 class="catbg">
						', $txt['ultport_admin_permissions_settings_subtitle'], '
					</h3>
				</div>
				<div class="windowbg noup">';		
				$modeller = $upCaller->ssi()->getModeller();
				foreach ($context['permissions'] as $permissions)
				{	
					echo '
					<dl class="settings">
						<dt>
							'. $permissions['text-name'] .'
						</dt>
						<dd>
							', $modeller->getGreatCheckbox(name:$permissions['name'],value:'on',isChecked: !empty($context[$permissions['name']]['value']))  ,'
						</dd>
					</dl>';
				}	

			echo '					
				</div>
				<div class="w-100">
					<input type="hidden" name="group_selected" value="', $context['group-selected'] ,'" />					
					<input type="hidden" name="sc" value="', $context['session_id'], '" />						
					<button type="submit" name="save" class="up-btn" style="padding-left:5px;padding-right:5px;padding-bottom:5px;">
						<i class="bi bi-check-circle-fill"></i> ',$txt['ultport_button_save'],'
					</button>
				</div>
			</form>
		</div>';

	}	
	
}

//Show the Ultimate Portal - Area: Preferences / Section: Portal Menu Settings
function template_preferences_main_links()
{
	global $context, $txt, $settings, $scripturl, $ultimateportalSettings, $upCaller;
	$modeller = $upCaller->ssi()->getModeller();

	echo "
	    <script type=\"text/javascript\">
			function makesurelink() {
				if (confirm('".$txt['ultport_admin_portal_menu_delet_confirm']."')) {
					return true;
				} else {
					return false;
				}
			}
	    </script>";
	
	echo	'
	<div class="cat_bar">
		<h3 class="catbg">
			<img alt="',$txt['ultport_admin_portal_menu_title'],'" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/link.png"/> ', $txt['ultport_admin_portal_menu_title'], '
		</h3>
	</div>		
	<div class="windowbg noup" style="padding-top: 10px; padding-bottom:10px;">
		<form method="post" action="', $scripturl, '?action=admin;area=preferences;sa=save-portal-menu" accept-charset="', $context['character_set'], '">												
			<table class="w-100 table">
				<thead>
					<tr>
						<th align="center">									
							', $txt['ultport_admin_mainlinks_icon'], '
						</th>			
						<th align="center">	
							', $txt['ultport_admin_mainlinks_title'], '
						</th>			
						<th align="center">	
							', $txt['ultport_admin_mainlinks_url'], '
						</th>			
						<th align="center">	
							', $txt['ultport_admin_mainlinks_position'], '
						</th>			
						<th align="center">	
							', $txt['ultport_admin_mainlinks_edit'], '
						</th>			
						<th align="center">	
							', $txt['ultport_admin_mainlinks_delete'], '
						</th>			
						<th align="center">	
							', $txt['ultport_admin_mainlinks_active'], '
						</th>			
						<th align="center">	
							', $txt['ultport_admin_mainlinks_top_menu'], '
						</th>
					</tr>			
				</thead>
				<tbody>';	
				
			foreach($context['main-links'] as $main_link)
			{	
				echo '
				<tr>
					<td class="',$main_link['activestyle'],'" width="1%" align="center">
						', $main_link['icon'] ,'
					</td>
					<td class="',$main_link['activestyle'],'" width="15%" align="left">
						', $main_link['title'] ,'
					</td>
					<td class="',$main_link['activestyle'],'" width="60%" align="left">
						', $main_link['url'] ,'
					</td>
					<td class="',$main_link['activestyle'],'" width="1%" align="center">
						<input type="text" name="', $main_link['position_form'] ,'" size="4" value="', !empty($main_link['position']) ? $main_link['position'] : '' , '" />
					</td>
					<td class="',$main_link['activestyle'],'" width="1%" align="center">
						<strong><a style="color:blue" href="', $scripturl, '?action=admin;area=preferences;sa=edit-portal-menu;id=', $main_link['id'] ,';' . $context['session_var'].'=', $context['session_id'], '">', $txt['ultport_button_edit'] ,'</a></strong>
					</td>
					<td class="',$main_link['activestyle'],'" width="1%" align="center">
						<strong><a onclick="return makesurelink()" style="color:red" href="', $scripturl, '?action=admin;area=preferences;sa=delete-portal-menu;id=', $main_link['id'] ,';' . $context['session_var'].'=', $context['session_id'], '">', $txt['ultport_button_delete'] ,'</a></strong>
					</td>
					<td class="',$main_link['activestyle'],'" width="1%" align="center">
						<input type="checkbox" name="',  $main_link['active_form'] ,'" value="1" ', $main_link['active'] ,' />
					</td>
					<td class="',$main_link['activestyle'],'" width="17%" align="center">
						<input type="checkbox" name="',  $main_link['top_menu_form'] ,'" value="1" ', $main_link['top_menu'] ,' />
					</td>
				</tr>';				
			}
				
					
		echo '</tbody>
			</table>
			<div class="w-100">
				<span class="floatright">
					<input type="hidden" name="sc" value="', $context['session_id'], '" />
					<input type="hidden" name="save-menu" value="ok" />						
					<button type="submit" name="save" class="up-btn">
						<i class="bi bi-save"></i> ',$txt['ultport_button_save'],'
					</button>
				</span>
			</div>
		</form>
	</div>';

	//Add Main Link
	echo	'
	<div style="padding-top: 10px; padding-bottom:10px;">
		<form method="post" action="', $scripturl, '?action=admin;area=preferences;sa=add-portal-menu" accept-charset="', $context['character_set'], '">												
			<div class="cat_bar">				
				<h3 class="catbg">	
					<img alt="',$txt['ultport_admin_portal_menu_add_title'],'" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/link_add.png"/>&nbsp;', $txt['ultport_admin_portal_menu_add_title'], '
				</h3>
			</div>
			<div class="windowbg noup">
				<dl class="settings">
					<dt>
						', $txt['ultport_admin_mainlinks_icon'], '
					</dt>			
					<dd>
						<input type="text" name="icon" size="52" />
					</dd>			
				</dl>
				<dl class="settings">
					<dt>
						', $txt['ultport_admin_mainlinks_title'], '
					</dt>			
					<dd>
						<input type="text" name="title" size="52" />
					</dd>			
				</dl>			
				<dl class="settings">
					<dt>
						', $txt['ultport_admin_mainlinks_url'], '
					</dt>			
					<dd>
						<input value="https://" type="text" name="url" size="52" />
					</dd>			
				</dl>			
				<dl class="settings">
					<dt>
						', $txt['ultport_admin_mainlinks_position'], '
					</dt>			
					<dd>
						<input type="text" name="position" value="', $context['last_position'] ,'" size="2" />
					</dd>			
				</dl>
				<dl class="settings">
					<dt>
						', $txt['ultport_admin_mainlinks_active'], '
					</dt>			
					<dd>
						', $modeller->getGreatCheckbox(name:'active',value:'1') ,'
					</dd>			
				</dl>
				<div class="w-100">
					<span class="floatright">
						<input type="hidden" name="add-menu" value="ok" />	
						<input type="hidden" name="sc" value="', $context['session_id'], '" />
						<button type="submit" name="add" class="up-btn">
							<i class="bi bi-save"></i> ',$txt['ultport_button_add'],'
						</button>
					</span>
				</div>
			</div>
		</form>
	</div>';	
}

//Show the Ultimate Portal - Area: Preferences / Section: Edit Portal Menu Settings
function template_preferences_edit_main_links()
{
	global $context, $txt, $settings, $scripturl, $ultimateportalSettings, $upCaller;
	$modeller = $upCaller->ssi()->getModeller();
	
	//Add Main Link
	echo	'
	<form method="post" action="', $scripturl, '?action=admin;area=preferences;sa=edit-portal-menu" accept-charset="', $context['character_set'], '">												
		<div class="cat_bar">
			<h3 class="catbg">
				<img alt="',$txt['ultport_admin_portal_menu_edit_title'],'" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/link_edit.png"/> ', $txt['ultport_admin_portal_menu_edit_title'], '
			</h3>
		</div>
		<div class="windowbg noup">';
	
		foreach($context['edit-main-links'] as $edit_main_link)
		{		
		echo	'				
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_mainlinks_icon'], '
				</dt>
				<dd>
					<input type="hidden" name="id" value="', $edit_main_link['id'] ,'" />						
					<input type="text" name="icon" value="', $edit_main_link['icon'] ,'" size="65" />
				<dd>
			</dl>
			<dl class="settings">
				<td width="30%" class="windowbg2">									
					', $txt['ultport_admin_mainlinks_title'], '
				</dt>
				<dd>
					<input type="text" name="title" value="', $edit_main_link['title'] ,'" size="65" />
				<dd>
			</dl>			
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_mainlinks_url'], '
				</dt>
				<dd>
					<input type="text" name="url" value="', $edit_main_link['url'] ,'" size="65" />
				<dd>
			</dl>			
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_mainlinks_position'], '
				</dt>
				<dd>
					<input type="text" name="position" value="', $edit_main_link['position'] ,'" size="2" />
				<dd>
			</dl>			
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_mainlinks_active'], '
				</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'active',value:'on',isChecked:!empty($edit_main_link['active'])) ,'
				<dd>
			</dl>';
	}		
			
	echo 	'	
		</div>	
		<div class="w-100">
			<input type="hidden" name="save" value="ok" />	
			<input type="hidden" name="sc" value="', $context['session_id'], '" />
			<button type="submit" name="edit" class="up-btn">
				<i class="bi bi-floppy-fill"></i> ',$txt['ultport_button_edit'],'
			</button>
		</div>
	</form>';
	
}

//Show the Ultimate Portal - Area: Preferences / Section: SEO
function template_preferences_seo()
{
	global $context, $txt, $settings, $scripturl, $ultimateportalSettings;
	
	//Add Main Link
	echo	'
	<form method="post" action="', $scripturl, '?action=admin;area=preferences;sa=seo" accept-charset="', $context['character_set'], '">												
		<div class="cat_bar">
			<h3 class="catbg">	
				<img alt="',$txt['ultport_seo_title'],'" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/config.png"/> ', $txt['seo_robots_title'], '
			</h3>
		</div>	
		<div class="windowbg noup">		
			<div>', $txt['seo_robots_txt'], '</div>
			<div class="w-100">
				<strong>', $txt['seo_robots_added'] ,'</strong><br/>
				<textarea id="robots_add" name="robots_add" rows="20" cols="80" class="w-100">
					', !empty($context['robots_txt']) ? $context['robots_txt'] : '' ,'
				</textarea>
			</div>				
			<div class="w-100" style="padding-top: 15px;">	
				<input type="hidden" name="sc" value="', $context['session_id'], '" />
				<button type="submit" name="save_robot" class="up-btn">
					<i class="bi bi-save"></i> ',$txt['ultport_button_save'],'
				</button>
			</div>
		</div>
		<div class="cat_bar">
			<h3 class="catbg">
				<img alt="',$txt['ultport_seo_title'],'" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/config.png"/> ', $txt['seo_config'], '
			</h3>
		</div>
		<div class="windowbg noup">			
			<dl class="settings">
				<dt>
					', $txt['seo_title_key_word'], '
				</dt>
				<dd>
					<input type="text" name="seo_title_keyword" size="50" maxlength="200" ',!empty($ultimateportalSettings['seo_title_keyword']) ? 'value="'.$ultimateportalSettings['seo_title_keyword'].'"' : '','/>				
				</dd>			
			</dl>
			<dl class="settings">
				<dt>
					', $txt['seo_google_analytics'], '
				</dt>
				<dd>
					<input type="text" name="seo_google_analytics" size="20" maxlength="50" ',!empty($ultimateportalSettings['seo_google_analytics']) ? 'value="'.$ultimateportalSettings['seo_google_analytics'].'"' : '','/>
				</dd>			
			</dl>
			<div class="w-100">	
				<input type="hidden" name="sc" value="', $context['session_id'], '" />
				<button type="submit" name="save_seo_config" class="up-btn">
					<i class="bi bi-save"></i> ',$txt['ultport_button_save'],'
				</button>
			</div>
		</div>
		<div class="cat_bar">
			<h3 class="catbg">
				<img alt="',$txt['seo_google_verification_code_title'],'" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/config.png"/> ', $txt['seo_google_verification_code_title'], '
			</h3>
		</div>
		<div class="windowbg noup">
			<dl class="settings">
				<dt>
					', $txt['seo_google_verification_code'], '
				</dt>
				<dd>
					<input type="text" name="seo_google_verification_code" size="50" maxlength="200" />';
				if(!empty($ultimateportalSettings['seo_google_verification_code']))	
				{
					$verifications_codes = explode(',', $ultimateportalSettings['seo_google_verification_code']);
					$count = count($verifications_codes);
					echo '	
					<div align="left">
						<ul style="list-style-image:none;list-style-position:outside;list-style-type:none;">';
					for($i = 0; $i <= $count; $i++)
					{
						if(!empty($verifications_codes[$i]))
						{
							echo '	
							<li style="background:transparent url(', $settings['default_theme_url'] ,'/images/ultimate-portal/download/menu.png) no-repeat scroll 2px 50%;padding-left:16px;">', $verifications_codes[$i] ,'.html&nbsp;<a href="', $scripturl ,'?action=admin;area=preferences;sa=seo;file=', $verifications_codes[$i] ,';' . $context['session_var'].'=', $context['session_id'] ,'"><img src="', $settings['default_theme_url'] ,'/images/ultimate-portal/delete.png" alt="', $txt['ultport_button_delete'] ,'" title="', $txt['ultport_button_delete'] ,'" /></a></li>';	
						}
					}
					echo '
						</ul>
					</div>';
				}
	echo '				
				</dd>			
			</dl>	
			<div class="w-100">				
				<input type="hidden" name="sc" value="', $context['session_id'], '" />
				<button type="submit" name="save_seo_google_verification_code" class="up-btn">
					<i class="bi bi-save"></i> ',$txt['ultport_button_save'],'
				</button>
			</tr>
		</table>		
	</form>';	
}

function template_mb_main()
{
	global $context, $txt;

	echo "
	<script type=\"text/javascript\">
		function makesurelink() {
			if (confirm('".$txt['ultport_mb_delete']."')) {
				return true;
			} else {
				return false;
			}
		}
	</script>";

	echo '
	<div id="admincenter">
		<div class="title_bar">
			<h3 class="titlebg">
				', $txt['ultport_mb_title'] ,' - ', $txt['ultport_mb_main'] ,'
			</h3>
		</div>
		<div class="manage-blocks windowbg noup">';
			if($context['mb_view']){
				echo '<ul class="nolist">';
				foreach($context['multiblocks'] as $mb)
				{
					echo '
					<li class="windowbg">
						<span class="floatleft fw-bold">
							', $mb['title'] ,'
							<div class="up-text-muted up-small">', $mb['position'] ,'</div>
						</span>
						<span class="floatright">
							', $mb['edit'] ,' ', $mb['delete'] ,'
						</span>
					</li>';
				}
				echo '
				</ul>';
			}else{
				echo '<div class="noticebox"></div>';
			}
			echo '
		</div>	
	</div>';
}

function template_mb_add()
{
	global $context, $scripturl, $txt, $settings;
	global $upCaller;
	$modeller = $upCaller->ssi()->getModeller();

	echo '
	<div id="admincenter">
		<form name="mbadd" method="post" action="', $scripturl, '?action=admin;area=multiblock;sa=add" accept-charset="', $context['character_set'], '">
			<div class="title_bar">
				<h3 class="titlebg">
					', $txt['ultport_mb_title'] ,' - ', $txt['ultport_mb_add'] ,' - ', $txt['ultport_mb_step'] ,' 1
				</h3>
			</div>
			<div class="windowbg">
				<dl class="settings">
					<dt>
						', $txt['ultport_mb_enable'] ,'
					</dt>
					<dd>
						', $modeller->getGreatCheckbox(name:'enable',value:'1') ,'
					</dd>						
					<dt>
						', $txt['ultport_mb_title2'] ,'
					</dt>
					<dd>
						<input type="text" name="title" value="" class="input_text" size="70"/>
					</dd>';
					
					$position = explode('|', $txt['ultport_mb_position']);
					
					echo '
					<dt>
						', $position[0] ,'
					</dt>
					<dd>
						<select id="position" name="position">
							<option value="header">', trim($position[1]) ,'</option>
							<option value="footer">', trim($position[2]) ,'</option>
						</select>
					</dd>
					<dt>
						', $txt['ultport_mb_blocks'] ,'
					</dt>
					<dd>';				
					foreach($context['blocks'] as $blocks){
						echo '
						<div>
							',$modeller->getGreatCheckbox(name:'block[]',value:$blocks['id']),'
							<span class="up-small">',$blocks['title'],'</span>
						</div>';
					}				
					echo '
					</dd>';				
					$design = explode('|', $txt['ultport_mb_design']);
					echo '	
					<dt>
						', $design[0] ,'
					</dt>
					<dd>
						<div style="width:30%;float:left;text-align:left" class="up-radio">
							<label>
								<input type="radio" value="1-2" name="design"> 
								<span>', $design[1] ,'</span>
							</label>
							<img alt="" id="design_image" src="', $settings['default_images_url'], '/ultimate-portal/1-row-2-columns.png" width="100" height="100" align="top" />
						</div>
						<div style="width:30%;float:left;text-align:left" class="up-radio">
							<label>
								<input type="radio" value="2-1" name="design"> 
								<span>', $design[2] ,'</span>
							</label>
							<img alt="" id="design_image" src="', $settings['default_images_url'], '/ultimate-portal/2-rows-1-column.png" width="100" height="100" align="top" />
						</div>
						<div style="width:30%;float:left;text-align:left" class="up-radio">
							<label>
								<input type="radio" value="3-1" name="design"> 
								<span>', $design[3] ,'</span>
							</label>
							<img alt="" id="design_image" src="', $settings['default_images_url'], '/ultimate-portal/3-rows-1-column.png" width="100" height="100" align="top" />
						</div>
					</dd>';
					
				echo '
				<dt>
					', $txt['ultport_mbk_collapse'] ,'
				</dt>
				<dd>
					',$modeller->getGreatCheckbox(name:'mbk_collapse',value:'1'),'
				</dd>											
				<dt>
					', $txt['ultport_mbk_style'] ,'
				</dt>
				<dd>
					',$modeller->getGreatCheckbox(name:'mbk_style',value:'1'),'
				</dd>											
				<dt>
					', $txt['ultport_mbk_title'] ,'
				</dt>
				<dd>
					',$modeller->getGreatCheckbox(name:'mbk_title',value:'1'),'
				</dd>											
				</dl>
				<div class="righttext">
					<input type="hidden" name="step" value="1" />
					<input type="hidden" name="sc" value="', $context['session_id'] ,'" />
					<button type="submit" name="next" class="up-btn">
						<i class="bi bi-arrow-right"></i> ', $txt['ultport_mb_next'], '
					</button>
				</div>
			</div><!-- div windowbg -->
		</form>	
	</div><!-- div admincenter -->
	<br class="clear">';
}

function template_mb_add_1()
{
	global $context, $scripturl, $txt, $upCaller;
	$modeller = $upCaller->ssi()->getModeller();

	echo '
	<div id="admincenter">
		<form name="mbadd" method="post" action="', $scripturl, '?action=admin;area=multiblock;sa=add" accept-charset="', $context['character_set'], '">
			<div class="title_bar">
				<h3 class="titlebg">
					', $txt['ultport_mb_title'] ,' - ', $txt['ultport_mb_add'] ,' - ', $txt['ultport_mb_step'] ,' 2				
				</h3>
			</div>
			<div class="manage-blocks windowbg noup">
				<div style="padding-bottom:10px;">
					', $modeller->alertWarning(null,$txt['ultport_mb_organization'])  ,'
				</div>
				<ul class="nolist">';
				$bk_selected = explode(',', $context['id_blocks']);
				foreach($context['blocks'] as $blocks){
					if (in_array($blocks['id'], $bk_selected)){
						echo '
						<li class="windowbg">							
							<span class="floatleft">
								', $blocks['title'],' (',$txt['ultport_mbk_position'],')
							</span>
							<span class="floatright">';
							switch($context['design']){
							case "1-2":
								echo '
								<div class="up-radio">
									<label>
										<input type="radio" value="c1" name="mbk_view_', $blocks['id'] ,'"> 
										<span>', $txt['ultport_mb_column'] ,' 1</span>
									</label>
									<label>
										<input type="radio" value="c2" name="mbk_view_', $blocks['id'] ,'"> 
										<span>', $txt['ultport_mb_column'] ,' 2</span>
									</label>
								</div>';
								break;
							case "2-1":
								echo '
								<div class="up-radio">
									<label>
										<input type="radio" value="r1" name="mbk_view_', $blocks['id'] ,'">
										<span>', $txt['ultport_mb_row'] ,' 1</span>
									</label>
									<label>
										<input type="radio" value="r2" name="mbk_view_', $blocks['id'] ,'">
										<span>', $txt['ultport_mb_row'] ,' 2</span>
									</label>
								</div>';
								break;
							case "3-1":
								echo '
								<div class="up-radio">
									<label>
										<input type="radio" value="r1" name="mbk_view_', $blocks['id'] ,'"> 
										<span>', $txt['ultport_mb_row'] ,' 1</span>
									</label>
									<label>
										<input type="radio" value="r2" name="mbk_view_', $blocks['id'] ,'"> 
										<span>', $txt['ultport_mb_row'] ,' 2</span>
									</label>
									<label>
										<input type="radio" value="r3" name="mbk_view_', $blocks['id'] ,'"> 
										<span>', $txt['ultport_mb_row'] ,' 3</span>
									</label>
								</div>';
								break;
							default:
								echo $modeller->alertError(null,$txt['up_not_founds']);
								break;
							}															
						echo '
						</li>';						
					}
				}
				echo '
				</ul>
			</div>
			<div class="righttext">
				<input type="hidden" name="title" value="', $context['title'] ,'" />
				<input type="hidden" name="position" value="', $context['position'] ,'" />
				<input type="hidden" name="mbk_title" value="', $context['mbk_title'] ,'" />
				<input type="hidden" name="mbk_collapse" value="', $context['mbk_collapse'] ,'" />
				<input type="hidden" name="mbk_style" value="', $context['mbk_style'] ,'" />
				<input type="hidden" name="enable" value="', $context['enable'] ,'" />
				<input type="hidden" name="blocks" value="',  $context['id_blocks'] ,'" />
				<input type="hidden" name="design" value="',  $context['design'] ,'" />
				<input type="hidden" name="sc" value="', $context['session_id'] ,'" />
				<button type="submit" name="save" class="up-btn">
					<i class="bi bi-save"></i> ', $txt['ultport_button_save'], '
				</button>
			</div>
		</form>	
	</div><!-- div admincenter -->
	<br class="clear">';
}

function template_mb_edit()
{
	global $context, $scripturl, $txt, $settings;
	global $upCaller;
	$modeller = $upCaller->ssi()->getModeller();

	echo '
	<div id="admincenter">
		<form name="mbedit" method="post" action="', $scripturl, '?action=admin;area=multiblock;sa=edit;id=', $context['idmbk'] ,'" accept-charset="', $context['character_set'], '">
			<div class="title_bar">
				<h3 class="titlebg">
					', $txt['ultport_mb_title'] ,' - ', $txt['ultport_mb_edit'] ,' - ', $context['multiblocks'][$context['idmbk']]['title'] ,' - ', $txt['ultport_mb_step'] ,' 1
				</h3>
			</div>
			<div class="windowbg noup">				
				<dl class="settings">
					<dt>
						', $txt['ultport_mb_enable'] ,'
					</dt>
					<dd>
						', $modeller->getGreatCheckbox(name:'enable',value:'1',isChecked:!empty($context['multiblocks'][$context['idmbk']]['enable'])) ,'
					</dd>						
					<dt>
						', $txt['ultport_mb_title2'] ,'
					</dt>
					<dd>
						<input type="text" name="title" value="', $context['multiblocks'][$context['idmbk']]['title'] ,'" class="input_text" size="70"/>
					</dd>';
					
					$position = explode('|', $txt['ultport_mb_position']);
					
					echo '
					<dt>
						', $position[0] ,'
					</dt>
					<dd>
						<select id="position" name="position">
							<option ', $context['multiblocks'][$context['idmbk']]['position']=='header' ? 'selected="selected"' : '' ,' value="header">', trim($position[1]) ,'</option>
							<option ', $context['multiblocks'][$context['idmbk']]['position']=='footer' ? 'selected="selected"' : '' ,' value="footer">', trim($position[2]) ,'</option>
						</select>
					</dd>
					<dt>
						', $txt['ultport_mb_blocks'] ,'
					</dt>
					<dd>';
				
					$id_blocks = explode(',',$context['multiblocks'][$context['idmbk']]['blocks']);
					foreach($context['blocks'] as $blocks){
						echo '
						<div>
							',$modeller->getGreatCheckbox(name:'block[]',value:$blocks['id'],isChecked:in_array($blocks['id'], $id_blocks)),' <span class="up-small">', $blocks['title'] ,'</span>
						</div>';
					}
				
					echo '
					</dd>';
				
					$design = explode('|', $txt['ultport_mb_design']);
					echo '	
					<dt>
						', $design[0] ,'
					</dt>
					<dd>						
						<div style="width:30%;float:left;text-align:left" class="up-radio">
							<label>
								<input ', trim($context['multiblocks'][$context['idmbk']]['design'])=='1-2' ? 'checked="checked"' : '' ,' type="radio" value="1-2" name="design">
								<span>', $design[1] ,'</span>
							</label>
							<div>
								<img alt="" id="design_image" src="', $settings['default_images_url'], '/ultimate-portal/1-row-2-columns.png" width="100" height="100" align="top" />
							</div>
						</div>
						<div style="width:30%;float:left;text-align:left" class="up-radio">
							<label>
								<input ', trim($context['multiblocks'][$context['idmbk']]['design'])=='2-1' ? 'checked="checked"' : '' ,' type="radio" value="2-1" name="design">
								<span>', $design[2] ,'</span>
							</label>
							<div>
								<img alt="" id="design_image" src="', $settings['default_images_url'], '/ultimate-portal/2-rows-1-column.png" width="100" height="100" align="top" />
							</div>
						</div>
						<div style="width:30%;float:left;text-align:left" class="up-radio">
							<label>
								<input ', trim($context['multiblocks'][$context['idmbk']]['design'])=='3-1' ? 'checked="checked"' : '' ,' type="radio" value="3-1" name="design">
								<span>', $design[3] ,'</span>
							</label>
							<div>
								<img alt="" id="design_image" src="', $settings['default_images_url'], '/ultimate-portal/3-rows-1-column.png" width="100" height="100" align="top" />
							</div>
						</div>
					</dd>';
					
					echo '
					<dt>
						', $txt['ultport_mbk_collapse'] ,'
					</dt>
					<dd>
						', $modeller->getGreatCheckbox(name:'mbk_collapse',value:'1',isChecked:!empty($context['multiblocks'][$context['idmbk']]['mbk_collapse'])) ,'
					</dd>											
					<dt>
						', $txt['ultport_mbk_style'] ,'
					</dt>
					<dd>
						', $modeller->getGreatCheckbox(name:'mbk_collapse',value:'1',isChecked:!empty($context['multiblocks'][$context['idmbk']]['mbk_style'])) ,'
					</dd>											
					<dt>
						', $txt['ultport_mbk_title'] ,'
					</dt>
					<dd>
						', $modeller->getGreatCheckbox(name:'mbk_title',value:'1',isChecked:!empty($context['multiblocks'][$context['idmbk']]['mbk_title'])) ,'
					</dd>											
				</dl>
				<div class="righttext">
					<input type="hidden" name="step" value="1" />
					<input type="hidden" name="sc" value="', $context['session_id'] ,'" />
					<button type="submit" name="next" class="up-btn">
						<i class="bi bi-arrow-right"></i> ', $txt['ultport_mb_next'], '
					</button>
				</div>				
			</div><!-- div windowbg -->
		</form>	
	</div><!-- div admincenter -->
	<br class="clear">';
}

function template_mb_edit_1()
{
	global $context, $scripturl, $txt;
	global $upCaller;

	$modeller = $upCaller->ssi()->getModeller();

	echo '
	<div id="admincenter">
		<form name="mbadd" method="post" action="', $scripturl, '?action=admin;area=multiblock;sa=edit;id=', $context['idmbk'] ,'" accept-charset="', $context['character_set'], '">
			<div class="title_bar">
				<h3 class="titlebg">
					', $txt['ultport_mb_title'] ,' - ', $txt['ultport_mb_add'] ,' - ', $txt['ultport_mb_step'] ,' 2				
				</h3>
			</div>
			<div class="manage-blocks windowbg noup">
				<div style="padding-bottom:10px;">
					', $modeller->alertWarning(null,$txt['ultport_mb_organization'])  ,'
				</div>
				<ul class="nolist">';
				$bk_selected = explode(',', $context['id_blocks']);
				$alternate = true;
				$i = 1; //flag
				$column = 2;
				foreach($context['blocks'] as $blocks){
					if (in_array($blocks['id'], $bk_selected)){
						echo '
						<li class="windowbg">							
							<span class="floatleft">
								', $blocks['title'],' (',$txt['ultport_mbk_position'],')
							</span>
							<span class="floatright">';
							switch($context['design']){
							case "1-2":
								echo '
								<div class="up-radio">
									<label>
										<input type="radio" value="c1" name="mbk_view_', $blocks['id'] ,'" ', !empty($context['oblocks'][$blocks['id']]['mbk_view']) ? ($context['oblocks'][$blocks['id']]['mbk_view']=='c1' ? 'checked="checked"' : '') : '' ,'> 
										<span>', $txt['ultport_mb_column'] ,' 1</span>
									</label>
									<label>
										<input type="radio" value="c2" name="mbk_view_', $blocks['id'] ,'" ', !empty($context['oblocks'][$blocks['id']]['mbk_view']) ? ($context['oblocks'][$blocks['id']]['mbk_view']=='c2' ? 'checked="checked"' : '') : '' ,'> 
										<span>', $txt['ultport_mb_column'] ,' 2</span>
									</label>
								</div>';
								break;
							case "2-1":
								echo '
								<div class="up-radio">
									<label>
										<input type="radio" value="r1" name="mbk_view_', $blocks['id'] ,'" ', !empty($context['oblocks'][$blocks['id']]['mbk_view']) ? ($context['oblocks'][$blocks['id']]['mbk_view']=='r1' ? 'checked="checked"' : '') : '' ,'>
										<span>', $txt['ultport_mb_row'] ,' 1</span>
									</label>
									<label>
										<input type="radio" value="r2" name="mbk_view_', $blocks['id'] ,'" ', !empty($context['oblocks'][$blocks['id']]['mbk_view']) ? ($context['oblocks'][$blocks['id']]['mbk_view']=='r2' ? 'checked="checked"' : '') : '' ,'>
										<span>', $txt['ultport_mb_row'] ,' 2</span>
									</label>
								</div>';
								break;
							case "3-1":
								echo '
								<div class="up-radio">
									<label>
										<input type="radio" value="r1" name="mbk_view_', $blocks['id'] ,'" ', !empty($context['oblocks'][$blocks['id']]['mbk_view']) ? ($context['oblocks'][$blocks['id']]['mbk_view']=='r1' ? 'checked="checked"' : '') : '' ,'> 
										<span>', $txt['ultport_mb_row'] ,' 1</span>
									</label>
									<label>
										<input type="radio" value="r2" name="mbk_view_', $blocks['id'] ,'" ', !empty($context['oblocks'][$blocks['id']]['mbk_view']) ? ($context['oblocks'][$blocks['id']]['mbk_view']=='r2' ? 'checked="checked"' : '') : '' ,'> 
										<span>', $txt['ultport_mb_row'] ,' 2</span>
									</label>
									<label>
										<input type="radio" value="r3" name="mbk_view_', $blocks['id'] ,'" ', !empty($context['oblocks'][$blocks['id']]['mbk_view']) ? ($context['oblocks'][$blocks['id']]['mbk_view']=='r3' ? 'checked="checked"' : '') : '' ,'> 
										<span>', $txt['ultport_mb_row'] ,' 3</span>
									</label>
								</div>';
								break;
							default:
								echo $modeller->alertError(null,$txt['up_not_founds']);
								break;
							}															
						echo '
						</li>';						
					}
				}
				echo '
				</ul>
			</div>
			<div class="righttext">
				<input type="hidden" name="title" value="', $context['title'] ,'" />
				<input type="hidden" name="position" value="', $context['position'] ,'" />
				<input type="hidden" name="mbk_title" value="', $context['mbk_title'] ,'" />
				<input type="hidden" name="mbk_collapse" value="', $context['mbk_collapse'] ,'" />
				<input type="hidden" name="mbk_style" value="', $context['mbk_style'] ,'" />
				<input type="hidden" name="enable" value="', $context['enable'] ,'" />
				<input type="hidden" name="blocks" value="',  $context['id_blocks'] ,'" />
				<input type="hidden" name="design" value="',  $context['design'] ,'" />
				<input type="hidden" name="sc" value="', $context['session_id'] ,'" />
				<button type="submit" name="save" class="up-btn">
					<i class="bi bi-save"></i> ', $txt['ultport_button_save'], '
				</button>
			</div>
		</form>	
	</div><!-- div admincenter -->
	<br class="clear">';
}

?>