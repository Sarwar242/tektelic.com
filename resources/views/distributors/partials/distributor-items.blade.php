
@foreach ($distributor_items as $distributor_item)
@if(!empty($distributor_item->distributor))
    <div class="distributors-item">
        <a class="distributor-card" target="_blank" href="<?= url($distributor_item->distributor->link ?? '') ?>" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
            <div class="distributor-card-body">
                <div class="distributor-image">
                    <svg class="distributor-placeholder" width="380" height="285" viewBox="0 0 380 285" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0" y="0" width="380" height="285" rx="3" ry="3" fill="none"></rect>
                    </svg>
                    <img class="distributor-logo" src="{{asset(\App\Helpers\Helper::getImgSrc($distributor_item->distributor->image))}}" alt="{{ $distributor_item->alt }}" title="{{ $distributor_item->pic_title }}" />
                </div>
            </div>
            <div class="distributor-card-footer"><span class="distributor-name">{!! $distributor_item->title !!}</span></div>
        </a>
    </div>
    @endif
@endforeach
