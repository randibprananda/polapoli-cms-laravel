@extends('layouts.dashboard')

@section('title', 'Setting Web | Pola Poli')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="row mb-32 gy-32">
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
            <div class="row justify-content-between gy-32">
                <div class="col-12 col-md-4 d-flex">
                    <h4 class="mx-8 h4">Setting Web</h4>
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
                    <form action="{{ route('settings.web.index') }}" method="POST" enctype="multipart/form-data"
                        id="formData">
                        @csrf
                        <div id="method">
                            @method('POST')
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        SEO Keyword
                                    </label>
                                    @if (isset($data['seo_keyword']))
                                        <input type="text" class="form-control" id="seo_keyword" name="seo_keyword"
                                            value="{{ $data['seo_keyword'] }}">
                                    @else
                                        <input type="text" class="form-control" id="seo_keyword" name="seo_keyword">
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        Hero Title
                                    </label>
                                    @if (isset($data['hero_title']))
                                        <input type="text" class="form-control" id="hero_title" name="hero_title"
                                            value="{{ $data['hero_title'] }}">
                                    @else
                                        <input type="text" class="form-control" id="hero_title" name="hero_title">
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="content" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        Hero Subtitle
                                    </label>
                                    @if (isset($data['hero_subtitle']))
                                        <textarea class="form-control" id="hero_subtitle" name="hero_subtitle" rows="3">{{ $data['hero_subtitle'] }}</textarea>
                                    @else
                                        <textarea class="form-control" id="hero_subtitle" name="hero_subtitle" rows="3"></textarea>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <div class="d-flex justify-content-between">
                                        <label for="name" class="form-label">
                                            <span class="text-danger me-4"></span>
                                            Hero Picture
                                        </label>
                                        @if (isset($data['hero_picture']))
                                            <a target="_blank" href="{{ $data['hero_picture'] }}">
                                                Preview
                                            </a>
                                        @else
                                            <span class="text-danger">Unset</span>
                                        @endif
                                    </div>
                                    <input type="file" class="form-control" id="hero_picture" name="hero_picture">
                                </div>
                            </div>

                            {{-- <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        USP Title
                                    </label>
                                    @if (isset($data['usp_title']))
                                        <input type="text" class="form-control" id="usp_title" name="usp_title"
                                            value="{{ $data['usp_title'] }}">
                                    @else
                                        <input type="text" class="form-control" id="usp_title" name="usp_title">
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="content" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        USP Subtitle
                                    </label>
                                    @if (isset($data['usp_subtitle']))
                                        <input type="text" class="form-control" id="usp_subtitle" name="usp_subtitle"
                                            value="{{ $data['usp_subtitle'] }}">
                                    @else
                                        <input type="text" class="form-control" id="usp_subtitle"
                                            name="usp_subtitle">
                                    @endif
                                </div>
                            </div> --}}

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        Layanan Title
                                    </label>
                                    @if (isset($data['layanan_title']))
                                        <input type="text" class="form-control" id="layanan_title"
                                            name="layanan_title" value="{{ $data['layanan_title'] }}">
                                    @else
                                        <input type="text" class="form-control" id="layanan_title"
                                            name="layanan_title">
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        Solusi Title
                                    </label>
                                    @if (isset($data['solusi_title']))
                                        <input type="text" class="form-control" id="solusi_title" name="solusi_title"
                                            value="{{ $data['solusi_title'] }}">
                                    @else
                                        <input type="text" class="form-control" id="solusi_title"
                                            name="solusi_title">
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="content" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        Solusi Subtitle
                                    </label>
                                    @if (isset($data['solusi_subtitle']))
                                        <textarea class="form-control" id="solusi_subtitle" name="solusi_subtitle" rows="3">{{ $data['solusi_subtitle'] }}</textarea>
                                    @else
                                        <textarea class="form-control" id="solusi_subtitle" name="solusi_subtitle" rows="3"></textarea>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        Testimonial Title
                                    </label>
                                    @if (isset($data['testimonial_title']))
                                        <input type="text" class="form-control" id="testimonial_title"
                                            name="testimonial_title" value="{{ $data['testimonial_title'] }}">
                                    @else
                                        <input type="text" class="form-control" id="testimonial_title"
                                            name="testimonial_title">
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        About Title
                                    </label>
                                    @if (isset($data['about_detail_title']))
                                        <input type="text" class="form-control" id="about_detail_title"
                                            name="about_detail_title" value="{{ $data['about_detail_title'] }}">
                                    @else
                                        <input type="text" class="form-control" id="about_detail_title"
                                            name="about_detail_title">
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="content" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        About Subtitle
                                    </label>
                                    @if (isset($data['about_detail_subtitle']))
                                        <textarea class="form-control" id="about_detail_subtitle" name="about_detail_subtitle" rows="3">{{ $data['about_detail_subtitle'] }}</textarea>
                                    @else
                                        <textarea class="form-control" id="about_detail_subtitle" name="about_detail_subtitle" rows="3"></textarea>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <div class="d-flex justify-content-between">
                                        <label for="name" class="form-label">
                                            <span class="text-danger me-4"></span>
                                            About Picture
                                        </label>
                                        @if (isset($data['about_detail_picture']))
                                            <a target="_blank" href="{{ $data['about_detail_picture'] }}">
                                                Preview
                                            </a>
                                        @else
                                            <span class="text-danger">Unset</span>
                                        @endif
                                    </div>
                                    <input type="file" class="form-control" id="about_detail_picture"
                                        name="about_detail_picture">
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        Pricing Title
                                    </label>
                                    @if (isset($data['pricing_title']))
                                        <input type="text" class="form-control" id="pricing_title"
                                            name="pricing_title" value="{{ $data['pricing_title'] }}">
                                    @else
                                        <input type="text" class="form-control" id="pricing_title"
                                            name="pricing_title">
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        Pricing Subitle
                                    </label>
                                    @if (isset($data['pricing_subtitle']))
                                        <input type="text" class="form-control" id="pricing_title"
                                            name="pricing_subtitle" value="{{ $data['pricing_subtitle'] }}">
                                    @else
                                        <input type="text" class="form-control" id="pricing_title"
                                            name="pricing_subtitle">
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        Pricing Detail Title
                                    </label>
                                    @if (isset($data['pricing_detail_title']))
                                        <input type="text" class="form-control" id="pricing_detail_title"
                                            name="pricing_detail_title" value="{{ $data['pricing_detail_title'] }}">
                                    @else
                                        <input type="text" class="form-control" id="pricing_detail_title"
                                            name="pricing_detail_title">
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="content" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        Pricing Detail Subtitle
                                    </label>
                                    @if (isset($data['pricing_detail_subtitle']))
                                        <textarea class="form-control" id="pricing_detail_subtitle" name="pricing_detail_subtitle" rows="3">{{ $data['pricing_detail_subtitle'] }}</textarea>
                                    @else
                                        <textarea class="form-control" id="pricing_detail_subtitle" name="pricing_detail_subtitle" rows="3"></textarea>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <div class="d-flex justify-content-between">
                                        <label for="name" class="form-label">
                                            <span class="text-danger me-4"></span>
                                            Pricing Picture
                                        </label>
                                        @if (isset($data['pricing_detail_picture']))
                                            <a target="_blank" href="{{ $data['pricing_detail_picture'] }}">
                                                Preview
                                            </a>
                                        @else
                                            <span class="text-danger">Unset</span>
                                        @endif
                                    </div>
                                    <input type="file" class="form-control" id="pricing_detail_picture"
                                        name="pricing_detail_picture">
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        FAQ Title
                                    </label>
                                    @if (isset($data['faq_title']))
                                        <input type="text" class="form-control" id="faq_title" name="faq_title"
                                            value="{{ $data['faq_title'] }}">
                                    @else
                                        <input type="text" class="form-control" id="faq_title" name="faq_title">
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="name" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        CTA Title
                                    </label>
                                    @if (isset($data['cta_title']))
                                        <input type="text" class="form-control" id="cta_title" name="cta_title"
                                            value="{{ $data['cta_title'] }}">
                                    @else
                                        <input type="text" class="form-control" id="cta_title" name="cta_title">
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="content" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        CTA Subtitle
                                    </label>
                                    @if (isset($data['cta_subtitle']))
                                        <textarea class="form-control" id="cta_subtitle" name="cta_subtitle" rows="3">{{ $data['cta_subtitle'] }}</textarea>
                                    @else
                                        <textarea class="form-control" id="cta_subtitle" name="cta_subtitle" rows="3"></textarea>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="mb-24">
                                    <label for="content" class="form-label">
                                        <span class="text-danger me-4"></span>
                                        Footer Description
                                    </label>
                                    @if (isset($data['footer_desc']))
                                        <textarea class="form-control" id="footer_desc" name="footer_desc" rows="3">{{ $data['footer_desc'] }}</textarea>
                                    @else
                                        <textarea class="form-control" id="footer_desc" name="footer_desc" rows="3"></textarea>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <button type="submit" id="btn-submit" hidden>SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        let csrf_token;
        $(document).ready(function() {

            csrf_token = $('[name="_token"]').val();
            $("#formData :input").prop("disabled", true);
            $('.btn-save').hide();
            $('.btn-edit').show();
        });

        function editData() {
            $("#formData :input").prop("disabled", false);
            $('.btn-save').show();
            $('.btn-cancel').show();
            $('.btn-edit').hide();
        }

        function saveData() {
            $("#btn-submit").click();
        }

        function disableInput() {
            $("#formData :input").prop("disabled", true);
            $('.btn-cancel').hide();
            $('.btn-save').hide();
            $('.btn-edit').show();
        }

        function cancelEdit() {
            resetToSavedData();
            disableInput();
        };


        function fillDetailData(response) {
            console.log("respoonse " + JSON.stringify(response));

            if (response.hasOwnProperty('seo_keyword')) {
                $("#seo_keyword").val(response.seo_keyword);
                $("#hero_title").val(response.hero_title);
                $("#hero_subtitle").val(response.hero_subtitle);
                $("#hero_picture").val(response.hero_picture);

                $("#layanan_title").val(response.layanan_title);

                $("#solusi_title").val(response.solusi_title);
                $("#solusi_subtitle").val(response.solusi_subtitle);

                $("#usp_title").val(response.usp_title);
                $("#usp_subtitle").val(response.usp_subtitle);

                $("#testimonial_title").val(response.testimonial_title);

                $("#about_detail_title").val(response.about_detail_title);
                $("#about_detail_subtitle").val(response.about_detail_subtitle);
                $("#about_detail_picture").val(response.about_detail_picture);

                $("#pricing_title").val(response.pricing_title);
                $("#pricing_detail_title").val(response.pricing_detail_title);
                $("#pricing_detail_subtitle").val(response.pricing_detail_subtitle);
                $("#pricing_detail_picture").val(response.pricing_detail_picture);

                $("#faq_title").val(response.faq_title);

                $("#cta_title").val(response.cta_title);
                $("#cta_subtitle").val(response.cta_subtitle);

                $("#footer_desc").val(response.footer_desc);
            } else {
                $("#seo_keyword").val("")
                $("#hero_title").val("")
                $("#hero_subtitle").val("")
                $("#hero_picture").val("")

                $("#layanan_title").val("")

                $("#solusi_title").val("")
                $("#solusi_subtitle").val("")

                $("#usp_title").val("");
                $("#usp_subtitle").val("");

                $("#testimonial_title").val("")

                $("#about_detail_title").val("")
                $("#about_detail_subtitle").val("")
                $("#about_detail_picture").val("")

                $("#pricing_title").val("")
                $("#pricing_detail_title").val("")
                $("#pricing_detail_subtitle").val("")
                $("#pricing_detail_picture").val("")

                $("#faq_title").val("")

                $("#cta_title").val("")
                $("#cta_subtitle").val("")

                $("#footer_desc").val("")
            }

        }

        function resetToSavedData() {
            event.preventDefault();
            $.ajax({
                url: "{{ route('settings.web.index') }}",
                type: "GET",
                success: function(res) {
                    fillDetailData(res);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError)
                }
            });
        }
    </script>
@endsection
