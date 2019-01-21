<?php
echo '<script>var nksOptions=' . json_encode($options). '</script>';

$local = $options['nks_msg_lang'];
$page = $options['nks_msg_page_id'];


if (!isset($page)) return;

$uicolor = $options['nks_msg_ui_color'];
$greetIn = $options['nks_msg_loggedin'];
$greetOut = $options['nks_msg_loggedout'];
$uiHsl = json_decode($options['nks_msg_ui_hsl']);
$buttonHsl = json_decode($options['nks_msg_label_hsl']);
$uiHue = $uiHsl->h;
$uiSaturation = $uiHsl->s;
$buttonHue = $buttonHsl->h;
$buttonSaturation = $buttonHsl->s;
if ($uiHue == 0 && $uiSaturation == 1) {
	$defUi = true;
	echo '<script>var nksUiDefault = true</script>';
}
if ($buttonHue == 0 && $buttonSaturation == 1) {
	$defButton = true;
}

?>

<script>

	window.fbMessengerPlugins = window.fbMessengerPlugins || {
			init: function () {
				FB.init({
					appId:'157033831606522',
					autoLogAppEvents : true,
					xfbml : true,
					version: 'v2.11'});
			},
			callable: []
		};

	window.fbAsyncInit = window.fbAsyncInit || function () {
			var parsing = function() {
				console.log("parsing plugins", arguments);
				jQuery(document).trigger('la.parse');
			}

			var resize = function() {
				console.log("resize plugin", arguments);
				jQuery(document).trigger('la.resize');
			}

			var ready = function() {
				console.log("ready", arguments);
				jQuery(document).trigger('la.ready');
			}

			var finished_rendering = function() {
				console.log("finished rendering plugins", arguments);
				jQuery(document).trigger('la.render');
			}

			var request_complete = function() {
				console.log("request_complete", arguments);
				jQuery(document).trigger('la.request_complete');
			}

			var auth_response_change_callback = function(response) {
				console.log("auth_response_change_callback");
				console.log(response);
				jQuery(document).trigger('la.authResponseChange');
			}

			var auth_status_change_callback = function(response) {
				console.log("auth_status_change_callback: " + response.status);
				jQuery(document).trigger('la.statusChange');
			}

			var login_event = function(response) {
				console.log("login_event");
			}

			var logout_event = function() {
				console.log("logout_event");
			}

			var livechatplugin_loaded = function() {
				console.log("livechatplugin_loaded")
				jQuery(document).trigger('la.livechatplugin_loaded');
			}

			var xd_resize = function() {
				console.log("xd_resize", arguments);
			}
			var xd_resize_flow = function() {
				console.log("xd.resize.flow", arguments);
			}
			var xd_resize_iframe = function() {
				console.log("xd_resize_iframe", arguments);
			}
			var xd_rsdk_event = function() {
				console.log("xd_rsdk_event", arguments);
			}

			var iframe_onload = function() {
				console.log("iframe_onload", arguments);
			}
			var test = function() {
				console.log("works!", arguments);
			}

			var events

			FB.Event.subscribe('xfbml.parse', parsing); // works
			FB.Event.subscribe('xfbml.render', finished_rendering); // works
			FB.Event.subscribe('xfbml.resize', resize); // works
			FB.Event.subscribe('xfbml.ready', ready);
			FB.Event.subscribe('request.complete', request_complete);
			FB.Event.subscribe('xd.resize', xd_resize);
			FB.Event.subscribe('xd.resize.flow', xd_resize_flow);
			FB.Event.subscribe('xd.resize.iframe', xd_resize_iframe);
			FB.Event.subscribe('xd.sdk_event', xd_rsdk_event);
			FB.Event.subscribe('iframe.onload', iframe_onload);
			FB.Event.subscribe('auth.authResponseChange', auth_response_change_callback);
			FB.Event.subscribe('auth.statusChange', auth_status_change_callback);
			FB.Event.subscribe('auth.login', login_event);
			FB.Event.subscribe('auth.logout', logout_event);

			FB.Event.subscribe('xd.liveChatPluginGetBubbleIframe', logout_event);
			FB.Event.subscribe('xd.liveChatPluginPrepareMobileAnchorIframe', logout_event);
			FB.Event.subscribe('xd.liveChatPluginResizeAnchorIframe', logout_event);
			FB.Event.subscribe('xd.liveChatPluginExpandDesktopDialogIframe', logout_event);
			FB.Event.subscribe('xd.liveChatPluginExpandMobileDialogIframe', logout_event);
			FB.Event.subscribe('xd.liveChatPluginShowDialogIframe', function () {
				console.log('open')
			});
			FB.Event.subscribe('xd.liveChatPluginHideDialogIframe', logout_event);
			FB.Event.subscribe('livechatplugin:loaded', livechatplugin_loaded); // works
			FB.Event.subscribe('xfbml.liveChatPluginPrepareDesktopAnchorIframe', test);

			window.fbMessengerPlugins.callable.forEach(function (item) { item(); });
			window.fbMessengerPlugins.init();
		};

	jQuery(document).on('test', function () {
		console.log('event')
	})
	//	debugger

	setTimeout(function () {
		(function (d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) { return; }
			js = d.createElement(s);
			js.id = id;
			js.src = "//connect.facebook.net/<?php echo $local; ?>/sdk/xfbml.customerchat.js";
			//			js.src = "https://dev2.looks-awesome.com/wp-content/plugins/NKS-messenger/js/chat.js?ver=4.8.4";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk')); }, 0);
</script>
<!--
<svg id="nks_msg_filter_svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

	<defs>
		<filter id="nks_msg_filter" width="130%" height="120%">

			<feColorMatrix in="SourceGraphic" type="hueRotate" values="<?php /*echo $uiHue; */?>" result="hueRotate"></feColorMatrix>
			<feColorMatrix in="hueRotate" type="saturate" values="<?php /*echo $uiSaturation; */?>" result="saturate"></feColorMatrix>

			<feImage id="feimage" xlink:href="<?php /*echo plugins_url('/img/', __FILE__);*/?>filter.svg" x="0" y="0" result="mask"></feImage>
			<feComposite in2="mask" in="saturate" operator="in" result="comp" />

			<feMerge result="merge">
				<feMergeNode in="SourceGraphic" />
				<feMergeNode in="comp" />
			</feMerge>

		</filter>
		<filter id="nks_msg_filter_collapsed" width="150%" height="250%">

			<feColorMatrix in="SourceGraphic" type="hueRotate" values="<?php /*echo $uiHue; */?>" result="hueRotate"></feColorMatrix>
			<feColorMatrix in="hueRotate" type="saturate" values="<?php /*echo $uiSaturation; */?>" result="saturate"></feColorMatrix>

			<feImage id="feimage2" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php /*echo plugins_url('/img/', __FILE__);*/?>filter_collapsed.svg" x="-110px" y="85px" result="mask"></feImage>			<feComposite in2="mask" in="saturate" operator="in" result="comp"></feComposite>

			<feMerge result="merge">
				<feMergeNode in="SourceGraphic"></feMergeNode>
				<feMergeNode in="comp"></feMergeNode>
			</feMerge>

		</filter>
	</defs>
</svg>-->
<!--
<style>
	<?php /*if(!isset($defUi)): */?>

	.nks_msg_filtered {
		-webkit-filter: url("#nks_msg_filter");
		filter: url("#nks_msg_filter");
		z-index: 1;
		transform: translate(0, 0);
	}

	.nks_msg_collapsed .nks_msg_filtered {
		-webkit-filter: url("#nks_msg_filter_collapsed");
		filter: url("#nks_msg_filter_collapsed");
		z-index: 1;
		transform: translate(0, 0);
	}

	#nks_msg_backdrop {
		position: fixed;
		bottom: 95px;
		right: 25px;
		width: 310px;
		height: 500px;
		z-index: 9999999999999;
		-webkit-backdrop-filter: hue-rotate(<?php /*echo $uiHue; */?>deg) saturate(<?php /*echo $uiSaturation * 100; */?>%);
		backdrop-filter: hue-rotate(<?php /*echo $uiHue; */?>deg) saturate(<?php /*echo $uiSaturation * 100; */?>%);
		pointer-events: none;
	}

	.nks_msg_collapsed #nks_msg_backdrop {
		height: 50px;
	}

	.nks_msg_hidden #nks_msg_backdrop {
		display: none;
	}

	.nks_msg_mobile.nks_msg_expanded #nks_msg_backdrop {
		height: 100%;
		width: calc(100% - 50px);
		bottom: 0;
		right: 0;
	}

	<?php /*endif; */?>
	<?php /*if(!isset($defButton)): */?>
	.fb_dialog iframe {
		-webkit-filter: hue-rotate(<?php /*echo $buttonHue; */?>deg) saturate(<?php /*echo $buttonSaturation * 100; */?>%);
		filter: hue-rotate(<?php /*echo $buttonHue; */?>deg) saturate(<?php /*echo $buttonSaturation * 100; */?>%);
	}
	<?php /*endif; */?>

	#nks_msg_filter_svg {
		display: none;
	}
</style>-->

<div class="fb-customerchat"<?php
    echo ( $uicolor != '#0084FF' ? ' theme_color="' . $uicolor . '"' : '' );
    echo ( !empty($greetIn) ? ' logged_in_greeting="' . $greetIn . '"' : '' );
    echo ( !empty($greetOut) ? ' logged_out_greeting="' . $greetOut . '"' : '' );
?>" page_id="<?php echo $page . '"' . ( $options['nks_msg_label_tooltip'] == 'visible' ? ' minimized=true' : '') ?> ref=""> </div>