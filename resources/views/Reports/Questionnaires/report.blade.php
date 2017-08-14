@extends('layout')

@section('title_section', 'login page')

@section('style')
@endsection

@section('content')


<h2></h2>


<div data-function="chart-questionnaire"></div>

@endsection

@section('scripts')
<!-- JavaScript :: Custom scripts for module -->
    <script src="/js/AppCore/Extensions/highcharts-4.2.4/js/highcharts.js"></script>
    <script src="/js/AppCore/Extensions/highcharts-4.2.4/js/highcharts-3d.js"></script>
    <script src="/js/AppCore/Extensions/highcharts-4.2.4/js/modules/exporting.js"></script>
    <script src="/js/AppCore/Extensions/highcharts-4.2.4/js/modules/drilldown.js"></script>
    
    <script src="/js/Modules/Reports/Questionnaires/chartQuestionnaires.js"></script>
    <script src="/js/Modules/Reports/Questionnaires/reportsVC.js"></script>
@endsection