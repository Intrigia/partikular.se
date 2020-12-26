jQuery(function($){ // use jQuery code inside this to avoid "$ is not defined" error
	$('.sciencemag__ajax__loadmore').click(function(){

		var button = $(this),
		    data = {
			'action': 'loadmore',
			'query': sciencemag_loadmore_params.posts, // that's how we get params from wp_localize_script() function
			'page' : sciencemag_loadmore_params.current_page,
			'ishome' : sciencemag_loadmore_params.ishome,
			'iscategory' : sciencemag_loadmore_params.iscategory,
			'isauthor' : sciencemag_loadmore_params.isauthor,
			'issearch' : sciencemag_loadmore_params.issearch
		};
		$.ajax({ // you can also use $.post here
			url : sciencemag_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Laddar...'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) {
					button.text( '+ Ladda fler' ).prev().after(data); // insert new posts
					sciencemag_loadmore_params.current_page++;

					if ( sciencemag_loadmore_params.current_page == sciencemag_loadmore_params.max_page )
						button.remove(); // if last page, remove the button

					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					button.remove(); // if no data, remove the button as well
				}
			}
		});
	});
});
