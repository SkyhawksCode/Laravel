<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Battery;
use App\Models\Settings;
use App\Models\Pda;
use Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //SELECT *, TIMEDIFF(updated_at, created_at) AS usedtime FROM batteries
        // $batteries = DB::table('batteries')
        //     ->select(DB::raw('batteries.*, TIMEDIFF(updated_at, created_at) AS usedtime'))
        //     ->get();
            
        //return view('dashboard/index',compact('batteries'));
        return view('dashboard/index');
    }

    public function ajax()
    {
        //SELECT *, TIMEDIFF(updated_at, created_at) AS usedtime FROM batteries
        $batteries = DB::table('batteries')
            ->select(DB::raw('batteries.*, TIMEDIFF(batteries.updated_at, batteries.created_at) AS usedtime'))
            ->get();
           
        return response()->json($batteries);
    }

    public function search()
    {
        //SELECT *, TIMEDIFF(updated_at, created_at) AS usedtime FROM batteries
        $batteries = DB::table('batteries')
            ->select(DB::raw('batteries.*, TIMEDIFF(updated_at, created_at) AS usedtime'))
            ->get();
              
        return view('dashboard/search',compact('batteries'));
    }

    public function setting()
    { 
        $settings = DB::table('settings')
            ->select(DB::raw('settings.*'))
            ->first();
        return view('dashboard/setting',compact('settings'));
    }

    public function settingsave(Request $request)
    { 
        $validatedData = $request->validate([
            'interval'    => 'required',
            'lowbattery'  => 'required',
            'adminemail'  => 'required|max:255',
        ]);
        if($request->id){
            $id = $request->id;
            Settings::whereId($id)->update($validatedData);
        }else{
            $show = Settings::create($validatedData);
        }
        return redirect('/home/setting')->with('success', 'Settings is successfully saved');
    }

    public function pdasetting()
    { 
        return view('dashboard/pdasetting');
    }

    public function pdapurcase(Request $request)
    {
        $validatedData = $request->validate([
            'wifimac'    => 'required',
            'pdaname'  => 'required',
            'description'  => 'required|max:255',
            'purchaseddate'    => 'required',
            'reference'  => 'required',
            'batterylevel'  => 'required',
        ]);

        $result = DB::table('pdas')
            ->select(DB::raw('*'))
            ->where('wifimac', '=', $request['wifimac'])
            ->count();
        if($result > 0){
            DB::table('pdas')
                ->where('wifimac', $request['wifimac'])
                ->update([
                    'pdaname' => $request['pdaname']
                ]);
        }else{
            $show = Pda::create($validatedData);
        }

        DB::table('batteries')
            ->where('wifi_mac', $request['wifimac'])
            ->update(['pdaname' => $request['pdaname']]);

        return redirect('/home/pdasetting')->with('success', 'Settings is successfully saved');
    }

    public function users()
    {
        return view('users/index');
    }
}
