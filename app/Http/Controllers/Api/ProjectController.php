<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index() {
        
        // $projects = Project::with('technologies', 'type')->get();
        $projects = Project::with('technologies', 'type')->paginate(5);
       
        
        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }

    public function show($slug){

        $project = Project::where('slug', '=', $slug)->with('technologies', 'type')->first();


        if($project){
            
            $data = [

                'success' => true,
                'project' => $project,

            ];

        }else{
            
            $data = [

                'success' => false,
                'error' => 'No project with this url has been found',
            ];
        }

        return response()->json($data);
    }
}
