@extends('dashboard.layouts.default')

@section('title', 'Документ')

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
	<li class="breadcrumb-item"><a href="javascript:;">Документ</a></li>
	<li class="breadcrumb-item active">Документ</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Документ</h1>
<!-- end page-header -->

<!-- begin panel -->

<x-panel title="Panel">

    <!-- Button to trigger the modal -->


    <x-modal class="my-modal btn btn-blue ml-auto mb-3 mr-3" title="Создать Документ" id="myModal" label="Создать">
        <form method="POST" action="{{ route('document') }}">
            @csrf
            <x-form.input
                class="form-floating"
                style="accent-color: cadetblue"
                label="Наименование документ"
                name="name"
                type="text"
                :value="old('name')"
                placeholder="Введите название"
                required="false">
            </x-form.input>
            <x-form.select
                class="form-select"
                name="template_id"
                :options="$options"
                label="Выберите шаблон"
                value="old('template_id')">
            </x-form.select>
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
            <th>Наименование шаблона</th>
            <th>Пользователь</th>
            <th>Время создания</th>
            <th>Файл</th>
        </tr>
        </thead>
        <tbody>
        @foreach($documents as $document)
            <tr>
                <td>{{ $document->id }}</td>
                <td>{{ $document->name }}</td>
                <td>{{ $document->template->name }}</td>
                <td>{{ $document->user->name }}</td>
                <td>{{ $document->created_at }}</td>
                <td><a href="{{url($document->file)}}"><i class="fas fa-lg fa-fw me-10px fa-download "></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-panel>
</div>
<!-- end panel -->
@endsection
