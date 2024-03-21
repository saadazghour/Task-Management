<?php

namespace App\Http\Controllers;

use App\Models\Taches;
use Illuminate\Http\Request;

use App\Models\Product;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;



class TachesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return Taches::select('id', 'title', 'description')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'title'=>'required',
            'description'=>'required',
        ]);

         $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{

            $taches = Taches::create($validator->validated());

            return response()->json([
                'message' => 'Taches Created Successfully!!',
                'taches' => $taches,
            ]);

        }catch(\Exception $e){

           Log::error($e->getMessage());
            return response()->json([
                'message' => 'Something goes wrong while creating a Taches!!',
                'error' => $e->getMessage() // Add this line to return the error message

            ], 500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Taches $taches)
    {
        //
        return response()->json(['taches' => $taches]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Taches $taches)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Taches $taches)
    {
        //

         $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{

            $taches->fill($validator->validated())->save();

            return response()->json([
                'message' => 'Taches Updated Successfully!!',
                'taches' => $taches,
            ]);

        }catch(\Exception $e){
           Log::error($e->getMessage());
            return response()->json([
                'message' => 'Something goes wrong while updating a taches!!'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Taches $taches)
    {
        //
        try {
            //code...
            $taches->delete();

            return response()->json([
                'message' => 'Taches Deleted Successfully!!'
            ], 200);

        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Something goes wrong while deleting a taches!!'
            ], 500);


        }

    }
}
