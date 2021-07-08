@extends('client.layouts.master')
@section('title')
{{__('views.subject')}}
@endsection
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        @if (session('msg'))
            <div class="alert alert-warning">
              {{session('msg')}}
            </div>
        @endif
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1>
              {{$subject->name}}
            </h1>

          </div> 
         
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        
        <!-- ./row -->
        <div class="row">
          <div class="col-12">
            
          </div>
        </div>
        <!-- ./row -->
        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">{{__('views.home')}}</a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">{{__('views.detail')}}</a>
                  </li>
                  
                 
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-history-tab" data-toggle="pill" href="#custom-tabs-one-history" role="tab" aria-controls="custom-tabs-one-history" aria-selected="false">{{__('views.history')}}</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                    <div class="card">
                      @foreach($tasks as $task)
                      <div class="row">
                        <div class="col-12 col-sm-12">
                          <div class="card">
                            <div class="card-header ui-sortable-handle" style="cursor: move;">
                              <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                {{$task->name}}
                              </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                              <ul class="todo-list ui-sortable" id="{{$task->id}}" data-widget="todo-list">
                                @foreach($task->userTask as $userTask )
                                
                                <li class="{{($userTask->status == Status::Finish)?'done':''}}">
                                  <div class="input-group">
                                    <input route="{{route('task.update',[$userTask->id])}}" type="text" class="form-control comment" name="comment" value="{{$userTask->comment}}">
                                    <input route="{{route('task.edit',[$userTask->id])}}" class="form-control checkStatus" type="checkbox" {{($userTask->status == Status::Finish)?'checked':''}} value="" name="">
                                    <div class="tools">
                                      <i class="fas fa-trash delete" route="{{route('task.destroy',[$userTask->id])}}"></i>
                                    </div>
                                  </div>
                                </li>

                                @endforeach

                              </ul>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                              <div class="input-group">
                                  <input type="text" name="task" placeholder="Type Task ..." class="form-control">
                                  <span class="input-group-append">
                                    <button task_id="{{$task->id}}" route="{{route('task.store')}}" type="button" class="btn btn-primary addUserTask">{{__('views.addTask')}}</button>
                                  </span>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                 
                  <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                     {!!$subject->detail!!}
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-history" role="tabpanel" aria-labelledby="custom-tabs-one-history-tab">
                     <div class="card-body">
                      @foreach($tasks as $task)
                      <ul class="todo-list ui-sortable history" id="{{$task->id}}" data-widget="todo-list">
                        @foreach($task->userTask as $userTask )
                        @if($userTask->status == Status::Finish)
                        <li >
                          <!-- drag handle -->
                          <span class="handle ui-sortable-handle">
                            <i class="fas fa-ellipsis-v"></i>
                            <i class="fas fa-ellipsis-v"></i>
                          </span>
                          <!-- checkbox -->
                          <div class="icheck-primary d-inline ml-2">
                            
                          </div>
                          <!-- todo text -->
                          <span class="text">{{$userTask->comment}}</span>
                          <div class="tools">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-o"></i>
                          </div>
                        </li>
                        @endif
                        @endforeach
                      </ul>
                      @endforeach 
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
  </div>


@endsection
@section('js')
@include('i18n')
<script src="{{ asset('templates/dist/js/userTask.js') }}"></script>
@endsection

