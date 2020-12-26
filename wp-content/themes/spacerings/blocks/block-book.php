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
		<p><?php
    $authors = block_value( 'authors' );
    $title = block_value( 'title' );
    $edition = block_value( 'edition' );
    $location = block_value( 'location' );
    $publisher = block_value( 'publisher' );
    $year = block_value( 'year' );

    if ( ! empty( $authors ) ) {
        echo ucwords($authors) . " ; ";
    }
    if ( ! empty( $title ) ) {
        echo "<i>" . $title . "</i>; ";
    }
    if ( ! empty( $edition ) ) {
        echo $edition . " upplagan ; ";
    }
    if ( ! empty( $location ) ) {
        echo ucfirst($location) . " ";
    }
    if ( ! empty( $publisher ) ) {
        echo $publisher;
    }
    if ( ! empty( $year ) ) {
        echo ", " . $year . ".";
    }
    ?></p>
	</div>
</div>
