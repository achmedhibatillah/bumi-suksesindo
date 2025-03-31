@if(session()->has('error-modal'))
    <!-- Modal -->
    <div class="modal fade" id="modalError" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog modal-sm">
            <div class="modal-content border-light rounded-m">
                <div class="modal-header bg-danger text-light">
                    <h1 class="modal-title fs-5"><i class="fas fa-exclamation-circle me-2"></i>Peringatan</h1>
                    <button type="button" class="ms-auto hover bg-danger border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    {{ session('error-modal') }}
                </div>
            </div>
        </div>
    </div>
@endif
@if(session()->has('warning-modal'))
    <!-- Modal -->
    <div class="modal fade" id="modalWarning" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog modal-sm">
            <div class="modal-content border-light rounded-m">
                <div class="modal-header bg-warning text-dark">
                    <h1 class="modal-title fs-5"><i class="fas fa-exclamation-circle me-2"></i>Peringatan</h1>
                    <button type="button" class="ms-auto hover bg-warning border-secondary text-dark rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    {{ session('warning-modal') }}
                </div>
            </div>
        </div>
    </div>
@endif

<script>
document.addEventListener("DOMContentLoaded", function () {
    @if(session()->has('error-modal'))
        var myModal = new bootstrap.Modal(document.getElementById('modalError'));
        myModal.show();
    @endif
    @if(session()->has('warning-modal'))
        var myModal = new bootstrap.Modal(document.getElementById('modalWarning'));
        myModal.show();
    @endif
});
</script>
