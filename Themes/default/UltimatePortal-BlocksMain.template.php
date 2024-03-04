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
							',$txt['ultport_blocks_enable'],' <input type="checkbox" name="',  $vblocks['active_form'] ,'" value="checked" ', $vblocks['active'] ,' />
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
							',$txt['ultport_blocks_enable'],' <input type="checkbox" name="',  $vblocks['active_form'] ,'" value="checked" ', $vblocks['active'] ,' />
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
			<button type="submit" name="',$txt['ultport_button_save'],'" class="button">
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
			<button type="submit" name="',$txt['ultport_button_edit'],'">
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
	global $context, $txt, $settings, $scripturl, $ultimateportalSettings;
	
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
			<button type="submit" name="',$txt['ultport_button_add'],'">
				<i class="bi bi-check-circle-fill"></i> ',$txt['ultport_button_add'],'
			</button>
		</td>
	</form>';

}

function template_add_block_php()
{
	global $context, $txt, $settings, $scripturl, $ultimateportalSettings;
	
	//Preview
	if($context['preview'])
	{
		echo '
		<table align="center" width="70%">
			<tr>
				<td>';
					head_block($context['icon'], $context['title'], -10, $context['bk_collapse'], $context['bk_no_title'], $context['bk_style']);
					eval($context['content']);
					footer_block($context['bk_style']);
		echo '			
				</td>
			</tr>
		</table><br />';
	}
	//End Preview
	
	echo	'
	<form method="post" action="', $scripturl, '?action=admin;area=ultimate_portal_blocks;sa=add-block-php" accept-charset="', $context['character_set'], '">												
		<table width="70%" align="center" class="bordercolor" cellspacing="1" cellpadding="5" border="0">
			<tr>
				<td colspan="2" width="100%" class="titlebg">									
					', $txt['ultport_add_bk_php_titles'], '
				</td>			
			</tr>			
			<tr>
				<td width="50%" class="windowbg2">									
					', $txt['ultport_add_bk_title'], '
				</td>			
				<td width="50%" align="center" class="windowbg2">									
					<input type="text" value="', $context['title'] ,'" name="bk-title" size="50" />
				</td>			
			</tr>
			<tr>
				<td valign="top" width="50%" class="windowbg2">									
					', $txt['ultport_add_bk_icon'], '
				</td>			
				<td width="50%" class="windowbg2">
					<table width="100%">
						<tr>';									
						$i = 1;
						foreach($context['folder_images'] as $folder)
						{
							echo '
							<td>
								<input '. ($context['icon'] == $folder['value'] ? 'checked="checked"' : '') .' value="'. $folder['value'] .'" type="radio" name="icon">&nbsp;', $folder['image'] . '
							</td>';
							$i++;
							if($i==6)
							{
								echo '</tr><tr>';
								$i = 1;
							}
						}
		echo '			</tr>
					</table>
				</td>			
			</tr>						
			<tr>
				<td colspan="2" width="100%" align="center" class="tborder">									
					<textarea id="content" name="content" rows="20" cols="80" style="width: 99.2%">', $context['content'] ,'</textarea>
				</td>			
			</tr>
			<tr>
				<td width="50%" class="windowbg2">									
					', $txt['ultport_add_bk_collapse'], '
				</td>			
				<td width="50%" class="windowbg2">									
					<input type="checkbox" name="can_collapse" value="on" ', !empty($context['bk_collapse']) ? 'checked="checked"' : '' ,' />
				</td>			
			</tr>						
			<tr>
				<td width="50%" class="windowbg2">									
					', $txt['ultport_add_bk_style'], '
				</td>			
				<td width="50%" class="windowbg2">									
					<input type="checkbox" name="bk_style" value="on" ', !empty($context['bk_style']) ? 'checked="checked"' : '' ,' />
				</td>			
			</tr>						
			<tr>
				<td width="50%" class="windowbg2">									
					', $txt['ultport_add_bk_no_title'], '
				</td>			
				<td width="50%" class="windowbg2">									
					<input type="checkbox" name="no_title" value="on" ', !empty($context['bk_no_title']) ? 'checked="checked"' : '' ,' />
				</td>
			</tr>			
		</table>
		<table width="70%" align="center" cellspacing="1" cellpadding="5" border="0">
			<tr>
				<td colspan="2" align="left">	
					<input type="hidden" name="sc" value="', $context['session_id'], '" />
					<input type="submit" name="save" value="', $txt['ultport_button_add'] ,'" />&nbsp;
					<input type="submit" name="preview" value="', $txt['ultport_button_preview'] ,'" />
				</td>
			</tr>
		</table>
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
	<table width="100%" align="center" class="tborder" cellspacing="1" cellpadding="5" border="0">
		<tr>
			<td colspan="6" width="100%" class="catbg">									
				', $txt['ultport_admin_bk_custom'], '
			</td>			
		</tr>			
		<tr>
			<td width="5%" align="center" class="titlebg">									
				', $txt['ultport_blocks_titles_id'], '
			</td>			
			<td width="3%" align="center" class="titlebg">									
				', $txt['ultport_admin_bk_type'], '
			</td>			
			<td width="58%" align="left" class="titlebg">									
				', $txt['ultport_add_bk_title'], '
			</td>			
			<td width="34%"  align="left" colspan="3" class="titlebg">									
				', $txt['ultport_admin_bk_action'], '
			</td>			
		</tr>';
	if (!empty($context['bkcustom_view']))	
	{
		foreach($context['block-custom'] as $block_custom)
		{	
		echo '					
		<tr>
			<td width="5%" align="center" class="', $block_custom['activestyle'] ,'">									
				', $block_custom['id'] ,'
			</td>			
			<td width="3%" align="center" class="', $block_custom['activestyle'] ,'">									
				', $block_custom['type-img'] ,'
			</td>			
			<td width="58%" align="left" class="', $block_custom['activestyle'] ,'">									
				', $block_custom['title_link_edit'] ,'
			</td>			
			<td width="11%" align="center" class="', $block_custom['activestyle'] ,'">									
				', $block_custom['permissions'] ,'
			</td>			
			<td width="11%" align="center" class="', $block_custom['activestyle'] ,'">									
				', $block_custom['edit'] ,'
			</td>			
			<td width="11%" align="center" class="', $block_custom['activestyle'] ,'">									
				', $block_custom['delete'] ,'
			</td>			
		</tr>';	
		}
	}
	echo '	
	</table><br />';

	echo	'
	<table width="100%" align="center" class="tborder" cellspacing="1" cellpadding="5" border="0">
		<tr>
			<td colspan="6" width="100%" class="catbg">									
				', $txt['ultport_admin_bk_system'], '
			</td>			
		</tr>
		<tr>
			<td width="5%" align="center" class="titlebg">									
				', $txt['ultport_blocks_titles_id'], '
			</td>			
			<td width="3%" align="center" class="titlebg">									
				', $txt['ultport_admin_bk_type'], '
			</td>			
			<td width="58%" align="left" class="titlebg">									
				', $txt['ultport_add_bk_title'], '
			</td>			
			<td width="34%" align="left" colspan="3" class="titlebg">									
				', $txt['ultport_admin_bk_action'], '
			</td>			
		</tr>';
	foreach($context['block-system'] as $block_system)
	{	
		echo '					
		<tr>
			<td width="5%" align="center" class="', $block_system['activestyle'] ,'">									
				', $block_system['id'] ,'
			</td>			
			<td width="3%" align="center" class="', $block_system['activestyle'] ,'">									
				', $block_system['type-img'] ,'
			</td>			
			<td width="58%" align="left" class="', $block_system['activestyle'] ,'">									
				', $block_system['title'] ,'
			</td>			
			<td width="11%" align="center" class="', $block_system['activestyle'] ,'">									
				', $block_system['permissions'] ,'
			</td>			
			<td width="11%" align="center" class="', $block_system['activestyle'] ,'">									
				', $block_system['edit'] ,'
			</td>			
			<td width="11%" align="center" class="', $block_system['activestyle'] ,'">									
				', $block_system['delete'] ,'
			</td>			
		</tr>';
	}	
	echo '	
	</table>';


}

function template_edit_block_html()
{
	global $context, $txt, $settings, $scripturl, $ultimateportalSettings;
	
	echo	'
	<form method="post" action="', $scripturl, '?action=admin;area=ultimate_portal_blocks;sa=blocks-html-edit" accept-charset="', $context['character_set'], '">												
		<table width="80%" align="center" class="tborder" cellspacing="1" cellpadding="5" border="0">
			<tr>
				<td colspan="2" width="100%" class="titlebg">									
					', $txt['ultport_add_bk_html_titles'], '
				</td>			
			</tr>			
			<tr>
				<td width="50%" class="windowbg2">									
					', $txt['ultport_add_bk_title'], '
				</td>			
				<td width="50%" class="windowbg2">									
					<input type="text" value="', $context['title'] ,'" name="bk-title" size="85" />
				</td>			
			</tr>			
			<tr>
				<td valign="top" width="50%" class="windowbg2">									
					', $txt['ultport_add_bk_icon'], '
				</td>			
				<td width="50%" class="windowbg2">
					<table width="100%">
						<tr>';									
						$i = 1;
						foreach($context['folder_images'] as $folder)
						{
							echo '
							<td>
								<input '. ($context['icon'] == $folder['value'] ? 'checked="checked"' : '') .' value="'. $folder['value'] .'" type="radio" name="icon">&nbsp;', $folder['image'] . '
							</td>';
							$i++;
							if($i==6)
							{
								echo '</tr><tr>';
								$i = 1;
							}
						}
		echo '			</tr>
					</table>
				</td>						
			</tr>			
			<tr>
				<td colspan="2" width="100%" align="center" class="windowbg2">									
					<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 100%">', $context['content'] ,'</textarea>
				</td>			
			</tr>
			<tr>
				<td width="50%" class="windowbg2">									
					', $txt['ultport_add_bk_collapse'], '
				</td>			
				<td width="50%" class="windowbg2">									
					<input type="checkbox" name="can_collapse" value="on" ', !empty($context['bk_collapse']) ? 'checked="checked"' : '' ,' />
				</td>			
			</tr>						
			<tr>
				<td width="50%" class="windowbg2">									
					', $txt['ultport_add_bk_style'], '
				</td>			
				<td width="50%" class="windowbg2">									
					<input type="checkbox" name="bk_style" value="on" ', !empty($context['bk_style']) ? 'checked="checked"' : '' ,' />
				</td>			
			</tr>						
			<tr>
				<td width="50%" class="windowbg2">									
					', $txt['ultport_add_bk_no_title'], '
				</td>			
				<td width="50%" class="windowbg2">									
					<input type="checkbox" name="no_title" value="on" ', !empty($context['bk_no_title']) ? 'checked="checked"' : '' ,' />
				</td>
			</tr>			
		</table>
		<table width="80%" align="center" cellspacing="1" cellpadding="5" border="0">
			<tr>
				<td colspan="2" align="center">	
					<input type="hidden" name="save" value="ok" />						
					<input type="hidden" name="id" value="', $context['id'] ,'" />	
					<input type="hidden" name="sc" value="', $context['session_id'], '" />
					<input type="submit" name="',$txt['ultport_button_save'],'" value="',$txt['ultport_button_save'],'" />
				</td>
			</tr>
		</table>
	</form>';

}

function template_edit_block_php()
{
	global $context, $txt, $settings, $scripturl, $ultimateportalSettings;
	
	//Preview
	if($context['preview'])
	{
		echo '
		<table align="center" width="70%">
			<tr>
				<td>';
					head_block($context['icon'], $context['title'], -10, $context['bk_collapse'], $context['bk_no_title'], $context['bk_style']);
					$context['content'] = trim($context['content'], '<?php');
					$context['content'] = trim($context['content'], '?>');
					eval($context['content']);
					footer_block($context['bk_style']);
		echo '			
				</td>
			</tr>
		</table><br />';
	}
	//End Preview
	
	echo	'
	<form method="post" action="', $scripturl, '?action=admin;area=ultimate_portal_blocks;sa=blocks-php-edit;id='. $context['id'] .';type-php='. $context['type_php'] .'" accept-charset="', $context['character_set'], '">												
		<table width="70%" align="center" class="bordercolor" cellspacing="1" cellpadding="5" border="0">
			<tr>
				<td colspan="2" width="100%" class="titlebg">									
					', $txt['ultport_add_bk_php_titles'], '
				</td>			
			</tr>			
			<tr>
				<td width="50%" class="windowbg2">									
					', $txt['ultport_add_bk_title'], '
				</td>			
				<td width="50%" align="center" class="windowbg2">									
					<input type="text" value="', $context['title'] ,'" name="bk-title" size="50" />
				</td>			
			</tr>
			<tr>
				<td valign="top" width="50%" class="windowbg2">									
					', $txt['ultport_add_bk_icon'], '
				</td>			
				<td width="50%" class="windowbg2">
					<table width="100%">
						<tr>';									
						$i = 1;
						foreach($context['folder_images'] as $folder)
						{
							echo '
							<td>
								<input '. ($context['icon'] == $folder['value'] ? 'checked="checked"' : '') .' value="'. $folder['value'] .'" type="radio" name="icon">&nbsp;', $folder['image'] . '
							</td>';
							$i++;
							if($i==6)
							{
								echo '</tr><tr>';
								$i = 1;
							}
						}
		echo '			</tr>
					</table>
				</td>			
			</tr>									
			<tr>
				<td colspan="2" width="100%" align="center" class="tborder">									
					<textarea id="content" name="content" rows="20" cols="80" style="width: 99.2%">', $context['content'] ,'</textarea>
				</td>			
			</tr>
			<tr>
				<td width="50%" class="windowbg2">									
					', $txt['ultport_add_bk_collapse'], '
				</td>			
				<td width="50%" class="windowbg2">									
					<input type="checkbox" name="can_collapse" value="on" ', !empty($context['bk_collapse']) ? 'checked="checked"' : '' ,' />
				</td>			
			</tr>						
			<tr>
				<td width="50%" class="windowbg2">									
					', $txt['ultport_add_bk_style'], '
				</td>			
				<td width="50%" class="windowbg2">									
					<input type="checkbox" name="bk_style" value="on" ', !empty($context['bk_style']) ? 'checked="checked"' : '' ,' />
				</td>			
			</tr>						
			<tr>
				<td width="50%" class="windowbg2">									
					', $txt['ultport_add_bk_no_title'], '
				</td>			
				<td width="50%" class="windowbg2">									
					<input type="checkbox" name="no_title" value="on" ', !empty($context['bk_no_title']) ? 'checked="checked"' : '' ,' />
				</td>
			</tr>						
		</table>
		<table width="70%" align="center" cellspacing="1" cellpadding="5" border="0">
			<tr>
				<td colspan="2" align="left">	
					<input type="hidden" name="sc" value="', $context['session_id'], '" />
					<input type="hidden" name="use_folder" value="', $context['use_folder'] ,'" />&nbsp;
					<input type="submit" name="save" value="', $txt['ultport_button_save'] ,'" />&nbsp;
					<input type="submit" name="preview" value="', $txt['ultport_button_preview'] ,'" />
				</td>
			</tr>
		</table>
	</form>';

}

function template_perms_block()
{
	global $context, $txt, $settings, $scripturl, $ultimateportalSettings;
	
	echo	'
	<form method="post" action="', $scripturl, '?action=admin;area=ultimate_portal_blocks;sa=blocks-perms;id='. $context['id'] .'" accept-charset="', $context['character_set'], '">												
		<table width="70%" align="center" class="bordercolor" cellspacing="1" cellpadding="5" border="0">
			<tr>
				<td colspan="2" width="100%" class="titlebg">									
					', $txt['ultport_admin_edit_perms'], ' (', $context['title'] ,')
				</td>			
			</tr>			
			<tr>
				<td width="50%" valign="top" class="windowbg2">									
					', $txt['ultport_admin_select_perms'], '
				</td>			
				<td width="50%" align="left" class="windowbg2">									
					<div id="allowedAutoUnhideGroupsList">';
					$permissionsGroups = explode(',',$context['perms']);
						// List all the membergroups so the user can choose who may access this board.
					foreach ($context['groups'] as $group)
	echo '
						<input type="checkbox" name="perms[]" value="', $group['id_group'], '" id="groups_', $group['id_group'], '"', ((in_array($group['id_group'],$permissionsGroups) == true) ? ' checked="checked" ' : ''), '/>', $group['group_name'], '<br />';
echo '
						<input type="checkbox" onclick="invertAll(this, this.form, \'perms[]\');" /> <i>', $txt['ultport_button_select_all'], '</i><br />
						<br />
					</div>
				</td>			
			</tr>			
		</table>
		<table width="70%" align="center" cellspacing="1" cellpadding="5" border="0">
			<tr>
				<td colspan="2" align="left">	
					<input type="hidden" name="sc" value="', $context['session_id'], '" />
					<input type="submit" name="save" value="', $txt['ultport_button_save'] ,'" />
				</td>
			</tr>
		</table>
	</form>';

}


?>

