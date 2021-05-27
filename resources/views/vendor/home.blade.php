@extends('index')
@section('content')
    <div class="container">
        <h2>Dashboard</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="danger">
                <td>Start Parse</td>
                <td>Parse Items</td>
                <td>Save Items</td>
                <td>Type Data</td>

                </thead>

                @foreach($data as $item)
                <tr>
                    <td>{{ $item->start_date }}</td>
                    <td>{{ $item->file_items }}</td>
                    <td>{{ $item->save_items }}</td>
                    <td>{{ $item->table_name }}</td>
                </tr>
                @endforeach
            </table>
    </div>
    </div>

@endsection
