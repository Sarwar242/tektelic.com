<?php if(!empty($entity) ){ ?>
<div class="section-seo">
    <article class="seo-atricle">
        <?php if(!empty($entity->seo_title) ){ ?>
        <h2 class="seo-title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50">{!! $entity->seo_title !!}</h2>
        <?php } ?>
        <?php if(!empty($entity->seo_description) ){ ?>
        <div class="collapse-block" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
            <div class="content-block hide">

                {!! $entity->seo_description !!}

            </div>
            <a class="content-toggle toggle--see-more" href="#" data-close="See more" data-open="Hide" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="1250"><?= \App\Models\StaticTextLang::t("See more",'footer_form'); ?></a>
        </div>
        <?php } ?>
    </article>
</div>
<?php } ?>
