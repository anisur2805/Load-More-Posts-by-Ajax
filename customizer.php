
<!-- Function -->
// Include AR CUSTOMIZER
include get_theme_file_path( 'inc/ar-customizer.php' );
function custom_scripts(){
	wp_enqueue_style( 'arstyle', get_theme_file_uri('assets/css/arstyle.css'), null, time());
	
	$services_icon_color_css = get_theme_mod( 'ar_services_icon_color', '#ff0000' );
	$services_style =<<<EOD
.services-section i{
	color: {$services_icon_color_css};
}
EOD;
	wp_add_inline_style('arstyle',$services_style);
}
add_action('wp_enqueue_scripts', 'custom_scripts');

function ar_customize_function(){
	wp_enqueue_script( 'ar-customizer-js', get_theme_file_uri('/assets/js/ar-customizer.js'), array( 'jquery', 'customize-preview' ), time(), true );
}
add_action('customize_preview_init', 'ar_customize_function');

<!-- Front End Side Content -->
<div class="services-section">
	<div class="container">
		<div class="services-heading">
			<h2 id="services-heading"><?php echo esc_html( get_theme_mod( 'ar_services_heading', __('Services', 'mercurygate') ) ); ?></h2>
			<?php if(get_theme_mod( 'ar_services_display_subheading', 1 )): ?>
				<p><?php echo esc_html(get_option( 'ar_services_subheading', __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe repellendus, quis magnam quibusdam, deleniti exercitationem reprehenderit ab, possimus minima accusamus, soluta provident. Totam nesciunt, fugit.') )); ?></p>
		<?php endif; ?>
		</div>
		<div class="row text-center">
			<?php $number_of_columns = get_theme_mod( 'ar_services_column_in_row', '4' ); ?>
			<div class="col-md-<?php echo esc_attr($number_of_columns); ?>">
				<i class="fa fa-facebook"></i>
				<h3>Service 01</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, adipisci.</p>
			</div>
			<div class="col-md-<?php echo esc_attr($number_of_columns); ?>">
				<i class="fa fa-instagram"></i>
				<h3>Service 01</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, adipisci.</p>
			</div>
			<div class="col-md-<?php echo esc_attr($number_of_columns); ?>">
				<i class="fa fa-twitter"></i>
				<h3>Service 01</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, adipisci.</p>
			</div>
			<div class="col-md-<?php echo esc_attr($number_of_columns); ?>">
				<i class="fa fa-facebook"></i>
				<h3>Service 01</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, adipisci.</p>
			</div>
			<div class="col-md-<?php echo esc_attr($number_of_columns); ?>">
				<i class="fa fa-instagram"></i>
				<h3>Service 01</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, adipisci.</p>
			</div>
			<div class="col-md-<?php echo esc_attr($number_of_columns); ?>">
				<i class="fa fa-twitter"></i>
				<h3>Service 01</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, adipisci.</p>
			</div>
		</div>
	</div>
</div>

<!-- js -->
;(function($){
	wp.customize('ar_services_heading', function(value){
		value.bind(function(newvalue){
			$('#services-heading').html(newvalue);
		});
	});

	wp.customize('ar_services_icon_color', function(value){
		value.bind(function(newvalue){
			$('.services-section i').css('color', newvalue);
		})
	});
})(jQuery);

<!-- Inc file customizer.php -->
<?php
function ar_customizer_settings( $wp_customizer ){
	$wp_customizer->add_section('cus_services', array(
		'title'=> __('Services', 'mercurygate'),
		'priority'=> '30'
	));

	$wp_customizer->add_setting('ar_services_heading', array(
		'dafault'=>'Our Services',
		'transport'=> 'postMessage'
	));
	$wp_customizer->add_control('ar_services_heading_ctrl', array(
		'label'=>__('Services Heading', 'mercurygate'),
		'section'=> 'cus_services',
		'settings'=> 'ar_services_heading',
		'type'=> 'text'
	));

	$wp_customizer->add_setting('ar_services_subheading', array(
		'dafault'=>'Lorem ipsum doler sit amet',
		'transport'=> 'refresh',
		// 'type'=>'option'
	));
	$wp_customizer->add_control('ar_services_subheading_ctrl', array(
		'label'=>__('Services Subheading', 'mercurygate'),
		'section'=> 'cus_services',
		'settings'=> 'ar_services_subheading',
		'type'=> 'textarea',
		'active_callback'=> 'display_services_subheading'
	));

	$wp_customizer->add_setting('ar_services_display_subheading', array(
		'default'=> 1,		
		'transport'=> 'refresh'
	));
	$wp_customizer->add_control('ar_services_display_subheading_ctrl', array(
		'label'=>__('Display Sub Heading', 'mercurygate'),
		'section'=> 'cus_services',
		'settings'=> 'ar_services_display_subheading',
		'type'=> 'checkbox'
	));

	// Set Column
	$wp_customizer->add_setting('ar_services_column_in_row', array(
		'default'=>'4',
		'transport'=> 'refresh'
	));
	$wp_customizer->add_control('ar_services_column_in_row_ctrl', array(
		'label'=>__('Number of Column', 'mercurygate'),
		'section'=> 'cus_services',
		'settings'=> 'ar_services_column_in_row',
		'type'=> 'select',
		'choices'=> array(
			'3'=> __('4 in Each Row', 'mercurygate'),
			'4'=> __('3 in Each Row', 'mercurygate'),
			'6'=>  __('2 in Each Row', 'mercurygate'),
			'12'=>  __('1 in Each Row', 'mercurygate'),

		)
	));


	//Other Section
	$wp_customizer->add_section('cus_other', array(
		'title'=> __('Other Panel', 'mercurygate'),
		'priority'=> '40'
	));
	$wp_customizer->add_setting('ar_other_heading', array(
		'default'=>'other2',
		'transport'=> 'refresh'
	));
	$wp_customizer->add_control('ar_other_heading_ctrl', array(
		'label'=>__('Fav Food', 'mercurygate'),
		'section'=> 'cus_other',
		'settings'=> 'ar_other_heading',
		'type'=> 'radio',
		'choices'=> array(
			'other1'=> __('Beaf', 'mercurygate'),
			'other2'=>  __('Chicken', 'mercurygate'),
			'other3'=>  __('Fish', 'mercurygate')

		)
	));

	$wp_customizer->add_setting('ar_services_icon_color', array(
		'default'=> '#f00',
		'transport'=> 'postMessage'
	));
	$wp_customizer->add_control( new WP_Customize_Color_Control( $wp_customizer, 'ar_services_icon_color_ctrl', array(
		'label'=>__('Icon Color', 'mercurygate'),
		'section'=> 'cus_other',
		'settings'=> 'ar_services_icon_color',
	)));

	// Customizer Page
	$wp_customizer->add_section('cus_customizer', array(
		'title'=> __('Customizer Section', 'mercurygate'),
		'priority'=> '40',
		'active_callback' => function(){
			return is_page_template( 'ar-customizer.php' );
		}
	));
	$wp_customizer->add_setting('ar_customizer_heading', array(
		'default'=>'About Page Heading',
		'transport'=> 'refresh'
	));
	$wp_customizer->add_control('ar_customizer_heading_ctrl', array(
		'label'=>__('Customizer Heading', 'mercurygate'),
		'section'=> 'cus_customizer',
		'settings'=> 'ar_customizer_heading',
		'type'=> 'text'
	));


}
add_action('customize_register', 'ar_customizer_settings');

function display_services_subheading(){
	if(get_theme_mod('ar_services_display_subheading') ==1 ){
		return true;
	}
	return false;
}