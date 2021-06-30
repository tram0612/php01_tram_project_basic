$(document).ready(function(){
	$.ajaxSetup({
	    headers:
	    {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});


	$(".finish").change(function() {
		var	id = $(this).attr('data_id')
		console.log(id)
        if($(this).is(":checked")) { 
            $.ajax({
	            type:'POST',
	            url:'/server/course/finish',
	            data:{
	              'id':id,
	              'finish':1,
	            },
	            success:function (data) {
	            
	            },
	            error: function (e) {
	                    console.log((e.responseJSON.errors));
	                }
        	}, "json");
        } else {
            $.ajax({
	            type:'POST',
	            url:'/server/course/finish',
	            data:{
	              'id':id,
	              'finish':0,
	            },
	            success:function (data) {
	              
	            },
	            error: function (e) {
	                    console.log((e.responseJSON.errors));
	                }
	        }, "json");
        }
    });
});