# WordPress teman för Staffanstorp.se

## Allmänt

[Staffanstorps kommun](http://staffanstorp.se) är en WordPress 3 [multisite](http://codex.wordpress.org/Create_A_Network) med ungefär 40 undersajter. För undersajterna används ett förenklat tema(_staffsubdoman_) baserat på huvuddomänens(_staff2_) tema.

Du är mer än välkommen att vidareutveckla dessa teman eller använda vissa delar av koden här på samma sätt som det mesta i temana bygger på arbete som andra har utfört, t.ex.:

* [HTML5 Boilerplate](http://html5boilerplate.com/): ([The Unlicense](http://unlicense.org/))
* [320 and up](http://stuffandnonsense.co.uk/projects/320andup/): 
([MIT Licens](http://creativecommons.org/licenses/MIT/))

Temana använder [Responsive Design](http://www.alistapart.com/articles/responsive-web-design/) med ett "fluid grid" som har åtta kolumner.

## Typsnitt
[FF Meta Serif Web Pro](https://typekit.com/fonts/ff-meta-serif-web-pro) och [FF Meta Web Pro](https://typekit.com/fonts/ff-meta-web-pro) laddas från [typkit.com](http://typekit.com). Fast detta sker bara om webbläsaren har font-smoothing (_cleartype_ et al.) påslaget:

	html.hasFontSmoothing-true body{ … font-family: "ff-meta-serif-web-pro-1","ff-meta-serif-web-pro-2", Georgia, serif;}

För webbläsare som inte har font-smoothing, saknar stöd för webbtypsnitt (`@font-face`), samt iPad och smartphones laddas en fallback font stack:

	font-family: Georgia, Times, serif;

[Zoltan Hawryluk](http://www.useragentman.com/blog/) har skrivit [Typehelpers](http://www.useragentman.com/blog/2009/11/29/how-to-detect-font-smoothing-using-javascript/) som undersöker stödet för font-smoothing.

## Sajtkarta

<del>Uppe i högra hörnet finns en länk som öppnar en sajtkarta. Om du missat den är du inte ensam… ;) För att få kartan så kompakt som möjligt används [David DeSandro](http://desandro.com)'s utmärkta [Masonry](http://masonry.desandro.com/). Sajtkartan är statisk eftersom det blev för svårt att hantera all databasanrop som krävs för att ha den dynamisk.</del>

Sajtkartan är nu bortplockad (30/5-12).

## Plugins

**OBS!** [Simple Section Navigation Widget](http://www.cmurrayconsulting.com/software/wordpress-simple-section-navigation/) används för navigering i högerspalten och tillägget måste vara aktiverat för att inte få ett felmeddelande.

Följande tilläggsmoduler är aktiva:

* [Akismet](http://akismet.com/)
* [All in One SEO Pack](http://semperfiwebdesign.com/)
* [Binary Peak Content Management](http://binarypeak.se/) -- plugg som lägger till funktionalitet för [Staffanstorps officiella iOS-app](http://itunes.apple.com/tw/app/staffanstorp/id478960853?mt=8).
* [Google Calendar Events](http://www.rhanney.co.uk/plugins/google-calendar-events) -- omstylad av mig.
* [Page Excerpt](http://dennishoppe.de/wordpress-plugins/page-excerpt)
* [Quick Cache](http://www.primothemes.com/post/product/quick-cache-plugin-for-wordpress/) -- rekommenderas varmt.
* [Relevanssi Premium](http://www.relevanssi.com/)
* [Simple Section Navigation Widget](http://www.cmurrayconsulting.com/software/wordpress-simple-section-navigation/)
* [Unfiltered MU](http://wordpress.org/extend/plugins/unfiltered-mu/)
* [WP-Paginate](http://www.ericmmartin.com/projects/wp-paginate/)

## Javascript

[jQuery](http://jquery.com) enqueue-as via functions.php och sedan är den flesta plugins samlade i js/staff.js.

## Licens

Utvecklat av [Johan Edlund](http://edlunddesign.com/) / [@pjedlund](http://twitter.com/pjedlund/). Du är fri att använda denna kod på vilket sätt som helst. [The Unlicense](http://unlicense.org/).

Bilder, illustrationer och grafik är licensierade enligt [Creative Commons Erkännande-IckeKommersiell-DelaLika 3.0 Unported Licens](http://creativecommons.org/licenses/by-nc-sa/3.0/). [Staffanstorps licenspolicy](http://staffanstorp.se/om-webbplatsen/licens/).