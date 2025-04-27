    <!-- ================> Footer section start here <================== -->
    <footer class="footer">
      <div class="footer__top padding--top padding--bottom">
          <div class="container">
              <div class="row g-4">
                  {{-- <div class="col-xl-3 col-sm-6 col-12">
                      <div class="footer__about">
                          <div class="section__header">
                              <h2>About Peace</h2>
                          </div>
                          <div class="section__wrapper">
                              <div class="footer__about-thumb">
                                  <img src="{{ asset('assets/home/assets/images/footer/post/01.jpg') }}" alt="footer thumb" class="w-100">
                              </div>
                              <div class="footer__about-contet">
                                  <p>Dramatically strategize economically sound action items for e-business niches. Quickly re-engineer 24/365 potentialities before.</p>
                              </div>
                          </div>
                      </div>
                  </div> --}}
                  @if(!empty($ffestivals) && $ffestivals->isNotEmpty())
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="footer__tags">
                            <div class="section__header">
                                <h2>up coming events</h2>
                            </div>
                            <div class="section__wrapper">
                                <ul>
                                    @foreach ($ffestivals as $festival)
                                        <li><a href={{ route('home.singlefestival',$festival->id) }}>{{ $festival->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                  @endif
                  <div class="col-xl-3 col-sm-6 col-12">
                      <div class="footer__post">
                          <div class="section__header">
                              <h2>Popular Temples</h2>
                          </div>
                          <div class="section__wrapper">
                            @foreach ($ftemples as $temple)
                                <div class="footer__post-item">
                                    <div class="footer__post-inner">
                                        <div class="footer__post-thumb">
                                            <a href="{{ route('home.viewtemple',$temple->id) }}"><img src="{{ asset($temple->main_image) }}" alt="footer post"></a>
                                        </div>
                                        <div class="footer__post-content">
                                            <a href="{{ route('home.viewtemple',$temple->id) }}">
                                                <h6>{{ $temple->name }}</h6>
                                            </a>
                                            <p><i class="fas fa-map-marker-alt"></i> {{ $temple->state.' , '.$temple->country }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                      <div class="footer__links">
                          <div class="section__header">
                              <h2>Useful Links</h2>
                          </div>
                          <div class="section__wrapper">
                              <ul>
                                @if(!Auth::check())
                                    <li><a href="{{ route('login') }}">Log in</a></li>
                                @endif
                                  <li><a href="{{ route('home.temples') }}">All Temples</a></li>
                                  <li><a href="{{ route('home.festivals') }}">All Events</a></li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="footer__bottom">
          <div class="container">
              <div class="footer__bottom-area text-center">
                  <div class="footer__bottom-logo">
                      {{-- <a href="index.html"><img src="{{ asset('assets/home/assets/images/footer/post/01.jpg') }}" alt="footer logo"></a> --}}
                  </div>
                  <div class="footer__bottom-content">
                      <p>Copyright &copy; {{ date('Y') }} <a href="{{ route('home') }}">TMS</a></p>
                  </div>
              </div>
          </div>
      </div>
  </footer>
  <!-- ================> Footer section end here <================== -->

