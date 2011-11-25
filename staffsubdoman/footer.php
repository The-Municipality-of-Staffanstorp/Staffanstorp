<div id="FooterWrapper"><!-- start FooterWrapper -->
<div id="Footer" class="clearfix"><!-- start Footer -->

<div class="hr"></div><hr />

<p class="copy"><a class="alignleft" rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/"><img alt="Creative Commons-licens" src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" /></a>Denna webbplats är licensierad under en <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons Erkännande-IckeKommersiell-DelaLika 3.0 Unported Licens</a>. För vissa verk gäller inte denna generella licens. <a href="http://staffanstorp.se/om-webbplatsen/licens/">Staffanstorps licenspolicy</a>.</p>

<?php if(is_active_sidebar('footer-2')): ?>
<div id="Etikettmoln" class="widget-area"><!-- start Etikettmoln -->
<ul>
<?php dynamic_sidebar('Footer2'); ?>
</ul>
</div><!-- end Etikettmoln -->
<?php endif; ?>

</div><!-- end Footer -->
</div><!-- end FooterWrapper -->

<!--[if IE 7]>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/imgSizer.js"></script>
<script type="text/javascript">
window.onload = function() {
	imgSizer.collate();
}
</script>
<![endif]-->

<?php wp_footer(); ?>

</body>
</html>