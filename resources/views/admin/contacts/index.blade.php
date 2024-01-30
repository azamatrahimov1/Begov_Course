@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light"></span> Xabarlar</h4>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">To'liq Ism</th>
                    <th scope="col">Telefon Raqami</th>
                    <th scope="col">Tavsifi</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @php
                    $i = 1;
                @endphp
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$contact->full_name}}</td>
                        <td>{{$contact->phone_number}}</td>
                        <td>{{$contact->desc}}</td>
                        <td>
                            <div class="d-flex">
                                <form action="{{ route('contacts.destroy', ['contact' => $contact->id]) }}" method="POST"
                                      id="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            class="btn btn-danger"
                                            onclick="delete_button({{$contact->id}})">
                                        <i class="bx bx-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')
    <script>
        form = document.getElementById('form-delete');

        function delete_button(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.action = '/contacts/' + id;
                    form.submit()
                }
            })
        }

    </script>

@endsection




