<?php
$sajturl = get_bloginfo('url');
$sajtnamn = get_bloginfo('name');
$currentyear = date("Y"); 

if (is_page() && !is_front_page() || is_single()) {
	echo '<ul id="Breadcrumb" class="clearfix">';
	echo '<li class="home"><a href="'.$sajturl.'">'.$sajtnamn.'</a></li>';
	if (is_page()) {
		$ancestors = get_post_ancestors($post);
			if ($ancestors) {
				$ancestors = array_reverse($ancestors);
				foreach ($ancestors as $crumb) {
				echo '<li><a href="'.get_permalink($crumb).'">'.get_the_title($crumb).'</a></li>';
			}
		}
	}
	
	if (is_single() && is_attachment()){
		echo '<li><a href="#">Fil</a></li>';
	}
	
	if (is_single() && !is_attachment()){
		echo '<li><a href="'.$sajturl.'/'.$currentyear.'/">Nyheter</a></li>';
	}

	// Current page
	if (is_page() || is_single()) {
		echo '<li class="current">'.get_the_title().'</li>';
	}
echo '</ul>';

} //END FIRST IF

elseif (is_front_page()) { // Front page
	echo '<ul id="Breadcrumb" class="clearfix">';
	echo '<li class="home"><a href="'.$sajturl.'" title="Till startsidan">'.$sajtnamn.'</a></li>';
	echo '<li class="current">Startsida</li>';
	echo '</ul>';
}

elseif (is_search()){ // Search
	echo '<ul id="Breadcrumb" class="clearfix">';
	echo '<li class="home"><a href="'.$sajturl.'" title="Till startsidan">'.$sajtnamn.'</a></li>';
	echo '<li class="current">Sökresultat för <span>' . $s . '</span>';
	echo '</li></ul>';
}

elseif (is_tag()){ // Etikett
	echo '<ul id="Breadcrumb" class="clearfix">';
	echo '<li class="home"><a href="'.$sajturl.'" title="Till startsidan">'.$sajtnamn.'</a></li>';
	echo '<li class="current">';
	echo 'Arkiv för etiketten <span>'.single_tag_title('', false ).'</span>';
	echo '</li></ul>';
}

elseif (is_category()){ // Kategori
	echo '<ul id="Breadcrumb" class="clearfix">';
	echo '<li class="home"><a href="'.$sajturl.'" title="Till startsidan">'.$sajtnamn.'</a></li>';
	echo '<li class="current">Arkiv för kategorin <span>'.single_cat_title('', false ).'</span></li></ul>';
}

elseif (is_author()){ // Skribent
	if(get_query_var('author_name')) :
    $curauth = get_user_by('slug', get_query_var('author_name'));
else :
    $curauth = get_userdata(get_query_var('author'));
endif;

	echo '<ul id="Breadcrumb" class="clearfix">';
	echo '<li class="home"><a href="'.$sajturl.'" title="Till startsidan">'.$sajtnamn.'</a></li>';
	echo '<li class="current">Artiklar skrivna av <span>'.$curauth->first_name.' '.$curauth ->last_name.'</span></li></ul>';
}

elseif (is_archive()){ // Nyhetsarkiv
	echo '<ul id="Breadcrumb" class="clearfix">';
	echo '<li class="home"><a href="'.$sajturl.'" title="Till startsidan">'.$sajtnamn.'</a></li>';
	echo '<li class="current">Nyhetsarkiv <span>'; echo theme_get_archive_date(); echo '</span></li></ul>';
}

elseif (is_404()){ // 404
	echo '<ul id="Breadcrumb" class="clearfix">';
	echo '<li class="home"><a href="'.$sajturl.'" title="Till startsidan">'.$sajtnamn.'</a></li>';
	echo '<li class="current"><span>404</span>: Sidan kunde inte hittas</li>';
	echo '</ul>';
}

?>