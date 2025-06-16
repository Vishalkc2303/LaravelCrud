@extends('admin.layouts.app')

@section('content')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>
    <main>
        <div class="container-fluid px-5">
            <h1 class="mt-4">Edit News Article</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" required value="{{ $news->title }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                        name="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10">{{ $news->content }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title"
                        name="meta_title" value="{{ $news->meta_title }}">
                    @error('meta_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <input type="text" class="form-control @error('meta_description') is-invalid @enderror"
                        id="meta_description" name="meta_description" value="{{ $news->meta_description }}">
                    @error('meta_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                                name="category_id" required>
                                <option value="{{ $news->category_id }}">{{ $news->category->name }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $news->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label for="subcategory_id" class="form-label">Subcategory</label>
                            <select class="form-select @error('subcategory_id') is-invalid @enderror" id="subcategory_id"
                                name="subcategory_id" required>
                                <option value="{{ $news->subcategory_id }}">{{ $news->subCategory->name }}</option>
                                <option value="">Select Subcategory</option>
                                {{-- @foreach ($subcategories as $subcategory)
                                <option value="">
                                    {{ $news->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                                        {{ $subcategory->name }}
                                </option>
                                @endforeach --}}
                            </select>
                            @error('subcategory_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <style>
                    .bootstrap-tagsinput {
                        margin: 0;
                        width: 100%;
                        padding: 0.5rem 0.75rem 0;
                        font-size: 1rem;
                        line-height: 1.25;
                        transition: border-color 0.15s ease-in-out;

                        &.has-focus {
                            background-color: #fff;
                            border-color: #5cb3fd;
                        }

                        .label-info {
                            display: inline-block;
                            background-color: #636c72;
                            padding: 0 .4em .15em;
                            border-radius: .25rem;
                            margin-bottom: 0.4em;
                        }

                        input {
                            margin-bottom: 0.5em;
                        }
                    }

                    .bootstrap-tagsinput .tag [data-role="remove"]:after {
                        content: '\00d7';
                    }
                </style>
                <div class="mb-3">
                    <label for="tags" class="form-label">Tags(Press enter after tags & Enter all the tags again if you
                        are editing the tags)</label>
                    {{-- <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags"
                        name="tags" value="{{ old('tags') }}"> --}}
                    <input type="text" name="tags" value="" data-role="tagsinput" placeholder="Add tags" />

                    @error('tags')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary btn-lg mb-5">Submit</button>
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}

    {{-- <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script> --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('#content'))
                .catch(error => {
                    console.error(error);
                });
        });
    </script>

    <script>
        // CKEDITOR.replace('content');

        $(document).ready(function() {

            $(document).on('change', '#category_id', function() {
                var categoryId = $(this).val();
                var subcategorySelect = $('#subcategory_id');

                // Clear existing options
                subcategorySelect.empty().append('<option value="">Select Subcategory</option>');

                if (categoryId) {
                    $.getJSON('/api/subcategories/' + categoryId, function(data) {
                        $.each(data.subcategories, function(index, subcategory) {
                            var option = $('<option></option>').val(subcategory.id).text(
                                subcategory.name);
                            subcategorySelect.append(option);
                        });
                    });
                }
            });
        });
        // for tags input

        $(document).ready(function() {

            $('input[name="input"]').tagsinput({
                trimValue: true,
                confirmKeys: [13, 44, 32],
                focusClass: 'my-focus-class'
            });

            $('.bootstrap-tagsinput input').on('focus', function() {
                $(this).closest('.bootstrap-tagsinput').addClass('has-focus');
            }).on('blur', function() {
                $(this).closest('.bootstrap-tagsinput').removeClass('has-focus');
            });

        });
    </script>


    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
@endsection
