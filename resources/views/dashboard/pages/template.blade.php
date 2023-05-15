@extends('dashboard.layouts.default')

@section('title', 'Шаблон')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:">Шаблон</a></li>
        <li class="breadcrumb-item active">Шаблон</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Шаблон</h1>
    <!-- end page-header -->

    <!-- begin panel -->

    <x-panel title="Panel">

        <!-- Button to trigger the modal -->


        <x-modal class="my-modal btn btn-blue ml-auto mb-3 mr-3" title="Создать шаблон" id="myModal" label="Создать">
            <form method="POST" action="{{ route('template') }}" enctype="multipart/form-data">
                @csrf
                <x-form.input
                    class="form-floating"
                    style="accent-color: cadetblue"
                    label="Наименование шаблон"
                    name="name"
                    type="text"
                    :value="old('name')"
                    placeholder="Введите название"
                    required="false">
                </x-form.input>
                <x-form.input
                    class="form-floating"
                    label="Выберите файл"
                    name="file"
                    type="file"
                    :value="old('file')"
                    placeholder="Выберите файл"
                    required="false"
                    accept=".doc,.docx">
                </x-form.input>

                <div class="row">
                    <div class="col-md-4 ml-auto">
                        <x-primary-button class="form-control btn btn-blue">
                            Отправить
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </x-modal>


        <table class="table table-hover">
            <thead>
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>Пользователь</th>
                <th>Время создания</th>
                <th>Файл</th>
            </tr>
            </thead>
            <tbody>
            @foreach($templates as $template)
                <tr>
                    <td>{{ $template->id }}</td>
                    <td>{{ $template->name }}</td>
                    <td>{{ $template->user->name }}</td>
                    <td>{{ $template->created_at }}</td>
                    <td>
                        <a href="{{url($template->file)}}"><i class="fas fa-lg fa-fw me-10px fa-download "></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-panel>
    </div>
    <!-- end panel -->
@endsection
