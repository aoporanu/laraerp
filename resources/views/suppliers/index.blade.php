@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Suppliers list</div>
                    <div class="card-body">
                        <table class="table table-bodered" id="supplier_table">
                            <tr>
                                <th>ID</th>
                                <th>SKU</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {
            $('#supplier_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('suppliers.datatable.data') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'sku', name: 'sku'},
                    {data: 'name', name: 'name'}
                ]
            });
        });
    </script>
@endsection