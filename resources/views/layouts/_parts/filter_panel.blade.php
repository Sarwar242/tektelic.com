<?php

use App\Categories;use App\Product;
$active = '';
$class_catalog = '';
$categories = Categories::getCategories();
$static_url = false;
if($url == 'catalog' || $url == 'articles') {
    if($url == 'articles') {
        $static_url = 'articles';
    } else {
        $static_url = 'catalog';
    }
    $parse_data_filter = Product::parseFilterString(isset($_GET['filters']) ? $_GET['filters'] : []);
    $active_category = isset($parse_data_filter['filters']) ? $parse_data_filter['filters']['result_category'] : [];
    $class_catalog = 'filter-panel-catalog';
    if(empty($active_category)) $active = 'active';
} else {
    if(empty($category_slug)){
        $active = 'active';
    }
}
?>

<div class="filter-panel" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50">
    <div class="filter-panel-inner closed <?=$class_catalog?>" id="filter-panel">
        <div class="filter-panel-item item-load-data">
            <a data-url="{{$static_url}}" href="{{url((string)$url)}}" data-category-id="all">
                <div class="filter-panel-button uppercase <?= $active ?>">All</div>
            </a>
        </div>
        @foreach($categories as $category)
            <?php
            $active = '';
            if($url == 'catalog' || $url == 'articles') {
                if(in_array($category->id,$active_category)) $active = 'active';
            } else {
                if($category->slug === $category_slug) {
                    $active = 'active';
                }
            }

            ?>
            <div class="filter-panel-item item-load-data">
                <a data-url="{{$static_url}}" href="{{url($url.'/category',['category_slug' => $category->slug])}}" data-category-id="{{$category->id}}">
                    <div class="filter-panel-button uppercase <?= $active ?>">{{$category->name}}</div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="filter-panel-footer" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="1100">
        <button class="filter-panel-trigger" id="load-more-sub"><?= \App\Models\StaticTextLang::t("More",'portfolio'); ?></button>
    </div>
</div>
