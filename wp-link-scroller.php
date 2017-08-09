<?php
/*
Plugin Name: WP Link Scroller
Plugin URI: http://nebster.net
Description: Plugin creates slow scrolling for your #anchor links. 
Version: 1.1
Author: Игорь Тронь
Author URI: http://nebster.net
*/	
	$wpls_url = plugin_dir_url( __FILE__ ) ;
	$wpls_url = substr( $wpls_url, 0, -1 );
	$wpls_path = __DIR__ ;
	
	require( $wpls_path . '/inc/classes.php' );
	require( $wpls_path . '/inc/settings.php' );
	require( $wpls_path . '/inc/fields.php' );
	
	$wpls = new wpls\WP_Link_Scroller;
	
	add_action( 'wp_footer', 'wpls_footer', 1000 );
	function wpls_footer(){
		global $wpls;
		$options['delay'] = $wpls->getOption( 'main_section::delay' );
		$options['delay'] = $options['delay'] != '' ? $options['delay'] : @$wpls->fields[ 'main_section' ][1][ 'delay' ][2]['default'];
		$options['offset'] = $wpls->getOption( 'main_section::offset' );
		$options['offset'] = $options['offset'] != '' ? $options['offset'] : @$wpls->fields[ 'main_section' ][1][ 'offset' ][2]['default'];
	?>
	
	<script>
		jQuery( 'body' ).on( "click","a", function (event) {

			var href  = jQuery( this ).attr( 'href' );
			if ( href.charAt(0) == '#' ){
				var top = jQuery( href ).offset().top - <?php echo $options['offset']; ?>;
				jQuery('body,html').animate({scrollTop: top}, <?php echo $options['delay']; ?>);
			}
		});
	</script>
	<?php
	};