<?php

class mmbd_settings{

	public $options;

	public function __construct(){
	
		$this->options = get_option('mmbd_plugin_option');
		add_action( 'admin_menu', array( $this, 'mmbd_admin_page' ) );
		add_action( 'admin_init', array( $this, 'mmbd_admin_settings' ) );
		
	}
	
	public function mmbd_admin_page(){
		add_options_page('MMB&D Blog Options', 'MMB&D Blog Options', 'administrator', 'mmbd_blog_options_name', array($this, 'mmbd_create_admin_page'));
	}
	
	public function mmbd_create_admin_page(){
		?>
		<div class="wrap">
				<?php screen_icon(); ?>
				<h2>Marketing Material Branding and Distribution Blog Options</h2>
				<?php $o = get_option('mmbd_plugin_option'); ?>
				<?php var_dump($o); ?>
				<form method="post" action="options.php" enctype="multipart/form-data">
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
		register_setting('mmbd_plugin_options', 'mmbd_plugin_option');
		add_settings_section('mmbd_main_section', 'Main Settings', array($this, 'mmbd_main_section_cb'), 'mmbd_blog_options_page');
		add_settings_field('mmbd_robots', "Robots:", array($this, 'mmbd_checkbox_robots_setting'), 'mmbd_blog_options_page', 'mmbd_main_section');
		add_settings_field('mmbd_nodesc', "No Meta Description:", array($this, 'mmbd_checkbox_nodescription_setting'), 'mmbd_blog_options_page', 'mmbd_main_section');
		add_settings_field('mmbd_noauthor', "No Google Authorship:", array($this, 'mmbd_checkbox_noauthorship_setting'), 'mmbd_blog_options_page', 'mmbd_main_section');
		add_settings_field('mmbd_sametitle', "Same Title:", array($this, 'mmbd_checkbox_sametitle_setting'), 'mmbd_blog_options_page', 'mmbd_main_section');
				
	}

	public function mmbd_main_section_cb(){
		//opional
	}
	
	public function mmbd_checkbox_robots_setting(){
		
		$selected = ( $this->options['mmbd_robots'] ) ? 'checked' : '';
		
		echo "<input type='checkbox' name='mmbd_plugin_option[mmbd_robots]' value='1' {$selected} >";
	
	}
	
	public function mmbd_checkbox_nodescription_setting(){
		
		$selected = ( $this->options['mmbd_nodesc'] ) ? 'checked' : '';
		echo "<input type='checkbox' name='mmbd_plugin_option[mmbd_nodesc]' {$selected}>";
	
	}
	
	public function mmbd_checkbox_noauthorship_setting(){
		
		$selected = ( $this->options['mmbd_noauthor'] ) ? 'checked' : '';
		echo "<input type='checkbox' name='mmbd_plugin_option[mmbd_noauthor]' {$selected}>";
	
	}
	
	public function mmbd_checkbox_sametitle_setting(){
	
		$selected = ( $this->options['mmbd_sametitle'] ) ? 'checked' : '';
		echo "<input type='checkbox' name='mmbd_plugin_option[mmbd_sametitle]' {$selected}>";
	
	}

}

?>