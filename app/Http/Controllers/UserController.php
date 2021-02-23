<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Excel;
use Illuminate\Support\Facades\DB;
use App\Exports\UsersExport;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('users/index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users/create');
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
            'firstname' => 'required|max:255',
            'lastname'  => 'required|max:255',
            'name'      => 'required|max:255|unique:users',
            'password'  => 'required|min:8',
            'confpass'  => 'required|min:8|same:password',
            'email'     => 'required|max:255',
        ]);
        $show = User::create($validatedData);
   
        return redirect('/users')->with('success', 'User is successfully saved');
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
        $user = User::findOrFail($id);
        return view('users/edit', compact('user'));
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
            'firstname' => 'required|max:255',
            'lastname'  => 'required|max:255',
            'name'      => 'required|max:255',
            'password'  => 'required|min:8',
            'confpass'  => 'required|min:8|same:password',
            'email'     => 'required|max:255',
        ]);

        $validatedData = $request->validate([
            'firstname' => 'required|max:255',
            'lastname'  => 'required|max:255',
            'name'      => 'required|max:255',
            'password'  => 'required|min:8',
            'email'     => 'required|max:255',
        ]);

        User::whereId($id)->update($validatedData);

        return redirect('/users')->with('success', 'User Data is successfully updated');
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
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('success', 'User Data is successfully deleted');
    }

    public function toexcel()
    {
        //
        return Excel::download(new UsersExport, 'users.xlsx');
        $fileName = 'users.xlsx';
        $tasks = User::all();

        $headers = array(
            "Content-type"        => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Name', 'First Name', 'Last Name', 'Email', 'Created Date');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['name']  = $task->name;
                $row['firstname']    = $task->firstname;
                $row['lastname']    = $task->lastname;
                $row['email']  = $task->email;
                $row['created_at']  = $task->created_at;

                fputcsv($file, array($row['name'], $row['firstname'], $row['lastname'], $row['email'], $row['created_at']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function tocsv()
    {
        //
        //return Excel::download(new UsersExport, 'users.csv'); very nice!
        $fileName = 'users.csv';
        $tasks = User::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Title', 'Assign', 'Description', 'Start Date', 'created_at');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['name']  = $task->name;
                $row['firstname']    = $task->firstname;
                $row['lastname']    = $task->lastname;
                $row['email']  = $task->email;
                $row['created_at']  = $task->created_at;

                fputcsv($file, array($row['name'], $row['firstname'], $row['lastname'], $row['email'], $row['created_at']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function print()
    {
        return "PRINT";
    }

}
