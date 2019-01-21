<?php

//add_action( 'admin_init', 'nks_msg_register_settings' );

function nks_msg_register_settings() {

	$options = nks_msg_get_options();
	//register_setting( 'nks_msg_options', 'nks_msg_options', 'nks_msg_options_validate' );

	add_settings_section('nks_msg_main', 'Basic', 'nks_msg_colors_text', 'nks_msg');
	add_settings_field('nks_msg_page_id', "ID of your Facebook page ", 'nks_msg_app_id_str', 'nks_msg', 'nks_msg_main');
	add_settings_field('nks_msg_lang', "Messenger UI language", 'nks_msg_lang_str', 'nks_msg', 'nks_msg_main');
	add_settings_field('nks_msg_display', "How to show Messenger", 'nks_msg_display_str', 'nks_msg', 'nks_msg_main');

	add_settings_section('nks_msg_advanced', 'Advanced', 'nks_msg_colors_text', 'nks_msg');
//	add_settings_field('nks_msg_advanced', "Form Theme", 'nks_msg_layout_theme_str', 'nks_msg', 'nks_msg_advanced');
//	add_settings_field('nks_msg_base_color', "Sidebar Base Color", 'nks_msg_base_color_str', 'nks_msg', 'nks_msg_advanced');
//	add_settings_field('nks_msg_image_bg', 'Choose Background Image', 'nks_msg_image_bg_str', 'nks_msg', 'nks_msg_advanced');
//	add_settings_field('nks_msg_custom_bg', 'Your custom background', 'nks_msg_custom_bg_str', 'nks_msg', 'nks_msg_advanced');
//	add_settings_field('nks_msg_userpic_style', "Profile picture style:", 'nks_msg_userpic_style_str', 'nks_msg', 'nks_msg_advanced');
//	add_settings_field('nks_msg_invert_style', "Button style:", 'nks_msg_invert_style_str', 'nks_msg', 'nks_msg_advanced');
//	add_settings_field('nks_msg_show_social', "Show social bar:", 'nks_msg_show_social_str', 'nks_msg', 'nks_msg_advanced');
//	add_settings_field('nks_msg_flat_socialbar', 'Social bar position:', 'nks_msg_flat_socialbar_str', 'nks_msg', 'nks_msg_advanced');
//	add_settings_field('nks_msg_color_schema', "Schema", 'nks_msg_color_schema_str', 'nks_msg', 'nks_msg_advanced', array('hidden' => true));
//	add_settings_field('nks_msg_rgba', "Rgba", 'nks_msg_rgba_str', 'nks_msg', 'nks_msg_advanced', array('hidden' => true));
	add_settings_field('nks_msg_test_mode', "Test mode during setup", 'nks_msg_test_mode_str', 'nks_msg', 'nks_msg_advanced');

	add_settings_field('nks_msg_sidebar_pos', "Messenger position", 'nks_msg_sidebar_pos_str', 'nks_msg', 'nks_msg_advanced');
	add_settings_field('nks_msg_ui_color', "Messenger UI color", 'nks_msg_ui_color_str', 'nks_msg', 'nks_msg_advanced');
	add_settings_field('nks_msg_loggedin', "Greeting for users logged in FB", 'nks_msg_loggedin_str', 'nks_msg', 'nks_msg_advanced');
	add_settings_field('nks_msg_loggedout', "Greeting for users logged out from FB", 'nks_msg_loggedout_str', 'nks_msg', 'nks_msg_advanced');
	add_settings_field('nks_msg_ui_hsl', "Messenger UI color", 'nks_msg_ui_hsl_str', 'nks_msg', 'nks_msg_advanced', array('hidden' => true));
//	add_settings_field('nks_msg_label_color', "Button color", 'nks_msg_label_color_str', 'nks_msg', 'nks_msg_advanced');
	add_settings_field('nks_msg_label_hsl', "", 'nks_msg_label_hsl_str', 'nks_msg', 'nks_msg_advanced', array('hidden' => true));
	add_settings_field('nks_msg_tooltip_grad', "", 'nks_msg_tooltip_grad_str', 'nks_msg', 'nks_msg_advanced', array('hidden' => true));
	add_settings_field('nks_msg_label_tooltip', "Button tooltip", 'nks_msg_label_tooltip_str', 'nks_msg', 'nks_msg_advanced');
	add_settings_field('nks_msg_label_tooltip_text', "Button tooltip text", 'nks_msg_label_tooltip_text_str', 'nks_msg', 'nks_msg_advanced');
	add_settings_field('nks_msg_tooltip_color', "Button tooltip color", 'nks_msg_tooltip_color_str', 'nks_msg', 'nks_msg_advanced');
	add_settings_field('nks_msg_label_vis', "Button visibility", 'nks_msg_label_vis_str', 'nks_msg', 'nks_msg_advanced');

//	add_settings_field('nks_msg_fade_content', "Fade out main content", 'nks_msg_fade_content_str', 'nks_msg', 'nks_msg_advanced');
//	add_settings_field('nks_msg_togglers', "Additional element to toggle Messenger", 'nks_msg_togglers_str', 'nks_msg', 'nks_msg_advanced');
//	add_settings_field('nks_msg_scroll', "Scroll behavior", 'nks_msg_scroll_str', 'nks_msg', 'nks_msg_advanced');
}

function nks_msg_colors_text() {
}

function nks_msg_display_str() {
	$options = nks_msg_get_options();
	$user_opts = json_decode($options['nks_msg_display']);
	$locations = $options['locations'];
	//browser()->log('tab ' .$index . ' opts');
	//browser()->log($user_opts);

	?>

		<input id='nks_msg_display' name='nks_msg_options[nks_msg_display]' type='hidden' value='<?php echo $options['nks_msg_display']?>' />
	<div class='loc_popup'>
		<p>
			<label for="nks_msg_user_status"><?php _e('Show Messenger for:', 'nks-messenger') ?></label>
			<select name="display_user_status" id="nks_msg_user_status" class="widefat">
				<option value="everyone" <?php echo selected( $user_opts->user->everyone, '1' ) ?>><?php _e('Everyone', 'nks-messenger') ?></option>
				<option value="loggedout" <?php echo selected( $user_opts->user->loggedout, '1' ) ?>><?php _e('Logged-out users', 'nks-messenger') ?></option>
				<option value="loggedin" <?php echo selected( $user_opts->user->loggedin, '1' ) ?>><?php _e('Logged-in users', 'nks-messenger') ?></option>
			</select>
		</p>

		<p>
			<label for="nks_msg_display_mobile"><?php _e('Show on mobiles:', 'nks-messenger') ?></label>
			<select name="display_mobile" id="nks_msg_display_mobile" class="widefat">
				<option value="yes" <?php echo selected( $user_opts->mobile->yes, '1' ) ?>><?php _e('Show', 'nks-messenger') ?></option>
				<option value="no" <?php echo selected( $user_opts->mobile->no, '1' ) ?>><?php _e('Don\'t show', 'nks-messenger') ?></option>
			</select>
		</p>

		<p>
			<label for="nks_msg_user_status"><?php _e('Display rule:', 'nks-messenger') ?></label>

			<select name="display_rule" id="display_rule" class="widefat">
				<option value="exclude" <?php echo selected( $user_opts->rule->exclude, '1' ) ?>><?php _e('Hide on checked pages', 'nks-messenger') ?></option>
				<option value="include" <?php echo selected( $user_opts->rule->include, '1' ) ?>><?php _e('Show on checked pages', 'nks-messenger') ?></option>
			</select>
		</p>

		<div style="height:188px; overflow:auto; border:1px solid #dfdfdf; padding:10px; margin-bottom:5px;">
			<h4 class="dw_toggle" style="cursor:pointer;margin-top:0;"><?php _e('Default WP pages (scroll down ↓)', 'nks-messenger') ?></h4>
			<div class="dw_collapse">
				<?php foreach ($locations->wp_pages as $key => $label){
					?>
					<p><input class="checkbox" type="checkbox" value="<?php echo $key?>" <?php checked(isset($user_opts->location->wp_pages->$key) ? $user_opts->location->wp_pages->$key : false, true) ?> id="display_wp_page_<?php echo $key?>" name="display_wp_page_<?php echo $key?>" />
						<label for="display_wp_page_<?php echo $key?>"><?php echo $label .' '. __('Page', 'nks-messenger') ?></label></p>
				<?php
				}
				?>
			</div>

			<h4 class="dw_toggle" style="cursor:pointer;"><?php _e('Pages') ?></h4>
			<div class="dw_collapse">
				<?php foreach ( $locations->pages as $page ) {
					//$instance['page-'. $page->ID] = isset($instance['page-'. $page->ID]) ? $instance['page-'. $page->ID] : false;
					$id = $page->ID;
					$p_title = apply_filters('the_title', $page->post_title, $page->ID);
					if ( $page->post_parent ) {
						$parent = get_post($page->post_parent);

						$p_title .= ' ('. apply_filters('the_title', $parent->post_title, $parent->ID);

						if ( $parent->post_parent ) {
							$grandparent = get_post($parent->post_parent);
							$p_title .= ' - '. apply_filters('the_title', $grandparent->post_title, $grandparent->ID);
							unset($grandparent);
						}
						$p_title .= ')';

						unset($parent);
					}
					//browser()->log($p_title);

					?>
					<p><input class="checkbox" type="checkbox" value="<?php echo $id?>" <?php checked(isset($user_opts->location->pages->$id), true) ?> id="display_page_<?php echo $id ?>" name="display_page_<?php echo $id ?>" />
						<label for="display_page_<?php echo $id?>"><?php echo $p_title ?></label></p>
					<?php   unset($p_title);
				}  ?>
			</div>

			<?php if ( !empty($locations->cposts) ) { ?>
				<h4 class="dw_toggle" style="cursor:pointer;"><?php _e('Custom Post Types', 'nks-messenger') ?> +/-</h4>
				<div class="dw_collapse">
					<?php foreach ( $locations->cposts as $post_key => $custom_post ) {
						?>
						<p><input class="checkbox" type="checkbox" value="<?php echo $post_key?>" <?php checked(isset($user_opts->location->cposts->$post_key), true) ?> id="display_cpost_<?php echo $post_key?>" name="display_cpost_<?php echo $post_key?>" />
							<label for="display_cpost_<?php echo $post_key?>"><?php echo stripslashes($custom_post->labels->name) ?></label></p>
						<?php
						unset($post_key);
						unset($custom_post);
					} ?>
				</div>

				<!--<h4 class="dw_toggle" style="cursor:pointer;"><?php /*_e('Custom Post Type Archives', 'nks-messenger') */?> +/-</h4>
				<div class="dw_collapse">
					<?php /*foreach ( $this->cposts as $post_key => $custom_post ) {
						if ( !$custom_post->has_archive ) {
							// don't give the option if there is no archive page
							continue;
						}
						$instance['type-'. $post_key .'-archive'] = isset($instance['type-'. $post_key .'-archive']) ? $instance['type-'. $post_key .'-archive'] : false;
						*/?>
						<p><input class="checkbox" type="checkbox" <?php /*checked($instance['type-'. $post_key.'-archive'], true) */?> id="<?php /*echo $widget->get_field_id('type-'. $post_key .'-archive'); */?>" name="<?php /*echo $widget->get_field_name('type-'. $post_key .'-archive'); */?>" />
							<label for="<?php /*echo $widget->get_field_id('type-'. $post_key .'-archive'); */?>"><?php /*echo stripslashes($custom_post->labels->name) */?> <?php /*_e('Archive', 'nks-messenger') */?></label></p>
					<?php /*} */?>
				</div>-->
			<?php } ?>

			<h4 class="dw_toggle" style="cursor:pointer;"><?php _e('Categories') ?></h4>
			<div class="dw_collapse">
				<?php foreach ( $locations->cats as $cat ) {
					$catid = $cat->cat_ID;
					?>
					<p><input class="checkbox" type="checkbox"  value="<?php echo $catid?>" <?php checked(isset($user_opts->location->cats->$catid), true) ?> id="display_cat_<?php echo $catid?>" name="display_cat_<?php echo $catid?>" />
						<label for="display_cat_<?php echo $catid?>"><?php echo $cat->cat_name ?></label></p>
					<?php
					unset($cat);
				}
				?>
			</div>

			<?php /*if ( !empty($this->taxes) ) { */?><!--
				<h4 class="dw_toggle" style="cursor:pointer;"><?php /*_e('Taxonomies', 'nks-messenger') */?> +/-</h4>
				<div class="dw_collapse">
					<?php /*foreach ( $this->taxes as $tax ) {
						$instance['tax-'. $tax] = isset($instance['tax-'. $tax]) ? $instance['tax-'. $tax] : false;
						*/?>
						<p><input class="checkbox" type="checkbox" <?php /*checked($instance['tax-'. $tax], true) */?> id="<?php /*echo $widget->get_field_id('tax-'. $tax); */?>" name="<?php /*echo $widget->get_field_name('tax-'. $tax); */?>" />
							<label for="<?php /*echo $widget->get_field_id('tax-'. $tax); */?>"><?php /*echo str_replace(array('_','-'), ' ', ucfirst($tax)) */?></label></p>
						<?php
			/*						unset($tax);
								}
								*/?>
				</div>
			--><?php /*} */?>

			<?php if ( !empty($locations->langs) ) { ?>
				<h4 class="dw_toggle" style="cursor:pointer;"><?php _e('Languages', 'nks-messenger') ?></h4>
				<div class="dw_collapse">
					<?php foreach ( $locations->langs as $lang ) {
						$key = $lang['language_code'];
						?>
						<p><input class="checkbox" type="checkbox" value="<?php echo $key?>" <?php checked(isset($user_opts->location->langs->$key), true) ?> id="display_lang_<?php echo $key?>" name="display_lang_<?php echo $key?>" />
							<label for="display_lang_<?php echo $key?>"><?php echo $lang['native_name'] ?></label></p>

						<?php
						unset($lang);
						unset($key);
					}
					?>
				</div>
			<?php } ?>

			<p><label for="display_ids"><?php _e('Comma Separated list of IDs of posts not listed above', 'nks-messenger') ?>:</label>
				<input type="text" value="<?php echo implode(",", $user_opts->location->ids); ?>" name="display_ids" id="display_ids" />
			</p>
		</div>
	</div>
	<span class="field-title">Last Step</span>
	<p class="tip">Only one thing left to successfully add Messenger on your site: you need to whitelist your site URL in settings of Facebook page. <a href="https://www.dropbox.com/s/10no2v4dnd5bzkt/Screenshot%202018-01-08%2009.59.19.png?dl=0" target="_blank">How to whitelist your site</a>.</p>
<?php
}

function nks_msg_callback_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	$val = htmlentities($options['nks_msg_callback_'.$index], ENT_QUOTES);
	echo "<h6>Code to execute after user successfully submits form, eg. GA tracking (syntax errors here can break plugin).</h6><textarea cols='100' rows='10' id='nks_msg_callback_{$index}' placeholder='Valid JS code' name='nks_msg_options[nks_msg_callback_{$index}]'>".$val."</textarea>";
}

function nks_msg_forms_str() {
	$options = nks_msg_get_options();
	echo " <input id='nks_msg_forms' name='nks_msg_options[nks_msg_forms]' size='40' type='hidden' value='{$options['nks_msg_forms']}' style='' />";
}
function nks_msg_form_status_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	echo " <input id='nks_msg_form_status_{$index}' name='nks_msg_options[nks_msg_form_status_{$index}]' size='40' type='hidden' value='{$options['nks_msg_form_status_'.$index]}' style='' />";
}

function nks_msg_email_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	echo "<h6>Separate by comma if multiple.</h6><input id='nks_msg_email_{$index}' name='nks_msg_options[nks_msg_email_{$index}]' size='40' type='text' value='{$options['nks_msg_email_'.$index]}' style='' />";
}

function nks_msg_mc_token_str() {
	$options = nks_msg_get_options();
	echo "<h6>You can add here your VALID MailChimp token and subscription checkbox will be added to form.</h6><input id='nks_msg_mc_token' name='nks_msg_options[nks_msg_mc_token]' size='40' type='text' value='{$options['nks_msg_mc_token']}' style='' />";
}

function nks_msg_sub_question_str() {
	$options = nks_msg_get_options();
    $val = htmlentities($options['nks_msg_sub_question'], ENT_QUOTES);
    echo "<h6>Question that is near subscription checkbox.</h6><input id='nks_msg_sub_question' name='nks_msg_options[nks_msg_sub_question]' size='40' type='text' value='{$val}' style='' />";
}

function nks_msg_mc_lists_str() {
	$options = nks_msg_get_options();
	
	if (empty($options['nks_msg_mc_token'])) {
		 echo '<p>Add MailChimp token first to see available lists</p><input type="hidden" name="nks_msg_options[nks_msg_mc_lists]" value="">';
	} else {
		if (empty($options['nks_msg_mc_lists'])) {
			$lists = nks_msg_get_MC_lists($options['nks_msg_mc_token']);
			$options['nks_msg_mc_lists'] = json_encode($lists);
		} else {
			$lists = json_decode($options['nks_msg_mc_lists']);
		}

		echo "<input type='hidden' name='nks_msg_options[nks_msg_mc_lists]' value='{$options['nks_msg_mc_lists']}'>";

		echo '<h6>Choose list to send opt-in in case of subscription.</h6>';
		echo '<select name="nks_msg_options[nks_msg_mc_list_id]">';
		for ($i = 0, $len = sizeof($lists); $i < $len; $i++) {
			echo '<option value="' . $lists[$i][0] . '" '. ($options['nks_msg_mc_list_id'] == $lists[$i][0] ? 'selected=selected' : '') .'>' . $lists[$i][1] . '</option>';
		}
		echo '</select>';

	}
}

function nks_msg_form7_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	echo "<h6>Will replace default form. Any simple form should work here. Eg. you can use shortcode from Contact Form 7, Gravity Forms.</h6><input id='nks_msg_form7_{$index}' name='nks_msg_options[nks_msg_form7_{$index}]' size='40' type='text' value='{$options['nks_msg_form7_'.$index]}' style='' />";
}

function nks_msg_additional_fields_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	$fields = json_decode($options['nks_msg_additional_fields_'.$index], true);

	//dirty migration
	if (isset($fields['address']) && !isset($fields['address']['on'])) {
		$options['nks_msg_additional_fields_'.$index] = '{"company" : {"on":false,"required":false}, "phone" : {"on":false,"required":false}, "address" : {"on":false,"required":false}, "subject" : {"on":false,"required":false}}';
		$fields = json_decode($options['nks_msg_additional_fields_'.$index], true);
	}

	$first_checked = isset($fields['company']) && !empty($fields['company']['on']) ? 'checked="checked"' : '';
	$sec_checked = isset($fields['phone']) && !empty($fields['phone']['on']) ? 'checked="checked"' : '';
	$third_checked = isset($fields['address']) && !empty($fields['address']['on']) ? 'checked="checked"' : '';
	$forth_checked = isset($fields['subject']) && !empty($fields['subject']['on']) ? 'checked="checked"' : '';

	$req1 = isset($fields['company']) && !empty($fields['company']['required']) ? 'checked="checked"' : '';
	$req2 = isset($fields['phone']) && !empty($fields['phone']['required']) ? 'checked="checked"' : '';
	$req3 = isset($fields['address']) && !empty($fields['address']['required']) ? 'checked="checked"' : '';
	$req4 = isset($fields['subject']) && !empty($fields['subject']['required']) ? 'checked="checked"' : '';

	echo "<h6>Besides Name, Email and Message.</h6>
			<p data-id='company'><input id='nks_msg_additional_company_{$index}' data-type='on' name='nks_msg_options[nks_msg_additional_company_{$index}]' type='checkbox' value='yes' {$first_checked} style='' /> <label for='nks_msg_additional_company_{$index}'>Company</label> <input data-type='required' id='nks_msg_required_company_{$index}' name='nks_msg_options[nks_msg_required_company_{$index}]' type='checkbox' value='yes' {$req1} style='' /> <label for='nks_msg_required_company_{$index}'>Required field?</label> </p>
			<p data-id='phone'><input id='nks_msg_additional_phone_{$index}' data-type='on' name='nks_msg_options[nks_msg_additional_phone_{$index}]' type='checkbox' value='yes' {$sec_checked} style='' /> <label for='nks_msg_additional_phone_{$index}'>Phone</label> <input data-type='required' id='nks_msg_required_phone_{$index}' name='nks_msg_options[nks_msg_required_phone_{$index}]' type='checkbox' value='yes' {$req2} style='' /> <label for='nks_msg_required_phone_{$index}'>Required field?</label></p>
			<p data-id='address'><input id='nks_msg_additional_address_{$index}' data-type='on' name='nks_msg_options[nks_msg_additional_address_{$index}]' type='checkbox' value='yes' {$third_checked} style='' /> <label for='nks_msg_additional_address_{$index}'>Address</label> <input data-type='required' id='nks_msg_required_address_{$index}' name='nks_msg_options[nks_msg_required_address_{$index}]' type='checkbox' value='yes' {$req3} style='' /> <label for='nks_msg_required_address_{$index}'>Required field?</label></p>
			<p data-id='subject'><input id='nks_msg_additional_subject_{$index}' data-type='on' name='nks_msg_options[nks_msg_additional_subject_{$index}]' type='checkbox' value='yes' {$forth_checked} style='' /> <label for='nks_msg_additional_subject_{$index}'>Subject</label> <input data-type='required' id='nks_msg_required_subject_{$index}' name='nks_msg_options[nks_msg_required_subject_{$index}]' type='checkbox' value='yes' {$req4} style='' /> <label for='nks_msg_required_subject_{$index}'>Required field?</label></p>
			<input type='hidden' id='nks_msg_additional_fields_{$index}' name='nks_msg_options[nks_msg_additional_fields_{$index}]' value='{$options['nks_msg_additional_fields_'.$index]}'>
	<script>
	jQuery('.settings-form-row.nks_msg_additional_fields_{$index} input').change(function() {
		var t = jQuery(this);
		var inp = jQuery('#nks_msg_additional_fields_{$index}');
		var storage = JSON.parse(inp.val());

		var id = t.parent().attr('data-id');
		var type = t.attr('data-type');

		if (this.checked) {
			storage[id][type] = true;
		} else {
			storage[id][type] = false;
		}

		inp.val(JSON.stringify(storage))

	});
	</script>
	";
}


function nks_msg_test_mode_str() {
	$options = nks_msg_get_options();
	$style = $options['nks_msg_test_mode'];
	$first_checked = $style == 'yes' ? 'checked="checked"' : '';

	echo "
	<p><h6>Will be visible only for logged-in admins.</h6><input id='nks_msg_test_mode' name='nks_msg_options[nks_msg_test_mode]' class='switcher' type='checkbox' value='yes' {$first_checked} style='' /> <label for='nks_msg_test_mode'></label></p>
	";
}
function nks_msg_body_str() {
	$options = nks_msg_get_options();
	$style = $options['nks_msg_body'];
	$first_checked = $style == 'yes' ? 'checked="checked"' : '';

	echo "
	<p><h6>Can help if you experience layout issues with activated plugin.</h6><input id='nks_msg_body' name='nks_msg_options[nks_msg_body]' class='switcher' type='checkbox' value='yes' {$first_checked} style='' /> <label for='nks_msg_body'></label></p>
	";
}

function nks_msg_email_title_str ($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
  echo '<h6>if Subject field is not used.</h6>' . get_bloginfo('name') . " <input id='nks_msg_email_title_{$index}' name='nks_msg_options[nks_msg_email_title_{$index}]' size='100' type='text' value='{$options['nks_msg_email_title_'.$index]}' style='' />";
}


function nks_msg_is_default_str($args) {
	$options = nks_msg_get_options();
	$locations = $options['locations'];
	$index = $args["index"];
	$user_opts = json_decode($options['nks_msg_is_default_' . $index]);

	//browser()->log('tab ' .$index . ' opts');
	//browser()->log($user_opts);

	?>
	<h6>Will show up when button is clicked.</h6>
	<p>
		<input id='nks_msg_is_default_<?php echo $index?>' name='nks_msg_options[nks_msg_is_default_<?php echo $index?>]' type='hidden' value='<?php echo $options['nks_msg_is_default_'.$index]?>' />
	<div class='loc_popup'>

		<div style="height:150px; overflow:auto; border:1px solid #dfdfdf; padding:5px; margin-bottom:5px;">
			<h4 class="dw_toggle" style="cursor:pointer;margin-top:0;"><?php _e('Default WP pages', 'nks-messenger') ?></h4>
			<div class="dw_collapse">
				<?php foreach ($locations->wp_pages as $key => $label){
					?>
					<p><input class="checkbox" type="checkbox" value="<?php echo $key?>" <?php checked(isset($user_opts->location->wp_pages->$key) ? $user_opts->location->wp_pages->$key : false, true) ?> id="display_wp_page_<?php echo $key . '_' . $index?>" name="display_wp_page_<?php echo $key . '_' . $index?>" />
						<label for="display_wp_page_<?php echo $key . '_' . $index?>"><?php echo $label .' '. __('Page', 'nks-messenger') ?></label></p>
				<?php
				}
				?>
			</div>

			<h4 class="dw_toggle" style="cursor:pointer;"><?php _e('Pages') ?></h4>
			<div class="dw_collapse">
				<?php foreach ( $locations->pages as $page ) {
					//$instance['page-'. $page->ID] = isset($instance['page-'. $page->ID]) ? $instance['page-'. $page->ID] : false;
					$id = $page->ID;
					$p_title = apply_filters('the_title', $page->post_title, $page->ID);
					if ( $page->post_parent ) {
						$parent = get_post($page->post_parent);

						$p_title .= ' ('. apply_filters('the_title', $parent->post_title, $parent->ID);


						if ( $parent->post_parent ) {
							$grandparent = get_post($parent->post_parent);
							$p_title .= ' - '. apply_filters('the_title', $grandparent->post_title, $grandparent->ID);
							unset($grandparent);
						}
						$p_title .= ')';

						unset($parent);
					}
					//browser()->log($p_title);

					?>
					<p><input class="checkbox" type="checkbox" value="<?php echo $id?>" <?php checked(isset($user_opts->location->pages->$id), true) ?> id="display_page_<?php echo $id . '_' . $index?>" name="display_page_<?php echo $id . '_' . $index?>" />
						<label for="display_page_<?php echo $id . '_' . $index?>"><?php echo $p_title ?></label></p>
					<?php   unset($p_title);
				}  ?>
			</div>

			<?php if ( !empty($locations->cposts) ) { ?>
				<h4 class="dw_toggle" style="cursor:pointer;"><?php _e('Custom Post Types', 'nks-messenger') ?> +/-</h4>
				<div class="dw_collapse">
					<?php foreach ( $locations->cposts as $post_key => $custom_post ) {
						?>
						<p><input class="checkbox" type="checkbox" value="<?php echo $post_key?>" <?php checked(isset($user_opts->location->cposts->$post_key), true) ?> id="display_cpost_<?php echo $post_key . '_' . $index?>" name="display_cpost_<?php echo $post_key . '_' . $index?>" />
							<label for="display_cpost_<?php echo $post_key . '_' . $index?>"><?php echo stripslashes($custom_post->labels->name) ?></label></p>
						<?php
						unset($post_key);
						unset($custom_post);
					} ?>
				</div>

				<!--<h4 class="dw_toggle" style="cursor:pointer;"><?php /*_e('Custom Post Type Archives', 'nks-messenger') */?> +/-</h4>
				<div class="dw_collapse">
					<?php /*foreach ( $this->cposts as $post_key => $custom_post ) {
						if ( !$custom_post->has_archive ) {
							// don't give the option if there is no archive page
							continue;
						}
						$instance['type-'. $post_key .'-archive'] = isset($instance['type-'. $post_key .'-archive']) ? $instance['type-'. $post_key .'-archive'] : false;
						*/?>
						<p><input class="checkbox" type="checkbox" <?php /*checked($instance['type-'. $post_key.'-archive'], true) */?> id="<?php /*echo $widget->get_field_id('type-'. $post_key .'-archive'); */?>" name="<?php /*echo $widget->get_field_name('type-'. $post_key .'-archive'); */?>" />
							<label for="<?php /*echo $widget->get_field_id('type-'. $post_key .'-archive'); */?>"><?php /*echo stripslashes($custom_post->labels->name) */?> <?php /*_e('Archive', 'nks-messenger') */?></label></p>
					<?php /*} */?>
				</div>-->
			<?php } ?>

			<h4 class="dw_toggle" style="cursor:pointer;"><?php _e('Categories') ?></h4>
			<div class="dw_collapse">
				<?php foreach ( $locations->cats as $cat ) {
					$catid = $cat->cat_ID;
					?>
					<p><input class="checkbox" type="checkbox"  value="<?php echo $catid?>" <?php checked(isset($user_opts->location->cats->$catid), true) ?> id="display_cat_<?php echo $catid . '_' . $index?>" name="display_cat_<?php echo $catid . '_' . $index?>" />
						<label for="display_cat_<?php echo $catid . '_' . $index?>"><?php echo $cat->cat_name ?></label></p>
					<?php
					unset($cat);
				}
				?>
			</div>

			<?php /*if ( !empty($this->taxes) ) { */?><!--
				<h4 class="dw_toggle" style="cursor:pointer;"><?php /*_e('Taxonomies', 'nks-messenger') */?> +/-</h4>
				<div class="dw_collapse">
					<?php /*foreach ( $this->taxes as $tax ) {
						$instance['tax-'. $tax] = isset($instance['tax-'. $tax]) ? $instance['tax-'. $tax] : false;
						*/?>
						<p><input class="checkbox" type="checkbox" <?php /*checked($instance['tax-'. $tax], true) */?> id="<?php /*echo $widget->get_field_id('tax-'. $tax); */?>" name="<?php /*echo $widget->get_field_name('tax-'. $tax); */?>" />
							<label for="<?php /*echo $widget->get_field_id('tax-'. $tax); */?>"><?php /*echo str_replace(array('_','-'), ' ', ucfirst($tax)) */?></label></p>
						<?php
			/*						unset($tax);
								}
								*/?>
				</div>
			--><?php /*} */?>

			<?php if ( !empty($locations->langs) ) { ?>
				<h4 class="dw_toggle" style="cursor:pointer;"><?php _e('Languages', 'nks-messenger') ?></h4>
				<div class="dw_collapse">
					<?php foreach ( $locations->langs as $lang ) {
						$key = $lang['language_code'];
						?>
						<p><input class="checkbox" type="checkbox" <?php checked(isset($user_opts->location->langs->$key), true) ?> id="display_lang_<?php echo $key . '_' . $index?>" value="<?php echo $key?>" name="display_lang_<?php echo $index?>" />
							<label for="display_lang_<?php echo $key . '_' . $index?>"><?php echo $lang['native_name'] ?></label></p>

						<?php
						unset($lang);
						unset($key);
					}
					?>
				</div>
			<?php } ?>

			<p><label for="display_ids"><?php _e('Comma Separated list of IDs of posts not listed above', 'nks-messenger') ?>:</label>
				<input type="text" value="<?php echo implode(",", $user_opts->location->ids); ?>" name="display_ids" id="display_ids" />
			</p>
		</div>

		<button name='Submit' type='submit' id='sbmt_nks_msg_popup' class='display-sbmt button-primary' value='Save'>Save Display Options</i></button>

	</div>
	</p>
<?php
}

function nks_msg_base_color_str() {
	$options = nks_msg_get_options();
    $basecolor = json_decode($options['nks_msg_base_color']);
    $theme = $options['nks_msg_theme'];
		$currentBase = $basecolor -> $theme;
    $previewpic = empty($options['nks_msg_userpic']) ? plugins_url('/img/wolf.jpg', __FILE__) : $options['nks_msg_userpic'];
    $previewname = empty($options['nks_msg_user_firstname']) ? 'John' : $options['nks_msg_user_firstname'];
    $previewname2 = empty($options['nks_msg_user_firstname']) ? '' : $options['nks_msg_user_firstname'];
    $previewlastname = empty($options['nks_msg_user_lastname']) ? 'Appleseed' : $options['nks_msg_user_lastname'];
    $previewtitle = empty($options['nks_msg_user_title']) ? 'Blog Awesome Author' : $options['nks_msg_user_title'];
    $previewbio = empty($options['nks_msg_user_bio']) ? 'Hello lovely visitor! Send me a message and you will have my answer.' : $options['nks_msg_user_bio'];
    $position = $options['nks_msg_flat_socialbar'];
		$url = plugins_url('/img', __FILE__);
		$bgimage = $options['nks_msg_image_bg'];
		$userpic = $options['nks_msg_userpic_style'];

		if ($bgimage !== 'none') {
			if($bgimage === 'custom') {
				$bgstyle = 'background-image: url(' . $options['nks_msg_custom_bg'] . ')';
			} else {
				$bgstyle = 'background-image: url(' . plugins_url('/img/bg/' . $options['nks_msg_image_bg']. '.jpg', __FILE__) . ')';
			}
		} else {
			$bgstyle = '';
		}

		echo "<div class='colorswrap'><p>Choose theme base color...</p><span class='colorsliders cs_flat' data-theme='flat'></span><span class='colorsliders cs_minimalistic' data-theme='minimalistic'></span><span class='colorsliders cs_aerial' data-theme='aerial'></span><p>...or enter color in HEX format here:</p></div>";
    echo "<input id='nks_msg_base_color' name='nks_msg_options[nks_msg_base_color]' type='hidden' value='{$options['nks_msg_base_color']}' style='' />";
    echo "<input id='base_color_flat' name='base_color_flat' data-color-format='hex' size='40' type='text' value='{$basecolor -> flat}' style='display: none;' />";
    echo "<input id='base_color_minimalistic' name='base_color_minimalistic' data-color-format='hex' size='40' type='text' value='{$basecolor -> minimalistic}' style='display: none;' />";
    echo "<input id='base_color_aerial' name='base_color_aerial' data-color-format='hex' size='40' type='text' value='{$basecolor -> aerial}' style='display: none;' />
	<div id='nks_msg_theme_preview' class='nks_msg_up_style_{$userpic}'>
        <p>Theme demo:</p>
        <div class='nks_msg_theme_preview_flat'>
            <div class='nks_msg_flat' style='{$bgstyle}'>
                <div class='nks_msg_sidebar_cont_scrollable'>
                    <div class='nks_msg_sidebar_cont shrinked'>
                        <div class='nks_msg_sidebar_header'>
                            <div class='nks_msg_sidebar_socialbar'>
                                <ul>
                                    <li class='nks_msg_bg_color1'><a href='' class='nks_msg_rss'></a></li>
                                    <li class='nks_msg_bg_color2'><a href='' class='nks_msg_gplus'></a></li>
                                    <li class='nks_msg_bg_color3'><a href='' class='nks_msg_linkedin'></a></li>
                                    <li class='nks_msg_bg_color4'><a href='' class='nks_msg_instagram'></a></li>
                                    <li class='nks_msg_bg_color5'><a href='' class='nks_msg_youtube'></a></li>
                                    <li class='nks_msg_bg_color6'><a href='' class='nks_msg_pinterest'></a></li>
                                    <li class='nks_msg_bg_color7'><a href='' class='nks_msg_twitter'></a></li>
                                    <li class='nks_msg_bg_color8'><a href='' class='nks_msg_facebook'></a></li>
                                </ul>
                            </div>
                            <div class='nks_msg_sidebar_header_userinfo nks_msg_bg_color1'>
                                <div class='nks_msg_userpic'>
                                        <img src='{$previewpic}' alt=''>

                                </div>
                                <div class='nks_msg_user_credentials'>
                                    <span class='nks_msg_user_lastname'>{$previewlastname}</span>
                                    <span class='nks_msg_user_title nks_msg_text_color9'>{$previewtitle}</span>
                                </div>
                            </div>
                        </div>
                        <div class='nks_msg_sidebar_content'>
                            <div class='nks_msg_user_bio'>{$previewbio}</div>
                            <div class='nks_msg_form_input_wrapper nks_msg_name_field'>
                                <input type='text' class='nks_msg_border_color5' name='nks_msg_name_field' id='nks_msg_name_field' placeholder='Your name *' data-rules='required|min[2]|max[16]'>
                            </div>
                             <div class='nks_msg_form_input_wrapper nks_msg_email_field'>
                                <input type='text'  name='nks_msg_name_field' id='nks_msg_name_field1-1' placeholder='Your e-mail *'>
                            </div>
                            <div class='nks_msg_form_btn_wrapper'>
                                <a class='nks_msg_button nks_msg_bg_color8 nks_msg_boxshadow_color3' data-box-shadow='0 2px 0px 2px' href='#'>Send</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class='nks_msg_theme_preview_minimalistic'>
            <div class='nks_msg_minimalistic' style='{$bgstyle}'>
                <div class='nks_msg_sidebar_cont_scrollable'>
                    <div class='nks_msg_sidebar_cont shrinked'>
        								<div class='nks_msg_sidebar_header'>
                        <div class='nks_msg_sidebar_header_userinfo'>
                            <div class='nks_msg_userpic'>
                                <img src='{$previewpic}' alt=''>
                            </div>
                            <div class='nks_msg_user_credentials'>
                                <span class='nks_msg_user_firstname nks_msg_text_color1'>{$previewname2}</span>
                                <span class='nks_msg_user_lastname'>{$previewlastname}</span>
                                <span class='nks_msg_user_title'>{$previewtitle}</span>
                            </div>
		                        </div>

                              <div class='nks_msg_sidebar_socialbar'>
	                               <ul>
	                               		<li><a class='nks_msg_facebook' href='https://www.facebook.com/'></a></li><li><a class='nks_msg_twitter nks_msg_bg_color1' href='https://www.facebook.com/'></a></li><li><a class='nks_msg_pinterest' href='https://www.facebook.com/'></a></li><li><a class='nks_msg_youtube' href='https://www.facebook.com/'></a></li><li><a class='nks_msg_instagram' href='https://www.facebook.com/'></a></li><li><a class='nks_msg_linkedin' href='https://www.facebook.com/'></a></li><li><a class='nks_msg_gplus' href='https://www.facebook.com/'></a></li><li><a class='nks_msg_rss' href='https://www.facebook.com/'></a></li>
	                               </ul>
	                           </div>
                    			</div>

                    <div class='nks_msg_sidebar_content'>
                        <div class='nks_msg_user_bio'>{$previewbio}</div>

                            <div class='nks_msg_form_input_wrapper nks_msg_name_field'>
                                <input type='text' class='nks_msg_border_color5 nks_msg_boxshadow_color4'  data-box-shadow='inset 0px -4px 0px 0px' name='nks_msg_name_field' id='nks_msg_name_field2' placeholder='Your name *'>
                            </div>
                             <div class='nks_msg_form_input_wrapper nks_msg_email_field'>
                                <input type='text' class=''  data-box-shadow='inset 0px -4px 0px 0px' name='nks_msg_name_field' id='nks_msg_name_field2-1' placeholder='Your e-mail *'>
                            </div>
                            <div class='nks_msg_form_btn_wrapper'>
                                <a class='nks_msg_button nks_msg_bg_color1 nks_msg_boxshadow_color5' data-box-shadow='0 2px 0px 2px' href='#'>Send</a>
                            </div>

                    </div>
	</div>
	</div>
	</div>
	</div>

	<div class='nks_msg_theme_preview_aerial'>
            <div class='nks_msg_aerial' style='{$bgstyle}'>
                <div class='nks_msg_sidebar_cont_scrollable'>
                    <div class='nks_msg_sidebar_cont'>
        								<div class='nks_msg_sidebar_header'>
        								<div class='nks_msg_sidebar_socialbar'>
                           <ul>
                              <li><a class='nks_msg_facebook' href='https://www.facebook.com/'></a></li><li><a class='nks_msg_twitter' href='https://www.facebook.com/'></a></li><li><a class='nks_msg_pinterest' href='https://www.facebook.com/'></a></li><li><a class='nks_msg_youtube' href='https://www.facebook.com/'></a></li><li><a class='nks_msg_instagram' href='https://www.facebook.com/'></a></li><li><a class='nks_msg_linkedin' href='https://www.facebook.com/'></a></li><li><a class='nks_msg_gplus' href='https://www.facebook.com/'></a></li><li><a class='nks_msg_rss' href='https://www.facebook.com/'></a></li>
                           </ul>
                        </div>
                        <div class='nks_msg_sidebar_header_userinfo'>
                            <div class='nks_msg_userpic'>
                                <img src='{$previewpic}' alt=''>
                            </div>
                            <div class='nks_msg_user_credentials'>
                                <span class='nks_msg_user_firstname nks_msg_text_color1'>{$previewname2}</span>
                                <span class='nks_msg_user_lastname nks_msg_text_color1'>{$previewlastname}</span>
                                <span class='nks_msg_user_title nks_msg_text_color2'>{$previewtitle}</span>
                            </div>
		                        </div>
                    			</div>

                    <div class='nks_msg_sidebar_content'>
                        <div class='nks_msg_user_bio nks_msg_text_color1'>{$previewbio}</div>

                            <div class='nks_msg_form_input_wrapper nks_msg_name_field'>
                                <input type='text' class='nks_msg_text_color1 nks_msg_bg_rgb_color1' name='nks_msg_name_field' id='nks_msg_name_field3' placeholder='Your name *' value='Your name *'>
                            </div>
                            <div class='nks_msg_form_input_wrapper nks_msg_email_field'>
                                <input type='text' class='nks_msg_text_color1 nks_msg_bg_rgb_color1' name='nks_msg_email_field' id='nks_msg_email_field' placeholder='Your email *' value='Your email *'>
                            </div>
                            <div class='nks_msg_form_btn_wrapper'>
                                <a class='nks_msg_button nks_msg_bg_color1 nks_msg_boxshadow_color5' data-box-shadow='0 2px 0px 2px' href='#'>Send</a>
                            </div>

                    </div>
	</div>
	</div>
	</div>
	</div>
	</div>
	";
}

function nks_msg_color_schema_str () {
    $options = nks_msg_get_options();
    echo "<input id='nks_msg_color_schema' name='nks_msg_options[nks_msg_color_schema]' type='text' value='{$options['nks_msg_color_schema']}' style='' />";
}
function nks_msg_ui_hsl_str () {
    $options = nks_msg_get_options();
    echo "<input id='nks_msg_ui_hsl' name='nks_msg_options[nks_msg_ui_hsl]' type='hidden' value='{$options['nks_msg_ui_hsl']}' style='' />";
}
function nks_msg_label_hsl_str () {
    $options = nks_msg_get_options();
    echo "<input id='nks_msg_label_hsl' name='nks_msg_options[nks_msg_label_hsl]' type='hidden' value='{$options['nks_msg_label_hsl']}' style='' />";
}
function nks_msg_tooltip_grad_str () {
    $options = nks_msg_get_options();
    echo "<input id='nks_msg_tooltip_grad' name='nks_msg_options[nks_msg_tooltip_grad]' type='hidden' value='{$options['nks_msg_tooltip_grad']}' style='' />";
}

function nks_msg_rgba_str () {
    $options = nks_msg_get_options();
    echo "<input id='nks_msg_rgba' name='nks_msg_options[nks_msg_rgba]' type='text' value='{$options['nks_msg_rgba']}' style='' />";
}

function nks_msg_layout_theme_str () {
    $options = nks_msg_get_options();
		$theme = $options['nks_msg_theme'];
		echo "
		<select id='nks_msg_theme' name='nks_msg_options[nks_msg_theme]'>
		<option value='minimalistic' " . ($theme === 'minimalistic' ? 'selected="selected"' : '') . ">Minimalistic White</option>
	    <option value='flat' " . ($theme === 'flat' ? 'selected="selected"' : '') . ">Flat Dark</option>" .
/*	  <option value='cube' " . ($theme === 'cube' ? 'selected="selected"' : '') . ">Cube</option> */
		  "<option value='aerial' " . ($theme === 'aerial' ? 'selected="selected"' : '') . ">Aerial</option>
	  </select>
    ";
}

function nks_msg_scroll_str () {
    $options = nks_msg_get_options();
		$scroll = $options['nks_msg_scroll'];
		echo "
		<h6>When Messenger is opened.</h6>
		<select id='nks_msg_scroll' name='nks_msg_options[nks_msg_scroll]'>
		<option value='custom' " . ($scroll === 'custom' ? 'selected="selected"' : '') . ">Disable scroll of main content</option>
	    <option value='standard' " . ($scroll === 'standard' ? 'selected="selected"' : '') . ">Enable scroll of main content</option>
	  </select>
    ";
}

function nks_msg_enable_test_str() {
	$options = nks_msg_get_options();

	if(@$options['nks_msg_enable_test'] == "enable") {
		$nks_msg_enable_test = "checked='checked'" ;
	} else {
        $nks_msg_enable_test = '';
    }

	echo "<h6>Enable simple captcha to help prevent spam.</h6><input id='nks_msg_enable_test' name='nks_msg_options[nks_msg_enable_test]' class='switcher' type='checkbox' value='enable' {$nks_msg_enable_test} style='' /> <label for='nks_msg_enable_test'></label><br>
	";
}

function nks_msg_autoresponder_str() {
	$options = nks_msg_get_options();

	if(@$options['nks_msg_autoresponder'] == "enable") {
		$nks_msg_autoresponder = "checked='checked'" ;
	} else {
        $nks_msg_autoresponder = '';
    }

	echo "<h6>User will receive copy of own message if checked.</h6><input id='nks_msg_autoresponder' name='nks_msg_options[nks_msg_autoresponder]' class='switcher' type='checkbox' value='enable' {$nks_msg_autoresponder} style='' /> <label for='nks_msg_autoresponder'></label><br>
	";
}

function nks_msg_sidebar_type_str () {
	$options = nks_msg_get_options();
	$checked1 = $options['nks_msg_sidebar_type'] === 'push' ? 'checked="checked"' : '';
	$checked2 = $options['nks_msg_sidebar_type'] === 'slide' ? 'checked="checked"' : '';

	echo "<p><input id='nks_msg_sidebar_type_push' name='nks_msg_options[nks_msg_sidebar_type]' type='radio' {$checked1} value='push' /> <label for='nks_msg_sidebar_type_push'>Pushing page content and revealing itself under it</label></p>";
	echo "<p><input id='nks_msg_sidebar_type_slide' name='nks_msg_options[nks_msg_sidebar_type]' type='radio' {$checked2} value='slide' /> <label for='nks_msg_sidebar_type_slide'>Sliding itself on the top of page content</label></p>";
}

function nks_msg_calltoaction_str() {
	$options = nks_msg_get_options();
	echo " <input id='nks_msg_calltoaction' name='nks_msg_options[nks_msg_calltoaction]' size='40' type='text' value='{$options['nks_msg_calltoaction']}' style='' />";
}

function nks_msg_success_message_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
    $val = htmlentities($options['nks_msg_success_message_'.$index], ENT_QUOTES, "UTF-8");

    echo " <input id='nks_msg_success_message_{$index}' name='nks_msg_options[nks_msg_success_message_{$index}]' size='100' type='text' value='{$val}' style='' />
	";
}

function nks_msg_userpic_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	echo "<h6>Automatically resized to 110x110px.</h6>";
    if (empty($options['nks_msg_userpic_'.$index])) {
        echo "<input id='nks_msg_userpic_file_" . $index . "' type='file' name='nks_msg_pic_{$index}' value='{$options['nks_msg_userpic_'.$index]}' /> <input name='Submit' type='submit' class='button-primary' value='Upload' />";
    } else {
        echo '<div class="nks_msg_userpic"><img width="110" height="110" src="' . $options['nks_msg_userpic_'.$index] . '" alt=""/></div>';
        echo '<p><input  style="margin-top: 0;" type="submit" class="button-secondary" id="nks_msg_remove_pic_'. $index . '" value="Remove this pic"/></p>';
        echo "<script>
             var index = " . $index . ";
             console.log('#nks_msg_remove_pic_' + index);
         (function(){
             jQuery('#nks_msg_remove_pic_' + index).on('click keydown', function(){
                  jQuery('#nks_msg_userpic_' + index).val('');
             })
           })()
           </script>
       ";
        echo "<span>...or upload new one</span><br><input id='nks_msg_userpic_file_{$index}' type='file' name='nks_msg_pic_{$index}' value='{$options['nks_msg_userpic_'.$index]}' /> <input name='Submit' type='submit' class='button-primary' value='Upload' />";
    }
    echo " <input id='nks_msg_userpic_{$index}' name='nks_msg_options[nks_msg_userpic_{$index}]' size='100' type='hidden' value='{$options['nks_msg_userpic_'.$index]}' style='' />";
}

function nks_msg_image_bg_str() {
    $options = nks_msg_get_options();
    $bg = $options['nks_msg_image_bg'];
		$isCustom = $bg === 'custom';
    echo "<select id='nks_msg_image_bg' name='nks_msg_options[nks_msg_image_bg]'>
    <option value='none' " . ($bg === 'none' ? 'selected="selected"' : '') . ">Default</option>
    <option value='custom' " . ($bg === 'custom' ? 'selected="selected"' : '') . ">My custom background</option>
    <option value='blur1' " . ($bg === 'blur1' ? 'selected="selected"' : '') . ">Blurred #1</option>
    <option value='blur2' " . ($bg === 'blur2' ? 'selected="selected"' : '') . ">Blurred #2</option>
    <option value='blur3' " . ($bg === 'blur3' ? 'selected="selected"' : '') . ">Blurred #3</option>
    <option value='blur4' " . ($bg === 'blur4' ? 'selected="selected"' : '') . ">Blurred #4</option>
    <option value='blur5' " . ($bg === 'blur5' ? 'selected="selected"' : '') . ">Blurred #5</option>
    <option value='blur6' " . ($bg === 'blur6' ? 'selected="selected"' : '') . ">Blurred #6</option>
    <option value='blur7' " . ($bg === 'blur7' ? 'selected="selected"' : '') . ">Blurred #7</option>
    <option value='blur8' " . ($bg === 'blur8' ? 'selected="selected"' : '') . ">Blurred #8</option>
    <option value='blur9' " . ($bg === 'blur9' ? 'selected="selected"' : '') . ">Blurred #9</option>
    <option value='blur10' " . ($bg === 'blur10' ? 'selected="selected"' : '') . ">Blurred #10</option>
    <option value='blur11' " . ($bg === 'blur11' ? 'selected="selected"' : '') . ">Blurred #11</option>
    <option value='blur12' " . ($bg === 'blur12' ? 'selected="selected"' : '') . ">Blurred #12</option>
    <option value='blur13' " . ($bg === 'blur13' ? 'selected="selected"' : '') . ">Blurred #13</option>
    <option value='blur14' " . ($bg === 'blur14' ? 'selected="selected"' : '') . ">Blurred #14</option>
    <option value='blur15' " . ($bg === 'blur15' ? 'selected="selected"' : '') . ">Blurred #15</option>
    <option value='pattern1' " . ($bg === 'pattern1' ? 'selected="selected"' : '') . ">Pattern #1</option>
    <option value='pattern2' " . ($bg === 'pattern2' ? 'selected="selected"' : '') . ">Pattern #2</option>
    <option value='pattern3' " . ($bg === 'pattern3' ? 'selected="selected"' : '') . ">Pattern #3</option>
    <option value='pattern4' " . ($bg === 'pattern4' ? 'selected="selected"' : '') . ">Pattern #4</option>
    <option value='pattern5' " . ($bg === 'pattern5' ? 'selected="selected"' : '') . ">Pattern #5</option>
    <option value='pattern6' " . ($bg === 'pattern6' ? 'selected="selected"' : '') . ">Pattern #6</option>
    <option value='pattern7' " . ($bg === 'pattern7' ? 'selected="selected"' : '') . ">Pattern #7</option>
    <option value='pattern8' " . ($bg === 'pattern8' ? 'selected="selected"' : '') . ">Pattern #8</option>
    <option value='pattern9' " . ($bg === 'pattern9' ? 'selected="selected"' : '') . ">Pattern #9</option>
    <option value='pattern10' " . ($bg === 'pattern10' ? 'selected="selected"' : '') . ">Pattern #10</option>
    <option value='pattern11' " . ($bg === 'pattern11' ? 'selected="selected"' : '') . ">Pattern #11</option>
    <option value='pattern12' " . ($bg === 'pattern12' ? 'selected="selected"' : '') . ">Pattern #12</option>
    <option value='pattern13' " . ($bg === 'pattern13' ? 'selected="selected"' : '') . ">Pattern #13</option>
    <option value='pattern14' " . ($bg === 'pattern14' ? 'selected="selected"' : '') . ">Pattern #14</option>
    <option value='pattern15' " . ($bg === 'pattern15' ? 'selected="selected"' : '') . ">Pattern #15</option>
    </select>";
		echo "
	  <script>
	  jQuery(function($){
        var isCustomBG = !!'{$isCustom}';
        var custom = $('.nks_msg_custom_bg');
				if (isCustomBG) {
					custom.show();
				}
	  })

    </script>
    ";
}

function nks_msg_custom_bg_str() {
    $options = nks_msg_get_options();
    if (empty($options['nks_msg_custom_bg'])) {
        echo "<input id='nks_msg_custom_bg' type='file' name='nks_msg_custom_bg' value='{$options['nks_msg_custom_bg']}' /> <input name='Submit' type='submit' class='button-primary' value='Upload' />";
        echo "<br><br><label for='nks_msg_custom_bg_url'>or use URL:</label> <input id='nks_msg_custom_bg_url' name='nks_msg_options[nks_msg_custom_bg]' size='100' type='text' value='{$options['nks_msg_custom_bg']}' style='' />";
    } else {
        echo '<div class="nks_msg_custom_bg" ><img src="' . $options['nks_msg_custom_bg'] . '" alt=""/></div>';
        echo "<span>...or upload new one</span><br><input id='nks_msg_custom_bg' type='file' name='nks_msg_custom_bg' value='{$options['nks_msg_custom_bg']}' /><input name='Submit' type='submit' class='button-primary' value='Upload' />";
	      echo "<br><br><label for='nks_msg_custom_bg_url'>Background image URL:</label><br><input id='nks_msg_custom_bg_url' name='nks_msg_options[nks_msg_custom_bg]' size='100' type='text' value='{$options['nks_msg_custom_bg']}' style='' />";
    }
    //echo " <input id='nks_msg_custom_bg' name='nks_msg_options[nks_msg_custom_bg]' size='100' type='hidden' value='{$options['nks_msg_custom_bg']}' style='' />";
}

function nks_msg_flat_socialbar_str() {
    $options = nks_msg_get_options();
    $position = $options['nks_msg_flat_socialbar'];
    echo "<select id='nks_msg_flat_socialbar' name='nks_msg_options[nks_msg_flat_socialbar]'>
    <option value='top' " . ($position === 'top' ? 'selected="selected"' : '') . ">Top</option>
    <option value='bottom' " . ($position === 'bottom' ? 'selected="selected"' : '') . ">Bottom</option>
    </select>";
}

function nks_msg_user_firstname_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	$val = htmlentities($options['nks_msg_user_firstname_'.$index], ENT_QUOTES, "UTF-8");

	echo " <h6>ex. First name.</h6><input id='nks_msg_user_firstname_{$index}' name='nks_msg_options[nks_msg_user_firstname_{$index}]' size='100' type='text' value='{$val}' style='' />";
}

function nks_msg_user_lastname_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	$val = htmlentities($options['nks_msg_user_lastname_'.$index], ENT_QUOTES, "UTF-8");

	echo " <h6>ex. Full name or Company name.</h6><input id='nks_msg_user_lastname_{$index}' name='nks_msg_options[nks_msg_user_lastname_{$index}]' size='100' type='text' value='{$val}' style='' />";
}

function nks_msg_user_title_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	$val = htmlentities($options['nks_msg_user_title_'.$index], ENT_QUOTES, "UTF-8");

	echo " <h6>ex. your Title or Company Motto.</h6><input id='nks_msg_user_title_{$index}' name='nks_msg_options[nks_msg_user_title_{$index}]' size='100' type='text' value='{$val}' style='' />";
}

function nks_msg_user_bio_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	$val = htmlentities($options['nks_msg_user_bio_'.$index], ENT_QUOTES, "UTF-8");
	echo "<h6>ex. Text with your short bio or company history.</h6><textarea cols='100' rows='10' id='nks_msg_user_bio_{$index}' name='nks_msg_options[nks_msg_user_bio_{$index}]' >" . $val . "</textarea>";
}
function nks_msg_avatar_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	echo " <input id='nks_msg_avatar_{$index}' name='nks_msg_options[nks_msg_avatar_{$index}]' size='100' type='text' value='{$options['nks_msg_avatar_'.$index]}' style='' />";
}

function nks_msg_facebook_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	echo " <input id='nks_msg_facebook_{$index}' name='nks_msg_options[nks_msg_facebook_{$index}]' size='100' type='text' value='{$options['nks_msg_facebook_'.$index]}' style='' />";
}

function nks_msg_twitter_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	echo " <input id='nks_msg_twitter_{$index}' name='nks_msg_options[nks_msg_twitter_{$index}]' size='100' type='text' value='{$options['nks_msg_twitter_'.$index]}' style='' />";
}


function nks_msg_pinterest_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	echo " <input id='nks_msg_pinterest_{$index}' name='nks_msg_options[nks_msg_pinterest_{$index}]' size='100' type='text' value='{$options['nks_msg_pinterest_'.$index]}' style='' />";
}
function nks_msg_youtube_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	echo " <input id='nks_msg_youtube_{$index}' name='nks_msg_options[nks_msg_youtube_{$index}]' size='100' type='text' value='{$options['nks_msg_youtube_'.$index]}' style='' />";
}
function nks_msg_instagram_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	echo " <input id='nks_msg_instagram_{$index}' name='nks_msg_options[nks_msg_instagram_{$index}]' size='100' type='text' value='{$options['nks_msg_instagram_'.$index]}' style='' />";
}
function nks_msg_linkedin_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	echo " <input id='nks_msg_linkedin_{$index}' name='nks_msg_options[nks_msg_linkedin_{$index}]' size='100' type='text' value='{$options['nks_msg_linkedin_'.$index]}' style='' />";
}

function nks_msg_gplus_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	echo " <input id='nks_msg_gplus_{$index}' name='nks_msg_options[nks_msg_gplus_{$index}]' size='100' type='text' value='{$options['nks_msg_gplus_'.$index]}' style='' />";
}
function nks_msg_rss_str($args) {
	$options = nks_msg_get_options();
	$index = $args["index"];
	echo " <input id='nks_msg_rss_{$index}' name='nks_msg_options[nks_msg_rss_{$index}]' size='100' type='text' value='{$options['nks_msg_rss_'.$index]}' style='' />";
}


function nks_msg_ui_color_str() {
	$options = nks_msg_get_options();

	echo "<h6>We highly recommend you choose a color that has a high contrast to white. Default is <em>#0084FF</em></h6><input id='nks_msg_ui_color' data-color-format='hex' name='nks_msg_options[nks_msg_ui_color]' type='text' value='{$options['nks_msg_ui_color']}' style='' />
	<script>

		jQuery(function($){
			
			var colorInput = $('input#nks_msg_ui_color');
			var hueInput = $('input#nks_msg_ui_hsl');
			
			var hslBase = {h: 209.40239043824704, s: 1, l: 0.5078431372549019, a: 1}; 

			var opts = {
		     previewontriggerelement: true,
		     previewformat: 'hex',
		     flat: false,
		     color: '{$options['nks_msg_ui_color']}',
		     customswatches: 'ui',
		     connectedinput: colorInput,
		     swatches: [
		       '0084ff'
		     ],
		     order: {
		         hsl: 1,
		         preview: 2
		     },
		     onchange: function(container, color) {
		     		/*var currentBaseColor = colorInput.val();
					var hsl = tinycolor(currentBaseColor).toHsl();
					var newColor;
//debugger
		     		
		     		if ( Math.ceil(hsl.h) != Math.ceil(hslBase.h) ) {
		     		    // not default
		     		    		     		    
		     		    
		     		    newColor = {
		     		       h: Math.ceil(hsl.h - hslBase.h - 10),
		     		       s: Math.ceil(100 + (hsl.s - hslBase.s) * 100) / 100,
		     		       l: hsl.l - hslBase.l
		     		    }
		     		    
		     		    hueInput.val(JSON.stringify(newColor))
		     		    
		     		    console.log('apply ui color', hsl, hslBase, JSON.stringify(newColor))
		     		} else {
		     			var def = {h:0,s:1,l:1};
		     			hueInput.val(JSON.stringify(def));
		     		}*/
		     }
   };
			jQuery('#nks_msg_ui_color').ColorPickerSliders(opts);
		});

</script>
";

}
function nks_msg_label_color_str() {
	$options = nks_msg_get_options();

	echo "<h6>Default is <em>rgb(4, 132, 255)</em></h6><input id='nks_msg_label_color' data-color-format='rgba' name='nks_msg_options[nks_msg_label_color]' type='text' value='{$options['nks_msg_label_color']}' style='' />
	<script>

		jQuery(function($){
			var colorInput = $('input#nks_msg_label_color');
			var hueInput = $('input#nks_msg_label_hsl');
			
			var hslBase = {
				h: 209.40239043824704,
				s: 1,
				l: 0.5078431372549019,
				a: 1
			};
			
			var opts = {
		    previewontriggerelement: true,
		     previewformat: 'hex',
		     flat: false,
		     color: '{$options['nks_msg_ui_color']}',
		     customswatches: 'ui',
		     connectedinput: colorInput,
		     swatches: [
		       '0084ff'
		     ],
		     order: {
		         hsl: 1,
		         preview: 2
		     },
		     onchange: function(container, color) {
		     		var currentBaseColor = colorInput.val();
					var hsl = tinycolor(currentBaseColor).toHsl();
					var newColor;
//debugger
		     		
		     		if ( Math.ceil(hsl.h) != Math.ceil(hslBase.h) ) {
		     		    // not default
		     		    		     		    
		     		    
		     		    newColor = {
		     		       h: Math.ceil(hsl.h - hslBase.h - 10),
		     		       s: Math.ceil(100 + (hsl.s - hslBase.s) * 100) / 100,
		     		       l: hsl.l - hslBase.l
		     		    }
		     		    		     		    
		     		    hueInput.val(JSON.stringify(newColor));
		     		    
		     		    console.log('apply button color', hsl, hslBase, JSON.stringify(newColor));

		     		} else {
		     			var def = {h:0,s:1,l:1};
		     			hueInput.val(JSON.stringify(def));
		     		}	     		

		     }
   };
			jQuery('#nks_msg_label_color').ColorPickerSliders(opts);
		});

</script>
";

}

function nks_msg_tooltip_color_str() {
	$options = nks_msg_get_options();

	echo "<input id='nks_msg_tooltip_color' data-color-format='rgba' name='nks_msg_options[nks_msg_tooltip_color]' type='text' value='{$options['nks_msg_tooltip_color']}' style='' />
	<script>
		jQuery(function($){
			var colorInput = $('input#nks_msg_tooltip_color');
			var gradInput = $('input#nks_msg_tooltip_grad');
			
			var gradAdjustments = {
				h: -15,
				s: -7,
				v: 0
			}

			var opts = {
		    previewontriggerelement: true,
		     previewformat: 'hex',
		     flat: false,
		     color: '{$options['nks_msg_tooltip_color']}',
		     customswatches: 'tooltip',
		     connectedinput: colorInput,
		     swatches: [
		       '0084ff'
		     ],
		     order: {
		         hsl: 1,
		         preview: 2
		     },
		     onchange: function(container, color) {
		     		var currentBaseColor = colorInput.val();
					var hsv = tinycolor(currentBaseColor).toHsv();
					var newGradient;
//debugger
		     		// {h: 209, s: 1, v: 1, a: 1}
					// {h: 194, s: 0.91, v: 1, a: 1} 
					
					newGradient = {
						h: hsv.h + gradAdjustments.h,
						s: hsv.s + gradAdjustments.s * 0.01,
						v: hsv.v + gradAdjustments.v * 0.01
					}
					
					newGradient = tinycolor(normalize(newGradient)).toRgbString();
					
					gradInput.val(newGradient);
					
					console.log('apply tooltip color', hsv, gradAdjustments, newGradient)
		     }
   };
			$('#nks_msg_tooltip_color').ColorPickerSliders(opts);
		});
		

</script>
";

}

function nks_msg_label_style_str() {
	$options = nks_msg_get_options();
	$val = $options['nks_msg_label_style'];

	echo "<div id='nks_msg_button_preview'><span class='fa-stack fa-lg fa-{$options['nks_msg_label_size']}'> <i class='fa icon-{$options['nks_msg_label_shape']} fa-stack-2x'></i> <i class='fa icon-mail-{$options['nks_msg_label_style']} fa-stack-1x fa-inverse'></i> </span></div>";
	echo "<select id='nks_msg_label_style' name='nks_msg_options[nks_msg_label_style]'>
		 <option value='1' " . ($val === '1' ? 'selected="selected"' : '') . ">Icon style 1</option>
		 <option value='4' " . ($val === '4' ? 'selected="selected"' : '') . ">Icon style 2</option>
		 <option value='3' " . ($val === '3' ? 'selected="selected"' : '') . ">Icon style 3</option>
		 <option value='6' " . ($val === '6' ? 'selected="selected"' : '') . ">Icon style 4</option>
		 <option value='7' " . ($val === '7' ? 'selected="selected"' : '') . ">Icon style 5</option>
		 <option value='alt' " . ($val === 'alt' ? 'selected="selected"' : '') . ">Icon style 6</option>
 </select>";
}

function nks_msg_label_tooltip_str() {
	$options = nks_msg_get_options();
	$val = $options['nks_msg_label_tooltip'];

	echo "<h6>Tooltip appears only when Messenger button is visible and chat window is closed.</h6><select id='nks_msg_label_tooltip' name='nks_msg_options[nks_msg_label_tooltip]'>
		 <option value='visible' " . ($val === 'visible' ? 'selected="selected"' : '') . ">Visible</option>
 		 <option value='none' " . ($val === 'none' ? 'selected="selected"' : '') . ">None</option>

 </select>";
}

function nks_msg_lang_str() {
	$options = nks_msg_get_options();
	$val = $options['nks_msg_lang'];

	$locales = array(
		'af_ZA' => 'Afrikaans',
		'ar_AR' => 'Arabic',
		'az_AZ' => 'Azerbaijani',
		'be_BY' => 'Belarusian',
		'bg_BG' => 'Bulgarian',
		'bn_IN' => 'Bengali',
		'bs_BA' => 'Bosnian',
		'ca_ES' => 'Catalan',
		'cs_CZ' => 'Czech',
		'cy_GB' => 'Welsh',
		'da_DK' => 'Danish',
		'de_DE' => 'German',
		'el_GR' => 'Greek',
		'en_GB' => 'English (GB)',
		'en_PI' => 'English (Pirate)',
		'en_UD' => 'English (Upside Down)',
		'en_US' => 'English (US)',
		'eo_EO' => 'Esperanto',
		'es_ES' => 'Spanish (Spain)',
		'es_LA' => 'Spanish',
		'et_EE' => 'Estonian',
		'eu_ES' => 'Basque',
		'fa_IR' => 'Persian',
		'fb_LT' => 'Leet Speak',
		'fi_FI' => 'Finnish',
		'fo_FO' => 'Faroese',
		'fr_CA' => 'French (Canada)',
		'fr_FR' => 'French (France)',
		'fy_NL' => 'Frisian',
		'ga_IE' => 'Irish',
		'gl_ES' => 'Galician',
		'he_IL' => 'Hebrew',
		'hi_IN' => 'Hindi',
		'hr_HR' => 'Croatian',
		'hu_HU' => 'Hungarian',
		'hy_AM' => 'Armenian',
		'id_ID' => 'Indonesian',
		'is_IS' => 'Icelandic',
		'it_IT' => 'Italian',
		'ja_JP' => 'Japanese',
		'ka_GE' => 'Georgian',
		'km_KH' => 'Khmer',
		'ko_KR' => 'Korean',
		'ku_TR' => 'Kurdish',
		'la_VA' => 'Latin',
		'lt_LT' => 'Lithuanian',
		'lv_LV' => 'Latvian',
		'mk_MK' => 'Macedonian',
		'ml_IN' => 'Malayalam',
		'ms_MY' => 'Malay',
		'nb_NO' => 'Norwegian (bokmal)',
		'ne_NP' => 'Nepali',
		'nl_NL' => 'Dutch',
		'nn_NO' => 'Norwegian (nynorsk)',
		'pa_IN' => 'Punjabi',
		'pl_PL' => 'Polish',
		'ps_AF' => 'Pashto',
		'pt_BR' => 'Portuguese (Brazil)',
		'pt_PT' => 'Portuguese (Portugal)',
		'ro_RO' => 'Romanian',
		'ru_RU' => 'Russian',
		'sk_SK' => 'Slovak',
		'sl_SI' => 'Slovenian',
		'sq_AL' => 'Albanian',
		'sr_RS' => 'Serbian',
		'sv_SE' => 'Swedish',
		'sw_KE' => 'Swahili',
		'ta_IN' => 'Tamil',
		'te_IN' => 'Telugu',
		'th_TH' => 'Thai',
		'tl_PH' => 'Filipino',
		'tr_TR' => 'Turkish',
		'uk_UA' => 'Ukrainian',
		'vi_VN' => 'Vietnamese',
		'zh_CN' => 'Simplified Chinese (China)',
		'zh_HK' => 'Traditional Chinese (Hong Kong)',
		'zh_TW' => 'Traditional Chinese (Taiwan)',
	);

	echo "<select id='nks_msg_lang' name='nks_msg_options[nks_msg_lang]'>";
    // echo "<option value='en_US' " . ($val === 'en_US' ? 'selected="selected"' : '') . ">English (US)</option>";
	foreach ($locales as $locale_value => $locale_name) {
		$selected =  $val == $locale_value ? 'selected="selected"' : '';
//		echo '<div class="checkbox-row"><input type="checkbox" ' . $checked . ' value="yep" name="flow_flow_options[mod-role-' . $role_value . ']" id="mod-role-' . $role_value . '"><label for="mod-role-' . $role_value . '">' . $role_name . '</label></div>';
		echo "<option value='$locale_value' " . $selected . ">$locale_name</option>";
	}
	echo "</select>";
}

function nks_msg_app_id_str() {
	$options = nks_msg_get_options();
	echo " <h6>Find your page ID <a href='https://findmyfbid.com' target='_blank'>here</a>.</h6> <input id='nks_msg_page_id' name='nks_msg_options[nks_msg_page_id]' size='20' type='text' value='{$options['nks_msg_page_id']}' style='' />";
}
function nks_msg_loggedin_str() {
	$options = nks_msg_get_options();
    echo "<h6>The greeting text that will be displayed if the user is currently logged in to Facebook. Maximum 80 characters.</h6>";
	echo " <input id='nks_msg_loggedin' name='nks_msg_options[nks_msg_loggedin]' size='80' type='text' value='{$options['nks_msg_loggedin']}' style='' />";
}

function nks_msg_loggedout_str() {
	$options = nks_msg_get_options();
    echo "<h6>The greeting text that will be displayed if the user is currently not logged in to Facebook. Maximum 80 characters.</h6>";
    echo " <input id='nks_msg_loggedout' name='nks_msg_options[nks_msg_loggedout]' size='80' type='text' value='{$options['nks_msg_loggedout']}' style='' />";
}

function nks_msg_label_tooltip_text_str() {
	$options = nks_msg_get_options();
	echo " <input id='nks_msg_label_tooltip_text' name='nks_msg_options[nks_msg_label_tooltip_text]' size='10' type='text' value='{$options['nks_msg_label_tooltip_text']}' style='' />";
}

function nks_msg_metro_str() {
	$options = nks_msg_get_options();
	$style = $options['nks_msg_metro'];
	$first_checked = $style == 'yes' ? 'checked="checked"' : '';

	echo "
	<p><h6>Overrides other shapes.</h6><input id='nks_msg_metro' name='nks_msg_options[nks_msg_metro]' class='switcher' type='checkbox' value='yes' {$first_checked} style='' /> <label for='nks_msg_metro'></label></p>
	";
	echo "
	  <script>
	  jQuery(function(){

		var check = jQuery('#nks_msg_metro');

	  var icons = jQuery('#nks_msg_button_preview .fa-stack');
	  var init = true;
	  check.change(function() {
		  var checked = this.checked;
	    icons.each(function(){
	        var preview = jQuery(this);
	        var back = preview.find('i:first');
	        var fore = preview.find('i:last');
	        var color;
	        var css;

	        if(checked) {
	        	        	        	  jQuery('body').addClass('metro')

	            color = back.css('color');
	            css = {'background-color': color};
	            back.css(css);
	        } else {
	        	        	  jQuery('body').removeClass('metro')

	            color = fore.css('color');
	            back.css('background-color', '');
	        }

	        init = false;
	    })

	  });

	  			if (check.is(':checked')) check.change()

		 })
	   </script>
	   ";
}

function nks_msg_label_invert_str() {
	$options = nks_msg_get_options();
	$style = $options['nks_msg_label_invert'];
	$first_checked = $style == 'yes' ? 'checked="checked"' : '';

	echo "
	<p><input id='nks_msg_label_invert' name='nks_msg_options[nks_msg_label_invert]' class='switcher' type='checkbox' value='yes' {$first_checked} style='' /> <label for='nks_msg_label_invert'></label></p>
	";
	echo "
	  <script>
	  jQuery(function(){
	  	  var check = jQuery('#nks_msg_label_invert');

		  var icons = jQuery('#nks_msg_button_preview .fa-stack')
		  check.change(function() {
		  var checked = this.checked;

		  if (checked) {
		  	jQuery('#nks_msg_label_stroke').attr('checked', false).change();
		  }
	    icons.each(function(){
	        var preview = jQuery(this);
	        var back = preview.find('i:first');
	        var fore = preview.find('i:last');
	        var color;
	        if(checked) {
	        		jQuery('body').addClass('inverted')
	            color = back.css('color');
	            fore.removeClass('fa-inverse').css('color', color);
	            back.addClass('fa-inverse').css('color', '');
	        } else {
	        	  jQuery('body').removeClass('inverted')
	            color = fore.css('color');
	            back.removeClass('fa-inverse').css('color', color);
	            fore.addClass('fa-inverse').css('color', '');
	        }
	    })

	    });

			if (check.is(':checked')) check.change()

	  })
	   </script>
	   ";
}

function nks_msg_label_size_str() {
	$options = nks_msg_get_options();
	$val = $options['nks_msg_label_size'];

	echo "<select id='nks_msg_label_size' name='nks_msg_options[nks_msg_label_size]'>
		 <option value='1x' " . ($val === '1x' ? 'selected="selected"' : '') . ">1x</option>
		 <option value='2x' " . ($val === '2x' ? 'selected="selected"' : '') . ">2x</option>
		 <option value='3x' " . ($val === '3x' ? 'selected="selected"' : '') . ">3x</option>
 </select>";
}

function nks_msg_label_shape_str() {
	$options = nks_msg_get_options();
	$val = $options['nks_msg_label_shape'];

	echo "<select id='nks_msg_label_shape' name='nks_msg_options[nks_msg_label_shape]'>
		 <option value='circle' " . ($val === 'circle' ? 'selected="selected"' : '') . ">Circle</option>
		 <option value='square' " . ($val === 'square' ? 'selected="selected"' : '') . ">Rounded square</option>
 </select>";
}

function nks_msg_label_top_str() {
	$options = nks_msg_get_options();
	echo "<h6>Please enter CSS valid value for  ex. '50%' or '200px'.</h6><input id='nks_msg_label_top' name='nks_msg_options[nks_msg_label_top]' size='10' type='text' value='{$options['nks_msg_label_top']}' style='' />";
}

function nks_msg_label_top_mob_str() {
	$options = nks_msg_get_options();
	echo " <input id='nks_msg_label_top_mob' name='nks_msg_options[nks_msg_label_top_mob]' size='10' type='text' value='{$options['nks_msg_label_top_mob']}' style='' />";
}

function nks_msg_label_vis_str() {
	$options = nks_msg_get_options();
	$val = $options['nks_msg_label_vis'];
	$first_checked = $val == 'visible' ? 'checked="checked"' : '';
  	$sec_checked = $val == 'scroll_per' ? 'checked="checked"' : '';
	$third_checked = $val == 'hidden_500' ? 'checked="checked"' : '';
	$forth_checked = $val == 'scroll' ? 'checked="checked"' : '';
	$fifth_checked = $val == 'scroll_into' ? 'checked="checked"' : '';
//	<p class='check-row'><input id='nks_msg_label_vis_scroll_per' name='nks_msg_options[nks_msg_label_vis]'  type='radio' value='scroll_into' {$sec_checked} style='' /> <label for='nks_msg_label_vis_scroll_per'>Fade in button after user scrolls certain percentage of page.</label><br>

	echo "
	<p class='check-row'><input id='nks_msg_label_vis_visible' name='nks_msg_options[nks_msg_label_vis]'  type='radio' value='visible' {$first_checked} style='' /> <label for='nks_msg_label_vis_visible'>Always visible</label></p>
	<p class='check-row'><input id='nks_msg_label_vis_scroll' name='nks_msg_options[nks_msg_label_vis]'  type='radio' value='scroll' {$forth_checked} style='' /> <label for='nks_msg_label_vis_scroll'>Fade in button only after user start to scroll</label></p>
	<p class='check-row'><input id='nks_msg_label_vis_scroll_into' name='nks_msg_options[nks_msg_label_vis]'  type='radio' value='scroll_into' {$fifth_checked} style='' /> <label for='nks_msg_label_vis_scroll_into'>Fade in button only after element with selector scrolls into view.</label><br>
	<p style='padding-left: 32px;line-height: 26px;'>Please use any valid CSS selector like #id and .class<br><input type='text' id='nks_msg_label_vis_selector' value='{$options['nks_msg_label_vis_selector']}' name='nks_msg_options[nks_msg_label_vis_selector]' value></p></p>
	";
}

function nks_msg_togglers_str()
{
	$options = nks_msg_get_options();
	echo "<h6>Valid CSS selector like #id or .class</h6><input id='nks_msg_togglers' name='nks_msg_options[nks_msg_togglers]' type='text' value='{$options['nks_msg_togglers']}' style='' />";
}

function nks_msg_label_mouseover_str() {
	$options = nks_msg_get_options();
	$style = $options['nks_msg_label_mouseover'];
	$first_checked = $style == 'yes' ? 'checked="checked"' : '';

	echo "
	<p><h6>When user hovers button.</h6><input id='nks_msg_label_mouseover' name='nks_msg_options[nks_msg_label_mouseover]' class='switcher' type='checkbox' value='yes' {$first_checked} style='' /> <label for='nks_msg_label_mouseover'></label></p>
	";
}
function nks_msg_userpic_style_str() {
	$options = nks_msg_get_options();
	$style = $options['nks_msg_userpic_style'];
	$first_checked = $style == 'theme_custom' ? 'checked="checked"' : '';
  $sec_checked = $style == 'none' ? 'checked="checked"' : '';

	echo "
	<p><input id='nks_msg_userpic_style_theme_custom' name='nks_msg_options[nks_msg_userpic_style]' type='radio' value='theme_custom' {$first_checked} style='' /> <label for='nks_msg_userpic_style_theme_custom'>Theme Custom</label></p>
	<p><input id='nks_msg_userpic_style_none' name='nks_msg_options[nks_msg_userpic_style]' type='radio' value='none' {$sec_checked} style='' /> <label for='nks_msg_userpic_style_none'>None</label></p>
	";
}

function nks_msg_invert_style_str() {
	$options = nks_msg_get_options();
	$style = $options['nks_msg_invert_style'];
	$first_checked = $style == 'invert' ? 'checked="checked"' : '';

	echo "
	<p><h6>Useful with light color schemes.</h6>
	<input id='nks_msg_invert_style' name='nks_msg_options[nks_msg_invert_style]' class='switcher' type='checkbox' value='invert' {$first_checked} style='' /> <label for='nks_msg_invert_style'></label></p>
	";
	echo "<script>
	jQuery('#nks_msg_invert_style').change(function() {
	var t = jQuery(this).closest('.settings-form-wrapper');
	    if(this.checked) {
	        t.addClass('nks_msg_invert');
	    } else {
	        t.removeClass('nks_msg_invert');
	    }
	}).change();
	</script>";
}

function nks_msg_show_social_str() {
	$options = nks_msg_get_options();
  $vis = $options['nks_msg_show_social'];
 echo "<select id='nks_msg_show_social' name='nks_msg_options[nks_msg_show_social]'>
 <option value='show' " . ($vis === 'show' ? 'selected="selected"' : '') . ">Yes</option>
 <option value='hide' " . ($vis === 'hide' ? 'selected="selected"' : '') . ">No</option>
 </select>";
	echo "<script>
	jQuery('#nks_msg_show_social').change(function() {
	var val = jQuery(this).val();
		var t = jQuery(this).closest('.settings-form-wrapper');
	    if(val === 'show') {
	        t.removeClass('nks_msg_hide_social');
	    } else {
	        t.addClass('nks_msg_hide_social');
	    }
	}).change();
	</script>";
}

function nks_msg_custom_css_str()
{
    $options = nks_msg_get_options();
    echo "<h6>Stored during updates.</h6><textarea cols='100' rows='10' id='nks_msg_custom_css' name='nks_msg_options[nks_msg_custom_css]' >" . $options['nks_msg_custom_css'] . "</textarea>";
}

function nks_msg_fade_content_str () {
    $options = nks_msg_get_options();
	  $light_checked = $options['nks_msg_fade_content'] == 'light' ? 'checked="checked"' : '';
    $dark_checked = $options['nks_msg_fade_content'] == 'dark' ? 'checked="checked"' : '';
    $none_checked = $options['nks_msg_fade_content'] == 'none' ? 'checked="checked"' : '';
	echo "<h6>When Messenger is opened.</h6>";
	  echo "<p><input id='nks_msg_fade_content_light' name='nks_msg_options[nks_msg_fade_content]' type='radio' {$light_checked} value='light' style='' /> <label for='nks_msg_fade_content_light'>Light overlay</label></p>";
   	echo "<p><input id='nks_msg_fade_content_dark' name='nks_msg_options[nks_msg_fade_content]' type='radio' {$dark_checked} value='dark' style='' /> <label for='nks_msg_fade_content_dark'>Dark overlay</label></p>";
	  echo "<p><input id='nks_msg_fade_content_none' name='nks_msg_options[nks_msg_fade_content]' type='radio' {$none_checked} value='none' style='' /> <label for='nks_msg_fade_content_none'>Don't fade (recommended if you experience animation lags in Chrome browser on Windows)</label></p>";

}
function nks_msg_sidebar_pos_str () {
    $options = nks_msg_get_options();
    $left_checked = $options['nks_msg_sidebar_pos'] == 'left' ? 'checked="checked"' : '';
    $right_checked = $options['nks_msg_sidebar_pos'] == 'right' ? 'checked="checked"' : '';

   	echo "<p><input id='nks_msg_sidebar_pos_right' name='nks_msg_options[nks_msg_sidebar_pos]' type='radio' {$right_checked} value='right' style='' /> <label for='nks_msg_sidebar_pos_right'></label></p>";
	echo "<p><input id='nks_msg_sidebar_pos_left' name='nks_msg_options[nks_msg_sidebar_pos]' type='radio' {$left_checked} value='left' style='' /> <label for='nks_msg_sidebar_pos_left'></label></p>";

}


if ( !function_exists('imsanity_get_source')) {

/*
Plugin Name: Imsanity
Plugin URI: http://verysimple.com/products/imsanity/
Description: Imsanity stops insanely huge image uploads
Author: Jason Hinkle
Version: 2.2.5
Author URI: http://verysimple.com/
*/

define('IMSANITY_VERSION','2.2.5');
define('IMSANITY_SCHEMA_VERSION','1.1');

define('IMSANITY_DEFAULT_MAX_WIDTH',110);
define('IMSANITY_DEFAULT_MAX_HEIGHT',110);
define('IMSANITY_DEFAULT_BMP_TO_JPG',1);
define('IMSANITY_DEFAULT_QUALITY',90);

define('IMSANITY_SOURCE_POST',1);
define('IMSANITY_SOURCE_LIBRARY',2);
define('IMSANITY_SOURCE_OTHER',4);


/**
 * Inspects the request and determines where the upload came from
 * @return IMSANITY_SOURCE_POST | IMSANITY_SOURCE_LIBRARY | IMSANITY_SOURCE_OTHER
 */
function imsanity_get_source()
{
	return array_key_exists('post_id', $_REQUEST)
		?  ($_REQUEST['post_id'] == 0 ? IMSANITY_SOURCE_LIBRARY : IMSANITY_SOURCE_POST)
		: IMSANITY_SOURCE_OTHER;
}

/**
 * Given the source, returns the max width/height
 *
 * @example:  list($w,$h) = imsanity_get_max_width_height(IMSANITY_SOURCE_LIBRARY);
 * @param int IMSANITY_SOURCE_POST | IMSANITY_SOURCE_LIBRARY | IMSANITY_SOURCE_OTHER
 */
function imsanity_get_max_width_height($source)
{
	$w = IMSANITY_DEFAULT_MAX_WIDTH;
	$h = IMSANITY_DEFAULT_MAX_HEIGHT;
	return array($w,$h);
}



/**
 * If the uploaded image is a bmp this function handles the details of converting
 * the bmp to a jpg, saves the new file and adjusts the params array as necessary
 *
 * @param array $params
 */
function imsanity_bmp_to_jpg($params)
{

	// read in the bmp file and then save as a new jpg file.
	// if successful, remove the original bmp and alter the return
	// parameters to return the new jpg instead of the bmp

	//include_once('libs/imagecreatefrombmp.php');

	$bmp = imagecreatefrombmp($params['file']);

	// we need to change the extension from .bmp to .jpg so we have to ensure it will be a unique filename
	$uploads = wp_upload_dir();
	$oldFileName = basename($params['file']);
	$newFileName = basename(str_ireplace(".bmp", ".jpg", $oldFileName));
	$newFileName = wp_unique_filename( $uploads['path'], $newFileName );

	$quality = IMSANITY_DEFAULT_QUALITY;

	if (imagejpeg($bmp,$uploads['path'] . '/' . $newFileName, $quality))
	{
		// conversion succeeded.  remove the original bmp & remap the params
		unlink($params['file']);

		$params['file'] = $uploads['path'] . '/' . $newFileName;
		$params['url'] = $uploads['url'] . '/' . $newFileName;
		$params['type'] = 'image/jpeg';
	}
	else
	{
		unlink($params['file']);

		return wp_handle_upload_error( $oldFileName,
			__("Oh Snap! Imsanity was Unable to process the BMP file.  "
			."If you continue to see this error you may need to disable the BMP-To-JPG "
			."feature in Imsanity settings.", 'imsanity' ) );
	}

	return $params;
}

/**
 * ################################################################################
 * UTILITIES
 * ################################################################################
 */

/**
 * Util function returns an array value, if not defined then returns default instead.
 * @param Array $array
 * @param string $key
 * @param variant $default
 */
function imsanity_val($arr,$key,$default='')
{
	return isset($arr[$key]) ? $arr[$key] : $default;
}

/**
 * output a fatal error and optionally die
 *
 * @param string $message
 * @param string $title
 * @param bool $die
 */
function imsanity_fatal($message, $title = "", $die = false)
{
	echo ("<div style='margin:5px 0px 5px 0px;padding:10px;border: solid 1px red; background-color: #ff6666; color: black;'>"
		. ($title ? "<h4 style='font-weight: bold; margin: 3px 0px 8px 0px;'>" . $title . "</h4>" : "")
		. $message
		. "</div>");

	if ($die) die();
}

/**
 * Replacement for deprecated image_resize function
 * @param string $file Image file path.
 * @param int $max_w Maximum width to resize to.
 * @param int $max_h Maximum height to resize to.
 * @param bool $crop Optional. Whether to crop image or resize.
 * @param string $suffix Optional. File suffix.
 * @param string $dest_path Optional. New image file path.
 * @param int $jpeg_quality Optional, default is 90. Image quality percentage.
 * @return mixed WP_Error on failure. String with new destination path.
 */
function imsanity_image_resize( $file, $max_w, $max_h, $crop, $suffix = null, $dest_path = null, $jpeg_quality = 90 ) {

	if (function_exists('wp_get_image_editor'))
	{
		// WP 3.5 and up use the image editor

		$editor = wp_get_image_editor( $file );
		if ( is_wp_error( $editor ) )
			return $editor;
		$editor->set_quality( $jpeg_quality );

		$resized = $editor->resize( $max_w, $max_h, $crop );
		if ( is_wp_error( $resized ) )
			return $resized;

		$dest_file = $editor->generate_filename( $suffix, $dest_path );

		// FIX: make sure that the destination file does not exist.  this fixes
		// an issue during bulk resize where one of the optimized media filenames may get
		// used as the temporary file, which causes it to be deleted.
		while (file_exists($dest_file)) {
			$dest_file = $editor->generate_filename('TMP', $dest_path );
		}

		$saved = $editor->save( $dest_file );

		if ( is_wp_error( $saved ) )
			return $saved;

		return $dest_file;
	}
	else
	{
		// wordpress prior to 3.5 uses the old image_resize function
		return image_resize( $file, $max_w, $max_h, $crop, $suffix, $dest_path, $jpeg_quality);
	}
}
}

/**
 * Handler after a file has been uploaded.  If the file is an image, check the size
 * to see if it is too big and, if so, resize and overwrite the original
 * @param Array $params
 */
function nks_msg_imsanity_handle_upload($params) {

	$options = nks_msg_get_options();
	for ($i = 1; $i <= $options['nks_msg_forms']; $i++) {
		if (isset($_FILES['nks_msg_pic_'.$i]) && ($_FILES['nks_msg_pic_'.$i]['size'] > 0)) {
			/* debug logging... */
			// file_put_contents ( "debug.txt" , print_r($params,1) . "\n" );

			/*	$option_convert_bmp = IMSANITY_DEFAULT_BMP_TO_JPG;

				if ($params['type'] == 'image/bmp' && $option_convert_bmp)
				{
					$params = imsanity_bmp_to_jpg($params);
				}*/

			// make sure this is a type of image that we want to convert and that it exists
			// @TODO when uploads occur via RPC the image may not exist at this location
			$oldPath = $params['file'];

			if ( (!is_wp_error($params)) && file_exists($oldPath) && in_array($params['type'], array('image/png','image/gif','image/jpeg')))
			{

				// figure out where the upload is coming from
				$source = imsanity_get_source();

				list($maxW,$maxH) = imsanity_get_max_width_height($source);

				list($oldW, $oldH) = getimagesize( $oldPath );

				/* HACK: if getimagesize returns an incorrect value (sometimes due to bad EXIF data..?)
				$img = imagecreatefromjpeg ($oldPath);
				$oldW = imagesx ($img);
				$oldH = imagesy ($img);
				imagedestroy ($img);
				//*/

				/* HACK: an animated gif may have different frame sizes.  to get the "screen" size
				$data = ''; // TODO: convert file to binary
				$header = unpack('@6/vwidth/vheight', $data );
				$oldW = $header['width'];
				$oldH = $header['width'];
				//*/

				if (($oldW > $maxW && $maxW > 0) || ($oldH > $maxH && $maxH > 0))
				{
					$quality = IMSANITY_DEFAULT_QUALITY;


					list($newW, $newH) = wp_constrain_dimensions($oldW, $oldH, $maxW, $maxH);

					// this is wordpress prior to 3.5 (image_resize deprecated as of 3.5)
					//$resizeResult = imsanity_image_resize( $oldPath, $newW, $newH, true, null, null, $quality);
					$resizeResult = imsanity_image_resize( $oldPath, $maxW, $maxH, true, null, null, $quality);

					/* uncomment to debug error handling code: */
					// $resizeResult = new WP_Error('invalid_image', __(print_r($_REQUEST)), $oldPath);

					// regardless of success/fail we're going to remove the original upload
					unlink($oldPath);

					if (!is_wp_error($resizeResult))
					{
						$newPath = $resizeResult;

						// remove original and replace with re-sized image
						rename($newPath, $oldPath);
					}
					else
					{
						// resize didn't work, likely because the image processing libraries are missing
						$params = wp_handle_upload_error( $oldPath ,
							sprintf( __("Oh Snap! Imsanity was unable to resize this image "
								. "for the following reason: '%s'
						.  If you continue to see this error message, you may need to either install missing server"
								. " components or disable the Imsanity plugin."
								. "  If you think you have discovered a bug, please report it on the Imsanity support forum.", 'imsanity' ) ,$resizeResult->get_error_message() ) );

					}
				}

			}
		}
	};




	return $params;

}

/* add filters to hook into uploads */
add_filter( 'wp_handle_upload', 'nks_msg_imsanity_handle_upload' );
