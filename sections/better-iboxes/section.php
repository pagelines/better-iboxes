<?php
/*
	Section: Better iBoxes
	Author: Aleksander Hansson
	Author URI: http://ahansson.com
	Demo: http://betteriboxes.ahansson.com
	Description: A better way to create and configure several iBoxes at once. It is all about options!
	Class Name: BetterIBoxes
	Workswith: templates, main
	Filter: component
	Loading: active
*/


class BetterIBoxes extends PageLinesSection {

   function section_template( ) {

		$better_iboxes_array = $this->opt('better_iboxes_array');

		$format_upgrade_mapping = array(
			'text'	=> 'better_iboxes_text_%s',
			'title'	=> 'better_iboxes_title_%s',
			'link'	=> 'better_iboxes_link_%s',
			'border_radius'	=> 'better_iboxes_border_radius_%s',
			'title_on_top'	=> 'title_on_top_%s',
			'title_type'	=> 'title_type_%s',
			'animation'	=> 'better_iboxes_animation_%s',
			'animations'	=> 'better_iboxes_animations_%s',
			'icon'	=> 'better_iboxes_icon_%s',
			'font_size'	=> 'better_iboxes_font_size_%s',
			'image'	=> 'better_iboxes_image_%s',
			'dimensions'	=> 'better_iboxes_dimensions_%s',
			'contrast'	=> 'better_iboxes_contrast_%s',
			'hover'	=> 'better_iboxes_hover_%s',
			'custom_class'	=> 'better_iboxes_custom_class_%s'
		);

		$better_iboxes_array = $this->upgrade_to_array_format( 'better_iboxes_array', $better_iboxes_array, $format_upgrade_mapping, $this->opt('better_iboxes_count'));

		// must come after upgrade
		if( !$better_iboxes_array || $better_iboxes_array == 'false' || !is_array($better_iboxes_array) ){
			$better_iboxes_array = array( array(), array(), array() );
		}

		$cols_number = ($this->opt('better_iboxes_cols')) ? $this->opt('better_iboxes_cols'): 3;
		$cols = (12 / $cols_number);

		$media_type = ($this->opt('better_iboxes_media')) ? $this->opt('better_iboxes_media') : 'icon';
		$media_format = ($this->opt('better_iboxes_format')) ? $this->opt('better_iboxes_format') : 'top';

		$width = 0;
		$output = '';

		$count = 1;

		if( is_array($better_iboxes_array) ){

			$boxes = count( $better_iboxes_array );

			foreach( $better_iboxes_array as $better_ibox ){

				// TEXT
				$text = pl_array_get( 'text', $better_ibox, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id lectus sem. Cras consequat lorem.');
				$text = sprintf('<div data-sync="better_iboxes_array_item%s_text">%s</div>', $count, $text );
				$title_type = pl_array_get( 'title_type', $better_ibox, 'h4');
				$title = pl_array_get( 'title', $better_ibox, 'Better iBox '. $count );
				$title = sprintf('<%s data-sync="better_iboxes_array_item%s_title">%s</%s>', $title_type, $count, $title, $title_type );

				// LINK
				$link = pl_array_get( 'link', $better_ibox);
				$link_opening = ($link) ? sprintf('<a href="%s">', $link ) : '';
				$link_closing = ($link) ? sprintf('</a>', $link ) : '';

				$hover = ( pl_array_get( 'hover', $better_ibox) ) ? '': 'hover';
				$contrast = ( pl_array_get( 'contrast', $better_ibox) ) ? '': 'pl-contrast';

				if( pl_array_get( 'animations', $better_ibox) == 0 ) {
					$animations = '';
				} else {
					$animations = pl_array_get( 'animation', $better_ibox);
				}

				$format_class = ($media_format == 'left') ? 'media left-aligned' : 'top-aligned';
				$media_class = sprintf('media-type-%s %s %s', $media_type, $hover, $contrast);

				$media_bg = '';
				$media_html = '';

				$border_radius = (pl_array_get( 'border_radius', $better_ibox)) ? sprintf('border-radius: %s;', pl_array_get( 'border_radius', $better_ibox)) : 'border-radius: 50%;';
				$font_size = (pl_array_get( 'font_size', $better_ibox)) ? sprintf('font-size: %s;', pl_array_get( 'font_size', $better_ibox)) : 'font-size: 40px;';
				$dimensions = (pl_array_get( 'dimensions', $better_ibox)) ? sprintf('width: %s; height:%s;', pl_array_get( 'dimensions', $better_ibox), pl_array_get( 'animations', $better_ibox)) : 'width:90px; height: 90px;';

				if( $media_type == 'icon' ){
					$media = pl_array_get( 'icon', $better_ibox) ? pl_array_get( 'icon', $better_ibox) : false;
					if(!$media){
						$icons = pl_icon_array();
						$media = $icons[ array_rand($icons) ];
					}
					$media_html = sprintf('<i class="icon icon-%s" style="%s"></i>', $media, $font_size);

				} elseif( $media_type == 'image' ){

					$media = (pl_array_get( 'image', $better_ibox)) ? pl_array_get( 'image', $better_ibox) : false;

					$media_html = '';

					$media_bg = ($media) ? sprintf('background-image: url(%s);', $media) : '';

				}

				if ( pl_array_get( 'title_on_top', $better_ibox) ) {
					$title_top = $title;
					$title_bottom = '';
				} else {
					$title_top = '';
					$title_bottom = $title;
				}

				if ($media_type == 'text') {
					$iboxes_media = '';
				} else {
					$iboxes_media = sprintf(
						'<div class="better_iboxes_media">
							<span class="better_iboxes_icon-border %s %s" style="%s %s %s">
								%s
							</span>
						</div>',
						$media_class,
						$animations,
						$media_bg,
						$border_radius,
						$dimensions,
						$media_html
					);
				}

				if($width == 0)
					$output .= '<div class="row fix">';

				$custom_class = ( pl_array_get( 'custom_class', $better_ibox) ) ? pl_array_get( 'custom_class', $better_ibox): '';

				$output .= sprintf(
					'<div class="%s span%s better_iboxes %s fix">
						%s
						%s
						%s
							<div class="better_iboxes_text bd">
								%s
								<div class="better_iboxes_desc">
									%s
								</div>
							</div>
						%s
					</div>',

					$custom_class,
					$cols,
					$format_class,
					$link_opening,
					$title_top,
					$iboxes_media,
					$title_bottom,
					$text,
					$link_closing
				);

				$width += $cols;

				if($width >= 12 || $i == $boxes){
					$width = 0;
					$output .= '</div>';
				}

				$count++;

			}
		}

		$group_animate = ($this->opt('better_iboxes_group_animate')) ? '': 'pl-animation-group';

		printf('<div class="better_iboxes_wrapper %s">%s</div>',$group_animate, $output);

	}

	function section_head(){

		?>
			<script type="text/javascript">

			jQuery(document).ready(function() {

				jQuery(window).resize(function(){
				    jQuery('.media-type-image').each(function() {
				        jQuery(this).height(jQuery(this).width());
				    });
				}).resize();
			});
			</script>
		<?php
	}

	function section_opts(){

		$options = array();

		$how_to_use = __( '
		<strong>Read the instructions below before asking for additional help:</strong>
		</br></br>
		<strong>1.</strong> In the frontend editor, drag the Better iBoxes section to a template of your choice.
		</br></br>
		<strong>2.</strong> Edit settings for Better iBoxes.
		</br></br>
		<strong>3.</strong> When you are done, hit "Publish" to see changes.
		</br></br>
		<strong><a href="http://betteriboxes.ahansson.com/custom-less/" target="_blank">See here how to change hover color</a></strong>
		</br></br>
		<div class="row zmb">
				<div class="span6 tac zmb">
					<a class="btn btn-info" href="http://forum.pagelines.com/71-products-by-aleksander-hansson/" target="_blank" style="padding:4px 0 4px;width:100%"><i class="icon-ambulance"></i>          Forum</a>
				</div>
				<div class="span6 tac zmb">
					<a class="btn btn-info" href="http://betterdms.com" target="_blank" style="padding:4px 0 4px;width:100%"><i class="icon-align-justify"></i>          Better DMS</a>
				</div>
			</div>
			<div class="row zmb" style="margin-top:4px;">
				<div class="span12 tac zmb">
					<a class="btn btn-success" href="http://shop.ahansson.com" target="_blank" style="padding:4px 0 4px;width:100%"><i class="icon-shopping-cart" ></i>          My Shop</a>
				</div>
			</div>
		', 'better-iboxes' );

		$options[] = array(
			'key' => 'better_iboxes_help',
			'type'     => 'template',
			'template'      => do_shortcode( $how_to_use ),
			'title' =>__( 'How to use:', 'better-iboxes' ) ,
		);

		$options[] = array(
			'key'	=> 'better_iboxes_settings',
			'title' => __( 'Better iBoxes Settings', 'better-iboxes' ),
			'type'	=> 'multi',
			'opts'	=> array(
				array(
					'key'			=> 'better_iboxes_cols',
					'type' 			=> 'select',
					'opts'		=> array(
						1	 	=> array( 'name' => __( '1', 'better-iboxes' ) ),
						2		=> array( 'name' => __( '2', 'better-iboxes' ) ),
						3		=> array( 'name' => __( '3', 'better-iboxes' ) ),
						4		=> array( 'name' => __( '4', 'better-iboxes' ) ),
						6		=> array( 'name' => __( '6', 'better-iboxes' ) ),
						12		=> array( 'name' => __( '12', 'better-iboxes' ) )
					),
					'default'		=> 3,
					'label' 	=> __( 'Number of iBoxes per row (Default is 3)', 'better-iboxes' ),
				),
				array(
					'key'			=> 'better_iboxes_media',
					'type' 			=> 'select',
					'opts'		=> array(
						'icon'	 	=> array( 'name' => __( 'Icon Font', 'better-iboxes' ) ),
						'image'		=> array( 'name' => __( 'Images', 'better-iboxes' ) ),
						'text'		=> array( 'name' => __( 'Text Only, No Media', 'better-iboxes' ) )
					),
					'default'		=> 'icon',
					'label' 	=> __( 'Select Better iBoxes Media Type', 'better-iboxes' ),
				),
				array(
					'key'			=> 'better_iboxes_format',
					'type' 			=> 'select',
					'opts'		=> array(
						'top'		=> array( 'name' => __( 'Media on Top', 'better-iboxes' ) ),
						'left'	 	=> array( 'name' => __( 'Media at Left', 'better-iboxes' ) ),
					),
					'default'		=> 'top',
					'label' 	=> __( 'Select the Better iBoxes Media Location', 'better-iboxes' ),
				),
				array(
					'key'			=> 'better_iboxes_group_animate',
					'type' 			=> 'check',
					'label' 	=> __( 'Remove Group Animate?', 'better-iboxes' ),
				),
			)

		);

		$options[] = array(
			'key'		=> 'better_iboxes_array',
	    	'type'		=> 'accordion',
			'title'		=> __('Better iBoxes Setup', 'better-iboxes'),
			'post_type'	=> __('Better iBox', 'better-iboxes'),
			'opts'	=> array(
				array(
					'key'		=> 'title',
					'label'		=> __( 'Better iBoxes Title', 'better-iboxes' ),
					'type'		=> 'text'
				),
				array(
					'key'		=> 'title_on_top',
					'label'		=> __( 'Title On Top?', 'better-iboxes' ),
					'type' 			=> 'select',
					'opts'		=> array(
						true	 	=> array( 'name' => __( 'Yes', 'better-iboxes' ) ),
						false		=> array( 'name' => __( 'No', 'better-iboxes' ) )
					),
					'default'		=> false,
				),
				array(
					'key'		=> 'title_type',
					'label'		=> __( 'Better iBoxes Title Type', 'better-iboxes' ),
					'type' 			=> 'select',
					'opts'		=> array(
						'h1'	 	=> array( 'name' => __( 'Heading 1', 'better-iboxes' ) ),
						'h2'		=> array( 'name' => __( 'Heading 2', 'better-iboxes' ) ),
						'h3'		=> array( 'name' => __( 'Heading 3', 'better-iboxes' ) ),
						'h4'		=> array( 'name' => __( 'Heading 4', 'better-iboxes' ) ),
						'h5'		=> array( 'name' => __( 'Heading 5', 'better-iboxes' ) ),
						'h6'		=> array( 'name' => __( 'Heading 6', 'better-iboxes' ) )
					),
					'default'		=> 'h4',
				),
				array(
					'key'		=> 'text',
					'label'	=> __( 'Better iBoxes Text', 'better-iboxes' ),
					'type'	=> 'textarea'
				),
				array(
					'key'		=> 'link',
					'label'		=> __( 'Better iBoxes Link (Optional). Remember "http://"', 'better-iboxes' ),
					'type'		=> 'text'
				),
				array(
					'key'		=> 'border_radius',
					'label'		=> __( 'Better iBoxes Border Radius (Default is 50%) for no border radius type: "none"', 'better-iboxes' ),
					'type'		=> 'text'
				),
				array(
					'key'			=> 'animation',
					'label' 		=> __( 'Select Animation', 'better-iboxes' ),
					'type' 			=> 'select',
					'opts'		=> array(
						'pl-animation pl-appear'		=> array( 'name' => __( 'Appear', 'better-iboxes' ) ),
						'pl-animation pla-scale'	 	=> array( 'name' => __( 'Scale', 'better-iboxes' ) ),
						'pl-animation pla-fade'			=> array( 'name' => __( 'Fade', 'better-iboxes' ) ),
						'pl-animation pla-from-left'	=> array( 'name' => __( 'From Left', 'better-iboxes' ) ),
						'pl-animation pla-from-right'	=> array( 'name' => __( 'From Right', 'better-iboxes' ) ),
						'pl-animation pla-from-top'		=> array( 'name' => __( 'From Top', 'better-iboxes' ) ),
						'pl-animation pla-from-bottom'	=> array( 'name' => __( 'From Bottom', 'better-iboxes' ) )
					),
					'help' 			=> __( 'This is a DMS Pro feature. You have to register your site to make animations work. If you want to remove animations, use the checkbox below.', 'better-iboxes' ),
					'default'		=> 'pl-animation pl-appear',
				),
				array(
					'key'			=> 'animations',
					'label'			=> 'Remove Animation?',
					'type' 			=> 'select',
					'opts'		=> array(
						true	 	=> array( 'name' => __( 'Yes', 'better-iboxes' ) ),
						false		=> array( 'name' => __( 'No', 'better-iboxes' ) )
					),
					'default'		=> false,
				),
				array(
					'key'		=> 'icon',
					'label'		=> __( 'Better iBoxes Icon', 'better-iboxes' ),
					'type'		=> 'select_icon',
				),
				array(
					'key'		=> 'font_size',
					'label'		=> __( 'Better iBoxes Icon Size (Default is 40px)', 'better-iboxes' ),
					'type'		=> 'text'
				),
				array(
					'key'		=> 'image',
					'label'		=> __( 'Better iBoxes Image', 'better-iboxes' ),
					'type'		=> 'image_upload',
				),
				array(
					'key'		=> 'dimensions',
					'label'		=> __( 'Better iBoxes Dimensions (Default is 90px)', 'better-iboxes' ),
					'type'		=> 'text'
				),
				array(
					'key'		=> 'contrast',
					'label'		=> __( 'Remove iBoxes Contrast', 'better-iboxes' ),
					'type' 			=> 'select',
					'opts'		=> array(
						true	 	=> array( 'name' => __( 'Yes', 'better-iboxes' ) ),
						false		=> array( 'name' => __( 'No', 'better-iboxes' ) )
					),
					'default'		=> false,
				),
				array(
					'key'		=> 'hover',
					'label'		=> __( 'Remove iBoxes Hover', 'better-iboxes' ),
					'type' 			=> 'select',
					'opts'		=> array(
						true	 	=> array( 'name' => __( 'Yes', 'better-iboxes' ) ),
						false		=> array( 'name' => __( 'No', 'better-iboxes' ) )
					),
					'default'		=> false,
				),
				array(
					'key'		=> 'custom_class',
					'label'		=> __( 'Custom class', 'better-iboxes' ),
					'type'		=> 'text'
				),
			)
	    );

		return $options;
	}

}