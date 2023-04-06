<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectFeatureRequest;
use App\Models\Project;
use App\Models\ProjectFeatures;
use Illuminate\Http\Request;

class ProjectFeaturesController extends Controller
{
    public function index()
    {
        $project_features = ProjectFeatures::where('status', 0)->get();

        return view('project_features.index', compact('project_features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();

        return view('project_features.create',compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectFeatureRequest $request)
    {
        $project_features =  $request->validated();

        ProjectFeatures::create($project_features);

        return redirect()->route('project_feature.index')->with('success', 'ProjectFeatures Added Successfully');
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
        $projects = Project::all();
        $project_feature = ProjectFeatures::find($id);

        return view('project_features.edit', compact('project_feature','projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectFeatureRequest $request, $id)
    {
        $project_feature = ProjectFeatures::find($id);
        $project_featuresData =  $request->validated();

        $project_feature->update($project_featuresData);

        return redirect()->route('project_feature.index')->with('success', 'ProjectFeatures Updated Successfully');
    }
    public function delete($id)
    {
        $employee = ProjectFeatures::find($id);

        $data = [
            'status' => 1
        ];
        $employee->update($data);
        
        return redirect()->back()->with('success', 'Employee Delete Successfully');
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
