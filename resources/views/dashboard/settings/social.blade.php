@extends('layouts.dashboard')

@section('title', 'Setting About Company | Pola Poli')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/select2.min.css')}}">
@endsection

@section('content')
<div class="row mb-32 gy-32">
    <div class="col-12">
        <div class="row justify-content-between gy-32">
            <div class="col-12 col-md-4 d-flex">
                <h4 class="mx-8 h4">Setting About Company</h4>
            </div>
            <div class="col-12 col-md-7">
                <div class="row g-16 align-items-center justify-content-end">
                    <div class="col hp-flex-none w-auto">
                        @can('web-update')
                        <button type="button" class="btn btn-success btn-edit" onclick="editData();"
                            style="display:none">
                            <span>Edit</span>
                        </button>
                        @endcan
                        <button type="button" class="btn btn-text btn-cancel" onclick="cancelEdit();"
                            style="display:none">
                            <span>Cancel</span>
                        </button>
                        @can('web-add')
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
            <div class="card-body">
                <form action="" id="formData">
                    @csrf
                    <div id="method">
                        @method("POST")
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4"></span>
                                    Instagram Account
                                </label>
                                @if (isset($data['instagram']['account_name']))
                                <input type="text" id="instagram_account" name="instagram_account"  value="{{$data['instagram']['account_name']}}" class="form-control">
                                @else
                                <input type="text" id="instagram_account" name="instagram_account" class="form-control">
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4"></span>
                                    Instagram Link
                                </label>
                                @if (isset($data['instagram']['link']))
                                <input type="text" id="instagram_link" name="instagram_link" value="{{$data['instagram']['link']}}" class="form-control">
                                @else
                                <input type="text" id="instagram_link" name="instagram_link" class="form-control">
                                @endif

                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4"></span>
                                    Facebook Account
                                </label>
                                @if (isset($data['facebook']['account_name']))
                                <input type="text" id="facebook_account" name="facebook_account" value="{{$data['facebook']['account_name']}}" class="form-control">
                                @else
                                <input type="text" id="facebook_account" name="facebook_account" class="form-control">
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4"></span>
                                    Facebook Link
                                </label>
                                @if (isset($data['facebook']['link']))
                                <input type="text" id="facebook_link" name="facebook_link" value="{{$data['facebook']['link']}}" class="form-control">
                                @else
                                <input type="text" id="facebook_link" name="facebook_link" class="form-control">
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4"></span>
                                    Twitter Account
                                </label>
                                @if (isset($data['twitter']['account_name']))
                                <input type="text" id="twitter_account" name="twitter_account" value="{{$data['twitter']['account_name']}}" class="form-control">
                                @else
                                <input type="text" id="twitter_account" name="twitter_account" class="form-control">
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4"></span>
                                    Twitter Link
                                </label>
                                @if (isset($data['twitter']['link']))
                                <input type="text" id="twitter_link" name="twitter_link" value="{{$data['twitter']['link']}}" class="form-control">
                                @else
                                <input type="text" id="twitter_link" name="twitter_link" class="form-control">
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4"></span>
                                    Youtube Account
                                </label>
                                @if (isset($data['youtube']['account_name']))
                                <input type="text" id="youtube_account" name="youtube_account" value="{{$data['youtube']['account_name']}}" class="form-control">
                                @else
                                <input type="text" id="youtube_account" name="youtube_account" class="form-control">
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4"></span>
                                    Youtube Link
                                </label>
                                @if (isset($data['youtube']['link']))
                                <input type="text" id="youtube_link" name="youtube_link" value="{{$data['youtube']['link']}}" class="form-control">
                                @else
                                <input type="text" id="youtube_link" name="youtube_link" class="form-control">
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4"></span>
                                    Tiktok Account
                                </label>
                                @if (isset($data['tiktok']['account_name']))
                                <input type="text" id="tiktok_account" name="tiktok_account" value="{{$data['tiktok']['account_name']}}" class="form-control">
                                @else
                                <input type="text" id="tiktok_account" name="tiktok_account" class="form-control">
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4"></span>
                                    Tiktok Link
                                </label>
                                @if (isset($data['tiktok']['link']))
                                <input type="text" id="tiktok_link" name="tiktok_link" value="{{$data['tiktok']['link']}}" class="form-control">
                                @else
                                <input type="text" id="tiktok_link" name="tiktok_link" class="form-control">
                                @endif
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
<script>
    let csrf_token;
    $(document).ready(function () {

        csrf_token = $('[name="_token"]').val();
        $("#formData :input").prop("disabled", true);
        $('.btn-save').hide();
        $('.btn-edit').show();
    });
    function saveData() {
        $.ajax({
                url: "{{route('settings.social.store')}}",
                type: "POST",
                data: {
                    _token: csrf_token,
                    _method: "POST",
                    instagram_account: $('#instagram_account').val(),
                    instagram_link: $('#instagram_link').val(),
                    facebook_account: $('#facebook_account').val(),
                    facebook_link: $('#facebook_link').val(),
                    twitter_account: $('#twitter_account').val(),
                    twitter_link: $('#twitter_link').val(),
                    youtube_account: $('#youtube_account').val(),
                    youtube_link: $('#youtube_link').val(),
                    tiktok_account: $('#tiktok_account').val(),
                    tiktok_link: $('#tiktok_link').val(),
                },
                dataType: 'JSON',
                success: function(res){
                    fillDetailData(res);
                    disableInput();
                }, error: function (xhr, ajaxOptions, thrownError){
                    alert(thrownError)
                }
        });

    }

    function disableInput(){
        $("#formData :input").prop("disabled", true);
        $('.btn-cancel').hide();
        $('.btn-save').hide();
        $('.btn-edit').show();
    }
    function cancelEdit(){
        resetToSavedData();
        disableInput();
    };

    function editData() {
        $("#formData :input").prop("disabled", false);
        $('.btn-save').show();
        $('.btn-cancel').show();
        $('.btn-edit').hide();
    }

    function fillDetailData(response){
        console.log(response);
        if(response.hasOwnProperty('facebook')){
            if(response.facebook.hasOwnProperty('account_name')){
                $("#facebook_account").val(response.facebook.account_name);
            } else {
                $("#facebook_account").val("");
            }
            if(response.facebook.hasOwnProperty('link')){
                $("#facebook_link").val(response.facebook.link);
            }else {
                $("#facebook_link").val("");
            }
        }else {
            $("#facebook_account").val("");
            $("#facebook_link").val("");
        }
        if(response.hasOwnProperty('instagram')){

            if(response.instagram.hasOwnProperty('account_name')){
                $("#instagram_account").val(response.instagram.account_name);
            }else {
                $("#instagram_account").val("");
            }
            if(response.instagram.hasOwnProperty('link')){
                $("#instagram_link").val(response.instagram.link);
            }else {
                $("#instagram_link").val("");
            }
        } else {
            $("#instagram_account").val("");
            $("#instagram_link").val("");
        }

        if(response.hasOwnProperty('twitter')){

            if(response.twitter.hasOwnProperty('account_name')){
                $("#twitter_account").val(response.twitter.account_name);
            }else {
                $("#twitter_account").val("");
            }
            if(response.twitter.hasOwnProperty('link')){
                $("#twitter_link").val(response.twitter.link);
            }else {
                $("#twitter_link").val("");
            }
        }else {
            $("#twitter_account").val("");
            $("#twitter_link").val("");
        }

        if(response.hasOwnProperty('youtube')){
            if(response.youtube.hasOwnProperty('account_name')){
                $("#youtube_account").val(response.youtube.account_name);
            }else {
                $("#youtube_account").val("");
            }
            if(response.youtube.hasOwnProperty('link')){
                $("#youtube_link").val(response.youtube.link);
            }else {
                $("#youtube_link").val("");
            }
        }else {
            $("#youtube_account").val("");
            $("#youtube_link").val("");
        }

        if(response.hasOwnProperty('tiktok')){
            if(response.tiktok.hasOwnProperty('account_name')){
                $("#tiktok_account").val(response.tiktok.account_name);
            }else {
                $("#tiktok_account").val("");
            }
            if(response.tiktok.hasOwnProperty('link')){
                $("#tiktok_link").val(response.tiktok.link);
            }else {
                $("#tiktok_link").val("");
            }
        }else {
            $("#tiktok_account").val("");
            $("#tiktok_link").val("");
        }
    }

    function resetToSavedData() {
        event.preventDefault();
        $.ajax({
                url: "{{route('settings.social.index')}}",
                type: "GET",
                success: function(res){
                    fillDetailData(res);
                }
        });
    }

</script>
@endsection
