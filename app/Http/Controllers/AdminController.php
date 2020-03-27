<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Exception;

class AdminController extends Controller
{           
    public function __construct()
    {
         $this->middleware('auth');
    }
    
    public function dashboard()
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        return view('admin.dashboard');
    }
    
    public function contentCustomisation()
    {   
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $active = 'contentCustomisation';
        return view('admin.contentCustomisation', compact('active'));
    }
    
    public function robotManagement()
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $active = 'robotManagement';
        return view('admin.robotManagement.robotManagement', compact('active'));
    }
    public function processingList()
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $active = 'robotManagement';
        return view('admin.robotManagement.processingList', compact('active'));
    }
    
    public function accountManagement()
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $active = 'accountManagement';
        return view('admin.accountManagement.accountManagement', compact('active'));
    }
    
    public function utilities()
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $active = 'utilities';
        return view('admin.utilities.utilities', compact('active'));
    }
    
    public function deleteComment(int $commentId)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        try {
            $comment = Comment::findOrFail($commentId);
            $comment->delete();
            return 'Comment was successfully deleted.';
        } catch (Exception $exception) {
            return 'Unexpected error occurred while trying to process your request.';
        }
    }
}
