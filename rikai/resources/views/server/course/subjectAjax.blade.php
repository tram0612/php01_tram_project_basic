<tr>
  <td>{{$subject->id}}</td>
  <td><a href=""> {{$subject->name}}</a></td>
  <td> {{$req->startedAt}}</td>
  <td id="status_{{$subject->id}}">@if($status == Status::Start)
    <button type="button" data_c="{{$courseId}}" data_s="{{$subject->id}}" class="btn btn-block btn-outline-success btn-sm status">{{__('views.start')}}</button>
    @else
    <button type="button" data_c="{{$courseId}}" data_s="{{$subject->id}}" class="btn btn-block btn-outline-danger btn-sm status">{{__('views.finish')}}</button>
    @endif
  </td>
  <td>
    <button type="button"  class="btn btn-block bg-gradient-info btn-xs"><a href="">{{__('views.edit')}}</a></button>
    <form method="POST" action="{{route('server.course.subject.destroy',[$courseId,$subject->id])}}">
      @csrf
      <input type="hidden" name="_method" value="DELETE">
      <button type="submit" class="btn btn-block bg-gradient-danger btn-xs">
        <i data-feather="delete">{{__('views.delete')}}</i>
      </button>
    </form>
  </td>
</tr>
<script src="{{ asset('templates/dist/js/subject.js') }}"></script>