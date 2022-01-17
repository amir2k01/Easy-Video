<?php

/**
 * 
 *

 *
 * @wordpress-plugin
 * Plugin Name:       EasyVideo
 * Plugin URI:        http://Amirali.com
 * Description:       WordPress Plugin to Fetch videos from youtbe 
 * Version:           1.0.0
 * Author:            Amir Ali
 * Author URI:        http://AmirAli.com/
 * License:           GPL-2.0+
 * Text Domain:       EasyVideo(API)
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'EasyVideo', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_EasyVideo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-EasyVideo-activator.php';
	EasyVideo_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_EasyVideo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-EasyVideo-deactivator.php';
	EasyVideo_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'EasyVideo' );
register_deactivation_hook( __FILE__, 'EasyVideo' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-EasyVideo.php';

		function show_video_youtube( $atts ) {
			//leer attrib que se llame idvideo
			$idvideo=$atts['idvideo'];
			$autoplay=$atts['autoplay'];
			$loop=$atts['loop'];
			$controls=$atts['controls'];
			$mute=$atts['mute'];
			echo("AUTOPLAY: ".$autoplay);
			if(is_numeric($autoplay)){
				if($autoplay>1){
					$autoplay=1;
				}
			}
			else{
				$autoplay=1;
			}
			if(is_numeric($loop)){
				if($loop>1){
					$loop=1;
				}
			}
			else{
				$loop=1;
			}
			if(is_numeric($controls)){
				if($controls>1){
					$controls=0;
				}
			}
			else{
				$controls=0;
			}
			if(is_numeric($mute)){
				if($mute>1){
					$mute=1;
				}
			}
			else{
				$mute=1;
			}
			// $atts = shortcode_atts( array(
			// 	'foo' => 'no foo',
			// 	'baz' => 'default baz'
			// ), $atts, 'bartag' );
			if(!empty($idvideo) && !is_admin()){
				?>
				<!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
				<div id="contentplayer">
					<div id="player"></div>
				</div>

				<script>
					// 2. This code loads the IFrame Player API code asynchronously.
					var tag = document.createElement('script');

					tag.src = "https://www.youtube.com/iframe_api";
					var firstScriptTag = document.getElementsByTagName('script')[0];
					firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

					// 3. This function creates an <iframe> (and YouTube player)
					//    after the API code downloads.
					var player;
					function onYouTubeIframeAPIReady() {
						player = new YT.Player('player', {
							height: '360',
							width: '640',
							videoId: '<?php echo($idvideo); ?>',
							playerVars:{
								'autoplay':<?php echo($autoplay); ?>,
								'loop':<?php echo($loop); ?>,
								'controls':<?php echo($controls); ?>,
								'mute':<?php echo($mute); ?>
							},
							events: {
								'onReady': onPlayerReady,
								'onStateChange': onPlayerStateChange
							}
						});
					}
					// 4. The API will call this function when the video player is ready.
					function onPlayerReady(event) {
						event.target.playVideo();
					}

					// 5. The API calls this function when the player's state changes.
					//    The function indicates that when playing a video (state=1),
					//    the player should play for six seconds and then stop.
					var done = false;
					function onPlayerStateChange(event) {
						var autoplayVar;
						autoplayVar=player.b.b.playerVars.autoplay;
						if(autoplayVar==1){
							if (event.data ==YT.PlayerState.ENDED) {
								event.target.playVideo();
							}
						}
						else{
							event.target.stopVideo();
						}
					}
					function playVideo(event) {
						event.target.playVideo();
					}
					function stopVideo(event) {
						event.target.stopVideo();
					}
				</script>
				<?php
			}
			return 0;
		}
		add_shortcode( 'videoyoutube', 'show_video_youtube' );
/*
****************************
*/
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_EasyVideo() {

	$plugin = new ytplayer();
	$plugin->run();

}
run_EasyVideo();
