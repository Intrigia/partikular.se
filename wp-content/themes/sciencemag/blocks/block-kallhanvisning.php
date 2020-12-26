<div class="sciencemag-citation-block">
	<div class="citation-favicon">
		<img src="<?php 
		$parse = parse_url(block_field( 'url', false ));
		echo "https://s2.googleusercontent.com/s2/favicons?domain=" . $parse['host'];?>">
	</div>
	<div class="citation-text">
		<p><?php block_field( 'frfattare' ); ?> . <?php block_field( 'klltitel' ); ?> . <i><?php block_field( 'tidskriftstitel' ); ?> . </i><?php block_field( 'publiceringsdatum' ); ?> . &lt;<a href="<?php block_field( 'url' ); ?>" target="_blank"><?php block_field( 'url' ); ?></a>&gt; (Hämtad <?php block_field( 'hmtningsdatum' ); ?>)</p>
	</div>
</div>