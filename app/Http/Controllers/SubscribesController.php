<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use Exception;

class SubscribesController extends Controller
{

    /**
     * Display a listing of the subscribes.
     */
    public function index()
    {
        $subscribes = Subscribe::paginate(25);

        return view('subscribes.index', compact('subscribes'));
    }

    /**
     * Show the form for creating a new subscribe.
     */
    public function create()
    {
        
        
        return view('subscribes.create');
    }

    /**
     * Store a new subscribe in the storage.
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Subscribe::create($data);

            return redirect()->route('subscribes.subscribe.index')
                ->with('success_message', 'Subscribe was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified subscribe.
     */
    public function show($id)
    {
        $subscribe = Subscribe::findOrFail($id);

        return view('subscribes.show', compact('subscribe'));
    }

    /**
     * Show the form for editing the specified subscribe.
     */
    public function edit($id)
    {
        $subscribe = Subscribe::findOrFail($id);
        

        return view('subscribes.edit', compact('subscribe'));
    }

    /**
     * Update the specified subscribe in the storage.
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $subscribe = Subscribe::findOrFail($id);
            $subscribe->update($data);

            return redirect()->route('subscribes.subscribe.index')
                ->with('success_message', 'Subscribe was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified subscribe from the storage.
     */
    public function destroy($id)
    {
        try {
            $subscribe = Subscribe::findOrFail($id);
            $subscribe->delete();

            return redirect()->route('subscribes.subscribe.index')
                ->with('success_message', 'Subscribe was successfully deleted.');
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
                'email' => 'required|string|min:1|max:255',
            'subscribe' => 'boolean', 
        ];

        
        $data = $request->validate($rules);


        $data['subscribe'] = $request->has('subscribe');


        return $data;
    }

}
