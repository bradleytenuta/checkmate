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
                <tr>
                    <!-- Invisible button to add width to header -->
                    <th><img
                        src="{{ Storage::url('/images/icon/user-minus-solid.png') }}"
                        title="Delete Button"
                        class="form-check form-check-inline"/></th>
                    
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
                @foreach (\App\User::all()->except(['id', Auth::user()->id]) as $user)
                    <tr>
                        <!-- Delete Buttons -->
                        <td>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="{{ $user->id }}"
                                    id="radio-id-1-{{ $user->id }}"
                                    value="{{ $user->id }}">
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