<div class="work-infobox-container">
    <div class="row">

        <!-- Module Title Container -->
        @include('components.work.title', ['module'=>$module])

        <!-- Module Info Container -->
        <div class="col-md-6">
            <p>{{ $module->description }}</p>
        </div>

        <!-- List of Professors in Module -->
        <div class="col-md-3">

            <!-- Gets all the Professors on the module -->
            <h5>{{ __('Professors') }}</h5>
            <div class="work-infobox-list">
                <ul>
                @foreach ($module->users as $userOnModule)
                    @if ($userOnModule->isProfessor($module))
                        <li><a href="{{ route('user.show', ['id' => $userOnModule->id]) }}">{{ $userOnModule->firstname}} {{ $userOnModule->surname }}</a></li>
                    @endif
                @endforeach
                </ul>
            </div>
        </div>

        <!-- List of Assessors and Professors in Module -->
        <div class="col-md-3">

            <!-- Gets all the Assessors on the module -->
            <h5>{{ __('Assessors') }}</h5>
            <div class="work-infobox-list">
                <ul>
                @foreach ($module->users as $userOnModule)
                    @if ($userOnModule->isAssessor($module))
                        <li><a href="{{ route('user.show', ['id' => $userOnModule->id]) }}">{{ $userOnModule->firstname}} {{ $userOnModule->surname }}</a></li>
                    @endif
                @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>