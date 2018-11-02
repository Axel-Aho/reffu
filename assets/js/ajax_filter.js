'use strict';

var $ = require('jquery');


$(document).on('ready',function(){

	$('.filters').click(function(e){
		e.preventDefault();
        var filter = $(this).attr('value');
		$.ajax({
			url: ajaxadress.ajaxurl,
            data: {
                action: 'filter_ajax_function',
                id: filter,
            },
			type: 'POST',
			contentType: 'application/x-www-form-urlencoded',
	
			success:function(result){
				$('#response').html(result); // insert data
            },
		}); console.log(data);
		return false;
    });
    
    $('.calendar_day').click(function(e){
        e.preventDefault();
        var postday = $(this).attr('value');
		$.ajax({
			url: ajaxadress.ajaxurl,
            data: {
                action: 'calendar_ajax_function',
                value: postday,
            },
			type: 'POST',
			contentType: 'application/x-www-form-urlencoded',
	
			success:function(result){
				$('#date').html(result); // insert data
            },
		});
		return false;
    });

    $(".calendar_day").click(function() { //select by class
        var clicked = $(this);
      
        if (clicked.hasClass('toggle')) {
          $('.calendar_day').removeClass('disabled'); //enable all again  
          clicked.removeClass('toggle');
        } else {
         $('.calendar_day').removeClass('toggle');
          clicked.addClass('toggle');
          clicked.removeClass('disabled');
          $('.calendar_day').not(clicked).addClass('disabled'); //disable everything except clicked element
        }
      });
      
});