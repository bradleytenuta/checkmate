<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Meta Data -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Checkmate') }}</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- JS Files -->
        <script src="{{ URL::asset('js/app.js') }}" defer></script>

        <!-- CSS Files -->
        <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <!-- The Dynamic Content -->
        @yield ('dynamic-master-content')
        <!-- End of Dynamic Content -->

        <!-- Footer -->
        <footer class="footer-container footer-margin">

            <!-- Links -->
            <div class="footer-copyright text-center py-3">

                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/in/bradley-tenuta">
                    <img src="{{ Storage::url('images/footer/linkedin-icon.png')}}" width="40" height="40" class="d-inline-block align-top" alt=""/>
                </a>

                <!-- Bitbucket -->
                <a href="https://bitbucket.org/BradBitt">
                    <img src="{{ Storage::url('images/footer/bitbucket-icon.png')}}" width="40" height="40" class="d-inline-block align-top" alt=""/>
                </a>

            </div>

            <!-- Version -->
            <div class="footer-copyright text-center py-3">Version 1.0.0</div>

        </footer>
        <!-- End Of Footer -->
    </body>
</html>