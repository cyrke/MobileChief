<?php

/* ---------------------------------------------------------------------------- */
/* Plupload Field
/* ---------------------------------------------------------------------------- */

	function plchf_msb_site_settings_field_plupload($fields, $count) {

		// Get the Field Definitions
		$type 			= $fields['type'];
		$label 			= $fields['name'];
		$tooltip		= $fields['tooltip'];
		$placeholder	= $fields['placeholder'];
		$multiple		= $fields['multiple'];
		$field_id		= $fields['id'];

		// Get the saved Value
		$value			= plchf_msb_get_site_option($type, $field_id);
		
		if ($multiple == 'true') {
			$multiple = true;
		} else {
			$multiple = false;
		}
		
		$multiple 	= $multiple; 	// allow multiple files upload
		$width 		= null; 	// If you want to automatically resize all uploaded images then provide width here (in pixels)
		$height 	= null; 	// If you want to automatically resize all uploaded images then provide height here (in pixels)
	
		$output .= '
		<label>'.$label.'
			<a href="#" class="tipsy-se floatr" rel="tooltip" data-placement="top" data-original-title="'.$tooltip.'">
				<img src="'.PLUGINCHIEFMSB.'images/element-icons/element-info.png" width="20px">
			</a>
		</label>';
	
		$output .= '<input type="hidden" name="field['.$type.$field_id.']['.$field_id.']" id="'.$field_id.'" value="'.$value.'" />';
		$output .= '<div class="plupload-upload-uic hide-if-no-js ';

			if ($multiple) {
				$output .= 'plupload-upload-uic-multiple';
			}

		$output .= '" id="'.$field_id.'plupload-upload-ui">';

		    $output .= '<span class="ajaxnonceplu" id="ajaxnonceplu'. wp_create_nonce($field_id . "pluploadan") .'"></span>';

		    if ($width && $height) {
		    	$output .= '<span class="plupload-resize"></span><span class="plupload-width" id="plupload-width'.$width.'"></span>';
		        $output .= '<span class="plupload-height" id="plupload-height'.$height.'"></span>';
		    }

		    $output .= '<div class="filelist"></div>';

		$output .= '</div>';

		$output .= '<div class="plupload-thumbs ';

			if ($multiple) {
				$output .= 'plupload-thumbs-multiple';
			}

			$output .= '" id="'. $field_id .'plupload-thumbs">';

		$output .= '</div>';

			// Show Thumbs Here if there are any already



		$output .= '<div class="clear"></div>';

		$output .= '<br/>';

		$output .= '<a id="'.$field_id.'plupload-browse-button" class="btn btn-primary" class="button" />Select Files</a>';

		$output .= '<div class="clear"></div>';

		$output .= '<br/>';

		echo apply_filters('plchf_msb_site_settings_field_plupload_filters',$output);

	}

	add_action('plchf_msb_site_settings_field_plupload','plchf_msb_site_settings_field_plupload', 10, 4);