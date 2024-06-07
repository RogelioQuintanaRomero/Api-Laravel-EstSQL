<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Validator;

class studentController extends Controller
{
    //
    public function index()
    {
        $students = Student::all();
        //validamos que los datos no esten vacios
        //if($students->isEmpty()){
        //    return response()->json(['message' => 'No hay estudiantes'], 404);
        //}
        //
       /*  if ($students->isEmpty()){
            $data = [
                'message' => 'No se encontraron estudiantes',
                'status' => 200
            ];
            return response()->json($data, 404);
        } */
        $data = [
            'students' => $students,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
       $validator = Validator::make($request->all(),[
        'name' => 'required|max:255',
        'email'=> 'required|email|unique:student',
        'phone' => 'required|digits:10',
        'language' => 'required|in:English,Spanish,French'
       ]);
       
       if($validator->fails())
       {
            $data =[
                'message' => 'Error en la vlaidacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
       }

       $student = Student::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'language' => $request->language
       ]);

       if(!$student){
            $data =[
                'message' => 'Error al crear el estudiante',
                'status' => 500
            ];
            return response()->json($data, 500);
       }

       $data = [
            'student' => $student,
            'status' => 201
       ];
       
       return response()->json($data,201);
    }

    public function show($id)
    {
        $student = Student::find($id);

        if(!$student)
        {
            $data =[
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            'students' => $student,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if(!$student){
            $data = [
                'message' => 'Destroy: Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $student->delete();

        $data = [
            'message' => 'Estudiante Eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);

    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if(!$student){
            $data =[
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'email' => 'required|email|unique:student',
            'phone' => 'required|digits:10',
            'language' => 'required|in:English,Spanish,French'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'erros' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->language = $request->language;

        $student->save();

        $data = [
            'message' => 'Estudiante actualizado',
            'student' => $student,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id){
        
        $student = Student::find($id);

        if(!$student){
            $data =[
                'message' => 'Patch: Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        //return response()->json($request->all(), 200);

        $validator = Validator::make($request->all(),[
            'name' => 'max:255',
            'email' => 'email|unique:student',
            'phone' => 'digits:10',
            'language' => 'in:English,Spanish,French'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Patch: Error en la validacion de los datos',
                'erros' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('name')){
            $student->name = $request->name;
        }
        if ($request->has('email')){
            $student->email = $request->email;
        }
        if ($request->has('phone')){
            $student->phone = $request->phone;
        }
        if ($request->has('language')){
            $student->language = $request->language;
        }

        $student->save();

        $data = [
            'message' => 'Patch: Estudiante actualizado',
            'student' => $student,
            'status' => 200     
        ];

        return response()->json($data, 200);
    }

    /*
    //
    //  segmento 2 de consulta de route
    //

    public function index()
    {
        return 'Obtiene listado de estudiantes desde Controller';
    }

    public function show($id)
    {
        return 'Obtiene estudiante '.$id.' desde controller';
    }

    public function create(Request $request)
    {
        return 'Crea Estudiante desde Controlador ';
    } 

    public function update(Request $request)
    {
        return 'Actualiza Estudiante desde Controlador ';
    } 

    public function delete($id)
    {
        return 'Elimina Estudiante '.$id.' desde controller';
    }    

    */

}
