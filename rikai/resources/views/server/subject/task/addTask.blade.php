<tr id='{{$task->id}}'>
<td>{{$task->id}}</td>
<td><a href=""> {{$task->name}}</a></td>
<td> {{$task->detail}}</td>
<td>
  <button type="button" class="btn btn-block bg-gradient-info btn-xs"><a href="{{route('server.subject.task.show',[$id,$task->id])}}">Edit</a></button>
  <form method="post" action="{{route('server.subject.task.destroy',[$id,$task->id])}}">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="btn btn-block bg-gradient-danger btn-xs">
      <i data-feather="delete">Delete</i>
    </button>
  </form>
</td>
</tr>