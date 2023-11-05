@extends('layouts.dashboard')

@section('title', 'Contact | Pola Poli')

@section('content')
<div class="row mb-32 gy-32">
    <div class="col-12">
        <div class="row justify-content-between gy-32">
            <div class="col-12 col-md-4">
                <h4 class="h4">Contact</h4>
            </div>
            <div class="col-12 col-md-7">
                <div class="row g-16 align-items-center justify-content-end">
                    <div class="col-12 col-md-6 col-xl-4">
                        <form action="{{route('settings.contact.index')}}" method="get">

                        <div class="input-group align-items-center">
                            <span class="input-group-text bg-white hp-bg-dark-100 border-end-0 pe-0">
                                <i class="iconly-Light-Search text-black-80" style="font-size: 16px;"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 ps-8" id="search" name="search" value="{{request('search')??''}}" placeholder="Search">
                        </div>
                    </form>

                    </div>

                    <div class="col hp-flex-none w-auto">
                        @can('web-add')
                        <button type="button" class="btn btn-primary w-100" onclick="saveData();">
                            <i class="ri-add-line remix-icon"></i>
                            <span>Tambah Contact</span>
                        </button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
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
        <div class="card hp-contact-card mb-32">
            <div class="card-body px-0">
                <div class="table-responsive">
                    <table class="table align-middle table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $item)
                                
                            <tr>
                                
                                <td>
                                    {{$item->title}}
                                </td>
                                <td>
                                    {{$item->content}}
                                </td>
                                <td>
                                    @if ($item->status == 1) 
                                    <div class="badge bg-success-4 hp-bg-dark-success text-success border-success">
                                        active
                                    </div>

                                    @else
                                    <div class="badge bg-danger-4 hp-bg-dark-danger text-danger border-danger">
                                        inactive
                                    </div>
                                    @endif
                                </td> 
                                <td class="text-end">
                                    @can('web-update')
                                    <button onclick="detailData({{$item->id}})" class="btn btn-text text-primary btn-sm"
                                        title="Detail">
                                        <i class="iconly-Light-Show"></i>
                                    </button>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- @include('partials.dashboard.pagination') --}}
                <div>
                    {{$data->links("pagination::bootstrap-4")}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="modalData" tabindex="-1" aria-labelledby="modalDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-16 px-24">
                <h5 class="modal-title" id="modalDataLabel">Manage Info</h5>
                <button type="button" class="btn-close hp-bg-none d-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri-close-line hp-text-color-dark-0 lh-1" style="font-size: 24px;"></i>
                </button>
            </div>

            <div class="divider m-0"></div>

            <form id="formData" action="{{route('settings.contact.store')}}" method="POST">
                @csrf
                <div id="method">
                    @method("POST")
                </div>
                <div class="modal-body">
                    <input type="number" hidden>
                    <input type="text" id="contact_id" hidden>

                    <div class="row gx-8">
                        <div class="col-12 col-md-12">

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4">*</span>
                                        Title
                                    </label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4">*</span>
                                        Content
                                    </label>
                                    <input type="text" class="form-control" id="content" name="content">
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="status" class="form-label">
                                        <span class="text-danger me-4">*</span>
                                        Status
                                    </label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option selected hidden>Status</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer pt-0 px-24 pb-24">
                    <div class="divider"></div>
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            @can('web-delete')
                            <button type="button" onclick="deleteData()" class="btn btn-danger btn-delete">Delete</button>
                            @endcan
                        </div>
                        <div>
                            <button type="button" class="btn btn-text btn-cancel"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success btn-edit" onclick="editData()">Edit</button>
                            <button type="submit" class="btn btn-primary btn-save">Save</button>
                            <button type="button" onclick="updateData()" class="btn btn-primary btn-update">Update</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function fillDetailData(response){
        console.log(response);
        $("#contact_id").val(response.id.toString());
        $("#title").val(response.title);
        $("#content").val(response.content);
        $("#status").val(response.status).change();
    }
    function saveData() {
        $('.btn-edit').hide();
        $('.btn-delete').hide();
        $('.btn-update').hide();
        $('.btn-save').show();
        $('#modalData').modal('show');
        $(".modal-body :input").prop("disabled", false);
    }

    function detailData(id) {
        if(id != null){
            $.ajax({
                url: "{{route('settings.contact.show', ':id')}}".replace(":id", id),
                type: "GET",
                success: function(res){
                    fillDetailData(res);
                }
            });
        }

        $('.btn-edit').show();
        $('.btn-delete').show();
        $('.btn-save').hide();
        $('.btn-update').hide();
        $(".modal-body :input").prop("disabled", true);
        $('#modalData').modal('show');
    }

    function editData() {
        $(".modal-body :input").prop("disabled", false);
        $('.btn-edit').hide();
        $('.btn-delete').hide();
        $('.btn-save').hide();
        $(".btn-save").prop("disabled", true);
        $('.btn-update').show();
    }

    function updateData(){
        const id = $("#contact_id").val();
        console.log("id="+id);
        if(id != null && id != undefined){
            console.log("id = "+id);
            $("#formData").attr("method", "POST");
            $("#formData").attr("action", "{{route('settings.contact.update', ':id')}}".replace(":id", id)); 
            $("#method").html(`@method('PUT')`); 
            $("#formData").submit(); 
        } else {
            alert("Cannot update data, id not found");
        }
    }

    function deleteData() {
        const id = $("#contact_id").val();
        if(id != null && id != undefined){
            console.log("id = "+id);
            $("#formData").attr("method", "POST");
            $("#formData").attr("action", "{{route('settings.contact.destroy', ':id')}}".replace(":id", id)); 
            $("#method").html(`@method('delete')`); 
            $("#formData").submit(); 

        } else {
            alert("Cannot update data, id not found");
        }
    }

    function resetModalState(){ 
        console.log("closed");
        $("#title").val("");
        $("#content").val("");
        $("#contact").val("");
        $("#status").val("Status").change();
        $(".btn-save").prop("disabled", false);

    };

    $("#modalData").on("hidden.bs.modal", function () { 
        resetModalState();
    });

</script>
@endsection
