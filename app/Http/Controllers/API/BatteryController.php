<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Battery;
use Illuminate\Http\Request;
use Validator;
class UserController extends Controller
{
    public $successStatus = 200;
    public function index()
    {
        return Battery::latest()->get();
    }

    public function store(Request $request)
    {         
        $this->validate($request, [
            'wifimac' => 'required',
            'batterylevel' => 'required',
        ]);

        Battery::create([
           'wifi_mac' => $request['wifimac'],
           'battery_level' => $request['batterylevel'],
        ]);
        return response()->json(['success'=>$success], $this->successStatus); 
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {   
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'type' => 'required',
        ]);

        $battery = Battery::findOrFail($id);

        $battery->update($request->all());
    }

    public function destroy($id)
    {
        $battery = Battery::findOrFail($id);
        $battery->delete();
        return response()->json([
         'message' => 'Battery deleted successfully'
        ]);
    }

}
