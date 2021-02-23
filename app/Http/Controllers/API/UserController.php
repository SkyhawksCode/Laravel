<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pda;
use App\Models\Battery;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public $successStatus = 200;
    public function index()
    {
        return User::latest()->get();
    }

    public function store(Request $request)
    {   
        /** PDA create or update start */
        $this->validate($request, [
            'wifimac' => 'required',
            'batterylevel' => 'required',
            'pdaname' => 'required',
            'username' => 'required',
        ]);
        
        $result = DB::table('pdas')
            ->select(DB::raw('*'))
            ->where('wifimac', '=', $request['wifimac'])
            ->count();
        
        if($result == 0){
            Pda::create([
                'wifimac'       => $request['wifimac'],
                'pdaname'       => $request['pdaname'],
                'description'   => '',
                'reference'     => '',
                'purchaseddate' => date("Y-m-d"),
                'batterylevel'  => $request['batterylevel'],
            ]);
        }else{
            DB::table('pdas')
                ->where('wifimac', $request['wifimac'])
                ->update(['batterylevel' => $request['batterylevel']]);
        }
        /** PDA create or update end */

        /** PDA name get */

        $result = DB::table('pdas')
            ->select(DB::raw('pdaname'))
            ->where('wifimac', '=', $request['wifimac'])
            ->first();

        $pdaname = $result->pdaname;
        
        //SELECT user_id FROM batteries WHERE id = (SELECT MAX(id) FROM batteries WHERE pdaname='sdk_gphone_x86_arm')

        $last_user_id = "";
        $realylastname = "";

        $lastid = DB::table('batteries')
            ->select(DB::raw('max(id) as uid'))
            ->where('wifi_mac', '=', $request['wifimac'])
            ->get();

        foreach($lastid as $name => $last){
            $last_id = $last->uid;
        } 
        
        $lastuserid = DB::table('batteries')
            ->select(DB::raw('user_id'))
            ->where('id', '=', $last_id)
            ->get();

        foreach($lastuserid as $name => $lastuser){
            $last_user_id = $lastuser->user_id;
        }
        
        $curusername = DB::table('users')
            ->select('name')
            ->where('email', '=', $request['username'])
            ->get();

        foreach($curusername as $name => $curname){
            $realycurname = $curname->name;
        } 
        
        if($last_user_id == $realycurname){

            $current_user_id = DB::table('batteries')
                ->select(DB::raw('max(id) as uid'))
                ->where('user_id', '=', $last_user_id)
                ->get();
            
            foreach($current_user_id as $name => $current){
                $current_id = $current->uid;
            } 

            $affected = DB::table('batteries')
                ->where('id', $current_id)
                ->update(['wifi_mac' => $request['wifimac'], 'battery_level' => $request['batterylevel'], 'charge_status' => $request['chargestatus'], 'updated_at' => date("Y-m-d H:i:s")]);

        }else{
            
            
            Battery::create([
                'wifi_mac' => $request['wifimac'],
                'battery_level' => $request['batterylevel'],
                'pdaname' => $pdaname,
                'user_id' => $realycurname,
                'last_user_id' => $last_user_id,
                'charge_status' => $request['chargestatus'],
            ]);

        }

        $success['savestatus'] =  "ok";
        return response()->json(['success'=>$success], $this->successStatus); 
    }

    public function show($id)
    {
        //
    }

    public function getsetting()
    {
        //
        $setting = DB::table('settings')
            ->select('*')
            ->first();
        
        return response()->json([
            'interval' => $setting->interval,
            'lowbattery' => $setting->lowbattery,
            'adminemail' => $setting->adminemail
        ]);
    }

    public function update(Request $request, $id)
    {   
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'type' => 'required',
        ]);

        $user = User::findOrFail($id);

        $user->update($request->all());
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
         'message' => 'User deleted successfully'
        ]);
    }

    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => true, 'token' => $token], $this-> successStatus); 
        } 
        else{
            return response()->json(['success' => false, 'error' => "unauthorized"]); 
        }
    }
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], $this->successStatus); 
    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 
}
