@extends('layouts.dashboard')

@section('title', 'Layanan | Pola Poli')

@section('content')
    <div class="row mb-32 gy-32">
        <div class="col-12">
            <div class="row justify-content-between gy-32">
                <div class="col-12 col-md-4">
                    <h4 class="h4">Layanan</h4>
                </div>
                <div class="col-12 col-md-7">
                    <div class="row g-16 align-items-center justify-content-end">
                        <div class="col-12 col-md-6 col-xl-4">
                            <form action="{{ route('dashboard.layanan.index') }}" method="get">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text bg-white hp-bg-dark-100 border-end-0 pe-0">
                                        <i class="iconly-Light-Search text-black-80" style="font-size: 16px;"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 ps-8" id="search"
                                        name="search" value="{{ request('search') ?? '' }}" placeholder="Search">
                                </div>
                            </form>
                        </div>

                        @can('layanan-add')
                            <div class="col hp-flex-none w-auto">
                                <button type="button" class="btn btn-primary w-100" onclick="saveData();">
                                    <i class="ri-add-line remix-icon"></i>
                                    <span>Add Layanan</span>
                                </button>
                            </div>
                        @endcan

                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card hp-contact-card mb-32">
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-hover table-borderless">
                            <thead>
                                <tr>
                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            <div
                                                class="avatar-item avatar-lg d-flex align-items-center justify-content-center bg-primary-4 hp-bg-dark-primary text-primary hp-text-color-dark-0 rounded-circle">
                                                <img
                                                    src="{{ $item->picture != null ? $item->picture : asset('app-assets/img/default-profile.svg') }}">
                                            </div>
                                        </td>
                                        <td>
                                            {{ $item->title != null ? $item->title : 'Not set' }}
                                        </td>
                                        <td>
                                            @if ($item->status == 1)
                                                <div
                                                    class="badge bg-success-4 hp-bg-dark-success text-success border-success">
                                                    active
                                                </div>
                                            @else
                                                <div class="badge bg-danger-4 hp-bg-dark-danger text-danger border-danger">
                                                    inactive
                                                </div>
                                            @endif
                                        </td>
                                        @can('layanan-update')
                                            <td class="text-end">
                                                <button onclick="detailData({{ $item->id }})"
                                                    class="btn btn-text text-primary btn-sm" title="Detail">
                                                    <i class="iconly-Light-Show"></i>
                                                </button>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $data->links('pagination::bootstrap-4') }}
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
                    <h5 class="modal-title" id="modalDataLabel">Manage Layanan</h5>
                    <button type="button" class="btn-close hp-bg-none d-flex align-items-center justify-content-center"
                        data-bs-dismiss="modal" aria-label="Close">
                        <i class="ri-close-line hp-text-color-dark-0 lh-1" style="font-size: 24px;"></i>
                    </button>
                </div>

                <div class="divider m-0"></div>

                <form id="formData" method="POST" enctype="multipart/form-data"
                    action="{{ route('dashboard.layanan.store') }}">
                    @csrf
                    <div id="method">
                        @method('POST')
                    </div>
                    <div class="modal-body modal-body-scroll">
                        <input type="number" hidden>
                        <input type="text" id="id" hidden>
                        <div class="row gx-8">
                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4">*</span>
                                        Thumbnail
                                    </label>
                                    <input type="file" name="picture" class="form-control" required>
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

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4">*</span>
                                        Title
                                    </label>
                                    <input type="text" class="form-control" name="title" id="title" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="content" class="form-label">
                                        <span class="text-danger me-4">*</span>
                                        Description
                                    </label>
                                    <textarea class="form-control" id="description" name="description" rows="2" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer pt-0 px-24 pb-24">
                        <div class="divider"></div>
                        <div class="d-flex justify-content-between w-100">
                            <div>
                                @can('layanan-delete')
                                    <button type="button" class="btn btn-danger btn-delete"
                                        onclick="deleteData()">Delete</button>
                                @endcan
                            </div>
                            <div>
                                <button type="button" class="btn btn-success btn-edit" onclick="editData()">
                                    <i class="iconly-Curved-Edit"></i>
                                    Edit</button>
                                <button type="button" class="btn btn-text btn-cancel"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary btn-save">Save</button>
                                <button type="button" class="btn btn-primary btn-update"
                                    onclick="updateData()">Update</button>
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
        let csrf_token = $('meta[name="csrf-token"]').attr('content');

        function resetModalState() {
            console.log("closed");
            $("#status").val("Status").change();
            $("#title").val("");
            $("#description").html("");
        };
        $("#modalData").on("hidden.bs.modal", function() {
            resetModalState();
        });

        function saveData() {
            $('.btn-edit').hide();
            $('.btn-delete').hide();
            $('.btn-update').hide();
            $('.btn-save').show();
            $('#modalData').modal('show');
            $(".modal-body :input").prop("disabled", false);
        }

        function fillDetailData(response = null) {
            console.log(response)
            $("#id").val(response.id.toString());
            $("#status").val(response.status).change();
            $("#title").val(response.title);
            $("#description").html(response.description);
        }

        function detailData(id = null) {
            if (id != null) {
                $.ajax({
                    url: "{{ route('dashboard.layanan.show', ':id') }}".replace(":id", id),
                    type: "GET",
                    success: function(res) {
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
            $('.btn-update').show();
            $("[name='picture']").prop("required", false)
        }

        function updateData() {
            const id = $("#id").val();
            if (id != null && id != undefined) {
                console.log("id = " + id);
                $("#formData").attr("method", "POST");
                $("#formData").attr("action", "{{ route('dashboard.layanan.update', ':id') }}".replace(":id", id));
                $("#method").html(`@method('PUT')`);
                $("#formData").submit();
            } else {
                alert("Cannot update data, id not found");
            }
        }

        function deleteData() {
            const id = $("#id").val();
            if (id != null && id != undefined) {
                console.log("id = " + id);
                $("#formData").attr("method", "POST");
                $("#formData").attr("action", "{{ route('dashboard.layanan.destroy', ':id') }}".replace(":id", id));
                $("#method").html(`@method('delete')`);
                $("#formData").submit();

            } else {
                alert("Cannot update data, id not found");
            }
        }

        $("#table-search").on("input", function() {

        });
    </script>
@endsection
