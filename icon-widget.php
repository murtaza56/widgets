<?php 
// Register Homepage Icons
genesis_register_sidebar( array(
	'id'		=> 'homepage-icons',
	'name'	=> __('Homepage Icons', 'jessica'),
	'description'		=> __('Create Homepage Icon Textareas - These should be added in groups of three.', 'jessica'),
	)
);
class Homepage_Icon extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'homepageicon',
			__( 'Homepage Icon', 'jessica' ),
			array(
				'description' => __( 'Add Icon Textareas to the homepage.', 'jessica' ),
				'classname'   => 'home-icon',
			)
		);
	}
	public function widget( $args, $instance ) {
				$title = apply_filters( 'widget_title', empty( $instance['icon_widget_title'] ) ? '' : $instance['icon_widget_title'], $instance, $this->id_base );
				$text  = apply_filters( 'widget_textarea',  empty( $instance['icon_widget_textarea']  ) ? '' : $instance['icon_widget_textarea'],  $instance );
				$fa = apply_filters( 'widget_fa', empty( $instance['icon_widget_fa'] ) ? '' : $instance['icon_widget_fa'], $instance ); ?>
		
				<div class="icon-text">
					<h2>
						<span class="fa <?php echo $fa; ?>"></span>
						<?php echo $title; ?>
					</h2>
					<p><?php echo $text; ?></p>
				</div>
		
			<?php 
	}
	public function form( $instance ) {
		// Set default values
		$instance = wp_parse_args( (array) $instance, array( 
			'icon_widget_title' => '',
			'icon_widget_fa' => '',
			'icon_widget_textarea' => '',
		) );
		// Retrieve an existing value from the database
		$icon_widget_title = !empty( $instance['icon_widget_title'] ) ? $instance['icon_widget_title'] : '';
		$icon_widget_fa = !empty( $instance['icon_widget_fa'] ) ? $instance['icon_widget_fa'] : '';
		$icon_widget_textarea = !empty( $instance['icon_widget_textarea'] ) ? $instance['icon_widget_textarea'] : '';
		// Form fields
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'icon_widget_title' ) . '" class="icon_widget_title_label">' . __( 'Title', 'jessica' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'icon_widget_title' ) . '" name="' . $this->get_field_name( 'icon_widget_title' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'jessica' ) . '" value="' . esc_attr( $icon_widget_title ) . '">';
		echo '</p>';
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'icon_widget_fa' ) . '" class="icon_widget_fa_label">' . __( 'Icon', 'jessica' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'icon_widget_fa' ) . '" name="' . $this->get_field_name( 'icon_widget_fa' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'jessica' ) . '" value="' . esc_attr( $icon_widget_fa ) . '">';
		echo '	<span class="description">' . __( 'Ex: fa-heart - Find an icon on <a href="http://fontawesome.io/icons/" target="_blank">fontawesome.io</a>', 'jessica' ) . '</span>';
		echo '</p>';
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'icon_widget_textarea' ) . '" class="icon_widget_textarea_label">' . __( 'Content', 'jessica' ) . '</label>';
		echo '	<textarea id="' . $this->get_field_id( 'icon_widget_textarea' ) . '" name="' . $this->get_field_name( 'icon_widget_textarea' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'jessica' ) . '">' . $icon_widget_textarea . '</textarea>';
		echo '</p>';
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['icon_widget_title'] = !empty( $new_instance['icon_widget_title'] ) ? strip_tags( $new_instance['icon_widget_title'] ) : '';
		$instance['icon_widget_fa'] = !empty( $new_instance['icon_widget_fa'] ) ? strip_tags( $new_instance['icon_widget_fa'] ) : '';
		$instance['icon_widget_textarea'] = !empty( $new_instance['icon_widget_textarea'] ) ? strip_tags( $new_instance['icon_widget_textarea'] ) : '';
		return $instance;
	}
}
function icon_register_widgets() {
	register_widget( 'Homepage_Icon' );
}
add_action( 'widgets_init', 'icon_register_widgets' );