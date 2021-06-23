@extends('server.layouts.master')
@section('ui')
@include('server.layouts.ui')
@endsection

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          @if (session('msg'))
          <div class="alert alert-success">
            {{session('msg')}}
          </div>
          @endif 
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{$course->name}}</h3>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                <table  class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>{{__('views.subject')}}</th>
                      <th>{{__('views.started_at')}}</th>
                      <th>{{__('views.status')}}</th>
                      <th>{{__('views.action')}}</th>
                    </tr>
                  </thead>
                  <tbody id="subjectTable" courseId="{{$course->id}}">
                    
                    @foreach($course->subject as $subject)
                    
                    <tr id='{{$subject->id}}'>
                      <td>{{$subject->id}}</td>
                      <td><a href=""> {{$subject->name}}</a></td>
                      <td> {{$subject->pivot->started_at}}</td>
                      <td id="status_{{$subject->id}}">@if($subject->pivot->status == Status::Start)
                        <button type="button" data_c="{{$course->id}}" data_s="{{$subject->id}}" class="btn btn-block btn-outline-success btn-sm status">{{__('views.start')}}</button>
                        @else
                        <button type="button" data_c="{{$course->id}}" data_s="{{$subject->id}}" class="btn btn-block btn-outline-danger btn-sm status">{{__('views.finish')}}</button>
                        @endif
                      </td>
                      <td>
                        <button type="button" class="btn btn-block bg-gradient-info btn-xs"><a href="{{route('server.course.subject.show',[$course->id,$subject->id])}}">{{__('views.edit')}}</a></button>
                        <form method="post" action="{{route('server.course.subject.destroy',[$course->id,$subject->id])}}">
                          @csrf
                          <input type="hidden" name="_method" value="DELETE">
                          <button type="submit" class="btn btn-block bg-gradient-danger btn-xs">
                            <i data-feather="delete">{{__('views.delete')}}</i>
                          </button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
             
              <!-- /.card-body -->
              
              <!-- form start -->
              <form id="AddSubject" courseId="{{$course->id}}" method="post" action="{{route('server.course.subject.store',[$course->id])}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>{{__('views.select')}}</label>
                    <select name="subject" class="form-control">
                      @foreach ($subjects as $subject)
                      <option value="{{$subject['id']}}">{{$subject['name']}}</option>
                      @endforeach
                    </select>
                 </div>
                  
                  @error('subject')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <!-- Date -->
                  <div class="form-group">
                    <label>{{__('views.date')}}</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <input type="text" name="started_at" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                  </div>
                  @error('started_at')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{__('views.add')}}</button>
                </div>
              </form>
            </div>
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --> 
@endsection


@section('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@include('i18n')
@include('server.layouts.datePicker')
<script src="{{ asset('templates/dist/js/subject.js') }}"></script>

@endsection