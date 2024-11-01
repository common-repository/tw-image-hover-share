<?php
    /*
    Plugin Name: TW Image Hover effect
    Plugin URI: http://www.taureanwooley.com
    Description: This plugin uses the ability to download as well as share images based on hover effect.
    Author: Taurean Wooley
    Version: 1.0.8
    Author URI: http://www.taureanwooley.com
    */
    if (!function_exists('twp_admin_actions')) {
        function tw_image_share_admin_actions() {
			add_menu_page(
				'TW Image Sharer', 
				'TW Image Sharer',
				'publish_posts',
				'tw_image_share_admin',
				'tw_image_share_admin'
			);
		}
        add_action('admin_menu', 'tw_image_share_admin_actions');
        
        function tw_image_share_theme_options(){
            include("views/theme_options.php");
        }
        
        function tw_image_share_enqueue_style() {
			wp_enqueue_style('tw_image_share_hover',plugins_url('css/style.css',__FILE__));
		}
		add_action( 'wp_enqueue_scripts', 'tw_image_share_enqueue_style' );
		
		function gallery_box(){
			$url = home_url('/');
			$url = parse_url($url);
			$url = str_replace('.','^',$url['host']);
			$contents =  file_get_contents('http://quanticpost.com/getdata/get_image_share/'.$url);
			if($contents != ''){
				$json = json_decode($contents,true);
			} else {
				$url = 'http://quanticpost.com/getdata/get_image_share/'.$url;
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$data = curl_exec($ch);
				curl_close($ch);
				
				$json = json_decode($data,true);
			}
			
			$info_holder = array();
			
			foreach($json as $k=>$j){
				$info_holder[$k] = array();
				foreach($j as $d=>$f){
					$info_holder[$k][$f['image']]['network'] .= $f['network'].',';
					$info_holder[$k][$f['image']]['image'] = $f['image'];
				}
			}
			
			foreach($info_holder as $k=>$f){
				echo '<h1>'.$k.'</h1>';
				echo '<div class="tw_main_holder">';
				foreach($f as $v=>$a){
					echo '<div class="tw_gallery_holder"><img src="'.str_replace('__','/',str_replace('^','.',$v)).'" style="width: 100%;"/></div>';
				}
				echo '<div class="clear"></div>';
				echo '</div>';
			}
		}
		add_shortcode('gallery_box','gallery_box');
		
		function tw_image_share_header(){
		    $social_urls = array('twitter'=>'http://twitter.com/intent/tweet?status=TW_Title%20-TW_Site+TW_URL',
    					'facebook'=>'http://www.facebook.com/share.php?u=TW_URL&title=TW_Title%20-TW_Site',
    					'reddit'=>'http://www.reddit.com/submit?url=TW_URL&title=TW_Title%20-TW_Site',
   						'google_plus'=>'https://plus.google.com/share?url=TW_URL',
   						'pinterest'=>'https://pinterest.com/pin/create/bookmarklet/?media=TW_URL&url=TW_URL&is_video=false&description=TW_Title%20-TW_Site',
   						'digg'=>'http://digg.com/submit?url=TW_URL&title=TW_Title%20-TW_Site',
   						'tumblr'=>'http://www.tumblr.com/share/link?url=TW_URL&name=TW_Title%20TW_Site&description=TW_Title%20-TW_Site',
   						'stumbleupon'=>'http://www.stumbleupon.com/submit?url=TW_URL&title=TW_Title%20-TW_Site');
            $icons = get_option('tw_social_image_icons');
            $image_post = get_option('tw_image_post');
            if($icons == '') $icons = 'bw-circle';
            
            $pluginurl = 'http://quanticpost.com/images/icons/png/lg_icon_kit/'.$icons.'/small';
    
		    include_once(plugin_dir_path(__FILE__).'/layout/scripts.php');
		}
		add_action('wp_head','tw_image_share_header');
		
		function check_order_status(){
		    $plugin_info = str_replace('/','_',str_replace('.','^',plugins_url(__FILE__)));
		    $file = file_get_contents('http://quanticpost.com/getdata/check_order_status/'.$plugin_info);
		    return $file;
		}
		
		function tw_image_share_enqueue_scripts() {
            wp_enqueue_script( 'tw_image_share_hover', plugins_url('js/tw_image_share_hover.js',__FILE__), array(), '1.0.0', true );
        }
        add_action( 'wp_enqueue_scripts', 'tw_image_share_enqueue_scripts' );
        
        function tw_image_share_admin() {
            $social_buttons = '';
            if(isset($_POST['tw_social_image_sharer'])){
                delete_option('tw_social_buttons');
                delete_option('tw_menu_alignment');
                delete_option('tw_social_image_icons');
                delete_option('tw_image_post');
                delete_option('tw_title');
                delete_option('tw_remove_quantic');
                foreach($_POST['tw_social_image_sharer'] as $k=>$f){
                    $social_buttons .= sanitize_text_field($k).',';
                }
                if($_POST['tw_image_post'] != ''){
                    $image_post = $_POST['tw_image_post'];
                } else {
                    $image_post = 'image';
                }
                $title = sanitize_text_field($_POST['tw_title']);
                $quantic_title = (isset($_POST['tw_remove_quantic']))?'quantic_post_removed':'';
                add_option('tw_image_post',$image_post);
                add_option('tw_social_buttons',$social_buttons);
                add_option('tw_menu_alignment',sanitize_text_field($_POST['tw_social_image_menu']));
                add_option('tw_social_image_icons',str_replace('tw_image_share_','',sanitize_text_field($_POST['tw_social_image_icons'])));
                add_option('tw_title',$title);
                $order_status = json_decode(check_order_status(),true);
                if($order_status['status'] == 'ordered'){
                    $quantic_title = $order_status['code'].$quantic_title;
                    add_option('tw_remove_quantic',$quantic_title);
                }
                $selected = explode(',',$social_buttons);
                
                $social_select = array();
                foreach($selected as $f){
                    $social_select[$f] = true;
                }
                
                $social_menu = $_POST['tw_social_image_menu'];
                $social_icon = $_POST['tw_social_image_icons'];
            } else {
                $social_buttons = get_option('tw_social_buttons');
                $social_menu = get_option('tw_menu_alignment');
                $image_post = get_option('tw_image_post');
                $title = get_option('tw_title');
                $order = json_decode(str_replace("\\",'',check_order_status()),true);
                if($order['status'] == 'ordered'){
                    $quantic_title = get_option('tw_remove_quantic');
                }
                $social_icon = 'tw_image_share_'.get_option('tw_social_image_icons');
                
                $selected = explode(',',$social_buttons);
                
                $social_select = array();
                foreach($selected as $f){
                    $social_select[$f] = true;
                }
            }
        	include('admin_page.php');
        }
    }
?>
