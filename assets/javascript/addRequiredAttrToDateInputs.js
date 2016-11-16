$(document).ready(function() {
	$(':radio').change(function(){
		if ($('[value=0]').is(':checked')) { 
			$('.datepick').attr('required', true);
		} else {
			$('.datepick').removeAttr('required');
		}
	});
});