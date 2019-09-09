<div class="col-lg-6 col-6 d-flex justify-content-center">
    <div class="card" data-id="{{ $post->id }}">
        <div class="card-body">
            @foreach($post->tags as $tag)
                <a class="btn btn-outline-success" href="">{{ $tag->name }}</a>
            @endforeach
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->description }}</p>
            <a href="{{ route('show', $post->id) }}" class="btn btn-primary">Посмотреть</a>
        </div>
        @if($post->images->isNotEmpty())
            <img class="card-img-top"
                 src="{{ asset('storage/images/posts') . '/' . $post->images->first()->path}}
                     " style="width: 200px" alt="">

        @endif
        <div>
            {{$post->created_at->diffForHumans()}}
        </div>
    </div>
</div>
