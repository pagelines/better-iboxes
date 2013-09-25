<?php
/*
	Section: Better iBoxes
	Author: Aleksander Hansson
	Author URI: http://ahansson.com
	Description: An easy way to create and configure several box type sections at once.
	Class Name: BetterIBoxes
	Filter: component
	Loading: active
*/


class BetterIBoxes extends PageLinesSection {

	var $default_limit = 4;

	function section_head(){

		?>
			<script type="text/javascript">

			jQuery(document).ready(function() {

				jQuery(window).resize(function(){
				    // If there are multiple elements with the same class, "main"
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

		$options[] = array(

			'title' => __( 'Better iBoxes Configuration', 'better-iboxes' ),
			'type'	=> 'multi',
			'opts'	=> array(
				array(
					'key'			=> 'better_iboxes_count',
					'type' 			=> 'count_select',
					'count_start'	=> 1,
					'count_number'	=> 12,
					'default'		=> 4,
					'label' 	=> __( 'Number of Better iBoxes to Configure', 'better-iboxes' ),
				),
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
					'default'		=> 4,
					'label' 	=> __( 'Number of iBoxes per row (Default is 4)', 'better-iboxes' ),
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

		$slides = ($this->opt('better_iboxes_count')) ? $this->opt('better_iboxes_count') : $this->default_limit;
		$media = ($this->opt('better_iboxes_media')) ? $this->opt('better_iboxes_media') : 'icon';

		for($i = 1; $i <= $slides; $i++){

			$opts = array(

				array(
					'key'		=> 'better_iboxes_title_'.$i,
					'label'		=> __( 'Better iBoxes Title', 'better-iboxes' ),
					'type'		=> 'text'
				),
				array(
					'key'		=> 'title_on_top_'.$i,
					'label'		=> __( 'Title On Top?', 'better-iboxes' ),
					'type'		=> 'check',
					'default'	=> false
				),
				array(
					'key'		=> 'title_type_'.$i,
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
					'key'		=> 'better_iboxes_text_'.$i,
					'label'	=> __( 'Better iBoxes Text', 'better-iboxes' ),
					'type'	=> 'textarea'
				),
				array(
					'key'		=> 'better_iboxes_link_'.$i,
					'label'		=> __( 'Better iBoxes Link (Optional). Remember "http://"', 'better-iboxes' ),
					'type'		=> 'text'
				),
				array(
					'key'		=> 'better_iboxes_border_radius_'.$i,
					'label'		=> __( 'Better iBoxes Border Radius (Default is 50%) for no border radius type: "none"', 'better-iboxes' ),
					'type'		=> 'text'
				),
				array(
					'key'			=> 'better_iboxes_animation_'.$i,
					'label' 		=> __( 'Select Animation', 'better-iboxes' ),
					'type' 			=> 'select',
					'opts'		=> array(
						'pl-appear'			=> array( 'name' => __( 'Appear', 'better-iboxes' ) ),
						'pla-scale'	 		=> array( 'name' => __( 'Scale', 'better-iboxes' ) ),
						'pla-fade'			=> array( 'name' => __( 'Fade', 'better-iboxes' ) ),
						'pla-from-left'		=> array( 'name' => __( 'From Left', 'better-iboxes' ) ),
						'pla-from-right'	=> array( 'name' => __( 'From Right', 'better-iboxes' ) ),
						'pla-from-top'		=> array( 'name' => __( 'From Top', 'better-iboxes' ) ),
						'pla-from-bottom'	=> array( 'name' => __( 'From Bottom', 'better-iboxes' ) )
					),
					'help' 			=> __( 'This is a DMS Pro feature. You have to register your site to make animations work. If you want to remove animations, use the checkbox below.', 'better-iboxes' ),
					'default'		=> 'pl-appear',
				),
				array(
					'type' 			=> 'check',
					'key'			=> 'better_iboxes_animations_'.$i,
					'label'			=> 'Remove Animation?',
					'default'		=> false,
				),
			);

			if($media == 'icon'){
				$opts[] = array(
					'key'		=> 'better_iboxes_font_size_'.$i,
					'label'		=> __( 'Better iBoxes Icon Size (Default is 40px)', 'better-iboxes' ),
					'type'		=> 'text'
				);
				$opts[] = array(
					'key'		=> 'better_iboxes_icon_'.$i,
					'label'		=> __( 'Better iBoxes Icon', 'better-iboxes' ),
					'type'		=> 'select_icon',
				);
				$opts[] = array(
					'key'		=> 'better_iboxes_contrast_'.$i,
					'label'		=> __( 'Remove iBoxes Contrast', 'better-iboxes' ),
					'type'		=> 'check',
					'default'	=> true,
				);
				$opts[] = array(
					'key'		=> 'better_iboxes_hover_'.$i,
					'label'		=> __( 'Remove iBoxes Hover', 'better-iboxes' ),
					'type'		=> 'check',
					'default'	=> true,
				);
			} elseif($media == 'image'){
				$opts[] = array(
					'key'		=> 'better_iboxes_image_'.$i,
					'label'		=> __( 'Better iBoxes Image', 'better-iboxes' ),
					'type'		=> 'image_upload',
				);
			}
			$opts[] = array(
				'key'		=> 'better_iboxes_dimensions_'.$i,
				'label'		=> __( 'Better iBoxes Dimensions (Default is 90px)', 'better-iboxes' ),
				'type'		=> 'text'
			);

			$opts[] = array(
				'key'		=> 'better_iboxes_custom_class_'.$i,
				'label'		=> __( 'iBox '.$i.' custom class', 'better-iboxes' ),
				'type'		=> 'text'
			);


			$options[] = array(
				'title' 	=> __( 'Better iBoxes ', 'better-iboxes' ) . $i,
				'type' 		=> 'multi',
				'opts' 		=> $opts,

			);

		}

		return $options;
	}



   function section_template( ) {

		$boxes = ($this->opt('better_iboxes_count')) ? $this->opt('better_iboxes_count') : $this->default_limit;
		$cols_number = ($this->opt('better_iboxes_cols')) ? $this->opt('better_iboxes_cols'): 4;
		$cols = (12 / $cols_number);

		$media_type = ($this->opt('better_iboxes_media')) ? $this->opt('better_iboxes_media') : 'icon';
		$media_format = ($this->opt('better_iboxes_format')) ? $this->opt('better_iboxes_format') : 'top';

		$width = 0;
		$output = '';

		for($i = 1; $i <= $boxes; $i++):

			// TEXT
			$text = ($this->opt('better_iboxes_text_'.$i)) ? $this->opt('better_iboxes_text_'.$i) : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id lectus sem. Cras consequat lorem.';

			$text = sprintf('<div data-sync="better_iboxes_text_%s">%s</div>', $i, $text );

			$title_type = (! $this->opt('title_type_'.$i) ) ? 'h4': $this->opt('title_type_'.$i);

			$title = ($this->opt('better_iboxes_title_'.$i)) ? $this->opt('better_iboxes_title_'.$i) : __('Better iBoxes '.$i, 'better-iboxes');
			$title = sprintf('<%s data-sync="better_iboxes_title_%s">%s</%s>', $title_type, $i, $title, $title_type );

			// LINK
			$link = $this->opt('better_iboxes_link_'.$i);
			$link_opening = ($link) ? sprintf('<a href="%s">', $link ) : '';
			$link_closing = ($link) ? sprintf('</a>', $link ) : '';
			$hover = ($this->opt('better_iboxes_hover_'.$i)) ? '' : 'hover';
			$contrast = ($this->opt('better_iboxes_contrast_'.$i)) ? '' : 'pl-contrast';

			if (! $this->opt('better_iboxes_animations_'.$i) ) {
				$animations = ($this->opt('better_iboxes_animation_'.$i)) ? sprintf('pl-animation %s', $this->opt('better_iboxes_animation_'.$i) ): '';
			}

			$format_class = ($media_format == 'left') ? 'media left-aligned' : 'top-aligned';
			$media_class = sprintf('media-type-%s %s %s', $media_type, $hover, $contrast);

			$media_bg = '';
			$media_html = '';


			$border_radius = ($this->opt('better_iboxes_border_radius_'.$i)) ? sprintf('border-radius: %s;', $this->opt('better_iboxes_border_radius_'.$i)) : 'border-radius: 50%;';
			$font_size = ($this->opt('better_iboxes_font_size_'.$i)) ? sprintf('font-size: %s;', $this->opt('better_iboxes_font_size_'.$i)) : 'font-size: 40px;';
			$lineheight = $this->opt('better_iboxes_dimensions_'.$i);
			$dimensions = ($this->opt('better_iboxes_dimensions_'.$i)) ? sprintf('width: %s; height:%s;', $this->opt('better_iboxes_dimensions_'.$i), $this->opt('better_iboxes_dimensions_'.$i), $lineheight) : 'width:90px; height: 90px;';

			if( $media_type == 'icon' ){
				$media = ($this->opt('better_iboxes_icon_'.$i)) ? $this->opt('better_iboxes_icon_'.$i) : false;
				if(!$media){
					$icons = pl_icon_array();
					$media = $icons[ array_rand($icons) ];
				}
				$media_html = sprintf('<i class="icon icon-%s" style="%s"></i>', $media, $font_size);

			} elseif( $media_type == 'image' ){

				$media = ($this->opt('better_iboxes_image_'.$i)) ? $this->opt('better_iboxes_image_'.$i) : false;

				$media_html = '';

				$media_bg = ($media) ? sprintf('background-image: url(%s);', $media) : '';

			}

			if ( $this->opt('title_on_top_'.$i) ) {
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

			$custom_class = ( $this->opt('better_iboxes_custom_class_'.$i) ) ? $this->opt('better_iboxes_custom_class_'.$i): '';

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

		endfor;
		$group_animate = ($this->opt('better_iboxes_group_animate')) ? '': 'pl-animation-group';

		printf('<div class="better_iboxes_wrapper %s">%s</div>',$group_animate, $output);

	}

}