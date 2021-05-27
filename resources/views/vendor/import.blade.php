@extends('index')
@section('content')
    <div class="container">

        <form method="POST" action="{{ url('upload') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="file_movies" class="control-label">Movies file import</label>
                <input id="file_movies" type="file" class="form-control" name="mycsv" required>

            </div>
            <p><button type="submit" class="btn btn-success" name="submit">Submit</button></p>
        </form>

    </div>
    <div class="container">

        <form method="POST" action="{{ url('upload-casts') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="file_movies" class="control-label">Casts file import</label>
                <input id="file_movies" type="file" class="form-control" name="mycsvcasts" required>
            </div>
            <p><button type="submit" class="btn btn-success" name="submit">Submit</button></p>
        </form>

    </div>

@endsection
