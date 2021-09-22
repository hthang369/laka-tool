@extends('components.system-admin.form')

@section('message_content')
    @if (session('message'))
        <x-alert type="info" dismissible>{{session('message')}}</x-alert>
    @endif
@endsection
    @section('body_content')
    <x-form route="laka-log.s3-log-list">
        <x-form-group :inline="true">
            <div class="col-2">
                <x-datepicker name="dtFrom" :value="$dtFrom" />
            </div>
            <span>~</span>
            <div class="col-2">
                <x-datepicker name="dtTo" :value="$dtTo" />
            </div>
            <x-button type="submit" variant="primary" text="Search" />
        </x-form-group>
    </x-form>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr scope="header">
            <th scope="col">@lang('common.index')</th>
            <th scope="col">Name</th>
            <th scope="col">@lang('common.action')</th>
        </tr>
        </thead>
        <tbody>

        @if(empty($data['paginator']->items()))
            <tr>
                <td scope="col" colspan="7" class="">
                    <div class="alert alert-warning">
                        @lang('custom_message.no_item_found')
                    </div>
                </td>
            </tr>
        @endif
        @foreach($data['paginator']->items() as $key => $value)
            <tr scope="row">
                <td>
                    {{ (($data['paginator']->currentPage() - 1 ) * $data['paginator']->perPage() ) + $loop->iteration }}
                </td>
                <td>{{$value['name']}}</td>
                <td>
                    <div>
                        <form action="{{route('laka-log.download-log')}}" method="POST">
                            @csrf
                            {!! Form::hidden('name', $value['name']) !!}
                            @if($value['isDownloaded'] == true)
                                <button type="submit" class="btn btn-sm btn-secondary" disabled>
                                    <i class="fas fa-download"></i>
                                </button>
                            @else
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fas fa-download"></i>
                                </button>
                            @endif
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @if ($data['paginator']->lastPage() > 1)
    <x-pagination
        :total="$data['paginator']->total()"
        :current="$data['paginator']->currentPage()"
        :pages="$data['paginator']->lastPage()"
        :except="['date_log']" />
    @endif
</div>
@endsection
