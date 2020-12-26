<div class="sciencemag-citation-block">
	<div class="citation-favicon">
		<?php
    $url = block_value( 'url' );
    if ( ! empty( $url ) ) {
      $parse = parse_url(block_field( 'url', false ));
      echo '<img src="' . 'https://s2.googleusercontent.com/s2/favicons?domain=' . $parse['host'] . '">';
    } else {
      $block = block_config();
      $icon  = $block['icon'];
      $icons = block_lab_get_icons();
      if ( isset( $icons[ $icon ] ) ) {
      	echo $icons[ $icon ];
      }
    }
    ?>
	</div>
	<div class="citation-text">
    <p><?php
    $author = block_value( 'author' );
    $title = block_value( 'title' );
    $owner = block_value( 'owner' );
    $changedate = block_value( 'changedate' );
    $getdate = block_value( 'getdate' );

    if ( ! empty( $author ) ) {
        echo $author . "; ";
    }
    if ( ! empty( $title ) ) {
        echo "<i>" . $title . "</i>; ";
    }
    if ( ! empty( $owner ) ) {
        echo $owner . " ; ";
    }
    if ( ! empty( $changedate ) ) {
        echo $changedate . "; ";
    }
    if ( ! empty( $url ) ) {
        echo '<a target="_blank" href="' . $url . '">' . $url . "</a>, ";
    }
    if ( ! empty( $getdate ) ) {
        echo $getdate . ".";
    }
    ?></p>
	</div>
</div>
