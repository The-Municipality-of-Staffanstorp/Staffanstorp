<form method="get" action="<?php bloginfo('home'); ?>/">
<div id="Searchform" class="clearfix">
<label class="hidden" for="s">Sök hela webbplatsen</label>

<div class="forminner clearfix">
<?php if (is_search()) : ?>
<input type="text" name="s" id="s" value="<?php echo wp_specialchars($s, 1); ?>" />
<?php else : ?>
<input type="text" name="s" id="s" value="Vad söker du..." />
<?php endif; ?>

<button class="button" type="submit">Sök</button>
</div>

</div>
</form>