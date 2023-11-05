@extends('layouts.dashboard')

@section('title', 'Role | Pola Poli')

@section('content')
<div class="row mb-32 gy-32">
    <div class="col-12">
        <div class="row justify-content-between gy-32">
            <div class="col-12 col-md-4">
                <h4 class="h4">Role</h4>
            </div>
            <div class="col-12 col-md-7">
                <div class="row g-16 align-items-center justify-content-end">
                    <div class="col-12 col-md-6 col-xl-4">
                        <form action="{{route('settings.role.index')}}" method="get">

                            <div class="input-group align-items-center">
                                <span class="input-group-text bg-white hp-bg-dark-100 border-end-0 pe-0">
                                    <i class="iconly-Light-Search text-black-80" style="font-size: 16px;"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-8" id="search" name="search" value="{{request('search')??''}}" placeholder="Search">
                            </div>
                        </form>

                    </div>

                    <div class="col hp-flex-none w-auto">
                        @can('role-add')
                        <button type="button" class="btn btn-primary w-100" onclick="saveData();">
                            <i class="ri-add-line remix-icon"></i>
                            <span>Add Role</span>
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
                                <th>Name</th>
                                <th>Jumlah User</th>
                                <th>Jumlah Permission</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $item)
                                
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->users_count}}</td>
                                <td><a href="{{route('settings.permission.index')}}?role={{$item->id}}">{{$item->permissions_count}} Permissions</a></td>
                                <td class="text-end">
                                    @can('role-update')
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
                <h5 class="modal-title" id="modalDataLabel">Manage Role</h5>
                <button type="button" class="btn-close hp-bg-none d-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri-close-line hp-text-color-dark-0 lh-1" style="font-size: 24px;"></i>
                </button>
            </div>

            <div class="divider m-0"></div>

            <form id="myForm" action="{{route('settings.role.store')}}" method="POST">
                @csrf
                <div id="method">
                    @method("POST")
                </div>
                <div class="modal-body">
                    <input type="number" hidden>
                    <input type="text" id="role_id" hidden>

                    <div class="row gx-8">
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Name
                                </label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer pt-0 px-24 pb-24">
                    <div class="divider"></div>
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            @can('role-delete')
                            <button type="button"  onclick="deleteData()"  class="btn btn-danger btn-delete">Delete</button>
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
        $("#role_id").val(response.id.toString());
        $("#name").val(response.name);
    }

    function saveData() {
        $('.btn-edit').hide();
        $('.btn-delete').hide();
        $('.btn-update').hide();
        $('.btn-save').show();
        $(".modal-body :input").prop("disabled", false);
        $('#modalData').modal('show');
    }

    function detailData(id) {
        if(id != null){
            $.ajax({
                url: "{{route('settings.role.show', ':id')}}".replace(":id", id),
                type: "GET",
                success: function(res){
                    fillDetailData(res);
                }
            });
        }
        $('.btn-edit').show();
        $('.btn-delete').show();
        $('.btn-save').hide();
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
        const id = $("#role_id").val();
        console.log("id="+id);
        if(id != null && id != undefined){
            console.log("id = "+id);
            $("#myForm").attr("method", "POST");
            $("#myForm").attr("action", "{{route('settings.role.update', ':id')}}".replace(":id", id)); 
            $("#method").html(`@method('PUT')`); 
            $("#myForm").submit(); 
        } else {
            alert("Cannot update data, id not found");
        }
    }

    function deleteData() {
        const id = $("#role_id").val();
        if(id != null && id != undefined){
            console.log("id = "+id);
            $("#myForm").attr("method", "POST");
            $("#myForm").attr("action", "{{route('settings.role.destroy', ':id')}}".replace(":id", id)); 
            $("#method").html(`@method('delete')`); 
            $("#myForm").submit(); 

        } else {
            alert("Cannot update data, id not found");
        }
    }

    function resetModalState(){ 
        console.log("closed");
        $("#name").val("");
        $(".btn-save").prop("disabled", false);

    };

    $("#modalData").on("hidden.bs.modal", function () { 
        resetModalState();
    });

</script>
@endsection
