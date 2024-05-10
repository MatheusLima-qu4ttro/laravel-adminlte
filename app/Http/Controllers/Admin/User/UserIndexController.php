<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


class UserIndexController extends Controller
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
     * Esse metodo mostra a tela do usuario selecionado na listagem.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) : \Illuminate\Contracts\Support\Renderable
    {
        return view('admin.user.index', [
            'user' => DB::table('users')->find($request->id),
        ]);
    }

    /**
     * Esse metodo atualiza os dados do usuario selecionado.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) : \Illuminate\Http\RedirectResponse
    {
        try {
            DB::table('users')->where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => preg_replace('/[^0-9]/', '', $request->phone),
                'country' => $request->country,
                'uf' => $request->uf,
                'city' => $request->city,
                'address' => $request->address,
                'number' => $request->number,
            ]);

            return redirect()->route('user.list')->with('success', 'Usuário atualizado com sucesso');
        }catch (\Exception $e) {
            return redirect()->route('user.list')->with('error', 'Erro ao atualizar usuário');
        }

    }


    /**
     * Esse metodo atualiza a senha do usuario selecionado.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request) : \Illuminate\Http\RedirectResponse
    {
        try {
            // Atualiza a senha do usuário no banco de dados
            DB::table('users')
                ->where('id', $request->id)
                ->update(['password' => Hash::make($request->password)]);

            return redirect()->route('profile')->with('success', 'Senha alterada com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('profile')->with('error', 'Erro ao alterar senha: ' . $e->getMessage());
        }
    }

    /**
     * Esse metodo atualiza a imagem do usuario selecionado.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeImage(Request $request) : \Illuminate\Http\RedirectResponse
    {
        try {
            // Salva a imagem que está em base64 na pasta public/vendor/adminlte
            $imageData = str_replace('data:image/png;base64,', '', $request->image);
            $imageData = str_replace(' ', '+', $imageData);
            $imageName = time() . '.png';
            File::put(public_path('vendor/adminlte/' . $imageName), base64_decode($imageData));

            // Busca o usuário pelo ID usando o Query Builder
            $user = DB::table('users')->where('id', $request->id)->first();

            // Verifica se a imagem atual não é uma das imagens padrão antes de excluí-la
            if ($user && $user->image && !in_array($user->image, ['default.jpg', 'default.png'])) {
                File::delete(public_path('vendor/adminlte/' . $user->image));
            }

            // Atualiza a imagem do usuário no banco de dados
            DB::table('users')
                ->where('id', $request->id)
                ->update(['image' => $imageName]);

            return redirect()->route('profile')->with('success', 'Imagem alterada com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('profile')->with('error', 'Erro ao alterar imagem: ' . $e->getMessage());
        }
    }

}
