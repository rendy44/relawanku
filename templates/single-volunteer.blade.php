@includeIf('parts.hero')
<section class="relawanku-section section-volunteer">
    <div class="frow-container">
        <div class="frow">
            <div class="col-md-2-3">
                <div class="section-wrapper">
                    <h2>Details</h2>
                    <div class="details-row">
                        @foreach($details as $detailId => $detailArr)
                            <div class="detail-item item-{{$detailId}}">
                                <label for="{{$detailId}}">{{$detailArr[0]}}</label>
                                <span id="{{$detailId}}">{{$detailArr[1]}}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>