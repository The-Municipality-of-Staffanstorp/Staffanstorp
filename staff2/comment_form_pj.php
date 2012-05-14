<?php if ('open' == $post->comment_status) : ?>
<div id="respond">
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php comment_id_fields(); ?>
<fieldset>
<legend>Lämna en kommentar</legend>

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>
<?php if( get_option('comment_registration') && !$user_ID ) : ?>
<p>Du måste vara <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">inloggad</a> för att lägga till en kommentar.</p><?php else : ?>

<?php if($user_ID) : ?>
<p class="logged-in-as">Inloggad som <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>">Logga ut &raquo;</a></p>

<?php else : ?>
<div class="form-left">
<p><label for="author">Namn <?php if ($req) echo "(obligatoriskt)"; ?></label><br />
<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" /></p>
<p><label for="email">E-post (publiceras aldrig &ndash; <?php if ($req) echo " obligatoriskt)"; ?></label><br />
<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" /></p>
<p><label for="url">Webbplats</label><br />
<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" /></p>
</div>
<?php endif; ?>

<div class="<?php if($user_ID) : ?>form-logged-in<?php else : ?>form-right<?php endif; ?> clearfix">
<p><label for="comment">Kommentar:</label><br />
<textarea name="comment" id="comment" cols="100%" rows="10"></textarea></p>
<p><button class="button" name="submit" type="submit" value="Skicka kommentar">Skicka</button></p>
<?php do_action('comment_form', $post->ID); ?>
<!-- <p class="clear tecken">Du kan använda följande <abbr title="HyperText Markup Language">HTML</abbr> element: <code><?php echo allowed_tags(); ?></code></p> -->
</div>

</fieldset>
</form>
<?php endif; // If registration required and not logged in ?>
</div>
<?php endif; // if you delete this the sky will fall on your head ?>