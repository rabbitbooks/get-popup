@extends('layouts.app')

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="@if (!$popup->id){{ route('popup.store') }}@else{{ route('popup.update', $popup) }}@endif" method="POST">
                            @csrf
                            @if ($popup->id) @method('PUT') @endif
                            <div class="form-group">

                                <label for="popupTitle">Название всплывающего окна</label>
                                <br>
                                @if ($errors->has('title'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach($errors->get('title') as $error)
                                            {{ $error }}<br>
                                        @endforeach
                                    </div>
                                @endif
                                <input type="text" name="title" id="popupTitle" class="form-control" value="{{ old('title') ?? $popup->title }}">
                                <br>
                                <label for="popupText">Текст всплывающего окна</label>
                                <br>
                                @if ($errors->has('text'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('text') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input type="text" name="text" id="popupText" class="form-control" value="{{ old('text') ?? $popup->text }}">
                                <div class="form-check">
                                    <input
                                        @if ($popup->is_enabled == 1 || old('is_enabled')) checked @endif id="popupIsEnabled" name="is_enabled" type="checkbox" value="1">
                                    <label for=popupIsEnabled">Всплывающее окно активно</label>
                                </div>
                                <button class="btn btn-outline-primary">@if ($popup->id){{ 'Изменить' }}@else{{ 'Добавить' }}@endif всплывающее окно</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
