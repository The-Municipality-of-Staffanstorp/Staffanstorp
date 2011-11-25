<?php get_header(); ?>

<div id="ContentWrapperWrapper"><!-- start ContentWrapperWrapper -->
<div id="ContentWrapper" class="clearfix"><!-- start ContentWrapper -->

<?php
$sida = get_option('ozh_sample');$sidID = $sida['sometext'];
query_posts('page_id='.$sidID);
if ( have_posts()) : while ( have_posts()) : the_post(); ?>

<div id="Aktuellt" class="clearfix"><!-- start Feature -->
<div class="featureImage">

<?php
if (has_post_thumbnail()) {
	echo '<a class="lankpil" href="'.get_permalink().'">' . clean_wp_width_height(get_the_post_thumbnail($post->ID, 'medium')) . '</a>';}
?>
</div>
<div class="featureText">
<h2><a href="<?php the_permalink(); ?>"><?php $customField = get_post_custom_values("underrubrik");if (isset($customField[0])){echo $customField[0];} else { the_title();} ?></a></h2>

<?php the_excerpt('&raquo; &raquo; &raquo; &raquo;'); ?>
<p class="textright"><a class="more button" href="<?php the_permalink(); ?> ">Läs mer &raquo;<span class="hidden"> av <?php the_title(); ?> </span></a></p>

</div>
</div><!-- end Feature -->

<?php endwhile;endif ?>
<?php wp_reset_query(); ?>

<div id="Main"><!-- start Main Content -->

<!-- Breadcrumb -->
<?php include( TEMPLATEPATH . '/breadcrumb.php' ); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

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
<li class="entry-meta-etiketter">Etiketter  <?php the_tags('',', ', ''); ?></li>
<?php if(!comments_open()) :?><?php else : ?>
<li class="entry-meta-kommentarer"><?php comments_popup_link('Lämna en kommentar', 'En kommentar', '% Kommentarer'); ?></li>
<?php endif; ?>

<?php edit_post_link('Redigera &raquo;', '<li class="entry-meta-redigera">', '</li>'); ?>
</ul>
</div><!-- end entry-meta-wrapper -->

<div class="entry-body">
<?php the_excerpt('&raquo; &raquo; &raquo; &raquo;'); ?>
<?php $arkivURL = get_post_custom_values("arkivURL");
if (isset($arkivURL[0])){
echo '<p><a href="'.$arkivURL[0].'">'.$sajtnamn.'s gamla sida</a></p>';} ?>
<p class="readmore"><a href="<?php the_permalink(); ?> ">Läs mer »<span class="hidden"> av <?php the_title(); ?> </span></a></p>
</div>

</div><!-- end entry -->

<?php endwhile; endif; ?>

<div class="clear"></div>
</div><!-- end Main Content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>