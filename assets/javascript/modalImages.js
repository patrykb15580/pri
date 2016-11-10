$(document).ready(function(){
	var file_name;
	var image_id;
	$('.reward-details-images').click(function(){
		file_name = $(this).data('filename');
		image_id = $(this).data('imageid');
		$('.reward-details-image').fadeOut(function(){
			$('.reward-details-image').attr('src', '/system/reward_images/' + image_id + '/medium/' + file_name);
			$('.reward-details-image').fadeIn();
		});
	});
});