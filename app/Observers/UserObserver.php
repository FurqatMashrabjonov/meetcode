<?php

namespace App\Observers;

use App\Models\ProgrammingLanguage;
use App\Models\User;
use Illuminate\Support\Facades\File;

class UserObserver
{

    public function created(User $user): void
    {
        $user->createUserDirectory();
    }


    public function deleted(User $user): void
    {
        $user->deleteUserDirectory();
    }

}
