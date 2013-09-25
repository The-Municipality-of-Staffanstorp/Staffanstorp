<?php
/*
Template Name: Kontakt
*/
?>

<?php get_header(); ?>

<div id="ContentWrapperWrapper"><!-- start ContentWrapperWrapper -->
<div id="Sidflikar"><p>&nbsp;</p></div>
<div id="ContentWrapper" class="clearfix"><!-- start ContentWrapper -->

<div id="MainKontakt"><!-- start Main Content -->

<!-- Breadcrumb -->
<?php include( TEMPLATEPATH . '/breadcrumb.php' ); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<div class="entry clearfix"><!-- start entry -->
<h2 class="entry-title">Kontakt <span class="amp">&amp;</span> Synpunkter</h2>
<div class="entry-meta-wrapper"><!-- start entry-meta-wrapper -->

<form name="rs_form" action="http://app.readspeaker.com/cgi-bin/rsent" method="post" target="rs">
<input type="hidden" name="selectedhtml" />
<input type="hidden" name="url" value="<?php the_permalink(); ?>" />
<input type="hidden" name="customerid" value="5595" />
<input type="hidden" name="lang" value="sv_se" />
<input type="hidden" name="output" value="template" />
</form>

</div><!-- end entry-meta-wrapper -->

<div class="entry-body">
<?php
if (has_post_thumbnail()) {
	$fullSrc = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
	echo '<p class="lank-bild"><a class="lightbox" href="' . $fullSrc[0] . '">' . clean_wp_width_height(get_the_post_thumbnail($post->ID, 'medium')) . '</a></p>';
} ?>
<?php the_content();?>
</div>

</div><!-- end entry -->
<?php endwhile ?>	

<?php comments_template(); ?>

<?php else : ?>
<h2><?php _e('Sidan finns inte'); ?></h2>
<?php endif; ?>

</div><!-- end Main Content -->

</div><!-- end ContentWrapper -->
</div><!-- end ContentWrapperWrapper -->

<div id="QuickInfoWrapper"><!-- start QuickInfoWrapper -->
<div id="QuickInfo"><!-- start QuickInfo -->

<ul class="wrapper clearfix"><!-- start widget ul-wrapper -->
<?php
//first QuickInfo
dynamic_sidebar('QuickInfo 1');
//second QuickInfo
dynamic_sidebar('QuickInfo 2');
//third QuickInfo
dynamic_sidebar('QuickInfo 3');
//fourth QuickInfo
dynamic_sidebar('QuickInfo 4'); 
?>
</ul><!-- end widget ul-wrapper -->

</div><!-- end QuickInfo -->
</div><!-- end QuickInfoWrapper -->

<div id="LandskapsWrapper">
<div id="Landskap1"></div>
<div id="Landskap2"></div>
</div>

<?php get_footer(); ?>