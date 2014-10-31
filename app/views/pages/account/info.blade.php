@extends('layouts.default')

@section('content')

     <div class="container">

        @include('pages.account.partials.details')

        <br/><br/>

        @include('pages.account.partials.password')

        <br/><br/>

        @include('pages.account.partials.delete')
    </div>
@stop