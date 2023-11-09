@php
    if(!isset($includeToComponent__)) $includeToComponent__ = false;
    if( $includeToComponent__  == true) $name = $clear_name;
    $includeFromHeadToDown = (isset($includeFromHeadToDown) && $includeFromHeadToDown == "true" )?true:false;
    $stackNameScript = (isset($includeFromHeadToDown) && $includeFromHeadToDown)? 'js-lib-component-head':'js-lib-component';
    $include = (isset($include))?$include:false;
    $textComponet = (isset($admin))?"Add component Menu double click for set setting":"Loading";
@endphp
@pushOnce('css-style')
    <link type="text/css"  rel="stylesheet" href="/js/component/paginationComponent/pagination.css">
@endpushOnce
@pushOnce($stackNameScript)
    <script src="/js/component/paginationComponent/pagination.js"></script>
@endPushOnce
@if(!$include)

<component id="component_menu_{{$name}}" data-name="{{$name}}">
    <div id="component_{{$name}}" class="pagination">{{$textComponet}}</div>
</component>
    @if($includeToComponent__ != true)
        @if(!$includeFromHeadToDown)
            @push('component-js')
        @endif
    @endif
    <script date-id_script="{{$name}}">
        @if($includeToComponent__ != true )
            @if(!$includeFromHeadToDown)
                $(document).ready(function() {
            @endif
        @endif
            var pagination_{{$name}} = {
                'pageSize':{{(isset($pagination['pageSize']))?$pagination['pageSize']:10}},
                'page':{{(isset($pagination['page']))?$pagination['page']:1}},
                'typePagination':{{(isset($pagination['typePagination']))?$pagination['typePagination']:1}}
            };
            var params_{{$name}} = {
                'name':'{{isset($name)?$name:'noName'}}',
                @isset($targetObject)
                'targetObject': page__.getElementsGroup('{{$targetObject}}')[0]['obj'],
                @endisset
                'data':@php echo isset($data)?$data:'null'; @endphp,
                'template':@php echo isset($template)?str_replace("\/","/",json_encode($template)):"template_1";@endphp,
                'target':@php echo isset($target)?json_encode($target):"undefined"; @endphp,
                pagination: pagination_{{$name}},
            };
            var obj_{{$name}} = new Pagination('#component_{{$name}}', params_{{$name}})
            page__.addNewElement(obj_{{$name}}, 'component_{{$name}}')
        @if($includeToComponent__ != true )
            @if(!$includeFromHeadToDown)
                });
            @endif
        @endif
    </script>
    @if($includeToComponent__ != true )
        @if(!$includeFromHeadToDown)
            @endpush
        @endif
    @endif

@endif

