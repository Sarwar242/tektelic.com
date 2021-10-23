<div class="tab-section" id="tab-1">
    <div class="row">
        @if(!empty($product->getCharacteristics()['main']))
            @foreach($product->getCharacteristics()['main'] as $name => $items)
                <div class="col-12 col-md-6">
                    <h4 class="specification-heading">{{$name}}</h4>
                    <ul class="specification-list">
                        @foreach($items as $item)
                            <li class="specification-list-item">{{$item['name']}}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        @endif
    </div>
</div>
<div class="tab-section" id="tab-2">
    @if(!empty($product->getCharacteristics()['base']))
        @foreach($product->getCharacteristics()['base'] as $name => $items)
            <h4 class="specification-heading">{{$name}}</h4>
            <div class="specification-table">
                <table>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td><span class="table-cell">{{$item['name']}}</span></td>
                            @if($item['checked'])
                                <td>
                                    @if($item['value'] == 'on')<i class="icon-checked"></i>@endif
                                </td>
                            @endif
                            @if(!$item['checked'])
                                <td><span class="table-cell">{{$item['value']}}</span></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
</div>
<div class="tab-section" id="tab-3">
    <!-- #SID : 40-new-tab-on-product-page -->
    @if($product->compliance_sheet != '')
        <ul class="specification-button-group">
            <li class="button-group-item">
                <a class="specification-button" target="_blank" href="{{asset($product->compliance_sheet)}}"><?= \App\Models\StaticTextLang::t("Get Compliance",'catalog'); ?></a>
            </li>
        </ul>
    @endif
    @if($product->fcc_compliance != '')
        <ul class="specification-button-group">
            <li class="button-group-item">
                <a class="specification-button" target="_blank" href="{{asset($product->fcc_compliance)}}"><?= \App\Models\StaticTextLang::t("FCC Compliance",'catalog'); ?></a>
            </li>
        </ul>
    @endif
</div>

