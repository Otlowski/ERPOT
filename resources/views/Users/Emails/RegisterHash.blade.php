@extends('AppBase.Emails.BaseLayout')

@section('header')

{{$header}}

@endsection


@section('content')

<div>

    Hi {{$name}}. <br />
    To activate Your account click at the link: 
    <a href="{{$link}}">Verify!</a>
    
</div>

@endsection