<li class="{{($task->status == Status::Finish)?'done':''}}">
  <div class="input-group">
    <input route="{{route('task.update',[$task->id])}}" type="text" class="form-control comment" name="comment" value="{{$task->comment}}">
    <input route="{{route('task.edit',[$task->id])}}" class="form-control checkStatus" type="checkbox" {{($task->status == Status::Finish)?'checked':''}} value="" name="">
    <div class="tools">
      <i class="fas fa-trash delete" route="{{route('task.destroy',[$task->id])}}"></i>
    </div>
  </div>
</li>
<script src="{{ asset('templates/dist/js/userTask.js') }}"></script>