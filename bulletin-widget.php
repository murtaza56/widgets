<?php 
// Register Homepage Call to Action
genesis_register_sidebar( array(
	'id'		=> 'homepage-bulletin',
	'name'	=> __('Homepage Bulletin', 'jessica'),
	'description'		=> __('Create a Homepage Bulletin', 'jessica'),
	)
);
// Bulletin Widget
class Bulletin_Text_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'bulletin_text_widget',
			__( 'Homepage Bulletin', 'jessica' ),
			array(
				'description' => __( 'Add a Bulletin to the homepage.', 'jessica' ),
				'classname'   => 'bulletin_widget',
			)
		);
	}
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', empty( $instance['bulletin_title'] ) ? '' : $instance['bulletin_title'], $instance, $this->id_base );
		$text  = apply_filters( 'widget_text',  empty( $instance['bulletin_textarea']  ) ? '' : $instance['bulletin_textarea'],  $instance ); ?>
		
				<aside class="home-blurb">
					<div class="wrap">
						<p><?php echo $text; ?></p>
					</div>
				</aside>
			<?php
	}
	public function form( $instance ) {
		// Set default values
		$instance = wp_parse_args( (array) $instance, array( 
			'bulletin_title' => 'Bulletin',
			'bulletin_textarea' => '',
		) );
		// Retrieve an existing value from the database
		$bulletin_title = !empty( $instance['bulletin_title'] ) ? $instance['bulletin_title'] : '';
		$bulletin_textarea = !empty( $instance['bulletin_textarea'] ) ? $instance['bulletin_textarea'] : '';
		// Form fields
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'bulletin_title' ) . '" class="bulletin_title_label">' . __( 'Title', 'jessica' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'bulletin_title' ) . '" name="' . $this->get_field_name( 'bulletin_title' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'jessica' ) . '" value="' . esc_attr( $bulletin_title ) . '">';
		echo '	<span class="description">' . __( 'The title does not appear on the homepage.', 'jessica' ) . '</span>';
		echo '</p>';
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'bulletin_textarea' ) . '" class="bulletin_textarea_label">' . __( 'Content', 'jessica' ) . '</label>';
		echo '	<textarea id="' . $this->get_field_id( 'bulletin_textarea' ) . '" name="' . $this->get_field_name( 'bulletin_textarea' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'jessica' ) . '">' . $bulletin_textarea . '</textarea>';
		echo '</p>';
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['bulletin_title'] = !empty( $new_instance['bulletin_title'] ) ? strip_tags( $new_instance['bulletin_title'] ) : '';
		$instance['bulletin_textarea'] = !empty( $new_instance['bulletin_textarea'] ) ? strip_tags( $new_instance['bulletin_textarea'] ) : '';
		return $instance;
	}
}
function bulletin_register_widgets() {
	register_widget( 'Bulletin_Text_Widget' );
}
add_action( 'widgets_init', 'bulletin_register_widgets' );