@extends('components.system-admin.list')

@section('caption_page')
    @parent
    <x-form method="POST" route="laka-log.store">
        @foreach(data_get($data,'rows') as $key=> $file)
            {!! Form::hidden('files[]', data_get($file,'name')) !!}
        @endforeach
        {!! Form::btSubmit(__('laka_log.btn-parse-all'), 'primary', ['class' => 'btn-sm mb-2', 'icon' => "fas fa-exchange-alt",'data-confirmation-msg'=>__('common.confirm_parse_all') ],'add',$sectionCode)!!}

    </x-form>
@endsection
