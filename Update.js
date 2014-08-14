$(document).ready(function() {
	
	$('.fieldcheck').click(function() {

		var self = $(this).attr("name");
		if ($('#' + 'Mod' + self).prop('disabled') == true) {
		$('#' + 'Mod' + self).prop('disabled', false); 

	}	else {

		$('#' + 'Mod' + self).prop('disabled', true);
}

}); 

});