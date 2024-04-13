@extends('layouts.app')

@section('title', 'Management System')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Management Product</h1>
                {{-- <div class="section-header-button">
                    <a href="features-post-create.html" class="btn btn-primary">Add New</a>
                </div> --}}
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Posts</a></div>
                    <div class="breadcrumb-item">All Posts</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-0">
                            <div class="card-body">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">All <span
                                                class="badge badge-white">5</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Draft <span
                                                class="badge badge-primary">1</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Pending <span
                                                class="badge badge-primary">1</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Trash <span
                                                class="badge badge-primary">0</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Management Product</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('product.create') }}" class="btn btn-icon btn-left btn-primary"><i
                                            class="far fa-edit"></i> Add
                                        New</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <select class="form-control selectric">
                                        <option>Action For Selected</option>
                                        <option>Move to Draft</option>
                                        <option>Move to Pending</option>
                                        <option>Delete Pemanently</option>
                                    </select>
                                </div>
                                <div class="float-right">

                                    <form method="GET" action="{{ route('product.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            {{-- <th class="pt-2 text-center">
                                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        data-checkbox-role="dad" class="custom-control-input"
                                                        id="checkbox-all">
                                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </th> --}}
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            {{-- <th>Deskripsi</th> --}}
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Status</th>
                                            <th>Gambar</th>
                                            <th>Created At</th>
                                        </tr>

                                        @foreach ($products as $product)
                                            <tr>
                                                {{-- <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            class="custom-control-input" id="checkbox-1">
                                                        <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td> --}}
                                                <td>{{ $product->name }}
                                                    <div class="table-links">
                                                        <a href="#">View</a>
                                                        <div class="bullet"></div>
                                                        <a href="{{ route('product.edit', $product->id) }}">Edit</a>
                                                        <div class="bullet"></div>
                                                        <a href="" class="text-danger"
                                                            onclick="event.preventDefault(); document.getElementById('delete-form').submit()">Trash</a>
                                                        <form id="delete-form"
                                                            action="{{ route('product.destroy', $product->id) }}"
                                                            method="post" style="display: none">
                                                            @method('delete')
                                                            @csrf
                                                        </form>

                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $product->category->name }}
                                                </td>
                                                {{-- <td>
                                                    {{ $product->description }}
                                        </td> --}}
                                                <td>
                                                    {{ 'Rp. ' . number_format($product->price, 2, ',', '.') }}
                                                </td>
                                                <td>
                                                    {{ $product->stock }}
                                                </td>
                                                <td>

                                                    @if ($product->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                    {{-- <div
                                                        class="badge
                                                            badge-warning">
                                                        {{ $product->status == 1 ? 'AKCTIVE' : 'INACTIVE' }}
                                                    </div> --}}
                                                </td>
                                                <td>
                                                    <img src="{{ $product->image }}" width="100px" alt="">
                                                </td>
                                                <td>
                                                    {{ $product->created_at }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $products->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script> --}}
    {{-- Sweetalert Konfirmasi Delete --}}

    {{-- <script type="text/javascript">
        $('.delete').click(function() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
            });
        });
    </script> --}}

    {{-- <script type="text/javascript">
        $(function() {
            $(document).on('click', '#delete-form', function(e) {
                e.preventDefault();
                var link = $(this).attr("href");
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });

                    }
                });
            })
        })
    </script> --}}
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
{{-- @include('layouts.alert') --}}
