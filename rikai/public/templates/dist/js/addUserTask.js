$(document).ready(function(){
	$.ajaxSetup({
	    headers:
	    {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});
	$(".addUserTask").click(function(e) {
		
		var route = $(this).attr('route')
		var comment = $(this).closest('div').find('input[name="task"]').val()
		var task_id = $(this).attr('task_id')
		console.log(comment);
		
		if(comment==''){
			alert(trans('views.oop!'));
		}
		else{
			$(this).closest('div').find('input[name="task"]').val('')
			
			$.ajax({
	            type:'POST',
	            url:route,
	            data:{
	              'comment':comment,
	              'task_id':task_id,
	            },
	            success:function (data) {
	            	//console.log(data.html)
	              $('#'+task_id).append(data.html)
	            },
	            error: function (xhr) {
	                    console.log(xhr.responseText);
	                }
	        }, "json");
		}

	});
});