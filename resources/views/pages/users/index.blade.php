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
                <h1>Management System</h1>
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
                                <h4>Management User</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('user.create') }}" class="btn btn-icon btn-left btn-primary"><i
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

                                    <form method="GET" action="{{ route('user.index') }}">
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
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created At</th>
                                        </tr>

                                        @foreach ($users as $user)
                                            <tr>
                                                {{-- <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            class="custom-control-input" id="checkbox-1">
                                                        <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td> --}}
                                                <td>{{ $user->name }}
                                                    <div class="table-links">
                                                        <form action="{{ route('user.destroy', $user->id) }}"
                                                            method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <a href="#">View</a>
                                                            <div class="bullet"></div>
                                                            <a href="{{ route('user.edit', $user->id) }}">Edit</a>
                                                            <div class="bullet"></div>
                                                            <a href="" class="text-danger deleted"
                                                                data-name="{{ $user->name }}">Trash</a>
                                                        </form>
                                                        {{-- <a href="" class="text-danger"
                                                            onclick="event.preventDefault(); document.getElementById('delete-form').submit()">Trash</a> --}}
                                                        {{-- <form id="delete-form"
                                                            action="{{ route('user.destroy', $user->id) }}" method="post"
                                                            style="display: none">
                                                            @method('delete')
                                                            @csrf
                                                        </form> --}}

                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $user->email }}
                                                </td>
                                                <td>
                                                    <div
                                                        class="badge
                                                            badge-warning">
                                                        {{ $user->role }}
                                                    </div>
                                                </td>
                                                <td>{{ $user->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $users->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
    {{-- Sweetalert --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script>
        $('.deleted').click(function(event) {
            var username = $(this).attr('data-name');
            var form = $(this).closest('form')
            event.preventDefault();
            swal({
                    title: 'Are you sure?',
                    // text: 'Once deleted, you will not be able to recover this imaginary file!',
                    text: 'Once deleted, you will not be able to recover this imaginary file! ' + username +
                        ' ',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {

                    if (willDelete) {
                        form.submit();
                        // window.location = '/user/' + userid + ''
                        swal('Poof! Your imaginary file has been deleted!', {
                            icon: 'success',
                        });
                    } else {
                        swal('Your imaginary file is safe!');
                    }
                });
        });
    </script>



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
