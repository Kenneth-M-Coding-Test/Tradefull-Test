<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Orbitron:700&display=swap" />
</head>
<style>
    th,td {
        text-align: center;
    }
</style>

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

</html>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
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