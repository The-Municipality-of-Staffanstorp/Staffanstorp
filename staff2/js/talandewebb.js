var addr = "www.browsealoud.com";
var l = typeof (locale) == "undefined" ? "se" : locale;
var locale = "se";
function getProtocol() { return window.location.href.indexOf('https') == 0 ? 'https' : 'http'; }

var bd = {
    init: function () {
        this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
        this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
        this.OS = this.searchString(this.dataOS) || "an unknown OS";
    },
    searchString: function (data) {
        for (var i = 0; i < data.length; i++) {
            var dataString = data[i].string;
            var dataProp = data[i].prop;
            this.versionSearchString = data[i].versionSearch || data[i].identity;
            if (dataString) {
                if (dataString.indexOf(data[i].subString) != -1)
                    return data[i].identity;
            }
            else if (dataProp)
                return data[i].identity;
        }
    },
    searchVersion: function (dataString) {
        var index = dataString.indexOf(this.versionSearchString);
        if (index == -1) return;
        var result = parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
        // Work out the correct IE version (based on the potential presence of Compatibility View)
        if (document.documentMode) {
            if (document.documentMode != "undefined") {
                result = parseFloat(dataString.substring(dataString.indexOf("Trident") + 8)) == 4 ? 8 : 9;
            }
        }
        return result;
    },
    dataBrowser: [
		{
		    string: navigator.userAgent,
		    subString: "Chrome",
		    identity: "Chrome"
		},
		{
		    string: navigator.vendor,
		    subString: "Apple",
		    identity: "Safari",
		    versionSearch: "Version"
		},
		{
		    string: navigator.userAgent,
		    subString: "Firefox",
		    identity: "Firefox"
		},
		{		// for newer Netscapes (6+)
		    string: navigator.userAgent,
		    subString: "Netscape",
		    identity: "Netscape"
		},
		{
		    string: navigator.userAgent,
		    subString: "MSIE",
		    identity: "IE",
		    versionSearch: "MSIE"
		},
		{ 		// for older Netscapes (4-)
		    string: navigator.userAgent,
		    subString: "Mozilla",
		    identity: "Netscape",
		    versionSearch: "Mozilla"
		}
	],
    dataOS: [
		{
		    string: navigator.platform,
		    subString: "Win",
		    identity: "Windows"
		},
		{
		    string: navigator.platform,
		    subString: "Mac",
		    identity: "Mac"
		},
		{
		    string: navigator.userAgent,
		    subString: "iPad",
		    identity: "iPad"
		},
		{
		    string: navigator.userAgent,
		    subString: "iPod",
		    identity: "iPod"
		},
		{
		    string: navigator.userAgent,
		    subString: "iPhone",
		    identity: "iPhone"
		},
		{
		    string: navigator.userAgent,
		    subString: "Android",
		    identity: "Android"
		},
		{
		    string: navigator.platform,
		    subString: "Linux",
		    identity: "Linux"
		}
	]

};
bd.init();

var bn = "";
switch (bd.OS) {
    case "Windows": case "Mac": case "Linux":
        bn = bd.browser == "IE" ? bd.browser + bd.version : bd.browser;
        break;

    case "iPad": case "Android": case "iPhone": case "iPod":
        bn = bd.OS;
        break;
}

var arrIdx = 0;
var TRY_NOW = [
	"Listen with BrowseAloud"
];
var SECURE_SITE = [
	"BrowseAloud currently unsupported on secure sites."
];
var MORE_INFO = [
	"Learn more at www.browsealoud.com"
];
var LIGHTBOX_TEXT = [
	"<b>BrowseAloud</b> reads websites out loud. It's free to use.<br /><br />Find out more by \
	<a href=\"http://www.browsealoud.com/\" target=\"_blank\">clicking here</a>."
];

var html = "";

if (typeof (jQuery) == "undefined") {
    html += "<scr" + "ipt type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js\"></scr" + "ipt>";
}

var prefix = "__ba_";
var fontColour = "#FFF";
var imgSuffix = "";
var speakerMode = false;

if (typeof (mode) != "undefined") {
    speakerMode = mode.indexOf("logo") != -1;
    prefix = "__ba_" + mode;
    imgSuffix = "_" + mode;
}
var pgId = 80004;
switch (l) {
    case "us":
        pgId = 80096;
        break;
}

var bookmarkletLink = "javascript:function getProtocol(){return window.location.href.indexOf('https')==0?'https':'http';}(function(){if(bd.browser=='IE'&&getProtocol()=='https'){alert('You are viewing a secure website. We do not currently support BrowseAloud services on secure sites.');}else{document.getElementsByTagName('body')[0].appendChild(document.createElement('script')).src=getProtocol()+'://babm.texthelp.com/Bookmarklet.ashx?l=" + l + "';}})()";

html += "\
<style type=\"text/css\">\
	#" + prefix + "_button *,#" + prefix + "_lb_content{font-family:'Calibri',sans-serif;font-size:12px;color:" + fontColour + ";}\
	#" + prefix + "_button{}" + /*\
	#" + prefix + "_button a{}\
	#" + prefix + "_button a img{border:0;}\
	#" + prefix + "_button .logo{}\
	#" + prefix + "_title{}" + \
	#" + prefix + "_lb_overlay{display:none;position:absolute;top:0%;left:0%;width:100%;height:100%;background-color:black;z-index:1001;-moz-opacity:0.7;opacity:.70;filter:alpha(opacity=70);}\
	#" + prefix + "_lb_content{display:none;position:absolute;padding:16px;background-color:white;z-index:1002;overflow:auto;border-radius:10px;box-shadow:5px 5px 10px #b2b2b2;overflow:auto;font-size:11pt;color:#000;}\
	#" + prefix + "_close_btn{display:none;z-index:1005;position:absolute;}\
	#" + prefix + "_zoom{}\*/
"</style>";

if (speakerMode) {
    html += "\
	<a id=\"" + prefix + "_link\" href=\"" + bookmarkletLink + ";zoomToolbar();\" title=\"" + TRY_NOW[arrIdx] + "\">\
		<img src=\"http://" + addr + "/plus/ba" + imgSuffix + ".png\" alt=\"" + TRY_NOW[arrIdx] + "\" />\
	</a>";
} else {
    html += "\
	<div id=\"" + prefix + "_button\" style=\"width:116px;height:51px;padding:1px 0 0 4px;background:url(http://" + addr + "/plus/ba_button_bg" + imgSuffix + ".png) no-repeat top;\">\
		<a class=\"logo\" href=\"" + bookmarkletLink + ";zoomToolbar();\" title=\"" + TRY_NOW[arrIdx] + "\" style=\"display:inline-block;float:left;margin:4px 2px 0 0;width:42px;height:42px;vertical-align:middle;\"></a>\
		<div id=\"" + prefix + "_title\" style=\"font-size:14px;font-weight:bold;margin:0 4px 8px 0;text-align:center;width:64px;height:13px;float:right;color:" + fontColour + "\">" + bn + "</div>\
		<a href=\"" + bookmarkletLink + ";zoomToolbar();\" style=\"display:inline-block;width:24px;height:24px;vertical-align:middle;margin:0 0 0 6px;outline:0;\">";

    if (getProtocol() == "https") {
        html += "\
			<img src=\"http://" + addr + "/plus/ba_lock" + imgSuffix + ".png\" alt=\"" + SECURE_SITE[arrIdx] + "\" title=\"" + SECURE_SITE[arrIdx] + "\" style=\"border: 0;\" />";
    } else {
        html += "\
			<img src=\"http://" + addr + "/plus/ba_play" + imgSuffix + ".png\" alt=\"" + TRY_NOW[arrIdx] + "\" title=\"" + TRY_NOW[arrIdx] + "\" style=\"border: 0;\" />";
    }

    html += "</a>\
		<a href=\"http://www.browsealoud.com/page.asp?pg_id=" + pgId + "\" target=\"_blank\" style=\"display:inline-block;width:24px;height:24px;vertical-align:middle;margin:0 0 0 6px;outline:0;\">\
			<img src=\"http://" + addr + "/plus/ba_more" + imgSuffix + ".png\" alt=\"" + MORE_INFO[arrIdx] + "\" title=\"" + MORE_INFO[arrIdx] + "\" style=\"border: 0;\" />\
		</a>\
	</div>";
}

html += "<div id=\"" + prefix + "_zoom\" style=\"display:none;position:absolute;border:2px solid #081c73;width:0px;height:0px;background-color:#ece9d8;border-top-left-radius:10px;\"></div>";

function handleDocLoad() {
    if (typeof (jQuery) != "undefined") {
        var $ = jQuery;
        $(document).ready(function () {
            var pos = $("#" + prefix + "_button").length > 0 ? $("#" + prefix + "_button a:first").position() : $("#" + prefix + "_link").position();

            try {

                $("#" + prefix + "_zoom").css({
                    "left": pos.left + "px",
                    "top": pos.top + "px"
                });
            } catch(error) {

            }
        });
    } else {
        setTimeout(handleDocLoad, 250);
    }
}
handleDocLoad();

function hideZoom() {
    if (typeof ($rw_isPageLoaded) != "undefined" && $rw_isPageLoaded()) {
        $("#" + prefix + "_zoom").fadeOut();
    } else {
        setTimeout(function () { $("#" + prefix + "_zoom").remove(); }, 1000);
    }
}

function zoomToolbar() {
    setTimeout(function () {
        if ($("#ba_message_box") && $("#ba_message_box").length == 0 && bd.browser != "IE") {
            $("#" + prefix + "_zoom").show().animate({
                width: "136px",
                left: (window.outerWidth - 163) + "px",
                height: "56px",
                top: (5 + $(document).scrollTop()) + "px"
            }, 750, function () {
                hideZoom();
            });
        }
    }, 500);
}

// document.write(html);

/*
Standard JavaScript function to get the value of a given cooke (by name)
This can be replaced or enhanced as needed, so long as it still returns the value of the cookie
*/
function getCookie(name) {
    var start = document.cookie.indexOf(name + "=");
    var len = start + name.length + 1;
    if (!start && name != document.cookie.substring(0, name.length)) {
        return null;
    }
    if (start == -1) {
        return null;
    }
    var end = document.cookie.indexOf(";", len);
    if (end == -1) {
        end = document.cookie.length;
    }
    return unescape(document.cookie.substring(len, end));
}

/*
Standard JavaScript function to set a new cookie with name and value (with a number of optional parameters)
This can be replaced or enhanced as needed, so long as it still set the value of the cookie
*/
function setCookie(name, value, expires, path, domain, secure) {
    var today = new Date();
    today.setTime(today.getTime());
    if (expires) {
        expires = expires * 1000 * 60 * 60 * 24; // Expects "expires" parameter as a number days. Converts into milliseconds (as required when setting cookie expiration)
    }
    var expires_date = new Date(today.getTime() + (expires));
    document.cookie = name + "=" + escape(value) +
                      (expires ? ";expires=" + expires_date.toGMTString() : "") +
                      (path ? ";path=" + path : "") +
                      (domain ? ";domain=" + domain : "") +
                      (secure ? ";secure" : "");
}

/*
Standard JavaScript function to delete a cookie by name (with optional path and domain parameters)
This can be replaced or enhanced as needed, so long as it still deletes the cookie
*/
function deleteCookie(name, path, domain) {
    if (getCookie(name)) {
        document.cookie = name + "=" +
           (path ? ";path=" + path : "") +
           (domain ? ";domain=" + domain : "") +
           ";expires=Thu, 01-Jan-1970 00:00:01 GMT";
    }
}

var isBarShown = false;

/*
Example function to toggle the visibility of the bar and the associated cookie
*/
function toggleBar() {
    if (document.getElementById("texthelpspeechstream")) {
        isBarShown = !isBarShown;
        $rw_setBarVisibility(isBarShown);
        $rw_enableClickToSpeak(isBarShown);
        setSpeakerImg(isBarShown);

        if (!isBarShown) {
            deleteCookie("ba_bar", "/", false);
        } else {
            setCookie("ba_bar", "on", false, "/", false, false);
        }
    } else {
        setCookie("ba_bar", "on", false, "/", false, false);
        loadBar();
    }
}

/*
This function toggles the image and alt text of an arbitrary button which turns BrowseAloud Plus on and off
*/
function setSpeakerImg(isOn) {
    try {
        $("#__ba_icon,.speaker img").attr("src", isOn ? "plus/ba_stop.png" : "plus/ba_play.png").attr("alt", isOn ? "Disable BrowseAloud Plus on this site" : "Listen with BrowseAloud").attr("title", $("#__ba_icon").attr("alt"));
    } catch (error) {

    }
}

/*
Returns the protocol of the current page (needed to ensure no security warnings when in HTTPS mode)
DO NOT MODIFY THE NAME OR CONTENT OF THIS FUNCTION - IT IS USED BY THE CODE WHICH LOADS BROWSEALOUD PLUS
*/
function getProtocol() { return window.location.href.indexOf('https') == 0 ? 'https' : 'http'; }

function loadBar() {

    /* BEGIN: DO NOT MODIFY (Include this code on whatever button/link/element you wish to trigger the loading of the bar */
    (function () {
        if (navigator.userAgent.indexOf('MSIE 8') != -1 && getProtocol() == 'https') {
            alert('You are viewing a secure website. We do not currently support BrowseAloud services on secure sites.');
        } else {
            // This assume locale is set somewhere in the script. Supported locales = uk, us, nl, no, se
            document.getElementsByTagName('body')[0].appendChild(document.createElement('script')).src = getProtocol() + '://babm.texthelp.com/Bookmarklet.ashx?l=' + locale;
        }
    })();
    /* END: DO NOT MODIFY */

    isBarShown = true;
    setSpeakerImg(true);
}

if (getCookie("ba_bar") == "on") {
    setTimeout(loadBar, 500); // Apply a timeout to let the underlying page settle before trying to manipulate it
}