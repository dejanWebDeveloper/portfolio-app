<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Repositories\Admin\ProjectRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Services\PhotoService;

class ProjectController extends Controller
{
    protected $content;
    protected $photoService;

    public function __construct(ProjectRepository $content, PhotoService $photoService)
    {
        $this->content = $content;
        $this->photoService = $photoService;
    }

    public function index()
    {
        $projectContent = $this->content->projectContent();
        return view('admin.project_pages.projects_page', compact('projectContent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $addProjectContent = $this->content->projectContent();
        return view('admin.project_pages.add_project_form', compact('addProjectContent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'heading' => ['required', 'string', 'min:20', 'max:255'],
            'preheading' => ['required', 'string', 'min:50', 'max:500'],
            'category_id' => ['numeric', 'exists:categories,id'],
            'author' => ['required', 'string'],
            'github_link' => ['required', 'string', 'url'],
            'demo_link' => ['string', 'url', 'nullable'],
            'priority' => ['numeric', 'nullable', 'min:1', 'max:10'],
            'tags' => ['required', 'array', 'min:2'],
            'tags.*' => ['required', 'numeric', 'exists:tags,id'],
            'first-photo' => ['file', 'mimes:jpeg,png,jpg', 'max:1000'],
            'text' => ['required', 'string', 'min:20', 'max:1000']
        ]);
        $newProject = $this->content->saveProject($data);
        //saving photo
        if (request()->hasFile('first-photo')) { //if has file
            $photo = request()->file('first-photo'); //save file to $photo
            //helper methode
            $this->photoService->saveProjectPhoto($photo, $newProject, 'photo');
        }
        session()->put('system_message', 'Project Added Successfully');
        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, $slug)
    {
        $projectForEdit = $this->content->editProject($id, $slug);
        $contentForEdit = $this->content->projectContent();
        return view('admin.project_pages.edit_project_page', compact(
            'projectForEdit',
            'contentForEdit'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $projectForEdit)
    {
        $data = request()->validate([
            'heading' => ['required', 'string', 'min:20', 'max:255'],
            'preheading' => ['required', 'string', 'min:50', 'max:500'],
            'category_id' => ['numeric', 'exists:categories,id'],
            'author' => ['required', 'string'],
            'github_link' => ['required', 'string', 'url'],
            'demo_link' => ['string', 'url'],
            'priority' => ['numeric', 'nullable', 'min:1', 'max:10'],
            'tags' => ['required', 'array', 'min:2'],
            'tags.*' => ['required', 'numeric', 'exists:tags,id'],
            'first-photo' => ['file', 'mimes:jpeg,png,jpg', 'max:1000'],
            'text' => ['required', 'string', 'min:20', 'max:1000']
        ]);
        $projectForEdit = $this->content->saveEditedProject($data, $projectForEdit);

        //saving photo
        if ($request->hasFile('first-photo')) {
            $this->photoService->deleteProjectPhoto($projectForEdit, 'photo');
            $this->photoService->saveProjectPhoto($request->file('first-photo'), $projectForEdit, 'photo');
        }

        if ($request->has('delete_photo1') && $request->delete_photo1) {
            $this->content->deletePhotoJS($projectForEdit);
        }

        session()->put('system_message', 'Project Edited Successfully');
        return redirect()->route('admin.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->content->deleteProject(['project_for_delete_id' => $id]);
        return response()->json(['success' => 'Project Deleted Successfully']);
    }


    public function datatable(Request $request)
    {
        $query = $this->content->dataTable($request);

        return DataTables::of($query)
            ->addColumn('photo', fn($row) => "<img src='" . e($row->imageUrl()) . "' width='100' class='img-rounded' />"
            )
            ->addColumn('heading', fn($row) => $row->heading)
            ->editColumn('enable', fn($row) => $row->enable
                ? '<span class="badge badge-success">Yes</span>'
                : '<span class="badge badge-danger">No</span>')
            ->addColumn('category', fn($row) => $row->category?->name)
            ->addColumn('views', fn($row) => $row->views)
            ->addColumn('github_link', fn($row) => $row->github_link)
            ->addColumn('demo_link', fn($row) => $row->demo_link)
            ->addColumn('priority', fn($row) => $row->priority)
            ->editColumn('created_at', fn($row) => $row->created_at?->format('d/m/Y H:i:s')
            )
            ->addColumn('actions', fn($row) => view('admin.project_pages.partials.actions', compact('row'))
            )
            ->rawColumns(['photo', 'actions', 'enable'])
            ->toJson();
    }

    public function disableProject()
    {
        $data = request()->validate([
            'project_for_disable_id' => ['required', 'numeric', 'exists:projects,id'],
        ]);
        $this->content->disableOneProject($data);
        return response()->json(['success' => 'Project Disabled Successfully']);
    }

    public function enableProject()
    {
        $data = request()->validate([
            'project_for_enable_id' => ['required', 'numeric', 'exists:projects,id'],
        ]);
        $this->content->enableOneProject($data);
        return response()->json(['success' => 'Project Enabled Successfully']);
    }
}
