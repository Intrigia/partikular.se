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
    $papertitle = block_value( 'papertitle' );
    $volume = block_value( 'volume' );
    $issue = block_value( 'issue' );
    $year = block_value( 'year' );
    $pagenr = block_value( 'pagenr' );
    $url = block_value( 'url' );
    $getdate = block_value( 'getdate' );

    if ( ! empty( $authors ) ) {
        echo ucwords($authors) . ". ";
    }
    if ( ! empty( $papertitle ) ) {
        echo $papertitle . ". ";
    }
    if ( ! empty( $title ) ) {
        echo "<i>" . $title . "</i>. ";
    }
    if ( ! empty( $volume ) ) {
        echo "Vol. " . $volume . ", ";
    }
    if ( ! empty( $issue ) ) {
        echo $issue . ", ";
    }
    if ( ! empty( $year ) ) {
        echo $year . ": ";
    }
    if ( ! empty( $pagenr ) ) {
        echo $pagenr . ". ";
    }
    if ( ! empty( $url ) ) {
        echo '<a target="_blank" href="' . $url . '">' . $url . "</a>";
        if ( ! empty( $getdate ) ) {
            echo " (Hämtad " . $getdate . ")";
        }
        echo ".";
    }
    ?></p>
	</div>
</div>
