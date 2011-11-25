<?php get_header(); ?>

<div id="ContentWrapperWrapper"><!-- start ContentWrapperWrapper -->
<div id="Sidflikar"><p>markering</p></div>
<div id="ContentWrapper" class="clearfix"><!-- start ContentWrapper -->

  
<?php $args = array('posts_per_page' => 1,'post__in'  => get_option('sticky_posts'),'caller_get_posts' => 1);
query_posts($args); 
$do_not_duplicate = $post->ID;?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div id="Aktuellt" class="clearfix"><!-- start Feature -->
<p class="ribbon">Aktuellt</p>
<div class="featureImage">

<?php
if (has_post_thumbnail()) {
	$fullSrc = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
	echo '<a class="lankpil" href="'.get_permalink().'">' . clean_wp_width_height(get_the_post_thumbnail($post->ID, 'medium')) . '</a>';}
?>
</div>
<div class="featureText">
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

<ul class="entry-meta clearfix">
<li class="entry-meta-etiketter"><?php the_tags('',', ', ''); ?></li>
<li class="entry-meta-kommentarer"><?php comments_popup_link('Lämna en kommentar', 'En kommentar', '% Kommentarer'); ?></li>
</ul>
 
<?php the_excerpt('&raquo; &raquo; &raquo; &raquo;'); ?>
<p class="textright"><a class="more button" href="<?php the_permalink(); ?> ">Läs mer<span class="hidden"> av <?php the_title(); ?> </span></a></p>

</div>
</div><!-- end Feature -->
<?php endwhile;endif ?>
<?php wp_reset_query(); ?>

<div id="Main"><!-- start Main Content -->

<!-- Breadcrumb -->
<?php include( TEMPLATEPATH . '/breadcrumb.php' ); ?>

<?php// query_posts('cat=-1,-2,-10'); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
if( $post->ID == $do_not_duplicate ) continue; update_post_caches($posts); ?>

<div class="entry clearfix"><!-- start entry -->
<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

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
</div><!-- end entry-meta-wrapper -->

<div class="entry-body">
<?php the_excerpt('&raquo; &raquo; &raquo; &raquo;'); ?>
<p class="readmore"><a href="<?php the_permalink(); ?> ">Läs mer »<span class="hidden"> av <?php the_title(); ?> </span></a></p>
</div>

</div><!-- end entry -->

<?php endwhile; endif; ?>

<div class="clear"></div>
</div><!-- end Main Content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>