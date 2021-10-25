<?php

namespace App\Repositories\Eloquent\User;

use App\Helpers\ApiResponse;
use App\Repositories\Eloquent\BaseRepository;
use App\Models\User;
use App\Repositories\Contracts\User\IUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthRepository
 */
class UserRepository extends BaseRepository implements IUser
{
    /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    public function userProfile($id)
    {
        $user = $this->find($id);
        return ApiResponse::format('success', $user);
    }

    public function allUsers()
    {
        $users = $this->all();
        return ApiResponse::format("success", $users);
    }

    public function createUser(Request $request)
    {
        $user = $this->create(array_merge(
            $request->all(),
            ['password' => Hash::make($request->password)],
        ));
        return ApiResponse::format('success', $user);
    }

    public function updateUser(Request $request, $id)
    {
        $user = $this->update(array_merge(
            $request->all(),
            ['password' => Hash::make($request->password)],
        ), $id);
        return ApiResponse::format('success', $user);
    }

    public function deleteUser($id)
    {
        $user = $this->delete($id);
        return ApiResponse::format("success", $user);
    }
}
