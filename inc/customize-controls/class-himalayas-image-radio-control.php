<?php
/**
 * Extend WP_Customize_Control for radio image control.
 *
 * Class HIMALAYAS_Image_Radio_Control
 *
 * @since 1.1.9
 */

class HIMALAYAS_Image_Radio_Control extends WP_Customize_Control {

	public function render_content() {

		if ( empty( $this->choices ) ) {
			return;
		}

		$name = '_customize-radio-' . $this->id;

		?>
		<style>
			#himalayas-img-container .himalayas-radio-img-img {
				border: 3px solid #DEDEDE;
				margin: 0 5px 5px 0;
				cursor: pointer;
				border-radius: 3px;
				-moz-border-radius: 3px;
				-webkit-border-radius: 3px;
			}

			#himalayas-img-container .himalayas-radio-img-selected {
				border: 3px solid #AAA;
				border-radius: 3px;
				-moz-border-radius: 3px;
				-webkit-border-radius: 3px;
			}

			input[type=checkbox]:before {
				content: '';
				margin: -3px 0 0 -4px;
			}
		</style>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<ul class="controls" id='himalayas-img-container'>
			<?php
			foreach ( $this->choices as $value => $label ) :
				$class = ( $this->value() == $value ) ? 'himalayas-radio-img-selected himalayas-radio-img-img' : 'himalayas-radio-img-img';
				?>
				<li style="display: inline;">
					<label>
						<input <?php $this->link(); ?>style='display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link();
						checked( $this->value(), $value ); ?> />
						<img src='<?php echo esc_html( $label ); ?>' class='<?php echo $class; ?>' />
					</label>
				</li>
			<?php
			endforeach;
			?>
		</ul>
		<script type="text/javascript">

			jQuery( document ).ready( function ( $ ) {
				$( '.controls#himalayas-img-container li img' ).click( function () {
					$( '.controls#himalayas-img-container li' ).each( function () {
						$( this ).find( 'img' ).removeClass( 'himalayas-radio-img-selected' );
					} );
					$( this ).addClass( 'himalayas-radio-img-selected' );
				} );
			} );

		</script>
		<?php
	}
}
