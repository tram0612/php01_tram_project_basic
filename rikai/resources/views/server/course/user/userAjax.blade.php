<tr>
    <td>
        {{$user->id}}
    </td>
    <td>
        <a>
            {{$user->name}}
        </a>
    </td>
    <td>
      <img alt="Avatar" class="table-avatar" src="/upload/{{$user->avatar}}">
    </td>
    @if($user->role==UserRole::Trainee)
    <td class="project-state">
        <a class="btn btn-primary btn-sm" href="#">
            <i class="fas fa-folder">
            </i>
            Progress
        </a>
    </td>
    @endif
    <td class="project-actions text-right">
      <form method="post" action="{{route('server.course.delUser',[$req->courseId,$req->userId])}}">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="btn btn-block bg-gradient-danger btn-xs">
          <i data-feather="delete">Delete</i>
        </button>
      </form>
        
    </td>
</tr>