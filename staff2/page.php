<?php get_header(); ?>

<div id="ContentWrapperWrapper"><!-- start ContentWrapperWrapper -->
<div id="Sidflikar"><p>&nbsp;</p></div>
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
<li class="entry-meta-skribent">Sidansvarig <?php the_author_posts_link(); ?></li>
<?php if(!comments_open()) :?><?php else : ?>
<li class="entry-meta-kommentarer"><?php comments_popup_link('Lämna en kommentar', 'En kommentar', '% Kommentarer'); ?></li>
<?php endif; ?>
</ul>

<h3 class="entry-meta-verktyg">Verktyg</h3>
<ul class="entry-meta entry-meta-tools">
<li class="lyssna"><a href="http://app.readspeaker.com/cgi-bin/rsent?customerid=5595&amp;lang=sv_se&amp;output=template&amp;url=<?php the_permalink(); ?>" onclick="openAndRead(); return false;" accesskey="L" target="rs" title="Lyssna p&aring; sidans text med ReadSpeaker">Lyssna</a></li>
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

<form name="rs_form" action="http://app.readspeaker.com/cgi-bin/rsent" method="post" target="rs">
<input type="hidden" name="selectedhtml" />
<input type="hidden" name="url" value="<?php the_permalink(); ?>" />
<input type="hidden" name="customerid" value="5595" />
<input type="hidden" name="lang" value="sv_se" />
<input type="hidden" name="output" value="template" />
</form>

<?php
$args = array(
'post_type' => 'attachment',
'post_mime_type' => 'application/zip, application/msword, application/vnd.ms-excel, application/pdf',
'numberposts' => -1,
'post_status' => null,
'post_parent' => $post->ID
);

$filer = get_posts($args);
if ($filer) {
		echo '<h3 class="entry-meta-bifogade">Bifogade dokument</h3><ul class="entry-meta entry-meta-blanketter">';
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
			echo '</li>';
		}
		
$bodyID = '';
if (function_exists('has_parent') && !is_search()){
	if (has_parent($wp_query->post, 17)){
		$bodyID = 'Vision';
	} elseif (has_parent($wp_query->post, 46)){
		$bodyID = 'Arbetsliv';
	} elseif (is_home()){
		$bodyID = 'Home';	
	} elseif (has_parent($wp_query->post, 73)){
		$bodyID = 'Uppleva';
	} elseif (has_parent($wp_query->post, 95)){
		$bodyID = 'Trygghet';
	} elseif (has_parent($wp_query->post, 118)){
		$bodyID = 'Boende';
	} elseif (has_parent($wp_query->post, 141)){
		$bodyID = 'Omsorg';	
	} elseif (has_parent($wp_query->post, 162)){
		$bodyID = 'Skola';
	} elseif (has_parent($wp_query->post, 178)){
		$bodyID = 'Politik';
	} else {
	$bodyID = 'Annan';
	}
}
$sajturl = get_bloginfo('url');
echo '<li class="alla"><a href="'.$sajturl.'/blanketter/#Blankett'.$bodyID.'"> Alla blanketter i <em>'.$bodyID.'</em> &raquo;</a></li>';
echo '</ul>';
}
?>

</div><!-- end entry-meta-wrapper -->

<div class="entry-body">
<?php
if (has_post_thumbnail()) {
	$fullSrc = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
	echo '<p class="lank-bild"><a class="lightbox" href="' . $fullSrc[0] . '">' . clean_wp_width_height(get_the_post_thumbnail($post->ID, 'medium')) . '</a></p>';
} ?>
<!-- RSPEAK_START -->
<?php the_content(); ?>
<!-- RSPEAK_STOP -->
</div>

</div><!-- end entry -->
<?php endwhile ?>

<p class="hoppa-till-navigering clearfix"><a href="#Sidebar" class="hoppa-till-navigering__knapp">Hoppa till navigering</a><p>

<?php comments_template(); ?>

<?php else : ?>
<h2><?php _e('Sidan finns inte'); ?></h2>
<?php endif; ?>

</div><!-- end Main Content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>