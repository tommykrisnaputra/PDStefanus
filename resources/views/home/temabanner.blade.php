<div class="home-cards-container">
    <div class="container">
        <div id="temaBannerCaraousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($temaPd as $key => $data)
                <div class="place-card-container carousel-item {{$key == 0 ? 'active':''}}">
                    <div class="place-card-grid">
                        <div>
                            <div class="place-card-title">
                                <span class="place-card-text">
                                  <h3><b>Next Topic</b></h3>
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
                                    {{ $data->date->format('D d M Y') }}
                                </span>
                            </div>
                        </div>
                      <div class="place-card-tema-pd">
                          <a href={{ $data->links }}  >
                              <img alt="image" class="place-card-tema-pd-img" src={{ $data->media }}/>
                          </a>
                      </div>

                    </div>
                </div>
            @endforeach
                <!-- Add more carousel items as needed -->
            </div>
            <button class="carousel-control-prev banner-button tema-carousel-button" type="button" data-bs-target="#temaBannerCaraousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next banner-button tema-carousel-button" type="button" data-bs-target="#temaBannerCaraousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
