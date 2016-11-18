function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
        	$('.avatar-big').fadeOut(function(){
	        	$('.avatar-preview').fadeOut(function(){
	        		$('.avatar-preview').attr('src', e.target.result);
	        		$('.avatar-preview').fadeIn();
	        	});
			});
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function(){
	$("#form-page-file-button").change(function(){
		readURL(this);
	});
});