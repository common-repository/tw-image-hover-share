<style>
    .information{
        padding: 10px;
        margin-right: 20px;
        margin-top: 50px;
        color: #545454;
    }
    .clear{
        clear: both;
    }
    .share-holder div{
        float: left;
        width: 150px;
        margin-bottom: 10px;
    }
    .share-hover-style div{
        float: left;
        width: 120px;
        margin-bottom: 10px;
    }
    .share-hover-style p{
        clear: both;
    }
    .information p{
        border-bottom: 1px solid #ababab;
        padding: 5px;
        font-weight: bold;
        clear: both;
    }
    .share-icon-holder .image-holder{
        width: 100px;
        float: left;
    }
    .image-holder{
        text-align: center;
        margin: 10px;
        background: #242424;
        padding: 10px;
        color: #fff;
        box-shadow: 0px 2px 5px rgba(0,0,0,.3);
    }
</style>
<?php
    $donate_link = 'http://quanticpost.com/image_share_remove/'.str_replace('/','_',str_replace('.','^',get_bloginfo('url')));
?>
<div class="information">
    <h1>TW Image Sharer <a href="<?php echo $donate_link; ?>" target="_blank" style="padding: 10px; background: #458B00; color: #fff; text-decoration: none;">Purchase</a></h1>
    <form action="" method="POST">
        <p>
            Choose the social networks that you would like to share on.
        </p>
        <div class="share-holder">
            <div>
                <input type="checkbox" name="tw_social_image_sharer[facebook]" value="tw_facebook" <?php if(isset($social_select['facebook'])) echo 'checked'; ?>/>
                Facebook
            </div>
            <div>
                <input type="checkbox" name="tw_social_image_sharer[twitter]" value="tw_twitter" <?php if(isset($social_select['twitter'])) echo 'checked'; ?>/>
                Twitter
            </div>
            <div>
                <input type="checkbox" name="tw_social_image_sharer[google_plus]" value="tw_google_plus" <?php if(isset($social_select['google_plus'])) echo 'checked'; ?>/>
                Google +
            </div>
            <div>
                <input type="checkbox" name="tw_social_image_sharer[pinterest]" value="tw_pinterest" <?php if(isset($social_select['pinterest'])) echo 'checked'; ?>/>
                Pinterest
            </div>
            <div>
                <input type="checkbox" name="tw_social_image_sharer[digg]" value="tw_digg" <?php if(isset($social_select['digg'])) echo 'checked'; ?>/>
                Digg
            </div>
            <div>
                <input type="checkbox" name="tw_social_image_sharer[tumblr]" value="tw_tumblr" <?php if(isset($social_select['tumblr'])) echo 'checked'; ?>/>
                Tumblr
            </div>
            <div>
                <input type="checkbox" name="tw_social_image_sharer[reddit]" value="tw_reddit" <?php if(isset($social_select['reddit'])) echo 'checked'; ?>/>
                Reddit
            </div>
            <div>
                <input type="checkbox" name="tw_social_image_sharer[stumbleupon]" value="tw_stumbleupon" <?php if(isset($social_select['stumbleupon'])) echo 'checked'; ?>/>
                Stumbleupon
            </div>
            <div class="clear"></div>
        </div>
        <p>Linkability</p>
        <div class="clear">
            <div style="margin-bottom: 10px; background: #242424; padding: 10px; color: #fff;">
                <input type="radio" name="tw_image_post" value="image" <?php if($image_post == 'image' || $image_post == '') echo 'checked'; ?> />Link to images only
            </div>
            <div style="padding: 10px; background: #242424; color: #fff;">
                <input type="radio" name="tw_image_post" value="post" <?php if($image_post == 'post') echo 'checked'; ?> />Link to post containing image
            </div>
        </div>
        <p>Title</p>
        <div class="clear">
            <div style="margin-bottom: 10px; background: #242424; padding: 10px; color: #fff;">
                <input type="radio" name="tw_title" value="post_title" <?php if($title == 'post_title' || $title == '') echo 'checked'; ?> /> Display Post Title
            </div>
            <div style="padding: 10px; background: #242424; color: #fff; margin-bottom: 10px;">
                <input type="radio" name="tw_title" value="website_title" <?php if($title == 'website_title') echo 'checked'; ?> /> Display Website Title
            </div>
            <div style="padding: 10px; background: #242424; color: #fff;">
                <input type="checkbox" name="tw_remove_quantic" class="tw_remove_quantic" value="quantic_post_removed" <?php if($quantic_title == 'quantic_post_removed') echo 'checked'; ?> />Remove Quanticpost Title <a href="<?php echo $donate_link; ?>" target="_blank">Purchase</a>
            </div>
        </div>
        <script>
            var quantic = document.getElementsByClassName('tw_remove_quantic')[0];
            quantic.onclick = function(){
                window.open('<?php echo $donate_link; ?>');
            }
        </script>
        <p>
            Choose style of hover menu.
        </p>
        <div class="share-hover-style">
            <div class="image-holder">
                left aligned
                <input type="radio" name="tw_social_image_menu" value="tw_image_share_menu1" <?php if($social_menu == 'tw_image_share_menu1') echo 'checked'; ?>/>
            </div>
            <div class="image-holder">
                right aligned
                <input type="radio" name="tw_social_image_menu" value="tw_image_share_menu2" <?php if($social_menu == 'tw_image_share_menu2') echo 'checked'; ?>/>
            </div>
            <div class="image-holder">
                bottom aligned
                <input type="radio" name="tw_social_image_menu" value="tw_image_share_menu3" <?php if($social_menu == 'tw_image_share_menu3') echo 'checked'; ?>/>
            </div>
            <div class="image-holder">
                top aligned
                <input type="radio" name="tw_social_image_menu" value="tw_image_share_menu4" <?php if($social_menu == 'tw_image_share_menu4') echo 'checked'; ?>/>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="share-icon-holder">
            <div class="image-holder">
                Color Circle
                <img src="<?php echo 'http://quanticpost.com/images/icons/png/lg_icon_kit/mini-circle/small/facebook.png'; ?>"/>
                <img src="<?php echo 'http://quanticpost.com/images/icons/png/lg_icon_kit/mini-circle/small/google_plus.png'; ?>"/>
                <img src="<?php echo 'http://quanticpost.com/images/icons/png/lg_icon_kit/mini-circle/small/pinterest.png'; ?>"/>
                <div><input type="radio" name="tw_social_image_icons" value="tw_image_share_mini-circle" <?php if($social_icon == 'tw_image_share_mini-circle') echo 'checked'; ?>/></div>
            </div>
            <div class="image-holder">
                Color Square
                <img src="<?php echo 'http://quanticpost.com/images/icons/png/lg_icon_kit/mini-square/small/facebook.png'; ?>"/>
                <img src="<?php echo 'http://quanticpost.com/images/icons/png/lg_icon_kit/mini-square/small/google_plus.png'; ?>"/>
                <img src="<?php echo 'http://quanticpost.com/images/icons/png/lg_icon_kit/mini-square/small/pinterest.png'; ?>"/>
                <div><input type="radio" name="tw_social_image_icons" value="tw_image_share_mini-square" <?php if($social_icon == 'tw_image_share_mini-square') echo 'checked'; ?>/></div>
            </div>
            <div class="image-holder">
                Color Circle
                <img src="<?php echo 'http://quanticpost.com/images/icons/png/lg_icon_kit/ko-circle/small/facebook.png'; ?>"/>
                <img src="<?php echo 'http://quanticpost.com/images/icons/png/lg_icon_kit/ko-circle/small/google_plus.png'; ?>"/>
                <img src="<?php echo 'http://quanticpost.com/images/icons/png/lg_icon_kit/ko-circle/small/pinterest.png'; ?>"/>
                <div><input type="radio" name="tw_social_image_icons" value="tw_image_share_ko-circle" <?php if($social_icon == 'tw_image_share_ko-circle') echo 'checked'; ?>/></div>
            </div>
            <div class="image-holder">
                Color Square
                <img src="<?php echo 'http://quanticpost.com/images/icons/png/lg_icon_kit/ko-square/small/facebook.png'; ?>"/>
                <img src="<?php echo 'http://quanticpost.com/images/icons/png/lg_icon_kit/ko-square/small/google_plus.png'; ?>"/>
                <img src="<?php echo 'http://quanticpost.com/images/icons/png/lg_icon_kit/ko-square/small/pinterest.png'; ?>"/>
                <div><input type="radio" name="tw_social_image_icons" value="tw_image_share_ko-square" <?php if($social_icon == 'tw_image_share_ko-square') echo 'checked'; ?>/></div>
            </div>
            <div class="clear"></div>
        </div>
        <p><input type="submit" name="submit" value="Submit"/></p>
    </form>
    
</div>