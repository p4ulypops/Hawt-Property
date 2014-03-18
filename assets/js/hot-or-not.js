$(document).ready(function(e) {
	if ($('.archivelistingContianer').exists()) {
		$('.archivelistingContianer').first().removeClass('hideme');
		setupVote($('.archivelistingContianer').first().data('votehash'));
	}
	
	$('main').height($(window).height());
	$('.flipper').height($(window).height() * .5);
	
	function setupVote(hash) {
		$('#propid').val(hash);
	}
	
	$('.votebuttons').click(function() {
		var power = $(this).data('level');
		var objID = $('#propid').val();
		var theURL = '/vote/index/' + objID + '/' + power;
		console.log(theURL);
		$.ajax({
			url: theURL,
		//	dataType: 'jsonp',
			
		}).done(function(data) {
			var proccessedData = window.JSON.parse(data);
			console.log(proccessedData);
			$('.archivelistingContianer').first().fadeOut('fast').remove();
			$('.archivelistingContianer').first().fadeIn('fast');
			
			setupVote($('.archivelistingContianer').first().data('votehash'));
			
		}).fail(function(jqXHR, textStatus, errorThrown) {
			console.log(jqXHR, textStatus, errorThrown);
		});;
		
		
	});
	
	
});

$(window).resize(function(e) {
	$('.flipper').height($(window).height() * .5);
});