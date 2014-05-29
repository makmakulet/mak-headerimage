<?php

//do_action( 'media_buttons', 'image_test' ); // second argument is the same as the `<input>` id

wp_enqueue_script( 'tribe-image-widget', $this->plugin_url . 'forms/image-widget.js', array( 'jquery', 'media-upload', 'media-views' ));

wp_localize_script( 'tribe-image-widget', 'TribeImageWidget', array(
        'frame_title' => __( 'Select an Image', 'image_widget' ),
        'button_title' => __( 'Insert Into Widget', 'image_widget' ),
) );
?>

<script src="<?php echo $this->plugin_url;?>forms/image-widget.js"></script>

<div class="uploader">
    <input type="button" class="button" name="uploader_button" id="uploader_button" value="Select an Image" onclick="imageWidget.uploader( 'widget_sp_image-3', 'mak-header-' ); return false;" />
    <div class="tribe_preview" id="mak-header-preview"><br>
        <?php echo $loaded_image;?>
    </div>
    <input type="hidden" id="mak-header-attachment_id" name="attachment_id" value="<?php echo $image_id;?>" />
    <input type="hidden" id="mak-header-imageurl" name="imageurl" value="<?php echo $image_path;?>"/>
</div>