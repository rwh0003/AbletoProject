@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <questionnaire :userid="{{ Auth::user()->id }}"></questionnaire>
        </div>
    </div>
</div>
@endsection
