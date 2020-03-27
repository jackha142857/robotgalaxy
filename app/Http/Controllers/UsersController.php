<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Property;
use App\Models\Robot;
use App\Models\SavedList;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    ////////////////////////////////////////////////////////////////////////////////////
    /**
     * For admin 
     */
    public function index()
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $users = User::all();
        $active = 'accountManagement';
        return view('admin.accountManagement.index', compact('users', 'active'));
    }
    public function create()
    {       
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        return view('admin.accountManagement.create');
    }
    
    public function store(Request $request)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        try {            
            $data = $this->getData($request);
            $data['password'] = Hash::make($data['password']);  
            if (User::where('email', '=', $data['email'])->exists()) {
                return back()->withInput()
                ->withErrors(['unexpected_error' => "This email already exists"]);
            }
            if(!is_numeric($data['phone']) && $data['phone'] != "") {
                return back()->withInput()
                ->withErrors(['unexpected_error' => 'Phone number is invalid!']);
            }
            User::create($data);
            return redirect()->route('users.user.index')
                ->with('success_message', 'User was successfully added.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    public function show($id)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $user = User::findOrFail($id);
        return view('admin.accountManagement.show', compact('user'));
    }

    public function edit($id)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $user = User::findOrFail($id);
        return view('admin.accountManagement.edit', compact('user'));
    }
    
    public function changepass($id)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $user = User::findOrFail($id);
        return view('admin.accountManagement.changepass', compact('user'));
    }

    public function update($id, Request $request)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        try {            
            $data = $this->getData($request);            
            $user = User::findOrFail($id);
            if (User::where('email', '=', $data['email'])->exists() && $data['email'] != $user->email) {
                return back()->withInput()
                ->withErrors(['unexpected_error' => "This email already exists"]);
            }
            if(!is_numeric($data['phone']) && $data['phone'] != "") {
                return back()->withInput()
                ->withErrors(['unexpected_error' => 'Phone number is invalid!']);
            }
            $user->update($data);
            return redirect()->route('users.user.index')
                ->with('success_message', 'User was successfully updated.');
        } catch (Exception $exception) {
            return back()->withInput()
            ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }        
    }    
    
    public function updatepass($id, Request $request)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        try {            
            $data = $this->getData($request);
            $data['password'] = Hash::make($data['password']);            
            $user = User::findOrFail($id);
            $user->update($data);            
            return redirect()->route('users.user.index')
            ->with('success_message', 'Password was successfully updated.');
        } catch (Exception $exception) {            
            return back()->withInput()
            ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    public function destroy($id)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('users.user.index')
                ->with('success_message', 'User was successfully deleted.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    protected function getData(Request $request)
    {
        $rules = [
                'name' => 'required|string|min:1|max:255',
            'email' => 'required|string|min:1|max:255',
            'email_verified_at' => 'nullable|date_format:j/n/Y',
            'password' => 'required|string|min:1|max:255',
            'phone' => 'nullable|string|min:0|max:255',
            'address' => 'nullable|string|min:0|max:255',
            'dob' => 'nullable|date_format:j/n/Y',
            'avatar' => 'nullable|string|min:0|max:255',
//             'avatar' => 'nullable|file|string|min:0|max:255',
            'privilege' => 'required|string|min:1',
            'remember_token' => 'nullable|string|min:0|max:100', 
        ];        
        $data = $request->validate($rules);
        return $data;
    }
    ////////////////////////////////////////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////////////////////////////////////
    /**
     * Show,  update, and get data of user profile
     */
    public function profile(int $userId)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->id != $userId) {
            return redirect('/');
        }
        $user = User::findOrFail($userId);
        
        $active = "profile";
        return view('users.profile.edit', compact('active', 'user'));
    }
    
    public function updateProfile($id, Request $request)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->id != $id) {
            return redirect('/');
        }
        try {
            $data = $this->getDataUser($request);
            if(!is_numeric($data['phone'])) {
                return back()->withInput()
                ->withErrors(['unexpected_error' => 'Phone number is invalid!']);
            }
            $user = User::findOrFail($id);
            $user->update($data);
            return redirect()->route('profile', $id)
            ->with('success_message', 'Profile was successfully updated.');
        } catch (Exception $exception) {
            return back()->withInput()
            ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }
    
    protected function getDataUser(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:1|max:255',
            'email' => 'required|string|min:1|max:255',
            'phone' => 'nullable|string|min:0|max:255',
            'address' => 'nullable|string|min:0|max:255',
            'dob' => 'nullable|date_format:j/n/Y',
            'avatar' => 'nullable|string|min:0|max:255',
        ];
        $data = $request->validate($rules);
        return $data;
    }
    ////////////////////////////////////////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////////////////////////////////////
    /**
     * Show,  update, and get data of user password
     */
    public function changepassword($id)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->id != $id) {
            return redirect('/');
        }
        $user = User::findOrFail($id);
        return view('users.profile.changepass', compact('user'));
    }
    
    public function updatePassword($id, Request $request)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->id != $id) {
            return redirect('/');
        }
        try {
            $data = $this->getDataChangePass($request);
            if(!Hash::check($data['oldPassword'], Auth::user()->password)) {
                return back()->withInput()
                ->withErrors(['Fail: ' => 'Current password is not correct!']);
            }
            if($data['newPassword'] != $data['rePassword']) {
                return back()->withInput()
                ->withErrors(['Fail: ' => 'Retype password is not match!']);
            }
            $data['password'] = Hash::make($data['newPassword']);
            $user = User::findOrFail($id);
            $user->update($data);
            return redirect()->route('profile', $id)
            ->with('success_message', 'Password was successfully updated.');
        } catch (Exception $exception) {
            return back()->withInput()
            ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }
    
    protected function getDataChangePass(Request $request)
    {
        $rules = [
            'oldPassword' => 'required|string|min:8|max:255',
            'newPassword' => 'required|string|min:8|max:255',
            'rePassword' => 'required|string|min:8|max:255',
        ];
        $data = $request->validate($rules);
        return $data;
    }
    ////////////////////////////////////////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////////////////////////////////////
    /**
     * Link to statistic page, source page, savedlist, shared, upload page, banned
     */
    public function statistic()
    {
        $active = "statistic";
        $data = array();
        $robots = DB::table('robots')
                    ->join('robot_infos', 'robots.id', '=', 'robot_infos.robot_id')
                    ->join('properties', 'robot_infos.property_id', '=', 'properties.id')
                    ->select(DB::raw('count(robots.id) as total, robot_infos.content as year'))
                    ->where('properties.name', '=', 'Year')
                    ->where('robots.state', '=', 1)
                    ->groupBy('robot_infos.content')
                    ->orderBy('robot_infos.content', 'desc')
                    ->get();
        foreach ($robots as $robot) {
            $data = Arr::prepend($data,array('x' => (int)$robot->year, 'y' => $robot->total));
        }                
        return view('users.statistic', compact('active', 'data'));
    }
    
    public function source()
    {
        $filters = Property::where('filter', '>', 0)->get()->sortBy('order');
        $robots = Robot::where('state', 1)->get();
        $active = "source";
        return view('users.source', compact('filters', 'robots', 'active'));
    }
    
    public function shared()
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege == 0) {
            return redirect('/banned');
        }
        $filters = Property::where('filter', '>', 0)->get()->sortBy('order');
        $robots = Robot::where('user_id', Auth::user()->id)->get();
        $active = "shared";
        return view('users.shared', compact('filters', 'robots', 'active'));
    }
    
    public function saved()
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege == 0) {
            return redirect('/banned');
        }
        $filters = Property::where('filter', '>', 0)->get()->sortBy('order');
        $robotsId = array_column(DB::table('robots')->join('saved_lists', 'robots.id', '=', 'saved_lists.robot_id')
            ->where('saved_lists.user_id', '=', Auth::user()->id)->select('robots.id')->get()->toArray(), 'id');
        //         var_dump($robotsId);
        //         die();
        $robots = Robot::whereIn('id', $robotsId)->get();
        $active = "saved";
        return view('users.saved', compact('filters', 'robots', 'active'));
    }
    
    public function upload()
    {
        $properties = Property::where('order', '!=', '0')->get()->sortBy('order');
        $robot = null;
        $active = "upload";
        return view('users.upload', compact('properties', 'robot', 'active'));
    }
    
    public function banned()
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }        
        return view('users.banned');
    }
    ////////////////////////////////////////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////////////////////////////////////
    /**
     * Robot detail page, add to saved list function, and about comments
     */
    public function robotDetail(int $robotId)
    {
        $robot = Robot::where('id', $robotId)->get()->first();
        $active = "robotDetail";
        return view('users.robotdetail', compact('robot', 'active'));
    }
    
    public function addSavedList(Request $request)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        try {
            $data = [];
            $data['user_id'] = $request->input('user_id');
            $data['robot_id'] = $request->input('robot_id');            
            SavedList::create($data);            
            return "Add to saved list successfully!";
        } catch (Exception $exception) {            
            return "Already added to saved list!";
        }
    }
    
    public function comment(Request $request)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        try {            
            $data = $this->getCommentData($request);            
            Comment::create($data);
            
            return 'Comment was successfully added!';
        } catch (Exception $exception) {            
            return 'Fail to submit comment: ' . $exception->getMessage();
        }
    }
    
    public function getComment(int $robotId)
    {
        $result = "";
        $commentParents = Comment::where('robot_id', '=', $robotId)->where('comment_id', '=', null)->oldest()->get();
        foreach ($commentParents as $commentParent) {
            $result .= "<div class='row' style='border-top: 1px solid #e6e9ec;'>".
                            "<div class='col-md-8'><span style='color: IndianRed;'><b>". $commentParent->User->name . "</b></span></div>".
                            "<div class='col-md-4' align='right'><span style='color: IndianRed; font-size: 12px;'>". $commentParent->created_at . "</span></div></div>";
            $result .= "<div class='row'>".
                "<div class='col-md-12'><span style='color: black;'>". htmlspecialchars($commentParent->comment) . "</span></div></div>";
            if(Auth::user() != null) {
                if(Auth::user()->privilege == 100) {
                    $result .= "<div class='row'>".
                        "<div class='col-md-12'><a href='javascript:showReplyBox(" . $commentParent->id .");'>". 'reply' . "</a>
                                    <a href='javascript:deleteComment(" . $commentParent->id .");'>". 'delete' . "</a></div></div>";
                } else {
                    $result .= "<div class='row'>".
                        "<div class='col-md-12'><a href='javascript:showReplyBox(" . $commentParent->id .");'>". 'reply' . "</a></div></div>";
                }
            }            
            $result .= "<div class='row'>".
                            "<div class='col-md-1'></div>".
                            "<div class='col-md-10' id='rp" . $commentParent->id . "'></div></div>";
            $commentChilds = Comment::where('robot_id', '=', $robotId)->where('comment_id', '=', $commentParent->id)->oldest()->get();
            foreach ($commentChilds as $commentChild) {
                $result .= "<div class='row'>".
                                "<div class='col-md-1'></div>".
                                "<div class='col-md-7'><span style='color: IndianRed;'><b>". $commentChild->User->name . "</b></span></div>".
                                "<div class='col-md-3' align='right'><span style='color: IndianRed; font-size: 12px;'>". $commentChild->created_at . "</span></div></div>";
                $result .= "<div class='row'>".
                                "<div class='col-md-1'></div>".
                                "<div class='col-md-10'><span style='color: black;'>". htmlspecialchars($commentChild->comment) . "</span></div></div>";
                if(Auth::user() != null) {
                    if(Auth::user()->privilege == 100) {
                        $result .= "<div class='row'>".
                            "<div class='col-md-1'></div>".
                            "<div class='col-md-10'><a href='javascript:deleteComment(" . $commentChild->id .");'>". 'delete' . "</a></div></div>";
                    }
                } 
            }
        }
        return $result;
    }
    
    protected function getCommentData(Request $request)
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
    ////////////////////////////////////////////////////////////////////////////////////
}
