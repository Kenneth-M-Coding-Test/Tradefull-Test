@extends('main')

@section('content')
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
@endsection

@section('bottomscript')
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
@endsection