<?php

namespace App\Repository\User;

interface UserInteface {
    public function adminGetAll();
    public function adminFindUser($email);
    public function adminDelete($email);
    public function adminCreateUser();

    public function findUser($email);
    public function updateUser($email);
}