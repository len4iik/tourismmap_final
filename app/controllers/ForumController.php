<?php

class ForumController extends BaseController
{
    public function mainPage()
    {
        $groups = ForumGroup::orderBy('title', 'ASC')->get();
        $categories = ForumCategory::all();
        return View::make('inner.forum.forummainpage')->with('groups', $groups)->with('categories', $categories);
    }

    public function category($id)
    {
        $category = ForumCategory::find($id);
        if($category == null)
        {
            return Redirect::route('forum')->with('fail', 'The category doesn\'t exist.');
        }
        $posts = $category->posts()->get();
        //get the group for breadcrumb
        $group = ForumGroup::find($category->group_id);
        return View::make('inner.forum.category')->with('category', $category)->with('posts', $posts)->with('group', $group);
    }

    public function post($id)
    {
        $post = ForumPost::find($id);
        if($post == null)
        {
            return Redirect::route('forum')->with('fail', 'The post doesn\'t exist.');
        }
        $user = $post->user()->first();
        //get the group and the category for breadcrumb
        $category = ForumCategory::find($post->category_id);
        $group = ForumGroup::find($category->group_id);
        return View::make('inner.forum.post')->with('post', $post)->with('category', $category)->with('group', $group)->with('user', $user);
    }

    public function newPost($id) //category id
    {
        return View::make('inner.forum.newpost')->with('id', $id);
    }

    public function createGroup()
    {
        $data = Input::all();
        $rules = array(
            'group_name' => 'required|unique:forum_groups,title|max:50'
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails())
        {
            return Redirect::route('forum')->withErrors($validator)->withInput()->with('modal', '#group_form');
        }
        else
        {
            $group = ForumGroup::createGroup($data);
            if($group->save())
            {
                return Redirect::route('forum')->with('success', 'The group was created!');
            }
            //if database connection fails
            else
            {
                return Redirect::route('forum')->with('fail', 'An error occurred.');
            }
        }
    }

    public function hideGroup($id)
    {
        $group = ForumGroup::find($id);
        if($group == null)
        {
            return Redirect::route('forum')->with('fail', 'The group doesn\'t exist.');
        }

        if(!$group->isHidden())
            $group->is_hidden = 1;
        else $group->is_hidden = 0;
        if($group->save())
        {
            return Redirect::route('forum')->with('success', 'The group hidden status has been changed!');
        }
        //if database connection fails
        else
        {
            return Redirect::route('forum')->with('fail', 'An error occurred.');
        }
    }

    public function deleteGroup($id)
    {
        $group = ForumGroup::find($id);
        if($group == null)
        {
            return Redirect::route('forum')->with('fail', 'The group doesn\'t exist.');
        }

        $categories = $group->categories();
        $posts = $group->posts();
        $comments = $group->comments();
        //variables below for a success status of every delete
        $deleteCategories = true;
        $deletePosts = true;
        $deleteComments = true;

        if($categories->count() > 0)
        {
            $deleteCategories = $categories->delete();
        }
        if($posts->count() > 0)
        {
            $deletePosts = $posts->delete();
        }
        if($comments->count() > 0)
        {
            $deleteComments = $comments->delete();
        }

        if($deleteCategories && $deletePosts && $deleteComments && $group->delete())
        {
            return Redirect::route('forum')->with('success', 'The group was deleted!');
        }
        //if database connection fails
        else
        {
            return Redirect::route('forum')->with('fail', 'An error occurred.');
        }
    }

    public function createCategory($id)
    {
        $data = Input::all();
        $rules = array(
            'category_name' => 'required|unique:forum_categories,title|max:50'
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails())
        {
            return Redirect::route('forum')->withErrors($validator)->withInput()->with('category-modal', '#category_modal')->with('group-id', $id);
        }
        else
        {
            $group = ForumGroup::find($id);
            if($group == null)
            {
                return Redirect::route('forum')->with('fail', 'The group doesn\'t exist.');
            }
            $category = ForumCategory::createCategory($data, $id);
            if($category->save())
            {
                return Redirect::route('forum')->with('success', 'The category was created!');
            }
            //if database connection fails
            else
            {
                return Redirect::route('forum')->with('fail', 'An error occurred.');
            }
        }
    }

    public function editCategory($id)
    {
        $data = Input::all();
        $rules = array(
            'category_name' => 'required|unique:forum_categories,title|max:50'
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails())
        {
            return Redirect::route('forumCategory', $id)->withErrors($validator)->withInput()->with('modal', '#category_update');
        }
        else
        {
            $category = ForumCategory::updateCategory($id, $data);
            if($category->save())
            {
                return Redirect::route('forumCategory', $id)->with('success', 'The category has been updated!');
            }
            //if database connection fails
            else
            {
                return Redirect::route('forumCategory', $id)->with('fail', 'An error occurred.');
            }
        }
    }

    public function deleteCategory($id)
    {
        $category = ForumCategory::find($id);
        if($category == null)
        {
            return Redirect::route('forum')->with('fail', 'The category doesn\'t exist.');
        }

        $posts = $category->posts();
        $comments = $category->comments();
        //variables below for a success status of every delete
        $deletePosts = true;
        $deleteComments = true;

        if($posts->count() > 0)
        {
            $deletePosts = $posts->delete();
        }
        if($comments->count() > 0)
        {
            $deleteComments = $comments->delete();
        }

        if($deletePosts && $deleteComments && $category->delete())
        {
            return Redirect::route('forum')->with('success', 'The category was deleted!');
        }
        //if database connection fails
        else
        {
            return Redirect::route('forum')->with('fail', 'An error occurred.');
        }
    }

    public function createPost($id)
    {
        $data = Input::all();
        $rules = array(
            'title' => 'required|min:3|max:100',
            'body' => 'required|min:10|max:10000'
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails())
        {
            return Redirect::route('forumGetNewPost', $id)->withErrors($validator)->withInput();
        }
        else
        {
            $category = ForumCategory::find($id);
            if($category == null)
            {
                return Redirect::route('forumGetNewPost', $id)->with('fail', 'The category doesn\'t exist.');
            }
            $post = ForumPost::createPost($data, $category->group_id ,$id);
            if($post->save())
            {
                return Redirect::route('forumPost', $post->id)->with('success', 'The post has been created!');
            }
            //if database connection fails
            else
            {
                return Redirect::route('forumGetNewPost', $id)->with('fail', 'An error occurred.');
            }
        }
    }

    public function editPostGet($id)
    {
        $post = ForumPost::find($id);
        if($post == null)
        {
            return Redirect::route('forumCategory')->with('fail', 'The post doesn\'t exist.');
        }
        return View::make('inner.forum.editpost')->with('post', $post);
    }

    public function editPost($id)
    {
        $data = Input::all();
        $rules = array(
            'title' => 'required|min:3|max:100',
            'body' => 'required|min:10|max:10000'
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails())
        {
            return Redirect::route('forumGetEditPost', $id)->withErrors($validator)->withInput();
        }
        else
        {
            $post = ForumPost::updatePost($id, $data);
            if($post->save())
            {
                return Redirect::route('forumPost', $post->id)->with('success', 'The post has been updated!');
            }
            //if database connection fails
            else
            {
                return Redirect::route('forumGetEditPost', $id)->with('fail', 'An error occurred.');
            }
        }
    }

    public function deletePost($id)
    {
        $post = ForumPost::find($id);
        if($post == null)
        {
            return Redirect::route('forum')->with('fail', 'The post doesn\'t exist.');
        }

        $comments = $post->comments();
        //variable below for a success status of every delete
        $deleteComments = true;

        if($comments->count() > 0)
        {
            $deleteComments = $comments->delete();
        }

        if($deleteComments && $post->delete())
        {
            return Redirect::route('forumCategory', $post->category_id)->with('success', 'The post was deleted!');
        }
        //if database connection fails
        else
        {
            return Redirect::route('forumCategory', $post->category_id)->with('fail', 'An error occurred.');
        }
    }

    public function createComment($id)
    {
        $data = Input::all();
        $rules = array(
            'comment' => 'required|max:10000'
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails())
        {
            return Redirect::route('forumPost', $id)->withErrors($validator)->withInput();
        }
        else
        {
            $post = ForumPost::find($id);
            if($post == null)
            {
                return Redirect::route('forumPost', $id)->with('fail', 'The post doesn\'t exist.');
            }
            $comment = ForumComment::createComment($data, $post->group_id, $post->category_id, $id);
            if($comment->save())
            {
                return Redirect::route('forumPost', $id)->with('success', 'The comment has been added!');
            }
            //if database connection fails
            else
            {
                return Redirect::route('forumGetNewPost', $id)->with('fail', 'An error occurred.');
            }
        }
    }

    public function deleteComment($id)
    {
        $comment = ForumComment::find($id);
        if($comment == null)
        {
            return Redirect::route('forum')->with('fail', 'The comment doesn\'t exist.');
        }
        if($comment->delete())
        {
            return Redirect::route('forumPost', $comment->post_id)->with('success', 'The comment was deleted!');
        }
        //if database connection fails
        else
        {
            return Redirect::route('forumPost', $comment->post_id)->with('fail', 'An error occurred.');
        }
    }
}