@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Content Container -->
<div class="content-container">

    <!-- Module Title Container -->
    <div class="container-fluid card-holder-title-container">

        <!-- Module Title -->
        <h1>My Modules</h1>

        <!-- Filter Buttons -->
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-secondary active">
                <input type="radio" name="options" id="option1" autocomplete="off" checked>{{ __('All') }}
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="options" id="option2" autocomplete="off">{{ __('Open') }}
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="options" id="option3" autocomplete="off">{{ __('Closed') }}
            </label>
        </div>

    </div>

    <!-- Bootstrap cards for the Users Modules -->
    <!-- TODO: Add Javascript to filter and sort this list -->
    @foreach (Auth::user()->modules as $module)
        <div class="card item-card">
            <div class="card-body">

                <!-- Card Contents -->
                <h5 class="card-title">{{$module->name}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ __('Description') }}</h6>
                <p class="card-text item-card-text">{{ $module->description }}</p>

                <!-- Links to open module -->
                <a href="{{ route('modules.show', ['id' => $module->id]) }}" class="card-link">Open</a>

                <!-- Icon to show role within module -->
                @if (Auth::user()->isStudent($module))
                    <img class="item-card-icon" src="{{ Storage::url('/images/other/module-icon-student.png') }}" data-toggle="tooltip" data-placement="bottom" title="Student">
                @endif
                @if (Auth::user()->isProfessor($module))
                    <img class="item-card-icon" src="{{ Storage::url('/images/other/module-icon-professor.png') }}" data-toggle="tooltip" data-placement="bottom" title="Professor">
                @endif
                @if (Auth::user()->isAssessor($module))
                    <img class="item-card-icon" src="{{ Storage::url('/images/other/module-icon-assessor.png') }}" data-toggle="tooltip" data-placement="bottom" title="Assessor">
                @endif
            </div>
        </div>
    @endforeach

    <!-- TODO: Add section to show courseworks in deadline order -->

</div>

@endsection
<!-- End of the Section-->