window.onload = function(){
    var tw_img_holder = document.getElementsByTagName('img');
    
    var tw_menu_timeout = setTimeout(function(){ },500);
    
    function tw_set_info(tw_share_image_menu,tw_info){
		tw_share_image_menu.style.display = 'none';
	}
    
    var tw_div_holder = document.createElement('div');
    tw_div_holder.setAttribute('class','tw_image_hover');
    var tw_div = document.createElement('div');
    tw_div.setAttribute('class','tw_menu_item');
   	
    for(a in tw_image_info){
        tw_div.innerHTML += '<div class="tw_share_button tw_'+a+'"><img src="'+tw_img_dir+'/'+a+'.png" width="30px"/></div>';
    }
	tw_div.innerHTML += '<div class="tw_logo">'+logo+'</div>';
	tw_div_holder.appendChild(tw_div);
    document.getElementsByTagName('body')[0].appendChild(tw_div_holder);
    
    window.onresize = function(){
        document.getElementsByClassName('tw_image_hover')[0].style.display = 'none';
    }
    
    var tw_currently_selected = tw_convert_category(tw_currently_selected);
    
    function tw_convert_category(encodedHtml){
        encodedHtml = encodeURI(encodedHtml);
        encodedHtml = encodedHtml.replace(/\//g,"__");
        encodedHtml = encodedHtml.replace(/\?/g,"%3F");
        encodedHtml = encodedHtml.replace(/=/g,"%3D");
        encodedHtml = encodedHtml.replace(/&/g,"%26");
        encodedHtml = encodedHtml.replace(/@/g,"%40");
        encodedHtml = encodedHtml.replace(/\./g,'^');
        
        return encodedHtml;
    }
    
    function check_parent_node_block(el,original){
        if(original){
            return original
        }
    }
    
    var iframe = document.createElement('iframe');
    iframe.setAttribute('class','tw_user_interaction');
    iframe.style.display = 'none';
    iframe.style.height = '0px';
    iframe.style.width = '0px';
    document.getElementsByTagName('body')[0].appendChild(iframe);
    var tw_user_interaction = document.getElementsByClassName('tw_user_interaction')[0];
    
    var tw_share_buttons = document.getElementsByClassName('tw_share_button');
    var tw_currently_selected = '';
    
    tw_url = tw_src_url;
    tw_src_url = tw_convert_category(tw_src_url);
    
    for(var i = 0; i < tw_share_buttons.length; ++i){
        tw_share_buttons[i].onclick = function(el){
            var share = el.currentTarget.getAttribute('class').replace('tw_share_button ','').replace('tw_','');
            var tw_share_info = tw_image_info[share];
            
            var re = new RegExp('TW_Site', 'g');
            tw_share_info = tw_share_info.replace(re,tw_site);
            var sre = new RegExp('TW_URL', 'g');
            if(tw_image_post == 'image'){
                tw_share_info = tw_share_info.replace(sre,tw_currently_selected);
            } else {
                tw_share_info = tw_share_info.replace(sre,tw_url);
            }
            var ssh = new RegExp('TW_Title', 'g');
            tw_share_info = tw_share_info.replace(ssh,tw_quantic_post);
            tw_currently_selected = tw_currently_selected.replace(/&/g,"%26");
            
            
            window.open(tw_share_info);
            tw_category = tw_convert_category(tw_category);
            tw_currently_selected_holder = tw_convert_category(tw_currently_selected);
            
            tw_user_interaction.src = "http://quanticpost.com/tw_image_share_record/"+tw_currently_selected_holder+'/'+tw_category+'/'+tw_src_url+'/'+share;
        }
    }
    
    var tw_share_animate = setTimeout(function(){},0);
    
    function animate(top_start,top_end,el,target){
        if(top_start > top_end){
            top_start -= 30;
            el.style.top = top_start+'px';
            clearTimeout(tw_share_animate);
            tw_share_animate = setTimeout(function(){ animate(top_start,top_end,el) },20);
        } else {
            clearTimeout(tw_share_animate);
        }
    }
    
    var cumulativeOffset = function(element) {
        var top = 0, left = 0;
        do {
            top += element.offsetTop  || 0;
            left += element.offsetLeft || 0;
            element = element.offsetParent;
        } while(element);
        
        return {
            top: top,
            left: left
        };
    };
    
    var current_img = null;
    var completed = [];
    
    for(var i = 0; i < tw_img_holder.length; ++i){
    	var image = new Image();
    	image.info = tw_img_holder[i];
    	
		if(typeof tw_img_holder[i].parentNode != undefined && tw_img_holder[i].parentNode.getAttribute('class') != undefined && tw_img_holder[i].parentNode.getAttribute('class').search('tw_share_button') !== 0){
            if(tw_img_holder[i].offsetWidth >= 300 && tw_img_holder[i].offsetHeight >= 200){
                var tw_node = document.createElement('div');
                tw_node.setAttribute('class','hover_trigger')
                tw_img_holder[i].parentNode.appendChild(tw_node);
                
                if(tw_img_holder[i].parentNode.getAttribute('class') != undefined && tw_img_holder[i].parentNode.getAttribute('class').search('tw_share_button') == -1){
                    tw_img_holder[i].addEventListener('mouseover',function(el){
                        if(el.target.parentNode.getElementsByTagName('img')[0].getAttribute('src') != null && current_img != el.target.parentNode.getElementsByTagName('img')[0].getAttribute('src')){
                            current_img = el.target.parentNode.getElementsByTagName('img')[0].getAttribute('src');
                            var tw_info = el.target.parentNode;
                            var tw_share_image_menu = document.getElementsByClassName('tw_menu_item')[0];
                            var testing = new cumulativeOffset(el.currentTarget);
                            var tw_image_hover_over = document.getElementsByClassName('tw_image_hover')[0];
                            
                            tw_image_hover_over.style.display = 'block';
                            tw_image_hover_over.style.overflow = 'hidden';
                            tw_image_hover_over.style.width = el.target.offsetWidth-(el.target.offsetWidth-100)+'px';
                            tw_image_hover_over.style.height = el.target.offsetHeight+'px';
                            tw_image_hover_over.style.position = 'absolute';
                            tw_image_hover_over.style.top = parseInt(testing.top)+'px';
                            
                            tw_share_image_menu.style.display = 'block';
                            tw_share_image_menu.style.position = 'absolute';
                            tw_share_image_menu.style.background = 'rgba(0,0,0,.5)';
                            tw_share_image_menu.style.borderRadius = '3px';
                            
                            logo_holder = document.getElementsByClassName('tw_logo')[0];
                            logo_holder.style.fontFamily = 'arial';
                            logo_holder.style.fontSize = '16px';
                            
                            switch(tw_menu_layout){
                                case 'tw_image_share_menu3':
                                	// bottom
                                    tw_share_image_menu.style.left = '30px';
                                    tw_share_image_menu.style.width = parseInt(tw_image_hover_over.offsetHeight+300)+'px';
                                    tw_top = (testing.top);
                                    tw_image_hover_over.style.left = testing.left+'px';
                                    
                                    if(testing.left < 0 || testing.left > window.innerWidth){
                                    	tw_image_hover_over.style.left = (el.target.offsetWidth-window.innerWidth-(window.innerWidth/2))+'px';
                                    }
                                    
                                    logo_holder.style.float = 'left';
                                    logo_holder.style.height = '32px';
                                    logo_holder.style.background = '#000';
                                    logo_holder.style.padding = '0px 15px';
                                    logo_holder.style.lineHeight = '30px';
                                    logo_holder.getElementsByTagName('a')[0].style.color = '#fff';
                                    
                                    tw_image_hover_over.style.width = (el.target.offsetWidth-28)+'px';
                                    tw_image_hover_over.style.height = '40px';
                                    if(el.target.parentNode.offsetHeight < el.target.offsetHeight){
                                        var total_offset = (el.target.offsetHeight-el.target.parentNode.offsetHeight)+10;
                                        animate(tw_top+el.target.offsetHeight-(total_offset)+100,tw_top+el.target.offsetHeight-(total_offset),tw_image_hover_over,el.target);
                                    } else {
                                        var total_offset = (el.target.offsetHeight)-20;
                                        animate(tw_top+(total_offset)+100,tw_top+(total_offset),tw_image_hover_over,el.target);
                                    }
                                    break;
                                case 'tw_image_share_menu4':
                                	// top
                                    logo_holder.style.float = 'left';
                                    logo_holder.style.height = '32px';
                                    logo_holder.style.background = '#000';
                                    logo_holder.style.padding = '0px 15px';
                                    logo_holder.style.lineHeight = '30px';
                                    logo_holder.getElementsByTagName('a')[0].style.color = '#fff';
                                    
                                    tw_share_image_menu.style.left = '30px';
                                    tw_share_image_menu.style.width = parseInt(tw_image_hover_over.offsetHeight+300)+'px';
                                    tw_top = (testing.top);
                                    tw_image_hover_over.style.left = testing.left+'px';
                                    tw_image_hover_over.style.width = (el.target.offsetWidth-28)+'px';
                                    tw_image_hover_over.style.height = '40px';
                                    tw_image_hover_over.style.top = tw_top+'px';
                                    animate(tw_top+el.target.offsetHeight,tw_top+70,tw_image_hover_over,el.target);
                                    break;
                                case 'tw_image_share_menu1':
                                	// left
                                    logo_holder.style.float = 'left';
                                    logo_holder.style.height = '30px';
                                    logo_holder.style.background = '#000';
                                    logo_holder.style.padding = '0px 11px';
                                    logo_holder.style.lineHeight = '30px';
                                    logo_holder.style.clear = 'both';
                                    logo_holder.getElementsByTagName('a')[0].style.color = '#fff';
                                    
                                    tw_share_image_menu.style.top = tw_image_hover_over.offsetHeight+'px';
                                    tw_share_image_menu.style.left = '30px';
                                    tw_image_hover_over.style.left = parseInt(testing.left)+'px';
                                    tw_share_image_menu.style.width = '60px';
                                    tw_top = (tw_image_hover_over.offsetHeight);
                                    clearTimeout(tw_share_animate);
                                    animate(tw_top,40,tw_share_image_menu,el.target);
                                    break;
                                default:
                                	// right
                                    logo_holder.style.float = 'left';
                                    logo_holder.style.height = '30px';
                                    logo_holder.style.background = '#000';
                                    logo_holder.style.padding = '0px 11px';
                                    logo_holder.style.lineHeight = '30px';
                                    logo_holder.style.clear = 'both';
                                    logo_holder.getElementsByTagName('a')[0].style.color = '#fff';
                                    
                                    tw_share_image_menu.style.top = tw_image_hover_over.offsetHeight+'px';
                                    tw_share_image_menu.style.left = parseInt(tw_image_hover_over.offsetWidth-80)+'px';
                                    tw_image_hover_over.style.left = parseInt(testing.left+el.target.offsetWidth-100)+'px';
                                    
                                    tw_share_image_menu.style.width = '60px';
                                    tw_top = (tw_image_hover_over.offsetHeight);
                                    clearTimeout(tw_share_animate);
                                    animate(tw_top,40,tw_share_image_menu,el.target);
                                    break;
                            }
                            tw_currently_selected = el.target.getAttribute('src');
                        }
                    },true);
                }
            }
	    }
    	image.src = tw_img_holder[i].getAttribute('src');
    	
    	image.onerror = function(){	}
    }
}
