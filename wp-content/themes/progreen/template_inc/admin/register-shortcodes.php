<?php



if(!function_exists('themeple_sc_column'))

{

	/**

	 * themeple_sc_column()

	 * 

	 * @param mixed $atts

	 * @param string $content

	 * @param string $shortcodename

	 * @return

	 */

	function themeple_sc_column($atts, $content = "", $shortcodename = "")

	{	

	    extract(shortcode_atts(array('nr' => ''), $atts));

	    $output = '';

        if($nr == 'first')

            $output .= '<div class="row-fluid">';

        $span = 12;

		if($shortcodename == 'one_third')

            $span = 4;

        else

        if($shortcodename == 'two_third')

            $span = 8;

        else

        if($shortcodename == 'one_fourth')

            $span = 3;

        else

        if($shortcodename == 'three_fourth')

            $span = 9;

        else

        if($shortcodename == 'one_half')

            $span = 6;

        else

        if($shortcodename == 'one_sixth')

            $span = 2;

        else

        if($shortcodename == 'five_sixth')

            $span = 10;

		$output .= '<div class="span'.$span.' sc-col">';

            $output .= do_shortcode($content);

        $output .= '</div>';

        if($nr == 'last')

            $output .= '</div>';

		return $output;

	}



	add_shortcode('one_third'	, 'themeple_sc_column');

	add_shortcode('two_third'	, 'themeple_sc_column');

	add_shortcode('one_fourth'	, 'themeple_sc_column');

	add_shortcode('three_fourth', 'themeple_sc_column');

	add_shortcode('one_half'	, 'themeple_sc_column');

	add_shortcode('one_sixth'	, 'themeple_sc_column');

	add_shortcode('two_sixth'	, 'themeple_sc_column');

	add_shortcode('three_sixth'	, 'themeple_sc_column');

	add_shortcode('four_sixth'	, 'themeple_sc_column');

    add_shortcode('five_sixth'	, 'themeple_sc_column');

}



if(!function_exists('themeple_sc_contentrow')){

    /**

     * themeple_sc_contentrow()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_contentrow($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('style' => 'border'), $atts));

        $output = '<div class="row-fluid sc-col">';

        $output .= do_shortcode($content);

        $output .= '</div>';

        if($style == 'border'){

            $output .= '<div class="divider_ row-fluid "></div>';

        }

        return $output;

    }

    add_shortcode('contentrow', 'themeple_sc_contentrow');

}



if(!function_exists('themeple_sc_abbreviation')){

    /**

     * themeple_sc_abbreviation()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_abbreviation($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => ''), $atts));

        $output = '<abbr title="'.$title.'">'.do_shortcode($content).'</abbr>';

        return $output;

    }

    add_shortcode('abbreviation', 'themeple_sc_abbreviation');

}

if(!function_exists('themeple_sc_textbar')){


 /**

     * themeple_sc_textbar()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

function themeple_sc_textbar($atts, $content=null, $shortcodename =""){
	extract(shortcode_atts(array('title_first' => '', 'title_first_description'=>'', 'title_second'=>'', 'title_second_description'=>'', 'button_title'=>'', 'button_link'=>'' ), $atts));
	$output = '<div class="themeple_sc">';
	$output .= '<div class="textbar">';
	$output .=  '<div class="container">';    
	$output .= '<div class="row-fluid">';        
	$output .= '<div class="span6">';      
	$output .= '<h4>'.$title_first.'</h4>';       
	$output .= '<span class="desc">'.$title_first_description.'</span></div>';        
	$output .=  '<div class="span6">';       
	$output .= '<h4>'.$title_second.'</h4>';        
	$output .= '<span class="desc">'.$title_second_description.'</span>';
	$output .= '<a href="'.$button_link.'" class="textbtn base_btn pull-right">'.$button_title.'</a></div>';       
	$output .= '<span class="headgradient"></span>  </div></div>';
	$output .= '<div class="header_shadow"></div></div></div>';
       return $output;
     }
	add_shortcode('textbar', 'themeple_sc_textbar');
  }

if(!function_exists('themeple_sc_blockquote')){

    /**

     * themeple_sc_blockquote()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_blockquote($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('source' => ''), $atts));
        
        $output = '<div class="themeple_sc">';
        $output .='<div class="themeple_blockquote">';

        $output .= do_shortcode($content);

        $output .='<br /><span>'.$source.'</span>';
        
        $output .='</div></div>';  
        

        return $output;

    }

    add_shortcode('blockquote', 'themeple_sc_blockquote');

}

if(!function_exists('themeple_sc_header_title')){

    /**

     * themeple_sc_header_title()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_header_title($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => '', 'header_size'=> ''), $atts));

        $output = '<div class="themeple_sc">';
        $output .= '<div class="header">';
       
        switch ($header_size) {
            case 'h3':
                $output .= '<h3>'.$title.'</h3>';
                $output .= '<span class="border_style_color"></span>';
                break;
            case 'h4':
                $output .= '<h4>'.$title.'</h4>';
                $output .= '<span class="border_style_color"></span>';
                break;
            case 'h5':    
                $output .= '<h5>'.$title.'<h5>';
                $output .= '<span class="border_style_color"></span>';
                break;
        }

        $output .= '</div></div>';

        return $output;

    }

    add_shortcode('header_title', 'themeple_sc_header_title');

}

if(!function_exists('themeple_sc_social_icons')){

    /**

     * themeple_sc_social_icons()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */


    function themeple_sc_social_icons($atts, $content=null, $shortcodename =""){

       extract(shortcode_atts(array('icon' => '', 'link'=>'' ), $atts));

       $output =  '<div class="themeple_sc">'; 
       $output .= '<ul class="social_icons">';
       $output .= '<li class="'.$icon.'">';
	$output .= '<a href="'.$link.'">';
       $output .= '<i class="icon-'.$icon.'"></i>';
       $output .= '</a>';
       $output .= '</li>';
       $output .='</ul></div>';
       return $output;

    }

    add_shortcode( 'social_icons', 'themeple_sc_social_icons' );


}    




if(!function_exists('themeple_sc_button')){

    /**

     * themeple_sc_button()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_button($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('dropdown'=>'','icon' => '', 'type' => '', 'link' => '', 'onclick' => '', 'color' => '', 'state' => '', 'block_level' => '', 'size' => '', 'icon_color' => 'dark_gray', 'fontcolor'=> ''), $atts));

        $classes = "btn ";

        $background =   'background:'.$color;

        $classes .= ' '.($size != 'default')?'btn-'.$size.' ':'';

        $classes .= ' '.($block_level == 'no')?'':'btn-block ';

        $classes .= ' '.($state == 'active')?'':'disabled ';

        

        

        $output = "";

        

        if($type == 'anchor'){

            $output .= '<a href="'.$link.'" class="'.$classes.'" style="'.$background.'">';

        }else

        if($type == 'button'){

            $output .= '<button onclick="'.$onclick.'" class="'.$classes.'">';

        }else

            $output .= '<input type="submit"  class="'.$classes.'" />';

        

        

        

       $icon_class = "";

       $icon_class .= ' '.($icon != 'none')?$icon.' ':'';

       

       

        if(!empty($fontcolor)){

        $output .= '<i class="'.$icon_class.'"></i><span style="color:'.$fontcolor.'">'.do_shortcode($content).'</span>';

        }else{

        $output .= '<i class="'.$icon_class.'"></i><span>'.do_shortcode($content).'</span>';

        }

        if($type == 'anchor'){

            $output .= '</a>';

            if($dropdown == 'yes'){

                $output .= '<a href="#" class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>';

            }

        }else

        if($type == 'button'){

            $output .= '</button>';

            if($dropdown == 'yes'){

                $output .= '<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>';

            }

        }

        

        

        

        return $output;

    }

    add_shortcode('button', 'themeple_sc_button');

}



if(!function_exists('themeple_sc_imagestyle')){

    /**

     * themeple_sc_imagestyle()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_imagestyle($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('style' => ''), $atts));

        $output = '<img src="'.do_shortcode($content).'" class="img-'.$style.'">';

        return $output;

    }

    add_shortcode('imagestyle', 'themeple_sc_imagestyle');

}

if(!function_exists('themeple_sc_navigation')){

    /**

     * themeple_sc_navigation()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_navigation($atts, $content=null, $shortcodename =""){

        $output = '<ul class="nav nav-list">';

        $output .= do_shortcode($content);

        $output .= '</ul>';

        return $output;

    }

    add_shortcode('navigation', 'themeple_sc_navigation');

}



if(!function_exists('themeple_sc_navigation_list')){

    /**

     * themeple_sc_navigation_list()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_navigation_list($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => ''), $atts));

        $output = '<li class="nav-header">';

        $output .= do_shortcode($title);

        $output .= do_shortcode($content);

        $output .= '</li>';

        return $output;

    }

    add_shortcode('navigation_list', 'themeple_sc_navigation_list');

}



if(!function_exists('themeple_sc_navigation_element')){

    /**

     * themeple_sc_navigation_element()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_navigation_element($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('link' => '', 'icon' => '', 'active' => ''), $atts));

        $active = ($active == 'yes')?'active':'';

        $icon_active = ($active == 'yes')?'icon-white':'';

        $output = '<li class="'.$active.'"><a href="'.$link.'">';

        if($icon != 'none'){

            $output .= '<i class="'.$icon.' '.$icon_active.'"></i> ';

        }

        $output .= do_shortcode($content);

        $output .= '</a></li>';

        return $output;

    }

    add_shortcode('navigation_element', 'themeple_sc_navigation_element');

}



if(!function_exists('themeple_sc_breadcrumb')){

    /**

     * themeple_sc_breadcrumb()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_breadcrumb($atts, $content=null, $shortcodename =""){

        $output = '<ul class="breadcrumb">';

        $output .= do_shortcode($content);

        $output .= '</ul>';

        return $output;

    }

    add_shortcode('breadcrumb', 'themeple_sc_breadcrumb');

}



if(!function_exists('themeple_sc_breadcrumb_element')){

    /**

     * themeple_sc_breadcrumb_element()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_breadcrumb_element($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('link' => '', 'active' => ''), $atts));

        if($active == 'yes'){

            $output = '<li class="active">';

            $output .= do_shortcode($content);

            $output .= '</li>';

        }else{

            $output = '<li><a href="'.$link.'">';

            $output .= do_shortcode($content);

            $output .= '</a><span class="divider">/</span></li>';

        }

        return $output;

    }

    add_shortcode('breadcrumb_element', 'themeple_sc_breadcrumb_element');

}



if(!function_exists('themeple_sc_label_badget')){

    /**

     * themeple_sc_label_badget()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_label_badget($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('style' => '', 'type' => ''), $atts));

        $style = ($style == 'default')?'':$style;

        

        $output = '<span class="'.$type.' '.$type.'-'.$style.'">'.do_shortcode($content).'</span>'; 

        return $output;

    }

    add_shortcode('label_badget', 'themeple_sc_label_badget');

}





if(!function_exists('themeple_sc_thumbnails')){

    /**

     * themeple_sc_thumbnails()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_thumbnails($atts, $content=null, $shortcodename =""){

        

        $output = '<ul class="thumbnails">';

        $output .= do_shortcode($content);

        $output .= '</ul>';

        return $output;

    }

    add_shortcode('thumbnails', 'themeple_sc_thumbnails');

}



if(!function_exists('themeple_sc_thumbnail')){

    /**

     * themeple_sc_thumbnail()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_thumbnail($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => '', 'desc' => '', 'size' => '3', 'link' => ''), $atts));

        $output = '<li class="span'.$size.'">';

        

            if($title != '' && $desc != ''){

                $output .= '<div class="thumbnail">';

                

                    $output .= '<img src="'.do_shortcode($content).'" alt="" />';

                    $output .= '<h1><a href="'.$link.'">'.$title.'</a></h1>';

                    $output .= '<p>'.$desc.'</p>';

                $output .= '</div>';

            }else{

                $output .= '<a href="'.$link.'" class="thumbnail"><img src="'.do_shortcode($content).'" alt="" /></a>';

            }

        

        $output .= '</li>';

        return $output;

    }

    add_shortcode('thumbnail', 'themeple_sc_thumbnail');

}



if(!function_exists('themeple_sc_alert')){

    /**

     * themeple_sc_alert()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_alert($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => '', 'style' => ''), $atts));

        $style = ($style == 'default')?'':$style;

        $output = '<div class="alert alert-'.$style.'">';

        $output .= '<a class="close" data-dismiss="alert" href="#">&times;</a>';

        $output .= '<strong>'.$title.'</strong> '.do_shortcode($content);

       

        $output .= '</div>';

        return $output;

    }

    add_shortcode('alert', 'themeple_sc_alert');

}



if(!function_exists('themeple_sc_progressbar')){

    /**

     * themeple_sc_progressbar()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_progressbar($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title'=>'', 'percentage' => '','striped' => '', 'type' => '', 'style' => '', 'animated' => '', 'success' => '', 'warning' => '', 'danger' => ''), $atts));

        

        $style = ($style == 'default')?'':' progress-'.$style;

        $animated = ($animated == 'yes')?' active':'';

        $striped = ($striped == 'yes')?' progress-striped':'';

        $output = '';

        

        if($type != 'default'){


            $output .= '<div class="progress '.$animated.' '.$striped.'">';

            $output .= '<div class="bar bar-success" style="width: '.$success.'%;"></div>';

            $output .= '<div class="bar bar-warning" style="width: '.$warning.'%;"></div>';

            $output .= '<div class="bar bar-danger" style="width: '.$danger.'%;"></div>';

            $output .= '</div>';

        }else{
            $output .= '<div class="skill">';
            $output .= '<div class="percentage_circle">';
            $output .= '<span class="circle2"><span class="circle3"><span class="circle4"></span></span></span><span class="circle5"><span>'.$percentage.'%</span></span></div>';
            $output .= '<div class="progress '.$animated.' '.$striped.' '.$style.'">';

            $output .= '<div class="bar" style="width: '.$percentage.'%;"></div>';

            $output .= '<span>'.$title.'</span>';

            $output .= '</div></div>';

        }

        

        

        return $output;

    }

    add_shortcode('progressbar', 'themeple_sc_progressbar');

}



if(!function_exists('themeple_sc_dropdown_container')){

    /**

     * themeple_sc_dropdown_container()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_dropdown_container($atts, $content=null, $shortcodename =""){

        $output = '<div class="btn-group">';

        $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

    add_shortcode('dropdown_container', 'themeple_sc_dropdown_container');

}



if(!function_exists('themeple_sc_dropdown')){

    /**

     * themeple_sc_dropdown()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_dropdown($atts, $content=null, $shortcodename =""){

        $output = '<ul class="dropdown-menu" role="menu">';

        $output .= do_shortcode($content);

        $output .= '</ul>';

        return $output;

    }

    add_shortcode('dropdown', 'themeple_sc_dropdown');

}



if(!function_exists('themeple_sc_sub_dropdown')){

    /**

     * themeple_sc_sub_dropdown()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_sub_dropdown($atts, $content=null, $shortcodename =""){

        $output = '<ul class="dropdown-menu">';

        $output .= do_shortcode($content);

        $output .= '</ul>';

        return $output;

    }

    add_shortcode('sub_dropdown', 'themeple_sc_sub_dropdown');

}



if(!function_exists('themeple_sc_dropdown_element')){

    /**

     * themeple_sc_dropdown_element()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_dropdown_element($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => '', 'submenu' => '', 'link' => '', 'icon' => ''), $atts));

        $icon = ($icon == 'none')?'':'<i class="'.$icon.'"></i> ';

        $el = '<a tabindex="-1" href="'.$link.'">'.$icon.$title.'</a>';

        $output = '<li class="'.(($submenu == 'yes')?'dropdown-submenu':'').'">';

            $output .= $el;

        $output .= do_shortcode($content);

        $output .= '</li>';

        return $output;

    }

    add_shortcode('dropdown_element', 'themeple_sc_dropdown_element');

}



if(!function_exists('themeple_sc_dropdown_subelement')){

    /**

     * themeple_sc_dropdown_subelement()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_dropdown_subelement($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => '', 'link' => '', 'icon' => ''), $atts));

        $icon = ($icon == 'none')?'':'<i class="'.$icon.'"></i> ';

        $el = '<a tabindex="-1" href="'.$link.'">'.$icon.$title.'</a>';

        $output = '<li>';

            $output .= $el;

        $output .= do_shortcode($content);

        $output .= '</li>';

        return $output;

    }

    add_shortcode('dropdown_subelement', 'themeple_sc_dropdown_subelement');

}

if(!function_exists('themeple_sc_tab_container')){

    /**

     * themeple_sc_tab_container()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_tab_container($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('fade' => '', 'position' => ''), $atts));

        $output = '<div class="tabbable '.(($position != 'top')?'tabs-'.$position:'').' ">';

        $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

    add_shortcode('tab_container', 'themeple_sc_tab_container');

}



if(!function_exists('themeple_sc_nav_tabs')){

    /**

     * themeple_sc_nav_tabs()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_nav_tabs($atts, $content=null, $shortcodename =""){

        

        $output = '<ul class="nav nav-tabs">';

        $output .= do_shortcode($content);

        $output .= '</ul>';

        return $output;

    }

    add_shortcode('nav_tabs', 'themeple_sc_nav_tabs');

}



if(!function_exists('themeple_sc_tab_content_container')){

    /**

     * themeple_sc_tab_content_container()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_tab_content_container($atts, $content=null, $shortcodename =""){

        

        $output = '<div class="tab-content">';

        $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

    add_shortcode('tab_content_container', 'themeple_sc_tab_content_container');

}

if(!function_exists('themeple_sc_tab_content')){

    /**

     * themeple_sc_tab_content()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_tab_content($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('id' => ''), $atts));

        $fade = "";

        $output = '<div class="tab-pane '.(($id == 1)?'active':'').' '.(($fade =='yes')?'fade':'').'" id="tab'.$id.'">';

        $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

    add_shortcode('tab_content', 'themeple_sc_tab_content');

}

if(!function_exists('themeple_sc_tab')){

    /**

     * themeple_sc_tab()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_tab($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('id' => '', 'title' => ''), $atts));

        $output = '<li class="'.(($id == 1)?'active':'').'"><a href="#tab'.$id.'" data-toggle="tab">'.$title.'</a></li>';

        return $output;

    }

    add_shortcode('tab', 'themeple_sc_tab');

}





if(!function_exists('themeple_sc_modal')){

    /**

     * themeple_sc_modal()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_modal($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => '', 'button_text' => ''), $atts));

        $output =  '<a href="#'.trim(str_replace(" ", '_', $title)).'" role="button" class="btn" data-toggle="modal">'.$button_text.'</a>';

        $output .= '<div class="modal hide fade" id="'.trim(str_replace(" ", '_', $title)).'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';

        $output .= '<div class="modal-header">';

        

        $output .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';

        $output .= '<h1>'.$title.'</h1>';

        

        $output .= '</div>';

        $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

    add_shortcode('modal', 'themeple_sc_modal');

}



if(!function_exists('themeple_sc_modal_content')){

    /**

     * themeple_sc_modal_content()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_modal_content($atts, $content=null, $shortcodename =""){

        

        $output = '<div class="modal-body">';

        $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

    add_shortcode('modal_content', 'themeple_sc_modal_content');

}

if(!function_exists('themeple_sc_modal_footer')){

    /**

     * themeple_sc_modal_footer()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_modal_footer($atts, $content=null, $shortcodename =""){

        

        $output = '<div class="modal-footer">';

        $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

    add_shortcode('modal_footer', 'themeple_sc_modal_footer');

}

if(!function_exists('themeple_sc_tooltip')){

    /**

     * themeple_sc_tooltip()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_tooltip($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => ''), $atts));

        $output = '<a href="#" rel="tooltip" title="'.$title.'">'.do_shortcode($content).'</a>';

        return $output;

    }

    add_shortcode('tooltip', 'themeple_sc_tooltip');

}



if(!function_exists('themeple_sc_popover')){

    /**

     * themeple_sc_popover()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_popover($atts, $content=null, $shortcodename =""){

        extract(shortcode_atts(array('title' => '', 'style' => '', 'size' => '', 'type' => '', 'button_text' => ''), $atts));

        $classes = "btn ";

        $classes .= ' '.($style != 'default')?'btn-'.$style.' ':'';

        $classes .= ' '.($size != 'default')?'btn-'.$size.' ':'';

        $output = '';

        if($type == 'anchor'){

            $output .= '<a href="#" class="'.$classes.'"  rel="popover" data-content="'.do_shortcode($content).'" data-original-title="'.$title.'">'.$button_text.'</a>';

        }else

        if($type == 'button')

            $output .= '<button class="'.$classes.'" rel="popover" data-content="'.do_shortcode($content).'" data-original-title="'.$title.'">'.$button_text.'</button>';

        return $output;

    }

    add_shortcode('popover', 'themeple_sc_popover');

}

global $toggles_i;

$toggles_i = 0;

if(!function_exists('themeple_sc_toggle_container')){

    /**

     * themeple_sc_toggle_container()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_toggle_container($atts, $content=null, $shortcodename =""){

        global $toggles_i;

        extract(shortcode_atts(array('faq' => ''), $atts));

        $toggles_i++;

        $output = '<div class="accordion '.(($faq == 'yes')?'':'').'" id="accordion'.$toggles_i.'">';

        $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

    add_shortcode('toggle_container', 'themeple_sc_toggle_container');

}



if(!function_exists('themeple_sc_toggle')){

    /**

     * themeple_sc_toggle()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_toggle($atts, $content=null, $shortcodename =""){

        global $toggles_i;

        extract(shortcode_atts(array('title' => ''), $atts));

        $output = '<div class="accordion-group">';

            $output .= '<div class="accordion-heading">';

            $id = rand(0, 50000);

                $output .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'.$toggles_i.'" href="#toggle'.$id.'">'.$title.'</a>';

            $output .= '</div>';

            $output .= '<div id="toggle'.$id.'" class="accordion-body collapse">';

                $output .= '<div class="accordion-inner">';

                    $output .= do_shortcode($content);

                $output .= '</div>';

            $output .= '</div>';

        $output .= '</div>';

        return $output;

    }

    add_shortcode('toggle', 'themeple_sc_toggle');

}



if(!function_exists('themeple_sc_border_divider_fit_page_content')){

    /**

     * themeple_sc_border_divider_fit_page_content()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_border_divider_fit_page_content($atts, $content=null, $shortcodename =""){

        $output = '<div class="divider row-fluid"></div>';

        return $output;

    }

    add_shortcode('border_divider_fit_page_content', 'themeple_sc_border_divider_fit_page_content');

}



if(!function_exists('themeple_sc_border_divider_fit_page_layout')){

    /**

     * themeple_sc_border_divider_fit_page_layout()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_border_divider_fit_page_layout($atts, $content=null, $shortcodename =""){

        $output = '<div class="divider_ row-fluid"></div>';

        return $output;

    }

    add_shortcode('border_divider_fit_page_layout', 'themeple_sc_border_divider_fit_page_layout');

}



if(!function_exists('themeple_sc_whitespace')){

    /**

     * themeple_sc_whitespace()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_whitespace($atts, $content=null, $shortcodename =""){

        $output = '<div class="row-fluid"></div>';

        return $output;

    }

    add_shortcode('whitespace', 'themeple_sc_whitespace');

}



if(!function_exists('themeple_sc_contact_form')){

    /**

     * themeple_sc_contact_form()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_contact_form($atts, $content = null, $shortcodename= ""){

        extract(shortcode_atts(array('heading' => '', 'success' => '', 'submit_text' => ''), $atts));

        

        $attr = array(

    		"success" => '<p>'.$success.'</p>',

    		"submit"  => $submit_text,

            "submit_class" => "more-large",

            "form_class" => "standard-form",

    		"action"  => get_permalink(),

    		"myemail" => themeple_get_option('email'),

    		"myblogname" => get_option('blogname'),

    		"autoresponder" => themeple_get_option('autoresponder'),

    		"autoresponder_subject" => themeple_get_option('autoresponder_subject'),

    		"autoresponder_email" => themeple_get_option('email')

	    );

        $custom_elements = themeple_get_option('contact_elements');

	

    

    	$elements = array();

        if(is_array($custom_elements))

    	{

    		foreach($custom_elements as $new_element)

    		{

    			$elements[strtolower( $new_element['label'] ) ] = $new_element;

    		}

    	}

        $contact_form = new themeple_form($attr);

    	$contact_form->create_elements($elements);

    	return '<div class="row-fluid">'.$contact_form->display_form().'</div>';

    }

    add_shortcode('contact_form', 'themeple_sc_contact_form');

}









if(!function_exists('themeple_sc_contact_form_slider')){

    /**

     * themeple_sc_contact_form()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_contact_form_slider($atts, $content = null, $shortcodename= ""){

        extract(shortcode_atts(array('heading' => '', 'success' => '', 'submit_text' => ''), $atts));

        

        $attr = array(

            "success" => '<p>Your message has been sent</p>',

            "submit"  => $submit_text,

            "form_class" => "slider_form",

            "submit_class" => "more-large",

            "action"  => get_permalink(),

            "myemail" => themeple_get_option('email'),

            "myblogname" => get_option('blogname'),

            "autoresponder" => themeple_get_option('autoresponder'),

            "autoresponder_subject" => themeple_get_option('autoresponder_subject'),

            "autoresponder_email" => themeple_get_option('email')

        );

        $custom_elements = themeple_get_option('contact_elements');

    

    

        $elements = array();

        if(is_array($custom_elements))

        {

            $i = 0;

            foreach($custom_elements as $new_element)

            {

                $i++;

                if($new_element['type'] != 'textarea'){

                    $elements[strtolower( $new_element['label'] ) ] = $new_element;

                    if($i > 1)

                        $elements[strtolower( $new_element['label'] ) ]['class'] = 'half';

                    if($i == count($custom_elements))

                        $elements[strtolower( $new_element['label'] ) ]['class'] = '';

                    if($i % 2 != 0 && $i == count($custom_elements))

                       $elements[strtolower( $new_element['label'] ) ]['class'] = 'half';

                }



            }

        }

        $contact_form = new themeple_form($attr);

        $contact_form->create_elements($elements);

        return '<div class="row">'.$contact_form->display_form().'</div>';

    }

    add_shortcode('contact_form_slider', 'themeple_sc_contact_form_slider');

}











if(!function_exists('themeple_sc_google_map')){

    /**

     * themeple_sc_google_map()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_google_map($atts, $content = null, $shortcodename=""){

        

        return '<div class="row-fluid row-google-map"><iframe class="googlemap" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.do_shortcode($content).'&amp;output=embed"></iframe><span class="map_shadow"></span></div>';

    }

    add_shortcode('google_map', 'themeple_sc_google_map');

}



if(!function_exists('themeple_sc_h1')){

    /**

     * themeple_sc_h1()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_h1($atts, $content = null, $shortcodename=""){

        return '<h1 class="shortcode_h1">'.do_shortcode($content).'</h1>';

    }

    add_shortcode('h1_heading', 'themeple_sc_h1');

}

if(!function_exists('themeple_sc_h2')){

    /**

     * themeple_sc_h2()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_h2($atts, $content = null, $shortcodename=""){

        return '<h2 class="shortcode_h2">'.do_shortcode($content).'</h2>';

    }

    add_shortcode('h2_heading', 'themeple_sc_h2');

}

if(!function_exists('themeple_sc_h3')){

    /**

     * themeple_sc_h3()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_h3($atts, $content = null, $shortcodename=""){

        return '<h3 class="shortcode_h3">'.do_shortcode($content).'</h3>';

    }

    add_shortcode('h3_heading', 'themeple_sc_h3');

}

if(!function_exists('themeple_sc_h4')){

    /**

     * themeple_sc_h4()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_h4($atts, $content = null, $shortcodename=""){

        return '<h4 class="shortcode_h4">'.do_shortcode($content).'</h4>';

    }

    add_shortcode('h4_heading', 'themeple_sc_h4');

}

if(!function_exists('themeple_sc_h5')){

    /**

     * themeple_sc_h5()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_h5($atts, $content = null, $shortcodename=""){

        return '<h4 class="shortcode_h5">'.do_shortcode($content).'</h5>';

    }

    add_shortcode('h5_heading', 'themeple_sc_h5');

}

if(!function_exists('themeple_sc_h6')){

    /**

     * themeple_sc_h6()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_h6($atts, $content = null, $shortcodename=""){

        return '<h6 class="shortcode_h6">'.do_shortcode($content).'</h6>';

    }

    add_shortcode('h6_heading', 'themeple_sc_h6');

}
if(!function_exists('themeple_sc_dropcast')){

    /**

     * themeple_sc_dropcast()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_sc_dropcast($atts, $content = null, $shortcodename=""){
         extract(shortcode_atts(array('form' => '', 'color' => '', 'fontcolor' => ''), $atts));

        return '<span class="dropcast '.$form.'" style="background:'.$color.'; color:'.$fontcolor.'!important">'.do_shortcode($content).'</span>';

    }

    add_shortcode('dropcast', 'themeple_sc_dropcast');

}



if(!function_exists('themeple_sc_full_image')){

   

    function themeple_sc_full_image($atts, $content = null, $shortcodename=""){

        return '<img src="'.do_shortcode($content).'" class="full_width_image" alt="" />';

    }

    add_shortcode('full_image', 'themeple_sc_full_image');

}















if(!function_exists('themeple_player_audio')){

    /**

     * themeple_palyer_audio()

     * 

     * @param mixed $atts

     * @param mixed $content

     * @param string $shortcodename

     * @return

     */

    function themeple_player_audio($atts, $content = null, $shortcodename=""){

        extract(shortcode_atts(array('title' => '', 'link' => '', 'audio_type'=>''), $atts));

            $output.='<audio id="player2" src="'.$link.'" type="audio/'.$audio_type.'" controls="controls" style="width:100% !important">';       

            $output.='</audio>';

            return $output;   

    }

    add_shortcode('player_audio', 'themeple_player_audio');

}



if(!function_exists('themeple_services_list')){

    

    function themeple_services_list($atts, $content = null, $shortcodename=""){

        extract(shortcode_atts(array(), $atts));

            $output ='<ul class="services_list themeple_sc">';

            $output .= do_shortcode($content);       

            $output .= '</ul>' ; 

            return $output;   

    }

    add_shortcode('services_list', 'themeple_services_list');

}



if(!function_exists('themeple_service_element')){

    

    function themeple_service_element($atts, $content = null, $shortcodename=""){

        extract(shortcode_atts(array("title" => "", 'link' => '', 'icon'=> '', 'icon_color' => ''), $atts));

            $output = '<li><i class="'.$icon.' '.(($icon_color === 'white')?' icon-white':'').'"></i> <a href="'.$link.'">'.$title.'</a></li>';  

            return $output;   

    }

    add_shortcode('service_element', 'themeple_service_element');

}
 

if(!function_exists('themeple_lightbox')){

    

    function themeple_lightbox($atts, $content = null, $shortcodename=""){

        extract(shortcode_atts(array("image_link" => "", 'video' => ''), $atts));

            $output = '';

            if($video != ''){

                    $output .= '<a class="lightbox-media" href="'.$video.'">';

            }else{

                    $output .= '<a class="lightbox-gallery" href="'.$image_link.'" title="">';

            }

            $output .= '<div class="visual lightbox">';

                $output .= '<img src="'.$image_link.'" />';

               

            $output .='</div></a>';

            return $output;   

    }

    add_shortcode('lightbox', 'themeple_lightbox');

}







if(!function_exists('themeple_sc_price_1')){

    function themeple_sc_price_1($atts, $content = null, $shortcodename=""){

        extract(shortcode_atts(array( 'type' => '', 'header_bool' => '', 'header_title' => '', 'header_money' => '', 'header_small' => '', 'footer_bool' => '', 'footer_button_text' => '', 'footer_link' => '' ), $atts));



        $output = '<div class="price_1_col '.$type.'">';

        $output .= '<div class="header">';

        if($header_bool == 'yes'){

            $output .= '<h1>'.$header_title.'</h1>';

            $output .= '<h2>'.$header_money.'</h2>';

        }

        $output .= '</div>';



        $output .= '<ul>';

        $output .= do_shortcode($content);

        $output .= '</ul>';



        $output .= '<div class="footer">';

        if($footer_bool == 'yes'){

            $output .= '<a href="'.$footer_link.'" class="btn price_button">'.$footer_button_text.'</a>';

        }

        $output .= '</div>';







        $output .= '</div>';





        return $output;

    }

    add_shortcode('price_table_1', 'themeple_sc_price_1');

}







if(!function_exists('themeple_sc_price_1_row')){

    function themeple_sc_price_1_row($atts, $content = null, $shortcodename=""){

        extract(shortcode_atts(array( 'type' => '' ), $atts));

        

        $output = '<li>';

        if($type == 'Tick')

            $output .= '<span class="icon-ok"></span>';

        if($type == 'Not')

            $output .= '<span class="icon-remove"></span>';

        

        $output .= do_shortcode($content);

        $output .= '</li>';

        return $output;

    }

    add_shortcode('price_table_1_row', 'themeple_sc_price_1_row');

}



if(!function_exists('themeple_sc_price_table_1_container')){

    function themeple_sc_price_table_1_container($atts, $content = null, $shortcodename=""){

        extract(shortcode_atts(array( 'col' => '' ), $atts));

        

        $output = '<div class="price_container col-'.$col.'">';

            $output .= do_shortcode($content);

        $output .= '</div>';

        return $output;

    }

    add_shortcode('price_table_1_container', 'themeple_sc_price_table_1_container');

}

if(!function_exists('themeple_sc_testimonials')){

    function themeple_sc_testimonials($atts, $content = null, $shortcodename=""){

        extract(shortcode_atts(array( ), $atts));

        $query_post = array('posts_per_page'=> 3, 'post_type'=> 'testimonial' );

        $output = '<div id="testimonials">';
               $loop = new WP_Query($query_post);
                         if($loop->have_posts()){
                            while($loop->have_posts()){
                                $loop->the_post();                                    
                                            
       
                $output .='<div class="testimon">' ;

                $output .='<p>'.get_the_content().'</p>';

                $output .= '<span class="arrow"></span>';

                $output .= '<div class="user-testimonial">'.get_the_title().'</div>';  

                 $output .='</div>';


        

       }

     }

     wp_reset_query();

     $output .= '</div>';
    return $output;
  }
    
    add_shortcode('testimonials', 'themeple_sc_testimonials');

}

if(!function_exists('themeple_sc_recent_portfolio')){

    function themeple_sc_recent_portfolio($atts, $content = null, $shortcodename=""){

         extract(shortcode_atts(array( ), $atts));
       
          $output ='<div class="pagination"><a href="" class="prev" title="Previous"></a><a href="" class="next" title="Next"></a></div>';

         $output .='<div class="recent_sc_portfolio">';
        
          
                $posts = get_posts( 'posts_per_page=18&post_type=portfolio');
                    if($posts){
                     foreach($posts as $post){
    
   
                            $id = $post->ID;
                         
                           $output .='<div class="portfolio_sc_item">' ;

                           $output .='<a href="'.get_permalink($id).'"><img src="'.themeple_image_by_id(get_post_thumbnail_id($id),  'recent_sc_portfolio' , 'url').'" alt=""></a>';

                           $output .='</div>';
                          }  

              

                    }
     
     
     $output .= '</div>';
    
     return $output;


  }
    
     add_shortcode('recent_portfolio', 'themeple_sc_recent_portfolio');

} 

if(!function_exists('themeple_sc_lists')){

    function themeple_sc_lists($atts, $content = null, $shortcodename=""){

         extract(shortcode_atts(array('type' => '' ), $atts));
        
         $output ='<li class="'.$type.'">'.do_shortcode($content).'</li>';
     
         return $output;

    }
    
     add_shortcode('lists', 'themeple_sc_lists');

} 
if(!function_exists('themeple_sc_highlights')){

    function themeple_sc_highlights($atts, $content = null, $shortcodename=""){

         extract(shortcode_atts(array('color' => '' ), $atts));
        
         $output ='<span style="background:#'.$color.'">'.do_shortcode($content).'</span>';
     
         return $output;

    }
    
     add_shortcode('highlights', 'themeple_sc_highlights');

} 
if(!function_exists('themeple_simple_table')){
    function themeple_simple_table( $atts ) {
       extract( shortcode_atts( array('cols' => 'none', 'data' => 'none' ), $atts ) );
    $cols = explode(',',$cols);
    $data = explode(',',$data);
    $total = count($cols);
    $output='<div class="themeple_sc">';;
    $output .= '<div class="border-table">';
    $output .= '<table class="table table-bordered"><tr class="th">';
    foreach($cols as $col):
        $output .= '<td>'.$col.'</td>';
    endforeach;
    $output .= '</tr><tr>';
    $counter = 1;
    foreach($data as $datum):
        $output .= '<td>'.$datum.'</td>';
        if($counter%$total==0):
            $output .= '</tr>';
        endif;
        $counter++;
    endforeach;
        $output .= '</table></div></div>';
    return $output;
}
add_shortcode( 'simple_table', 'themeple_simple_table' );
}

if(!function_exists('themeple_icon')){
    function themeple_icon($atts, $content = null, $shortcodename=""){

        return '<i class="'.do_shortcode( $content ).'"></i>';

    }

    add_shortcode( 'icon', 'themeple_icon' );

}

if(!function_exists('themeple_media')){
    function themeple_media($atts, $content = null, $shortcodename=""){
	 global $wp_embed;
	 $video = $wp_embed->run_shortcode("[embed]".trim($content)."[/embed]");
        return $video;

    }

    add_shortcode( 'sc_media', 'themeple_media' );

}

if(!function_exists('chart_shortcode')){
function chart_shortcode( $atts ) {
    extract(shortcode_atts(array(
        'data' => '',
        'colors' => '',
        'size' => '400x200',
        'bg' => 'ffffff',
        'title' => '',
        'labels' => '',
        'advanced' => '',
        'type' => 'pie'
    ), $atts));
    $string = '';
    switch ($type) {
        case 'line' :
            $charttype = 'lc'; break;
        case 'xyline' :
            $charttype = 'lxy'; break;
        case 'sparkline' :
            $charttype = 'ls'; break;
        case 'meter' :
            $charttype = 'gom'; break;
        case 'scatter' :
            $charttype = 's'; break;
        case 'venn' :
            $charttype = 'v'; break;
        case 'pie' :
            $charttype = 'p3'; break;
        case 'pie2d' :
            $charttype = 'p'; break;
        default :
            $charttype = $type;
        break;
    }
 
    if ($title) $string .= '&chtt='.$title.'';
    if ($labels) $string .= '&chl='.$labels.'';
    if ($colors) $string .= '&chco='.$colors.'';
    $string .= '&chs='.$size.'';
    $string .= '&chd=t:'.$data.'';
    $string .= '&chf='.$bg.'';
 
    return '<img title="'.$title.'" src="http://chart.apis.google.com/chart?cht='.$charttype.''.$string.$advanced.'" alt="'.$title.'" />';
}
add_shortcode('chart', 'chart_shortcode');
}


?>