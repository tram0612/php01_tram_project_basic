@extends('server.layouts.master')
@section('title')
{{__('views.user')}}
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
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
<section class="content">
      
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{$course->name}}</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          @php
          $role = UserRole::Trainee;
          if(Route::currentRouteName()=='server.course.supervisor'){
            $role = UserRole::Supervisor;
          }
          @endphp
          <table class="table table-striped projects">

              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                          {{$role==UserRole::Trainee?__('views.trainee'):__('views.supervisor')}}
                      </th>
                      <th style="width: 30%">
                          Avarta
                      </th>
                      @if($role==UserRole::Trainee)
                      <th>
                          {{__('views.progress')}}
                      </th>
                      @endif
                      <th style="width: 20%">
                       {{__('views.action')}}
                      </th>
                  </tr>
              </thead>
              <tbody id="userTable">
                @foreach($userOfCourse as $user)
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
                          <a class="btn btn-primary btn-sm" href="{{route('server.course.progressUser',[$course->id,$user->id])}}">
                              <i class="fas fa-folder">
                              </i>
                              {{__('views.progress')}}
                          </a>
                      </td>
                      @endif
                      <td class="project-actions text-right">
                        <form method="post" action="{{route('server.course.delUser',[$course->id,$user->id])}}">
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
      </div>
      <!-- /.card -->
      
 <!-- form start -->
      <form id="AddUser" courseId="{{$course->id}}" method="post" action="{{route('server.course.addUser',[$course->id])}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label>{{__('views.select')}}</label>
            <select name="user" class="form-control">
              @foreach ($users as $user)
              <option value="{{$user['id']}}">{{$user['name']}} ({{$user['email']}})</option>
              @endforeach
            </select>
         </div>
          
          @error('subject')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          
          
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">{{__('views.add')}}</button>
        </div>
      </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection


@section('js')

<script src="{{ asset('templates/dist/js/addUser.js') }}"></script>

@endsection