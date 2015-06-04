<?php

class NewsController extends BaseController
{
    public function mainPage()
    {
        $news = News::orderBy('created_at', 'DSC')->get();
        return View::make('inner.news.newsmainpage')->with('news', $news);
    }

    public function news($id)
    {
        $news = News::find($id);
        return View::make('inner.news.news')->with('news', $news);
    }

    public function create()
    {
        if(Request::isMethod('post'))
        {
            $data = Input::all();
            $rules = array(
                'subject' => 'required|min:3|max:200',
                'text' => 'required|min:10|max:10000',
                'news_pic' => 'mimes:jpeg,jpg,png|image|max:6500',
            );
            $validator = Validator::make($data, $rules);
            if($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $news = new News;
            $news->subject = $data['subject'];
            $news->text = $data['text'];
            $file = Input::file('news_pic');
            if($file)
            {
                $fileName = md5_file($file->getRealPath());
                $extension = $file->getClientOriginalExtension();
                $name = $fileName.'.'.$extension;
                $news->news_pic = '/img/news/'.$name;
                $file->move(public_path()."/img/news/", $name);
            }
            $news->save();
            return Redirect::route('newsPost', $news->id);
        }
        return View::make('inner.news.newnews');
    }

    public function delete($id)
    {
        $news = News::find($id);
        if($news == null)
        {
            return Redirect::route('news')->with('fail', 'The news don\'t exist.');
        }
        $comments = $news->comments();
        //variable below for a success status of comments delete
        $deleteComments = true;

        if($comments->count() > 0)
        {
            $deleteComments = $comments->delete();
        }

        if($deleteComments && $news->delete())
        {
            return Redirect::route('news')->with('success', 'News were deleted!');
        }
        return Redirect::route('news')->with('fail', 'An error occurred.');
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
            return Redirect::route('newsPost', $id)->withErrors($validator)->withInput();
        }
        else
        {
            $news = News::find($id);
            if($news == null)
            {
                return Redirect::route('newsPost', $id)->with('fail', 'The news don\'t exist.');
            }
            $comment = NewsComment::createComment($data, $id);
            if($comment->save())
            {
                return Redirect::route('newsPost', $id)->with('success', 'The comment has been added!');
            }
            //if database connection fails
            else
            {
                return Redirect::route('newsPost', $id)->with('fail', 'An error occurred.');
            }
        }
    }

    public function deleteComment($id)
    {
        $comment = NewsComment::find($id);
        if($comment == null)
        {
            return Redirect::route('news')->with('fail', 'The comment doesn\'t exist.');
        }
        if($comment->delete())
        {
            return Redirect::route('newsPost', $comment->news_id)->with('success', 'The comment was deleted!');
        }
        //if database connection fails
        else
        {
            return Redirect::route('newsPost', $comment->news_id)->with('fail', 'An error occurred.');
        }
    }
}