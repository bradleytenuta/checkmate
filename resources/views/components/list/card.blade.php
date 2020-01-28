<!-- Card for holder Module or Coursework information -->
<div class="card list-card-container">
    <div class="card-body">

        <!-- Card Contents -->
        <h5 class="card-title">{{ $item->name }}</h5>
        <p class="card-text list-card-text">{{ $item->description }}</p>

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