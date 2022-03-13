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

@if($missions)
    <section class="volunteer-section missions-section">
	    <div class="frow-container">
		    <div class="frow">
			    <div class="col-md-2-3">
				    <div class="inner-wrapper">
					    <h2>{{ $section_missions }}</h2>
					    <div class="missions-wrapper">
                            @foreach($missions as $missionId => $mission)
                                <div class="mission-item">
                                    <h4>{{ $mission['title'] }}</h4>
                                    @if(!empty($mission['location']))
                                        <p class="mission-location">{{ $mission['location'] }}</p>
                                    @endif
                                    @if($mission['start'])
                                        <p class="mission-period">{{ $mission['start']}} {{ $mission['end'] ? '- ' . $mission['end'] : ''}}</p>
                                    @endif                 
                                    @if(!empty($mission['volunteers']))               
                                        <p class="mission-desc">{{ $mission['volunteers'] }}</p>
                                    @endif
                                </div>
                            @endforeach
					    </div>
				    </div>
			    </div>
		    </div>
	    </div>
    </section>
@endif