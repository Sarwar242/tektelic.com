<div class="knowledge-base-aside-inner">
    <div class="aside-widgets" id="aside-accordion" data-accordion-group>
        <form action="#" class="form-filter-countainer">
            <!-- Topics -->
                <div class="aside-widget accordion open" data-accordion>
                    <div class="widget-title trigger-arrow" data-control><strong>Topics</strong></div>
                    <div class="widget-content" data-content>
                        <ul class="widget-list">
                            @foreach($lastArticles as $lastArticle)
                                <li class="widget-list-item"><a class="widget-list-link" href="{{url('articles',['slug' => $lastArticle->slug])}}">{{$lastArticle->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- Filters -->
                <div class="aside-widget" data-accordion>
                    <div class="widget-title trigger-arrow" data-control><strong>Filters</strong></div>
                    <div class="widget-content" data-content>
                        <!-- UseCase -->
                        <div class="aside-widget accordion open" data-accordion>
                            <div class="widget-title trigger-plus" data-control>UseCase</div>
                            <div class="widget-content" data-content>
                                @foreach($categoriesUse as $id => $category)
                                    <div class="widget-row">
                                        <label class="checkbox-item">
                                            <input
                                                @if(isset($checkedItems['result_use'][$id])) checked @endif
                                                name="category_use"
                                                type="checkbox"
                                                value="{{$id}}"
                                            /><span>{{$category}}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- UseCase -->
                        <div class="aside-widget" data-accordion>
                            <div class="widget-title trigger-plus" data-control>Key areas</div>
                            <div class="widget-content" data-content>
                                @foreach($categoriesArea as $id => $category)
                                    <div class="widget-row">
                                        <label class="checkbox-item">
                                            <input
                                                @if(isset($checkedItems['result_key'][$id])) checked @endif
                                                type="checkbox"
                                                name="category_area"
                                                value="{{$id}}"
                                            /><span>{{$category}}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tags -->
                <div class="aside-widget" data-accordion>
                    <div class="widget-title trigger-arrow" data-control><strong>Tags</strong></div>
                    <div class="widget-content" data-content>
                        @foreach($tags as $tag)
                            <div class="widget-row">
                                <label class="checkbox-item">
                                    <input
                                            @if(isset($checkedItems['result_tags'][$tag->id])) checked @endif
                                            type="checkbox"
                                            name="tag"
                                            value="{{$tag->id}}"
                                    /><span>{{$tag->name}}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
        </form>
    </div>
</div>
