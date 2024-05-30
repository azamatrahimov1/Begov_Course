<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exLargeModal">
    <i class="bx bx-plus"></i>
</button>
<form action="{{ route('users.index') }}" method="GET" class="d-inline">
    <input type="hidden" name="filter" value="expired">
    <button class="btn btn-info" type="submit">
        <i class="bx bx-filter-alt"></i>
    </button>
</form>
