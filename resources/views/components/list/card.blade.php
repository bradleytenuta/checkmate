<!-- Card for holder Module or Coursework information -->
<div class="grid list-container">
    <!-- Used to set the size of the grids -->
    <div class="grid-sizer col-lg-2"></div>

    <!-- A list of all the cards -->
    @foreach ($items as $item)
        <div class="grid-item col-lg-4 mb-2">
            <div class="card list-card-container">
                <div class="card-body">

                    <!-- Card Title -->
                    <h5>{{ $item->name }}</h5>

                    <!-- Card info icons -->
                    <div class="list-card-info-container">

                        <!-- Icon to show wheather its a module or a coursework -->
                        <img 
                            class="list-card-info-element"
                            src="{{ Storage::url(Auth::user()->getItemTypePath($item)) }}"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="{{ Auth::user()->getItemTypeText($item) }}" />

                        <!-- Icon to show role within module -->
                        <img 
                            class="list-card-info-element"
                            src="{{ Storage::url(Auth::user()->getModulePermissionIconPath($item)) }}"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="{{ Auth::user()->getModulePermissionText($item) }}" />

                        <!-- Icon to show if the item is open or closed -->
                        @if ($item->open == true)
                            <img 
                                class="list-card-info-element"
                                src="{{ Storage::url('/images/other/item-open.png') }}"
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="Open" />
                        @else
                            <img 
                                class="list-card-info-element"
                                src="{{ Storage::url('/images/other/item-closed.png') }}"
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="Closed" />
                        @endif

                        <!-- If coursework then show deadline -->
                        @if (Auth::user()->isCoursework($item))
                            @if(Auth::user()->dateIsToday($item))
                                <p class="list-card-due-today list-card-info-element">Due Today!</p>
                            @else
                                <p>{{ $item->deadline }}</p>
                            @endif
                        @endif

                        <!-- If module then show how many open courseworks -->
                        @if (Auth::user()->isModule($item))
                            <div
                                class="list-card-info-element list-card-number-of-courseworks"
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="Open Courseworks">
                                <img src="{{ Storage::url('/images/navbar/coursework.png') }}"/>
                                <p>{{ sizeof(Auth::user()->getOpenCourseworks($item)) }}</p>
                            </div>
                            
                        @endif

                    </div>

                    <!-- Card Description -->
                    <p class="card-text">{{ $item->description }}</p>

                    <!-- Links to open module -->
                    <a href="{{ route($urlName, ['id' => $item->id]) }}" class="card-link">Open</a>
                </div>
            </div>
        </div>
    @endforeach
</div>