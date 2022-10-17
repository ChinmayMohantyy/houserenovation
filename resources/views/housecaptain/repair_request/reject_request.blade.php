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
        <form action="{{url('/housecaptain/show-reject',@$reject_request->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <table class="table table-borderless">
                    <tr>
                            <input type="hidden" name="request_id" value="{{$reject_request->id}}">
                            <td>Send Message </td>
                            <td><textarea name="reject_request" id="" cols="70" rows="5" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reject Message"></textarea></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 text-center my-3">
                {{-- <a href="{{url('/housecaptain/repair-request-data',@$reject_request->id)}}" class="btn btn-primary">Cancel</a> --}}
                <button type="submit" class="btn btn-danger">Send</button>
            </div>
        </form>
    </div>
</div>
{{-- modal --}}
 
@endsection