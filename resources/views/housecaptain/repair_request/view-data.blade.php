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
        <form action="{{url('/housecaptain/show-interest',@$repair_request->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <table class="table table-borderless">
                    {{-- <tr>
                        <td>Document</td> --}}
                        {{-- <td><a href="{{asset('/verification_documents/'.$repair_request->verification_document)}}" target="_blank" class="text-success">Click Here</a></td> --}}
                        {{-- <td>
                           @foreach(explode(',', $repair_request->verification_document) as $data)
                                <img src="/verification_documents/{{@$data}}"
                                style="height: 100px;width:100px"alt="">
                            @endforeach
                           
                        </td>
                    </tr> --}}
                    {{-- <tr>
                        <td>Verification Data</td>
                        <td>{{@$repair_request->verification_data}}
                        <p>@if(@$repair_request->verification_data == '') N/a @endif</p></td>
                    </tr> --}}
                    {{-- <tr>
                        <td>Add Order</td>
                        <td><a href="{{url('/housecaptain/add-order',@$repair_request->id)}}" class="text-primary">Add Order</a><br>
                        <small style="color: rgba(64, 64, 58, 0.345)">If you are intrested add your order</small>
                        </td>
                    </tr> --}}
                    @if(@$repair_request->housecaptain_inspection_id == '')
                    @else
                        <tr>
                            <td>Upload Inspection Image<span style="color: red">*</span></td>
                            <td><input type="file" name="upload_image[]" value="" multiple></td>
                        </tr>
                        <tr>
                                <td>Add Notes<span style="color: red">*</span></td>
                                <td><textarea name="housecaptain_feedback" id="" cols="70" rows="5" required></textarea></td>
                        </tr>
                    @endif
                </table>
            </div>
            <div class="col-md-12 text-center my-3">
                @if (@$repair_request->rejected_house_captains == '')
                    @if(@$repair_request->housecaptain_inspection_id == '')
                    <a href="{{url('/housecaptain/inspection',@$repair_request->id)}}" class="btn btn-primary" onclick="myFunction()">Go to Inspection</a>
                    @else
                    {{-- <button type="submit" class="btn btn-success">Accept</button> --}}
                    <button type="submit" class="btn btn-success">Next</button>

                    {{-- <a href="{{url('/housecaptain/reject',@$repair_request->id)}}" class="btn btn-danger but_submit" id="">Reject</a> --}}
                    @endif
                @else
                <a href="#" class="btn btn-danger">Already Rejected</a>
                @endif

            </div>
        </form>
    </div>
</div>
{{-- modal --}}
 
@endsection

@section('scripts')
<script>
    function imagePreview(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#imagePreviewSrc').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }
  
    $("#imagePreview").change(function() {
        imagePreview(this);
    });
//    ajax

</script>
@endsection