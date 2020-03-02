<div class="input-group">
    <input
        class="form-control"
        id="create-module-search"
        placeholder="Search by name or id..."
        onkeypress="if (event.keyCode == 13) {searchForUser(); return false;}">
    <div class="input-group-append" onclick="searchForUser()">
        <span class="input-group-text">Search</span>
    </div>
</div>