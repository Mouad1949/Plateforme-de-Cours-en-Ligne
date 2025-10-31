<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Http\Requests\StoreCourRequest;
use App\Http\Requests\UpdateCourRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class CourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cours = Cour::all();
        return $cours;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourRequest $request)
    {
    
        $cour=$request->user()->teachCour()->create([
          "title" => $request->title,
          "description" => $request->description,
        ]);
        return response()->json([
        "messsage"=>"create cour successfuly",
        "cour"=>$cour
      ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cour $cour,$id)
    {
        $cour = Cour::find($id);
        return $cour;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourRequest $request, Cour $cour ,$id)
    {

        $cour = Cour::find($id);
        $cour->title = $request->title;
        $cour->description = $request->description;
        $cour->update();

        return response()->json([
        "messsage"=>"update cour successfuly",
        "cour"=>$cour
      ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cour $cour ,$id)
    {
        $cour = Cour::find($id);
        return response()->json([
        "messsage"=>"delete cour successfuly",
        "cour"=>$cour
      ]);
    }

    public function enroll(Request $request ,$id){
      $user = $request->user();
      
      $courid = $id;
      $user->cours()->attach($courid);
      return response()->json([
        'message' => 'Enrolled successfully',
        'cours_id' => $courid
    ]);
    }

    public function mycours(Request $request){
      $user = $request->user();
      $cours = $user->cours;
        return response()->json([
        'message' => 'My cours',
        'cours' => $cours 
    ]);
    }
}
