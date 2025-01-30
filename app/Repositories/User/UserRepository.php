<?php

namespace App\Repositories\User;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    public function __construct(private User $user) {}

    public function all()
    {
        return $this->user->all();
    }

    public function find($id)
    {
        $user = $this->user->find($id);
        if (!$user) {
            throw new Exception('User not found');
        }
        return $user;
    }

    public function create(array $data)
    {
        return $this->user->create($data);
    }

    public function update(array $data, $id)
    {
        $user = $this->user->find($id);
        if (!$user) {
            throw new Exception('User not found');
        }
        $data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'birth_date' => $data['birth_date'],
            'gender' => $data['gender'],
        ];

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->user->find($id);
        if (!$user) {
            throw new Exception('User not found');
        }
        $user->delete();
        return true;
    }
}
