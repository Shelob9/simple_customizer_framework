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
	$options = $options['_sf');
	$content_text_color = $options['content_text_color'];
	$content_link_color = $options['content_link_color'];
	$site_description_color = $options['site_description_color'];
	$post_title_color = $options['post_title_color'];
	$menu_text_color = $options['menu_text_color'];
	$site_name_color = $options['site_name_color'];
	$content_bg_color = $options['content_bg_color'];
	$header_bg_color = $options['header_bg_color'];
	$menu_bg_color = $options['menu_bg_color'];
	$menu_hover_color = $options['menu_hover_color'];
	$search_but_txt = $options['menu_search_txt_color'];
	$search_but_bg = $options['menu_search_bg_color'];
	$search_but_txt_hv = $options['menu_search_txt_color_hv'];
	$search_but_bg_hv = $options['menu_search_bg_color_hv'];
	$page_bg_color = $options['page_bg_color'];
	$sidebar_bg_color = $options['sidebar_bg_color'];
	$footer_bg_color = $options['footer_bg_color'];
	$masonry_bg_color = $options['masonry_bg_color'];
	$masonry_excerpt_text_color = $options['masonry_excerpt_text_color'];
	$masonry_title_color = $options['masonry_title_color'];
	$masonry_border_color = $options['masonry_border_color'];
	$sidebar_text_color = $options['sidebar_text_color'];
	$sidebar_link_color = $options['sidebar_link_color'];
	$widget_title_color = $options['widget_title_color'];
	$page_title_color = $options['page_title_color'];
	$slider_bg_color = $options['slider_bg_color'];
	$slider_title_color = $options['slider_title_color'];
	$slider_button_bg_color = $options['slider_button_bg_color'];
	$slider_button_text_color = $options['slider_button_text_color'];
	$slider_excerpt_text_color = $options['slider_excerpt_text_color'];
	$excerpt_button_bg_color = $options['excerpt_button_bg_color'];
	$excerpt_button_text_color = $options['excerpt_button_text_color'];
	
echo '<style>'; ?>
	.entry-content { color:  <?php echo $content_text_color; ?>; }
	#content a { color:  <?php echo $content_link_color; ?>; }
	.site-description {color: <?php echo $site_description_color; ?> }
	#content h1.entry-title a {color: <?php echo $post_title_color; ?> }
	.top-bar-section ul li>a {color: <?php echo $menu_text_color; ?> }
	.top-bar .name h1 a, h1.site-title a {color: <?php echo $site_name_color; ?> }
	.top-bar, .top-bar-section li a:not(.button) {background-color: <?php echo $menu_bg_color; ?> }
	.top-bar-section>ul>.divider
	{border-bottom-color: <?php echo $menu_bg_color; ?>;
	 border-top-color: <?php echo $menu_bg_color; ?>;
	 border-left-color: <?php echo $menu_bg_color; ?>;
	 border-right-color: <?php echo $menu_bg_color; ?>;
	 }
	.top-bar-section ul li>a.button {<?php echo 'color:'. $search_but_txt.'; background-color:'.$search_but_bg.';'; ?>}
	.top-bar-section ul li>a.button:hover{<?php echo 'color:'. $search_but_txt_hv.'; background-color:'.$search_but_bg_hv.';'; ?>}
	.top-bar-section li a:not(.button):hover {background-color: <?php echo $menu_hover_color; ?> }
	.top-bar-section .dropdown li a {color: <?php echo $menu_text_color; ?> }
	.top-bar-section ul.right {background-color: <?php echo $menu_bg_color; ?> }
	#secondary {color: <?php echo $sidebar_text_color; ?>;}
	#secondary a {color: <?php echo $sidebar_link_color; ?>;}
	h5.widget-title {color: <?php echo $widget_title_color; ?>;}
	h1.entry-title {color: <?php echo $page_title_color; ?>;}
	#content a.read-more-button.button	{color: <?php echo $excerpt_button_text_color; ?>;}
	.read-more a.button {background-color: <?php echo $excerpt_button_bg_color; ?>;}
	<?php

	//if the background for the header is not set to transparent use $header_bg_color else just let it transparent.
	if (! get_theme_mod( 'header-trans-bg' ) == '' ) { 	
		echo '#masthead {background-color:';
		echo $header_bg_color;
		echo '}';
	}
	
	//if the background for the sidebar is not set to transparent use $sidebar_bg_color else just let it transparent.
	if (! get_theme_mod( 'sidebar-trans-bg' ) == '' ) { 	
		echo '#secondary {background-color:';
		echo $sidebar_bg_color;
		echo '}';
	}
	
	//if the background for the footer is not set to transparent set background color.
	if (! get_theme_mod( 'footer-trans-bg' ) == '' ) { 	
		echo '.site-footer {background-color:';
		echo $footer_bg_color;
		echo '}';
	}
	
	//if the background for the content is not set to transparent set background color.
	if (! get_theme_mod( 'content-trans-bg' ) == '' ) { 
		echo '#primary {background-color:';
		echo $content_bg_color;
		echo '}';
		echo '.top-bar{paddding-right:15px}';
	}
	
	// If page background is not set to full-screen image set a color background.
	if (! get_theme_mod( 'body_bg_choice' ) == '' ) { 
		echo 'body{background-color:';
		echo $page_bg_color;
		echo ';}';
	}

	
//style masonry boxes if we are using masonry today
	if ( get_theme_mod( '_sf_masonry' ) == '' ) {
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
	if (! get_theme_mod( '_sf_slider_visibility' ) == '' ) { 
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


 
