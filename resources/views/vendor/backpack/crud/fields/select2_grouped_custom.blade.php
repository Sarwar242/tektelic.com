<!-- select2 -->
@php
  $current_value = old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' ));
@endphp

@include('crud::fields.inc.wrapper_start')
<label>{!! $field['label'] !!}</label>
@include('crud::fields.inc.translatable_icon')
@php
    $categories = \App\BindItems::getAllItems();

    //build option keys array to use with Select All in javascript.
    // $model_instance = new $field['model'];
    // $options_ids_array = $field['options']->pluck($model_instance->getKeyName())->toArray();
    $options_ids_array = [];
    $field['multiple'] = $field['multiple'] ?? true;

    $type_resources = $field['type_resources'];
    $id_entry = $entry->id;
    $select_items = \App\BindItems::getSelectItems($id_entry,$type_resources);

@endphp
<input type="hidden" name="parent_type" value="{{$type_resources}}">
<input type="hidden" name="parent_id" value="{{$id_entry}}">
<select
    name="{{ $field['name'] }}[]"
    style="width: 100%"
    data-init-function="bpFieldInitSelect2GroupedElement"
    data-select-all="{{ var_export($field['select_all'] ?? false)}}"
    data-options-for-js="{{json_encode(array_values($options_ids_array))}}"
    @include('crud::fields.inc.attributes', ['default_class' =>  'form-control select2_field'])
    {{ $field['multiple'] ? 'multiple' : '' }}
>
    @foreach ($categories as $type => $category)
        <optgroup label="{{\App\ItemKey::getNameType($type)}}">
            <?php $value = [] ?>
            @foreach ($category as $key => $subEntryName)
                <?php $value[$type] = $key ?>
                <option value="{{json_encode($value)}}"
                    @if (isset($select_items[$type][$key]) )
                        selected
                    @endif
                >
                    ({{\App\ItemKey::getNameType($type)}}) {{ $subEntryName }}
                </option>
            @endforeach
        </optgroup>
    @endforeach
</select>

{{-- HINT --}}
@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
@endif

@include('crud::fields.inc.wrapper_end')

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->fieldTypeNotLoaded($field))
    @php $crud->markFieldTypeAsLoaded($field);@endphp

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
        <!-- include select2 css-->
        <link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

        <style>
            .select2-container--bootstrap .select2-results__option .select2-results__option {
                padding-left: 20px !important;
                font-size: 13px;
            }
        </style>
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <!-- include select2 js-->
        <script src="{{ asset('packages/select2/dist/js/select2.full.min.js') }}"></script>
    @if (app()->getLocale() !== 'en')
        <script src="{{ asset('packages/select2/dist/js/i18n/' . app()->getLocale() . '.js') }}"></script>
    @endif
        <script>
            function bpFieldInitSelect2GroupedElement(element) {

                var $select_all = element.attr('data-select-all');
                if (!element.hasClass("select2-hidden-accessible"))
                {
                    element.select2({
                        theme: "bootstrap"
                    });

                    //get options ids stored in the field.
                    var options = JSON.parse(element.attr('data-options-for-js'));

                    if($select_all) {
                        element.parent().find('.clear').on("click", function () {
                            $obj.val([]).trigger("change");
                        });
                        element.parent().find('.select_all').on("click", function () {
                            $obj.val(options).trigger("change");
                        });
                    }
                }
            }
        </script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
