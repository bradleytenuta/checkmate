@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Content Container -->
<div class="content-container">

    <!-- Module Title Container -->
    <div class="container-fluid card-holder-title-container">

        <!-- Module Title -->
        <h1 class="item-title">{{ $module->name }}</h1>

        <!-- Icon to show role within module -->
        @if (Auth::user()->isStudent($module))
            <img class="item-title-icon" src="{{ URL::asset('/images/other/module-icon-student.png') }}" 
            data-toggle="tooltip" data-placement="bottom" title="Student">
        @endif
        @if (Auth::user()->isProfessor($module))
            <img class="item-title-icon" src="{{ URL::asset('/images/other/module-icon-professor.png') }}" 
            data-toggle="tooltip" data-placement="bottom" title="Professor">
        @endif
        @if (Auth::user()->isAssessor($module))
            <img class="item-title-icon" src="{{ URL::asset('/images/other/module-icon-assessor.png') }}" 
            data-toggle="tooltip" data-placement="bottom" title="Assessor">
        @endif

        <!-- Permission required buttons -->
        @if (Auth::user()->hasModulePermission(5, $module))
            <button type="button" class="btn btn-primary item-title-button">{{ __('Edit') }}</button>
        @endif
        @if (Auth::user()->hasModulePermission(6, $module))
            <button type="button" class="btn btn-primary item-title-button">{{ __('Delete') }}</button>
        @endif

    </div>

    <!-- Module Card -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">

                <!-- Module Info Container -->
                <div class="col-md-6">
                    <h4>{{ __('Description') }}</h4>
                    <p>{{ $module->description }}</p>
                </div>

                <!-- List of Assessors and Professors in Module -->
                <div class="col-md-6">

                    <!-- Gets all the Professors on the module -->
                    <h5>{{ __('Professors') }}</h5>
                    <div class="item-card-users-list">
                        @foreach ($module->users as $userOnModule)
                            @if ($userOnModule->isProfessor($module))
                                <p>{{ $userOnModule->firstname}} {{ $userOnModule->surname }}</p>
                            @endif
                        @endforeach
                    </div>

                    <!-- A break between the two lists -->
                    <hr>

                    <!-- Gets all the Assessors on the module -->
                    <h5>{{ __('Assessors') }}</h5>
                    <div class="item-card-users-list">
                        @foreach ($module->users as $userOnModule)
                            @if ($userOnModule->isAssessor($module))
                                <p>{{ $userOnModule->firstname}} {{ $userOnModule->surname }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <!-- Coursework Title Container -->
    <div class="container-fluid card-holder-title-container">

        <!-- Coursework Title -->
        <h3>{{ __('Courseworks') }}</h3>

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

    <!-- Bootstrap cards for the Modules courseworks -->
    <!-- TODO: Add Javascript to filter and sort this list -->
    @foreach ($module->courseworks as $coursework)
        <div class="card item-card">
            <div class="card-body">

                <!-- Card Contents -->
                <h5 class="card-title">{{$coursework->name}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ __('Description') }}</h6>
                <p class="card-text item-card-text">{{ $coursework->description }}</p>

                <!-- Links to open module -->
                <a href="{{ route('coursework.show', ['id' => $coursework->id]) }}" class="card-link">Open</a>
            </div>
        </div>
    @endforeach
</div>

@endsection
<!-- End of the Section-->