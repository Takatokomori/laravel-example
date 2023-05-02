<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $students = Student::all();
        return view("students.index", compact("students"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request):RedirectResponse
    {
        $student = new Student();
        $student->name = $request->name;
        Student::create($request->all());
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
        return view("students.edit", compact("student"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, 
                           Student $student): RedirectResponse
    {
        $student = Student::find($student->id);
        $student->name = $request->name;
        $student->save();
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
