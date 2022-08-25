@extends('layouts.admin_layout')

@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8"><h3 class="mb-0">Winner List</h3></div>
                            <div class="col-4 text-right d-none">
                                <!-- <a href="{{route('auction.register.create')}}" class="btn btn-sm btn-primary">Create
                                    Auction Register</a> -->
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="col-12">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="col-12">

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table id="table" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Auction</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Item</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


   
@stop
@push('backend_css')
    <link href="{{asset('argon/css/jquery.dataTables.min.css')}}">
    <link href="{{asset('argon/css/dataTables.bootstrap4.min.css')}}">
    <style>
        .dataTables_filter label {
            float: right;
        }

        .pagination {
            float: right;
        }
    </style>
@endpush
@push('backend_script')

    <script src="{{asset('argon/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('argon/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('winner.index')}}",
                language: {
                    paginate: {
                        next: '<i class="fas fa-arrow-right"></i>',
                        previous: '<i class="fas fa-arrow-left"></i>'
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'user', name: 'user'},
                    {data: 'auction', name: 'auction'},
                    {data: 'amount', name: 'amount'},
                    {data: 'item', name: 'item'},
                    
                ]
            });
          
        });
    </script>
@endpush
