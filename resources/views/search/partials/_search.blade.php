@if(!empty($count))
    <div class="search-results-body append_items" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
        @include('search.partials._items', ['data' => $data,'search_text'=>$search_text])
    </div>
    <div class="search-results-footer">
        <div class="pagination">
            <?php if($total_pages>1 && $loadmore<=$total_pages){ ?>
            <div class="load-more" id="load-more-search" data-page="<?= $loadmore  ?>" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="100">Load more</div>
                <?php } ?>

           <?php if($total_pages>1){ ?>
            <ul class="pagination-list" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="150">
                <li class="prev-page">

                    <?php if($page==1){
                        $stroke = '#C4C4C4';
                    ?>
                        <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 0.499998L1 5.25L5 10" stroke="<?= $stroke ?>" stroke-linecap="round"/>
                        </svg>

                    <?php
                    }
                    else{
                        $stroke = '#2CABE1';
                        ?>
                        <a class="prev-page-link" href="JavaScript:Void(0);">
                            <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 0.499998L1 5.25L5 10" stroke="<?= $stroke ?>" stroke-linecap="round"/>
                            </svg>
                        </a>
                    <?php
                    }
                    ?>

                </li>

                <?php

                    for($i = 1; $i <= $total_pages; $i++){
                    if($i == 1){
                ?>
                <li class="pagination-item"><a data-page="<?= $i ?>" id="<?= $i ?>"  class="pagination-link pagination-link-search current-page"
                                               href="JavaScript:Void(0);"><?= $i ?></a></li>
                <?php
                      }
                 else{
                ?>
                <li class="pagination-item"><a data-page="<?= $i ?>" id="<?= $i ?>" class="pagination-link pagination-link-search" href="JavaScript:Void(0);"><?= $i ?></a></li>
                 <?php } ?>
                 <?php } ?>


                <li class="next-page">
            <?php if($page==$total_pages){
                        $stroke = '#C4C4C4';
                    ?>

                        <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 0.499998L5 5.25L1 10" stroke="<?= $stroke ?>" stroke-linecap="round"/>
                        </svg>

                    <?php
                    }
                    else{
                        $stroke = '#2CABE1';
                        ?>
                        <a class="next-page-link" href="JavaScript:Void(0);">
                        <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 0.499998L5 5.25L1 10" stroke="<?= $stroke ?>" stroke-linecap="round"/>
                        </svg>
                    </a>
                        <?php
                    }
                    ?>

                </li>
            </ul>
        <?php } ?>
        </div>
    </div>

@else

    <div class="feature-headings">
        <div class="section-title"><b><?= \App\Models\StaticTextLang::t("No results", 'search'); ?></b></div>
    </div>
    <div class="no-results"><?= \App\Models\StaticTextLang::t("change your keywords and try again",'search'); ?></div>

@endif


