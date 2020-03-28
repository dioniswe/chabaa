@extends('layouts.neutral')

@section('content')

@endsection
@section('script')
    @if (count($files)==0)

        <div class="alert alert-warning">{{__("keine Datensätze vorhanden")}}</div>

    @else
        <table class="table table-condensed table-striped">
            <tr>
                <th>Name</th>
            </tr>
            @foreach($files as $file)
                <tr>
                    <td >
                        {{ $file->name }}
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection
