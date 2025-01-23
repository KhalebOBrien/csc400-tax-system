<?php

namespace App\Actions\Jetstream;

use App\Models\Grant;
use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;
use Illuminate\Support\Str;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {
        // find all user grants and delete
        $grants = Grant::where('user_id', $user->id)->get();
        foreach ($grants as $grant) {
            $grant->delete();
        }

        // delete user
        $user->update(['email' => Str::random(6).'|'.$user->email ]);
        if($user->profile_photo_path != "profile-photos/default.png") {
            $user->deleteProfilePhoto();
        }
        $user->tokens->each->delete();
        $user->delete();
    }
}
