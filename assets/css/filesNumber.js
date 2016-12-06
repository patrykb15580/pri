numFiles = $("input:files")[0].files.length;
$('.files-number').html("(" + numFiles + ")");

$('#form-page-file-button').change(function(){
	numFiles = $("input:files")[0].files.length;
	$('.files-number').html("(" + numFiles + ")");
});