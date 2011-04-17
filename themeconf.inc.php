<?php
/*
Theme Name: OS_default
Version: auto
Description: 
Theme URI: http://piwigo.org/ext/extension_view.php?eid=497
Author: flop25
Author URI: http://www.planete-flop.fr
*/
$themeconf = array(
  'name'         => 'OS_default',
  'parent'        => 'default',
  'icon_dir'      => 'themes/OS_default/icon',
  'mime_icon_dir' => 'themes/OS_default/icon/mimetypes/',
  'local_head'    => 'local_head.tpl',
  'activable' => false,
	'add_menu_on_public_pages'			=> true,	# activation
	'Exclude'			=> array('theNBMPage','thePicturePage','thePopuphelpPage',),	# Excluded pages
);
/*********************************menu on every pages ************************************/
// thx to Vdigital and his plugin spreadmenus
if ( !function_exists( 'add_menu_on_public_pages' ) ) {
	if ( defined('IN_ADMIN') and IN_ADMIN ) return false;
	add_event_handler('loc_after_page_header', 'add_menu_on_public_pages', 20);

	function  add_menu_on_public_pages() {
	  if ( function_exists( 'initialize_menu') ) return false; # The current page has already the menu 
	  if ( !get_themeconf('add_menu_on_public_pages') ) return false; # The current page has already the menu 
	  global $template, $page, $conf;
	  if ( isset($page['body_id']) and in_array($page['body_id'], get_themeconf('Exclude')) ) return false;

	  $template->set_filenames(array(
		'add_menu_on_public_pages' => dirname(__FILE__) . '/template/add_menu_on_public_pages.tpl',
	  ));
	  include_once(PHPWG_ROOT_PATH.'include/menubar.inc.php');
	  $template->parse('add_menu_on_public_pages');
	  
	  if (is_admin())
		{
	  $template->assign(
        'U_ADMIN', get_root_url().'admin.php?page=picture_modify'
      .'&amp;cat_id='.(isset($page['category']) ? $page['category']['id'] : '')
      .( isset($page['image_id']) ? '&amp;image_id='.$page['image_id'] : '')
      );
		}
	  
	}
}
/************************************ index.tpl ************************************/
add_event_handler('loc_end_index', 'OS_default_index');
function OS_default_index()
{
    global $template;
    $template->set_prefilter('index', 'OS_default_prefilter_index');
}
function OS_default_prefilter_index($content, &$smarty)
{
  $search = '#<div id="content" class="content">#';  
  $replacement = '<div id="content" class="content">
  <table id="table_content" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td id="section_up_left">&nbsp;</td>
      <td id="section_up">
';
  $content = preg_replace($search, $replacement, $content);

  $search = '#</div>\{\* <\!-- titrePage --> \*\}#';  
  $replacement = '';
  $content = preg_replace($search, $replacement, $content);
	
  $search = '#<h2>\{\$TITLE\}</h2>#';  
  $replacement = '<h2>{$TITLE}</h2>
	</div>{* <!-- titrePage --> *}  
	  </td>
      <td id="section_up_right">&nbsp;</td>
    </tr>
    <tr>
      <td id="section_left">&nbsp;</td>
      <td id="section_in">';
  $content = preg_replace($search, $replacement, $content);
	
  $search = '#\{if \!empty\(\$PLUGIN_INDEX_CONTENT_END\)\}\{\$PLUGIN_INDEX_CONTENT_END\}\{/if\}#';  
  $replacement = '{if !empty($PLUGIN_INDEX_CONTENT_END)}{$PLUGIN_INDEX_CONTENT_END}{/if}
      </td>
	  <td id="section_right">&nbsp;</td>
    </tr>
    <tr>
      <td id="section_bottom_left">&nbsp;</td>
      <td id="section_bottom" >&nbsp;</td>
      <td id="section_bottom_right" >&nbsp;</td>
    </tr>
  </table>
';
  return preg_replace($search, $replacement, $content);
}
?>
