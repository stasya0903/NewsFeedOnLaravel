@extends('layouts.main')

@section('title')
    @parent Новости
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Имя</th>
                <th>email</th>
                <th>Зарегистрирован</th>
                <th>Обновлен</th>
                <th>статус</th>
                <th>обновить статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $item)
                <tr>
                    <form method="POST" action="{{route('admin.users.update', $item)}}">
                        @csrf
                        @method("PUT")
                        <td>{{ $item->name  }}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>
                        @if($item->id !== $user->id)
                        <td>

                                <select name="is_admin" id="category"
                                        class="border-0 bg-transparent form-control @error('category') is-invalid @enderror">
                                    <option @if (!$item->is_admin) selected
                                            @endif value="0">User
                                    </option>
                                    <option @if ($item->is_admin)selected
                                            @endif value="1">Admin
                                    </option>
                                </select>

                        </td>
                        <td><input type="submit"></td>
                            @else
                            <td class="text-center">{{$item->is_admin ? 'Admin': 'User'}}</td>
                            <td>-</td>
                        @endif
                    </form>
                </tr>
            </tbody>
            @endforeach
        </table>

    </div>

@endsection
