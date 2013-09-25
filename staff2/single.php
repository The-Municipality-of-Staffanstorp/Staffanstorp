<?php get_header(); ?>

<div id="ContentWrapperWrapper"><!-- start ContentWrapperWrapper -->
<div id="Sidflikar"><p>&nbsp;</p></div>
<div id="ContentWrapper" class="clearfix"><!-- start ContentWrapper -->

<div id="Main"><!-- start Main Content -->

<!-- Breadcrumb -->
<?php include( TEMPLATEPATH . '/breadcrumb.php' ); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<div class="entry clearfix"><!-- start entry -->

<h2 class="entry-title"><?php the_title(); ?></h2>

<div class="entry-meta-wrapper"><!-- start entry-meta-wrapper -->
<ul class="entry-meta">
<?php $baseUrl = get_bloginfo('url');
$day = get_the_time('d');
$month = get_the_time('m');
$year  = get_the_time('Y');?>
<li class="entry-meta-datum">Datum <a href="<?php  echo $baseUrl .'/'. $year .'/'. $month . '/'. $day . '/'; ?>"><?php the_time('j F Y'); ?></a></li>
<li class="entry-meta-skribent">Skrivet av <?php the_author_posts_link(); ?></li>
<li class="entry-meta-kategori">Kategorier <?php the_category(', '); ?></li>
<li class="entry-meta-etiketter">Etiketter  <?php the_tags('',', ', ''); ?></li>
<li class="entry-meta-kommentarer"><?php comments_popup_link('Lämna en kommentar', 'En kommentar', '% Kommentarer'); ?></li>
</ul>

<h3 class="entry-meta-verktyg">Verktyg</h3>
<ul class="entry-meta entry-meta-tools">
<li class="lyssna"><a id="bapluslogo" class="logo" title="Aktivera talande Webb" onclick="toggleBar();" href="#">Aktivera talande Webb</a></li>
<?php edit_post_link('Redigera &raquo;', '<li class="entry-meta-redigera">', '</li>'); ?>
</ul>

<h3 class="entry-meta-betyg">Tycker du att informationen på den här sidan har hjälpt dig?</h3>
<div class="hr"></div>
<div class="polldaddy" id="pd_rating_holder_4441267_<?php echo( $post->ID ); ?>"></div>
<script type="text/javascript">
PDRTJS_settings_4441267_<?php echo( $post->ID ); ?> = {
	"id" : "4441267",
	"unique_id" : "wp-post-<?php echo( $post->ID ); ?>",
	"title" : "<?php echo( $post->post_title ); ?>",
	"permalink" : "<?php echo( get_permalink( $post->ID ) ); ?>",
        "item_id" :  "_<?php echo( $post->ID ); ?>"
};
</script>
 
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
} ?>
<?php the_content(); ?>
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