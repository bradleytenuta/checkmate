<!-- The assign table container -->
<div class="col-sm-12">

    <label>Assign</label>

    <!-- The Assign Header -->
    <div id="create-module-assign-header">
        <div class="col-sm-12">

            <!-- Search bar -->
            <div class="input-group">
                <input
                    class="form-control"
                    id="create-module-search"
                    placeholder="Search by name or id..."
                    onkeypress="if (event.keyCode == 13) {return false;}">
                <div class="input-group-append" onclick="searchForUser()">
                    <span class="input-group-text">Search</span>
                </div>
            </div>

            <!-- Table header -->
            <table>
                <tr>
                    <!-- The Radio Button options and onclick select all feature -->
                    <th><img
                        src="{{ Storage::url('/images/other/module-icon-professor.png') }}"
                        title="Select All - Professor"
                        class="form-check form-check-inline"
                        onclick="tableSelectAll({{ \App\ModuleRole::where('name', 'professor')->first()->id }})" /></th>
                    <th><img
                        src="{{ Storage::url('/images/other/module-icon-assessor.png') }}"
                        title="Select All - Assessor"
                        class="form-check form-check-inline"
                        onclick="tableSelectAll({{ \App\ModuleRole::where('name', 'assessor')->first()->id }})" /></th>
                    <th><img
                        src="{{ Storage::url('/images/other/module-icon-student.png') }}"
                        title="Select All - Student"
                        class="form-check form-check-inline"
                        onclick="tableSelectAll({{ \App\ModuleRole::where('name', 'student')->first()->id }})" /></th>
                    
                    <!-- Headers to explain the other cells -->
                    <th class="create-module-cell-id"><div class="form-check form-check-inline">Id</div></th>
                    <th><div class="form-check form-check-inline">Name</div></th>
                </tr>
            </table>
        </div>
    </div>

    <!-- Contains the options to assgin users to a module -->
    <div id="create-module-assign-container">
        <div class="col-sm-12">
            <table>
                @foreach (\App\User::all() as $user)
                    <tr>
                        <!-- Option Buttons -->
                        <td>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="{{ $user->id }}"
                                    id="radio-id-1-{{ $user->id }}"
                                    value="{{ \App\ModuleRole::where('name', 'professor')->first()->id }}"
                                    @if ($user->isProfessor($module))
                                    checked
                                    @endif>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="{{ $user->id }}"
                                    id="radio-id-2-{{ $user->id }}"
                                    value="{{ \App\ModuleRole::where('name', 'assessor')->first()->id }}"
                                    @if ($user->isAssessor($module))
                                    checked
                                    @endif>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="{{ $user->id }}"
                                    id="radio-id-3-{{ $user->id }}"
                                    value="{{ \App\ModuleRole::where('name', 'student')->first()->id }}"
                                    @if ($user->isStudent($module))
                                    checked
                                    @endif>
                            </div>
                        </td>
                        <!-- Name and ID -->
                        <td class="create-module-cell-id">
                            <div class="form-check form-check-inline">
                                <div class="form-check-input create-module-cell-id-inner">{{ $user->id }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <div class="form-check-input create-module-cell-name-inner">{{ $user->firstname }} {{ $user->surname }}</div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

</div>