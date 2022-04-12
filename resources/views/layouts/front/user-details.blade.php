@extends('layouts.front.app')
@section('meta-description')
<meta name="description" content="this is the user {{ $user->name }} main page">
@endsection
@section('title')
Magaxat | User Page
@endsection
@section('content')
<div class="one-user-wrapper">
  <div class="filter-user-wrapper">
    <div class="filter-user-container">
      <span class="filter-user-text">@lang('translations.filter')</span>
      <i class="fas fa-filter filter-user-icon"></i>
    </div>
    <div class="user-info-search-wrapper">
      <div class="search-items">
        <input class="user-info-input" placeholder="Поиск..." type="text" />
        <i class="fas fa-search user-info-search-icon"></i>
      </div>
    </div>
  </div>
  <div class="one-user-details-wrapper">
    <div class="one-user-main-info-wrapper">
      <div class="one-user-main-info-details">
        <div class="one-user-image-container">
          <img
            src="{{ asset($user->image ?? 'images/avatar.png') }}"
            alt="user-image"
            class="one-user-image"
          />
        </div>
        <div class="one-user-personal-info-container">
          <p class="one-user-name">{{ $user->name }}</p>
          <p class="one-user-email">{{ $user->email }}</p>
        </div>
      </div>
      <div class="one-user-main-info-button">
        <div class="one-user-green-button">
          <span class="green-button-text">@lang('translations.user_inf')</span>
        </div>
      </div>
      <div class="user-additional-info">
        @if($user->date_of_birth)
        <div class="info">
          <div class="info-name">@lang('translations.date_of_birth')</div>
          <div class="info-value">{{ $user->date_of_birth }}</div>
        </div>
        @endif
        @if($user->email)
        <div class="info">
          <div class="info-name">@lang('translations.email')</div>
          <div class="info-value">{{ $user->email }}</div>
        </div>
        @endif
        <div class="info">
          <div class="info-name">@lang('translations.gender')</div>
          <div class="info-value">{{ $user->name }}</div>
        </div>
        @if($user->age)
        <div class="info">
          <div class="info-name">@lang('translations.age')</div>
          <div class="info-value">{{ $user->age }}</div>
        </div>
        @endif
        @if($interesting_type)
        <div class="info">
          <div class="info-name">@lang('translations.interest_type')</div>
          <div class="info-value">{{ $interesting_type->name }}</div>
        </div>
        @endif
      </div>
    </div>
    <div class="one-user-social-info-wrapper">
      <div class="media-details">
        <span class="media-span media-title media-images-count-title"
          >@lang('translations.image')</span
        >
        <i class="fas fa-file-image media-icon media-image-icon"></i>
        <span class="media-count">{{ $user_images_count }}</span>
      </div>
      <div class="media-details">
        <span class="media-span media-title media-videos-count-title"
          >@lang('translations.video')</span
        >
        <i class="fas fa-photo-video media-icon media-videos-icon"></i>
        <span class="media-count">{{ $user_videos_count }}</span>
      </div>
      <div class="media-details">
        <span class="media-span media-title media-posts-count-title"
          >@lang('translations.posts')</span
        >
        <i class="fas fa-book-open media-icon media-book-icon"></i>
        <span class="media-count">{{ $user_posts_count }}</span>
      </div>
      <div class="media-details">
        <span class="media-span media-title media-subscribers-count-title"
          >@lang('translations.subscribtions')</span
        >
        <i class="fas fa-user media-icon media-image-icon"></i>
        <span class="media-count">{{ $user->subscribtions->count() }}</span>
      </div>
      <div class="media-details">
        <span class="media-span media-title media-subscribers-count-title"
          >@lang('translations.subscribers')</span
        >
        <i class="fas fa-users media-icon media-image-icon"></i>
        <span class="media-count">{{ $user->subscribers->count() }}</span>
      </div>
    </div>
  </div>
  <div class="main-posts">
    <div class="main-posts-buttons-container">
      <p class="main-posts-title">@lang('translations.news')</p>
      <div class="main-posts-buttons-wrapper">
        <div class="main-posts-search-wrapper">
          <i class="fas fa-search main-posts-search-icon"></i>
          <input type="text" class="main-posts-search-input" />
          <i class="fas fa-microphone main-posts-search-microhphone"></i>
        </div>
        <div class="main-posts-add-buttons">
          <button class="main-posts-add-appeal-button">
            @lang('translations.create_appeal')
          </button>
          <button class="main-posts-add-post-button">
            <i class="fal fa-plus"></i>
            @lang('translations.add_n_post')
          </button>
        </div>
      </div>
    </div>
    <div class="posts-wrapper">
      @foreach($user_posts as $post)
      <div class="main-post">
        <div class="main-post-user-info-wrapper">
          <div class="main-post-user-image-wrapper">
            <img
              src="{{asset($post->user->image ?? 'images/avatar.png')}}"
              alt=""
              class="main-post-user-image"
            />
          </div>
          <div class="main-post-user-names-wrapper">
            <span class="main-post-user-name">{{ $post->user->name }}</span>
            <span class="main-post-user-email">{{'@'. $post->user->name }}</span>
          </div>
        </div>
        <p class="main-post-title">{{ $post->title }}</p>
        <p class="main-post-description">
          {{ str_limit($post->description, 500) }}
        </p>

        @if($post->image)
        <div class="main-post-image-wrapper">
          <img src="{{ asset($post->image) }}" alt="" class="main-post-image" />
        </div>
        @endif

        @if($post->video)
        <div class="main-post-video-wrapper">
          <video
            controls
            src="{{ asset($post->video) }}"
            alt="video"
            class="main-post-video"
          ></video>
        </div>
        @endif
        <div class="main-post-socials">
          <div class="main-post-likes">
            <span>{{ $post->likes->count() }}</span>
            @if(Auth::check())
            <i
              id="{{ $post->id }}"
              class="icon fas {{ $post->likes->where('user_id', Auth::id())->count() !== 0 ? 'fa-heart liked-post-heart-icon' : 'fa-heart' }} post-heart-icon"
            ></i>
            @else
            <i
              id="{{ $post->id }}"
              class="icon fas {{ $post->likes->where('user_id', Auth::id())->count() !== 0 ? 'fa-heart liked-post-heart-icon' : 'fa-heart' }}"
            ></i>
            @endif
          </div>
          <div class="main-post-comments">
            <span class="comments-count-span">{{ $post->comments->count() }}</span>
            <i
              class="far fa-comments main-post-comments-icon"
              id="{{ $post->id }}"
            ></i>
          </div>
        </div>
        <div class="main-post-comments-section"></div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<!-- add post modal -->
<div class="posts-modal-wrapper">
  <div class="modal-content">
    <div class="close-modal-container">
      <span class="close-posts-modal">&times;</span>
    </div>
    <form action="{{ route('user.posts.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
          <label class="create-post-label" for="title">@lang('translations.title')</label>
          <input type="text" class="form-control" name="post_title" placeholder="Title" value="{{ old('post_title') }}">
          @error('post_title')
          <span style="color:red">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group">
          <label class="create-post-label" for="post_description">@lang('translations.descriptions')</label>
          <textarea name="post_description" class="text-area-form-control" id="description" cols="30" rows="10">{{ old('post_description') }}</textarea>
          @error('post_description')
          <span style="color:red">{{$message}}</span>
          @enderror
      </div>


      <div class="form-group modal-checker-container">
        <div class="post-modal-checker">
          <div class="modal-checker"></div>
        </div>
        <label class="create-post-label image-label">@lang('translations.image')</label>
        <label class="create-post-label video-label">@lang('translations.video')</label>
        @error('post_image')
          <span style="color:red">{{$message}}</span>
        @enderror
        @error('post_video')
          <span style="color:red">{{$message}}</span>
        @enderror
      </div>


      <div class="form-group post-modal-image-container">
          <label class="create-post-label" for="image">@lang('translations.image')</label>
          <input type="file" accept="image/*" class="form-control" name="post_image">
      </div>

      <button type="submit" class="btn btn-primary create-post-modal-btn">@lang('translations.add_n_post')</button>
  </form>
  </div>
</div>

 <!-- add appeal modal -->
 <div class="appeals-modal-wrapper">
  <div class="modal-content">
    <div class="close-modal-container">
      <span class="close-appeals-modal">&times;</span>
    </div>
    <form action="{{ route('user.appeals.store', Auth::id()) }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
          <label class="create-post-label" for="title">@lang('translations.title')</label>
          <input type="text" class="form-control" name="appeal_title" placeholder="Title">
          @error('appeal_title')
          <span style="color:red">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group">
          <label class="create-post-label" for="description">@lang('translations.descriptions')</label>
          <textarea name="appeal_description" class="text-area-form-control" id="description" cols="30" rows="10"></textarea>
          @error('appeal_description')
          <span style="color:red">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group modal-image-container">
          <label class="create-post-label" for="image">@lang('translations.image')</label>
          <input type="file" accept="image/*" multiple class="form-control" name="appeal_image[]">
          @error('appeal_image')
          <span style="color:red">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group modal-image-container">
        <label class="create-post-label" for="video">@lang('translations.video')</label>
        <input type="file" accept="video/*" class="form-control" name="appeal_video">
        @error('appeal_video')
          <span style="color:red">{{$message}}</span>
        @enderror
    </div>

      <button type="submit" class="btn btn-primary create-post-modal-btn">@lang('translations.add_appeal')</button>
  </form>
  </div>
</div>

@push('js')
<script src="{{ asset('js/addPostComment.js') }}" defer></script>
<script src="{{ asset('js/addPostLike.js') }}" defer></script>
<script src="{{ asset('js/toggleModalInputs.js') }}" defer></script>
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

{{-- <script src="{{ asset('js/toggleModalInputs.js') }}" defer></script> --}}
@endpush
@endsection
