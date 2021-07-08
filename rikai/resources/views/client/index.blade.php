@extends('client.layouts.master')
@section('title')
{{__('views.home')}}
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        @if (session('msg'))
            <div class="alert alert-warning">
              {{session('msg')}}
            </div>
        @endif
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{__('views.dashboard')}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <div class="row">
          @foreach($courses as $course)
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$course->name}}</h3>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{route('course.show',[$course->id])}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endforeach
          
        </div>
        <div class="row">
          <ul class="pagination pagination-sm">
           {{ $courses->links('pagination::bootstrap-4') }}
          </ul>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        
    </section>
    <!-- /.content -->
  </div>
@endsection


@section('js')
<!-- Tempusdominus Bootstrap 4 -->
<script src="templates/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- overlayScrollbars -->
<script src="templates/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
@endsection