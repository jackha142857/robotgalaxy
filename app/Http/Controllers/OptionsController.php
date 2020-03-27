<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class OptionsController extends Controller
{
    /**
     * Store a new option in the storage.
     */
    public function store(Request $request)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        try {            
            $property_id = 1;
            $option = '';
            $description = '';
            if($request->has('property_id')) {
                $property_id = $request->input('property_id');
            }
            if($request->has('option')) {
                $option = $request->input('option');
            }
            if($request->has('description')) {
                $description = $request->input('description');
            }
            if($option == null) {
                return "Fail to add option! Error: Option name is required";
            }
            Option::create(['property_id' => $property_id, 'option' => $option, 'description' => $description]);
            return "Option has been added successfully!";
        } catch (Exception $exception) {
            return "Fail to add option! Error: " . $exception->getMessage();
        }
    }

    /**
     * Update the specified option in the storage.
     */
    public function update($id, Request $request)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        try {            
            $option = Option::findOrFail($id);
            $property_id = $option->property_id;
            $option_ = $option->option;
            $description = $option->description;
            if($request->has('property_id')) {
                $property_id = $request->input('property_id');
            }
            if($request->has('option')) {
                $option_ = $request->input('option');
            }
            if($request->has('description')) {
                $description = $request->input('description');
            }
            $option->update(['property_id' => $property_id, 'option' => $option_, 'description' => $description]);

            return "Option has been updated successfully!";
        } catch (Exception $exception) {
            return "Fail to update option! Error: " . $exception->getMessage();
        }
    }

    /**
     * Remove the specified option from the storage.
     */
    public function destroy($id)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        try {
            $option = Option::findOrFail($id);
            $option->delete();

            return "Option has been deleted successfully!";
        } catch (Exception $exception) {
            return "Fail to delete option! Error: " . $exception->getMessage();
        }
    }
    
    public function getOptions(Request $request)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $propertyId = $request->input('propertyId');
        $property = Property::where('id', $propertyId)->get()->first();
        $options = Option::where('property_id', $propertyId)->get()->sortBy('order');
        $output = "";
        if($property->input_type_id == 1) {
            return $output;
        }
        for ($i = 0; $i < $options->count(); $i++) {            
            $output .= '<div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-7 alert alert-danger" role="alert"">
                                <label onclick="getOptionConfig('. $options->values()->get($i)->id .');">'.  $options->values()->get($i)->option .'</label>
                            </div>
                            <div class="col-md-1 alert alert-danger" role="alert"">
                                <i class="fa fa-trash" onclick="javascript:deleteOption('. $options->values()->get($i)->id .');"></i>
                            </div>
                            <div class="col-md-2">
                            </div>
                        </div>';            
        }
        $output .= '<div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8 alert alert-danger" role="alert" style="text-align: center;">
                                <input type="text" id="newOptionName"><button type="button" class="btn btn-primary" onclick="javascript:addOption();">Add Option</button>
                            </div>
                            <div class="col-md-2">
                            </div>
                        </div>';      
        return $output;
    }       
    
    public function getOptionConfig(Request $request)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $optionId = $request->input('optionId');
        $option = Option::where('id', $optionId)->get()->first();
        $output = ' <form method="POST" action="javascript:updateOption();" id="edit_option_form" name="edit_option_form" accept-charset="UTF-8" class="form-horizontal">
                        '.csrf_field().'
                        <input name="_method" type="hidden" value="PUT">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 alert alert-light">Name</div>
                                <div class="col-md-5"><input id="option" name="option" type="text" value="'. $option->option .'" style="width:100%; height:80%"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 alert alert-light">Description</div>
                                <div class="col-md-5"><input id="description" name="description" type="text" value="'. $option->description .'" style="width:100%; height:80%"></div>
                                <div class="col-md-4">
                                    <input class="btn btn-primary" type="submit" value="Update">
                                </div>
                            </div>    
                            <div class="row" hidden>
                                <div class="col-md-4 alert alert-light">Property Id</div>
                                <div class="col-md-8"><input id="propertyId" name="propertyId" type="text" value="'. $option->property_id .'"></div>
                            </div>
                            <div class="row" hidden>
                                <div class="col-md-4 alert alert-light">Id</div>
                                <div class="col-md-8"><input type="text" name="optionId" id="optionId" value="'. $option->id .'"></div>
                            </div>
                        </div>
                    </form>';
        return $output;
    }
}
