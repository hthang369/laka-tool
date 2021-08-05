@extends('layouts.system-admin')

@section('title', $titlePage)

@section('content')
    <!-- TITLE -->
    @section('header_page')
        <h2 class="card-header px-0">
            @lang($headerPage)
        </h2>
    @show

    <div class="card-body px-0">
        @section('message_content')
            @if (session('message'))
            <x-alert type="info" dismissible>{{session('message')}}</x-alert>
            @endif
        @show
        @section('caption_page')
            <div class="d-flex justify-content-between">
                <p>
                    <b>@lang('common.total')</b>
                    <label>{{ data_get($data, 'total') }}</label>
                </p>
                @if (data_get($data, 'pages') > 0)
                <p>
                    <b>@lang('common.pages')</b>
                    <label>{{ data_get($data, 'currentPage') }} / {{ data_get($data, 'pages')}}</label>
                </p>
                @endif
            </div>
        @show

        <x-table
            :responsive="true"
            bordered
            hover
            id="gridData"
            :sectionCode="$sectionCode"
            :items="data_get($data, 'rows')"
            :fields="data_get($data, 'fields')"
            :pagination="[
                'total' => data_get($data, 'total'),
                'pages' => data_get($data, 'pages'),
                'currentPage' => data_get($data, 'currentPage'),
                'from' => data_get($data, 'from'),
                'to' => data_get($data, 'to')
            ]">
            @yield('table_row')
        </x-table>
    </div>

    @yield('footer_page')
@endsection

@push('scripts')
<script>
    (function($) {
      var grid = "#gridData";
      var filterForm = "";
      var searchForm = "";
      _grids.grid.init({
        id: grid,
        filterForm: filterForm,
        dateRangeSelector: '.date-range',
        searchForm: searchForm,
        pjax: {
          pjaxOptions: {
            scrollTo: false,
          },
          // what to do after a PJAX request. Js plugins have to be re-intialized
          afterPjax: function(e) {
            _grids.init();
          },
        },
      });
      _grids.init()

    })(jQuery);
  </script>
@endpush
