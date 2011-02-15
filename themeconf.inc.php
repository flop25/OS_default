<?php
/*
Theme Name: OS_default
Version: 1.0.1
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

?>
