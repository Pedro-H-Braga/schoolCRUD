<?php

namespace App\Http\Controllers;

use App\Jobs\SchoolClass\CreateClass;
use App\Jobs\SchoolClass\UpdateClass;
use App\Models\SchoolClass;
use App\Http\Requests\StoreSchoolClassRequest;
use App\Http\Requests\UpdateSchoolClassRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Bus;

class SchoolClasses extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $class = SchoolClass::all();

        return response()->json($class);
    }


    /**
     * Store a newly created resource in storage.
     * @return JsonResponse
     */
    public function store(StoreSchoolClassRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            Bus::dispatchNow(new CreateClass($validated));
    
            return response()->json([
                'message' => 'Turma criada com sucesso!',
                'code' => 201,
            ], 201);
        } catch (\Exception $e) {
            error_log($e);
            return response()->json([
                'message' => 'Erro ao criar a turma.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     * @param int $schoolClass
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $class = SchoolClass::find($id);

        if (!$class) {
            return response()->json([
                'message' => 'Turma nao encontrada!',
                'code' => 404,
            ], 404);
        }

        return response()->json($class);
    }


    /**
     * Update the specified resource in storage.
     * @param UpdateSchoolClassRequest $request
     * @param int $schoolClass
     * @return JsonResponse      
     */
    public function update(UpdateSchoolClassRequest $request, int $id)
    {
        $validated = $request->validated();

        Bus::dispatchNow(new UpdateClass($id, $validated));
    
        return response()->json([
            'message' => 'Turma atualizada com sucesso!',
            'code' => 201,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroy(int $id)
    {
        $class = SchoolClass::find($id);

        if (!$class) {
            return response()->json([
                'message' => 'Turma nao encontrada!',
                'code' => 404,
            ], 404);
        }

        $class->delete();
        return response()->json(null, 204);
    }
}
