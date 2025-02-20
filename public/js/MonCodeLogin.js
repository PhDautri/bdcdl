$(document).ready(function() {

	// ouvre la modal demande d'accés//

	$(document).on('click', 'button[data-role=RequestAccess]', function(){

		$('#RequestAccess').modal('show'); // ouvre la modal		
            
    });
    

    // ferme le H3 au bout de 3sec //    

    if ($('h3').is(':visible') == true) {

    	// le H3 et visible //
    	
    	setTimeout(function(){ $('h3').hide();}, 3000);

    } 


})