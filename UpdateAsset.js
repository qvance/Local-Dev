$(document).ready(function() {
	
	$('.fieldcheck').click(function() {

		var self = $(this).attr("name");
		if ($('#' + 'Mod' + self).prop('disabled') == true) {
		$('#' + 'Mod' + self).prop('disabled', false); 

	}	else {

		$('#' + 'Mod' + self).prop('disabled', true);
}

}); 
						   
	$("#Modeled").on("change", "#ModNumber", function() {

		// Below is used for making sure that javascript is running without errors
		//$("div").css("border", "3px solid red");
		
		var selectedOption = $('option:selected', this);
		$('#ModName').val(selectedOption.data('modelname') );
		$('#Manu').val(selectedOption.data('manufacturer') );
        $('#Typical').val(selectedOption.data('type') );
        $('#Proc').val(selectedOption.data('processor') );
        $('#Mem').val(selectedOption.data('memory') );

    })
            
});

