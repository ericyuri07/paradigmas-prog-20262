<?php

namespace App\Http\Services;

use App\Http\Repositories\ClassroomRepository;
use Illuminate\Validation\ValidationException;

class ClassroomService extends BaseService
{
    public function __construct(private ClassroomRepository $classroomRepository)
    {
        parent::__construct($classroomRepository);
    }

    public function getWithFilters(array $data)
    {
        return $this->classroomRepository->getWithFilters($data);
    }

    public function manageUsers(array $data, string $id)
    {
        $classroom = $this->classroomRepository->show($id);
        $userIds = array_values(array_unique($data['user_ids']));

        if ($data['action'] === 'detach') {
            return $this->classroomRepository->detachUsers($classroom, $userIds);
        }

        $alreadyIn = $classroom->users->pluck('id')->all();
        $newUsers = array_diff($userIds, $alreadyIn);

        if (count($alreadyIn) + count($newUsers) > $classroom->vacancies) {
            throw ValidationException::withMessages([
                'user_ids' => ['A turma não possui vagas suficientes.']
            ]);
        }

        return $this->classroomRepository->attachUsers($classroom, $newUsers);
    }
}