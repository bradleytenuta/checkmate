<div class="breadcrumb-container">
    <a href="{{ route('home') }}">Home</a>
    >
    <a href="{{ route('module.show', ['module_id' => $coursework->module->id]) }}">{{ $coursework->module->name }}</a>
    >
    <a href="{{ route('coursework.show', ['module_id' => $coursework->module->id, 'coursework_id' => $coursework->id]) }}">{{ $coursework->name }}</a>
</div>