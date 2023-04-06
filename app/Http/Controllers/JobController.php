<?php

namespace App\Http\Controllers;

use App\Models\JobLevel;
use App\Models\JobTitle;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $job_titles = JobTitle::get();
        $job_lelvels = JobLevel::get();
        
        return view('job', compact('job_titles', 'job_lelvels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function job_title_store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|unique:job_titles,name|max:255',
        ]);

        JobTitle::create($input);

        return redirect()->back()->with('success','Successfully Added Job Title');
    }




    public function job_level_store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|unique:job_levels,name|max:255',
        ]);

        JobLevel::create($input);

        return redirect()->back()->with('success','Successfully Added Job Title');
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
    }
}
