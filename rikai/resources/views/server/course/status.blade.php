@if($subject->status == Status::Start)
    <button type="button" data_c="{{$subject->course_id}}" data_s="{{$subject->subject_id}}" class="btn btn-block btn-outline-success btn-sm status">Start</button>
    @else
    <button type="button" data_c="{{$subject->course_id}}" data_s="{{$subject->subject_id}}" class="btn btn-block btn-outline-danger btn-sm status">Finish</button>
    @endif