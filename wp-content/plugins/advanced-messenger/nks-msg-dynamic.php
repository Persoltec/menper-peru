<?php
//browser()->log($options);
?>
<style id="nks_msg_dynamic_styles">
<?php if($options['nks_msg_label_tooltip'] == 'visible'): ?>
#nks_msg_tooltip {
	font-family: inherit;
	position: fixed;
	right: 78pt;
	bottom: 19pt;
	top: auto;
	font-size: 20px;
	line-height: 28px;
	color: #FFF;
	padding: 4px 14px;
	margin-left: -20px;
	white-space: nowrap;
	background-color: <?php echo $options['nks_msg_tooltip_color'] ?>;
	border-radius: 20px;
	-webkit-border-radius: 15px;
	-webkit-backface-visibility: hidden;
	-webkit-filter: drop-shadow(0px 3pt 12pt #00000026);
	filter: drop-shadow(0px 3pt 12pt rgba(0, 0, 0, 0.15));
	border: 10px solid #fff;
	overflow: visible;
	z-index: 99999999999;
    opacity: 0;
    visibility: hidden;
    -webkit-transition: all 0.25s cubic-bezier(0.645, 0.045, 0.355, 1);
    transition: all 0.25s cubic-bezier(0.645, 0.045, 0.355, 1);
	background: linear-gradient(to bottom, <?php echo $options['nks_msg_tooltip_grad'] ?> 0%, <?php echo $options['nks_msg_tooltip_color'] ?> 66%);
}

.nks_msg_hidden #nks_msg_tooltip{
    opacity: 1;
    visibility: visible;
}
#nks_msg_tooltip:before {
	right: -25pt;
	top: 50%;
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
}

#nks_msg_tooltip:before {
	border-color: rgba(255, 255, 255, 0);
	border-left-color: #ffffff;
	border-width: 13px;
	margin-top: -13px;
}
.nks_msg_hidden .nks-hover .fa-stack-1x.fa-inverse:before  {
	color: white !important;
}

.nks_cc_trigger_tabs.nks_metro .nks-msg-tab-icon:after {
	left: 0;
	top: 0;
	margin-left: 0px;
	border-radius: 0px;
	-moz-border-radius: 0px;
	-webkit-border-radius: 0px;
}

.nks_cc_trigger_tabs.nks_metro .nks-msg-tab-icon.fa-3x:after {
	padding: 21px;
	font-size: 24px;
}

.nks_cc_trigger_tabs.nks_metro .nks-msg-tab-icon.fa-2x:after {
	padding: 10px 21px;
}

.nks_cc_trigger_tabs.nks_metro .nks-msg-tab-icon.fa-2x:after {
	font-size: 18px;
}

.nks_msg_tooltip_hidden #nks_msg_tooltip,
.nks_msg_tooltip_hidden .fb_dialog,
.nks_msg_tooltip_hidden .fb-customerchat
{
    /*display: none !important;*/
    opacity: 0 !important;
    visibility: hidden !important;
}

.fb_dialog,
.fb-customerchat {
    -webkit-transition: all 0.25s cubic-bezier(0.645, 0.045, 0.355, 1);
    transition: all 0.25s cubic-bezier(0.645, 0.045, 0.355, 1);
}

<?php endif; ?>

<?php if($options['nks_msg_sidebar_pos'] == 'left'): ?>

.fb_dialog, .fb-customerchat:not(.fb_iframe_widget_fluid) iframe {
	right: auto !important;
	left: 18pt !important;
}

#nks_msg_tooltip {
	right: auto;
	left: 94pt;
}

#nks_msg_tooltip:before {
	left: -25pt;
	right: auto;
	border-right-color: #fff;
	border-left-color: rgba(255, 255, 255, 0);
}

<?php endif; ?>


</style>
<script>
	(function($){

		var timer;

		timer = setInterval(function(){
			if (document.body) {
				clearInterval(timer);
				afterBodyArrived();
			}
		},14);

		function afterBodyArrived () {
			triggerEvent();
		}

		function triggerEvent(){
			$(document).trigger('nks_msg_ready');
		}

	})(jQuery)

</script>