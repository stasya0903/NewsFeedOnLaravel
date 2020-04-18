<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

        return response()->view('profile', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\News\News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    /** TODO validate data */
    public function update(Request $request)
    {
        $user = Auth::user();
        $errors = [];

            if (Hash::check($request->post('oldPassword'), $user->password)) {
                $user->update([
                    'name' => $request->post('name'),
                    'password' => Hash::make($request->post('password')),
                    'email' => $request->post('email')
                ]);
                $request->session()->flash('success', 'Данные пользователя изменены!');
            } else {
                $errors['oldPassword'][] = "Неверно введен текущий пароль";
            }
            return redirect()->route('profile.edit')->withErrors($errors);

    }

}
