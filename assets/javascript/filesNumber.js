numFiles = $("#form-page-file-button")[0].files.length;
$('.files-number').html("(" + numFiles + ")");

$('#form-page-file-button').change(function(){
	numFiles = $("#form-page-file-button")[0].files.length;
	$('.files-number').html("(" + numFiles + ")");
});