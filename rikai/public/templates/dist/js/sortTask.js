$(document).ready(function(){
	$('#taskTable').sortable({

      stop: function(){
        var ids = '';
        var subjectId =$(this).attr('subjectId');
        $('#taskTable tr').each(function(){
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
              url:'/server/subject/sortTask',
              data:{
                'ids':ids,
                'subjectId':subjectId,
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