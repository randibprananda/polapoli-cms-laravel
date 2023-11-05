@extends('layouts.dashboard')

@section('title', 'Permission | Pola Poli')

@section('content')
    <div class="row mb-32 gy-32">
        <div class="col-12">
            <div class="row justify-content-between gy-32">
                <div class="col-12 col-md-4 d-flex">
                    <a href="{{ url()->previous() }}" class="auth-back">
                        <i class="iconly-Light-ArrowLeft"></i>
                    </a>
                    <h4 class="mx-8 h4">Permission - {{ $role->name }}</h4>
                </div>
                <div class="col-12 col-md-7">
                    <div class="row g-16 align-items-center justify-content-end">
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="input-group align-items-center">
                                <span class="input-group-text bg-white hp-bg-dark-100 border-end-0 pe-0">
                                    <i class="iconly-Light-Search text-black-80" style="font-size: 16px;"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-8" placeholder="Search">
                            </div>
                        </div>

                        <div class="col hp-flex-none w-auto">
                            @can('role-update')
                                <button type="button" class="btn btn-success btn-edit" onclick="editData();">
                                    <span>Edit</span>
                                </button>
                            @endcan
                            <button type="button" class="btn btn-text btn-cancel" onclick="cancelEdit();"
                                style="display:none">
                                <span>Cancel</span>
                            </button>
                            @can('role-add')
                                <button type="button" class="btn btn-primary btn-save" onclick="saveData();"
                                    style="display:none">
                                    <span>Save</span>
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card hp-contact-card mb-32">
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <input type="hidden" id="role_id" name="role_id" value="{{ $role->id }}">
                        <table class="table align-middle table-hover table-borderless">
                            <thead>
                                <tr>
                                    <th>Permissions</th>
                                    @php
                                        $permission_in_role = [];
                                        foreach ($role->permissions as $permission) {
                                            $permission_in_role[] = $permission->name;
                                        }
                                    @endphp
                                    <th>Read</th>
                                    <th>Create</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                <form id="formData" action="">
                                    @csrf
                                    <div id="method">
                                        @method('POST')
                                    </div>
                                    <tr>
                                        <td>Tim Relawan</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="tim-index"
                                                {{ in_array('tim-index', $permission_in_role) ? 'checked' : '' }}
                                                id="tim-index" name="tim-index">
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Transaksi</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="transaksi-index"
                                                {{ in_array('transaksi-index', $permission_in_role) ? 'checked' : '' }}
                                                id="transaksi-index" name="transaksi-index">
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Withdrawal</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="withdrawal-index"
                                                {{ in_array('withdrawal-index', $permission_in_role) ? 'checked' : '' }}
                                                id="withdrawal-index" name="withdrawal-index">
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="withdrawal-update"
                                                {{ in_array('withdrawal-update', $permission_in_role) ? 'checked' : '' }}
                                                id="withdrawal-update" name="withdrawal-update">
                                        </td>
                                        <td>
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Solusi</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="solusi-index"
                                                {{ in_array('solusi-index', $permission_in_role) ? 'checked' : '' }}
                                                id="solusi-index" name="solusi-index">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="solusi-add"
                                                {{ in_array('solusi-add', $permission_in_role) ? 'checked' : '' }}
                                                id="solusi-add" name="solusi-add">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="solusi-update"
                                                {{ in_array('solusi-update', $permission_in_role) ? 'checked' : '' }}
                                                id="solusi-update" name="solusi-update">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="solusi-delete"
                                                {{ in_array('solusi-delete', $permission_in_role) ? 'checked' : '' }}
                                                id="solusi-delete" name="solusi-delete">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Layanan</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="layanan-index"
                                                {{ in_array('layanan-index', $permission_in_role) ? 'checked' : '' }}
                                                id="layanan-index" name="layanan-index">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="layanan-add"
                                                {{ in_array('layanan-add', $permission_in_role) ? 'checked' : '' }}
                                                id="layanan-add" name="layanan-add">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="layanan-update"
                                                {{ in_array('layanan-update', $permission_in_role) ? 'checked' : '' }}
                                                id="layanan-update" name="layanan-update">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="layanan-delete"
                                                {{ in_array('layanan-delete', $permission_in_role) ? 'checked' : '' }}
                                                id="layanan-delete" name="layanan-delete">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Client</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="client-index"
                                                {{ in_array('client-index', $permission_in_role) ? 'checked' : '' }}
                                                id="client-index" name="client-index">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="client-add"
                                                {{ in_array('client-add', $permission_in_role) ? 'checked' : '' }}
                                                id="client-add" name="client-add">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="client-update"
                                                {{ in_array('client-update', $permission_in_role) ? 'checked' : '' }}
                                                id="client-update" name="client-update">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="client-delete"
                                                {{ in_array('client-delete', $permission_in_role) ? 'checked' : '' }}
                                                id="client-delete" name="client-delete">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Testimonial</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="testimonial-index"
                                                {{ in_array('testimonial-index', $permission_in_role) ? 'checked' : '' }}
                                                id="testimonial-index" name="testimonial-index">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="testimonial-add"
                                                {{ in_array('testimonial-add', $permission_in_role) ? 'checked' : '' }}
                                                id="testimonial-add" name="testimonial-add">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="testimonial-update"
                                                {{ in_array('testimonial-update', $permission_in_role) ? 'checked' : '' }}
                                                id="testimonial-update" name="testimonial-update">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="testimonial-delete"
                                                {{ in_array('testimonial-delete', $permission_in_role) ? 'checked' : '' }}
                                                id="testimonial-delete" name="testimonial-delete">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Pricing</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="pricing-index"
                                                {{ in_array('pricing-index', $permission_in_role) ? 'checked' : '' }}
                                                id="pricing-index" name="pricing-index">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="pricing-add"
                                                {{ in_array('pricing-add', $permission_in_role) ? 'checked' : '' }}
                                                id="pricing-add" name="pricing-add">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="pricing-update"
                                                {{ in_array('pricing-update', $permission_in_role) ? 'checked' : '' }}
                                                id="pricing-update" name="pricing-update">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="pricing-delete"
                                                {{ in_array('pricing-delete', $permission_in_role) ? 'checked' : '' }}
                                                id="pricing-delete" name="pricing-delete">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>FAQ</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="faq-index"
                                                {{ in_array('faq-index', $permission_in_role) ? 'checked' : '' }}
                                                id="faq-index" name="faq-index">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="faq-add"
                                                {{ in_array('faq-add', $permission_in_role) ? 'checked' : '' }}
                                                id="faq-add" name="faq-add">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="faq-update"
                                                {{ in_array('faq-update', $permission_in_role) ? 'checked' : '' }}
                                                id="faq-update" name="faq-update">
                                        </td>
                                        <td>
                                            <input class="form-check-input faq-delete" type="checkbox" value="faq-delete"
                                                {{ in_array('faq-delete', $permission_in_role) ? 'checked' : '' }}
                                                id="faq-delete" name="faq-delete">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>News</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="news-index"
                                                {{ in_array('news-index', $permission_in_role) ? 'checked' : '' }}
                                                id="news-index" name="news-index">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="news-add"
                                                {{ in_array('news-add', $permission_in_role) ? 'checked' : '' }}
                                                id="news-add" name="news-add">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="news-update"
                                                {{ in_array('news-update', $permission_in_role) ? 'checked' : '' }}
                                                id="news-update" name="news-update">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="news-delete"
                                                {{ in_array('news-delete', $permission_in_role) ? 'checked' : '' }}
                                                id="news-delete" name="news-delete">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Web Settings</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="web-index"
                                                {{ in_array('web-index', $permission_in_role) ? 'checked' : '' }}
                                                id="web-index" name="web-index">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="web-add"
                                                {{ in_array('web-add', $permission_in_role) ? 'checked' : '' }}
                                                id="web-add" name="web-add">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="web-update"
                                                {{ in_array('web-update', $permission_in_role) ? 'checked' : '' }}
                                                id="web-update" name="web-update">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="web-delete"
                                                {{ in_array('web-delete', $permission_in_role) ? 'checked' : '' }}
                                                id="web-delete" name="web-delete">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>User</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="user-index"
                                                {{ in_array('user-index', $permission_in_role) ? 'checked' : '' }}
                                                id="user-index" name="user-index">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="user-add"
                                                {{ in_array('user-add', $permission_in_role) ? 'checked' : '' }}
                                                id="user-add" name="user-add">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="user-update"
                                                {{ in_array('user-update', $permission_in_role) ? 'checked' : '' }}
                                                id="user-update" name="user-update">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="user-delete"
                                                {{ in_array('user-delete', $permission_in_role) ? 'checked' : '' }}
                                                id="user-delete" name="user-delete">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Role</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="role-index"
                                                {{ in_array('role-index', $permission_in_role) ? 'checked' : '' }}
                                                id="role-index" name="role-index">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="role-add"
                                                {{ in_array('role-add', $permission_in_role) ? 'checked' : '' }}
                                                id="role-add" name="role-add">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="role-update"
                                                {{ in_array('role-update', $permission_in_role) ? 'checked' : '' }}
                                                id="role-update" name="role-update">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="role-delete"
                                                {{ in_array('role-delete', $permission_in_role) ? 'checked' : '' }}
                                                id="role-delete" name="role-delete">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>USP</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="usp-index"
                                                {{ in_array('usp-index', $permission_in_role) ? 'checked' : '' }}
                                                id="usp-index" name="usp-index">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="usp-add"
                                                {{ in_array('usp-add', $permission_in_role) ? 'checked' : '' }}
                                                id="usp-add" name="usp-add">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="usp-update"
                                                {{ in_array('usp-update', $permission_in_role) ? 'checked' : '' }}
                                                id="usp-update" name="usp-update">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="usp-delete"
                                                {{ in_array('usp-delete', $permission_in_role) ? 'checked' : '' }}
                                                id="usp-delete" name="usp-delete">
                                        </td>
                                    </tr>
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('modal')
<div class="modal fade" id="modalData" tabindex="-1" aria-labelledby="modalDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-16 px-24">
                <h5 class="modal-title" id="modalDataLabel">Add Contact</h5>
                <button type="button" class="btn-close hp-bg-none d-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri-close-line hp-text-color-dark-0 lh-1" style="font-size: 24px;"></i>
                </button>
            </div>

            <div class="divider m-0"></div>

            <form id="myForm">
                <div class="modal-body">
                    <input type="number" hidden>
                    <div class="row gx-8">
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Name
                                </label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer pt-0 px-24 pb-24">
                    <div class="divider"></div>
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            <button type="button" class="btn btn-danger btn-delete">Delete</button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-text btn-cancel"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success btn-edit" onclick="editData()">Edit</button>
                            <button type="submit" class="btn btn-primary btn-save">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection --}}

@section('js')
    <script>
        let csrf_token;
        $(document).ready(function() {
            csrf_token = $('[name="_token"]').val();
            disableInput()
        });

        function disableInput() {
            $("#tim-index").attr("onclick", "return false");
            $("#transaksi-index").attr("onclick", "return false");
            $("#withdrawal-index").attr("onclick", "return false");
            $("#withdrawal-update").attr("onclick", "return false");
            $("#solusi-index").attr("onclick", "return false");
            $("#solusi-add").attr("onclick", "return false");
            $("#solusi-update").attr("onclick", "return false");
            $("#solusi-delete").attr("onclick", "return false");
            $("#usp-index").attr("onclick", "return false");
            $("#usp-add").attr("onclick", "return false");
            $("#usp-update").attr("onclick", "return false");
            $("#usp-delete").attr("onclick", "return false");
            $("#layanan-index").attr("onclick", "return false");
            $("#layanan-add").attr("onclick", "return false");
            $("#layanan-update").attr("onclick", "return false");
            $("#layanan-delete").attr("onclick", "return false");
            $("#client-index").attr("onclick", "return false");
            $("#client-add").attr("onclick", "return false");
            $("#client-update").attr("onclick", "return false");
            $("#client-delete").attr("onclick", "return false");
            $("#pricing-index").attr("onclick", "return false");
            $("#pricing-add").attr("onclick", "return false");
            $("#pricing-update").attr("onclick", "return false");
            $("#pricing-delete").attr("onclick", "return false");
            $("#faq-index").attr("onclick", "return false");
            $("#faq-add").attr("onclick", "return false");
            $("#faq-update").attr("onclick", "return false");
            $("#faq-delete").attr("onclick", "return false");
            $("#testimonial-index").attr("onclick", "return false");
            $("#testimonial-add").attr("onclick", "return false");
            $("#testimonial-update").attr("onclick", "return false");
            $("#testimonial-delete").attr("onclick", "return false");
            $("#news-index").attr("onclick", "return false");
            $("#news-add").attr("onclick", "return false");
            $("#news-update").attr("onclick", "return false");
            $("#news-delete").attr("onclick", "return false");
            $("#bisnis-op-index").attr("onclick", "return false");
            $("#bisnis-op-add").attr("onclick", "return false");
            $("#bisnis-op-update").attr("onclick", "return false");
            $("#bisnis-op-delete").attr("onclick", "return false");
            $("#web-index").attr("onclick", "return false");
            $("#web-add").attr("onclick", "return false");
            $("#web-update").attr("onclick", "return false");
            $("#web-delete").attr("onclick", "return false");
            $("#user-index").attr("onclick", "return false");
            $("#user-add").attr("onclick", "return false");
            $("#user-update").attr("onclick", "return false");
            $("#user-delete").attr("onclick", "return false");
            $("#role-index").attr("onclick", "return false");
            $("#role-add").attr("onclick", "return false");
            $("#role-update").attr("onclick", "return false");
            $("#role-delete").attr("onclick", "return false");
            $('.btn-cancel').hide();
            $('.btn-save').hide();
            $('.btn-edit').show();
        }

        function cancelEdit() {
            resetToSavedData();
            disableInput();
        };

        function getCheckedValue() {
            let checked = [];
            if ($("#tim-index").is(":checked")) {
                checked.push("tim-index");
            }
            if ($("#transaksi-index").is(":checked")) {
                checked.push("transaksi-index");
            }
            if ($("#withdrawal-index").is(":checked")) {
                checked.push("withdrawal-index");
            }
            if ($("#withdrawal-update").is(":checked")) {
                checked.push("withdrawal-update");
            }
            if ($("#usp-index").is(":checked")) {
                checked.push("usp-index");
            }
            if ($("#usp-add").is(":checked")) {
                checked.push("usp-add");
            }
            if ($("#usp-update").is(":checked")) {
                checked.push("usp-update");
            }
            if ($("#usp-delete").is(":checked")) {
                checked.push("usp-delete");
            }
            if ($("#solusi-index").is(":checked")) {
                checked.push("solusi-index");
            }
            if ($("#solusi-add").is(":checked")) {
                checked.push("solusi-add");
            }
            if ($("#solusi-update").is(":checked")) {
                checked.push("solusi-update");
            }
            if ($("#solusi-delete").is(":checked")) {
                checked.push("solusi-delete");
            }
            if ($("#layanan-index").is(":checked")) {
                checked.push("layanan-index");
            }
            if ($("#layanan-add").is(":checked")) {
                checked.push("layanan-add");
            }
            if ($("#layanan-update").is(":checked")) {
                checked.push("layanan-update");
            }
            if ($("#layanan-delete").is(":checked")) {
                checked.push("layanan-delete");
            }
            if ($("#client-index").is(":checked")) {
                checked.push("client-index");
            }
            if ($("#client-add").is(":checked")) {
                checked.push("client-add");
            }
            if ($("#client-update").is(":checked")) {
                checked.push("client-update");
            }
            if ($("#client-delete").is(":checked")) {
                checked.push("client-delete");
            }
            if ($("#pricing-index").is(":checked")) {
                checked.push("pricing-index");
            }
            if ($("#pricing-add").is(":checked")) {
                checked.push("pricing-add");
            }
            if ($("#pricing-update").is(":checked")) {
                checked.push("pricing-update");
            }
            if ($("#pricing-delete").is(":checked")) {
                checked.push("pricing-delete");
            }
            if ($("#faq-index").is(":checked")) {
                checked.push("faq-index");
            }
            if ($("#faq-add").is(":checked")) {
                checked.push("faq-add");
            }
            if ($("#faq-update").is(":checked")) {
                checked.push("faq-update");
            }
            if ($("#faq-delete").is(":checked")) {
                checked.push("faq-delete");
            }
            if ($("#testimonial-index").is(":checked")) {
                checked.push("testimonial-index");
            }
            if ($("#testimonial-add").is(":checked")) {
                checked.push("testimonial-add");
            }
            if ($("#testimonial-update").is(":checked")) {
                checked.push("testimonial-update");
            }
            if ($("#testimonial-delete").is(":checked")) {
                checked.push("testimonial-delete");
            }
            if ($("#news-index").is(":checked")) {
                checked.push("news-index");
            }
            if ($("#news-add").is(":checked")) {
                checked.push("news-add");
            }
            if ($("#news-update").is(":checked")) {
                checked.push("news-update");
            }
            if ($("#news-delete").is(":checked")) {
                checked.push("news-delete");
            }
            if ($("#bisnis-op-index").is(":checked")) {
                checked.push("bisnis-op-index");
            }
            if ($("#bisnis-op-add").is(":checked")) {
                checked.push("bisnis-op-add");
            }
            if ($("#bisnis-op-update").is(":checked")) {
                checked.push("bisnis-op-update");
            }
            if ($("#bisnis-op-delete").is(":checked")) {
                checked.push("bisnis-op-delete");
            }
            if ($("#web-index").is(":checked")) {
                checked.push("web-index");
            }
            if ($("#web-add").is(":checked")) {
                checked.push("web-add");
            }
            if ($("#web-update").is(":checked")) {
                checked.push("web-update");
            }
            if ($("#web-delete").is(":checked")) {
                checked.push("web-delete");
            }
            if ($("#user-index").is(":checked")) {
                checked.push("user-index");
            }
            if ($("#user-add").is(":checked")) {
                checked.push("user-add");
            }
            if ($("#user-update").is(":checked")) {
                checked.push("user-update");
            }
            if ($("#user-delete").is(":checked")) {
                checked.push("user-delete");
            }
            if ($("#role-index").is(":checked")) {
                checked.push("role-index");
            }
            if ($("#role-add").is(":checked")) {
                checked.push("role-add");
            }
            if ($("#role-update").is(":checked")) {
                checked.push("role-update");
            }
            if ($("#role-delete").is(":checked")) {
                checked.push("role-delete");
            }
            return checked;
        }

        function saveData() {

            let checked = getCheckedValue();
            console.log(checked);

            $.ajax({
                url: "{{ route('settings.permission.store') }}",
                type: "POST",
                data: {
                    _token: csrf_token,
                    _method: "POST",
                    permission: checked,
                    role_id: $("#role_id").val()
                },
                dataType: 'JSON',
                success: function(res) {
                    resetToSavedData();
                    disableInput();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError)
                    console.log(xhr);
                }
            });

        }

        function fillDetailData(response) {
            console.log("response: " + JSON.stringify(response));
            if (response.includes("tim-index")) {
                $("#tim-index").prop("checked", true);
            } else {
                $("#tim-index").prop("checked", false);
            }
            if (response.includes("transaksi-index")) {
                $("#transaksi-index").prop("checked", true);
            } else {
                $("#transaksi-index").prop("checked", false);
            }
            if (response.includes("withdrawal-index")) {
                $("#withdrawal-index").prop("checked", true);
            } else {
                $("#withdrawal-index").prop("checked", false);
            }
            if (response.includes("withdrawal-update")) {
                $("#withdrawal-update").prop("checked", true);
            } else {
                $("#withdrawal-update").prop("checked", false);
            }
            if (response.includes("solusi-index")) {
                $("#solusi-index").prop("checked", true);
            } else {
                $("#solusi-index").prop("checked", false);
            }
            if (response.includes("solusi-add")) {
                $("#solusi-add").prop("checked", true);
            } else {
                $("#solusi-add").prop("checked", false);
            }
            if (response.includes("solusi-update")) {
                $("#solusi-update").prop("checked", true);
            } else {
                $("#solusi-update").prop("checked", false);
            }
            if (response.includes("solusi-delete")) {
                $("#solusi-delete").prop("checked", true);
            } else {
                $("#solusi-delete").prop("checked", false);
            }
            if (response.includes("usp-index")) {
                $("#usp-index").prop("checked", true);
            } else {
                $("#usp-index").prop("checked", false);
            }
            if (response.includes("usp-add")) {
                $("#usp-add").prop("checked", true);
            } else {
                $("#usp-add").prop("checked", false);
            }
            if (response.includes("usp-update")) {
                $("#usp-update").prop("checked", true);
            } else {
                $("#usp-update").prop("checked", false);
            }
            if (response.includes("usp-delete")) {
                $("#usp-delete").prop("checked", true);
            } else {
                $("#usp-delete").prop("checked", false);
            }
            if (response.includes("layanan-index")) {
                $("#layanan-index").prop("checked", true);
            } else {
                $("#layanan-index").prop("checked", false);
            }
            if (response.includes("layanan-add")) {
                $("#layanan-add").prop("checked", true);
            } else {
                $("#layanan-add").prop("checked", false);
            }
            if (response.includes("layanan-update")) {
                $("#layanan-update").prop("checked", true);
            } else {
                $("#layanan-update").prop("checked", false);
            }
            if (response.includes("layanan-delete")) {
                $("#layanan-delete").prop("checked", true);
            } else {
                $("#layanan-delete").prop("checked", false);
            }
            if (response.includes("client-index")) {
                $("#client-index").prop("checked", true);
            } else {
                $("#client-index").prop("checked", false);
            }
            if (response.includes("client-add")) {
                $("#client-add").prop("checked", true);
            } else {
                $("#client-add").prop("checked", false);
            }
            if (response.includes("client-update")) {
                $("#client-update").prop("checked", true);
            } else {
                $("#client-update").prop("checked", false);
            }
            if (response.includes("client-delete")) {
                $("#client-delete").prop("checked", true);
            } else {
                $("#client-delete").prop("checked", false);
            }
            if (response.includes("pricing-index")) {
                $("#pricing-index").prop("checked", true);
            } else {
                $("#pricing-index").prop("checked", false);
            }
            if (response.includes("pricing-add")) {
                $("#pricing-add").prop("checked", true);
            } else {
                $("#pricing-add").prop("checked", false);
            }
            if (response.includes("info-edit")) {
                $("#info-edit").prop("checked", true);
            } else {
                $("#info-edit").prop("checked", false);
            }
            if (response.includes("pricing-delete")) {
                $("#pricing-delete").prop("checked", true);
            } else {
                $("#pricing-delete").prop("checked", false);
            }
            if (response.includes("faq-index")) {
                $("#faq-index").prop("checked", true);
            } else {
                $("#faq-index").prop("checked", false);
            }
            if (response.includes("faq-add")) {
                $("#faq-add").prop("checked", true);
            } else {
                $("#faq-add").prop("checked", false);
            }
            if (response.includes("work-edit")) {
                $("#work-edit").prop("checked", true);
            } else {
                $("#work-edit").prop("checked", false);
            }
            if (response.includes("faq-delete")) {
                $("#faq-delete").prop("checked", true);
            } else {
                $("#faq-delete").prop("checked", false);
            }
            if (response.includes("testimonial-index")) {
                $("#testimonial-index").prop("checked", true);
            } else {
                $("#testimonial-index").prop("checked", false);
            }
            if (response.includes("testimonial-add")) {
                $("#testimonial-add").prop("checked", true);
            } else {
                $("#testimonial-add").prop("checked", false);
            }
            if (response.includes("activity-edit")) {
                $("#activity-edit").prop("checked", true);
            } else {
                $("#activity-edit").prop("checked", false);
            }
            if (response.includes("testimonial-delete")) {
                $("#testimonial-delete").prop("checked", true);
            } else {
                $("#testimonial-delete").prop("checked", false);
            }
            if (response.includes("news-index")) {
                $("#news-index").prop("checked", true);
            } else {
                $("#news-index").prop("checked", false);
            }
            if (response.includes("news-add")) {
                $("#news-add").prop("checked", true);
            } else {
                $("#news-add").prop("checked", false);
            }
            if (response.includes("news-edit")) {
                $("#news-edit").prop("checked", true);
            } else {
                $("#news-edit").prop("checked", false);
            }
            if (response.includes("news-delete")) {
                $("#news-delete").prop("checked", true);
            } else {
                $("#news-delete").prop("checked", false);
            }
            if (response.includes("bisnis-op-index")) {
                $("#bisnis-op-index").prop("checked", true);
            } else {
                $("#bisnis-op-index").prop("checked", false);
            }
            if (response.includes("bisnis-op-add")) {
                $("#bisnis-op-add").prop("checked", true);
            } else {
                $("#bisnis-op-add").prop("checked", false);
            }
            if (response.includes("bisnis-op-edit")) {
                $("#bisnis-op-edit").prop("checked", true);
            } else {
                $("#bisnis-op-edit").prop("checked", false);
            }
            if (response.includes("bisnis-op-delete")) {
                $("#bisnis-op-delete").prop("checked", true);
            } else {
                $("#bisnis-op-delete").prop("checked", false);
            }
            if (response.includes("web-index")) {
                $("#web-index").prop("checked", true);
            } else {
                $("#web-index").prop("checked", false);
            }
            if (response.includes("web-add")) {
                $("#web-add").prop("checked", true);
            } else {
                $("#web-add").prop("checked", false);
            }
            if (response.includes("web-edit")) {
                $("#web-edit").prop("checked", true);
            } else {
                $("#web-edit").prop("checked", false);
            }
            if (response.includes("web-delete")) {
                $("#web-delete").prop("checked", true);
            } else {
                $("#web-delete").prop("checked", false);
            }
            if (response.includes("user-index")) {
                $("#user-index").prop("checked", true);
            } else {
                $("#user-index").prop("checked", false);
            }
            if (response.includes("user-add")) {
                $("#user-add").prop("checked", true);
            } else {
                $("#user-add").prop("checked", false);
            }
            if (response.includes("user-edit")) {
                $("#user-edit").prop("checked", true);
            } else {
                $("#user-edit").prop("checked", false);
            }
            if (response.includes("user-delete")) {
                $("#user-delete").prop("checked", true);
            } else {
                $("#user-delete").prop("checked", false);
            }
            if (response.includes("role-index")) {
                $("#role-index").prop("checked", true);
            } else {
                $("#role-index").prop("checked", false);
            }
            if (response.includes("role-add")) {
                $("#role-add").prop("checked", true);
            } else {
                $("#role-add").prop("checked", false);
            }
            if (response.includes("role-edit")) {
                $("#role-edit").prop("checked", true);
            } else {
                $("#role-edit").prop("checked", false);
            }
            if (response.includes("role-delete")) {
                $("#role-delete").prop("checked", true);
            } else {
                $("#role-delete").prop("checked", false);
            }
        }

        function editData() {
            $("#tim-index").attr("onclick", "");
            $("#transaksi-index").attr("onclick", "");
            $("#withdrawal-index").attr("onclick", "");
            $("#withdrawal-update").attr("onclick", "");
            $("#solusi-index").attr("onclick", "");
            $("#solusi-add").attr("onclick", "");
            $("#solusi-update").attr("onclick", "");
            $("#solusi-delete").attr("onclick", "");
            $("#usp-index").attr("onclick", "");
            $("#usp-add").attr("onclick", "");
            $("#usp-update").attr("onclick", "");
            $("#usp-delete").attr("onclick", "");
            $("#layanan-index").attr("onclick", "");
            $("#layanan-add").attr("onclick", "");
            $("#layanan-update").attr("onclick", "");
            $("#layanan-delete").attr("onclick", "");
            $("#client-index").attr("onclick", "");
            $("#client-add").attr("onclick", "");
            $("#client-update").attr("onclick", "");
            $("#client-delete").attr("onclick", "");
            $("#pricing-index").attr("onclick", "");
            $("#pricing-add").attr("onclick", "");
            $("#pricing-update").attr("onclick", "");
            $("#pricing-delete").attr("onclick", "");
            $("#faq-index").attr("onclick", "");
            $("#faq-add").attr("onclick", "");
            $("#faq-update").attr("onclick", "");
            $("#faq-delete").attr("onclick", "");
            $("#testimonial-index").attr("onclick", "");
            $("#testimonial-add").attr("onclick", "");
            $("#testimonial-update").attr("onclick", "");
            $("#testimonial-delete").attr("onclick", "");
            $("#news-index").attr("onclick", "");
            $("#news-add").attr("onclick", "");
            $("#news-update").attr("onclick", "");
            $("#news-delete").attr("onclick", "");
            $("#bisnis-op-index").attr("onclick", "");
            $("#bisnis-op-add").attr("onclick", "");
            $("#bisnis-op-update").attr("onclick", "");
            $("#bisnis-op-delete").attr("onclick", "");
            $("#web-index").attr("onclick", "");
            $("#web-add").attr("onclick", "");
            $("#web-update").attr("onclick", "");
            $("#web-delete").attr("onclick", "");
            $("#user-index").attr("onclick", "");
            $("#user-add").attr("onclick", "");
            $("#user-update").attr("onclick", "");
            $("#user-delete").attr("onclick", "");
            $("#role-index").attr("onclick", "");
            $("#role-add").attr("onclick", "");
            $("#role-update").attr("onclick", "");
            $("#role-delete").attr("onclick", "");
            $('.btn-save').show();
            $('.btn-cancel').show();
            $('.btn-edit').hide();
        }

        function resetToSavedData() {
            event.preventDefault();
            $.ajax({
                url: "{{ route('settings.permission.index') }}",
                type: "GET",
                data: {
                    role: $("#role_id").val()
                },
                success: function(res) {
                    fillDetailData(res);
                }
            });
        }
    </script>
@endsection
