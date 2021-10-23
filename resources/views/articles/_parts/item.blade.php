@foreach($posts as $post)
    <article class="article-box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
        <div class="article-box-image"><img src="{{$post->image}}" alt="{{ $post->alt }}" title="{{ $post->pic_title }}"/></div>
        <div class="article-box-inner">
            <div class="article-box-header">
                <date class="article-box-date">
                    {{date('d.m.Y', strtotime($post->date))}}
                </date>
                <a class="article-box-link" href={{url('articles',['slug' => $post->slug])}}>
                    <h4 class="article-box-title"><?= strip_tags($post->title) ?></h4>
                </a>
            </div>
            <div class="article-box-content">
                <p><?= \Illuminate\Support\Str::limit(strip_tags($post->content), 150, $end='...') ?></p>
            </div>
            <div class="article-box-footer">
                @if(count($post->tags) > 0)
                    <div class="article-box-tags">
                        <i class="article-box-icon icon-tag"></i>
                        @foreach($post->tags as $tag)
{{--                            <a class="article-box-tag-link" href="{{url('tags_articles',['tag' => $tag->slug])}}">--}}
                            <a class="article-box-tag-link filter_by_tags" data-tag-name="{{$tag->id}}">
                                {{$tag->name}}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </article>
@endforeach
