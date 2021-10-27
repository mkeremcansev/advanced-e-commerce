<section class="featured section-padding">
    <div class="container">
        <div class="row">
            @foreach ($services as $service)
            <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                <div class="banner-features wow fadeIn animated hover-up animated">
                    <img src="{{ asset($service->image) }}" alt="{{ $service->title }}">
                    <h4 style="background-color: {{ $service->color }};">{{ $service->title }}</h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>