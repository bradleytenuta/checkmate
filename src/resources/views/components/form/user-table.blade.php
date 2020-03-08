<!-- The assign table container -->
<div class="col-sm-12">

    <label>All Users</label>

    <!-- The Assign Header -->
    <div id="create-module-assign-header">
        <div class="col-sm-12">

            <!-- Search bar -->
            @include('components.form.search')

            <!-- Table header -->
            <table>
                <tr class="header-table-row">
                    <!-- Headers to explain the other cells -->
                    <th><div class="form-check form-check-inline">Id</div></th>
                    <th><div class="form-check form-check-inline">Name</div></th>
                </tr>
            </table>
        </div>
    </div>

    <div id="create-module-assign-container">
        <div class="col-sm-12">
            <table>
                @foreach (\App\User::all()->except(['id', Auth::user()->id]) as $user)
                    <tr class="content-table-row">
                        <!-- Name and ID -->
                        <td>
                            <div class="form-check form-check-inline">
                                <div class="form-check-input create-module-cell-id-inner">{{ $user->id }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <a href="{{ route('user.show', ['user_id' => $user->id]) }}" class="form-check-input create-module-cell-name-inner">{{ $user->firstname }} {{ $user->surname }}</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>