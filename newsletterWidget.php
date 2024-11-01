<?php

// Extends WP_Widget
class Adelya_Newsletter_Widget extends WP_Widget {

    // Widget Declaration
	public function __construct()
	{
		parent::__construct('adelya_newsletter', 'Widget Adelya', array('description' => 'Affichage de la newsletter Adelya ou autre shortcode'));
	}
    
    // Widget view front-office
	public function widget($args, $instance)
	{
        echo $args['before_widget'];
        echo $args['before_title'];
        echo apply_filters('widget_title', $instance['title']);
        echo $args['after_title'];
        echo apply_filters('widget_text', $instance['text']);
        echo $args['after_widget'];
    }

    // Widget view in widget section (back-office)
    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $text = isset($instance['text']) ? $instance['text'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?=  $title  ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_name( 'text' ); ?>"><?php _e('Content:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" value='<?=  $text ?>' />
        </p>
        <?php
    }
}

// Initialisation Widget
function register_adelya_widget() {
register_widget( 'Adelya_Newsletter_Widget' );
}