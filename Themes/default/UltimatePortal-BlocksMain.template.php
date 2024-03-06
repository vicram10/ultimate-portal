<?php
/**
* @package Ultimate Portal
* @version 1.0.0
* @author vicram10
* @copyright 2024
*/

function template_positions()
{
	global $context, $txt, $settings, $scripturl, $upCaller;
	$modeller = $upCaller->ssi()->getModeller();
	
	echo	'
		<form method="post" action="', $scripturl, '?action=admin;area=ultimate_portal_blocks;sa=save-positions" accept-charset="', $context['character_set'], '">	
			<div class="cat_bar">
				<h3 class="catbg">						
					<img alt="',$txt['ultport_blocks_title'],'" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/config.png"/> ', $txt['ultport_blocks_title'], '
				</h3>
			</div>
			<div class="windowbg noup manage-blocks">				
				<div>
					<div class="title_bar">
						<h3 class="titlebg">
							<i class="bi bi-arrow-bar-left"></i> ', $txt['ultport_blocks_left'], '
						</h3>
					</div>
					<ul class="nolist">';
					if($context['exists_left'] ?? false)
					{				
						foreach($context['block-left'] as $block)
						{	
							echo '
							<li class="windowbg" style="padding-left: 5px;">
								', $modeller->printBlockAdmin($block) ,'
							</li>';
						}
					}
					echo '
					</ul>
					<div class="title_bar">
						<h3 class="titlebg">
							<i class="bi bi-text-center"></i> ', $txt['ultport_blocks_center'], '
						</h3>
					</div>
					<ul class="nolist">';
					if($context['exists_center'] ?? false)
					{				
						foreach($context['block-center'] as $block)
						{	
							echo '
							<li class="windowbg" style="padding-left: 5px;">
								', $modeller->printBlockAdmin($block) ,'
							</li>';
						}
					}
					echo '
					</ul>
					<div class="title_bar">
						<h3 class="titlebg">
							<i class="bi bi-arrow-bar-right"></i> ', $txt['ultport_blocks_right'], '
						</h3>
					</div>
					<ul class="nolist">';
					if($context['exists_right'] ?? false)
					{				
						foreach($context['block-right'] as $block)
						{	
							echo '
							<li class="windowbg" style="padding-left: 5px;">
								', $modeller->printBlockAdmin($block) ,'
							</li>';
						}
					}
					echo '
					</ul>
				</div>
			</div>';

		//Multiblock Header
		echo '
		<div class="cat_bar" style="margin-top:10px;">
			<h3 class="catbg">
				', $txt['ultport_mb_multiheader'] ,'			
			</h3>
		</div>
		<div class="manage-blocks windowbg noup">';
		if(!empty($context['exists_multiheader'])){	
			foreach($context['block-header'] as $block_header)
			{	
				$id = $block_header['id'];
				echo '
				<div class="title_bar">
					<h3 class="titlebg">
						', $block_header['id'] ,' - ', $block_header['mbtitle'] ,'
					</h3>
				</div>
				<ul class="nolist">';
				foreach($block_header['vblocks'] as $vblocks)
				{
					echo '
					<li class="windowbg">
						<span class="floatleft">
							', $vblocks['title'], ' [#',$vblocks['id'],']
						</span>
						<span class="floatright">
							<input type="hidden" name="',$vblocks['position_form'],'" value="',$vblocks['position'],'"/>
							<select name="',$vblocks['progressive_form'],'">
								<option value="', $vblocks['progressive'] ,'">', $vblocks['progressive'] ,'</option>
								', $context['header-progoption-'.$id] ?? null ,'
							</select>
							'. $modeller->getGreatCheckbox(name:$vblocks['active_form'],value:'checked',isChecked:$vblocks['active']) .'
						</span>
					</li>';
				}
				echo '
				</ul>';		
			}
		}
		echo '
		</div>';

		//Multiblock footer
		echo '
		<div class="cat_bar">
			<h3 class="catbg">
				', $txt['ultport_mb_footer'] ,'			
			</h3>
		</div>
		<div class="manage-blocks windowbg noup">';
		if(!empty($context['exists_footer']))
		{	
			foreach($context['block-footer'] as $block_footer)
			{	
				$id = $block_footer['id'];
				echo '
				<div class="title_bar">
					<h3 class="titlebg">
						', $block_footer['id'] ,' - ', $block_footer['mbtitle'] ,'
					</h3>
				</div>
				<ul class="nolist">';
				foreach($block_footer['vblocks'] as $vblocks)
				{
					echo '
					<li class="windowbg">
						<span class="floatleft">
							', $vblocks['title'], ' [#',$vblocks['id'],']
						</span>
						<span class="floatright">
							<input type="hidden" name="',$vblocks['position_form'],'" value="',$vblocks['position'],'"/>
							<select name="',$vblocks['progressive_form'],'">
								<option value="', $vblocks['progressive'] ,'">', $vblocks['progressive'] ,'</option>
								', $context['header-progoption-'.$id] ?? null ,'
							</select>
							'. $modeller->getGreatCheckbox(name:$vblocks['active_form'],value:'checked',isChecked:$vblocks['active']) .'
						</span>
					</li>';
				}
				echo '
				</ul>';		
			}
		}		
		echo '
		</div>
		<div class="floatright">
			<input type="hidden" name="sc" value="', $context['session_id'], '" />
			<input type="hidden" name="save" value="ok" />						
			<button type="submit" name="',$txt['ultport_button_save'],'" class="up-btn">
				<i class="bi bi-check-circle-fill"></i> ',$txt['ultport_button_save'],'
			</button>
		</div>
	</form>';

}

function template_blocks_titles()
{
	global $context, $txt, $settings, $scripturl, $ultimateportalSettings;
	
	echo	'
	<form method="post" action="', $scripturl, '?action=admin;area=ultimate_portal_blocks;sa=save-blocks-titles" accept-charset="', $context['character_set'], '">
		<div class="manage-blocks">
			<ul class="nolist" style="border-bottom:1px solid #ccc">';
			foreach($context['block-title'] as $block_title){
				echo '
				<li class="windowbg" style="pedding-right:5px;">
					<span class="floatleft">
						', $block_title['title'] ,'
					</span>
					<span class="floatright">
						<input type="text" name="', $block_title['title_block'] ,'" size="85" value="', !empty($block_title['title']) ? $block_title['title'] : '' , '" />
					</span>
				</li>';
			}
			echo '
			</ul>			
		</div>
		<div class="floatright" style="padding-top:5px;">
			<input type="hidden" name="save" value="ok" />
			<input type="hidden" name="sc" value="', $context['session_id'], '" />
			<button type="submit" name="',$txt['ultport_button_edit'],'" class="up-btn">
				<i class="bi bi-check-circle-fill"></i> ',$txt['ultport_button_edit'],'
			</button>
		</div>
	</form>';

}

function template_create_blocks()
{
	global $context, $settings, $scripturl;
	
	echo	'
	<div class="windowbg noup" style="width:25%;border-radius:10px;">
		<div class="floatleft">
			<a href="', $scripturl, '?action=admin;area=ultimate_portal_blocks;sa=add-block-html;sesc=' . $context['session_id'].'"><img alt="" style="cursor:pointer" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/page-html.png"/></a>
		</div>
		<div class="floatright">
			<a href="', $scripturl, '?action=admin;area=ultimate_portal_blocks;sa=add-block-php;sesc=' . $context['session_id'].'"><img alt="" style="cursor:pointer" border="0" src="'.$settings['default_images_url'].'/ultimate-portal/page-php.png"/></a>
		</div>			
	</div>';
}

function template_add_block_html()
{
	global $context, $txt, $scripturl;
	
	echo	'
	<form method="post" action="', $scripturl, '?action=admin;area=ultimate_portal_blocks;sa=add-block-html" accept-charset="', $context['character_set'], '">												
		<div class="cat_bar">
			<h3 class="catbg">
				', $txt['ultport_add_bk_html_titles'], '
			</h3>
		</div>
		<div class="windowbg noup">
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_title'], '
				</dt>			
				<dd>
					<input type="text" name="bk-title" size="85" />
				</dd>			
			</dl>
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_icon'], '
				</dt>			
				<dd class="w-100">';
				foreach($context['folder_images'] as $folder)
				{
					echo '
					<span class="floatleft">
						<input value="'. $folder['value'] .'" type="radio" name="icon">&nbsp;', $folder['image'] . '			
					</span>';
				}
				echo '
				</dd>			
			</dl>			
			<div class="w-100 titlebg" style="padding-left:0px !important;padding-right:0px !important">
				<textarea name="body_html" class="up-editor"></textarea>
			</div>
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_collapse'], '
				</dt>			
				<dd>
					<input type="checkbox" name="can_collapse" value="on" />
				</dd>			
			</dl>						
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_style'], '
				</dt>			
				<dd>
					<input type="checkbox" name="bk_style" value="on" />
				</dd>			
			</dl>
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_no_title'], '
				</dt>			
				<dd>
					<input type="checkbox" name="no_title" value="on" />
				</dd>			
			</dl>			
		</div>
		<div class="w-100">	
			<input type="hidden" name="save" value="ok" />		
			<input type="hidden" name="sc" value="', $context['session_id'], '" />
			<button type="submit" name="',$txt['ultport_button_add'],'" class="up-btn">
				<i class="bi bi-check-circle-fill"></i> ',$txt['ultport_button_add'],'
			</button>
		</td>
	</form>';

}

function template_add_block_php()
{
	global $context, $txt, $scripturl, $upCaller;
	$block = $upCaller->subsBlock();
	
	//Preview
	if($context['preview'])
	{
		echo '
		<div class="w-100 up-bg-warning" style="padding:10px !important;border-radius:10px;">';			
			$block->head($context['icon'], $context['title'], -10, $context['bk_collapse'], $context['bk_no_title'], $context['bk_style']);
			eval($context['content']);
			$block->footer($context['bk_style']);
		echo '
		</div>';
	}
	//End Preview
	
	echo	'
	<form method="post" action="', $scripturl, '?action=admin;area=ultimate_portal_blocks;sa=add-block-php" accept-charset="', $context['character_set'], '">												
		<div class="cat_bar" style="margin-top:10px;">
			<h3 class="catbg">
				', $txt['ultport_add_bk_php_titles'], '
			</h3>
		</div>
		<div class="windowbg noup">
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_title'], '
				</dt>			
				<dd>
					<input type="text" value="', $context['title'] ,'" name="bk-title" size="50" />
				</dd>			
			</dl>
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_icon'], '
				</dt>			
				<dd>
				<dd class="w-100">';
				foreach($context['folder_images'] as $folder)
				{
					echo '
					<span class="floatleft">
						<input value="'. $folder['value'] .'" type="radio" name="icon">&nbsp;', $folder['image'] . '			
					</span>';
				}
				echo '
				</dd>
			</dl>
			<div class="w-100">
				<textarea id="content" name="content" rows="20" class="w-100">
					', $context['content'] ,'
				</textarea>
			</div>
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_collapse'], '
				</dt>
				<dd>
					<input type="checkbox" name="can_collapse" value="on" ', !empty($context['bk_collapse']) ? 'checked="checked"' : '' ,' />
				</dd>
			</dl>
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_style'], '
				</dt>
				<dd>
					<input type="checkbox" name="bk_style" value="on" ', !empty($context['bk_style']) ? 'checked="checked"' : '' ,' />
				</dd>
			</dl>						
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_no_title'], '
				</dt>
				<dd>
					<input type="checkbox" name="no_title" value="on" ', !empty($context['bk_no_title']) ? 'checked="checked"' : '' ,' />
				</dd>
			</dl>			
		</div>
		<div class="w-100">
			<div class="floatright">
				<input type="hidden" name="sc" value="', $context['session_id'], '" />
				<button type="submit" name="save" class="up-btn">
					<i class="bi bi-check-circle-fill"></i> ', $txt['ultport_button_add'] ,'
				</button>
			</div>
			<div class="floatleft">
				<button type="submit" name="preview" class="up-btn">
					<i class="bi bi-search"></i> ', $txt['ultport_button_preview'] ,'
				</button>
			</div>
		</div>
	</form>';

}

function template_admin_block()
{
	global $context, $txt, $settings, $scripturl, $ultimateportalSettings;

	echo "
	    <script type=\"text/javascript\">
			function makesurelink() {
				if (confirm('".$txt['ultport_delete_confirmation']."')) {
					return true;
				} else {
					return false;
				}
			}
	    </script>";

	
	echo	'
	<div class="title_bar">
		<h3 class="titlebg">
			', $txt['ultport_admin_bk_custom'], '
		</h3>
	</div>
	<div class="manage-blocks windowbg noup">
		<ul class="nolist">';
		if (!empty($context['bkcustom_view']))	{
			foreach($context['block-custom'] as $block_custom){	
				echo '					
				<li class="windowbg">
					<span class="floatleft">
						', $block_custom['type-img'] ,' 
						', $block_custom['title_link_edit'] ,'
					</span>
					<span class="floatright">
						<span class="fw-bold" style="padding-right:10px;">', $block_custom['permissions'] ,'</span>
						<span class="fw-bold" style="padding-right:10px;">', $block_custom['edit'] ,'</span>
						<span class="fw-bold" style="padding-right:10px;">', $block_custom['delete'] ,'</span>
					</span>
				</li>';	
			}
		}		
	echo '	
		</ul>
	</div>';

	echo	'
	<div class="title_bar">
		<h3 class="titlebg">
			', $txt['ultport_admin_bk_system'], '
		</h3>
	</div>
	<div class="manage-blocks windowbg noup">
		<ul class="nolist">';
		foreach($context['block-system'] as $block_system){	
			echo '					
			<li class="windowbg">
				<span class="floatleft">
					', $block_system['type-img'] ,' 
					', $block_system['title'] ,'
				</span>
				<span class="floatright">
					<span class="fw-bold" style="padding-right:10px;">', $block_system['permissions'] ,'</span>
					<span class="fw-bold" style="padding-right:10px;">', $block_system['edit'] ,'</span>
					<span class="fw-bold" style="padding-right:10px;">', $block_system['delete'] ,'</span>
				</span>
			</li>';
		}	
	echo '	
		</ul>
	</div>';


}

function template_edit_block_html()
{
	global $context, $txt, $scripturl, $upCaller;
	$modeller = $upCaller->ssi()->getModeller();
	
	echo	'
	<form method="post" action="', $scripturl, '?action=admin;area=ultimate_portal_blocks;sa=blocks-html-edit" accept-charset="', $context['character_set'], '">												
		<div class="title_bar">		
			<h3 class="titlebg">
				', $txt['ultport_add_bk_html_titles'], '
			</h3>
		</div>
		<div class="windowbg noup">
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_title'], '
				</dt>
				<dd>
					<input type="text" value="', $context['title'] ,'" name="bk-title" size="85" />
				</dd>
			</dl>			
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_icon'], '
				</dt>			
				<dd class="w-100">';
				foreach($context['folder_images'] as $folder)
				{
					echo '
					<span class="floatleft">
						<input '. ($context['icon'] == $folder['value'] ? 'checked="checked"' : '') .' value="'. $folder['value'] .'" type="radio" name="icon"> ', $folder['image'] . '			
					</span>';
				}
				echo '
				</dd>			
			</dl>					
			<div class="w-100">
				<textarea name="body_html" class="up-editor">
					', $context['content'] ,'
				</textarea>
			</div>
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_collapse'], '
				</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'can_collapse',value:'on', isChecked:!empty($context['bk_collapse'])) ,'
				</dd>
			</dl>						
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_style'], '
				</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'bk_style',value:'on', isChecked:!empty($context['bk_style'])) ,'
				</dd>
			</dl>						
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_no_title'], '
				</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'no_title',value:'on', isChecked:!empty($context['bk_no_title'])) ,'
				</dd>
			</dl>
		</div>
		<div class="w-100">
			<input type="hidden" name="save" value="ok" />						
			<input type="hidden" name="id" value="', $context['id'] ,'" />	
			<input type="hidden" name="sc" value="', $context['session_id'], '" />
			<button type="submit" name="save" class="up-btn">
				<i class="bi bi-save"></i> ',$txt['ultport_button_save'],'
			</button>
		</div>
	</form>';

}

function template_edit_block_php()
{
	global $context, $txt, $scripturl, $upCaller;
	$block = $upCaller->subsBlock();
	$modeller = $upCaller->ssi()->getModeller();
	
	//Preview
	if($context['preview'])
	{
		echo '
		<div class="up-bg-warning" style="padding:10px;border-radius:10px;margin-bottom:20px;">';
			$block->head($context['icon'], $context['title'], -10, $context['bk_collapse'], $context['bk_no_title'], $context['bk_style']);
			$context['content'] = trim($context['content'], '<?php');
			eval($context['content']);
			$block->footer($context['bk_style']);
		echo '
		</div>';
	}
	//End Preview
	
	echo	'
	<form method="post" action="', $scripturl, '?action=admin;area=ultimate_portal_blocks;sa=blocks-php-edit;id='. $context['id'] .';type-php='. $context['type_php'] .'" accept-charset="', $context['character_set'], '">												
		<div class="title_bar">
			<h3 class="titlebg">
				', $txt['ultport_add_bk_php_titles'], '
			</h3>			
		</div>			
		<div class="manage-blocks windowbg noup">
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_title'], '
				</dt>			
				<dd>
					<input type="text" value="', $context['title'] ,'" name="bk-title" size="50" />
				</dd>			
			</dl>
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_icon'], '
				</dt>			
				<dd class="w-100">';
				foreach($context['folder_images'] as $folder)
				{
					echo '
					<span class="floatleft">
						<input '. ($context['icon'] == $folder['value'] ? 'checked="checked"' : '') .' value="'. $folder['value'] .'" type="radio" name="icon"> ', $folder['image'] . '			
					</span>';
				}
				echo '
				</dd>			
			</dl>									
			<div class="w-100">
				<textarea id="content" name="content" rows="20" class="w-100">', $context['content'] ,'</textarea>
			</div>
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_collapse'], '
				</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'can_collapse',value:'on', isChecked:!empty($context['bk_collapse'])) ,'
				</dd>
			</dl>						
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_style'], '
				</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'bk_style',value:'on', isChecked:!empty($context['bk_style'])) ,'
				</dd>
			</dl>						
			<dl class="settings">
				<dt>
					', $txt['ultport_add_bk_no_title'], '
				</dt>
				<dd>
					', $modeller->getGreatCheckbox(name:'no_title',value:'on', isChecked:!empty($context['bk_no_title'])) ,'
				</dd>
			</dl>						
		</div>
		<div class="w-100">
			<span class="floatleft">
				<input type="hidden" name="sc" value="', $context['session_id'], '" />
				<input type="hidden" name="use_folder" value="', $context['use_folder'] ,'" />
				<button type="submit" name="preview" class="up-btn">
					<i class="bi bi-search"></i> ', $txt['ultport_button_preview'] ,'
				</button>
			</span>
			<span class="floatright">
				<button type="submit" name="save" class="up-btn">
					<i class="bi bi-save"></i> ', $txt['ultport_button_save'] ,'
				</button>
			</span>
		</div>
	</form>';

}

function template_perms_block()
{
	global $context, $txt, $scripturl, $upCaller;
	$modeller = $upCaller->ssi()->getModeller();
	
	echo	'
	<form method="post" action="', $scripturl, '?action=admin;area=ultimate_portal_blocks;sa=blocks-perms;id='. $context['id'] .'" accept-charset="', $context['character_set'], '">												
		<div class="title_bar">
			<h3 class="titlebg">									
				', $txt['ultport_admin_edit_perms'], ' (', $context['title'] ,')
			</h3>			
		</div>
		<div class="windowbg noup">
			<dl class="settings">
				<dt>
					', $txt['ultport_admin_select_perms'], '
				</dt>			
				<dd>
					<div id="allowedAutoUnhideGroupsList">';
						$permissionsGroups = explode(',',$context['perms']);
						// List all the membergroups so the user can choose who may access this board.
						foreach ($context['groups'] as $group){
						$id_input = "groups_".$group['id_group'];
						echo '
						<div>
							', $modeller->getGreatCheckbox(
								name:'perms[]', 
								value: $group['id_group'],
								isChecked: in_array($group['id_group'],$permissionsGroups),
								id: $id_input
							) ,' ', $group['group_name'], '
						</div>';
						}
						echo '
						<div style="margin-top:10px;padding-top:5px;border-top:1px solid #CCC;">
							<span class="up-checkbox" style="padding-left:10px;padding-right:10px;">
								<input type="checkbox" onclick="invertAll(this, this.form, \'perms[]\');" class="up-checkbox-input" />
							</span>
							', $txt['ultport_button_select_all'], '
						</div>
					</div>
				</dd>			
			</dl>
		</div>
		<div class="w-100">	
			<input type="hidden" name="sc" value="', $context['session_id'], '" />
			<button type="submit" name="save" class="up-btn">
				<i class="bi bi-save"></i> ', $txt['ultport_button_save'] ,'
			</button>
		</div>
	</form>';

}