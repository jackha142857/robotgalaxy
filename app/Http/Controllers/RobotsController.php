<?php

namespace App\Http\Controllers;

use App\Models\Robot;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use App\Models\Property;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\RobotInfo;
use App\Mail\SendMailable;

class RobotsController extends Controller
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
        $robots = Robot::with('user')->get();
        $properties = Property::where('order', '!=', '0')->get()->sortBy('order');
        $active = 'robotManagement';
        return view('admin.robotManagement.index', compact('robots', 'properties', 'active'));
    }
    
    public function create()
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $Users = User::pluck('name','id')->all();
        $properties = Property::where('order', '!=', '0')->get()->sortBy('order');        
        return view('admin.robotManagement.create', compact('Users', 'properties'));
    } 
    
    public function store(Request $request)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $properties = Property::where('order', '!=', '0')->get()->sortBy('order');
        try {            
            $data = $this->getData($request);
            if(!isset($data['user_id'])) {
                return back()->withInput()
                ->withErrors(['unexpected_error' => 'Choose Uploaded By!']);
            }
            Robot::create($data);
            $robot = Robot::all()->last();            
            $data = Arr::add($data, 'robot_id', $robot->id);
            $data = Arr::add($data, 'property_id', '');
            $data = Arr::add($data, 'content', '');
            foreach ($properties as $property) {
                if($property->InputType->type == 2) {
                    $data[$property->name] = implode('   ', $data[$property->name]);
                    $str1 = trim($data[$property->name]);
                    $data[$property->name] = str_replace('   ', ', ', $str1);
                }                
                $data['property_id'] = $property->id;
                $data['content'] = $data[$property->name];
                if($data['content'] == null || $data['content'] == "") {
                    return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Choose ' . $property->name . ' !']);
                }
                $temp = $robot->robotInfos->firstWhere('property_id', $property->id);
                if($temp != null) {
                    $robotInfo = RobotInfo::findOrFail($temp->id);
                    $robotInfo->update($data);
                } else {
                    RobotInfo::create($data);
                }
            }
            return redirect()->route('robots.robot.index')
            ->with('success_message', 'Robot was successfully added.');
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
        $robot = Robot::with('user')->findOrFail($id);
        $properties = Property::where('order', '!=', '0')->get()->sortBy('order');        
        return view('admin.robotManagement.show', compact('robot', 'properties'));
    }
    
    public function edit($id)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $robot = Robot::findOrFail($id);
        $Users = User::pluck('name','id')->all();
        $properties = Property::where('order', '!=', '0')->get()->sortBy('order');        
        return view('admin.robotManagement.edit', compact('robot','Users', 'properties'));
    }
    
    public function update($id, Request $request)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $properties = Property::where('order', '!=', '0')->get()->sortBy('order');
        try {            
            $data = $this->getData($request);  
            if(!isset($data['user_id'])) {
                return back()->withInput()
                ->withErrors(['unexpected_error' => 'Choose Uploaded By!']);
            }
            $robot = Robot::findOrFail($id);
            $stateBefore = $robot->state;
            $robot->update($data);
            $stateAfter = $data['state'];            
            $data = Arr::add($data, 'robot_id', $robot->id);
            $data = Arr::add($data, 'property_id', '');
            $data = Arr::add($data, 'content', '');
            foreach ($properties as $property) {
                if($property->InputType->type == 2) {
                    $data[$property->name] = implode(', ', $data[$property->name]);
                }
                $data['property_id'] = $property->id;
                $data['content'] = $data[$property->name];
                if($data['content'] == null || $data['content'] == "") {
                    return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Choose ' . $property->name . ' !']);
                }
                $temp = $robot->robotInfos->firstWhere('property_id', $property->id);
                if($temp != null) {
                    $robotInfo = RobotInfo::findOrFail($temp->id);
                    $robotInfo->update($data);
                } else {
                    RobotInfo::create($data);
                }
            }            
            if($stateBefore == 0 && $stateAfter == 1) {
                $subject = "Approved robot";
                $content = "1 of your uploaded robots was approved";
            } else if ($stateAfter == 0) {
                $subject = "Denied robot";
                $content = "1 of your uploaded robots was denied";
            }
            if ($stateBefore != $stateAfter || $stateAfter == 0)
            {
                $name = "Robot Galaxy";
                $sender = User::where('id', 1)->get()->first()->email;
                $receiver = User::where('id', $robot->user_id)->get()->first()->email;
                \Illuminate\Support\Facades\Mail::to($receiver)->send(new SendMailable($name, $sender, $subject, $content));
            }            
            return redirect()->route('robots.robot.index')
            ->with('success_message', 'Robot was successfully updated.');
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
            $robot = Robot::findOrFail($id);
            $userId = $robot->user_id;
            $robot->delete();            
            {
                $name = "Robot Galaxy";
                $sender = User::where('id', 1)->get()->first()->email;
                $receiver = User::where('id', $userId)->get()->first()->email;
                $subject = "Deleted robot";
                $content = "1 of your uploaded robots was deleted";
                \Illuminate\Support\Facades\Mail::to($receiver)->send(new SendMailable($name, $sender, $subject, $content));
            }            
            return redirect()->route('robots.robot.index')
            ->with('success_message', 'Robot was successfully deleted.');
        } catch (Exception $exception) {            
            return back()->withInput()
            ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }
    
    protected function getData(Request $request)
    {
        $properties = Property::where('order', '!=', '0')->get()->sortBy('order');
        $rules = [
            'user_id' => 'nullable',
            'state' => 'boolean',
        ];
        foreach ($properties as $property) {
            $rules = Arr::add($rules, $property->name, 'nullable');
        }    
        $data = $request->validate($rules);
        $data['state'] = $request->has('state');
        return $data;
    }
    ////////////////////////////////////////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////////////////////////////////////
    /**
     * For user, get data for source page, shared page, saved page, and upload page
     */
    public function filter(Request $request)
    {
        if($request->ajax())
        {
            $robotIds = DB::table('robots')->select('id')->get()->pluck('id')->toArray();
            $joinDb = DB::table('robots')   ->join('robot_infos', 'robots.id', '=', 'robot_infos.robot_id')
                                            ->join('properties', 'robot_infos.property_id', '=', 'properties.id');
            $page = 1;
            if($request->has('page') && $request->input('page') != '')  
            {
                $page = (int)$request->input('page');
            }
            foreach ($request->all() as $key => $value) {
                if($value != null && $key != 'page') {                    
                    $key = explode("*", $key)[0];
                    $query1 = clone $joinDb;
                    $robotIds = $query1 ->select('robots.id')
                                        ->whereIn('robots.id', $robotIds)
                                        ->where('properties.name', 'LIKE', $key)
                                        ->where('robot_infos.content', 'LIKE', '%'.$value.'%')
                                        ->groupBy('id')
                                        ->get()->pluck('id')->toArray();
                } 
            }            
            $total = Robot::whereIn('id', $robotIds)->where('state', 1)->get()->count();
            $robots = Robot::whereIn('id', $robotIds)->where('state', 1)->paginate(12, ['*'], 'page', $page);            
            $output = "";
            if($robots->count() == 0) {
                $output = '<div class="col-lg-12"><h2 style="display: inline;"><br>There are 0 results !!!</h2><a "javascript:void(0)" onclick="openNav()" class="btn btn-primary" style="float:right;">Filter</a></div>';
            } else {
                $output = '<div class="col-lg-12"><h2 style="display: inline;"><br>There are ' . $total. ' results !!!</h2><a "javascript:void(0)" onclick="openNav()" class="btn btn-primary" style="float:right;">Filter</a></div>';
                foreach($robots as $robot) 
                {
                    $output .= "<div class='col-lg-4 col-md-6 mb-4'>".
                    "<div class='card h-100'>".
                    "<div class='card-body'>";
                    
                    $collection = collect();
                    foreach($robot->robotInfos as $robotInfo) 
                    {
                        $collection->push(['property' => $robotInfo->Property->name, 'content' => $robotInfo->content, 'order' => $robotInfo->Property->order]);
                    }
                    $sorted = $collection->sortBy('order')->where('order' , '>', 0);
                   
                    foreach($sorted as $robotInfo)
                    {
                        if($robotInfo['property'] == "Image")
                        {                          
                            $output .= "<a href='" . route('robotDetail', $robot->id) . "'>".
                                "<img alt='' src='" .$robotInfo['content'] . "' width='800' height='600' style='max-width:100%; max-height:200px; border: 1px solid DarkGreen; border-radius: 50px;' onerror='unavailableImage(this);'>" .
                            "</a>";
                        }
                        elseif($robotInfo['property'] == "Name")
                        {
                            $output .= "<h5 class='card-title'>".
                            "<a href='" .route('robotDetail', $robot->id). "'>" .$robotInfo['content'] . "</a>".
                            "</h5>";
                        }
                        else {
                            $output = $output . "<p class='card-text'><strong>" .$robotInfo['property']. " </strong>" .$robotInfo['content'] . "</p>";
                        }
                    }
                    $output .= "</div>".
                                    "<div class='card-footer'>".
                                    "<small class='text-muted'>&#9733; &#9733; &#9733; &#9733; &#9734;</small>".
                                    "</div>".
                                    "</div>".
                                    "</div>";
                }
                $output .= "<div class='col-lg-12' style='text-align: center;'>" .$robots->links() ."</div>";
            }
            return Response($output);
        }
    }
    
    public function filterSavedList(Request $request)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if($request->ajax())
        {
            $robotsId = array_column(DB::table('robots')->join('saved_lists', 'robots.id', '=', 'saved_lists.robot_id')
                ->where('saved_lists.user_id', '=', Auth::user()->id)->select('robots.id')->get()->toArray(), 'id');
            
            $robotIds = DB::table('robots')->whereIn('id', $robotsId)->select('id')->get()->pluck('id')->toArray();
            $joinDb = DB::table('robots')   ->join('robot_infos', 'robots.id', '=', 'robot_infos.robot_id')
                                            ->join('properties', 'robot_infos.property_id', '=', 'properties.id');
            $page = 1;
            if($request->has('page') && $request->input('page') != '')
            {
                $page = (int)$request->input('page');
            }
            foreach ($request->all() as $key => $value) {
                if($value != null && $key != 'page') {
                    $key = explode("*", $key)[0];
                    $query1 = clone $joinDb;
                    $robotIds = $query1 ->select('robots.id')
                    ->whereIn('robots.id', $robotIds)
                    ->where('properties.name', 'LIKE', $key)
                    ->where('robot_infos.content', 'LIKE', '%'.$value.'%')
                    ->groupBy('id')
                    ->get()->pluck('id')->toArray();
                }
            }
            $total = Robot::whereIn('id', $robotIds)->where('state', 1)->get()->count();
            $robots = Robot::whereIn('id', $robotIds)->where('state', 1)->paginate(12, ['*'], 'page', $page);
            $output = '<h1 class="mx-auto mb-5 text-uppercase"><br>List of my saved robots</h1>';;
            if($robots->count() == 0) {
                $output .= '<div class="col-lg-12"><h2 style="display: inline;"><br>There are 0 results !!!</h2><a "javascript:void(0)" onclick="openNav()" class="btn btn-primary" style="float:right;">Filter</a></div>';
            } else {
                $output .= '<div class="col-lg-12"><h2 style="display: inline;"><br>There are ' . $total. ' results !!!</h2><a "javascript:void(0)" onclick="openNav()" class="btn btn-primary" style="float:right;">Filter</a></div>';
                foreach($robots as $robot)
                {
                    $output .= "<div class='col-lg-4 col-md-6 mb-4'>".
                        "<div class='card h-100'>".
                        "<div class='card-body'>";
                    
                    $collection = collect();
                    foreach($robot->robotInfos as $robotInfo)
                    {
                        $collection->push(['property' => $robotInfo->Property->name, 'content' => $robotInfo->content, 'order' => $robotInfo->Property->order]);
                    }
                    $sorted = $collection->sortBy('order')->where('order' , '>', 0);
                    
                    foreach($sorted as $robotInfo)
                    {
                        if($robotInfo['property'] == "Image")
                        {
                            $output .= "<a href='" . route('robotDetail', $robot->id) . "'>".
                                "<img alt='' src='" .$robotInfo['content'] . "' width='800' height='600' style='max-width:100%; max-height:200px; border: 1px solid DarkGreen; border-radius: 50px;' onerror='unavailableImage(this);'>" .
                                "</a>";
                        }
                        elseif($robotInfo['property'] == "Name")
                        {
                            $output .= "<h5 class='card-title'>".
                                "<a href='" .route('robotDetail', $robot->id). "'>" .$robotInfo['content'] . "</a>".
                                "</h5>";
                        }
                        else {
                            $output = $output . "<p class='card-text'><strong>" .$robotInfo['property']. " </strong>" .$robotInfo['content'] . "</p>";
                        }
                    }
                    $output .= "</div>".
                        "<div class='card-footer'>".
                        "<small class='text-muted'>&#9733; &#9733; &#9733; &#9733; &#9734;</small>".
                        "</div>".
                        "</div>".
                        "</div>";
                }
                $output .= "<div class='col-lg-12' style='text-align: center;'>" .$robots->links() ."</div>";
            }
            return Response($output);
        }
    }
    
    public function filterShared(Request $request)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if($request->ajax())
        {
            $robotIds = DB::table('robots')->where('user_id', Auth::user()->id)->select('id')->get()->pluck('id')->toArray();
            $joinDb = DB::table('robots')   ->join('robot_infos', 'robots.id', '=', 'robot_infos.robot_id')
                                            ->join('properties', 'robot_infos.property_id', '=', 'properties.id');
            $page = 1;
            if($request->has('page') && $request->input('page') != '')
            {
                $page = (int)$request->input('page');
            }
            foreach ($request->all() as $key => $value) {
                if($value != null && $key != 'page') {
                    $key = explode("*", $key)[0];
                    $query1 = clone $joinDb;
                    $robotIds = $query1 ->select('robots.id')
                    ->whereIn('robots.id', $robotIds)
                    ->where('properties.name', 'LIKE', $key)
                    ->where('robot_infos.content', 'LIKE', '%'.$value.'%')
                    ->groupBy('id')
                    ->get()->pluck('id')->toArray();
                }
            }
            $total = Robot::whereIn('id', $robotIds)->where('state', 1)->get()->count();
            $robots = Robot::whereIn('id', $robotIds)->where('state', 1)->paginate(12, ['*'], 'page', $page);
            $output = '<h1 class="mx-auto mb-5 text-uppercase"><br>List of my uploaded robots</h1>';
            if($robots->count() == 0) {
                $output .= '<div class="col-lg-12"><h2 style="display: inline;"><br>There are 0 results !!!</h2><a "javascript:void(0)" onclick="openNav()" class="btn btn-primary" style="float:right;">Filter</a></div>';
            } else {
                $output .= '<div class="col-lg-12"><h2 style="display: inline;"><br>There are ' . $total. ' results !!!</h2><a "javascript:void(0)" onclick="openNav()" class="btn btn-primary" style="float:right;">Filter</a></div>';
                foreach($robots as $robot)
                {
                    $output .= "<div class='col-lg-4 col-md-6 mb-4'>".
                        "<div class='card h-100'>".
                        "<div class='card-body'>";
                    
                    $collection = collect();
                    foreach($robot->robotInfos as $robotInfo)
                    {
                        $collection->push(['property' => $robotInfo->Property->name, 'content' => $robotInfo->content, 'order' => $robotInfo->Property->order]);
                    }
                    $sorted = $collection->sortBy('order')->where('order' , '>', 0);
                    
                    foreach($sorted as $robotInfo)
                    {
                        if($robotInfo['property'] == "Image")
                        {
                            $output .= "<a href='" . route('robotDetail', $robot->id) . "'>".
                                "<img alt='' src='" .$robotInfo['content'] . "' width='800' height='600' style='max-width:100%; max-height:200px; border: 1px solid DarkGreen; border-radius: 50px;' onerror='unavailableImage(this);'>" .
                                "</a>";
                        }
                        elseif($robotInfo['property'] == "Name")
                        {
                            $output .= "<h5 class='card-title'>".
                                "<a href='" .route('robotDetail', $robot->id). "'>" .$robotInfo['content'] . "</a>".
                                "</h5>";
                        }
                        else {
                            $output = $output . "<p class='card-text'><strong>" .$robotInfo['property']. " </strong>" .$robotInfo['content'] . "</p>";
                        }
                    }
                    $output .= "</div>".
                        "<div class='card-footer'>".
                        "<small class='text-muted'>&#9733; &#9733; &#9733; &#9733; &#9734;</small>".
                        "</div>".
                        "</div>".
                        "</div>";
                }
                $output .= "<div class='col-lg-12' style='text-align: center;'>" .$robots->links() ."</div>";
            }
            return Response($output);
        }
    }    
    
    public function upload(Request $request)
    {
        $properties = Property::where('order', '!=', '0')->get()->sortBy('order');
        try {
            
            $data = $this->getData($request);
            
            Robot::create($data);
            $robot = Robot::all()->last();
            
            $data = Arr::add($data, 'robot_id', $robot->id);
            $data = Arr::add($data, 'property_id', '');
            $data = Arr::add($data, 'content', '');
            
            foreach ($properties as $property) {                
                if($property->InputType->type == 2) {
                    $data[$property->name] = implode('   ', $data[$property->name]);
                    $str1 = trim($data[$property->name]);
                    $data[$property->name] = str_replace('   ', ', ', $str1);
                }
                
                $data['property_id'] = $property->id;
                $data['content'] = $data[$property->name];
                if($data['content'] == null || $data['content'] == "") {
                    return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Choose ' . $property->name . ' !']);
                }
                $temp = $robot->robotInfos->firstWhere('property_id', $property->id);
                if($temp != null) {
                    $robotInfo = RobotInfo::findOrFail($temp->id);
                    $robotInfo->update($data);
                } else {
                    RobotInfo::create($data);
                }
            }            
            {
                $name = Auth::user()->name;
                $sender = Auth::user()->email;
                $receiver = User::where('id', 1)->get()->first()->email;
                $subject = "Uploaded robot";
                $content = "A robot was uploaded and need to be verified";
                \Illuminate\Support\Facades\Mail::to($receiver)->send(new SendMailable($name, $sender, $subject, $content));
            }            
            return redirect()->route('upload')
            ->with('success_message', 'Robot was successfully uploaded and is being processed!');
        } catch (Exception $exception) {            
            return back()->withInput()
            ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }    
    ////////////////////////////////////////////////////////////////////////////////////
}
