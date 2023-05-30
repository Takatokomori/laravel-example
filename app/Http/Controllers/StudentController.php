<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Models\Course;
use App\Models\Region;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $students = Student::with("courses")->get();
        $courses = Course::all();

        return view("students.index",
                    compact(["students", "courses"]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request):RedirectResponse
    {
        \DB::beginTransaction();
        try{
            $student = new Student();
            $student->name = $request->name;
            $student->save();
            $courseIds = $request->input("courseIds");
            $student->courses()->attach($courseIds);
            \DB::commit();
        }
        catch(\Thorwable $e){
            \DB::rollback();
            abort(500);
        }
        return redirect(route("students.index"));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $student = Student::findOrFail($id);
        return view("students.show", compact("student"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $student = Student::findOrFail($id);
        $courses = Course::all();
        $regions = Region::all();
        $myCourseIds = $student->courses()
                               ->pluck("course_id")
                               ->toArray();
        $myAdminStudentIds = $student->regions()
                               ->wherePivot('is_admin', false)
                               ->pluck('region_id')
                               ->toArray();

        return view("students.edit",
                    compact(["student", "courses",
                    "regions", "myCourseIds", "myAdminStudentIds"]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, 
                           Student $student): RedirectResponse
    {
        \DB::beginTransaction();
        try{
            $student = Student::find($student->id);
            $student->name = $request->name;
            $student->courses()->sync($request->input("courseIds", []));
            $student->save();
            \DB::commit();
        }
        catch(\Thorwable $e){
            \DB::rollback();
            abort(500);
        }
        return redirect(route("students.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        \DB::beginTransaction();
        try{
            $student = Student::find($id);
            $student->courses()->detach();
            $student->regions()->detach();
            $student->delete();
            \DB::commit();
        }
        catch(\Thorwable $e){
            \DB::rollback();
            abort(500);
        }
        return redirect(route("students.index"));
    }
}
