@extends('user.mailboard.master.master')
@section('header','Send')
@push('route',"send")
@push('jsExtra')
    <script>
        $('.filter').css('display','none');
    </script>
@endpush

