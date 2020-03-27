<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Robot;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class ReportsController extends Controller
{

    /**
     * Display a listing of the reports.
     */
    public function index()
    {
        $reports = Report::with('robot','user')->paginate(25);

        return view('reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new report.
     */
    public function create()
    {
        $Robots = Robot::pluck('id','id')->all();
        $Users = User::pluck('id','id')->all();
        
        return view('reports.create', compact('Robots','Users'));
    }

    /**
     * Store a new report in the storage.
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Report::create($data);

            return redirect()->route('reports.report.index')
                ->with('success_message', 'Report was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified report.
     */
    public function show($id)
    {
        $report = Report::with('robot','user')->findOrFail($id);

        return view('reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified report.
     */
    public function edit($id)
    {
        $report = Report::findOrFail($id);
        $Robots = Robot::pluck('id','id')->all();
        $Users = User::pluck('id','id')->all();

        return view('reports.edit', compact('report','Robots','Users'));
    }

    /**
     * Update the specified report in the storage.
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $report = Report::findOrFail($id);
            $report->update($data);

            return redirect()->route('reports.report.index')
                ->with('success_message', 'Report was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified report from the storage.
     */
    public function destroy($id)
    {
        try {
            $report = Report::findOrFail($id);
            $report->delete();

            return redirect()->route('reports.report.index')
                ->with('success_message', 'Report was successfully deleted.');
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
            'comment' => 'required|string|min:1|max:255',
            'state' => 'boolean', 
        ];

        
        $data = $request->validate($rules);


        $data['state'] = $request->has('state');


        return $data;
    }

}
