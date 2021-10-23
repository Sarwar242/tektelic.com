@foreach ($data as $d)
    @php
    //var_dump(App\Helpers\Helper::searchImage($d->search_type,$d));
    @endphp
    @if(!empty($d))
        <div class="search-result-item">
            <div class="search-result-item-inner">
                <?php if($data=\App\Helpers\Helper::checkFile(App\Helpers\Helper::searchImage($d->search_type,$d))){ ?>
                    @php
                        $src='';
                        if(!$data['is_base64']){
                            $src = $data['path'];
                        }
                        else{
                             $src = asset($data['path']);
                        }
                        @endphp
                        <?php if(!empty($src)){ ?>
                        <div class="search-result-image">
                            <img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{{$src}}" alt="search result - {{ \App\Helpers\Helper::searchAlt($d->search_type,$d) }}" title="{{ \App\Helpers\Helper::searchImgTitle($d->search_type,$d) }}">
                        </div>
                        <?php } ?>
                <?php } ?>
                <div class="search-result-item-content">
                    <p class="search-result-title">{!! \App\Helpers\Helper::createSearchLink($d->search_type)['title'] !!}</a></p>
                    <p class="search-result-subtitle"><a href="{{url(\App\Helpers\Helper::createSearchLink($d->search_type)['link'],['slug' => $d->slug])}}">{!! $d->title !!}</a> </p>
                    <p class="search-result-description">{!!  \Illuminate\Support\Str::limit(strip_tags($d->text), 363, $end='...')  !!}</p>
                </div>
            </div>
            <input type="hidden" class="count" value="{{$count}}">
            <input type="hidden" class="search_text" value="{{$search_text}}">
            <input type="hidden" class="total_pages" value="{{$total_pages}}">
            <input type="hidden" class="load_more_count" value="{{$loadmore}}">
        </div>

    @endif
@endforeach
