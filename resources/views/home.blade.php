@extends('layouts.app')

@section('content')
<div class="container">
    
    @foreach ($questions as $question)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <question-module 
                    :questionid="{{ $question->id }}" 
                    :userid="{{ Auth::user()->id }}">    
                </question-module>
            </div>
        </div>
    @endforeach

</div>
@endsection
