<div class="d-flex justify-content-between mb-3">
    <p class="d-flex align-items-center m-0">
        <label class="mr-2 mb-0"><b>@lang('common.total'):</b></label>
        <label class="mb-0">{{ $total }}</label>
    </p>

    @if ($pages > 0)
    {!! $paginator->links('components.system-admin.paginarion-pager') !!}
    @endif
</div>
