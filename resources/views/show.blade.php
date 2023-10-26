@extends('layouts.app')

@section('menu')
    @include('menu')
@endsection

@section('content')
    <style>
        body {
            overflow: hidden;
        }

        .gp-popup{
            display: block;
            position: fixed;
            z-index: 1001;
            left: calc(50% - 200px);
            top: calc(50% - 150px);
            margin: 0 auto;
            width: 400px;
            height: 200px;
            box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
            border-radius: 11px;
            overflow: hidden;

            visibility: hidden;
        }

        .gp-popup__wrapper {
            height: 100%;
            width: 100%;
        }

        .gp-popup__header {
            height: 60%;
            width: 100%;
            background-color: black;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        .gp-popup__title {
            color: white;
            margin: 0;
        }

        .gp-popup__footer {
            background-color: whitesmoke;
            height: 40%;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        .gp-popup__button {
            border: none;
            background-color: darkgreen;
            color: white;
            font-size: 15px;
            text-transform: uppercase;
            height: 34px;
            cursor: pointer;
        }

        .gp-popup__button:hover {
            opacity: 0.8;
        }

        .gp-overlay {
            position: fixed;
            top: 0;
            left: 0;
            background-color: black;
            height: 100%;
            width: 100%;
            z-index: 1000;
            cursor: pointer;

            transition: opacity 0.4s;
            opacity: 0;
            visibility: hidden;
        }

        @keyframes backInLeft {
            0% {
                transform: scale(0.7) translateX(-400%);
            }

            65% {

                transform: scale(0.7) ;
            }

            80% {
                transform: scale(0.7) ;
            }

            to {
                transform: scale(1);
            }
        }

        @keyframes backOutRight {
            0% {
                transform: scale(1);
            }

            20% {
                transform: scale(0.7) ;
            }

            35% {
                transform: scale(0.7) ;
            }

            to {
                transform: scale(0.7) translateX(500%);
            }
        }

        .backInLeft {
            animation-duration: 0.8s;
            animation-name: backInLeft;
            animation-timing-function: cubic-bezier(0.6, 0, 0.5, 0.05);
            animation-fill-mode: forwards;
        }

        .backOutRight {
            animation-duration: 0.8s;
            animation-name: backOutRight;
            animation-timing-function: cubic-bezier(0.6, 0, 0.5, 0.05);
            animation-fill-mode: forwards;
        }

    </style>
    <div class="container">
        <button class="btn btn-outline-primary show-popup">Показать</button>
    </div>
    <div class="gp-popup">
        <div class="gp-popup__wrapper">
            <div class="gp-popup__header">
                <h2 class="gp-popup__title">{{ $popup->text }}</h2>
            </div>
            <div class="gp-popup__footer">
                <button class="gp-popup__button">Закрыть попап</button>
            </div>
        </div>
    </div>
    <div class="gp-overlay"></div>

    <script type='text/javascript'>
        const $closeButton = document.querySelector('.gp-popup__button');
        const $overlay = document.querySelector('.gp-overlay');
        const $popup = document.querySelector('.gp-popup');
        const $show = document.querySelector('.show-popup');

        $closeButton.onclick = e => {
            e.preventDefault();
            gpCloseModal()
        }

        $overlay.onclick = () => {
            gpCloseModal()
        }

        $show.onclick = e => {
            e.preventDefault();
            $popup.classList.remove('backInLeft', 'backOutRight')
            gpOpenModal()
        }

        const gpOpenModal = () => {
            $overlay.style.visibility = 'visible';
            $overlay.style.opacity = 0.8;
            $popup.style.visibility = 'visible';
            $popup.classList.add('backInLeft');
        }

        const gpCloseModal = () => {
            $overlay.style.opacity = 0;
            setTimeout(function(){
                $overlay.style.visibility = 'hidden';
            }, 500);
            $popup.classList.add('backOutRight');
        }
    </script>
@endsection

