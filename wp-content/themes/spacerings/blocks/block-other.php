<div class="sciencemag-citation-block">
	<div class="citation-favicon">
		<?php
    $block = block_config();
    $icon  = $block['icon'];
    $icons = block_lab_get_icons();
    if ( isset( $icons[ $icon ] ) ) {
    	echo $icons[ $icon ];
    }
    ?>
	</div>
	<div class="citation-text">
		<p><?php block_field( 'citation' ); ?></p>
	</div>
</div>
