<?php

/**** Maintenance mode ****/
function admin_maintenace_mode()
{
  global $current_user;
  get_currentuserinfo();
  if ($current_user->user_login != "admin") { ?>
			<style> .updated{margin:30px !important;} </style><?php die(
     '<h3 id="message" class="updated">Underhållsarbete pågår.</h3>'
   );}
}
//add_action('admin_head', 'admin_maintenace_mode');

add_editor_style();

/**** Add post thumbnail functionality ****/
if (function_exists("add_theme_support")) {
  add_theme_support("post-thumbnails");
  set_post_thumbnail_size(260, 146, true); //  thumbnail size
  add_image_size("medium", 528, 297, true); // single post size
  add_image_size("large", 1440, 1024); // lightbox size
}

/**** Add title attribute back to gallery images -- new for WP 3.5 ****/
/**** http://wordpress.org/support/topic/restoring-titles-to-inserted-images-in-wordpress-35 ****/
function my_image_titles($atts, $img)
{
  $atts["title"] = trim(strip_tags($img->post_title));
  return $atts;
}
add_filter("wp_get_attachment_image_attributes", "my_image_titles", 10, 2);

/**** Enqueue jquery ****/
if (!is_admin()) {
  wp_deregister_script("jquery");
  wp_register_script(
    "jquery",
    "https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js",
    false,
    "3.7.1"
  );
  wp_enqueue_script("jquery");
}

/**** Remove css for wp-paginate ****/
function my_deregister_styles()
{
  wp_deregister_style("wp-paginate");
}
add_action("wp_print_styles", "my_deregister_styles", 100);

/**** TinyMCE cutomization ****/
/**** allow iFrame ****/
function fb_change_mce_options($initArray)
{
  // Comma separated string od extendes tags
  // Command separated string of extended elements
  $ext =
    "pre[id|name|class|style],iframe[align|longdesc|name|width|height|frameborder|scrolling|marginheight|marginwidth|src]";

  if (isset($initArray["extended_valid_elements"])) {
    $initArray["extended_valid_elements"] .= "," . $ext;
  } else {
    $initArray["extended_valid_elements"] = $ext;
  }
  // maybe; set tiny paramter verify_html
  $initArray["verify_html"] = false;

  return $initArray;
}
add_filter("tiny_mce_before_init", "fb_change_mce_options");

/**** dropdown knappar ****/
function fb_change_mce_buttons($initArray)
{
  //@see http://wiki.moxiecode.com/index.php/TinyMCE:Control_reference
  $initArray["theme_advanced_blockformats"] = "p,h3,h4";
  $initArray["theme_advanced_disable"] =
    "strikethrough,underline,forecolor,justifyfull,justifyleft,justifycenter,justifyright,indent,outdent,fullscreen";
  return $initArray;
}
add_filter("tiny_mce_before_init", "fb_change_mce_buttons");

// TinyMCE: First line toolbar customizations
if (!function_exists("base_extended_editor_mce_buttons")) {
  function base_extended_editor_mce_buttons($buttons)
  {
    // The settings are returned in this array. Customize to suite your needs.
    return [
      "bold",
      "italic",
      "formatselect",
      "bullist",
      "numlist",
      "blockquote",
      "link",
      "unlink",
      "pastetext",
      "pasteword",
      "removeformat",
      "charmap",
      "undo",
      "redo",
      "wp_help",
    ];
    /* WordPress Default
		return array(
			'bold', 'italic', 'strikethrough', 'separator',
			'bullist', 'numlist', 'blockquote', 'separator',
			'justifyleft', 'justifycenter', 'justifyright', 'separator',
			'link', 'unlink', 'wp_more', 'separator',
			'spellchecker', 'fullscreen', 'wp_adv'
		); */
  }
  add_filter("mce_buttons", "base_extended_editor_mce_buttons", 0);
}

// TinyMCE: Second line toolbar customizations
if (!function_exists("base_extended_editor_mce_buttons_2")) {
  function base_extended_editor_mce_buttons_2($buttons)
  {
    // The settings are returned in this array. Customize to suite your needs. An empty array is used here because I remove the second row of icons.
    return [];
    /* WordPress Default
		return array(
			'formatselect', 'underline', 'justifyfull', 'forecolor', 'separator',
			'pastetext', 'pasteword', 'removeformat', 'separator',
			'media', 'charmap', 'separator',
			'outdent', 'indent', 'separator',
			'undo', 'redo', 'wp_help'
		); */
  }
  add_filter("mce_buttons_2", "base_extended_editor_mce_buttons_2", 0);
}

/**** Remove target _blank etc. ****/
function rel_external($content)
{
  $regexp = '/\<a[^\>]*(target="_([\w]*)")[^\>]*\>[^\<]*\<\/a>/smU';
  if (preg_match_all($regexp, $content, $matches)) {
    for ($m = 0; $m < count($matches[0]); $m++) {
      if ($matches[2][$m] == "blank") {
        $temp = str_replace($matches[1][$m], 'rel="external"', $matches[0][$m]);
        $content = str_replace($matches[0][$m], $temp, $content);
      } elseif ($matches[2][$m] == "self") {
        $temp = str_replace(" " . $matches[1][$m], "", $matches[0][$m]);
        $content = str_replace($matches[0][$m], $temp, $content);
      }
    }
  }
  return $content;
}
add_filter("the_content", "rel_external");

/**** Clean away width and height attributes ****/
function clean_wp_width_height($string)
{
  return preg_replace(
    '/\<(.*?)(width="(.*?)")(.*?)(height="(.*?)")(.*?)\>/i',
    '<$1$4$7>',
    $string
  );
}

function remove_width_attributes($string)
{
  return preg_replace(
    '/\<(.*?)(width="(.*?)")(.*?)(height="(.*?)")(.*?)\>/i',
    '<$1$4$7>',
    $string
  );
  return $string;
}

add_filter("post_thumbnail_html", "remove_thumbnail_dimensions", 10);
add_filter("image_send_to_editor", "remove_thumbnail_dimensions", 10);
add_filter("the_content", "remove_thumbnail_dimensions", 10);

// Removes attached image sizes as well
/* -------------------------- */
function remove_thumbnail_dimensions($html)
{
  $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
  return $html;
}

/**** Clean away title attribute ****/
function remove_title_attributes($input)
{
  return preg_replace('/\s*title\s*=\s*(["\']).*?\1/', "", $input);
}
add_filter("wp_list_pages", "remove_title_attributes");

/**** captions ****/
add_shortcode("wp_caption", "fixed_img_caption_shortcode");
add_shortcode("caption", "fixed_img_caption_shortcode");

function fixed_img_caption_shortcode($attr, $content = null)
{
  // Allow plugins/themes to override the default caption template.
  $output = apply_filters("img_caption_shortcode", "", $attr, $content);
  if ($output != "") {
    return $output;
  }
  extract(
    shortcode_atts(
      [
        "id" => "",
        "align" => "alignnone",
        "width" => "",
        "caption" => "",
      ],
      $attr
    )
  );
  if (empty($caption)) {
    return $content;
  }
  if ($id) {
    $id = 'id="' . esc_attr($id) . '" ';
  }
  return "<div " .
    $id .
    'class="wp-caption clearfix ' .
    esc_attr($align) .
    '">' .
    do_shortcode($content) .
    '<p class="wp-caption-text">' .
    $caption .
    "</p></div>";
}

/**** Archive date function ****/
function theme_get_archive_date()
{
  if (is_day()) {
    $this_archive = get_the_time("j F Y");
  } elseif (is_month()) {
    $this_archive = get_the_time("F Y");
  } else {
    $this_archive = get_the_time("Y");
  }
  return $this_archive;
}

/**** Remove header stuff ****/
//remove_action( 'wp_head', 'feed_links_extra', 3 ); // Removes the links to the extra feeds such as category feeds
//remove_action( 'wp_head', 'feed_links', 2 ); // Removes links to the general feeds: Post and Comment Feed

remove_action("wp_head", "rsd_link");
remove_action("wp_head", "wp_generator");
remove_action("wp_head", "wlwmanifest_link");

function my_remove_recent_comments_style()
{
  global $wp_widget_factory;
  remove_action("wp_head", [
    $wp_widget_factory->widgets["WP_Widget_Recent_Comments"],
    "recent_comments_style",
  ]);
}
add_action("widgets_init", "my_remove_recent_comments_style");

/**** For navigation - check ID post and child-post ****/
function has_parent($post, $post_id)
{
  if ($post->ID == $post_id) {
    return true;
  } elseif ($post->post_parent == 0) {
    return false;
  } else {
    return has_parent(get_post($post->post_parent), $post_id);
  }
}

/**** Excerpt length ****/
function new_excerpt_length($length)
{
  return 34;
}
add_filter("excerpt_length", "new_excerpt_length");

/**** Insert thumbnails in RSS ****/
function insertThumbnailRSS($content)
{
  global $post;
  if (has_post_thumbnail($post->ID)) {
    $content =
      "<p>" . get_the_post_thumbnail($post->ID, "medium") . "</p>" . $content;
  }
  return $content;
}
add_filter("the_excerpt_rss", "insertThumbnailRSS");
add_filter("the_content_feed", "insertThumbnailRSS");

/****  add feed links to header ****/
if (function_exists("automatic_feed_links")) {
  automatic_feed_links();
} else {
  return;
}

/**** enable threaded comments ****/
function enable_threaded_comments()
{
  if (!is_admin()) {
    if (
      is_singular() and
      comments_open() and
      get_option("thread_comments") == 1
    ) {
      wp_enqueue_script("comment-reply");
    }
  }
}
/* add_action('get_header', 'enable_threaded_comments'); */
/* added above wp_head instead */

/**** Comments ****/
function custom_comments_callback($comment, $args, $depth)
{
  $GLOBALS["comment"] = $comment; ?>

<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
<div class="comment-wrap">
<div class="gravatarHolder"><?php echo get_avatar(
  get_comment_author_email(),
  $size = "50"
); ?></div>

<ul class="comment-meta">
<li><?php printf(__("%s"), get_comment_author_link()); ?></li>
<li><a class="comment-permalink" href="<?php echo htmlspecialchars(
  get_comment_link($comment->comment_ID)
); ?>"><?php comment_date("j/n, Y"); ?> @ <?php comment_time("H.i"); ?></a></li>
<li><?php edit_comment_link("Redigera &raquo;", "", ""); ?></li>
</ul>
<?php if ($comment->comment_approved == "0"): ?>
<p class="comment-moderation"><?php _e(
  "Your comment is awaiting moderation."
); ?></p>
<?php endif; ?>

<div class="comment-text"><?php comment_text(); ?></div>
<div class="clear"></div>
<div class="reply" id="comment-reply-<?php comment_ID(); ?>">
<?php comment_reply_link(
  array_merge($args, [
    "reply_text" => "Svara",
    "login_text" => "Logga in för att svara",
    "add_below" => "comment-reply",
    "depth" => $depth,
    "max_depth" => $args["max_depth"],
  ])
); ?>
</div>
<div class="clear"></div>
</div>

<?php
} // WP adds the closing </li>

/**** Pingbacks ****/
function custom_ping_callback($comment, $args, $depth)
{
  $GLOBALS["comment"] = $comment; ?>

<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
<div class="comment-wrap">

<h4><?php printf(__("%s"), get_comment_author_link()); ?></h4>
<p class="pingbackdate"><a href="http://en.support.wordpress.com/pingbacks/" title="Förklaring av pingback på engelska">Pingback</a> <span>den</span> <a class="comment-permalink" href="<?php echo htmlspecialchars(
  get_comment_link($comment->comment_ID)
); ?>"><?php comment_date("j F, Y"); ?> @ <?php comment_time("H.i"); ?></a></p>
<?php comment_text(); ?>
<div class="clear"></div>

</div>

<?php
} // WP adds the closing </li>

/**** Trackbacks ****/
function custom_track_callback($comment, $args, $depth)
{
  $GLOBALS["comment"] = $comment; ?>

<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
<div class="comment-wrap">

<h4><?php printf(__("%s"), get_comment_author_link()); ?></h4>
<p class="pingbackdate"><a href="http://en.support.wordpress.com/trackbacks/" title="Förklaring av trackbacks på engelska">Trackback</a> <span>den</span> <a class="comment-permalink" href="<?php echo htmlspecialchars(
  get_comment_link($comment->comment_ID)
); ?>"><?php comment_date("j F, Y"); ?> @ <?php comment_time("H.i"); ?></a></p>
<?php comment_text(); ?>
<div class="clear"></div>

</div>

<?php
} // WP adds the closing </li>

/**** Enable widgets ****/
function widgets_init_pj()
{
  register_sidebar([
    "name" => "StartsidaWidgets",
    "before_widget" => '<li id="%1$s" class="widget-container %2$s">',
    "after_widget" => "</li>",
    "description" => "Widgetyta för startsidan",
    "before_title" => '<h4 class="widget-title">',
    "after_title" => '</h4><div class="hr"></div><hr />',
  ]);

  register_sidebar([
    "name" => "Sidebar",
    "before_widget" => '<li id="%1$s" class="widget-container %2$s">',
    "after_widget" => "</li>",
    "description" => "Widgetyta på högersidan",
    "before_title" => '<h4 class="widget-title">',
    "after_title" => '</h4><div class="hr"></div><hr />',
  ]);

  register_sidebar([
    "name" => "QuickInfo 1",
    "before_widget" => '<li id="%1$s" class="widget-container %2$s">',
    "after_widget" => "</li>",
    "before_title" => '<h4 class="widget-title">',
    "after_title" => '</h4><div class="hr"></div><hr />',
  ]);

  register_sidebar([
    "name" => "QuickInfo 2",
    "before_widget" => '<li id="%1$s" class="widget-container %2$s">',
    "after_widget" => "</li>",
    "before_title" => '<h4 class="widget-title">',
    "after_title" => '</h4><div class="hr"></div><hr />',
  ]);

  register_sidebar([
    "name" => "QuickInfo 3",
    "before_widget" => '<li id="%1$s" class="widget-container %2$s">',
    "after_widget" => "</li>",
    "before_title" => '<h4 class="widget-title">',
    "after_title" => '</h4><div class="hr"></div><hr />',
  ]);

  register_sidebar([
    "name" => "QuickInfo 4",
    "before_widget" => '<li id="%1$s" class="widget-container %2$s last">',
    "after_widget" => "</li>",
    "before_title" => '<h4 class="widget-title">',
    "after_title" => '</h4><div class="hr"></div><hr />',
  ]);

  register_sidebar([
    "name" => "FooterLeft",
    "before_widget" => '<li id="%1$s" class="widget-container %2$s">',
    "after_widget" => "</li>",
    "description" =>
      "Widgetyta för etikettmoln på vänstersidan av sidfoten (4 kolumner bred)",
    "before_title" => '<h4 class="widget-title">',
    "after_title" => '</h4><div class="hr"></div><hr />',
  ]);

  register_sidebar([
    "name" => "FooterRight1",
    "before_widget" => '<li id="%1$s" class="widget-container %2$s">',
    "after_widget" => "</li>",
    "description" => "Widgetyta 1 för högersidan av sidfoten (2 kolumner bred)",
    "before_title" => '<h4 class="widget-title">',
    "after_title" => '</h4><div class="hr"></div><hr />',
  ]);

  register_sidebar([
    "name" => "FooterRight2",
    "before_widget" => '<li id="%1$s" class="widget-container %2$s last">',
    "after_widget" => "</li>",
    "description" => "Widgetyta 2 för högersidan av sidfoten (2 kolumner bred)",
    "before_title" => '<h4 class="widget-title">',
    "after_title" => '</h4><div class="hr"></div><hr />',
  ]);
}
add_action("widgets_init", "widgets_init_pj");

/**** Limit the archive to X months ****/
function my_limit_archives($args)
{
  $args["limit"] = 10;
  return $args;
}
add_filter("widget_archives_args", "my_limit_archives");

/**** Kill the admin nag ****/
if (!current_user_can("edit_users")) {
  add_action(
    "init",
    create_function('$a', "remove_action('init', 'wp_version_check');"),
    2
  );
  //add_filter('pre_option_update_core', create_function('$a', "return null;"));
}

/**** Remove widgets from wp-admin panel ****/
function remove_dashboard_widgets()
{
  global $wp_meta_boxes;
  /* 	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
 	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); */
  unset($wp_meta_boxes["dashboard"]["normal"]["core"]["dashboard_plugins"]);
  /* 	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']); */
  /* 	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); */
  unset($wp_meta_boxes["dashboard"]["side"]["core"]["dashboard_primary"]);
  unset($wp_meta_boxes["dashboard"]["side"]["core"]["dashboard_secondary"]);
}
/* if (!current_user_can('manage_options')) { */
add_action("wp_dashboard_setup", "remove_dashboard_widgets");
/* } */

/**** Allow contributors to upload media ****/
if (current_user_can("contributor") && !current_user_can("upload_files")) {
  add_action("admin_init", "allow_contributor_uploads");
}
function allow_contributor_uploads()
{
  $contributor = get_role("contributor");
  $contributor->add_cap("upload_files");
}

/**** Disable auto formatting in posts shortcode ****/
/**** Usage: [raw]Unformatted content[/raw] ****/
function my_formatter($content)
{
  $new_content = "";
  $pattern_full = "{(\[raw\].*?\[/raw\])}is";
  $pattern_contents = "{\[raw\](.*?)\[/raw\]}is";
  $pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

  foreach ($pieces as $piece) {
    if (preg_match($pattern_contents, $piece, $matches)) {
      $new_content .= $matches[1];
    } else {
      $new_content .= wptexturize(wpautop($piece));
    }
  }

  return $new_content;
}

remove_filter("the_content", "wpautop");
remove_filter("the_content", "wptexturize");
add_filter("the_content", "my_formatter", 99);

/**** Enable widget shortcode ****/
add_filter("widget_text", "do_shortcode");

/**** Obfuscate email shortcode ****/
function munge_mail_shortcode($atts, $content = null)
{
  for ($i = 0; $i < strlen($content); $i++) {
    $encodedmail .= "&#" . ord($content[$i]) . ";";
  }
  return '<a href="mailto:' . $encodedmail . '">' . $encodedmail . "</a>";
}
add_shortcode("mailto", "munge_mail_shortcode");

?>
