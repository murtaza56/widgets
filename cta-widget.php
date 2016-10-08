<?php 
// Register Homepage Call to Action
genesis_register_sidebar( array(
	'id'		=> 'homepage-cta',
	'name'	=> __('Homepage Call to Action', 'jessica'),
	'description'		=> __('Create a Homepage Call to Action', 'jessica'),
	)
);
// Call to Action Widget
class Call_to_Action extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'calltoaction',
			__( 'Homepage Call to Action', 'jessica' ),
			array(
				'description' => __( 'Add a Call to Action to the homepage.', 'jessica' ),
				'classname'   => 'call-to-action',
			)
		);
	}
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', empty( $instance['cta_widget_title'] ) ? '' : $instance['cta_widget_title'], $instance, $this->id_base );
		$text  = apply_filters( 'widget_text',  empty( $instance['cta_widget_textarea']  ) ? '' : $instance['cta_widget_textarea'],  $instance );
		$url   = apply_filters( 'widget_url', empty( $instance['cta_widget_url'] ) ? '' : $instance['cta_widget_url'], $instance ); 
		$button = apply_filters( 'widget_button', empty( $instance['cta_widget_button'] ) ? '' : $instance['cta_widget_button'], $instance ); ?>
		
		<section class="home-cta clear">
			<div class="wrap">
				<div class="cta-text">
				<?php if ( ! empty( $title ) ) : echo '<h3>' . $title . '</h3>'; endif; ?>
				<?php echo '<p>' . $text . '</p>'; ?>
				</div>
				<a class="cta-button" href="<?php echo $url; ?>" target="_blank"><span><?php echo $button; ?></span></a>
			</div>
		</section>
	<?php }
	public function form( $instance ) {
		// Set default values
		$instance = wp_parse_args( (array) $instance, array( 
			'cta_widget_title' => '',
			'cta_widget_textarea' => '',
			'cta_widget_url' => '',
			'cta_widget_button' => '',
		) );
		// Retrieve an existing value from the database
		$cta_widget_title = !empty( $instance['cta_widget_title'] ) ? $instance['cta_widget_title'] : '';
		$cta_widget_textarea = !empty( $instance['cta_widget_textarea'] ) ? $instance['cta_widget_textarea'] : '';
		$cta_widget_url = !empty( $instance['cta_widget_url'] ) ? $instance['cta_widget_url'] : '';
		$cta_widget_button = !empty( $instance['cta_widget_button'] ) ? $instance['cta_widget_button'] : '';
		// Form fields
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'cta_widget_title' ) . '" class="cta_widget_title_label">' . __( 'Title', 'jessica' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'cta_widget_title' ) . '" name="' . $this->get_field_name( 'cta_widget_title' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'jessica' ) . '" value="' . esc_attr( $cta_widget_title ) . '">';
		echo '</p>';
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'cta_widget_textarea' ) . '" class="cta_widget_textarea_label">' . __( 'Content', 'jessica' ) . '</label>';
		echo '	<textarea id="' . $this->get_field_id( 'cta_widget_textarea' ) . '" name="' . $this->get_field_name( 'cta_widget_textarea' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'jessica' ) . '">' . $cta_widget_textarea . '</textarea>';
		echo '</p>';
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'cta_widget_url' ) . '" class="cta_widget_url_label">' . __( 'Button Link', 'jessica' ) . '</label>';
		echo '	<input type="url" id="' . $this->get_field_id( 'cta_widget_url' ) . '" name="' . $this->get_field_name( 'cta_widget_url' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'jessica' ) . '" value="' . esc_attr( $cta_widget_url ) . '">';
		echo '</p>';
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'cta_widget_button' ) . '" class="cta_widget_button_label">' . __( 'Button Text', 'jessica' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'cta_widget_button' ) . '" name="' . $this->get_field_name( 'cta_widget_button' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'jessica' ) . '" value="' . esc_attr( $cta_widget_button ) . '">';
		echo '</p>';
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['cta_widget_title'] = !empty( $new_instance['cta_widget_title'] ) ? strip_tags( $new_instance['cta_widget_title'] ) : '';
		$instance['cta_widget_textarea'] = !empty( $new_instance['cta_widget_textarea'] ) ? strip_tags( $new_instance['cta_widget_textarea'] ) : '';
		$instance['cta_widget_url'] = !empty( $new_instance['cta_widget_url'] ) ? strip_tags( $new_instance['cta_widget_url'] ) : '';
		$instance['cta_widget_button'] = !empty( $new_instance['cta_widget_button'] ) ? strip_tags( $new_instance['cta_widget_button'] ) : '';
		return $instance;
	}
}
function cta_register_widgets() {
	register_widget( 'Call_to_Action' );
}
add_action( 'widgets_init', 'cta_register_widgets' );