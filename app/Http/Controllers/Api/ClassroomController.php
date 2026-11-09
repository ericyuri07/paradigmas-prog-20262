<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Http\Requests\ClassroomUsersRequest;
use App\Http\Resources\ClassroomResource;
use App\Http\Services\ClassroomService;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function __construct(private ClassroomService $classroomService)
    {
    }

    public function index(Request $request)
    {
        return ClassroomResource::collection($this->classroomService->getWithFilters($request->all()));
    }

    public function store(ClassroomRequest $request)
    {
        return new ClassroomResource($this->classroomService->store($request->validated()));
    }

    public function show(string $id)
    {
        return new ClassroomResource($this->classroomService->show($id));
    }

    public function update(ClassroomRequest $request, string $id)
    {
        return new ClassroomResource($this->classroomService->update($request->validated(), $id));
    }

    public function destroy(string $id)
    {
        $this->classroomService->destroy($id);

        return response()->noContent();
    }

    public function users(ClassroomUsersRequest $request, string $id)
    {
        return new ClassroomResource($this->classroomService->manageUsers($request->validated(), $id));
    }
}