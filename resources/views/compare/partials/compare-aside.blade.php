<?php if(!empty($comparison_one)){ ?>
@php
$product_db = $comparison_one->product;

if(!empty($product_db )){
if(!empty($ajax)){
    $product_type=$product_db->type;
}
else{
  //  $product_type=null;
}

//\App\Helpers\Helper::getMainOptions();
$options =  \App\Helpers\Helper::getMainOptions($product_type0);
    @endphp
<div class="compare-item-list">
    @foreach($options as $option)
    <div class="compare-list-row" data-row="<?= \App\Helpers\Helper::getNotEqualField($product_db,$option['name'],$product_type) ?>" data-row="equal" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
        <div class="compare-caption">{{$option['name']}} :</div>
    </div>
    @endforeach
</div>
<?php }
?>
<?php } ?>
