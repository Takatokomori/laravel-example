<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     * Show Blogs
     * 
     * @return view
     */
    public function index(): View
    {
        $blogs = Blog::all();
        return view("blogs.index", compact("blogs"));
    }

    public function show(int $id): View
    {
        $blog = Blog::findOrFail($id);
        return view("blogs.show", compact("blog"));
    }

    /**
     * store input form
     * 
     * @return view
     */
    public function store(BlogRequest $request): RedirectResponse
    {
        $input = $request->all();

        \DB::beginTransaction();
        try{
            Blog::create($input);
            \DB::commit();
            \Session::flash("err_msg", "We saved the blog.");
        }
        catch(\Thorwable $e){
            \DB::rollback();
            abort(500);
            \Session::flash("err_msg", "We had some trouble.");
        }
        return redirect(route("blogs.index"));
    }

    /**
     * show Blog detail
     * 
     * @return view
     */
    public function edit(Blog $blog): View
    {
        return view("blogs.detail", [
            "blog" => $blog
        ]);
    }

    /**
     * update form
     * 
     * @return view
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $input = $request->all();
        $blog->save($input);
        return redirect(route("blogs.index"));
    }

    /**
     * delete item
     * 
     * @return view
     */
    public function destroy(Blog $blog)
    {
        \DB::beginTransaction();
        try{
            $blog->delete();
            \DB::commit();
            \Session::flash("err_msg", "Successfully deleted the item.");
        }
        catch(\Thorwable $e){
            \DB::rollback();
            abort(500);
            \Session::flash("err_msg", "Failed to delete the info.");
        }
        return redirect(route("blogs.index"));
    }
}
