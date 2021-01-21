@extends('main')

@section('topscript')
    <style>
        th,td {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <body>
        <div style="width: 80%; margin:0 auto;">
            <h3 style="margin: 20px 0 20px 0;" class="text-center">Item Table</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th >Id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>
                                <a href="/item/{{ $item->id }}" class="btn btn-success">Update</a>
                            </td>
                            <td>
                                <a class="btn btn-danger delete"  href="#" data-id={{ $item->id }}>Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <a class="btn btn-info" href="/item/create">Create New Item</a>
            </div>
        </div>
    </body>
@endsection

@section('bottomscript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.delete').click(function() {
                var id = $(this).attr('data-id');
            
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/api/item/' + id,
                    type: 'DELETE',
                    success: function() {
                        window.location.replace("/item");
                    }
                });
            });
        });
    </script>
@endsection