<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('first_name', 'asc')->orderBy('last_name', 'asc')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'password' => 'required|min:6'
        ]);

        $user = new User();
        $user->fill($request->except('password'));
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return redirect(route('users.index'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'password' => 'min:6'
        ]);

        $user = User::findOrFail($id);
        $user->fill($request->except('password'));
        if ($request->has('password')) {
           $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        return redirect(route('users.index'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect(route('users.index'));
    }
}
