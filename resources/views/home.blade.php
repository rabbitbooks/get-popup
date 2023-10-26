@extends('layouts.app')

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Название окна</th>
                        <th scope="col">Текст окна</th>
                        <th scope="col">Состояние окна</th>
                        <th scope="col">Показы</th>
                        <th scope="col">Ссылка для вставки</th>
                        <th scope="col">Действие</th>
                    </tr>
                    </thead>
                    @forelse($popups as $popup)
                            <tbody>
                            <tr>
                                <td><a href="{{ route('popup.show', $popup->id) }}">{{ $popup->title }}</a></td>
                                <td>{{ $popup->text }}</td>
                                <td>@if(!$popup->is_enabled)Не активно @else Активно @endif</td>
                                <td>{{ $metadata->firstWhere('popup_id', $popup->id)->shows ?? '0'}}</td>
                                <td>{{ $metadata->firstWhere('popup_id', $popup->id)->link }}</td>
                                <td>
                                    <form action="{{ route('popup.destroy', $popup) }}" method="post">
                                        <a class="btn btn-success" href="{{ route('popup.edit', $popup) }}">Редактировать</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                            </tbody>

                    @empty
                        <tbody>
                        <tr>
                            <td colspan="6">Нет всплывающих окон</td>
                        </tr>
                        </tbody>
                    @endforelse
                    </table>
                {{ $popups->links() }}
            </div>
        </div>
    </div>
@endsection
