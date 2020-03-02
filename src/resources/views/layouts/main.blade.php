@extends ('layouts.master')

<!-- Begining of the dynamic Section-->
<!-- Just adds the navbar and then yeilds space for other views to inherit -->
@section ('dynamic-master-content')
    @include('components.navbar')
    <!-- The Dynamic main Content -->
    @yield ('dynamic-main-content')
@endsection