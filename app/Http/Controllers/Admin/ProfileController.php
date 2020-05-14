<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

        return response()->view('admin.profile', [
            'users' => User::all(),
            'user'=>Auth::user()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function update(Request $request, User $user)
    {
        $currentUser = Auth::user();
        if ($currentUser->id !== $user->id){
            $result = $user->update($request->only('is_admin'));
            if ($result) {
                return redirect(route('admin.users.edit'))
                    ->with("success", 'Статус пользователя успешно обнавлен');
            }
            return redirect(route('admin.users.edit'))
                ->with("error", 'Ошибка обновления');
        } else {
            return redirect(route('admin.users.edit'))
                ->with("error", 'Вы не можете обновить свой статус');
        }
    }

}
