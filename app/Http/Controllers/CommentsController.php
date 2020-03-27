<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Robot;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class CommentsController extends Controller
{

    /**
     * Display a listing of the comments.
     */
    public function index()
    {
        $comments = Comment::with('robot','user','parentcomment')->paginate(25);

        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new comment.
     */
    public function create()
    {
        $Robots = Robot::pluck('id','id')->all();
        $Users = User::pluck('id','id')->all();
        $ParentComments = Comment::pluck('id','id')->all();
        
        return view('comments.create', compact('Robots','Users','ParentComments'));
    }

    /**
     * Store a new comment in the storage.
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Comment::create($data);

            return redirect()->route('comments.comment.index')
                ->with('success_message', 'Comment was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified comment.
     */
    public function show($id)
    {
        $comment = Comment::with('robot','user','parentcomment')->findOrFail($id);

        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified comment.
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $Robots = Robot::pluck('id','id')->all();
        $Users = User::pluck('id','id')->all();
        $ParentComments = Comment::pluck('id','id')->all();

        return view('comments.edit', compact('comment','Robots','Users','ParentComments'));
    }

    /**
     * Update the specified comment in the storage.
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $comment = Comment::findOrFail($id);
            $comment->update($data);

            return redirect()->route('comments.comment.index')
                ->with('success_message', 'Comment was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified comment from the storage.
     */
    public function destroy($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();

            return redirect()->route('comments.comment.index')
                ->with('success_message', 'Comment was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    
    /**
     * Get the request's data from the request.
     */
    protected function getData(Request $request)
    {
        $rules = [
                'robot_id' => 'required',
            'user_id' => 'nullable',
            'comment_id' => 'nullable',
            'comment' => 'required', 
        ];        
        $data = $request->validate($rules);
        return $data;
    }

}
