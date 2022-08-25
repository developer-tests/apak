@extends('layouts.admin_layout')

@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Categories</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{route('category.create')}}" class="btn btn-sm btn-primary">Create</a>
                        </div>
                    </div>
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
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Parent Category</th>
                                <th scope="col">Creation Date</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                                                                
                                    @foreach($data as $d)
                                    <tr>
                                    <td>{{$d->id}}</td>
                                    <td>{{$d->title}}</td>
                                    <td>
                                    {{getFieldValue('Category','id',$d->parent_id,'title')}}
                                    </td>
                                    <td> {{$d->created_at}}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{route('category.edit', $d->id)}}">Edit</a>
                                                    <a class="dropdown-item" href="{{route('category.delete', $d->id)}}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                    </tr>
                                    @endforeach
                               
                                                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        
                    </nav>
                </div>
            </div>
        </div>
    </div>
  </div>
  
@endsection