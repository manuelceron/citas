<?php

namespace App\Http\Controllers;

use App\Models\Authorizable;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    use Authorizable;

    public function index()
    {
        //abort_if(Gate::denies('view_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::with('roles')->get();

        return view('modules.users.index', compact('users'));
    }

    public function create()
    {
        //abort_if(Gate::denies('add_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        return view('modules.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('modules.users.index');
    }

    public function show(User $user)
    {
        //abort_if(Gate::denies('view_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('modules.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        //abort_if(Gate::denies('edit_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $user->load('roles');

        return view('modules.users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('modules.users.index');
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return redirect()->route('modules.users.index');
    }
}
