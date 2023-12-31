<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserController extends Controller
{
    public function render(): Factory|\Illuminate\Foundation\Application|View|Redirector|Application|RedirectResponse
    {
        try {
            $this->authorize('viewAny', User::class);
        } catch (Throwable $th) {
            abort(403, $th->getMessage());
        }

        $users = DB::table('users')
            ->select('users.*')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin/users', ['users' => $users]);
    }

    /**
     * @param string $id
     * @return Factory|\Illuminate\Foundation\Application|View|Redirector|Application|RedirectResponse
     */
    public function delete(string $id): Factory|\Illuminate\Foundation\Application|View|Redirector|Application|RedirectResponse
    {
        try {
            $this->authorize('delete', User::find($id));
        } catch (Throwable $th) {
            abort(403, $th->getMessage());
        }

        $user = User::find($id);
        $user->delete();

        return redirect('/admin/users');

    }
}
