<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Battery;

class BatteryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $batteries = Battery::all(); 
        
        return view('index',compact('batteries'));
    }

    public function allget()
    {
        //ajax: "../../controllers/staff.php",
        $batteries = Battery::all();       
        return view('index',compact('batteries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'wifi_mac' => 'required|max:255',
            'battery_level' => 'required',
            'pdaname' => 'required|max:255',
            'last_user_id' => 'required',
            'user_id' => 'required',
        ]);
        $show = Battery::create($validatedData);
   
        return redirect('/batteries')->with('success', 'Battery Status is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $battery = Battery::findOrFail($id);
        return view('edit', compact('battery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
            'wifi_mac' => 'required|max:255',
            'battery_level' => 'required',
            'pdaname' => 'required|max:255',
            'last_user_id' => 'required',
            'user_id' => 'required',
        ]);
        Battery::whereId($id)->update($validatedData);

        return redirect('/batteries')->with('success', 'Battery Status Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $battery = Battery::findOrFail($id);
        $battery->delete();

        return redirect('/batteries')->with('success', 'Battery Status Data is successfully deleted');
    }

    public function tocsv()
    {
        //
        //return Excel::download(new UsersExport, 'users.csv'); very nice!
        $fileName = 'batteries.csv';

        $tasks = DB::table('batteries')
            ->select(DB::raw('batteries.*, TIMEDIFF(updated_at, created_at) AS usedtime'))
            ->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Current User', 'PDA Name', 'battery Level', 'Time Used', 'Date Time', 'Last User', 'WiFi MAC Address');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['cusername']       = $task->user_id;
                $row['pdaname']         = $task->pdaname;
                $row['batterylevel']    = $task->battery_level;
                $row['usedtime']        = $task->usedtime;
                $row['datetime']        = $task->updated_at;
                $row['lusername']       = $task->last_user_id;
                $row['wifimacaddr']     = $task->wifi_mac;

                fputcsv($file, array($row['cusername'], $row['pdaname'], $row['batterylevel'], $row['usedtime'], $row['datetime'], $row['lusername'], $row['wifimacaddr']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}
