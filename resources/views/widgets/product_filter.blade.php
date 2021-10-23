<div class="aside-widgets" id="<?= $class ?>" data-accordion-group>
    <!-- Product type -->
    <form action="#" method="post" class="form-filter-countainer">
        <div class="aside-widget accordion open" data-accordion>
            <div class="widget-title trigger-arrow" data-control><strong>Product type</strong></div>
            <div class="widget-content" id="categories" data-content>
                @if(!empty($types))
                    @foreach($types as $key => $name)
                        <div class="widget-row">
                            <label class="checkbox-item">
                                <input
                                    @if(isset($checkedItems['result_type'][$key])) checked @endif
                                    name="type"
                                    type="checkbox"
                                    value="{{$key}}"
                                /><span>{{$name}}</span>
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <!-- Category-->
<!--        <div class="aside-widget accordion open" data-accordion>
            <div class="widget-title trigger-arrow" data-control><strong>Category</strong></div>
            <div class="widget-content" id="types" data-content>
                @if(!empty($categories))
                    @foreach($categories as $key => $name)
                        <div class="widget-row">
                            <label class="checkbox-item">
                                <input
                                    name="category"
                                    type="checkbox"
                                    #{status}="#{status}"
                                    value="{{$key}}"
                                    @if(isset($checkedItems['result_category'][$key])) checked @endif
                                /><span>{{$name}}</span>
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>-->
        <!-- Range-->
        {{--<div class="aside-widget accordion" data-accordion>
            <div class="widget-title trigger-arrow" data-control><strong>Range</strong></div>
            <div class="widget-content" id="price-range" data-content>
                <div class="widget-row">
                    <div class="range-inputs-group">
                        <input name="first_range" class="input-number" type="number" value="0" id="range-input-from"><span class="range-devider">-</span>
                        <input name="second_range" class="input-number" type="number" value="100500" id="range-input-to">
                        <div class="range-button">ok</div>
                    </div>
                    <div style="cursor: pointer" class="range-input-slider"><input type="text" id="range-slider" class="range-slider" name="range" value="" /></div>
                </div>
            </div>
        </div>--}}
        <!-- Working frequency-->
        <div class="aside-widget accordion" data-accordion id="characteristic">
            @foreach($characteristics as $key => $characteristic)
                <div class="widget-title trigger-arrow" data-control>
                    <strong>{{\App\Widgets\ProductFilter::getNameGroup($key)}}</strong>
                </div>
                @foreach($characteristic as $item)
                    <div class="widget-content" data-content>
                        <div class="widget-row">
                            <label class="checkbox-item">
                                <input name="characteristic" value="{{$item['id']}}" type="checkbox"/>
                                <span>{{$item['name']}}</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>

        <!-- Cloud Tags-->
        <div class="aside-widget accordion open" data-accordion>
            <div class="widget-title trigger-arrow" data-control>
                <strong>Cloud Tags</strong>
            </div>
            <div class="widget-content" data-content>
                <span class="widget-tag">Smart Cities</span>
                <span class="widget-tag">Building Management</span>
                <span class="widget-tag">Smart Agriculture</span>
                <span class="widget-tag">Oil & Gas</span>
                <span class="widget-tag">Smart Tracking</span>
                <span class="widget-tag">Smart Cities</span>
                <span class="widget-tag">Building Management</span>
                <span class="widget-tag">Smart Agriculture</span>
                <span class="widget-tag">Oil & Gas</span>
                <span class="widget-tag">Smart Tracking</span>
            </div>
        </div>

    </form>
</div>
