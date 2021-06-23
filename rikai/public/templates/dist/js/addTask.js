$(document).ready(function(){
	$.ajaxSetup({
	    headers:
	    {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});
	$("#AddTask").submit(function(e) {
		e.preventDefault()
		var route = $(this).attr('action')
		var name = $(this).find('input[name="name"]').val()
		var detail = $(this).find('textarea[name="detail"]').val()
		console.log(name);
		console.log(detail);
		if(name=='' || detail=='' ){
			alert(trans('views.oop!'));
		}
		else{
			$(this).find('input[name="name"]').val('')
			$(this).find('textarea[name="detail"]').val('')
			$.ajax({
	            type:'POST',
	            url:route,
	            data:{
	              'name':name,
	              'detail':detail,
	            },
	            success:function (data) {
	            	console.log(data.html)
	              $('#taskTable').append(data.html)
	            },
	            error: function (xhr) {
	                    console.log(xhr.responseText);
	                }
	        }, "json");
		}

	});
});