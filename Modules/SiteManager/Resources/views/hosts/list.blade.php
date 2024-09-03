@extends(layouts_path('common', 'main-page'))

@push('styles')
<link rel="stylesheet" href="{{asset('css/codemirror.css')}}" />
@endpush

@section('content')
@php
    $modal = $data['modal'];
    $formOptions = array_only($modal, ['method', 'route']);
    data_set($formOptions, 'class', array_css_class(['frm-hosts', $modal['class']]));
    data_set($formOptions, 'id', 'modal_form');
@endphp
{!! Form::open($formOptions) !!}
{!! $data['form'] !!}
{!! Form::close() !!}
@endsection

@push('scripts')
<script src="{{ asset('js/codemirror.js') }}"></script>
@endpush
