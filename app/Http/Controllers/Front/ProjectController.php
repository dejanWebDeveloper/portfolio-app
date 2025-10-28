<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Front\ProjectRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projects;

    public function __construct(ProjectRepository $projects)
    {
        $this->projects = $projects;
    }

    public function projects()
    {
        $projects = $this->projects->getBlogProjects();

        return view('front.project_pages.projects_page.projects_page', compact('projects'));
    }

    /*public function projectCategory($id, $slug)
    {
        $category = Category::where('slug', $slug)->where('id', $id)->firstOrFail();
        $categoryProjects = $this->projects->getCategoryProjects($category->id);
        return view('front.project_pages.blog_category_page.blog_category_page', compact(
            'category',
            'categoryProjects'
        ));
    }*/

    public function project($id, $slug)
    {
        $singleProject = $this->projects->getSingleProject($id, $slug);
        $this->projects->incrementProjectViews($singleProject);
        $singleProjectTags = $singleProject->tags()->get();
        return view('front.project_pages.single_project_page.project_page', compact(
            'singleProject',
            'singleProjectTags'
        ));
    }

    public function projectSearch(Request $request)
    {
        $query = $request->input('search');
        $results = $this->projects->getProjectsResult($query);
        return view('front.project_pages.blog_search_page.blog_search_page', compact(
            'results',
            'query'
        ));
    }

}
