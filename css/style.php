<?php 
/**
*
* This file adds style to the header using returned values from theme customizer. 
* Since 1.0.5
*
**/
add_action('wp_head','_sf_custom_style');
//add_action('wp_head','dragonstone_background_img');

function _sf_custom_style() {
	$options = get_option('_sf');
	/*Page*/
	$page_bg_color = $options['page_bg_color'];	
	/*Header*/
	$header_bg_color = $options['header_bg_color'];
	$site_name_color = $options['site_name_color'];
	$site_description_color = $options['site_description_color'];
		/*Menu*/
		$menu_bg_color = $options['menu_bg_color'];
		$menu_hover_color = $options['menu_hover_color'];
		$menu_text_color = $options['menu_text_color'];
		$search_but_txt = $options['menu_search_txt_color'];
		$search_but_bg = $options['menu_search_bg_color'];
		$search_but_txt_hv = $options['menu_search_txt_color_hv'];
		$search_but_bg_hv = $options['menu_search_bg_color_hv'];
	/*Content*/
	$content_bg_color = $options['content_bg_color'];
	$content_text_color = $options['content_text_color'];
	$content_link_color = $options['content_link_color'];
	$post_title_color = $options['post_title_color'];
	$page_title_color = $options['page_title_color'];
	$excerpt_button_bg_color = $options['excerpt_button_bg_color'];
	$excerpt_button_text_color = $options['excerpt_button_text_color'];
	
		/*Slider*/
		$slider_bg_color = $options['slider_bg_color'];
		$slider_title_color = $options['slider_title_color'];
		$slider_excerpt_text_color = $options['slider_excerpt_text_color'];
		$slider_button_bg_color = $options['slider_button_bg_color'];
		$slider_button_text_color = $options['slider_button_text_color'];
	
		/*Masonry*/
		$masonry_bg_color = $options['masonry_bg_color'];
		$masonry_excerpt_text_color = $options['masonry_excerpt_text_color'];
		$masonry_title_color = $options['masonry_title_color'];
		$masonry_border_color = $options['masonry_border_color'];
	
	/*Sidebar*/
	$sidebar_bg_color = $options['sidebar_bg_color'];
	$widget_title_color = $options['widget_title_color'];
	$sidebar_text_color = $options['sidebar_text_color'];
	$sidebar_link_color = $options['sidebar_link_color'];
	
	/*Footer*/
	$footer_bg_color = $options['footer_bg_color'];

echo '<style>'; 
	
	/*header*/
	echo'
		.site-description {color: '.$site_description_color.'}
		#content a { color: '.$content_link_color.';}
		
	';
		/*Menu*/
		echo '
			.top-bar-section ul li>a {color: '.$menu_text_color.'}
			.top-bar .name h1 a, h1.site-title a {color: '.$site_name_color.'}
			.top-bar, .top-bar-section li a:not(.button) {background-color: '.$menu_bg_color.' }
			.top-bar-section>ul>.divider
			{border-bottom-color: '.$menu_bg_color.';
			 border-top-color: '.$menu_bg_color.';
			 border-left-color: '.$menu_bg_color.';
			 border-right-color: '.$menu_bg_color.';
			 }
			.top-bar-section ul li>a.button {'.'color:'. $search_but_txt.'; background-color:'.$search_but_bg.';'.'}
			.top-bar-section ul li>a.button:hover{'.'color:'. $search_but_txt_hv.'; background-color:'.$search_but_bg_hv.'}
			.top-bar-section li a:not(.button):hover {background-color: '.$menu_hover_color.'}
			.top-bar-section .dropdown li a {color: '.$menu_text_color.'}
			.top-bar-section ul.right {background-color: '.$menu_bg_color.'}
		';
	
	/*content*/
	echo'
		h1.entry-title {color: '.$page_title_color.';}
		#content h1.entry-title a {color: '.$post_title_color.';}
		.entry-content { color:  '.$content_text_color.';}
		#content a.read-more-button.button	{color: '.$excerpt_button_text_color.';}
		.read-more a.button {background-color: '.$excerpt_button_bg_color.';}
	';
		/*slider*/
		echo'
	
		';
		
		/*masonry*/
		echo'
	
		';
	/*sidebar*/
	echo'
		#secondary {color: '.$sidebar_text_color.';}
		#secondary a {color: '.$sidebar_link_color.';}
		h5.widget-title {color: '.$widget_title_color.';}
	';
	
	/*footer*/
	echo'
	
	';

	//if the background for the header is not set to transparent use $header_bg_color else just let it transparent.
	if (! $options['header-trans-bg'] == '' ) { 	
		echo '#masthead {background-color:';
		echo $header_bg_color;
		echo '}';
	}
	
	//if the background for the sidebar is not set to transparent use $sidebar_bg_color else just let it transparent.
	if (! $options['sidebar-trans-bg'] == '' ) { 	
		echo '#secondary {background-color:';
		echo $sidebar_bg_color;
		echo '}';
	}
	
	//if the background for the footer is not set to transparent set background color.
	if (! $options['footer-trans-bg'] == '' ) { 	
		echo '.site-footer {background-color:';
		echo $footer_bg_color;
		echo '}';
	}
	
	//if the background for the content is not set to transparent set background color.
	if (! $options['content-trans-bg'] == '' ) { 
		echo '#primary {background-color:';
		echo $content_bg_color;
		echo '}';
		echo '.top-bar{paddding-right:15px}';
	}
	
	// If page background is not set to full-screen image set a color background.
	if (! $options['body_bg_choice'] == '' ) { 
		echo 'body{background-color:';
		echo $page_bg_color;
		echo ';}';
	}

	
//style masonry boxes if we are using masonry today
	if ( $options['_sf_masonry'] == '' ) {
		echo '.masonry-entry{background-color:';
		echo $masonry_bg_color;
		echo '; border-color:';
		echo $masonry_border_color;
		echo '; width:';
		_sf_masonry_width($use='css');
		echo '}';
		echo '.masonry-post-title{color:';
		echo $masonry_title_color;
		echo ';}';
		echo '.masonry-post-excerpt .excerpt{color:';
		echo $masonry_excerpt_text_color;
		echo ';}';
		echo '#content {padding: 0 0 0 0;}';
	}

//style home page slider, if we are using it.
	if (! $options['_sf_slider_visibility'] == '' ) { 
		echo '.orbit-container {background-color:';
		echo $slider_bg_color;
		echo ';}';
		echo '#content h1.slider-entry-title a {color:';
		echo $slider_title_color;
		echo ';}';
		echo '#content a.slider.button {color:';
		echo $slider_button_text_color;
		echo ';}';
		echo '.slider-read-more a.button {';
		echo ';background-color:';
		echo $slider_button_bg_color;
		echo ';}';
		echo '.slider-entry-content .excerpt{color:';
		echo $slider_excerpt_text_color;
		echo ';}';	
	}

echo '</style>';

}


 
