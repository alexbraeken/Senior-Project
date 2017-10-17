<?php
interface UserRepositoryInterface
{
    public function find($id);
    public function save(User $user);
    public function remove(User $user);
}
