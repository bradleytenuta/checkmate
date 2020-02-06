<div class="work-infobox-container">
    <div class="row">

        <!-- Module Title Container -->
        @include('components.coursework.page.title', ['module'=>$module])

        <!-- Module Info Container -->
        <div class="col-md-12">
            <p>{{ $coursework->description }}</p>
        </div>

    </div>
</div>