<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersRepository implements BaseRepositoryInterface
{
    protected $user;


    public function __construct(User $user)
    {
        $this->user = $user;

    }


    /**
     *  Get all users
     *  @return LengthAwarePaginator
     */
    public function all($related = null): LengthAwarePaginator
    {
        //return all users
        return User::paginate();
    }

    public function get($id, array $related = null): Model
    {
        if (null == $user = $this->user->find($id)) {
            throw new ModelNotFoundException("User not found");
        }

        return $user;
    }

    /**
     *  Create a User
     *  @param array attributes
     *  @return Model
     */
    public function create(array $attributes):Model
    {
        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => isset($attributes['password'])?$attributes['password']: '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        return $user->refresh();
    }


    public function update(array $attributes, int $id): Model
    {

        $user = User::where('id', $id)
        ->update([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => $attributes['password']
        ]);

        return User::find($id)->refresh();
    }

    public function delete($id)
    {
        #TODO
    }

}
