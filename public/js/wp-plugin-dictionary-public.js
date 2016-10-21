(function( $ ) {
	'use strict';

	$(document).ready( function() {

		if( $.isFunction( $('.wp-plugin-dictionary-word').tooltip ) )
			$('.wp-plugin-dictionary-word').tooltip(); // Create tooltips

		$('.wp-plugin-dictionary-word').on('click', function(e) {
			e.preventDefault();
		});

	} );


})( jQuery );