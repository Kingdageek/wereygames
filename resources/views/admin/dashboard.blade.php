@extends('layouts.admin')
@section('title', 'Dashboard')
@section('nav_class', 'page-header-modern')

@section('content')

<div class="content">
    <div class="content-heading">
        Statistics <small class="d-none d-sm-inline">Awesome!</small>
   </div>

    @include('admin._dashboard-stats', ['data' => $data])

    {!! $story_chart->renderHtml() !!}

</div>
@endsection

@section('page:scripts')
    {!! $story_chart->renderChartJsLibrary() !!}
    {!! $story_chart->renderJs() !!}
@endsection
