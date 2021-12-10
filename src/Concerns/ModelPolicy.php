<?php


namespace Wefabric\Support\Concerns;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;

trait ModelPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view '.$this->permissionKey) || $user->hasPermissionTo('view own '.$this->permissionKey);
    }

    /**
     * @param User $user
     * @param Model $model
     * @return bool
     */
    public function view(User $user, Model $model): bool
    {
        if(!$user->hasPermissionTo('view '.$this->permissionKey)) {
            if ($user->hasPermissionTo('view own '.$this->permissionKey)) {
                return $user->id === $model->user_id;
            }
            return false;
        }
        return true;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create '.$this->permissionKey);
    }

    /**
     * @param User $user
     * @param Model $model
     * @return bool
     */
    public function update(User $user, Model $model): bool
    {
        if(!$user->hasPermissionTo('edit '.$this->permissionKey)) {
            if ($user->hasPermissionTo('edit own '.$this->permissionKey)) {
                return $user->id === $model->user_id;
            }
            return false;
        }
        return true;
    }

    /**
     * @param User $user
     * @param Model $model
     * @return bool
     */
    public function delete(User $user, Model $model): bool
    {
        if(!$user->hasPermissionTo('delete '.$this->permissionKey)) {
            if ($user->hasPermissionTo('delete own '.$this->permissionKey)) {
                return $user->id === $model->user_id;
            }
            return false;
        }
        return true;
    }
}
