@extends('layouts.default')

@section('content')

     <div class="container">

        @include('pages.account.partials.details')

        <br/><br/>

        @include('pages.account.partials.password')

        <br/><br/>

        @include('pages.account.partials.type')

        <br/><br/>
        @include('pages.account.partials.delete')

        <br/><br/>
        @include('pages.account.partials.posts')

        <br/><br/>
        @include('pages.account.partials.comments')
    </div>
@stop