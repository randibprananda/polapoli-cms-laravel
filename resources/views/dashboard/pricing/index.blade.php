@extends('layouts.dashboard')

@section('title', 'Pricing | Pola Poli')

@section('content')
    <div class="row mb-32 gy-32">
        <div class="col-12">
            <div class="row justify-content-between gy-32">
                <div class="col-12 col-md-4">
                    <h4 class="h4">Paket</h4>
                </div>
                <div class="col-12 col-md-7">
                    <div class="row g-16 align-items-center justify-content-end">
                        <div class="col-12 col-md-6 col-xl-4">
                            <form action="{{ route('dashboard.pricing.index') }}" method="get">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text bg-white hp-bg-dark-100 border-end-0 pe-0">
                                        <i class="iconly-Light-Search text-black-80" style="font-size: 16px;"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 ps-8" id="search"
                                        name="search" value="{{ request('search') ?? '' }}" placeholder="Search">
                                </div>
                            </form>
                        </div>

                        @can('pricing-add')
                            <div class="col hp-flex-none w-auto">
                                <button type="button" class="btn btn-primary w-100" onclick="saveData();">
                                    <i class="ri-add-line remix-icon"></i>
                                    <span>Add Paket</span>
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
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            {{ $item->title != null ? $item->title : 'Not set' }}
                                        </td>
                                        <td>
                                            {{ $item->title != null ? $item->price : 'Not set' }}
                                        </td>
                                        <td>
                                            {{ $item->quantity != null ? $item->quantity : 'Not set' }}
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
                                        @can('pricing-update')
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
                    <h5 class="modal-title" id="modalDataLabel">Manage Paket</h5>
                    <button type="button" class="btn-close hp-bg-none d-flex align-items-center justify-content-center"
                        data-bs-dismiss="modal" aria-label="Close">
                        <i class="ri-close-line hp-text-color-dark-0 lh-1" style="font-size: 24px;"></i>
                    </button>
                </div>

                <div class="divider m-0"></div>

                <form id="formData" method="POST" action="{{ route('dashboard.pricing.store') }}">
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
                                        Title
                                    </label>
                                    <input type="text" class="form-control" name="title" id="title" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="division" class="form-label">
                                        <span class="text-danger me-4">*</span>
                                        Division
                                    </label>
                                    <select class="form-select" name="division_id" id="division" required>
                                        <option selected hidden>Division</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="package_type" class="form-label">
                                        <span class="text-danger me-4">*</span>
                                        Package Type
                                    </label>
                                    <select class="form-select" id="package_type" name="package_type" required>
                                        <option selected hidden>Package Type</option>
                                        <option value="1">Standard</option>
                                        <option value="2">Pro</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4">*</span>
                                        Pricing
                                    </label>
                                    <input type="number" class="form-control" name="price" id="price" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4">*</span>
                                        Duration <small>(bulan)</small>
                                    </label>
                                    <input type="number" class="form-control" name="duration" min="0" id="duration"
                                        required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <label for="content" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Feature
                                </label>
                                <button type="button" class="button btn-primary rounded mb-3" id="add_feature">Tambah Feature</button>
                            </div>
                            <div class="col-12 col-md-12" id="feature-container">
                                <div class="repeater-feature" style="margin-top:15px">
                                    <input type="text" name="feature[]" class="form-control feature-input">
                                    <select class="form-select" style="margin-top:10px; margin-bottom:10px;" id="status_feature" name="status_feature[]" required>
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
                                        Jumlah User
                                    </label>
                                    <input type="number" class="form-control" name="quantity" id="quantity" required>
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
                                    <label for="add_on" class="form-label">
                                        <span class="text-danger me-4">*</span>
                                        Add On
                                    </label>
                                    <div id="add-on">
                                        {{-- add on checkbox --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer pt-0 px-24 pb-24">
                        <div class="divider"></div>
                        <div class="d-flex justify-content-between w-100">
                            <div>
                                @can('pricing-delete')
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
            $("#package_type").val("Package Type").change();
            $("#title").val("");
            $("#price").val("");
            $("#duration").val("");
            $("#feature").val("");
            $("#quantity").val("");
            $("#division").val("Division").change();
            $("input[name='add_on']").prop("checked", false);
            $("#feature-container").empty();
        };
        $("#modalData").on("hidden.bs.modal", function() {
            resetModalState();
        });

        function saveData() {
            fillAddOn();
            fillDivisionOptions();
            $('.btn-edit').hide();
            $('.btn-delete').hide();
            $('.btn-update').hide();
            $('.btn-save').show();
            $('#modalData').modal('show');
            $(".modal-body :input").prop("disabled", false);
        }

        function fillDivisionOptions() {
            return new Promise(function(resolve, reject) {
                $.ajax({
                    url: "{{ route('dashboard.pricing.getDivision') }}",
                    method: "GET",
                    success: function(res) {
                        console.log(res);
                        let options = res.reduce(function(acc, element) {
                            return acc + `<option value='${element.id}'>${element.name}</option>`;
                        }, "<option selected hidden>Division</option>");
                        $("#division").html(options);
                        resolve();
                    },
                    error: function(err) {
                        reject(err);
                    }
                });
            });
        }

        function fillAddOn() {
            return new Promise(function(resolve, reject) {
                $.ajax({
                    url: "{{ route('dashboard.pricing.getAddOn') }}",
                    method: "GET",
                    success: function(res) {
                        console.log(res);
                        let options = res.reduce(function(acc, element) {
                            return acc + `<div class="row my-10">
                                            <div class="col-12 col-md-8">
                                                <div class="form-check">
                                                    <input class="form-check-input" id="add_on_${element.id}" name="add_on[]" value="${element.id}" type="checkbox">
                                                    <label class="form-check-label ms-5" for="add_on_${element.id}">${element.title}</label>
                                                </div>
                                            </div>
                                        </div>`;
                        }, "");
                        $("#add-on").html(options);
                        resolve();
                    },
                    error: function(err) {
                        reject(err);
                    }
                });
            });
        }

        function fillDetailData(response = null) {
            const pricingData = response.data;
            const divisionData = response.division;
            const selectAddOn = response.select_add_on;
            const featureData = response.features;
            console.log(featureData, 'feature');
            $("#id").val(pricingData.id.toString());
            $("#status").val(pricingData.status).change();
            $("#package_type").val(pricingData.package_type).change();
            $("#title").val(pricingData.title);
            $("#price").val(pricingData.price);
            $("#duration").val(pricingData.duration);
            // $("#feature").val(pricingData.feature);
            $("#quantity").val(pricingData.quantity);

            fillDivisionOptions().then(function() {
                $("#division").val(divisionData.id).change();
                console.log(divisionData.id);
            });

            fillAddOn().then(function() {
                selectAddOn.forEach(function(addOn) {
                    $(`#add_on_${addOn.add_on_id}`).prop("checked", true);
                });
            }).catch(function(error) {
                console.error("Error in filling add-ons:", error);
            });

            let featureHtml = '';
            featureData.forEach(function(feature) {
                featureHtml += `
                    <div class="repeater-feature style="margin-top:15px">
                        <input type="text" name="feature[]" class="form-control feature-input" value="${feature.title}">
                        <input type="hidden" name="feature_id[]" class="hidden" value="${feature.id}">
                        <select class="form-select" style="margin-top:10px; margin-bottom:10px;" id="status_feature" name="status_feature[]" required>
                            <option selected hidden>Status</option>
                            <option value="1" ${feature.status === 1 ? 'selected' : ''}>Active</option>
                            <option value="2" ${feature.status === 2 ? 'selected' : ''}>Inactive</option>
                        </select>
                        <button type="button" class="remove-feature btn btn-danger rounded" style="margin-top:10px; margin-bottom:10px">Hapus</button>
                    </div>
                `;
            });

            // Append the featureHtml to the #feature-container div instead of #feature-repeater
            $("#feature-container").html(featureHtml);
        }

        function detailData(id = null) {
            if (id != null) {
                $.ajax({
                    url: "{{ route('dashboard.pricing.show', ':id') }}".replace(":id", id),
                    type: "GET",
                    success: function(res) {
                        console.log(res)
                        fillDetailData(res);
                    },
                    error: function(xhr, err, throwable) {
                        console.log(throwable)
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
                $("#formData").attr("action", "{{ route('dashboard.pricing.update', ':id') }}".replace(":id", id));
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
                $("#formData").attr("action", "{{ route('dashboard.pricing.destroy', ':id') }}".replace(":id", id));
                $("#method").html(`@method('delete')`);
                $("#formData").submit();

            } else {
                alert("Cannot update data, id not found");
            }
        }

        $("#table-search").on("input", function() {

        });

        $(document).ready(function() {
            $("#add_feature").click(function() {
                const repeaterItem = `
                    <div class="repeater-feature style="margin-top:15px">
                        <input type="text" name="feature[]" class="form-control feature-input">
                        <select class="form-select" style="margin-top:10px; margin-bottom:10px;" id="status_feature" name="status_feature[]" required>
                            <option selected hidden>Status</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                        <button type="button" class="remove-feature btn btn-danger rounded" style="margin-top:10px; margin-bottom:10px">Hapus</button>
                    </div>
                `;
                $("#feature-container").append(repeaterItem);
            });
                $(document).on('click', '.remove-feature', function() {
                    $(this).parent().remove();
            });
        });

    </script>
@endsection
