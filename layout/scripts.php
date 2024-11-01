<script>
	var tw_img_dir = "<?php echo $pluginurl; ?>";
	<?php $button_array = explode(',',get_option('tw_social_buttons'));
	    $image_info = '';
	    foreach($button_array as $p){
	        if($p != ''){
	            $image_info .= $p.':"'.$social_urls[$p].'",';
	        }
	    }
	    if($image_info == ''){
	        add_option('tw_social_buttons',sanitize_text_field('facebook').','.sanitize_text_field('twitter'));
	        $image_info = 'facebook:"http://www.facebook.com/share.php?u=TW_URL&title=TW_Title%20-TW_Site",';
	        $image_info .= 'twitter:"http://twitter.com/intent/tweet?status=TW_Title%20-TW_Site+TW_URL"';
	    }
	    global $post;
	    $category = get_the_category($post->ID);
	    
	    $order = json_decode(check_order_status(),true);
	    if($order['status'] != 'ordered'){
	        $quantic_post = get_option('tw_remove_quantic');
	        $logo = '<a href="http://quanticpost.com/imageshare" target="_blank">QPIS</a>';
	    } else {
	    	$logo = '<a href="http://quanticpost.com/imageshare" target="_blank"></a>';
	    }
	?>
	var tw_icon_set = '<?php echo get_option('tw_icon_set'); ?>';
	var tw_site = '<?php if(get_option('tw_title') == 'post_title'){ echo $post->post_title; } else { echo get_bloginfo('name'); } ?>';
	var tw_menu_layout = '<?php echo get_option('tw_menu_alignment'); ?>';
	var tw_quantic_post = '<?php if($quantic_post != 'quantic_post_removed') echo 'Quantic Image Sharer'; ?>';
	var tw_image_info = {<?php echo $image_info; ?>};
	var tw_category = '<?php echo $category[0]->name; ?>';
	var tw_src_url = '<?php echo $post->guid; ?>';
	var tw_image_post = '<?php echo $image_post; ?>';
	var logo = '<?php echo $logo; ?>';
</script>