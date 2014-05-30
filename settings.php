<?php

class mmbd_settings{

	public $options;

	public function __construct(){

		$this->options = get_option('mmbd_plugin_option');
		add_action( 'admin_menu', array( $this, 'mmbd_admin_page' ) );
		add_action( 'admin_init', array( $this, 'mmbd_admin_settings' ) );	
		add_action( 'admin_init', array( $this, 'mmbd_admin_settings_blogposts' ) );	
	}
	
	public function mmbd_admin_page(){
		//add_options_page('MMB&D Blog Options', 'MMB&D Blog Options', 'administrator', 'mmbd_blog_options_page', array($this, 'mmbd_create_admin_page'));
		add_menu_page('MMB&D Blog Options', 'MMB&D Blog Options', 'administrator', 'mmbd_blog_options_page', array($this, 'mmbd_create_admin_page'));
		add_submenu_page('mmbd_blog_options_page', 'Settings', 'Settings', 'administrator', 'mmbd_blog_settings_options_page', array($this, 'mmbd_create_settings_page'));
	}
	
	/* Main Menu */
	
	public function mmbd_create_admin_page(){
		?>
		<div class="wrap">
				<?php screen_icon(); ?>
				<h2>Marketing Material Branding and Distribution Blog Options</h2>
				<form method="post" action="options.php" enctype="multipart/form-data">
				<?php //$o = get_option('mmbd_plugin_options_blogpost'); ?>
				<?php //var_dump($o); ?>
				<table class="widefat">
				<tbody>
					<tr>
					<td>
					<?php settings_fields('mmbd_plugin_options_blogposts'); ?>
					<?php do_settings_sections('mmbd_blog_options_page_blogposts'); ?>
					</td>
					</tr>
				</tbody>
				</table>
					<p class="submit">
						<input name="submit" type="submit" class="button-primary" value="Save Changes"/>
					</p>
				</form>
			</div>
		
		<?php
	}
	
	public function mmbd_main_section_cb_blogposts(){
		//optional
	}
	
	public function mmbd_admin_settings_blogposts(){
		//the settings (register_setting, add_settings_section,add_settings_field )
		register_setting('mmbd_plugin_options_blogposts', 'mmbd_plugin_options_blogpost');
		add_settings_section('mmbd_main_section_blogposts', NULL, array($this, 'mmbd_main_section_cb_blogposts'), 'mmbd_blog_options_page_blogposts');
		add_settings_field('mmbd_blogs', '<thead><tr><th colspan="2">Blog Posts<th></tr></thead>', array($this, 'mmbd_blogposts_setting'), 'mmbd_blog_options_page_blogposts', 'mmbd_main_section_blogposts');
	}
	
	public function mmbd_blogposts_setting(){
	
	$loop = get_posts(
		array(
			'order_by' => 'desc'
		)
		);
	?>
	<select name="mmbd_plugin_options_blogpost[mmbd_blogs]">
	<?php
	foreach($loop as $loops){
		echo "<option value='{$loops->ID}'>{$loops->post_title}</option>";
	}
	?>
	</select> 
	<?php
	}
	
	/* End of Main Menu */
	
	/* Sub-Menu */
	
	public function mmbd_create_settings_page(){
		?>
		<div class="wrap">
				<?php screen_icon(); ?>
				<h2>Settings</h2>
				<form method="post" action="options.php" enctype="multipart/form-data">
				<?php //$o = get_option('mmbd_plugin_option'); ?>
				<?php //var_dump($o); ?>
					<?php settings_fields('mmbd_plugin_options'); ?>
					<?php do_settings_sections('mmbd_blog_options_page'); ?>
					<p class="submit">
						<input name="submit" type="submit" class="button-primary" value="Save Changes"/>
					</p>
				</form>
			</div>
		
		<?php
	}
	
	public function mmbd_admin_settings(){
		//the settings (register_setting, add_settings_section,add_settings_field )
		register_setting('mmbd_plugin_options', 'mmbd_plugin_option', array($this, 'mmbd_validate_settings'));
		add_settings_section('mmbd_main_section', 'Main Settings', array($this, 'mmbd_main_section_cb'), 'mmbd_blog_options_page');
		add_settings_field('mmbd_robots', "Robots:", array($this, 'mmbd_checkbox_robots_setting'), 'mmbd_blog_options_page', 'mmbd_main_section');
		add_settings_field('mmbd_nodesc', "No Meta Description:", array($this, 'mmbd_checkbox_nodescription_setting'), 'mmbd_blog_options_page', 'mmbd_main_section');
		add_settings_field('mmbd_noauthor', "No Google Authorship:", array($this, 'mmbd_checkbox_noauthorship_setting'), 'mmbd_blog_options_page', 'mmbd_main_section');
		add_settings_field('mmbd_sametitle', "Same Title:", array($this, 'mmbd_checkbox_sametitle_setting'), 'mmbd_blog_options_page', 'mmbd_main_section');
						
	}
		
	public function mmbd_main_section_cb(){
		//optional
	}
		
	public function mmbd_validate_settings($input){
		if (!isset($input['mmbd_robots'])){
		$input['mmbd_robots'] = '1';
		}
		return $input;
	}
	
	//Forms
	
	
	
	public function mmbd_checkbox_robots_setting(){
		 
		$selected = ( $this->options['mmbd_robots'] ) ? 'checked' : '';
		echo "<input type='hidden' name='mmbd_plugin_option[mmbd_robots]' value='0' >";
		echo "<input type='checkbox' name='mmbd_plugin_option[mmbd_robots]' value='1' {$selected} >";
	
	}
	
	public function mmbd_checkbox_nodescription_setting(){
		
		$selected = ( $this->options['mmbd_nodesc'] ) ? 'checked' : '';
		echo "<input type='hidden' name='mmbd_plugin_option[mmbd_nodesc]' value='0'>";
		echo "<input type='checkbox' name='mmbd_plugin_option[mmbd_nodesc]' value='1' {$selected}>";
	
	}
	
	public function mmbd_checkbox_noauthorship_setting(){
		
		$selected = ( $this->options['mmbd_noauthor'] ) ? 'checked' : '';
		echo "<input type='hidden' name='mmbd_plugin_option[mmbd_noauthor]' value='0'>";
		echo "<input type='checkbox' name='mmbd_plugin_option[mmbd_noauthor]' value='1' {$selected}>";
	
	}
	
	public function mmbd_checkbox_sametitle_setting(){
	
		$selected = ( $this->options['mmbd_sametitle'] ) ? 'checked' : '';
		echo "<input type='hidden' name='mmbd_plugin_option[mmbd_sametitle]' value='0'>";
		echo "<input type='checkbox' name='mmbd_plugin_option[mmbd_sametitle]' value='1' {$selected}>";
	
	}
	//End of the Forms
	
	/* Sub-Menu */
}
?>