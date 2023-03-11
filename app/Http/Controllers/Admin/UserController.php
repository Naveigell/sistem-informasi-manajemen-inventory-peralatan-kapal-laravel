<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::whereAdmin()->paginate(10);

        return view('admin.pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.pages.user.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(UserRequest $request)
    {
        User::create(array_merge($request->validated(), ["role" => User::ROLE_ADMIN]));

        return redirect(route('admin.users.index'))->with('success', 'Berhasil menambah admin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        return view('admin.pages.user.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect(route('admin.users.index'))->with('success', 'Berhasil mengubah admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('admin.users.index'))->with('success', 'Berhasil menghapus admin');
    }
}
