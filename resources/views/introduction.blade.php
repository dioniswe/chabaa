@extends('layouts.neutral')

@section('content')
        <form name="introduction" method="post" action="introduction">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        Hier kannst du deinen Namen bekanntgeben?

                        <div class="input-group"><br>
                            <input type="text" name="name" value="Gast" class="align-center form-control input-sm"
                                   placeholder="">
                        </div>
                    </div>
                </div>
                <input type="submit" value="Weiter" class="btn btn-primary btn-sm">
            </div>
        </form>
@endsection
