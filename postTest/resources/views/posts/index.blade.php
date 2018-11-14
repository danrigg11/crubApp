@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-12">
      @if(Session::has('success_msg'))
        <div class="alert alert-success">{{ Session::get('success_msg') }}</div>
      @endif
      <!-- Posts list -->
      @if(!empty($posts))
        <div class="row">
          <div class="col-lg-12 margin-tb">
            <div class="pull-left">
              <h2>Posts List </h2>
            </div>
            <div class="pull-right">
              <a class="btn btn-success" href="{{ route('posts.add') }}"> Add New</a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-striped task-table">
              <!-- Table Headings -->
              <thead>
                <th width="25%">Title</th>
                <th width="40%">Content</th>
                <th width="15%">Created</th>
                <th width="20%">Action</th>
              </thead>

              <!-- Table Body -->
              <tbody>
                @foreach($posts as $post)
                  <tr>
                    <td class="table-text">
                      <div>{{$post->title}}</div>
                    </td>
                    <td class="table-text">
                      <div>{{$post->content}}</div>
                    </td>
                    <td class="table-text">
                      <div>{{$post->created}}</div>
                    </td>
                    <td>
                      <a href="{{ route('posts.details', $post->id) }}" class="label label-success">Details</a>
                      <a href="{{ route('posts.edit', $post->id) }}" class="label label-warning">Edit</a>
                      <a href="{{ route('posts.delete', $post->id) }}" class="label label-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @endif
    </div>


    <div class="col-lg-12">

      <div class="pull-left">
        <h2 class="">Photos</h2>
        <hr>
        <h1>File Upload</h1>
        <form action="{{ URL::to('upload') }}" method="post" enctype="multipart/form-data">
          <label>Select image to upload:</label>
          <input style="padding-bottom:5px" type="file" name="file" id="file">
          <input type="submit" value="Upload" name="submit">
          <input type="hidden" value="{{ csrf_token() }}" name="_token">
          <img style="height:30px" src="" alt="">
        </form>
      </div>
    </div>
    <div class="center">
      @foreach (File::allFiles(public_path().'/uploads/') as $file)
      <?php
        $filename = $file->getRelativePathName();
        echo "<img style=\"width:300px\" src=\"/uploads/$filename\"/>";
        ?>
        <a href="/photo/delete/<?php echo $filename ?>" class="label label-danger w-100">Delete</a>
      @endforeach
    </div>
  </div>
@endsection
