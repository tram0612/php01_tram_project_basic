 $(document).ready(function(){
	$.ajaxSetup({
	    headers:
	    {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});
	
	$("#AddSubject").submit(function(e) {
		e.preventDefault()
		var route = $(this).attr('action')
		var subjectId = $(this).find('select[name="subject"]').find('option:selected').val()
		var startedAt = $(this).find('input[name="started_at"]').val()
		console.log(startedAt);
		if(subjectId=='' || startedAt=='' ){
			alert(trans('views.oop!'));
		}
		else{
			$(this).find('select[name="subject"]').find('option:selected').remove();
			$.ajax({
	            type:'POST',
	            url:route,
	            data:{
	              'subjectId':subjectId,
	              'startedAt':startedAt,
	            },
	            success:function (data) {
	            	console.log(data.html)
	              $('#subjectTable').append(data.html)
	            },
	            error: function (xhr) {
	                    console.log(xhr.responseText);
	                }
	        }, "json");
		}

	});
	$(".status").click(function(e) {
		var p ='#'+ $(this).closest('td').attr('id')
		var courseId = $(this).attr('data_c')
		var subjectId = $(this).attr('data_s')
		$.ajax({
	            type:'POST',
	            url:'/server/course/status',
	            data:{
	              'subjectId':subjectId,
	              'courseId':courseId,
	            },
	            success:function (data) {
	            	//console.log(data.html)
	              $(p).html(data.html)
	            },
	            error: function (xhr) {
	                    console.log(xhr.responseText);
	                }
	        }, "json");
	});
	
	$('#subjectTable').sortable({

      stop: function(){
        var ids = '';
        var courseId =$(this).attr('courseId');
        $('#subjectTable tr').each(function(){
          var id = $(this).attr('id');
          if(ids==''){
            ids=id;
          }
          else{
            ids +=','+id;
          }
        })
        //alert(ids);
        $.ajax({
              type:'POST',
              url:'/server/course/sortSubject',
              data:{
                'ids':ids,
                'courseId':courseId,
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