$(document).ready(function(){
	$.ajaxSetup({
	    headers:
	    {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});


	$(".checkStatus").change(function() {
		var	id = $(this).attr('data_id')
		console.log(id)
        
        $.ajax({
            type:'POST',
            url:'/subject/task/status',
            data:{
              'id':id,
            },
            success:function (data) {
            
            },
            error: function (e) {
                    console.log((e.responseJSON.errors));
                }
    	}, "json");
        
        
    });
});