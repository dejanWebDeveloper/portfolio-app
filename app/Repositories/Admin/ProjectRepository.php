<?php

namespace App\Repositories\Admin;

use App\Models\Category;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\PhotoService;

class ProjectRepository
{
    protected $photoService;

    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    public function projectContent()
    {
        return [
            'categories' => Category::all(),
            'tags' => Tag::all()
        ];
    }

    public function dataTable(Request $request)
    {
        $query = Project::with(['category']);

        if ($request->heading) {
            $query->where('heading', 'like', "%{$request->heading}%");
        }
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->enable !== null && $request->enable !== '') {
            $query->where('enable', $request->enable);
        }
        if ($request->filled('tags_id')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->whereIn('tags.id', $request->tags_id);
            });
        }
        return $query;
    }

    public function saveProject($data)
    {
        $slug = Str::slug($data['heading']);
        $originalSlug = $slug;
        $counter = 1;
        while (Project::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $data['slug'] = $slug;

        $lastProject = Project::orderByDesc('priority')->first();
        if (!$data['priority']) {
            // Ako nije postavljen prioritet, uzmi sledeći najveći
            $data['priority'] = $lastProject ? $lastProject->priority + 1 : 1;
        } else {
            // Pomeramo sve projekte sa istim ili većim prioritetom
            $conflictingProjects = Project::where('priority', '>=', $data['priority'])
                ->orderByDesc('priority')
                ->get();

            foreach ($conflictingProjects as $project) {
                $project->increment('priority'); // direktno u SQL-u
            }
        }

        $data['enable'] = 1;
        $data['created_at'] = now();
        $data['text'] = strip_tags($data['text'], '<img>');
        $project = new Project();
        $project->fill($data)->save();
        //table tags
        $project->tags()->sync($data['tags']);
        return $project;

    }

    public function deleteProject($data)
    {
        $project = Project::findOrFail($data['project_for_delete_id']);

        // Delete associated photos before removing DB record
        $this->photoService->deleteProjectPhoto($project, 'photo');
        $incrementProjects = Project::where('priority', '>', $project->priority)
            ->orderByDesc('priority')
            ->get();
        foreach ($incrementProjects as $incrementProject) {
            $incrementProject->priority -= 1;
            $incrementProject->save();
        }
        // Detach tags
        $project->tags()->sync([]);
        // Finally delete the project
        $project->delete();
    }

    public function editProject($id, $slug)
    {
        return Project::where('slug', $slug)->where('id', $id)->firstOrFail();
    }

    public function saveEditedProject($data, Project $projectForEdit)
    {
        $slug = Str::slug($data['heading']);
        $originalSlug = $slug;
        $counter = 1;
        while (Project::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $data['slug'] = $slug;
        // Ako nema priority, koristi postojeći ili poslednji priority +1, ili 1 ako tabela prazna
        if (empty($data['priority'])) {
            $lastProject = Project::orderByDesc('priority')->first();
            $data['priority'] = $lastProject ? $lastProject->priority + 1 : 1;
        } else {
            $projects = Project::all();
            $projectPriorities = $projects->pluck('priority')->toArray();

            $incrementProjects = Project::where('priority', '>=', $data['priority'])
                ->orderByDesc('priority')
                ->get();

            if (in_array($data['priority'], $projectPriorities)) {
                foreach ($incrementProjects as $incrementProject) {
                    $incrementProject->priority += 1;
                    $incrementProject->save();
                }
            }
        }

        $data['enable'] = 1;
        $data['important'] = 0;
        $data['text'] = strip_tags($data['text'], '<img>');
        $projectForEdit->fill($data)->save();
        //table tags
        $projectForEdit->tags()->sync($data['tags']);
        return $projectForEdit;
    }

    public function deletePhotoJS($projectForEdit)
    {
        if ($projectForEdit->photo) {
            Storage::disk('public')->delete('photo/' . $projectForEdit->photo);
            $projectForEdit->photo = null;
            $projectForEdit->save();
        }
    }

    public function disableOneProject($data)
    {
        $project = Project::findOrFail($data['project_for_disable_id']);
        $project->enable = 0;
        $project->save();
    }

    public function enableOneProject($data)
    {
        $project = Project::findOrFail($data['project_for_enable_id']);
        $project->enable = 1;
        $project->save();
    }

}
