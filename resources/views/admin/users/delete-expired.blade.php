<form id="deleteUsersForm" action="{{ route('users.deleteExpired') }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteExpiredModal">
        <i class="bx bx-trash"></i>
    </button>

    <div class="modal fade" id="deleteExpiredModal" tabindex="-1" aria-labelledby="deleteExpiredModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteExpiredModalLabel">Buni qaytara olmaysiz!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Haqiqatan ham muddati tugagan mijozlarni o‘chirib tashlamoqchimisiz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                    <button type="submit" class="btn btn-danger">Oʻchirish</button>
                </div>
            </div>
        </div>
    </div>
</form>
