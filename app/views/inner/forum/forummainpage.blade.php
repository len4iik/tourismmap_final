@extends('inner/innerlayout')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Forum</h1>
    </div>
    <div class="container">
        <div class="col-md-offset-2">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            @if(Auth::user()->isAdmin())
                <div>
                    <a class="btn btn-default" href="#" data-toggle="modal" data-target="#group_form">Add Group</a>
                </div>
                <br>
            @endif
            @foreach($groups as $group)
                @if(Auth::user()->isAdmin())
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="clearfix">
                            <h3 class="panel-title pull-left">{{ $group->title }}</h3>
                            <a class="btn btn-success btn-xs pull-right new_category" href="#" data-toggle="modal" data-target="#category_modal" id="add_category_{{ $group->id }}"><i class="glyphicon glyphicon-plus"></i> New Category</a>
                            <a class="btn btn-danger btn-xs pull-right delete_group" href="#" data-toggle="modal" data-target="#group_delete" id="{{ $group->id }}"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                            @if($group->isHidden())
                                <a class="btn btn-default btn-xs pull-right" href="{{ URL::route('forumGroupHide', $group->id) }}"><i class="glyphicon glyphicon-eye-open"></i> UnHide</a>
                            @else
                                <a class="btn btn-default btn-xs pull-right" href="{{ URL::route('forumGroupHide', $group->id) }}"><i class="glyphicon glyphicon-eye-close"></i> Hide</a>
                            @endif
                        </div>
                    </div>
                    <div class="panel-body panel-list-group">
                        <div class="list-group">
                            @foreach($categories as $category)
                                @if($category->group_id == $group->id)
                                <a class="list-group-item" href="{{ URL::route('forumCategory', $category->id) }}">{{ $category->title }}</a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @elseif(!$group->isHidden())
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="clearfix">
                                <h3 class="panel-title pull-left">{{ $group->title }}</h3>
                            </div>
                        </div>
                        <div class="panel-body panel-list-group">
                            <div class="list-group">
                                @foreach($categories as $category)
                                    @if($category->group_id == $group->id)
                                        <a class="list-group-item" href="{{ URL::route('forumCategory', $category->id) }}">{{ $category->title }}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        @if(Auth::user()->isAdmin())
            <div class="modal fade" id="group_form" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title">New Group</h4>
                        </div>
                        <div class="modal-body">
                            <form id="target_form" method="post" action="{{ URL::route('forumCreateGroup') }}">
                                <div class="form-group {{ ($errors->has('group_name')) ? 'has-error' : '' }}">
                                    <label for="group_name">Group name:</label>
                                    <input type="text" id="group_name" name="group_name" class="form-control">
                                    @if($errors->has('group_name'))
                                        <p>{{ $errors->first('group_name') }}</p>
                                    @endif
                                </div>
                                {{ Form::token() }}
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="form_submit">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="category_modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title">New Category</h4>
                        </div>
                        <div class="modal-body">
                            <form id="category_form" method="post">
                                <div class="form-group {{ ($errors->has('category_name')) ? 'has-error' : '' }}">
                                    <label for="category_name">Category name:</label>
                                    <input type="text" id="category_name" name="category_name" class="form-control">
                                    @if($errors->has('category_name'))
                                        <p>{{ $errors->first('category_name') }}</p>
                                    @endif
                                </div>
                                {{ Form::token() }}
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="category_submit">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="group_delete" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title">Delete Group</h4>
                        </div>
                        <div class="modal-body">
                            <h3>Are you sure you want to delete the group?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <a href="#" type="button" class="btn btn-primary" id="btn_delete_group">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop