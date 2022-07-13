@extends(module_views_path('home', 'layouts.template.list'))

@section('caption_page')
    @parent
    <x-form method="POST" route="laka-parse-log.store" id="frmParseAll">
        @foreach(data_get($data,'rows') as $key=> $file)
            {!! Form::hidden('files', data_get($file,'name')) !!}
        @endforeach
        {!! Form::btSubmit(__('laka_log.btn-parse-all'), 'primary', ['class' => 'btn-sm mb-2 btn-parse-all',
            'data-form-id' => 'frmParseAll',
            'data-trigger-confirm' => '1', 'data-loading' => translate('table.loading_text'),
            'icon' => "fas fa-exchange-alt",'data-confirmation-msg'=>__('common.confirm_parse_all') ],'add',$sectionCode)!!}

    </x-form>
@endsection

@push('scripts')
<script>
(function ($) {
    _grids.utils.handleAjaxRequest($('.btn-parse'), 'click', {
        pjaxContainer: '#downloadLakaLog-grid'
    });
    _grids.utils.handleAjaxRequest($('.btn-parse-all'), 'click', {
        pjaxContainer: '#downloadLakaLog-grid'
    });
})(jQuery);
</script>
@endpush
