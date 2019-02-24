@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chat between {{ $user1->name }} and {{ $user2->name }}</div>

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
                            @if($m->id_to == $user1->id)
                                <div class="float-right">{{$m->name}}</div>
                            @else
                                {{$m->name}}
                            @endif
                        </div>
                        <div class="card-body">
                            @if($m->id_to == $user1->id)
                                <div class="float-right">{{$m->text}}</div>
                            @else
                                {{$m->text}}
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
