<?php

namespace App\Http\Controllers;

use App\Models\Robot;
use App\Models\SavedList;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class SavedListsController extends Controller
{
     
    /**
     * Display a listing of the saved lists.
     */
    public function index()
    {
        $savedLists = SavedList::with('user','robot')->paginate(25);

        return view('saved_lists.index', compact('savedLists'));
    }

    /**
     * Show the form for creating a new saved list.
     */
    public function create()
    {
        $Users = User::pluck('id','id')->all();
        $Robots = Robot::pluck('state','id')->all();
        
        return view('saved_lists.create', compact('Users','Robots'));
    }

    /**
     * Store a new saved list in the storage.
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            SavedList::create($data);

            return redirect()->route('saved_lists.saved_list.index')
                ->with('success_message', 'Saved List was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified saved list.
     */
    public function show($id)
    {
        $savedList = SavedList::with('user','robot')->findOrFail($id);

        return view('saved_lists.show', compact('savedList'));
    }

    /**
     * Show the form for editing the specified saved list.
     */
    public function edit($id)
    {
        $savedList = SavedList::findOrFail($id);
        $Users = User::pluck('id','id')->all();
        $Robots = Robot::pluck('state','id')->all();

        return view('saved_lists.edit', compact('savedList','Users','Robots'));
    }

    /**
     * Update the specified saved list in the storage.
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $savedList = SavedList::findOrFail($id);
            $savedList->update($data);

            return redirect()->route('saved_lists.saved_list.index')
                ->with('success_message', 'Saved List was successfully updated.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified saved list from the storage.
     */
    public function destroy($id)
    {
        try {
            $savedList = SavedList::findOrFail($id);
            $savedList->delete();

            return redirect()->route('saved_lists.saved_list.index')
                ->with('success_message', 'Saved List was successfully deleted.');
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
                'user_id' => 'required',
            'robot_id' => 'required', 
        ];        
        $data = $request->validate($rules);
        return $data;
    }

}
