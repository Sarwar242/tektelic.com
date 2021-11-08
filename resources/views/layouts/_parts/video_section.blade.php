@if(isset($homeData['videos']))
<!-- #SID - 30-video-section-for-the-homepage -->
<!-- https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=UCKnuTRM6YY0OEKZ8GpJYdqg&maxResults=25&key=AIzaSyB-9wjw_CJdJpG0GX3hj1TlPuPL8Z_SWD4 -->
<div class="subtitle-padding">
    {!! $homeData['videos'] !!}
</div>
@endif
<div class="portfolio-list">
    <div class="portfolio-list-inner">
        @if(!empty($videos->link_one))
            <div class="portfolio-list-column video-single">
                <div class="youtube-video-place" data-yt-url="<?php echo $videos->link_one; ?>">
                    <div class="play"></div>
                    <img src="https://img.youtube.com/vi/<?php echo explode("/",$videos->link_one)[4]; ?>/0.jpg" async  loading='lazy' class="play-youtube-video">
                </div>
                <!--<iframe width="450" height="300" src="?rel=0&showinfo=0&autoplay=0" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
            </div>
        @endif
        @if(!empty($videos->link_two))
            <div class="portfolio-list-column video-single">
                <div class="youtube-video-place" data-yt-url="<?php echo $videos->link_two; ?>">
                    <div class="play"></div>
                    <img src="https://img.youtube.com/vi/<?php echo explode("/",$videos->link_two)[4]; ?>/0.jpg" async class="play-youtube-video">
                </div>
            </div>
        @endif
        @if(!empty($videos->link_three))
            <div class="portfolio-list-column video-single">
                <div class="youtube-video-place" data-yt-url="<?php echo $videos->link_three; ?>">
                    <div class="play"></div>
                    <img src="https://img.youtube.com/vi/<?php echo explode("/",$videos->link_three)[4]; ?>/0.jpg" async class="play-youtube-video">
                </div>
            </div>
        @endif
    </div>
</div>
