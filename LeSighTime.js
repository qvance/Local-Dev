$(document).ready(function(){ 
						   
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

    $("#Current").on("change", "#Stat1", function() {

    	var statusselected = $(this).val();
		if (statusselected == "Deployed") {

			$('#AN').prop('disabled', false);
			$('#Prim').prop('disabled', false);
    		$('#Deployed').prop('disabled', false);

    	} else {

			$('#AN').prop('disabled', true);
    		$('#Prim').prop('disabled', true);
    		$('#Deployed').prop('disabled', true);

    	}

    });
            
});

	
