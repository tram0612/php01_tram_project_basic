@extends('server.layouts.master')
@section('title')
{{__('views.progress')}}
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
                      <th>{{__('views.subject')}}</th>
                      <th>{{__('views.image')}}</th>
                      <th>{{__('views.done')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($subjects as $subject)
                    
                    <tr>
                      <td>{{$subject['subject']['id']}}</td>
                      <td><a href=""> {{$subject['subject']['name']}}</a></td>
                      <td><a href=""><img width="70px" height="70px" src="/upload/{{$subject['subject']['img']}}"></a></td>
                      <td><div class="form-check">
                        @if( $subject['status'] == Status::Finish )
                          <input  checked class="form-check-input" type="checkbox">
                        @else
                          <input  class="form-check-input" type="checkbox">
                        @endif
                        </div></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
              <!-- <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                 
                </ul>
              </div> -->
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


