<?php

namespace App\Http\Controllers;

use App\Models\InputType;
use Illuminate\Http\Request;
use Exception;

class InputTypesController extends Controller
{
    /**
     * Display a listing of the input types.
     */
    public function index()
    {
        $inputTypes = InputType::paginate(25);
        return view('input_types.index', compact('inputTypes'));
    }

    /**
     * Show the form for creating a new input type.
     */
    public function create()
    {      
        return view('input_types.create');
    }

    /**
     * Store a new input type in the storage.
     */
    public function store(Request $request)
    {
        try {            
            $data = $this->getData($request);            
            InputType::create($data);
            return redirect()->route('input_types.input_type.index')
                ->with('success_message', 'Input Type was successfully added.');
        } catch (Exception $exception) {
            return back()->withInput()
            ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified input type.
     */
    public function show($id)
    {
        $inputType = InputType::findOrFail($id);
        return view('input_types.show', compact('inputType'));
    }

    /**
     * Show the form for editing the specified input type.
     */
    public function edit($id)
    {
        $inputType = InputType::findOrFail($id);
        return view('input_types.edit', compact('inputType'));
    }

    /**
     * Update the specified input type in the storage.
     */
    public function update($id, Request $request)
    {
        try {            
            $data = $this->getData($request);            
            $inputType = InputType::findOrFail($id);
            $inputType->update($data);
            return redirect()->route('input_types.input_type.index')
                ->with('success_message', 'Input Type was successfully updated.');
        } catch (Exception $exception) {
            return back()->withInput()
            ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }        
    }

    /**
     * Remove the specified input type from the storage.
     */
    public function destroy($id)
    {
        try {
            $inputType = InputType::findOrFail($id);
            $inputType->delete();
            return redirect()->route('input_types.input_type.index')
                ->with('success_message', 'Input Type was successfully deleted.');
        } catch (Exception $exception) {
            return back()->withInput()
            ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }
    
    /**
     * Get the request's data from the request.
     */
    protected function getData(Request $request)
    {
        $rules = [
                'type' => 'required|string|min:1',
            'name' => 'required|string|min:1|max:255', 
        ];        
        $data = $request->validate($rules);
        return $data;
    }
}
