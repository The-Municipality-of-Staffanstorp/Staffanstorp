<?php get_header(); ?>

<div id="ContentWrapperWrapper"><!-- start ContentWrapperWrapper -->
<div id="ContentWrapper" class="clearfix"><!-- start ContentWrapper -->

<div id="Main"><!-- start Main Content -->

<!-- Breadcrumb -->
<?php include( TEMPLATEPATH . '/breadcrumb.php' ); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<div class="entry clearfix"><!-- start entry -->
<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

<div class="entry-meta-wrapper"><!-- start entry-meta-wrapper -->
<ul class="entry-meta">
<?php $baseUrl = get_bloginfo('url');
$day = get_the_time('d');
$month = get_the_time('m');
$year  = get_the_time('Y');?>
<li class="entry-meta-datum">Datum <a href="<?php  echo $baseUrl .'/'. $year .'/'. $month . '/'. $day . '/'; ?>"><?php the_time('j F Y'); ?></a></li>
<?php  
$sidtyp = get_post_type($post); 
$sidid =  $post -> ID;
$sidkom = $post-> comment_status;
if ($sidtyp == 'post') : ?>
<li class="entry-meta-skribent">Skrivet av <?php the_author_posts_link(); ?></li>
<li class="entry-meta-etiketter">Etiketter  <?php the_tags('',', ', ''); ?></li>
<?php if ($sidkom == 'open') : ?><li class="entry-meta-kommentarer"><?php comments_popup_link('Lämna en kommentar', 'En kommentar', '% Kommentarer'); ?></li><?php endif; ?>
<?php else : ?>
<?php if ($sidkom == 'open') : ?><li class="entry-meta-kommentarer"><?php comments_popup_link('Lämna en kommentar', 'En kommentar', '% Kommentarer'); ?></li>
<?php endif; ?>
<?php endif; ?>
</ul>
</div><!-- end entry-meta-wrapper -->

<div class="entry-body">
<?php the_excerpt('&raquo; &raquo; &raquo; &raquo;'); ?> 
<p class="readmore"><a href="<?php the_permalink(); ?> ">Läs mer »<span class="hidden"> av <?php the_title(); ?> </span></a></p>
</div>
</div><!-- end entry -->
<?php endwhile ?>
<?php endif; ?>

<?php if(function_exists('wp_paginate')){wp_paginate();} ?>

</div><!-- end Main Content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>