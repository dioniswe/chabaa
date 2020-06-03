@extends('layouts.neutral')

@section('content')

    <div class="container" >
        <file-manager  v-bind:settings='{"readOnly": true, "mobileFriendly": true, "compactMode": true, "singleDiskMode": true}' v-bind:style="{ height: '600px' }"></file-manager>
    </div>
@endsection
@section('script')

@endsection
