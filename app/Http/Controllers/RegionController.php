<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegionRequest;
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
    public function store(RegionRequest $request): RedirectResponse
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
        $myStudentIds = $region->students()->pluck('student_id')->toArray();
        $myAdminStudentIds = $region->students()
            ->wherePivot('is_admin', false)
            ->pluck('student_id')
            ->toArray();

        // Retrieve the students with prices for the region
        $studentsWithPrices = $region->students()
            ->whereIn('student_id', $myStudentIds)
            ->withPivot('price')
            ->get();

        // Extract the prices from the pivot table
        $prices = $studentsWithPrices->pluck('pivot.price', 'pivot.student_id');
        return view('regions.edit', compact('region', 'students', 'myStudentIds', 'myAdminStudentIds', 'prices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegionRequest $request, Region $region): RedirectResponse
{
    \DB::beginTransaction();
    try {
        // Validate the request
        $validatedData = $request->validated();
        $region = Region::find($region->id);
        $region->name = $request->name;

        $studentIds = $request->input('studentIds', []);
        $prices = $request->input('prices', []);
        $studentsWithPrices = [];

        foreach ($studentIds as $studentId) {
            $price = $prices[$studentId] ?? null;

            // Build the array of students with their prices
            $studentsWithPrices[$studentId] = ['price' => $price];
        }

        $region->students()->sync($studentsWithPrices);
        $region->save();
        \DB::commit();
    } catch (\Throwable $e) {
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
