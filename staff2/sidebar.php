<div id="Sidebar" class="widget-area"><!-- start Sidebar -->

<ul class="wrapper"><!-- start widget ul-wrapper -->

<?php if (is_home()) : ?>
<?php dynamic_sidebar('Frontpage'); ?>
<?php endif; //end is_home

if (is_page()) : //start is_page - subnav ?>
<!-- subnav -->
<?php simple_section_nav('before_widget=<li class="widget-container subnav">&after_widget=</li>&show_all=1&show_on_home=0&before_title=<h4 class="widget-title">&after_title=</h4><div class="hr"></div><hr />'); ?>
<?php endif; //end is_page - subnav

//second sidbar
dynamic_sidebar('Sidebar'); ?>
</ul><!-- end widget ul-wrapper -->

</div><!-- end Sidebar -->
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
