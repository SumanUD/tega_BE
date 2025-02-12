@extends('pages.includes.main')

@section('content')
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide" style="background-image: url('{{ asset('/siteimages/industriestwo.jpg') }}');">
            <div class="col-md-6 text-left">
                <div class="slc animate__animated animate__zoomIn animate__slow">
                    <h1>Test Demo</h1>
                    <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h3>
                    <a href="#" class="slidbut btn-c">Read More</a>
                </div>
            </div>
        </div>
        <div class="swiper-slide" style="background-image: url('{{ asset('/siteimages/industries.jpg') }}');">
            <div class="col-md-6 text-left">
                <div class="slc animate__animated animate__slow">
                    <h1>Test Demotwo</h1>
                    <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h3>
                    <a href="#" class="slidbut btn-c">Read More</a>
                </div>
            </div>
        </div>
        <div class="swiper-slide" style="background-image: url('{{ asset('/siteimages/industriestwo.jpg') }}');">
            <div class="col-md-6 text-left">
                <div class="slc animate__animated animate__slow">
                    <h1>Test Demothree</h1>
                    <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h3>
                    <a href="#" class="slidbut btn-c">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-button-next swcol"></div>
    <div class="swiper-button-prev swcol"></div>
</div>
@endsection
