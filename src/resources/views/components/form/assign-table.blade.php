<!-- The assign table container -->
<div class="col-sm-12">

    <label>Assign<span class="field-required">*</span></label>

    <!-- The Assign Header -->
    <div id="create-module-assign-header">
        <div class="col-sm-12">

            <!-- Search bar -->
            @include('components.form.search')

            <!-- Table header -->
            <table>
                <tr class="header-table-row">
                    <!-- The Radio Button options and onclick select all feature -->
                    <th><img
                        src="{{ Storage::url('/images/icon/module-icon-professor.png') }}"
                        title="Select All - Professor"
                        class="form-check form-check-inline"
                        onclick="tableSelectAll({{ \App\ModuleRole::where('name', 'professor')->first()->id }})" /></th>
                    <th><img
                        src="{{ Storage::url('/images/icon/module-icon-assessor.png') }}"
                        title="Select All - Assessor"
                        class="form-check form-check-inline"
                        onclick="tableSelectAll({{ \App\ModuleRole::where('name', 'assessor')->first()->id }})" /></th>
                    <th><img
                        src="{{ Storage::url('/images/icon/module-icon-student.png') }}"
                        title="Select All - Student"
                        class="form-check form-check-inline"
                        onclick="tableSelectAll({{ \App\ModuleRole::where('name', 'student')->first()->id }})" /></th>
                    
                    <!-- Headers to explain the other cells -->
                    <th><div class="form-check form-check-inline">Id</div></th>
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
                    <tr class="content-table-row">
                        <!-- Option Buttons -->
                        <td>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="{{ $user->id }}"
                                    id="radio-id-1-{{ $user->id }}"
                                    value="{{ \App\ModuleRole::where('name', 'professor')->first()->id }}">
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="{{ $user->id }}"
                                    id="radio-id-2-{{ $user->id }}"
                                    value="{{ \App\ModuleRole::where('name', 'assessor')->first()->id }}">
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="{{ $user->id }}"
                                    id="radio-id-3-{{ $user->id }}"
                                    value="{{ \App\ModuleRole::where('name', 'student')->first()->id }}">
                            </div>
                        </td>
                        <!-- Name and ID -->
                        <td>
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

<!-- Information warning box, reminding people to select at least one Professor -->
<div class="alert alert-primary mt-5" role="alert">
    <p>Only a single Professor needs to be assgined right now!</p>
    <hr>
    <p>Assign yourself to this module if you wish to be able to see it after creation.</p>
    <hr>
    <p class="mb-0">Assigning additonal Students, Assessors and Professors can be done later in the edit menu.</p>
</div>