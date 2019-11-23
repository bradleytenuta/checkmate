@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Content Container -->
<div class="content-container">

    <!-- Module Title -->
    <h1>My Modules</h1>

    <!-- Bootstrap cards for the Users Modules -->
    <!-- TODO: Add Javascript to filter and sort this list -->
    @foreach (Auth::user()->modules as $module)
        <div class="card module-card">
            <div class="card-body">

                <!-- Card Contents -->
                <h5 class="card-title">{{$module->name}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ __('Description')}}</h6>
                <p class="card-text module-card-text">{{$module->description}}</p>

                <!-- Links to open module -->
                <a href="{{ route('modules.show', ['id' => $module->id]) }}" class="card-link">Open</a>

                <!-- Icon to show role within module -->
                @if (Auth::user()->isStudent($module))
                    <img class="module-card-icon" src="/images/home/module-icon-student.png" data-toggle="tooltip" data-placement="bottom" title="Student">
                @endif
                @if (Auth::user()->isProfessor($module))
                    <img class="module-card-icon" src="/images/home/module-icon-professor.png" data-toggle="tooltip" data-placement="bottom" title="Professor">
                @endif
                @if (Auth::user()->isAssessor($module))
                    <img class="module-card-icon" src="/images/home/module-icon-assessor.png" data-toggle="tooltip" data-placement="bottom" title="Assessor">
                @endif
                
            </div>
        </div>
    @endforeach

</div>

@endsection
<!-- End of the Section-->