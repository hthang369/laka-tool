@extends(layouts_path('home', 'partial.list'))

@if (str_is(get_route_name(), 'laka-user-management.index'))
@push('scripts')
<script>
(function ($) {
    _grids.utils.handleAjaxRequest($('.btn-remote'), 'click', {
        pjaxContainer: '#approvalApiToken-grid'
    });
})(jQuery);
</script>
@endpush
@endif
