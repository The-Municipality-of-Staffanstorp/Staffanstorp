# WordPress teman för Staffanstorp.se

## Allmänt

[Staffanstorps kommun](http://staffanstorp.se) är en WordPress(WP) [multisite](http://codex.wordpress.org/Create_A_Network) med ungefär 40 undersajter. För undersajterna används ett förenklat tema(_staffsubdoman_) baserat på huvuddomänens(_staff2_) tema.

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

## Plugins

Följande tilläggsmoduler är aktiva:

* sdf

## Licens

Utvecklat av [Johan Edlund](http://edlunddesign.com/) / [@pjedlund](http://twitter.com/pjedlund/). Du är fri att använda denna kod på vilket sätt som helst. [The Unlicense](http://unlicense.org/).