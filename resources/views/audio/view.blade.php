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

        .card-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .audio-file {
            margin-top: 15px;
        }
    </style>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                       <h2>Audio Files Details</h2>
                    </div>
                    <div class="card-body">
                        <p><strong>Title:</strong> {{ $collection->name }}</p>
                        <p><strong>Description:</strong> {{ $collection->description }}</p>

                        <h4>Audio Files</h4>
                        @foreach($collection->audioFiles as $audioFile)
                            <div class="audio-file">
                                <p><strong>Language:</strong> {{ $audioFile->language }}</p>
                                <audio controls>
                                    <source src="{{ Storage::url($audioFile->file_path) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        @endforeach

                        <div class="text-center mt-3">
                            <a href="{{ route('audio.index') }}" class="btn btn-md btn-secondary">Back to Collections</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
