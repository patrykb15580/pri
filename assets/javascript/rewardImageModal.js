/* HTML for this modal
<img class="reward_image" src="<?= $img_path ?>" data-imageid="<?= $image->id ?>" data-filename="<?= $image->file_name ?>">

<div class="modal-bg">
	<img class="modal-image" src="">
</div>*/

$(document).ready(function(){
	var id = '';
	var file_name = '';

	$('.modal-bg').hide();

	$('.reward_image').click(function(){
		var id = $(this).data('imageid');
		var file_name = $(this).data('filename');

		$('.modal-image').attr('src', '/system/reward_images/' + id + "/large/" + file_name);
		$('.modal-bg').fadeIn();
	});
	$(document).mouseup(function (e){
	    if (!$(".modal-image").is(e.target) && $(".modal-image").has(e.target).length === 0) {
	        $(".modal-bg").fadeOut();
	    }
	});
});