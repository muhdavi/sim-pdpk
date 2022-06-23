<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ChangePasswordController extends Controller
{
    public function create()
    {
        return view('auth.change-password');
    }

    public function index()
    {
        return view('auth.change-password');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'retype_password' => 'required|same:new_password'
        ];
        $messages = [
            'same' => ':attribute harus sama dengan :other.',
            'min' => ':attribute minimal :min karakter',
            'required' => ':attribute harus diisi.'
        ];
        $customAttributes = [
            'old_password' => 'Password Lama',
            'new_password' => 'Password Baru',
            'retype_password' => 'Ketik Ulang Password Baru'
        ];
        $validation = Validator::make($data, $rules, $messages, $customAttributes);

        if ($validation->fails()) {
            return redirect()->route('password.change')->withErrors($validation)->withInput();
        } else {
            $user = User::find(Auth::user()->id);
            $oldPasswordDB = $user->password;
            $oldPasswordForm = $request->old_password;
            $newPassword = $request->new_password;

            if (Hash::check($oldPasswordForm, $oldPasswordDB)) {
                $user->password = Hash::make($newPassword);
                $user->save();
                $request->session()->flash('message', 'Password berhasil diubah.');
                return redirect()->route('dashboard');
            } else {
                $validation->errors()->add('old_password', 'Password Lama tidak sesuai.');
                return redirect()->route('password.change')->withErrors($validation)->withInput();
            }
        }
    }
}
