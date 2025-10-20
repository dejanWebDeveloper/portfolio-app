<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Admin\CategoryRepository;


class CategoryController extends Controller
{
    protected $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.category_pages.categories_page');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category_pages.add_category_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'between:5,50', 'unique:categories,name']
        ]);
        $this->categories->store($data);
        session()->put('system_message', 'Category Added Successfully');
        return redirect()->route('admin.categories.index');
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = request()->validate([
            'category_for_delete_id' => ['required', 'integer', 'exists:categories,id']
        ]);
        $this->categories->delete($data);

        return response()->json(['success' => 'Category Deleted Successfully']);
    }

    public function datatable()
    {
        $query = $this->categories->getFilteredCategory();

        return DataTables::of($query)
            ->addColumn('name', fn($row) => $row->name)
            ->editColumn('created_at', fn($row) => $row->created_at?->format('d/m/Y H:i:s'))
            ->addColumn('actions', fn($row) => view('admin.category_pages.partials.actions', compact('row')))
            ->rawColumns(['actions'])
            ->toJson();
    }
}
