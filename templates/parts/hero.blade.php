<div class="relawanku-hero">
    <div class="frow-container">
        @if(isset($hero_small))
            <div class="frow">
                <div class="col-md-2-3">
                    <div class="hero-title-wrapper">
                        <h1 class="hero-title">{!! $page_title !!}</h1>
                    </div>
                </div>
            </div>
        @else
            <div class="hero-title-wrapper">
                <h1 class="hero-title">{!! $page_title !!}</h1>
            </div>
        @endif
    </div>
</div>