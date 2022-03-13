<section class="volunteer-hero-section">
	<div class="frow-container">
		<div class="frow">
			<div class="col-md-2-3">
				<div class="inner-wrapper">
					<div class="cover">
						<span>Photo by iam_os on Unsplash</span>
					</div>
					<div class="profile">
						<div class="profile-image">
							<img src="{{ RELAWANKU__URL }}/assets/images/man.png" alt="Muslim icons created by Prosymbols - Flaticon" />
						</div>
						<div class="profile-info">
							<h1>{{ $volunteer_name }} {!! $is_valid ? "<i class='ri-checkbox-circle-line'></i>" : "<i class='ri-close-circle-line'></i>" !!}</h1>
							@if(isset($position) && $position)
                                <p>{{ $position }}</p>
                            @endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="volunteer-section detail-section">
	<div class="frow-container">
		<div class="frow">
			<div class="col-md-2-3">
				<div class="inner-wrapper">
					<h2>{{ $section_information }}</h2>
					<div class="details-wrapper">
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

@if($skills)
    <section class="volunteer-section skills-section">
	    <div class="frow-container">
		    <div class="frow">
			    <div class="col-md-2-3">
				    <div class="inner-wrapper">
					    <h2>{{ $section_skills }}</h2>
					    <div class="skills-wrapper">
						    <ul>
                                @foreach($skills as $skill)
                                    <li>{{ $skill }}</li>
                                @endforeach
                            </ul>
					    </div>
				    </div>
			    </div>
		    </div>
	    </div>
    </section>
@endif

<section class="volunteer-section missions-section">
	<div class="frow-container">
		<div class="frow">
			<div class="col-md-2-3">
				<div class="inner-wrapper">
					<h2>{{ $section_missions }}</h2>
					<div class="missions-wrapper">
                        <div class="mission-item">
                            <h4>Mission Long Name</h4>
                            <p class="mission-location">Padang, Indonesia</p>
                            <p class="mission-period">July 2021 - September 2021</p>
                            <p class="mission-desc">Alongside 6 other volunteers</p>
                        </div>
                        <div class="mission-item">
                            <h4>Second Mission Name</h4>
                            <p class="mission-location">Sumbawa, Indonesia</p>
                            <p class="mission-period">Feb 2020 - Maret 2020</p>
                            <p class="mission-desc">Alongside 8 other volunteers</p>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>