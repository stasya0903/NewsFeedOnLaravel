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
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Request $request)
    {
        $user = Auth::user();
        $v = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8']
        ]);
        $isPasswordCorrect = Hash::check($request->post('oldPassword'), $user->password);
        $v->getMessageBag()->add('oldPassword', $isPasswordCorrect ? "" : "Неверно введен текущий пароль");

        if ($isPasswordCorrect && !$v->fails()) {
            $user->update([
                'name' => $request->post('name'),
                'password' => Hash::make($request->post('password')),
                'email' => $request->post('email')
            ]);

            $request->session()->flash('success', 'Данные пользователя изменены!');
        }

        return redirect()->route('profile.edit')->withInput()->withErrors($v);

    }

}
