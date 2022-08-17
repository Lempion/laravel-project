@extends('layout')

@section('head')
    <title>Основная информация</title>
@endsection

@section('content')
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-plus-circle'></i> Редактировать
            </h1>

        </div>
        <form action="{{route('editData',$user['id'])}}" method="post">
            @csrf
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Общая информация</h2>
                            </div>
                            <div class="panel-content">
                                <!-- username -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput1">Имя</label>
                                    <input name="name" type="text" id="simpleinput1" class="form-control"
                                           value="{{ $user['name'] }}">
                                </div>

                                <!-- title -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput2">Место работы</label>
                                    <input name="company" type="text" id="simpleinput2" class="form-control"
                                           value="{{ $user['company'] }}">
                                </div>

                                <!-- tel -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput3">Номер телефона</label>
                                    <input name="phone" type="text" id="simpleinput3" class="form-control"
                                           value="{{ $user['phone'] }}">
                                </div>

                                <!-- address -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput4">Адрес</label>
                                    <input name="address" type="text" id="simpleinput4" class="form-control"
                                           value="{{ $user['address'] }}">
                                </div>
                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning">Редактировать</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection

@section('script')
    <script>

        $(document).ready(function () {

            $('input[type=radio][name=contactview]').change(function () {
                if (this.value == 'grid') {
                    $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-g');
                    $('#js-contacts .col-xl-12').removeClassPrefix('col-xl-').addClass('col-xl-4');
                    $('#js-contacts .js-expand-btn').addClass('d-none');
                    $('#js-contacts .card-body + .card-body').addClass('show');

                } else if (this.value == 'table') {
                    $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-1');
                    $('#js-contacts .col-xl-4').removeClassPrefix('col-xl-').addClass('col-xl-12');
                    $('#js-contacts .js-expand-btn').removeClass('d-none');
                    $('#js-contacts .card-body + .card-body').removeClass('show');
                }

            });

            //initialize filter
            initApp.listFilter($('#js-contacts'), $('#js-filter-contacts'));
        });

    </script>
@endsection

