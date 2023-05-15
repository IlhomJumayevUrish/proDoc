@extends('dashboard.layouts.default')

@section('title', 'Пользователь')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:">Пользователь</a></li>
        <li class="breadcrumb-item active">Пользователь</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Пользователь</h1>
    <!-- end page-header -->

    <!-- begin panel -->

    <x-panel title="Panel">
        <div class="d-flex">
            <a href="{{route('register') }}" class="btn btn-blue mb-3 mr-3 ml-auto">Создать</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>№</th>
                <th>ФИО</th>
                <th>Электронная почта</th>
                <th>Время создания</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-panel>
    </div>
    <!-- end panel -->
@endsection
