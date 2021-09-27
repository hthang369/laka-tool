@extends('components.system-admin.list')

@section('caption_page')
    @parent
    <x-form method="POST" route="laka-log.store">
        @foreach(data_get($data,'rows') as $key=> $file)
            {!! Form::hidden('files[]', data_get($file,'name')) !!}
        @endforeach
        <x-button variant="primary" :text="__('laka_log.btn-parse-all')" type="submit" :disabled="$data->status == 1 ? true : false"
                  class="mb-3"/>
    </x-form>
@endsection
