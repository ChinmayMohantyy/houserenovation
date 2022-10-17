@extends('admin.layouts.app')

@section('content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Assign Permission To
                    {{ strtoupper($role->name) }}</span></h4>
            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
        </div>
    </div>
    <div class="content">
        <form class="form-control" role="form" method="POST" action="/admin/role/{{ @$role->id }}/assign-permission" enctype='multipart/form-data'>
            {{ csrf_field() }}
            <div class="row">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Proposals</h5>
                    </div>
                    
                    <div class="panel-body">  
                    
                        @forelse($permissions as $permission)
                        <div class="row" style="border-bottom:solid 1px #ccc; padding:15px 0">
                            <div class="col-md-3"><strong>{{ $permission->name }}</strong></div>
                            <div class="col-md-9">
                            @foreach ($permission->permission as $item)
                            <label class="checkbox checkbox-inline" for="permission-{{ $item->id }}" style="margin-top:5px">
                            <input type="checkbox" name="permission[]" value="{{ $item->id }}" id="permission-{{ $item->id }}" @if ($role->hasPermissionTo($item->id)) checked @endif>
                                <i class="input-helper"></i> 
                                {{ $item->slug }}
                            </label>
                            @endforeach
                            </div>
                        </div>         
                        @empty
                            <p>No Permissions Added Yet !</p>
                        @endforelse
                        <div class="row" style="margin-top:30px">
                            <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary legitRipple">
                                    Assign
                                </button>
                                <a href="{{ url('/admin/roles') }}" class="btn btn-danger legitRipple">
                                    Cancel
                                </a>
                            </div>
                        </div>                 
                    </div>                 
                </div>               
            </div>
        </form>
    </div>

   
@endsection
