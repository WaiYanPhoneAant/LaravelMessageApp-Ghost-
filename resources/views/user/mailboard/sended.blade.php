@extends('user.mailboard.master.master')
@push('route',"send")
@push('jsExtra')
    <script>
        $('.filter').css('display','none');
    </script>
@endpush

