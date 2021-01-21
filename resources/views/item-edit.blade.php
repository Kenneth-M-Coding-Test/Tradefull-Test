<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Orbitron:700&display=swap" />
</head>

<body>
    <div style="width: 50%; margin:0 auto;">
        <h3 style="margin: 20px 0 20px 0;" class="text-center" id="title">Update Item</h3>
        <form id="edit-form">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" step=".01" class="form-control" id="price">
            </div>
            <button type="submit" class="btn btn-success" id="updateItemBtn">Update</button>
            <a href="/item" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var item = @json($item);

        $('#name').val(item.name);
        $('#price').val(item.price);

        if (!item.id) {
            $('#title').html('Create Item');
            $('#updateItemBtn').html('Create');
        }

        $('#edit-form').submit(function(e) {
            e.preventDefault();
            var updatedItem = {};
            var method = 'PATCH';
            var url = '/api/item/' + item.id;
            updatedItem.id = item.id;
            updatedItem.name = $('#name').val();
            updatedItem.price = $('#price').val();

            if (!updatedItem.name || !updatedItem.price) {
                return;
            }

            if (!updatedItem.id) {
                updatedItem.id = 0;
                method = 'POST';
                url = '/api/item';
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: method,
                data : {
                    item:updatedItem
                },
                success: function() {
                    window.location.replace("/item");
                }
            });
        }); 
    });
</script>