<div id="comments"><!-- start Comments -->
<?php if (post_password_required()) : ?>
<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'twentyten' ); ?></p>
</div><!-- #Comments -->
<?php return;endif; ?>

<?php if(have_comments()) : ?>

<h4 class="comments-title"><?php printf( _n( 'En kommentar till %2$s', '%1$s kommentarer till %2$s', get_comments_number(), 'twentyten' ), number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' ); ?></h4>
<ol class="commentlist">
<?php wp_list_comments('type=comment&style=ol&callback=custom_comments_callback'); ?>
</ol>

<?php if(function_exists('wp_paginate_comments')) {
    wp_paginate_comments();
} ?>

<?php else : // or, if we don't have comments:
if(!comments_open()) :
?>
<p class="nocomments">Kommentarer är stängda för denna artikel.</p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<!-- Comments form -->
<?php include(TEMPLATEPATH . '/comment_form_pj.php' ); ?>

</div><!-- end Comments -->