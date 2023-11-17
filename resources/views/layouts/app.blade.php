<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <meta name="description" content="géré plus facilement vos courrier">

    <!-- CSS files -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-vendors.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css">
    @livewireStyles
    <style>
        @import url('https://rsms.me/inter/inter.css');

        .loader {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left: 4px solid #206bc4;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .file,
        .file-list {
            position: relative;
        }

        .file .file-info,
        .file .file-action,
        .file-list .file-info,
        .file-list .file-action {
            position: absolute;
            display: none;
        }

        .file .file-info,
        .file-list .file-info {
            bottom: 0.5rem;
            left: 0;
            right: 0;
            display: inline;
        }

        .file .file-action,
        .file-list .file-action {
            top: 0.5rem;
            right: 0.5rem;
        }

        .file:hover,
        .file-list:hover {
            cursor: pointer;
        }

        .file:hover .file-action,
        .file-list:hover .file-action {
            display: inline;
        }
    </style>

</head>

<body class=" layout-fluid">
    <div class="page">
        <!-- Sidebar -->
        <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
                    aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('/img/logo/logo_white2.png') }}" style="height: 3rem;" alt="logo"
                            class="navbar-brand-image">
                    </a>
                </h1>
                <div class="navbar-nav flex-row d-lg-none">
                    <div class="d-none d-lg-flex">
                        <x-notification />
                    </div>
                    <x-profile />
                </div>
                @include('layouts.nav')
            </div>
        </aside>
        <!-- Navbar -->
        <header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="d-none d-md-flex">
                        <x-notification />
                    </div>
                    <x-profile />
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-fluid">
                    <div class="row px-3 align-items-center mw-100">
                        @yield('header')
                    </div>
                </div>
            </div>
            <div class="page-body ps-3">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Copyright &copy; 2023
                                <a href="." class="link-secondary">Couribox</a>.
                                All rights reserved.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.base.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/libs/tinymce/tinymce.min.js" defer>
    </script>
    <script src="{{ asset('js/main.js') }}"></script>
    @livewireScripts
    @yield('js')
</body>

</html>