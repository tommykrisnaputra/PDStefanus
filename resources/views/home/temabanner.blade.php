<div class="home-cards-container">
	<div class="container">
		<div class="carousel slide" id="temaBannerCaraousel" data-bs-ride="carousel">
			<div class="carousel-inner">
				@foreach ($temaPd as $key => $data)
					<div class="place-card-container carousel-item {{ $key == 0 ? 'active' : '' }}">
						<div class="place-card-grid">
							<div>
								<div class="place-card-title">
									<span class="place-card-text">
										<h3>Next Topic</h3>
									</span>

									<span class="place-card-text2">
										<span>{{ $data->title }}</span>
									</span><br>

									<span class="place-card-text1">
										<span>
											{!! nl2br(e($data->description)) !!}
										</span>
									</span>
								</div>
								<div class="place-card-date">
									<span class="place-card-text3">
										&nbsp;
										<i class="fa-sharp fa-regular fa-calendar fa-lg"></i>
										{{ \Carbon\Carbon::parse($data->date)->format('D d M Y') }}
									</span>
								</div>
							</div>
							<div class="place-card-tema-pd">
								<a href="{{ $data->links }}">
									<img class="place-card-tema-pd-img" src="{{ $data->media }}" alt="image">
								</a>
							</div>
						</div>
					</div>
				@endforeach
				<!-- Add more carousel items as needed -->
			</div>
			<button class="carousel-control-prev banner-button tema-carousel-button" data-bs-target="#temaBannerCaraousel"
				data-bs-slide="prev" type="button">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next banner-button tema-carousel-button" data-bs-target="#temaBannerCaraousel"
				data-bs-slide="next" type="button">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
	</div>
</div>
