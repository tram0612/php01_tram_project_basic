@extends('server.layouts.master')
@section('title')
{{__('views.course')}}
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
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{__('views.course')}}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>{{__('views.name')}}</th>
                      <th>{{__('views.image')}}</th>
                      <th>{{__('views.finish')}}</th>
                      <th>{{__('views.subject')}}</th>
                      <th>{{__('views.trainee')}}</th>
                      <th>{{__('views.supervisor')}}</th>
                      <th>{{__('views.action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($courses as $course)
                    
                    <tr>
                      <td>{{$course->id}}</td>
                      <td><a href="{{route('server.course.detail',[$course->id])}}"> {{$course->name}}</a></td>
                      <td><a href=""><img width="70px" height="70px" src="/upload/{{$course->img}}"></a></td>
                      <td><div class="form-check">
                        @if( $course->finish == Finish::Yes )
                          <input data_id="{{$course->id}}" checked class="form-check-input finish" type="checkbox">
                        @else
                          <input data_id="{{$course->id}}" class="form-check-input finish" type="checkbox">
                        @endif
                        </div></td>
                      <td><a href="{{route('server.course.subject.index',[$course->id])}}"> {{__('views.view_subject')}}</a></td>
                      <td><a href="{{route('server.course.trainee',[$course->id])}}"> {{__('views.view_trainee')}}</a></td>
                      <td><a href="{{route('server.course.supervisor',[$course->id])}}"> {{__('views.view_supervisor')}}</a></td>
                        <td>
                        <button type="button" class="btn btn-block bg-gradient-info btn-xs"><a href="{{ route('server.course.show', [$course->id]) }}">{{__('views.edit')}}</a></button>
                        <form method="POST" action="{{ route('server.course.destroy', [$course->id]) }}">
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
              
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  {{ $courses->links('pagination::bootstrap-4') }}
                </ul>
              </div>
            </div>
            <!-- /.card -->

            
            <!-- /.card -->
          </div>
          <!-- /.col -->
         
          <!-- /.col -->
        </div>
       
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection


@section('js')
<script src="{{ asset('templates/dist/js/finish.js') }}"></script>
@endsection