$(document).ready(function(){
	$.ajaxSetup({
	    headers:
	    {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});


	$(".checkStatus").change(function() {
        var route = $(this).attr('route')
        $.ajax({
            type:'GET',
            url:route,
            data:{
            },
            success:function (data) {
            },
            error: function (e) {
                    console.log((e.responseJSON.errors));
                }
    	}, "json");
    });
    $(".delete").click(function(e) {
        var route = $(this).attr('route')
        $(this).closest('li').remove()
        $.ajax({
            type:'DELETE',
            url:route,
            data:{
            },
            success:function (data) {
              $('#'+task_id).append(data.html)
            },
            error: function (xhr) {
                    console.log(xhr.responseText);
                }
        }, "json");
    });

    $(".addUserTask").click(function(e) {
        
        let route = $(this).attr('route')
        let comment = $(this).closest('div').find('input[name="task"]').val()
        let task_id = $(this).attr('task_id')
        console.log(comment);
        
        if(comment===''){
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
                  $('#'+task_id).append(data.html)
                },
                error: function (xhr) {
                        console.log(xhr.responseText);
                    }
            }, "json");
        }

    });

    $( ".comment" ).on("keydown", function(event) {
        if(event.which == 13) {
            var comment = $(this).val();
            var route = $(this).attr('route')
            if(comment==''){
                alert(trans('views.oop!'));
            }
            else{
                $.ajax({
                type:'PATCH',
                url:route,
                data:{
                  'comment':comment,
                },
                success:function (data) {
                },
                error: function (xhr) {
                        console.log(xhr.responseText);
                    }
            }, "json");
            }
        }
    });
});