<?php

namespace App\Http\Controllers;

use App\Jobs\Student\CreateStudent;
use App\Jobs\Student\UpdateStudent;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Bus;

class Students extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $student = Student::with('schoolClasses')->get();

        return response()->json($student);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreStudentRequest
     * @return JsonResponse
     */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            Bus::dispatchNow(new CreateStudent($validated));
    
            return response()->json([
                'message' => 'Aluno criado com sucesso!',
                'code' => 201,
            ], 201);
        } catch (\Exception $e) {
            error_log($e);
            return response()->json([
                'message' => 'Erro ao criar o aluno.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $student
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Aluno nao encontrado!',
                'code' => 404,
            ], 404);
        }

        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateStudentRequest $request
     * @param int $student
     * @return JsonResponse 
     */
    public function update(UpdateStudentRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();
        
        info('no método update: '. $id);
        Bus::dispatchNow(new UpdateStudent($id, $validated));
    
        return response()->json([
            'message' => 'Aluno atualizado com sucesso!',
            'code' => 201,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroy(int $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Aluno nao encontrado!',
                'code' => 404,
            ], 404);
        }

        $student->delete();
        return response()->json(null, 204);
    }
}
