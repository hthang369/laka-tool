<div class="d-flex justify-content-between mb-3">
    <div class="d-flex align-items-center">
        <label class="mr-2 mb-0"><b>@lang('common.total'):</b></label>
        <label class="mb-0">{{ $total }}</label>

        <div class="button-group ml-3">
            @foreach ($grid->getButtons() as $btn)
                {!! $btn !!}
            @endforeach
        </div>
    </div>

    @if ($paginator->hasPages())
    {!! $paginator->links(layouts_path('home', 'partial.paginarion-pager')) !!}
    @else
    <div class="header-pager-info d-flex align-items-center">
        <label class="mr-2 mb-0"><b>@lang('common.pages')</b></label>
        <label class="mb-0">{{ $currentPage }} / {{ $pages }}</label>
    </div>
    @endif
</div>
