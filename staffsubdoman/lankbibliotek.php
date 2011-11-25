<?php
/*
Template Name: Länkbibliotek
*/
?>

<?php get_header(); ?>

<div id="ContentWrapperWrapper"><!-- start ContentWrapperWrapper -->
<div id="ContentWrapper" class="clearfix"><!-- start ContentWrapper -->

<div id="Main"><!-- start Main Content -->

<!-- Breadcrumb -->
<?php include( TEMPLATEPATH . '/breadcrumb.php' ); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<div class="entry clearfix"><!-- start entry -->
<h2 class="entry-title"><?php $customField = get_post_custom_values("underrubrik");if (isset($customField[0])){echo $customField[0];} else { the_title();} ?></h2>

<div class="entry-meta-wrapper"><!-- start entry-meta-wrapper -->
<ul class="entry-meta">
<li class="entry-meta-datum">Datum <?php the_modified_date('j F Y'); ?></li>
<li class="entry-meta-skribent">Sidansvarig <?php the_author_posts_link(); ?></li>
<?php if(!comments_open()) :?><?php else : ?>
<li class="entry-meta-kommentarer"><?php comments_popup_link('Lämna en kommentar', 'En kommentar', '% Kommentarer'); ?></li>
<?php endif; ?>
<?php edit_post_link('Redigera &raquo;', '<li class="entry-meta-redigera">', '</li>'); ?>
</ul>

<h3 class="entry-meta-dela">Dela</h3>
<div class="entry-meta-share">
<a href="http://twitter.com/share" class="twitter-share-button">Twitter</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=button_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;colorscheme=light&amp;height=22&amp;locale=sv_SE" scrolling="no" frameborder="0"></iframe>
</div>

</div><!-- end entry-meta-wrapper -->

<div class="entry-body">
<?php
if (has_post_thumbnail()) {
	$fullSrc = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
	echo '<p class="lank-bild"><a class="lightbox" href="' . $fullSrc[0] . '">' . clean_wp_width_height(get_the_post_thumbnail($post->ID, 'medium')) . '</a></p>';
}
the_content(); 
wp_list_bookmarks('title_li=&category_before=&category_after=&limit=-1&title_before=<h3>&title_after=</h3>');
?>

</div>

</div><!-- end entry -->
<?php endwhile ?>	

<?php comments_template(); ?>

<?php else : ?>
<h2><?php _e('Sidan finns inte'); ?></h2>
<?php endif; ?>

</div><!-- end Main Content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>