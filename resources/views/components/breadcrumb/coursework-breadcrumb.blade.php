<div class="breadcrumb-container">
    <a href="{{ route('home') }}">Home</a>
    >
    <a href="{{ route('module.show', ['module_id' => $coursework->module->id]) }}">{{ $coursework->module->name }}</a>
</div>