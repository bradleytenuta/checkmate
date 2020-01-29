<!-- Card for holder Module or Coursework information -->
<div class="grid">
    <!-- Used to set the size of the grids -->
    <div class="grid-sizer col-lg-2"></div>

    <!-- A list of all the cards -->
    @foreach ($items as $item)
        <div class="grid-item col-lg-4 mb-2">
            <div class="card">
                <div class="card-body">

                    <!-- Card Contents -->
                    <h5 class="card-title">{{ $item->name }}</h5>
                    <p class="card-text">{{ $item->description }}</p>

                    <!-- Links to open module -->
                    <a href="{{ route($urlName, ['id' => $item->id]) }}" class="card-link">Open</a>

                    <!-- Icon to show role within module -->
                    <img 
                        class="list-card-permission-icon"
                        src="{{ Storage::url(Auth::user()->getModulePermissionIconPath($item)) }}"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title="{{ Auth::user()->getModulePermissionText($item) }}">
                </div>
            </div>
        </div>
    @endforeach
</div>