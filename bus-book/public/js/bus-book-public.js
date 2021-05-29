(function( $ ) {
	'use strict';
	
	jQuery(document).ready(function(){
		jQuery('#bus_booking_form').on('submit', function(e){
	        e.preventDefault();
	        var checked = jQuery("input[type=checkbox]:checked:not(:disabled)").length;

			if(!checked) {
				alert("Please select at least one seat to proceed booking.");
				return false;
			}
	        
	        this.submit();
	    });
    });

})( jQuery );
