@extends('inner/innerlayout')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <ol class="page-header breadcrumb">
            <li><a href="{{ URL::route('forum') }}">Forum</a></li>
            <li><a href="{{ URL::route('forum') }}#{{ $group->id }}">{{ $group->title }}</a></li>
            <li class="active">{{ $category->title }}</li>
        </ol>
    </div>
    <div class="container">
        <div class="col-md-offset-2">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            <div>
                <a class="btn btn-default" href="{{ URL::route('forumGetNewPost', $category->id) }}">Add a Post</a>
            </div>
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="clearfix">
                        <h3 class="panel-title pull-left">{{ $category->title }}</h3>
                        @if(Auth::user()->isAdmin())
                            <a class="btn btn-danger btn-xs pull-right delete_category" href="#" data-toggle="modal" data-target="#category_delete" id="{{ $category->id }}"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                            <a class="btn btn-success btn-xs pull-right update_category" href="#" data-toggle="modal" data-target="#category_update" id="update_category_{{ $category->id }}"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                        @endif
                    </div>
                </div>
                <div class="panel-body panel-list-group">
                    <div class="list-group">
                        @foreach($posts as $post)
                                <a class="list-group-item" href="{{ URL::route('forumPost', $post->id) }}">{{ $post->title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->isAdmin())
            <div class="modal fade" id="category_delete" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title">Delete Category</h4>
                        </div>
                        <div class="modal-body">
                            <h3>Are you sure you want to delete the category?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <a href="#" type="button" class="btn btn-primary" id="btn_delete_category">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="category_update" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title">Edit Category</h4>
                        </div>
                        <div class="modal-body">
                            <form id="category_update_form" method="post">
                                <div class="form-group {{ ($errors->has('category_name')) ? 'has-error' : '' }}">
                                    <label for="category_name">Category name:</label>
                                    <input type="text" id="category_name" name="category_name" value="{{ $category->title }}" class="form-control">
                                    @if($errors->has('category_name'))
                                        <p>{{ $errors->first('category_name') }}</p>
                                    @endif
                                </div>
                                {{ Form::token() }}
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="category_update_submit">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop