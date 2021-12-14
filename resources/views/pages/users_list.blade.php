@extends('layouts.master')

@push('styles')
    <link href="{{ asset('/dataTables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/dataTables/css/rowGroup.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('title', 'Users')

@section('content')

<div class="row mt-3">
    <div class="col-12">
        <h3>Users</h3>
        <table class="table" id="users_tbl">
            <thead class="bg-danger text-white">
                <th>Name</th>
                <th>Pokemon</th>
                <th>Reaction</th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
    

@endsection


@section('script')
    <script src="{{ asset('/dataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/dataTables/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('/dataTables/js/rowGroup.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready( function () {
            $('#users_tbl').DataTable({
                ajax: {
                        url: '/users/pokedex',
                        type: 'GET',
                        datatype: 'json'
                    },
                columns: [
                    {data: 'name'},
                    {data: 'pokemon'},
                    {data: 'reaction'}
                ],
                columnDefs: [ 
                    { visible: false, targets: 0 },
                    { targets : [2],
                      className : 'align-middle',
                        render : function (data, type, row) {
                            var result = '';
                            if(data == 'Favorite')
                            {
                                result = '<span class="fa fa-star h1 text-warning"></span> <label class="d-none">:'+data+'d</label>';
                            }
                            else if(data == 'Like')
                            {
                                result = '<span class="fa fa-thumbs-up h1 text-primary"></span> <label class="d-none">:'+data+'d</label>';
                            }
                            else
                            {
                                result = '<span class="fa fa-thumbs-down h1 text-danger"></span> <label class="d-none">:'+data+'d</label>';
                            }
                            return result ;
                        }
                    } 
                ], 
                order: [[ 0, 'asc' ]],
                displayLength: 10,
                drawCallback: function ( settings ) {
                    var api = this.api();
                    var rows = api.rows( {page:'current'} ).nodes();
                    var last=null; 
                    api.column(0, {page:'current'} )
                        .data().each( function ( group, i ) { 
                            if ( last !== group ) {
                                $(rows).eq( i ).before( '<tr class="group" style="background-color: #80808026;"><td colspan="3"><h5>'+group+'</h5></td></tr>' ); last = group; 
                            } } ); 
                },
                createdRow: function (row, data, index) {
                    
                } 
            });
        });





    </script>

@endsection