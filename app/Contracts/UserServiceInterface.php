<?php 

namespace App\Contracts;

use App\Models\CustomUser;

interface UserServiceInterface
{
    public function create(array $data);
    public function update(CustomUser $user, array $data);
    public function delete(CustomUser $user);
    public function restore(CustomUser $user);
    public function destroyPermanently(CustomUser $user);
    public function getAll();
    public function getDeleted();
    public function find($id);
}
