<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     * Show Blogs
     * 
     * @return view
     */
    public function showList()
    {
        $blogs = Blog::all();
        return view("blog.list", compact("blogs"));
    }

    /**
     * show Blog detail
     * 
     * @return view
     */
    public function showDetail($id)
    {
        $blog = Blog::find($id);
        if(is_null($blog))
        {
            \Session::flash("err_msg", "I'm sorry, we couldn't find data you wanted");
            return redirect(route("blogs"));
        }
        return view("blog.detail", compact("blog"));
    }

    /**
     * show Blog create form
     * 
     * @return view
     */
    public function create()
    {
        return view("blog.form");
    }

    /**
     * show Blog create form
     * 
     * @return view
     */
    public function store(BlogRequest $request)
    {
        $input = $request->all();

        \DB::beginTransaction();
        try{
            Blog::create($input);
            \DB::commit();
        }
        catch(\Thorwable $e){
            \DB::rollback();
            abort(500);
        }
        \Session::flash("err_msg", "We saved the blog");
        return redirect(route("blogs"));
    }
}
