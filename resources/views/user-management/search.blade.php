@extends('layouts.system-admin')

@section('title', 'Danh sách công ty')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="alert alert-primary" role="alert">
        <h1>@lang('custom_title.user')</h1>
    </div>

    <!-- SEARCH FORM -->
    <div id="collapseExample"
         class="mb-4 alert alert-secondary">
        <form method="GET" action="/system-admin/user-management/list?search=true">
            <input type="hidden" name="search" value="true">
            <div class="form-group">
                <label>Name</label>
                <input value="{{ request()->name }}" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input value="{{ request()->email }}" name="email" class="form-control"  >
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input value="{{ request()->phone }}" name="phone" class="form-control"  >
            </div>
            <div class="form-group">
                <label>Address</label>
                <input value="{{ request()->address }}" name="address" class="form-control"  >
            </div>
            <button type="submit" class="btn btn-success">Search
                <i class="fa fa-search"></i>
            </button>
            <!-- GET ALL BUTTON -->
            <a class="ml-3  my-2 btn  btn-secondary" href="/system-admin/user-management" role="button">
                <i class="fa fa-list" aria-hidden="true"></i>
                @lang('common.get_all')
            </a>
        </form>
    </div>
        </div>
@endsection
