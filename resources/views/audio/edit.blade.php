@extends('layout.master')
@section('content')
    <style>
        .container {
            margin-top: 50px;
        }

        .card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .file-group {
            margin-bottom: 1rem;
        }
    </style>
    <div class="container mt-5">
        <div class="row">
           <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Audio Files</h2>
                    </div>
                    <div class="card-body">
                        <form id="audioForm" action="{{ route('audio.update', $collection->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="collection_name">Collection Name:</label>
                                <input type="text" name="collection_name" id="collection_name" class="form-control" value="{{ $collection->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" name="description">{{ $collection->description }}</textarea>
                            </div>
                            <div id="fileFields">
                                @foreach($collection->audioFiles as $audioFile)
                                    <div class="file-group d-flex align-items-center mb-2">
                                        <label for="current_files" class="mr-2">Current File:</label>
                                        <input type="text" class="form-control" value="{{ $audioFile->file_path }}" readonly>
                                        <label for="language" class="ml-2 mr-2">Language:</label>
                                        <select name="language[]" class="form-control" required>
                                            <option value="en" {{ $audioFile->language == 'en' ? 'selected' : '' }}>English</option>
                                            <option value="es" {{ $audioFile->language == 'es' ? 'selected' : '' }}>Spanish</option>
                                            <option value="fr" {{ $audioFile->language == 'fr' ? 'selected' : '' }}>French</option>
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                            <div id="newFileFields">
                                <div class="file-group d-flex align-items-center mb-2">
                                    <label for="files" class="mr-2">New Audio File:</label>
                                    <input type="file" name="files[]" class="form-control-file" accept=".mp3,.wav">
                                    <label for="language" class="ml-2 mr-2">Language:</label>
                                    <select name="language[]" class="form-control">
                                        <option value="">Select Language</option>
                                        <option value="en">English</option>
                                        <option value="es">Spanish</option>
                                        <option value="fr">French</option>
                                    </select>
                                    <button type="button" class="btn btn-danger ml-2 remove-file"> <i class="fa fa-solid fa-trash"></i></button>
                                </div>
                            </div>
                            <button type="button" id="addFile" class="btn btn-secondary">Add More Files</button>

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('audio.index') }}" class="btn btn-md btn-secondary">Back</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('addFile').addEventListener('click', function () {
            var fileFields = document.getElementById('newFileFields');
            var newField = document.createElement('div');
            newField.className = 'file-group d-flex align-items-center mb-2';

            newField.innerHTML = `
                <label for="files" class="mr-2">New Audio File:</label>
                <input type="file" name="files[]" class="form-control-file" accept=".mp3,.wav">
                <label for="language" class="ml-2 mr-2">Language:</label>
                <select name="language[]" class="form-control">
                    <option value="">Select Language</option>
                    <option value="en">English</option>
                    <option value="es">Spanish</option>
                    <option value="fr">French</option>
                    <!-- Add more languages as needed -->
                </select>
                <button type="button" class="btn btn-danger ml-2 remove-file"> <i class="fa fa-solid fa-trash"></i></button>`;

            fileFields.appendChild(newField);
            newField.querySelector('.remove-file').addEventListener('click', function () {
                newField.remove();
            });
        });
    </script>
@endsection
