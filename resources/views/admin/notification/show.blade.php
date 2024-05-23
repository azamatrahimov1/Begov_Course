@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light"></span> Xabarlar</h4>

    @include('admin.success-alert')

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">To'liq Ism</th>
{{--                    <th scope="col">Telefon Raqami</th>--}}
                    <th scope="col">Tavsifi</th>
                    <th scope="col">Sana</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$contact->data['full_name'] }}</td>
{{--                        <td>{{$contact->data['phone_number'] }}</td>--}}
                        <td>{{$contact->data['desc'] }}</td>
                        <td>{{$contact->created_at}}</td>
                        <td>
                            @if(auth()->user()->can('delete'))
                                <button type="button" class="btn btn-icon btn-danger me-2"
                                        data-bs-toggle="modal" data-bs-target="#modalToggle{{$contact->id}}">
                                    <i class="bx bx-trash-alt"></i></button>

                                <div class="modal fade" id="modalToggle{{$contact->id}}"
                                     aria-labelledby="modalToggleLabel{{$contact->id}}" tabindex="-1"
                                     style="display: none" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalToggleLabel{{$contact->id}}">
                                                    Buni qaytara olmaysiz!</h5>
                                                <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">{{ $contact->full_name }}</div>
                                            <div class="modal-footer">
                                                <form
                                                    action="{{ route('contacts.destroy', ['contact' => $contact->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">O'chirish
                                                    </button>
                                                </form>
                                                <button class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">Ortga
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')

@endsection




