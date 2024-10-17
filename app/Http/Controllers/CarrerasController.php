<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use Illuminate\Http\Request;

class CarrerasController extends Controller
{
    public function index()
    {
        $carreras = Carreras::all();
        return response()->json($carreras);
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|string|max:100'
        ];
        $validator = \Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->all()
            ], 400);            
        } 
        $carrera = new Carreras($request->input());
        $carrera->save();
        return response()->json([
            'status' => true,
            'message' => 'Carrera created successfully',
            'data' => $carrera
        ], 201);
    }

    public function show(Carreras $carrera)
    {
        return response()->json([
            'status' => true,
            'message' => 'Carrera details',
            'data' => $carrera
        ]);
    }

    public function update(Request $request, Carreras $carrera)
    {
        $rules = [
            'nombre' => 'required|string|max:100'
        ];
        $validator = \Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->all()
            ], 400);            
        } 
        $carrera->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Carrera updated successfully',
            'data' => $carrera
        ], 201);
    }

    public function destroy(Carreras $carrera)
    {
        $carrera->delete();
        return response()->json([
            'status' => true,
            'message' => 'Carrera deleted successfully'
        ], 200);
    }
}