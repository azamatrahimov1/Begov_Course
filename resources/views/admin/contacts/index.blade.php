<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>
    <div class="py-4 px-4">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="container mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Phone Number</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($contacts as $contact)
                                <tbody>
                                <tr>
                                    <td>{{$contact->id}}</td>
                                    <td>{{$contact->full_name}}</td>
                                    <td>{{$contact->phone_number}}</td>
                                    <td>{{$contact->desc}}</td>
                                    <td>
                                        <form action="{{ route('contacts.destroy', ['contact' => $contact->id]) }}"
                                              method="POST" class="btn btn-sm btn-danger btn-lg">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this contact?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
