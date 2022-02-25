@extends('components.system-admin.update')

@section('header_page')
<h2 class="card-header px-4 bg-light">
    @lang($headerPage) : {{ data_get($data, 'role.name')}}
</h2>
@endsection

@section('message_content')
    @if (!blank(session('message')))
        <x-alert type="success">{!! session('message') !!}</x-alert>
    @elseif (!blank(session('errors')))
        <x-alert type="danger">{!! session('errors') !!}</x-alert>
    @endif
@endsection

@section('form_content')
   <x-table
        responsive
        bordered
        hover
        :sectionCode="$sectionCode"
        :items="data_get($data, 'rows')"
        :fields="data_get($data, 'fields')"
        :total="data_get($data, 'total')"
        :pages="data_get($data, 'pages')"
        :currentPage="data_get($data, 'currentPage')"
        :from="data_get($data, 'from')"
        :to="data_get($data, 'to')"
        >
        @yield('table_row')
    </x-table>
@endsection
