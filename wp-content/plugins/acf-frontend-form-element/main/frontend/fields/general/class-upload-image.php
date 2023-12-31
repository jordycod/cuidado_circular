<?php
namespace Frontend_Admin\Field_Types;

if ( ! class_exists( 'upload_image' ) ) :

	class upload_image extends upload_file {



		/*
		*  __construct
		*
		*  This function will setup the field type data
		*
		*  @type    function
		*  @date    5/03/2014
		*  @since    5.0.0
		*
		*  @param    n/a
		*  @return    n/a
		*/

		function initialize() {
			// vars
			$this->name     = 'upload_image';
			$this->label    = __( 'Upload Image', 'acf-frontend-form-element' );
			$this->public   = false;
			$this->defaults = array(
				'return_format' => 'array',
				'preview_size'  => 'thumbnail',
				'library'       => 'all',
				'min_width'     => 0,
				'min_height'    => 0,
				'min_size'      => 0,
				'max_width'     => 0,
				'max_height'    => 0,
				'max_size'      => 0,
				'mime_types'    => '',
				'button_text'   => __( 'Add Image', 'acf-frontend-form-element' ),
				'no_file_text'  => __( 'No Image selected', 'acf-frontend-form-element' ),
			);

			// filters
			add_filter( 'get_media_item_args', array( $this, 'get_media_item_args' ) );

		}

		/*
		*  get_media_item_args
		*
		*  description
		*
		*  @type    function
		*  @date    15/11/2022
		*  @since   3.9.16
		*
		*  @param   $vars (array)
		*  @return  $vars
		*/

		function get_media_item_args( $vars ) {
			$vars['send'] = true;
			return( $vars );

		}



		/*
		*  input_admin_enqueue_scripts
		*
		*  description
		*
		*  @type    function
		*  @date    16/12/2015
		*  @since    5.3.2
		*
		*  @param    $post_id (int)
		*  @return    $post_id (int)
		*/

		function input_admin_enqueue_scripts() {
			// localize
			acf_localize_text(
				array(
					'Select Image' => __( 'Select Image', 'acf-frontend-form-element' ),
					'Edit Image'   => __( 'Edit Image', 'acf-frontend-form-element' ),
					'Update Image' => __( 'Update Image', 'acf-frontend-form-element' ),
					'All images'   => __( 'All', 'acf-frontend-form-element' ),
				)
			);
		}

		function upload_button_text_setting( $field ) {
			acf_render_field_setting(
				$field,
				array(
					'label'       => __( 'Button Text' ),
					'name'        => 'button_text',
					'type'        => 'text',
					'placeholder' => __( 'Add Image', 'acf-frontend-form-element' ),
				)
			);
		}


		/*
		*  render_field()
		*
		*  Create the HTML interface for your field
		*
		*  @param    $field - an array holding all the field's data
		*
		*  @type    action
		*  @since    3.6
		*  @date    23/01/13
		*/

		function render_field( $field ) {
			if ( empty( $field['field_type'] ) ) {
				$field['field_type'] = 'image';
			}
			if ( empty( $field['preview_size'] ) ) {
				$field['preview_size'] = 'thumbnail';
			}

			// vars
			$uploader = acf_get_setting( 'uploader' );

			$value = $field['value'];
			// enqueue
			if ( $uploader == 'wp' && ! feadmin_edit_mode() ) {
				acf_enqueue_uploader();
			}

			// vars
			$url = '';
			$alt = '';
			$div = array(
				'class'              => 'acf-' . $field['field_type'] . '-uploader',
				'data-preview_size'  => $field['preview_size'],
				'data-library'       => $field['library'],
				'data-mime_types'    => $field['mime_types'],
				'data-uploader'      => $uploader,
				'data-resize_width'  => $field['max_width'],
				'data-resize_height' => $field['max_height'],
			);

			if ( ! empty( $field['button_text'] ) ) {
				$button_text = $field['button_text'];
			} else {
				$button_text = __( 'Add Image', 'acf-frontend-form-element' );

			}

			// has value?
			if ( $value ) {
				// update vars
				$url = wp_get_attachment_image_src( $value, $field['preview_size'] );
				$alt = get_post_meta( $value, '_wp_attachment_image_alt', true );

				// url exists
				if ( $url ) {
					$url = $url[0];
				}

				// url exists
				if ( $url ) {
					$div['class'] .= ' has-value';
				}
			} else {
				$url = wp_mime_type_icon( 'image/png' );
			}

			// get size of preview value
			$size = acf_get_image_size( $field['preview_size'] );

			?>
<div <?php acf_esc_attr_e( $div ); ?>>
			<?php
		
				acf_hidden_input(
					array(
						'data-name' => 'id',
						'name'      => $field['name'],
						'value'     => $value,
					)
				);
			?>
	<div class="show-if-value image-wrap" 
			<?php
			if ( $size['width'] ) :
				?>
		style="<?php echo esc_attr( 'max-width: ' . $size['width'] . 'px' ); ?>"
																  <?php
   endif;
			?>
   >
			<?php
			if ( $uploader != 'basic' ) {
				$edit = 'edit';
			} else {
				?>
				<div class="frontend-admin-hidden uploads-progress"><div class="percent">0%</div><div class="bar"></div></div>
				<?php
				$edit = 'edit-preview';
			}
			?>
		<img data-name="image" src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>"/>
		<!-- <div class="frontend-admin-hidden uploads-progress"><div class="percent">0%</div><div class="bar"></div></div> -->
		<div class="acf-actions -hover">
			<a class="acf-icon -pencil dark" data-name="<?php esc_attr_e( $edit ); ?>" href="#" title="<?php esc_attr_e( 'Edit', 'acf-frontend-form-element' ); ?>"></a>
			<a class="acf-icon -cancel dark" data-name="remove" href="#" title="<?php esc_attr_e( 'Remove', 'acf-frontend-form-element' ); ?>"></a>
		</div>
	</div>
	<div class="hide-if-value">
			<?php
			$empty_text = __( 'No file selected', 'acf-frontend-form-element' );
			if ( isset( $field['no_file_text'] ) ) {
				$empty_text = $field['no_file_text'];
			}
			if ( $uploader == 'basic' ) :
				?>
			<label class="acf-basic-uploader file-drop">
						  <?php
							$input_args = array(
								'name'  => 'file_input',
								'id'    => $field['id'],
								'class' => 'image-preview',
							);
							if ( $field['field_type'] == 'image' ) {
								 $input_args['accept'] = 'image/*';
							}
							if ( $field['mime_types'] ) {
									 $input_args['accept'] = $field['mime_types'];
							}
							acf_file_input( $input_args );
							?>
				<div class="file-custom">
				<?php echo esc_html( $empty_text ); ?>
					<div class="acf-button button">
				<?php echo esc_html( $button_text ); ?>
					</div>
				</div>
			</label>
				<?php
				$prefix = 'acff[file_data][' . $field['key'] . ']';
				fea_instance()->form_display->render_meta_fields( $prefix, $value );
				?>
	<?php else : ?>
			<p><?php echo esc_html_e( $empty_text ); ?> <a data-name="add" class="acf-button button" href="#"><?php esc_html_e( $button_text ); ?></a></p>
			
	<?php endif; ?>
			
	</div>
</div>
			<?php

		}



		/*
		*  render_field_settings()
		*
		*  Create extra options for your field. This is rendered when editing a field.
		*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
		*
		*  @type    action
		*  @since    3.6
		*  @date    23/01/13
		*
		*  @param    $field    - an array holding all the field's data
		*/

		function render_field_settings( $field ) {
			// clear numeric settings
			$clear = array(
				'min_width',
				'min_height',
				'min_size',
				'max_width',
				'max_height',
				'max_size',
			);

			foreach ( $clear as $k ) {

				if ( empty( $field[ $k ] ) ) {

					$field[ $k ] = '';

				}
			}

			acf_render_field_setting(
				$field,
				array(
					'label'        => __( 'Default Value', 'acf-frontend-form-element' ),
					'instructions' => __( 'Appears when creating a new post', 'acf-frontend-form-element' ),
					'type'         => 'image',
					'name'         => 'default_value',
				)
			);
			// return_format
			acf_render_field_setting(
				$field,
				array(
					'label'        => __( 'Return Value', 'acf-frontend-form-element' ),
					'instructions' => __( 'Specify the returned value on front end', 'acf-frontend-form-element' ),
					'type'         => 'radio',
					'name'         => 'return_format',
					'layout'       => 'horizontal',
					'choices'      => array(
						'array' => __( 'Image Array', 'acf-frontend-form-element' ),
						'url'   => __( 'Image URL', 'acf-frontend-form-element' ),
						'id'    => __( 'Image ID', 'acf-frontend-form-element' ),
					),
				)
			);

			// preview_size
			acf_render_field_setting(
				$field,
				array(
					'label'        => __( 'Preview Size', 'acf-frontend-form-element' ),
					'instructions' => __( 'Shown when entering data', 'acf-frontend-form-element' ),
					'type'         => 'select',
					'name'         => 'preview_size',
					'choices'      => acf_get_image_sizes(),
				)
			);

			// library
			acf_render_field_setting(
				$field,
				array(
					'label'        => __( 'Library', 'acf-frontend-form-element' ),
					'instructions' => __( 'Limit the media library choice', 'acf-frontend-form-element' ),
					'type'         => 'radio',
					'name'         => 'library',
					'layout'       => 'horizontal',
					'choices'      => array(
						'all'        => __( 'All', 'acf-frontend-form-element' ),
						'uploadedTo' => __( 'Uploaded to post', 'acf-frontend-form-element' ),
					),
				)
			);

			// min
			acf_render_field_setting(
				$field,
				array(
					'label'        => __( 'Minimum', 'acf-frontend-form-element' ),
					'instructions' => __( 'Restrict which images can be uploaded', 'acf-frontend-form-element' ),
					'type'         => 'text',
					'name'         => 'min_width',
					'prepend'      => __( 'Width', 'acf-frontend-form-element' ),
					'append'       => 'px',
				)
			);

			acf_render_field_setting(
				$field,
				array(
					'label'   => '',
					'type'    => 'text',
					'name'    => 'min_height',
					'prepend' => __( 'Height', 'acf-frontend-form-element' ),
					'append'  => 'px',
					'_append' => 'min_width',
				)
			);

			acf_render_field_setting(
				$field,
				array(
					'label'   => '',
					'type'    => 'text',
					'name'    => 'min_size',
					'prepend' => __( 'Image size', 'acf-frontend-form-element' ),
					'append'  => 'MB',
					'_append' => 'min_width',
				)
			);

			// max
			acf_render_field_setting(
				$field,
				array(
					'label'        => __( 'Maximum', 'acf-frontend-form-element' ),
					'instructions' => __( 'Restrict which images can be uploaded', 'acf-frontend-form-element' ),
					'type'         => 'text',
					'name'         => 'max_width',
					'prepend'      => __( 'Width', 'acf-frontend-form-element' ),
					'append'       => 'px',
				)
			);

			acf_render_field_setting(
				$field,
				array(
					'label'   => '',
					'type'    => 'text',
					'name'    => 'max_height',
					'prepend' => __( 'Height', 'acf-frontend-form-element' ),
					'append'  => 'px',
					'_append' => 'max_width',
				)
			);

			acf_render_field_setting(
				$field,
				array(
					'label'   => '',
					'type'    => 'text',
					'name'    => 'max_size',
					'prepend' => __( 'Image size', 'acf-frontend-form-element' ),
					'append'  => 'MB',
					'_append' => 'max_width',
				)
			);

			// allowed type
			acf_render_field_setting(
				$field,
				array(
					'label'        => __( 'Allowed file types', 'acf-frontend-form-element' ),
					'instructions' => __( 'Comma separated list. Leave blank for all types', 'acf-frontend-form-element' ),
					'type'         => 'text',
					'name'         => 'mime_types',
				)
			);

		}


		/*
		*  format_value()
		*
		*  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
		*
		*  @type    filter
		*  @since    3.6
		*  @date    23/01/13
		*
		*  @param    $value (mixed) the value which was loaded from the database
		*  @param    $post_id (mixed) the $post_id from which the value was loaded
		*  @param    $field (array) the field array holding all the field options
		*
		*  @return    $value (mixed) the modified value
		*/

		function format_value( $value, $post_id, $field ) {
			// bail early if no value
			if ( empty( $value ) ) {
				return false;
			}

			// bail early if not numeric (error message)
			if ( ! is_numeric( $value ) ) {
				return false;
			}

			// convert to int
			$value = intval( $value );

			// format
			if ( $field['return_format'] == 'url' ) {

				return wp_get_attachment_url( $value );

			} elseif ( $field['return_format'] == 'array' ) {

				return acf_get_attachment( $value );

			}

			// return
			return $value;

		}


	}




endif; // class_exists check

?>
