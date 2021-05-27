@extends('index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                                  data-toggle="tab">USA</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Europe</a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active " id="home">
                            @foreach($data_usa as $key => $item)
                                <h2>Decades : {{ $key }}s</h2>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="danger">
                                        <td>Years</td>
                                        <td>Rating</td>
                                        <td>Movie Name</td>
                                        <td>Year of movie</td>
                                        <td>Count of actors</td>
                                        <td>Genre</td>
                                        </thead>

                                        @foreach($item as $subitem)
                                            <tr>
                                                <td>{{ $key }}s</td>
                                                <td>{{ $subitem->avg_vote }}</td>
                                                <td>{{ $subitem->title }}</td>
                                                <td>{{ $subitem->year }}</td>
                                                <td>{{ count($subitem->actors) }}</td>
                                                <td>
                                                @foreach($subitem->genres as $genre)
                                                    {{$genre->name}};
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                            @endforeach


                        </div>


                        <div role="tabpanel" class="tab-pane" id="profile">
                            @foreach($data_eu as $key => $item)
                                <h2>Decades : {{ $key }}s</h2>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="danger">
                                        <td>Years</td>
                                        <td>Rating</td>
                                        <td>Movie Name</td>
                                        <td>Year of movie</td>
                                        <td>Count of actors</td>
                                        <td>Genre</td>
                                        </thead>

                                        @foreach($item as $subitem)
                                            <tr>
                                                <td>{{ $key }}s</td>
                                                <td>{{ $subitem->avg_vote }}</td>
                                                <td>{{ $subitem->title }}</td>
                                                <td>{{ $subitem->year }}</td>
                                                <td>{{ count($subitem->actors) }}</td>
                                                <td>
                                                    @foreach($subitem->genres as $genre)
                                                        {{$genre->name}};
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
