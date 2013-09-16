<?php
$count = 0;
$comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => $post->ID ));
if(count($comment_entries) > 0){
    foreach($comment_entries as $comment){
        if($comment->comment_approved)
            $count++;
    }
}
?>
<div id="comments">
                        <h5 class="number">COMMENTS</h5>
                        
                        <div class="row-fluid comments_list">
                            
                           <?php
                            if ( have_comments() ) : 
                                if(!empty($comment_entries)){
                                    wp_list_comments( array( 'type'=> 'comment', 'callback' => 'themeple_custom_comment' ) );
                                } 
                            endif;
                            ?>
                                                        
                        </div>
</div>
<?php comment_form(array(), $post->ID ) ?>
    
<?php
    /**
     * themeple_custom_comment()
     * 
     * @return
     */
    function themeple_custom_comment($comment, $args, $depth){
        
        ?>
        
       
        
                <div class="comment <?php if($depth == 1) echo 'span12'; else echo 'span11 offset1'; ?>">
                    
                            <dl class="dl-horizontal">
                                <dt>
                                    <?php echo get_avatar($comment, '50') ?>
                                    
                                </dt>
                                <dd>
                                    <ul>
                                        <li class="author"><span><a href=""><?php echo get_comment_author_link($comment) ?></a></span></li>
                                        <li> | <span><?php comment_date('M j Y', $comment) ?></span></li>
                                        <li> | <span><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span></li>
                                        <li><span> <?php edit_comment_link() ?></span></li>
                                    </ul>  
                                </dd>
                            </dl>
                            <div class="comment_text">
                            <?php echo get_comment_text($comment); ?>
                                    <?php if ($comment->comment_approved == '0') : ?>
                                         <span>Your comment is awaiting moderation.</span>
                            <?php endif; ?>  
                          </div>  
                </div>
                
               
            
        
        
        
        <?php

    }
    

?>