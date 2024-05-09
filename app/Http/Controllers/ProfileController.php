<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProfileController extends Controller
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
     * Esse metodo mostra a tela de perfil do usuario.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() : \Illuminate\Contracts\Support\Renderable
    {
        return view('admin.profile.index', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Esse metodo atualiza o perfil do usuario logado.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request) : \Illuminate\Http\RedirectResponse
    {
        try {
            $user = auth()->user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = preg_replace('/[^0-9]/', '', $request->phone);
            $user->country = $request->country;
            $user->uf = $request->uf;
            $user->city = $request->city;
            $user->address = $request->address;
            $user->number = $request->number;
            $user->save();

            return redirect()->route('profile')->with('success', 'Perfil atualizado com sucesso');
        }catch (\Exception $e) {
            return redirect()->route('profile')->with('error', 'Erro ao atualizar perfil');
        }

    }


    /**
     * Esse metodo atualiza a senha do usuario logado.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request) : \Illuminate\Http\RedirectResponse
    {
        try{
            $user = auth()->user();
            $user->password = \Hash::make($request->password);
            $user->save();

            return redirect()->route('profile')->with('success', 'Senha alterada com sucesso');
        }catch (\Exception $e) {
            return redirect()->route('profile')->with('error', 'Erro ao alterar senha');
        }
    }

    /**
     * Esse metodo atualiza a imagem do usuario logado.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeImage(Request $request) : \Illuminate\Http\RedirectResponse
    {
        try{
            //salva a imagem que está em base64 na pasta public/vendor/adminlte
            $image = $request->image;
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = time().'.png';
            File::put(public_path('vendor/adminlte/' . $imageName), base64_decode($image));

            //atualiza a imagem do usuário
            $user = auth()->user();

            // Verifica se a imagem atual não é uma das imagens padrão antes de excluí-la
            $currentImage = $user->image;
            if ($currentImage && !in_array($currentImage, ['default.jpg', 'default.png'])) {
                File::delete(public_path('vendor/adminlte/' . $currentImage));
            }

            $user->image = $imageName;
            $user->save();

            return redirect()->route('profile')->with('success', 'Imagem alterada com sucesso');
        }catch (\Exception $e) {
            return redirect()->route('profile')->with('error', 'Erro ao alterar imagem');
        }
    }

}
