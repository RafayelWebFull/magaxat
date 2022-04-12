@extends('layouts.front.welcome-app')
@section('meta-description')
<meta name="description" content="this is the main page of magaxat.com">
@endsection
@section('content')

<div class="appeals-section">
  <div class="main-appeals-title-wrapper">
    <p class="main-appeals-title">{{ __('translations.need_help_now') }}</p>
  </div>
  <div class="swiper appealsSwiper">
    <div class="swiper-wrapper home-appeals-wrapper">
      @foreach($random_appeals as $appeal)
        <div class="swiper-slide appeal-slide">
          <div class="appeal-slide-image-wrapper">
            <img class="appeal-slide-image" src="{{ $appeal->image_path }}" alt="" />
          </div>
          <div class="appeal-slider-info-wrapper">
            <p class="appeal-title"> {{ str_limit($appeal->title, 30) }}</p>
            <p class="appeal-description">
              {{ str_limit($appeal->description, 80) }}
            </p>
          </div>
          <a href="{{ route('show-appeal', $appeal->uniqueid) }}" class="appeal-slide-link">{{ __('translations.want_help') }}</a>
        </div>
      @endforeach
    </div>
  </div>
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
</div>

<div class="main-posts-wrapper pb-3">
  <div class="main-posts-title-wrapper">
    <p class="main-posts-title">{{ __('translations.news') }}</p>
  </div>
  <div class="col-md-8 col-10 offset-md-2 offset-1">
    <div class="main-posts-buttons-wrapper">
      <div class="main-posts-search-wrapper">
        <form action="{{ route('welcome', request()->query()) }}" method="GET">
          {{-- @csrf --}}
          <i class="fas fa-search main-posts-search-icon"></i>
          <input
            type="text"
            name="search-key"
            placeholder="{{ __('translations.search') }}"
            class="main-posts-search-input"
          />
          <button class="search-button">{{ __('translations.search') }}</button>
        </form>
      </div>
      <div class="main-posts-add-buttons">
        <button class="main-posts-add-appeal-button">{{ __('translations.help_request') }}</button>
        <button class="main-posts-add-post-button">
            &nbsp;
          <img src="{{asset('/images/group.png')}}" width="20px">
            &nbsp;&nbsp;
          {{ __('translations.new_post') }}
        </button>
      </div>
    </div>

    <div class="main-posts-container">
        <div class="main-posts">
          @foreach($random_posts as $post)
            <div class="main-post">
              <div class="post-user-date-wrapper">
                <div class="post-user-info">
                  <div class="post-user-image-wrapper">
                    <a href="{{ route('user.profile', $post->user->unique_id) }}">
                      <img src="{{ $post->user->image ?? asset('images/avatar.png') }}" alt="person" />
                    </a>
                  </div>
                  <div class="post-user-names-wrapper">
                    <span class="post-user-name">{{ $post->user->name }}</span>
                    <span class="post-user-link">@ {{ $post->user->name }}</span>
                  </div>
                </div>
                <div class="post-date-wrapper">
                  <span class="post-date">{{ $post->created_at->format('Y-m-d') }}</span>
                  <span class="post-time">{{ $post->created_at->format('H:i:a') }}</span>
                </div>
              </div>
              <p class="post-title">
                {{ $post->title }}
              </p>
              @if($post->image_path)
              <div class="post-image-wrapper">
                <img
                  class="main-post-image"
                  src="{{ $post->image_path }}"
                  alt="post-image"
                />
              </div>
              @endif

              @if($post->video)
              <div class="post-image-wrapper">
                <video controls
                  class="main-post-video"
                  src="{{ $post->video->video_path }}"
                  alt="post-image"
                /></video>
                <div class="play-wrapper">
                  <img src="{{ asset('images/img/play.png') }}" alt="">
                </div>
              </div>
              @endif
              {{-- <p class="post-description">
                {{ $post->description }}
              </p> --}}
              <div class="main-post-socials-wrapper">
                <div class="likes-count">
                  {{-- <i class="fa-solid fa-heart social-icon"></i> --}}

                @if(Auth::check())
                  @if($post->likes->where('user_id', Auth::id())->count() !== 0)
                  <img id="{{ $post->id }}" class="social-icon post-heart-icon liked-post-heart-icon" src="{{ asset('images/img/red-heart.png') }}" alt="heart">
                  @else
                  <img id="{{ $post->id }}" class="social-icon post-heart-icon" src="{{ asset('images/img/black-heart.png') }}" alt="heart">
                  @endif
                  @else
                  <img class="social-icon" src="{{ asset('images/img/black-heart.png') }}" alt="heart">
                @endif
                  <span class="likes-count-span">{{ $post->likes->count() }}</span>
                </div>
                <div class="comments-count" id="{{ $post->id }}">
                  <img id="{{ $post->id }}" class="social-icon main-post-comments-icon" src="{{ asset('images/img/comment.png') }}" alt="comment">
                  <span class="comments-count-span"> {{ $post->comments->count() }}</span>
                </div>
                <div class="shares-count">
                  <img id="{{ $post->id }}" class="social-icon main-post-comments-icon" src="{{ asset('images/img/share.png') }}" alt="share">
                  <span class="shares-count-span">4</span>
                </div>
                <div class="shares-count">
                  <img id="{{ $post->id }}" class="social-icon main-post-comments-icon" src="{{ asset('images/img/social-share.png') }}" alt="social-share">
                  <span class="social-shares-count-span">4</span>
                </div>
              </div>

              <div class="main-post-comment-form-wrapper">
                @if (Auth::check())
                <form class="main-post-comment-form">
                  <div class="form-group">
                    <textarea
                      name="title"
                      class="form-control main-post-form-textarea"
                      id="{{ $post->id }}"
                      cols="10"
                      rows="2"
                    ></textarea>
                  </div>
                  <div class="comment-error-div">
                    <span class="comment-error-span"></span>
                  </div>
                  <button type="button" class="main-post-add-comment-btn">
                    {{ __('translations.add_comment') }}
                  </button>
                </form>
                @endif
              </div>

              <div class="main-post-comments-section">

              </div>
            </div>
          @endforeach
        </div>
    </div>
  </div>

</div>

<div class="posts-modal-wrapper">
  <div class="posts-modal-content">
    <div class="close-modal-container">
      <i class="fa-solid fa-xmark close-posts-modal"></i>
    </div>
    <form
      action="{{ route('user.posts.store') }}"
      class="posts-modal-form"
      method="POST"
      enctype="multipart/form-data"
    >
    @csrf
      <div class="form-group">
        <label class="create-post-label" for="title">{{ __('translations.title') }}</label>
        <input
          type="text"
          class="form-control"
          name="post_title"
          placeholder="{{ __('translations.title') }}"
          value="{{ old('post_title') }}"
        />
        @error('post_title')
          <span style="color: red">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label class="create-post-label" for="post_description"
          >{{ __('translations.description') }}</label
        >
        <textarea
          name="post_description"
          class="text-area-form-control"
          id="post-description"
          cols="30"
          rows="10"
        >{{ old('post_description') }}</textarea>
        @error('post_description')
          <span style="color: red">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group post-modal-media-container">
        <div class="post-modal-media">
          <label class="create-post-label image-label">{{ __('translations.type_of_media') }}</label>
          <select name="media_type" class="form-control media-type">
            <option value="image">{{ __('translations.image') }}</option>
            <option value="video">{{ __('translations.video') }}</option>
          </select>
        </div>
        <div class="post-modal-media-type">
          <label class="create-post-label" for="image"
            >{{ __('translations.choose_your_file') }}</label
          >
          <label class="media-label">
            <input
              type="file"
              accept="image/*"
              class="media-input"
              name="post_image"
            />
            <span>{{ __('translations.choose_your_file') }}</span>
            <i class="fa-solid fa-link post-modal-attachement"></i>
          </label>
          @error('post_image')
            <span style="color: red" class="mi-e">{{$message}}</span>
          @enderror
          @error('post_video')
            <span style="color: red" class="mv-e">{{$message}}</span>
          @enderror
          <span style="color: red" class="mv-e"></span>
        </div>
      </div>

      <div class="form-group post-modal-image-container">
        <label class="create-post-label" for="countries">{{ __('translations.country') }}</label>
        <select name="country" class="form-control" id="country">
          @foreach($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
          @endforeach
        </select>
        @error('country')
          <span style="color: red">{{$message}}</span>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary create-post-modal-btn">
        {{ __('translations.create_post') }}
      </button>
    </form>
  </div>
</div>

<div class="appeals-modal-wrapper">
  <div class="appeals-modal-content">
    <div class="close-modal-container">
      <i class="fa-solid fa-xmark close-appeals-modal"></i>
    </div>
    <form
      action="{{ route('user.appeals.store') }}"
      class="appeals-modal-form"
      method="POST"
      enctype="multipart/form-data"
    >
    @csrf
      <div class="form-group">
        <label class="create-appeal-label" for="title">{{ __('translations.title') }}</label>
        <input
          type="text"
          class="form-control"
          name="appeal_title"
          placeholder="Title"
          value="{{ old('appeal_title') }}"
        />
        @error('appeal_title')
          <span style="color: red">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label class="create-post-label" for="appeal_description"
          >{{ __('translations.description') }}</label
        >
        <textarea
          name="appeal_description"
          class="text-area-form-control"
          id="appeal-description"
          cols="30"
          rows="10"
        >{{ old('appeal_description') }}</textarea>
        @error('appeal_description')
          <span style="color: red">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group post-modal-media-container">
        <div class="post-modal-media-type">
          <label class="create-post-label" for="image"
            >{{ __('translations.image') }}</label
          >
          <label class="media-label appeals-modal-image">
            <input
              type="file"
              accept="image/*"
              class="media-input"
              name="appeal_image[]"
              multiple
            />
            <span>{{ __('translations.image') }}</span>
            <i class="fa-solid fa-link post-modal-attachement"></i>
          </label>
          @error('appeal_image')
            <span style="color: red">{{$message}}</span>
          @enderror
        </div>
        <div class="post-modal-media-type">
          <label class="create-post-label" for="image"
            >{{ __('translations.video') }}</label
          >
          <label class="media-label">
            <input
              type="file"
              accept="video/mp4"
              class="media-input app-vi"
              name="appeal_video"
            />
            <span>{{ __('translations.choose_your_file') }}</span>
            <i class="fa-solid fa-link post-modal-attachement"></i>
          </label>
          @error('appeal_video')
            <span style="color: red">{{$message}}</span>
          @enderror
          <span style="color: red" class="app-ve"></span>
        </div>
      </div>

      <button type="submit" class="btn btn-primary create-post-modal-btn">
        {{ __('translations.create_appeal') }}
      </button>
    </form>
  </div>
</div>

@endsection
@push('js')

<script>
 window.uuxyz.uuxyzc = <?php echo json_encode($user_country); ?>
</script>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script src="{{ asset('js/addPostLike.js') }}" defer type="module"></script>
<script src="{{ asset('js/toggleModalInputs.js?version=3') }}" defer></script>
<script src="{{ asset('js/loadPosts.js?version=7') }}" defer type="module"></script>
<script src="{{asset('js/newest-addPostComments.js?version=2')}}" defer type="module"></script>
<script src="{{asset('js/upload.js')}}" defer></script>

<script>
  const postsModalContent = document.querySelector('.posts-modal-wrapper');
  const appealsModalContent = document.querySelector('.appeals-modal-wrapper');
  @if ($errors->count() > 0)
  const errors = {!! json_encode($errors->toArray()) !!};
  if(errors['modalType'] == 'postsModal') {
    postsModalContent.style.display="block"
  } else {
    appealsModalContent.style.display="block"
  }
  @endif
</script>

@endpush
