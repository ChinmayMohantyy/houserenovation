@extends('housecaptain.layouts.app')
@section('content')
<div class="card p-2">
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success no-border">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                        class="sr-only">Close</span></button>
                <span class="text-semibold">Well done!</span> {{session('success')}}.
            </div>
            @endif
            @if(session('failure'))
            <div class="alert alert-danger no-border">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                        class="sr-only">Close</span></button>
                <span class="text-semibold">Oh snap!</span> {{session('failure')}}.
            </div>
            @endif
        </div>
        <form action="{{url('/housecaptain/save-next',@$reject_request_data->id)}}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="row ml-2">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">Accept</button>
                </div>
                <div class="col-md-6">
                    <a href="{{url('/housecaptain/reject',$reject_request_data->id)}}" class="btn btn-danger but_submit" id="">Reject</a>
                </div>
            </div>

        </form>
    </div>
</div>
{{-- modal --}}
 
@endsection