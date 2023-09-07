<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('updated_at', 'DESC')->get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        $types = Type::select('id', 'label')->get();
        return view('admin.projects.create', compact('project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:50|unique:projects',
                'content' => 'nullable|string',
                'image' => 'nullable|image',
                'url' => 'nullable|url',
                'type_id' => 'nullable|exists:types,id'
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.unique' => 'Questo titolo esiste già',
                'title.max:50' => 'Il titolo non può essere più lungo di 50 caratteri',
                'url.url' => "L'Url deve essere un link valido",
                'image.image' => "Il file non è valido",
                'type_id.exists' => 'Il tipo non è valido'
            ]
        );

        $data = $request->all();
        $project = new project();

        if (array_key_exists('image', $data)) {
            $img_url = Storage::putFile('project_images', $data['image']);

            $data['image'] = $img_url;
        }

        $project->fill($data);
        $project->slug = Str::slug($project->title, '-');
        $project->save();

        return to_route('admin.projects.show', $project)
            ->with('alert-message', 'Progetto aggiunto con successo')
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::select('id', 'label')->get();

        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        $request->validate(
            [
                'title' => ['required', 'string', 'max:50', Rule::unique('projects')->ignore($project->id)],
                'content' => 'nullable|string',
                'image' => 'nullable|image',
                'url' => 'nullable|url',
                'type_id' => 'nullable|exists:types,id'
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.unique' => 'Questo titolo esiste già',
                'title.max:50' => 'Il titolo non può essere più lungo di 50 caratteri',
                'url.url' => "L'Url deve essere un link valido",
                'image.image' => "Il file non è valido",
                'type_id.exists' => 'Il tipo non è valido'
            ]
        );

        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '-');

        if (array_key_exists('image', $data)) {
            if ($project->image) Storage::delete($project->image);
            $img_url = Storage::putFile('project_images', $data['image']);

            $data['image'] = $img_url;
        }

        $project->update($data);

        return to_route('admin.projects.show', $project)
            ->with('alert-message', 'Progetto modificato con successo')
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')->with('type', 'success')->with('message', 'Il progetto è stato eliminato con successo!');
    }

    /**
     * Show trash storage.
     */
    public function trash()
    {
        $projects = Project::onlyTrashed()->get();
        return view('admin.projects.trash', compact('projects'));
    }

    /**
     * Definitive remove the specified resource from trash.
     */
    public function drop(string $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        if ($project->image) Storage::delete($project->image);
        $project->forceDelete();

        return to_route('admin.projects.trash')->with('type', 'success')->with('message', 'Il progetto è stato eliminato definitivamente con successo!');
    }

    /**
     * Restore the specified resource from trash.
     */
    public function restore(string $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();

        return to_route('admin.projects.show', compact('project'))->with('type', 'info')->with('message', 'Il progetto è stato ripristinato!');
    }
}
