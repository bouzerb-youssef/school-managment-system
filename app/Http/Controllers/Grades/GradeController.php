<?php

namespace App\Http\Controllers\Grades;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Grades=Grade::all();
       return view('pages.grades.grades',compact("Grades"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGrades $request)
    {
        
      try {
        $validated = $request->validated();
        $Grade = new Grade();
        /*
        $translations = [
            'en' => $request->Name_en,
            'ar' => $request->Name
        ];
        $Grade->setTranslations('Name', $translations);
        */
        $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
        $Grade->Notes = $request->Notes;
        $Grade->save();
        toastr()->success(trans('messages.success'));
        return redirect()->route('Grades.index');
    }

    catch (\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
