<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(4);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project =  new Project;
        $types =  Type::all();
        return view('admin.projects.create', compact('project', 'types')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->all();
        $data = $this->validation($request->all());

        $project = new Project;

        $project->fill($data);

        $project->save();

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
    //  * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {

        return view('admin.projects.show', compact('project'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
    //  * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types =  Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
    //  * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // $data = $request->all();
        $data = $this->validation($request->all());
		$project->update($data);
		return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
    //  * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
		return redirect()->route('admin.projects.index');
    }

    private function validation($data)
    {
        $validator = Validator::make(
            $data,
            [
              //... regole di validazione
              'title' => 'required|string|max:150',
              'type_id' => 'required',
              'content' => 'required|max:300',
              'link' => 'required',
            ],
            [
              //... messaggi di errore
              'title.required' => 'Il titolo è obbligatorio',
              'title.string' => 'Il titolo deve essere una stringa',
              'title.max' => 'Il titolo deve essere lungo max 150 caratteri',

              'type_id.required' => 'Devi selezionare una categoria',
              
              'content.required' => 'La descrizione è obbligatoria',
              'content.max' => 'Il titolo deve essere lungo max 300 caratteri',
              
              'link.required' => 'Il link è obbligatorio',
              ]
          )->validate();

          return $validator;
    }
}
