<!-- The assign table container -->
<div class="col-sm-12">

    <!-- The Assign Header -->
    <div id="create-module-assign-header">
        <div class="col-sm-12">

            <!-- Search bar -->
            @include('components.form.search')

            <!-- Table header -->
            <table>
                <tr id="submission-header-row" class="header-table-row">
                    <!-- Headers to explain the other cells -->
                    <th><div class="form-check form-check-inline">Id</div></th>
                    <th><div class="form-check form-check-inline">Name</div></th>
                    <th><div class="form-check form-check-inline">Submitted</div></th>
                    <th><div class="form-check form-check-inline">Mark</div></th>
                    <th><div class="form-check form-check-inline">Marker</div></th>
                    <th><div class="form-check form-check-inline">Link</div></th>
                </tr>
            </table>
        </div>
    </div>

    <div id="create-module-assign-container">
        <div class="col-sm-12">
            <table>
                <!-- Additional Header Row for mobile view, only for submission blade file. -->
                <tr id="submission-header-row-mobile">
                    <!-- Headers to explain the other cells -->
                    <th><div class="form-check form-check-inline">Id</div></th>
                    <th><div class="form-check form-check-inline">Name</div></th>
                    <th><div class="form-check form-check-inline">Submitted</div></th>
                    <th><div class="form-check form-check-inline">Mark</div></th>
                    <th><div class="form-check form-check-inline">Marker</div></th>
                    <th><div class="form-check form-check-inline">Link</div></th>
                </tr>

                @foreach ($coursework->module->users as $user)
                    <!-- Gets the submission that belongs to the user -->
                    @php
                        $submission = $coursework->submissions->firstWhere('user_id', $user->id);
                        $submitted = $submission != null;
                        $userMarker = $coursework->module->users->firstWhere('id', $submission->marker_id);
                    @endphp
                    <tr class="content-table-row">
                        <!-- ID -->
                        <td class="create-module-cell-id">
                            <div class="form-check form-check-inline">
                                <div class="form-check-input create-module-cell-id-inner">{{ $user->id }}</div>
                            </div>
                        </td>
                        <!-- Name -->
                        <td>
                            <div class="form-check form-check-inline">
                                <a href="{{ route('user.show', ['user_id' => $user->id]) }}" class="form-check-input create-module-cell-name-inner">{{ $user->firstname }} {{ $user->surname }}</a>
                            </div>
                        </td>
                        <!-- Submitted -->
                        <td>
                            <div class="form-check form-check-inline">
                                @if ($submitted)
                                    <div class="form-check-input">Submitted</div>
                                @else
                                    <div class="form-check-input">N/A</div>
                                @endif
                            </div>
                        </td>
                        <!-- Score -->
                        <td>
                            <div class="form-check form-check-inline">
                                @if ($submitted && $submission->score != null)
                                    <div class="form-check-input">{{ $submission->score }}</div>
                                @else
                                    <div class="form-check-input">N/A</div>
                                @endif
                            </div>
                        </td>
                        <!-- Marker -->
                        <td>
                            <div class="form-check form-check-inline">
                                @if ($submitted && $userMarker != null)
                                    <div class="form-check-input">{{ $userMarker->firstname }} {{ $userMarker->surname }}</div>
                                @else
                                    <div class="form-check-input">N/A</div>
                                @endif
                            </div>
                        </td>
                        <!-- Link -->
                        <td>
                            <div class="form-check form-check-inline">
                                @if ($submitted)
                                    <a
                                        href="{{ route('viewer.mark', ['module_id' => $coursework->module->id, 'coursework_id' => $coursework->id, 'submission_id' => $submission->id]) }}"
                                        type="button" class="form-check-input">Mark</a>
                                @else
                                    <p>N/A</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>