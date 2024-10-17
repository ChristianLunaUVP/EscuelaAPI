<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use Illuminate\Http\Request;
use App\Models\Carreras;
use DB;

class AlumnosController extends Controller
{
    public function index()
    {
        $alumnos = Alumnos::select('alumnos.*', 'carreras.nombre as carrera')
            ->join('carreras', 'carreras.id', '=', 'alumnos.carrera_id')
            ->orderBy('alumnos.id', 'asc')
            ->paginate(10);
        return response()->json($alumnos);
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|string|max:100',
            'matricula' => 'required|string|max:50',
            'carrera_id' => 'required|numeric|exists:carreras,id',
            'semestre' => 'required|integer|between:1,12',
            'imagen' => 'nullable|image|max:2048'
        ];
        $validator = \Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $alumno = new Alumnos($request->input());
        $alumno->save();
        return response()->json([
            'status' => true,
            'message' => 'Alumno created successfully',
            'data' => $alumno
        ], 201);
    }

    public function show($id)
{
    // Buscar el alumno por el ID proporcionado
    $alumno = Alumnos::find($id);

    if (!$alumno) {
        return response()->json([
            'status' => false,
            'message' => 'Alumno not found'
        ], 404);
    }

    return response()->json([
        'status' => true,
        'data' => $alumno
    ], 200);
}

    public function update(Request $request, $id)
    {
        $rules = [
            'nombre' => 'required|string|max:100',
            'matricula' => 'required|string|max:50',
            'carrera_id' => 'required|numeric|exists:carreras,id',
            'semestre' => 'required|integer|between:1,12',
            'imagen' => 'nullable|image|max:2048'
        ];
        $validator = \Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->all()
            ], 400);
        }
    
        // Encontrar el alumno por ID
        $alumnos = Alumnos::find($id);
        if (!$alumnos) {
            return response()->json([
                'status' => false,
                'message' => 'Alumno not found'
            ], 404);
        }
    
        // Asignar datos al modelo
        $alumnos->nombre = $request->input('nombre');
        $alumnos->matricula = $request->input('matricula');
        $alumnos->carrera_id = $request->input('carrera_id');
        $alumnos->semestre = $request->input('semestre');
    
        // Manejo de archivo de imagen
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $path = $file->store('public/imagenes');
            $alumnos->imagen = $path;
        }
    
        // Guardar cambios
        $alumnos->save();
    
        // Recargar el modelo para obtener los datos actualizados
        $alumnos->refresh();
    
        return response()->json([
            'status' => true,
            'message' => 'Alumno updated successfully',
            'data' => $alumnos
        ], 200);
    }

    public function destroy($id)
{
    // Encontrar el alumno por ID
    $alumnos = Alumnos::find($id);
    if (!$alumnos) {
        return response()->json([
            'status' => false,
            'message' => 'Alumno not found'
        ], 404);
    }

    // Eliminar el alumno
    $alumnos->delete();

    return response()->json([
        'status' => true,
        'message' => 'Alumno deleted successfully'
    ], 200);
}

    public function AlumnosporCarrera()
{
    $alumnos = Alumnos::select(DB::raw('count(alumnos.id) as count'), 'carreras.nombre')
        ->rightJoin('carreras', 'carreras.id', '=', 'alumnos.carrera_id')
        ->groupBy('carreras.nombre')
        ->orderBy('carreras.nombre', 'asc')
        ->get();
    return response()->json($alumnos);
}

    public function all()
    {
        $alumnos = Alumnos::select('alumnos.*', 'carreras.nombre as carrera')
            ->join('carreras', 'carreras.id', '=', 'alumnos.carrera_id')
            ->get();
        return response()->json($alumnos);
    }
}