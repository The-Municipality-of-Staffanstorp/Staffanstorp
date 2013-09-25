<?php
/*
Template Name: Dokument
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
<!-- RSPEAK_START -->
<h2 class="entry-title"><?php $customField = get_post_custom_values("underrubrik");if (isset($customField[0])){echo $customField[0];} else { the_title();} ?></h2>
<!-- RSPEAK_STOP -->
<div class="entry-meta-wrapper"><!-- start entry-meta-wrapper -->
<ul class="entry-meta">
<li class="entry-meta-datum">Datum <?php the_modified_date('j F Y'); ?></li>

<?php if(!comments_open()) :?><?php else : ?>
<li class="entry-meta-kommentarer"><?php comments_popup_link('Lämna en kommentar', 'En kommentar', '% Kommentarer'); ?></li>
<?php endif; ?>
</ul>

<h3 class="entry-meta-verktyg">Verktyg</h3>
<ul class="entry-meta entry-meta-tools">
<li class="lyssna"><a id="bapluslogo" class="logo" title="Aktivera talande Webb" onclick="toggleBar();" href="#">Aktivera talande Webb</a></li>
<?php edit_post_link('Redigera &raquo;', '<li class="entry-meta-redigera">', '</li>'); ?>
</ul>

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
	$fullSrc = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
	echo '<p class="lank-bild"><a class="lightbox" href="' . $fullSrc[0] . '">' . clean_wp_width_height(get_the_post_thumbnail($post->ID, 'medium')) . '</a></p>';
} ?>
<!-- RSPEAK_START -->
<?php the_content();

	$args = array(
		'post_type' => 'attachment', // search only attachments (media files)
		'numberposts' => -1 // unlimited results
	);
	$filer = get_posts($args);
	
	if ($filer) {
		echo '<ul class="blanketter">';
		foreach($filer as $fil){
			$filID = $fil->ID;
			$fillank = wp_get_attachment_url($fil->ID);
			//$icon = wp_mime_type_icon($filID);
			$mimetype = $fil->post_mime_type;
			//echo($mimetype);
			
			if($mimetype == 'application/pdf'){
				//echo $mimetype;
				$icon = 'pdf';
			} elseif ($mimetype == 'application/msword') {
				$icon = 'doc';	
			} elseif (
			$mimetype == 'application/vnd.ms-excel' || 
			$mimetype == 'application/x-excel' ||
			$mimetype == 'application/x-msexcel' ||
			$mimetype == 'application/excel' ||
			$mimetype == 'application/x-excel'
			) {
				$icon = 'spreadsheet';	
			} else {
				$icon = 'general';	
			}
			
			echo '<li class="'.$icon.'">';
			echo '<a href="'.$fillank .'">'. $fil->post_title .'</a>';
			if($fil->post_excerpt){
			echo '<span>'.$fil->post_content.'</span>';
			}
			echo '</li>';
		}
		echo '</ul>';
	}
?>
<!-- RSPEAK_STOP -->

<div class="hr"></div><hr />

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