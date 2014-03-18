// JavaScript Document

$(document).ready(function(e) {
	$('#options').find('label, input, select').each(function(index, element) {
			$(this).click(function() {
				if (! $(this).hasClass('opened')) {	
					$(this).parent().find('.deleteMe').fadeIn();
					$(this).parent().addClass('opened');	
				}
			});
	});
	$('.deleteMe').on('click', function() {
		$(this).parent().toggleClass('opened');
		$(this).fadeOut();
	});
	
	$('#openCloseSearch').click(function() {
		$('#options').slideToggle('slow');
		if ($(this).html() == "Open Search Terms") {
			$(this).html("Close Search Terms");
		} else {
			$(this).html("Open Search Terms");	
		}
	});
	
	$("#searchClear").click(function() {
		$.ajax({
			  type: "POST",
			  url: '/ajax/index/',
			  data: {},
			  success: function(data) { 
					//var json = $.parseJSON(data);
					console.log(data); 
					window.location = '/';
				}
			});
	});
	
	$('#searchParams').click(function() {
		var theData = {};
		$('#options').find('.optionBlock.opened').find('input, select').each(function(index, element) {
			theData[$(this).attr('name')] = $(this).val();
		});
		
			console.log(theData);
			
			$.ajax({
			  type: "POST",
			  url: '/ajax/index/',
			  data: theData,
			  success: function(data) { 
					//var json = $.parseJSON(data);
					console.log(data); 
					window.location = '/';
				}
			});
		
	});
});