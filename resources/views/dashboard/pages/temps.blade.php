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
        <form method="POST" class="row row-cols-lg-auto g-3 align-items-center"
              action="{{ route('file',['id' => $template]) }}" enctype="multipart/form-data">
            <div class="w-100" id="formModal">
                @csrf
                <div class="col-12">
                    <div class="mb-3">
{{--                        <label class="form-label">Название документа({{$name}})</label>--}}
                        <input class="form-control" name="doc_name" type="hidden" value="{{$name}}" required/>
                    </div>
                </div>
                @foreach($fields as $field)
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">{{$field->label}} <i>({{$field->key}})</i></label>
                            <input class="form-control" name="{{$field->key}}" type="text"/>
                        </div>
                    </div>

                @endforeach

            </div>
            <div class="col-2 ml-auto">
                <x-primary-button class="form-control btn btn-blue">
                    Отправить
                </x-primary-button>
            </div>
        </form>
    </x-panel>
    </div>
    <!-- end panel -->
    <script>
        function handleAdd() {
            var id = Date.now() + Math.random();
            const node = document.createElement("div");
            node.innerHTML = `
          <div class="row w-100 pl-4" id=content_${id}>
                <div class="col-6">
                    <div class="mb-3">
                        <input class="form-control" id=name_${id} name="label[]" type="text" required/>
                    </div>
                </div>
                <div class="col-5">
                    <div class="mb-3 mr-3">
                        <input class="form-control" id=key_${id} name="key[]" type="text" required/>
                    </div>
                </div>
                <div class="col-1">
                    <div class="mb-3 mr-3">
                        <a href="#" onclick="handleHide(${id})" class="btn btn-danger btn-icon btn-circle btn-lg">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
            </div>
`;
            document.getElementById("formModal").appendChild(node);
        }

        function handleHide(id) {
            var formElement = document.getElementById("content_" + id);
            var parentElement = formElement.parentNode;
            parentElement.removeChild(formElement);
        }
    </script>
@endsection
