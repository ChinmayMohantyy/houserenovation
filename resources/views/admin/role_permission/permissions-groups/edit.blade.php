@extends('admin.layouts.app')

@section('content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Permissions Groups</span></h4>
        <a class="heading-elements-toggle"><i class="icon-more"></i></a></div>
    </div>
    <div class="content">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <form method="POST" class="form-horizontal">
                    @method('PUT')
                    @csrf
                    <div class="tab-content">
                        <div id="basic-tab1" class="tab-pane active">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group"><label><span style="color: red;">*</span> Permission Groups</label> 
                                        <input type="text" name="name" value="{{@$permissiongroup->name}}" required="required"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="text-right"><button type="submit" class="btn btn-primary">SAVE<i
                                        class="icon-arrow-right14 position-right"></i></button></div>
                        </div>
                    </div>
                </form>
                <div class="heading-elements"></div>
            </div>
        </div>
    </div>
@endsection
