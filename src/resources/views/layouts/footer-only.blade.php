@extends ('layouts.master')

<!-- Begining of the dynamic Section-->
@section ('dynamic-master-content')
    <!-- The Dynamic main Content -->
    @yield ('dynamic-main-content')
    @include('components.footer')
@endsection