@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">New post</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Post</a></li>
                            <li class="breadcrumb-item active">New Post</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Add new post</h3>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
            <!-- /.card-header -->
                <form class="form-horizontal" method="post" action="{{ route('posts.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="inputTitle"
                                               id="inputTitle"
                                               placeholder="Title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="summernote" class="col-sm-2 col-form-label">Body</label>
                                    <div class="col-sm-10">
                                        <textarea id="summernote" name="inputBody">Place</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-2 col-form-label">
                                        Category
                                    </label>
                                    <div class="col-sm-10">
                                        <select class="custom-select form-control" name="category_id"
                                                id="category_id">
                                            @foreach($cats as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10 custom-control custom-switch">
                                        <div class="form-check">
                                            <input type="checkbox"
                                                   class="form-check-input custom-control-input"
                                                   id="checkBoxActive" name="checkBoxActive">
                                            <label class="form-check-label custom-control-label"
                                                   for="checkBoxActive">Publish</label>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-info">Save</button>
                                    <a href="{{ route('posts.index') }}"
                                       class="btn btn-default float-right">Cancel</a>
                                </div>
                            </div>
                            <div class="col-sm-4">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.content -->
    {{--    </div>--}}
@stop

@section('headerStyles')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endsection

@section('footerScripts')
    <!-- Summernote -->
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script>
      $(document).ready(function () {
        const FMButton = function (context) {
          const ui = $.summernote.ui;
          const button = ui.button({
            contents: '<i class="note-icon-picture"></i> ',
            tooltip: 'File Manager',
            click: function () {
              window.open('/file-manager/summernote', 'fm', 'width=1100,height=600');
            }
          });
          return button.render();
        };
        $('#summernote').summernote({
          height: 300,
          toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['fm-button', ['fm']],
            ['view', ['fullscreen', 'codeview', 'help']],
          ],
          buttons: {
            fm: FMButton
          }
        });

      });

      function fmSetLink(url) {
        $('#summernote').summernote('insertImage', url);
      };
    </script>
@endsection
