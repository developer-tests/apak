@extends('layouts.admin_layout')

@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8"><h3 class="mb-0">Wallets</h3></div>
                            <div class="col-4 text-right d-none">
                                <a href="{{route('auction.register.create')}}" class="btn btn-sm btn-primary">Create
                                    Auction Register</a>
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
                                    <th scope="col">wallet</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Created Date</th>
                                    <!-- <th scope="col">Action</th> -->
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="reject" tabindex="-1" aria-labelledby="rejectLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{route('auction.register.reject')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectLabel">Reject Reason</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-0">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="user_id" value="">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="reason">Reject Reason</label>
                                    <textarea class="form-control" id="reason" name="reason" rows="3">{{old('reason')}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
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
                ajax: "{{route('wallet.index')}}",
                language: {
                    paginate: {
                        next: '<i class="fas fa-arrow-right"></i>',
                        previous: '<i class="fas fa-arrow-left"></i>'
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'wallet', name: 'wallet'},
                    {data: 'description', name: 'description'},
                    {data: 'date', name: 'date'},
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: true,
                    //     searchable: true
                    // },
                ]
            });
          
        });
    </script>
@endpush
