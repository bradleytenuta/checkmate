<div class="modal" id="confirmation-modal" tabindex="-1" role="dialog" aria-labelledby="confirmation-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title">Are you sure?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('delete-form').submit();">Yes</button>
            </div>

            <!-- Delete Form -->
            <form id="delete-form" action="{{ $route ?? '' }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
