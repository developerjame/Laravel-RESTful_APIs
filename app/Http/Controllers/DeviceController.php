<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Validator;

class DeviceController extends Controller
{
    //
    function add(Request $req)
    {
        $device=new Device;
        $device->name=$req->name;
        $device->member_id=$req->member_id;
        $result=$device->save();
        if($result)
        {
            return ["Result"=>"Data has been saved"];
        }
        else
        {
            return ["Result"=>"Operation failed"];
        }
    }
    function update(Request $req)
    {
        $device=Device::find($req->id);
        $device->name=$req->name;
        $device->member_id=$req->member_id;
        $result=$device->save();
        if($result)
        {
            return ["result"=>"data has been updated"];
        }
        else
        {
            return ["result"=>"update operation has been failed"];
        }
    }
    function delete($id)
    {
        $device= Device::find($id);
        $result=$device->delete();
        if($result)
        { 
        return ["result"=>"record has been delete"];
        }
        else
        {
            return ["result"=>"delete operation is failed"];
        }
    }
    function search($name)
    {
        return Device::where("name","like","%".$name."%")->get();
    }
    function testData(Request $req)
    {
        $rules=array(
            "name"=>"required|min:2|max:10"
        );
        $validator= Validator::make($req->all(), $rules);
        if($validator->fails())
        {
            return response()->json($validator->errors(),401);
        }
        else
        {
            $device= new Device;
            $device->name=$req->name;
            $device->member_id=$req->member_id;
            $result=$device->save();
            if($result)
            {
                return ["Result"=>"Data has been saved"];
            }
            else
            {
                return ["Result"=>"Operation failed"];
            }
        }
       
    }

    public function index()
    {
        //
        return Device::all();
    }
}
