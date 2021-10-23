<?php
if(empty($category_slug)){
    $active_all = 'active';
    $active = '';
}
else{
    $active_all = '';
    $active = 'active';
}
?>
<div class="filter-panel">
    <div class="filter-panel-header">
        <div class="filter-panel-heading">Use Case</div>
    </div>
    <div class="filter-panel-inner closed" id="filter-panel">
        @foreach($categoriesUse as $category)
            <div class="filter-panel-item">
                <a href="{{url('category_catalog',['category_slug' => $category->slug])}}">
                    <div class="filter-panel-button {{ $category->slug==$category_slug? $active: '' }}">{{$category->name}}</div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="filter-panel-footer">
        <button class="filter-panel-trigger" id="filter-panel-trigger">More</button>
    </div>
</div>
<div class="filter-panel">
    <div class="filter-panel-header">
        <div class="filter-panel-heading">Key Areas</div>
    </div>
    <div class="filter-panel-inner">
        @foreach($categoriesArea as $category)
            <div class="filter-panel-item">
                <a href="{{url('category_catalog',['category_slug' => $category->slug])}}">
                    <div class="filter-panel-button {{ $category->slug==$category_slug? $active: '' }}">{{$category->name}}</div>
                </a>
            </div>
        @endforeach
    </div>
</div>
