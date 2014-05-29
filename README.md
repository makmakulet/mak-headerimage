mak-headerimage
===============

Wordpress Header Image Selector


How to use
===============

<code>
<?php

    if(class_exists('MakHeaderImageSelection')){
        
        $header_image = MakHeaderImageSelection::renderFrontendOutput($post->ID);
        
        echo ($header_image) ? $header_image : null;
        
}?>
<code>