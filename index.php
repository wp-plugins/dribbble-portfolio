<?php
/*
Plugin Name: Dribbble Portfolio
Plugin URI: http://kentothemes.com
Description: dribbble shots wordpress, dribbble shots, dribbble portfolio wordpress, dribbble shots display website
Version: 1.0
Author: KentoThemes
Author URI: http://kentothemes.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


wp_enqueue_script('jquery');
define('KENTO_DERRIBLE_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
wp_enqueue_style('kento-deribble-style', KENTO_DERRIBLE_PLUGIN_PATH.'css/style.css');

wp_enqueue_script('kento-deribble-js', plugins_url( '/js/kento-deribble-ajax.js' , __FILE__ ) , array( 'jquery' ));




add_shortcode('deribble_shots', 'deribble_shots');

function deribble_shots($atts, $content = null) {

        $atts = shortcode_atts(
            array(
				'bgcolor' => '',
				'border_color' => '',
                'userid' => '',
				'count' => '',
            ), $atts);




$url = 'http://api.dribbble.com/players/'.$atts['userid'].'/shots';



$json = file_get_contents($url);
$decoded_json = json_decode($json, true) ;





// $shots_count = count($decoded_json['shots']).'<br />';

$shots_count = $atts['count'];


deribble_shots_style($atts['bgcolor'],$atts['border_color']);


echo "<div id='deribble-shots'>";
echo "<div class='deribble-player'>";
echo "<div class='deribble-player-thumb'>";
echo "<img src='".$decoded_json['shots'][0]['player']['avatar_url']."' />";
echo "</div>";
echo "<div class='deribble-player-name'>";
echo "<a href='".$decoded_json['shots'][0]['player']['url']."'>";
echo $decoded_json['shots'][0]['player']['name'];
echo "</a>";
echo "</div>";
echo "<div class='deribble-player-location'>";
echo $decoded_json['shots'][0]['player']['location'];
echo "</div>";

echo "</div>";
echo "<ul id='' >";

for($i=0; $i<$shots_count;$i++)
	{	
	
		echo "<li class='ds-items'>";
		echo "<div link='".$decoded_json['shots'][$i]['image_url']."' class='ds-items-thumbs'>";
		echo "<img src='";
		echo $decoded_json['shots'][$i]['image_teaser_url'];
		echo "' />";
		echo "</div>";
		echo "<div class='ds-items-name'>";
		echo "<a href='";
		echo $decoded_json['shots'][$i]['url'];
		echo "'>";
		echo $decoded_json['shots'][$i]['title'];
		echo "</a>";
		echo "</div>";
		echo "<div class='ds-items-info'>";
		echo "<ul>";
		echo "<li class='ds-items-info-view'>";
		echo $decoded_json['shots'][$i]['views_count'];
		echo "</li>";
		echo "<li class='ds-items-info-comment'>";
		echo $decoded_json['shots'][$i]['comments_count'];
		echo "</li>";
		
		echo "<li class='ds-items-info-like'>";
		echo $decoded_json['shots'][$i]['likes_count'];
		echo "</li>";
		echo "</ul>";
		echo "</div>";		
		
		echo "</li>";
		
	
	}

echo "</ul>";
echo "</div>";
echo "<div id='ds-popup'>";
echo "<img title='click to close' width='100%' src='' />";
echo "</div>";
}






function deribble_shots_style($bgcolor,$border_color)
	{
		echo "<style type='text/css'>";
		echo "
		#deribble-shots
			{
				background-color: ".$bgcolor.";
			}
		#deribble-shots .ds-items
			{
				background-color: ".$border_color.";
			}
		#deribble-shots .deribble-player .deribble-player-thumb img
			{
				 border: 5px solid ".$border_color.";
			}

			
			";
		
		echo "</style>";
	
	}










?>