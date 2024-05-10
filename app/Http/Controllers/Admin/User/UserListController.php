<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class UserListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Esse metodo mostra a lista de perfis de usuarios.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list(Request $request) : \Illuminate\Contracts\Support\Renderable
    {
        $users = DB::table('users')
            ->where('name', 'like', '%' . $request->term . '%')
            ->orWhere('email', 'like', '%' . $request->term . '%')
            ->orWhere('role', 'like', '%' . $request->term . '%')
            ->paginate(10)
            ->appends($request->only('term'));

        return view('admin.user.list', [
            'users' => $users,
        ]);
    }

/**
     * Esse metodo deleta um usuario.
     *
     * @return \Illuminate\Http\RedirectResponse
 */
    public function delete(Request $request) : \Illuminate\Http\RedirectResponse
    {
        $user = DB::table('users')->where('id', $request->id)->first();
        if ($user) {
            DB::table('users')->where('id', $request->id)->delete();
            return redirect()->route('user.list')->with('success', 'Usuario deletado com sucesso!');
        } else {
            return redirect()->route('user.list')->with('error', 'Usuario não encontrado!');
        }
    }




}
