@extends('layouts.front.app')
@section('meta-description')
<meta name="description" content="this is the appeal {{ $appeal->title }} main page">
@endsection
@section('title')
Magaxat | Appeal
@endsection
@section('content')
<div class="main-appeal-wrapper">
  <div class="container">
    <div class="main-appeal-container">
      <div class="main-appeal-image-shares-wrapper">
        <div class="main-appeal-image-wrapper">
          <img src="{{ $appeal->user->image ?? asset('images/avatar.png') }}" alt="user-image" />
        </div>
        <div class="main-appeal-shares-wrapper">
          <div class="appeal-share-icon">
            <i class="fa-brands fa-facebook-square"></i>
          </div>
          <div class="appeal-share-icon">
            <i class="fa-brands fa-facebook-messenger"></i>
          </div>
          <div class="appeal-share-icon">
            <i class="fa-brands fa-whatsapp"></i>
          </div>
          <div class="appeal-share-icon">
            <i class="fa-brands fa-twitter"></i>
          </div>
          <div class="appeal-share-icon">
            <i class="fa-brands fa-instagram"></i>
          </div>
        </div>
      </div>
      <div class="main-appeal-info-wrapper">
        <div class="main-appeal-title-pdf-wrapper">
          <div class="main-appeal-title-description-wrapper">
            <p class="main-appeal-title">
              {{ $appeal->title }}
            </p>
            <p class="main-appeal-id">ID: {{ $appeal->uniqueid }}</p>
            <p class="main-appeal-description">
             {{ $appeal->description }}
            </p>
          </div>
          @if($appeal->pdf_path)
            <div class="main-appeal-pdf-wrapper">
              <div class="appeal-pdf-downloader">
                <i class="fa-solid fa-cloud-arrow-down"></i>
                <a href="{{ $appeal->pdf_path }}" download="{{ $appeal->pdf_path }}">
                  {{ __('translations.download_document') }}
                </a>
              </div>
            </div>
          @endif
        </div>
        <div class="appeal-media-wrapper">
          @if($appeal->image_path)
          <div class="appeal-media-image-wrapper">
            <div class="main-post">
              <div class="post-user-date-wrapper">
                <div class="post-user-info">
                  <div class="post-user-image-wrapper">
                    <a href="{{ route('user.page', $appeal->user->unique_id) }}">
                      <img src="{{ $appeal->user->image ?? asset('images/avatar.png') }}" alt="person" />
                    </a>
                  </div>
                  <div class="post-user-names-wrapper">
                    <span class="post-user-name">
                      {{ $appeal->user->name }}
                    </span>
                    <span class="post-user-link">@ {{ $appeal->user->name }}</span>
                  </div>
                </div>
                <div class="post-date-wrapper">
                  <span class="post-date">{{ $appeal->created_at->format('Y-m-d') }}</span>
                  <span class="post-time">{{ $appeal->created_at->format('H:ia') }}</span>
                </div>
              </div>

              <div class="post-image-wrapper">
                <img
                  class="main-post-image"
                  src="{{ $appeal->image_path }}"
                  alt="post-image"
                />
              </div>
            </div>
          </div>
          @endif

          @if($appeal->video)
          <div class="appeal-media-video-wrapper">
            <div class="main-post">
              <div class="post-user-date-wrapper">
                <div class="post-user-info">
                  <div class="post-user-image-wrapper">
                    <a href="{{ route('user.page', $appeal->user->unique_id) }}">
                      <img src="{{ $appeal->user->image !== null ? $appeal->user->image : asset('images/avatar.png') }}" alt="person" />
                    </a>
                  </div>
                  <div class="post-user-names-wrapper">
                    <div class="post-user-names-wrapper">
                      <span class="post-user-name">
                        {{ $appeal->user->name }}
                      </span>
                      <span class="post-user-link">@ {{ $appeal->user->name }}</span>
                    </div>
                  </div>
                </div>
                <div class="post-date-wrapper">
                  <span class="post-date">{{ $appeal->created_at->format('Y-m-d') }}</span>
                  <span class="post-time">{{ $appeal->created_at->format('H:ia') }}</span>
                </div>
              </div>

              <div class="post-image-wrapper">
                <video
                  class="main-post-image"
                  src="{{ $appeal->video->video_path }}"
                  alt="post-image"
                  controls
                ></video>
              </div>
            </div>
          </div>
          @endif
        </div>
        <div class="main-appeal-help-section">
          <div class="main-appeal-help-section-one">
            <div class="main-appeal-help-text-id">
              <p class="main-appeal-help-title">{{ __('translations.how_can_i_help') }}</p>
              <p class="main-appeal-help-description">
                {{ __('translations.to_help') }}
              </p>
              <div class="main-appeal-help-id-container">
                <div class="main-appeal-help-id">
                  <span>{{ $appeal->uniqueid }}</span>
                </div>
                <div class="main-appeal-help-icon-wrapper">
                  <i class="fa-solid fa-angle-right"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="main-appeal-help-section-two">
            <p class="make">{{ __('translations.make') }}</p>
            <div class="main-appeal-want-to-help">
              <div class="main-appeal-help-buttons-wrapper">
                <a href="" class="online-transfer-btn">
                  <img src="{{asset('images/img/signals.png')}}" alt="online-transfer" />
                  <span>{{ __('translations.online_transfer') }}</span>
                </a>
                <a href="" class="bank-transfer-btn">
                  <img src="{{asset('images/img/Vector (1).png')}}" alt="bank-transfer" />
                  <span>{{ __('translations.bank_transfer') }}</span>
                </a>
                @if($appeal->pdf_path)
                <a href="{{ $appeal->pdf_path }}" download="{{ $appeal->pdf_path }}" class="mobile-down-icon">
                  <i class="fa-solid fa-cloud-arrow-down"></i>
                  {{ __('translations.download_document') }}
                </a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="main-appeal-mobile-shares-wrapper">
        <div class="appeal-share-icon">
          <i class="fa-brands fa-facebook-square"></i>
        </div>
        <div class="appeal-share-icon">
          <i class="fa-brands fa-facebook-messenger"></i>
        </div>
        <div class="appeal-share-icon">
          <i class="fa-brands fa-whatsapp"></i>
        </div>
        <div class="appeal-share-icon">
          <i class="fa-brands fa-twitter"></i>
        </div>
        <div class="appeal-share-icon">
          <i class="fa-brands fa-instagram"></i>
        </div>
      </div>
    </div>
  </div>
</div>
@push('js')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset('js/toggleAppeal.js') }}" defer></script>
<script>
  var swiper = new Swiper(".swiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    autoplay: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });
</script>
@endpush
@endsection

