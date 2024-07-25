@extends('layout.master')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 d-flex justify-content-between align-items-center">
            Audio Files List
            <a href="{{ route('audio.create') }}" class="btn btn-primary">Upload Audio Files</a>
        </h2>
        <table class="table table-striped" id="" class="display" style="border: 1px solid var(--bs-gray-400);">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($collections as $key => $collection)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $collection->name }}</td>
                        <td>{{ $collection->description }}</td>
                        <td>
                            <a href="{{ route('audio.show', $collection) }}" class="btn btn-sm btn-secondary"><i
                                    class="fa fa-solid fa-eye"></i></a>
                            <a href="{{ route('audio.edit', $collection) }}" class="btn btn-sm btn-success"><i
                                    class="fa fa-solid fa-edit"></i></a>
                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="deleteAudio({{ $collection->id }})">
                                <i class="fa fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function deleteAudio(id) {
            if (confirm("Are you sure you want to delete this collection and its associated audio files?")) {
                $.ajax({
                    url: '/audio/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert('Collection and associated audio files deleted successfully!');
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('An error occurred while deleting the collection.');
                        console.error(xhr.responseText);
                    }
                });
            }
        }
    </script>
@endsection
