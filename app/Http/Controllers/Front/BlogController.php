<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Front\ProjectRepository;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $projects;

    public function __construct(ProjectRepository $projects)
    {
        $this->projects = $projects;
    }

    public function blog()
    {
        $blogProjects = $this->projects->getBlogProjects();

        return view('front.blog_pages.blog_page.blog_page', compact('blogProjects'));
    }

    public function blogCategory($id, $slug)
    {
        $category = Category::where('slug', $slug)->where('id', $id)->firstOrFail();
        $categoryProjects = $this->projects->getCategoryProjects($category->id);
        return view('front.blog_pages.blog_category_page.blog_category_page', compact(
            'category',
            'categoryProjects'
        ));
    }

    public function blogProject($id, $slug)
    {
        $singleProject = $this->projects->getSingleProject($id, $slug);
        $this->projects->incrementProjectViews($singleProject);
        $singleProjectTags = $singleProject->tags()->get();
        $prevProject = $this->projects->getPrevProject($id, $singleProject);
        $nextProject = $this->projects->getNextProject($id, $singleProject);
        return view('front.blog_pages.blog_project_page.blog_project_page', compact(
            'singleProject',
            'singleProjectTags',
            'prevProject',
            'nextProject',
        ));
    }

    public function blogSearch(Request $request)
    {
        $query = $request->input('search');
        $results = $this->projects->getProjectsResult($query);
        return view('front.blog_pages.blog_search_page.blog_search_page', compact(
            'results',
            'query'
        ));
    }

}
