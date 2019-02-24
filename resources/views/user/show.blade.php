@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                @if($user->is_delete)
                <div class="alert alert-warning" role="alert">
                    This user is delete.
                </div>
                @endif
            <div class="card">
                <div class="card-header">Chat with {{ $user->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('errors')
                    @foreach ($messages as $m)
                    <div class="card mt-1">
                        <div class="card-header">
                            @if($m->id_to == $id_to)
                                <div class="float-right">{{$m->name}}</div>
                            @else
                                {{$m->name}}
                            @endif
                        </div>
                        <div class="card-body">
                            @if($m->id_to == $id_to)
                                <div class="float-right">{{$m->text}}</div>
                            @else
                                {{$m->text}}
                            @endif
                        </div>
                    </div>
                    @endforeach
                    @if( ! $user->is_delete)
                    <form action="/user/{{ $id_to }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea class="form-control mt-1" name="message" rows="5"></textarea>
                            <button type="submit" class="btn btn-success float-right mt-1">
                                <i class="fa fa-plus"></i>
                                Post
                            </button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @if($is_admin)
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Correspondences {{ $user->name }}</div>
                <div class="card-body">
                    <ul>
                    @foreach ($users as $u)
                        <li><a href="{{$user->id}}/{{$u->id}}">{{$u->name}}</a></li>
                    @endforeach
                    </ul>
                </div>
            </div>
            @if( ! $user->is_delete)
            <form action="/user/delete/{{ $id_to }}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <button type="submit" class="btn btn-warning float-right mt-1">
                        <i class="fa fa-plus"></i>
                        Delete User - {{ $user->name }}
                    </button>
                </div>
            </form>
            @else
            <form action="/user/recovery/{{ $id_to }}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <button type="submit" class="btn btn-success float-right mt-1">
                        <i class="fa fa-plus"></i>
                        Recovery User - {{ $user->name }}
                    </button>
                </div>
            </form>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection
