<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">

<head>

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Language" content="sv-se" />
<meta http-equiv="imagetoolbar" content="false" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<meta name="MSSmartTagsPreventParsing" content="true" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="google-site-verification" content="Pqe6URB91y9GpzLOVQsK7jiV8NTtekFRhawwWSSk4W4" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head();?>
<!--[if ! lte IE 7]><!-->
<link rel="stylesheet" type="text/css" media="screen" href="<?php $theme_data = get_theme_data(TEMPLATEPATH . '/style.css'); bloginfo('stylesheet_url'); echo '?' . $theme_data['Version']; ?>" />
<link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo('template_directory'); ?>/css/print.css<?php echo '?' . $theme_data['Version']; ?>" />
<link rel="icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/i/apple-touch-icon.png" />
<script type="text/javascript" src="http://use.typekit.com/bch8hfh.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/fancybox/jquery.fancybox-1.3.4.js<?php echo '?' . $theme_data['Version']; ?>"></script>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/fancybox/jquery.fancybox-1.3.4.css<?php echo '?' . $theme_data['Version']; ?>" type="text/css" media="screen" />
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/staff.js<?php echo '?' . $theme_data['Version']; ?>"></script>
<!--<![endif]-->
<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" media="screen, projection" href="http://universal-ie6-css.googlecode.com/files/ie6.1.1.css">
<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php bloginfo('template_directory'); ?>/css/ie6.css" />
<![endif]-->
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" media="all" href="<?php $theme_data = get_theme_data(TEMPLATEPATH . '/style.css'); bloginfo('stylesheet_url'); echo '?' . $theme_data['Version']; ?>" />
<link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo('template_directory'); ?>/css/print.css<?php echo '?' . $theme_data['Version']; ?>" />
<link rel="icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon" />
<script type="text/javascript" src="http://use.typekit.com/bch8hfh.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/fancybox/jquery.fancybox-1.3.1.pack.js<?php echo '?' . $theme_data['Version']; ?>"></script>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/fancybox/jquery.fancybox-1.3.1.css<?php echo '?' . $theme_data['Version']; ?>" type="text/css" media="screen" />
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/ie7.js<?php echo '?' . $theme_data['Version']; ?>"></script>
<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php bloginfo('template_directory'); ?>/css/ie7.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php bloginfo('template_directory'); ?>/css/ie8.css" />
<![endif]-->

<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-22995022-1']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>

</head>
<?php
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
}?>

<body<?php echo ' id="' . $bodyID . '"' ?> class="no-js">

<!-- skip links -->
<ul id="Accessibility">
<li><a href="#Main">Hoppa till innehåll</a></li>
<li><a href="#MainNav">Hoppa till huvudnavigering</a></li>
<?php if (is_page()) : ?><li><a href="#Sidebar">Hoppa till undernavigering</a></li><?php endif; ?>
</ul>

<div id="ToolbarWrapper"><!-- start ToolbarWrapper -->
<div id="Toolbar" class="clearfix"><!-- start Toolbar -->
<?php if ( is_user_logged_in()) : ?>
<ul class="left">
<?php global $current_user;
	get_currentuserinfo();
	echo '<li class="inloggad">Inloggad som <a href="'.get_bloginfo('url').'/wp-admin/profile.php">'.$current_user->display_name.'</a></li>';
	echo '<li><a class="admin" href="'.get_bloginfo ('url').'/wp-admin/">Admin</a></li>';
?>
</ul>
<?php else : ?>
<ul class="left">
<li class="inloggad"><a class="admin" href="<?php get_bloginfo('url')?>/wp-admin/">Admin</a></li>
</ul>
<?php endif; ?>

<ul class="right">
<li><a class="kontakt" href="<?php bloginfo('url'); ?>/vision/kontakt/">Kontakt</a></li>
<li><a class="rss" href="<?php bloginfo('rss2_url'); ?>">RSS</a> <a class="vadarrss" href="<?php bloginfo('url'); ?>/om-webbplatsen/vad-ar-rss/">(Vad är RSS?)</a></li>
</ul>
</div><!-- end Toolbar -->
</div><!-- end ToolbarWrapper -->

<div id="HeaderWrapper"><!-- start HeaderWrapper -->
<div id="Header" class="clearfix"><!-- start Header -->

<h1 id="Logo"><a tabindex="1" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>

<!-- Search -->
<?php include( TEMPLATEPATH . '/searchform.php' ); ?>

<div class="clear"></div>

<ul id="MainNav" class="clearfix">
<li class="vision"><a href="<?php bloginfo('url'); ?>/vision/"><strong>Vision<em> Staffanstorp nu <span class="amp">&amp;</span>  i framtiden</em></strong></a></li>
<li class="boende"><a href="<?php bloginfo('url'); ?>/boende/"><strong>Boende<em> Bo, Bygga <span class="amp">&amp;</span> Miljö</em></strong></a></li>
<li class="uppleva"><a href="<?php bloginfo('url'); ?>/uppleva/"><strong>Uppleva<em> Kultur, Fritid <span class="amp">&amp;</span> Sevärt</em></strong></a></li>
<li class="skola"><a href="<?php bloginfo('url'); ?>/skola/"><strong>Skola<em> Utbildning <span class="amp">&amp;</span> Barnomsorg</em></strong></a></li>
<li class="trygghet"><a href="<?php bloginfo('url'); ?>/trygghet/"><strong>Trygghet<em> Säkerhet <span class="amp">&amp;</span> Medborgarservice</em></strong></a></li>
<li class="omsorg"><a href="<?php bloginfo('url'); ?>/omsorg/"><strong>Omsorg<em> Stöd, Vård <span class="amp">&amp;</span> Äldreomsorg</em></strong></a></li>
<li class="arbetsliv"><a href="<?php bloginfo('url'); ?>/arbetsliv/"><strong>Arbetsliv<em> Företagande <span class="amp">&amp;</span> Arbete</em></strong></a></li>
<li class="politik"><a class="last" href="<?php bloginfo('url'); ?>/politik/"><strong>Politik <em> Demokrati, Dialog <span class="amp">&amp;</span> Protokoll</em></strong></a></li>
</ul>

</div><!-- end Header -->
</div><!-- end HeaderWrapper -->
