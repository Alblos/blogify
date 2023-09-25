<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function render(string $id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $posts_count = User::getPostsCount($id);
        $up_since = User::getUpSince($id);
        $likes = User::getTotalRecivedLikes($id);
        $user = DB::table('users')->where('id', $id)->first();

        return view('profiles/profile',
            ['id' => $id,
            'posts_count' => $posts_count,
            'up_since' => $up_since,
            'likes' => $likes,
            'username' => $user->username,
            'email' => $user->email,
            ]);

    }
}
