$(document).ready(function(){
	var file_name;
	var image_id;
	$('body').on('click', '.reward-details-images', function(){
		file_name = $(this).data('filename');
		image_id = $(this).data('imageid');
		$('.reward-details-image').fadeOut(function(){
			$('.reward-details-image').attr('src', '/system/reward_images/' + image_id + '/big/' + file_name);
			$('.reward-details-image').fadeIn();
		});
	});
});