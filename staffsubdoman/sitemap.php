<div id="SitemapWrapper" class="clearfix"><!-- start SitemapWrapper -->
<div id="Sitemap" class="clearfix"><!-- start Sitemap -->

<p class="veryfakeheader"><strong>Sajtkarta</strong></p>

<ul id="Masonry" class="clearfix"><!-- start masonry -->
<?php wp_list_pages('title_li=&exclude_tree=1086');//exclude blanketter ?>

<?php 
$sajturl = get_bloginfo('url');
$currentyear = date("Y");
?>

<!--  extra pages  -->
<li class="parent-level-0"><a href="<?php echo $sajturl.'/'.$currentyear.'/' ?>">Nyhetsarkiv</a>
<!--
<ul class='children'>
	<li class="page_item page-item-31"><a href="#" title="Den gröna planen">Den gröna planen</a></li>
	<li class="page_item page-item-29"><a href="http://localhost:8888/StaffanstorpSVN/vision/framtidens-kommun/" title="Framtidens kommun">Framtidens kommun</a></li>
	<li class="page_item page-item-19 parent-level-1"><a href="http://localhost:8888/StaffanstorpSVN/vision/undersida/" title="Om kommunen">Om kommunen</a></li>
</ul>
-->
</li>

<li class="parent-level-0"><a href="<?php echo $sajturl.'/blanketter/' ?>">Blanketter</a></li>

</ul><!-- end masonry -->

</div><!-- end Sitemap -->
</div><!-- end SitemapWrapper -->