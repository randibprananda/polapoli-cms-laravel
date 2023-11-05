@extends('layouts.dashboard')

@section('title', 'Manage Article | Pola Poli')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/select2.min.css')}}">
@endsection

@section('content')
<div class="row mb-32 gy-32">
    <div class="col-12">
        <div class="row justify-content-between gy-32">
            <div class="col-12 col-md-4 d-flex">
                <a href="{{ route('dashboard.news.index') }}" class="auth-back">
                    <i class="iconly-Light-ArrowLeft"></i>
                </a>
                <h4 class="mx-8 h4">Manage Article</h4>
            </div>
            <div class="col-12 col-md-7">
                <div class="row g-16 align-items-center justify-content-end">
                    <div class="col hp-flex-none w-auto">
                        <button type="button" class="btn btn-success btn-edit" onclick="editData();"
                            style="display:none">
                            <span>Edit</span>
                        </button>
                        <button type="button" id="cancel-edit" class="btn btn-text btn-cancel" onclick="cancelEdit();"
                            style="display:none">
                            <span>Cancel</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-save" onclick="saveData();"
                            style="display:none">
                            <span>Save</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card hp-contact-card mb-32">
            <div class="card-body">
                <form action="{{route('dashboard.news.store')}}" method="POST" id="formData" enctype="multipart/form-data">
                    @csrf
                    <div id="method">
                        @method("POST")
                    </div>
                    <input type="hidden" name="id" id="id" value="{{$data->id ?? ""}}">
                    <div class="row">
                        <div class="alert-notification">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Photo
                                </label>
                                <input type="file" name="picture" class="form-control" value="{{old("picture")}}" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Title
                                </label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$data->title ?? old("title")}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Slug
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text slug"
                                        id="basic-addon3">https://polapoli.id/news/</span>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{$data->slug ?? old("slug")}}" aria-describedby="basic-addon3">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="status" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Status
                                </label>
                                <input type="hidden" name="selected_status" id="selected_status" value="{{$data->status ?? ""}}">
                                <select class="form-select" id="status" name="status" required>
                                    <option selected hidden>Status</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4"></span>
                                    Keyword
                                </label>
                                <input type="text" class="form-control" id="keyword" name="keyword" value="{{$data->keyword ?? old('keyword')}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4"></span>
                                    Category
                                </label>
                                <input type="hidden" name="selected_category" id="selected_category" value="{{$data->category_id ?? ""}}">
                                <select id="category_ids" class="category form-select" name="category_ids[]" multiple="multiple">
                                    @foreach ($news_categories as $news_category)
                                    <option value="{{$news_category->id}}">{{$news_category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    {{-- <span class="text-danger me-4"></span> --}}
                                    Description
                                </label>
                                <input type="text" class="form-control" id="description" name="description" value="{{$data->description ?? old('description')}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Content
                                </label>
                                <textarea class="form-control" id="detail-content" name="content"
                                    rows="2">{{$data->content ?? old("content")}}</textarea>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('app-assets/js/slug.js')}}"></script>
<script src="{{asset('app-assets/js/select2.min.js')}}"></script>
<script src="{{asset('app-assets/js/tinymce.min.js')}}"></script>
<script src="{{asset('app-assets/js/wysiwg.js')}}"></script>

<script>
    function setSelectedCategory(){
        const selectedCategory = $("#selected_category").val();
        // console.log("categioru "+arraySelectedCategory)
        if(selectedCategory != ""){
            let arraySelectedCategory = selectedCategory.split(",").map((val)=>val.trim());
            setTimeout(() => {
                $('#category_ids').val(arraySelectedCategory).change();
            }, 100); 
        } else {
            $('#category_ids').val([]).change();
        }
    }
    function setSelectedStatus(){
        const selectedStatus = $("#selected_status").val();
        if(selectedStatus != ""){
            $('#status').val(selectedStatus).change();
        }
    }

    function cancelEdit(){
        resetToSavedData();
        disableInput();
    };

    function fillDetailData(response){
        console.log(response);
        $("#title").val(response.title);        
        $("#slug").val(response.slug);        
        $("#keyword").val(response.keyword);        
        setSelectedCategory()
        setSelectedStatus()
        $("#detail-content").val(response.content);       
        $("#description").val(response.description); 
    }

    function resetToSavedData() { 
        event.preventDefault();
        const id = $("#id").val()
        $.ajax({
                url: "{{route('dashboard.news.show', ':id')}}".replace(":id", id),
                type: "GET",
                success: function(res){
                    fillDetailData(res);
                }
        });
    }

    function disableInput(){
        $("#formData :input").prop("disabled", true);
        $('.btn-save').hide();
        $('.btn-cancel').hide();
        $('.btn-edit').show();
    }

    $(document).ready(function () {
        $('.category').select2();
        setSelectedCategory();
        setSelectedStatus();
        var url = window.location.pathname.split('/');
        var cond = url.pop() || url.pop();

        if (cond == "create") {
            $('.btn-save').show();
            $('.btn-cancel').hide();
            $('.btn-edit').hide();
            $("#formData :input").prop("disabled", false);
        } else {
            $("#formData :input").prop("disabled", true);
            $('.btn-save').hide();
            $('.btn-edit').show();
        }
    });

    $("#title").on("input", function () {
        let url = this.value;
        let slug = convertSlug(url);
        $("#slug").val(slug);
        let keyword = convertKeyword(url);
        $("#keyword").val(keyword);
    });

    function editData() {
        $("#formData :input").prop("disabled", false);
        $('.btn-save').show();
        $('.btn-save').attr("onclick", "updateData()");
        $('.btn-cancel').show();
        $('.btn-edit').hide();
    }

    function updateData(){
        const id = $("#id").val();
        console.log("id="+id);
        if(id != null && id != undefined){
            console.log("id = "+id);
            $("#formData").attr("method", "POST");
            $("#formData").attr("action", "{{route('dashboard.news.update', ':id')}}".replace(":id", id)); 
            $("#method").html(`@method('PUT')`); 
            $("#formData").submit(); 
        } else {
            alert("Cannot update data, id not found");
        }
    }
    function saveData() {
        $("#formData").submit(); 
    }

</script>
@endsection
