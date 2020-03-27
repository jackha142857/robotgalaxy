<?php

namespace App\Http\Controllers;

use App\Models\InputType;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class PropertiesController extends Controller
{
    /**
     * Store a new property in the storage.
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
            $name = '';
            $input_type_id = 1;
            $description = '';
            $order = 0;
            $filter = 0;            
            if($request->has('name')) {
                $name = $request->input('name');
            }
            if($request->has('input_type_id')) {
                $input_type_id = $request->input('input_type_id');
            }
            if($request->has('description')) {
                $description = $request->input('description');
            }
            if($request->has('order')) {
                $order = $request->input('order');
            }
            if($request->has('filter')) {
                $filter = $request->input('filter');
            }            
            if($name == null) {
                return "Fail to add property! Error: Property name is required";
            }
            Property::create(['name' => $name, 'input_type_id' => $input_type_id, 'description' => $description, 'order' => $order, 'filter' => $filter]);
            return "Property has been added successfully!";
        } catch (Exception $exception) {
            return "Fail to add property! Error: " . $exception->getMessage();
        }
    }

    /**
     * Update the specified property in the storage.
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
            $property = Property::findOrFail($id);
            $name = $property->name;
            $input_type_id = $property->input_type_id;
            $description = $property->description;
            $order = $property->order;
            $filter = $property->filter;
            if($request->has('name')) {
                $name = $request->input('name');
            }
            if($request->has('input_type_id')) {
                $input_type_id = $request->input('input_type_id');
            }
            if($request->has('description')) {
                $description = $request->input('description');
            }
            if($request->has('order')) {
                $order = $request->input('order');
            }
            if($request->has('filter')) {
                $filter = $request->input('filter');
            }  
            $property->update(['name' => $name, 'input_type_id' => $input_type_id, 'description' => $description, 'order' => $order, 'filter' => $filter]);
            return "Property has been updated successfully!";
        } catch (Exception $exception) {
            return "Fail to update property! Error: " . $exception->getMessage();
        }
    }

    /**
     * Remove the specified property from the storage.
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
            $property = Property::findOrFail($id);
            $property->delete();
            $properties = Property::where('order', '!=', 0)->get()->sortBy('order');
            $request = new Request();
            for($i = 0; $i < $properties->count(); $i++) {
                $request->replace(['order' => $i+1]);
                $this->update($properties->values()->get($i)->id, $request);
            }            
            return "Property has been deleted successfully!";
        } catch (Exception $exception) {
            return "Fail to delete property! Error: " . $exception->getMessage();
        }
    }
    
    public function getProperties()
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $properties = Property::all()->sortBy('order');
        $output = "";
        $filter = "";
        $up = "";
        $down = "";
        $isActive = "";
        $inactiveProperties = "";
        $output .= '<div class="row">
                            <div class="col-md-2 alert alert-warning" role="alert"">
                                In Filter?
                            </div>
                            <div class="col-md-7 alert alert-warning" role="alert"">
                                Name
                            </div>
                            <div class="col-md-3 alert alert-warning" role="alert"">
                                Customise
                            </div>
                        </div>';
        for ($i = 0; $i < $properties->count(); $i++) {   
            if($properties->values()->get($i)->order != 0) {
                $isActive = '<div class="col-md-7 alert alert-success" role="alert"">
                                <label  ondblclick="javascript:updatePropertyOrder('. $properties->values()->get($i)->id .', 0);"
                                        onclick="javascript:getOptions('. $properties->values()->get($i)->id .');getPropertyConfig('. $properties->values()->get($i)->id .');">'.  $properties->values()->get($i)->name .'</label>
                            </div>';
            } else {
                $isActive = '<div class="col-md-7 alert alert-secondary" role="alert"">
                                <label  ondblclick="javascript:updatePropertyOrder('. $properties->values()->get($i)->id .', '. ($properties->values()->get($properties->count()-1)->order + 1) .');"
                                        onclick="javascript:getOptions('. $properties->values()->get($i)->id .');getPropertyConfig('. $properties->values()->get($i)->id .');">'.  $properties->values()->get($i)->name .'</label>
                            </div>';
            }
            if($properties->values()->get($i)->filter != 0) {
                $filter = '<i class="fa fa-check-circle" onclick="javascript:updatePropertyFilter('. $properties->values()->get($i)->id .', '. 0 .');"></i>';
            } else {
                $filter = '<i class="fa fa-times" onclick="javascript:updatePropertyFilter('. $properties->values()->get($i)->id .', '. 1 .');"></i>';
            }
            if($properties->values()->get($i)->order != 0) {                
                if($properties->values()->get($i)->order == 1) {
                    if($i != $properties->count() - 1) {
                        $up = "";
                        $down = '<i class="fa fa-arrow-circle-down" 
                                onclick="javascript:updatePropertyOrder('. $properties->values()->get($i)->id .', '. ($properties->values()->get($i)->order + 1) .'); 
                                                    updatePropertyOrder('. $properties->values()->get($i+1)->id .', '. ($properties->values()->get($i+1)->order - 1) .');"></i>';
                    } else {
                        $up = "";
                        $down = "";
                    }
                } else if($i == $properties->count() - 1) {
                    $up = '<i class="fa fa-arrow-circle-up"
                            onclick="javascript:updatePropertyOrder('. $properties->values()->get($i)->id .', '. ($properties->values()->get($i)->order - 1) .'); 
                                                updatePropertyOrder('. $properties->values()->get($i-1)->id .', '. ($properties->values()->get($i-1)->order + 1) .');"></i>'; 
                    $down = "";
                } else {
                    $up = '<i class="fa fa-arrow-circle-up"
                            onclick="javascript:updatePropertyOrder('. $properties->values()->get($i)->id .', '. ($properties->values()->get($i)->order - 1) .');
                                                updatePropertyOrder('. $properties->values()->get($i-1)->id .', '. ($properties->values()->get($i-1)->order + 1) .');"></i>'; 
                    $down = '<i class="fa fa-arrow-circle-down"
                            onclick="javascript:updatePropertyOrder('. $properties->values()->get($i)->id .', '. ($properties->values()->get($i)->order + 1) .');
                                                updatePropertyOrder('. $properties->values()->get($i+1)->id .', '. ($properties->values()->get($i+1)->order - 1) .');"></i>';
                }
            } else {
                $up = "";
                $down = "";
            }
            if($properties->values()->get($i)->order == 0) {
                $inactiveProperties .= '<div class="row">
                            <div class="col-md-2 alert alert-success" role="alert"">
                                '. $filter .'
                            </div>
                            '. $isActive.'
                            <div class="col-md-1 alert alert-success" role="alert"">
                                '. $up .'
                            </div>
                            <div class="col-md-1 alert alert-success" role="alert"">
                                '. $down .'
                            </div>
                            <div class="col-md-1 alert alert-success" role="alert"">
                                <i class="fa fa-trash" onclick="javascript:deleteProperty('. $properties->values()->get($i)->id .');"></i>
                            </div>
                        </div>';
            } else {
                $output .= '<div class="row">
                                <div class="col-md-2 alert alert-success" role="alert"">
                                    '. $filter .'
                                </div>
                                '. $isActive.'
                                <div class="col-md-1 alert alert-success" role="alert"">
                                    '. $up .'
                                </div>
                                <div class="col-md-1 alert alert-success" role="alert"">
                                    '. $down .'
                                </div>
                                <div class="col-md-1 alert alert-success" role="alert"">
                                    <i class="fa fa-trash" onclick="javascript:deleteProperty('. $properties->values()->get($i)->id .');"></i>
                                </div>
                            </div>';
            }
        }
        $output .= $inactiveProperties;
        $output .= '<div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8 alert alert-success" role="alert" style="text-align: center;">
                                    <input type="text" id="newPropertyName"><button type="button" class="btn btn-primary" onclick="javascript:addProperty();">Add Property</button>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>';
        return $output;
    }
    
    public function getPropertyConfig(Request $request)
    {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        if(Auth::user()->privilege != 100) {
            return redirect('/');
        }
        $InputTypes = InputType::pluck('name','id')->all();
        $propertyId = $request->input('propertyId');
        $property = Property::where('id', $propertyId)->get()->first();
        $temp1 = '';
        $temp2 = '';
        foreach($InputTypes as $key => $InputType) {
            if($property->input_type_id == $key) {
                $temp1 = 'selected';
            } else {
                $temp1 = '';
            }
            $temp2 .= ' <option value="'. $key .'" '. $temp1 .'>
                            '. $InputType .'
                        </option>';
        }
        $output = ' <form method="POST" action="javascript:updateProperty();" id="edit_property_form" name="edit_property_form" accept-charset="UTF-8" class="form-horizontal">
                        '.csrf_field().'
                        <input name="_method" type="hidden" value="PUT">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 alert alert-light">Name</div>
                                <div class="col-md-5"><input id="name" name="name" type="text" value="'. $property->name .'" style="width:100%; height:80%"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 alert alert-light">Input type</div>
                                <div class="col-md-5">
                                    <select class="form-control" id="input_type_id" name="input_type_id" required="true" style="width:100%; height:80%">
                	                   '. $temp2 .'
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 alert alert-light">Description</div>
                                <div class="col-md-5"><input id="description" name="description" type="text" value="'. $property->description .'" style="width:100%; height:80%"></div>                                
                                <div class="col-md-4">
                                    <input class="btn btn-primary" type="submit" value="Update">
                                </div>
                            </div>
                            <div class="row" hidden>
                                <div class="col-md-4 alert alert-light">Filter Order</div>
                                <div class="col-md-8"><input type="number" name="filter" id="filter" min="0" max="100" value="'. $property->filter .'"></div>
                            </div>
                            <div class="row" hidden>
                                <div class="col-md-4 alert alert-light">Id</div>
                                <div class="col-md-8"><input id="propertyId" name="propertyId" type="text" value="'. $property->id .'"></div>
                            </div>
                            <div class="row" hidden>
                                <div class="col-md-4 alert alert-light">Display Order</div>
                                <div class="col-md-8"><input type="number" name="order" id="order" min="0" max="100" value="'. $property->order .'"></div>
                            </div>
                        </div>
                    </form>';
        return $output;
    }
}
