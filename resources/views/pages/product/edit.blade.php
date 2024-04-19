@extends('layouts.app')

@section('title', 'Tambah Produk')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Form Edit Produk</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('product.index') }}">Produk</a></div>
                    <div class="breadcrumb-item">Edit Produk</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Produk</h2>

                <div class="card">
                    <form action="{{ route('product.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Update Produk <div class="badge badge-success">{{ $product->name }}</div>
                            </h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text"
                                    class="form-control @error('name')
                                is-invalid
                            @enderror"
                                    name="name" value="{{ $product->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('name')
                                    <div class="valid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                {{-- <input style="height: 150px"
                                    class="form-control @error('description')
                                is-invalid
                            @enderror"
                                    name="description" value="{{ $product->description }}" type="text"> --}}
                                <textarea style="height: 150px"
                                    class="form-control @error('description')
                                is-invalid
                            @enderror"
                                    name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Gambar Produk</label>
                                @if ($product->image)
                                    <img src="{{ asset('storage/products/' . $product->image) }}"
                                        class="img-preview img-fluid mb-3 col-sm-3 d-block">
                                @else
                                    <img class="img-preview img-fluid mb-3 col-sm-3">
                                @endif
                                <input type="file" id="image"
                                    class="form-control @error('image')
                                is-invalid
                            @enderror"
                                    name="image" onchange="previewImage()">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Kategori</label>
                                <select name="category_id"
                                    class="form-control selectric @error('category_id') is-invalid
                                @enderror">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number"
                                    class="form-control @error('price')
                                is-invalid
                            @enderror"
                                    name="price" value="{{ $product->price }}">
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number"
                                    class="form-control @error('stock')
                                is-invalid
                            @enderror"
                                    name="stock" value="{{ $product->stock }}">
                                @error('stock')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="selectgroup selectgroup-pills">
                                    <label class="selectgroup-item">
                                        <input type="radio" class="selectgroup-input" name="status" value="1"
                                            {{ $product->status == 1 ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" class="selectgroup-input" name="status" value="0"
                                            {{ $product->status == 0 ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Inactive</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Favorite</label>
                                    <div class="selectgroup selectgroup-pills">
                                        <label class="selectgroup-item">
                                            <input type="radio" class="selectgroup-input" name="is_favorite"
                                                value="1" {{ $product->is_favorite == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">Like</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" class="selectgroup-input" name="is_favorite"
                                                value="0" {{ $product->is_favorite == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">Unlike</span>
                                        </label>
                                    </div>

                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description')
    </script>
@endpush
