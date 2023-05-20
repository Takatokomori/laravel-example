<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StudentRequest;
use Illuminate\View\View;
use App\Models\Student;
use App\Models\Region;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $regions = Region::with('students')->get();

        return view("regions.index", compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request): RedirectResponse
    {
        \DB::beginTransaction();
        try
        {
            $region = new Region();
            $region->name = $request->name;
            $region->save();

            \DB::commit();
        }
        catch(\Throable $e)
        {
            \DB::rollback();
            abort(500);
        }

        return redirect(route("regions.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $region = Region::findOrFail($id);
        return view('regions.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $region = Region::findOrFail($id);
        $students = Student::all();
        $myStudentIds = $region->students()
                               ->pluck('student_id')
                               ->toArray();

        return view('regions.edit',
                compact([
                    'region', 'students'
                    ,'myStudentIds'
                ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request,
                        Region $region): RedirectResponse
    {
        \DB::beginTransaction();
        try{
            $region = Region::find($region->id);
            $region->name = $request->name;
            $region->students()->sync($request->input("studentIds", []));
            $region->save();
            \DB::commit();
        }
        catch(\Thorwable $e){
            \DB::rollback();
            abort(500);
        }
        return redirect(route("regions.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        \DB::beginTransaction();
        try{
            $region = Region::find($id);
            $region->students()->detach();
            $region->delete();
            \DB::commit();
        }
        catch(\Thorwable $e){
            \DB::rollback();
            abort(500);
        }
        return redirect(route("regions.index"));
    }
}
