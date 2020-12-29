@extends('layouts.neutral-including-app-js')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {!! __('Termine/Abkündigungen') !!}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="any_count">
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('Id') !!}</th>
                                    <th>{!! trans('Datum') !!}</th>
                                    <th>{!! trans('Veranstaltung') !!}</th>
                                    <th>{!! trans('Prediger') !!}</th>
                                    <th>{!! trans('Einleitung') !!}</th>
                                    <th>{!! trans('Techniker') !!}</th>
                                    <th>{!! trans('Kinderstunde') !!}</th>
                                    <th>Sonstiges</th>
                                    <th>Verschiedenes</th>
                                    <th>veröffentlichen</th>
                                    <th>mit Abendmahl</th>
                                </tr>
                                </thead>
                                <tbody id="appointed_dates_table">
                                @foreach($appointedDates as $appointedDate)
                                    <tr>
                                        <td>{{$appointedDate->id}}</td>
                                        <td>{{$appointedDate->date}}</td>
                                        <td>{{$appointedDate->subject}}</td>
                                        <td>{{$appointedDate->preacher}}</td>
                                        <td>{{$appointedDate->technician}}</td>
                                        <td>{{$appointedDate->childrens_ministry}}</td>
                                        <td>{{$appointedDate->other_notes}}</td>
                                        <td>{{$appointedDate->miscellaneous}}</td>
                                        <td>{{$appointedDate->publish}}</td>
                                        <td>{{$appointedDate->communion}}</td>

                                        <td class="hidden-sm hidden-xs hidden-md">{{$appointedDate->created_at}}</td>
                                        <td class="hidden-sm hidden-xs hidden-md">{{$appointedDate->updated_at}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('users/' . $appointedDate->id) }}" data-toggle="tooltip" title="{!! trans('show') !!}">
                                                {!! trans('laravelusers::laravelusers.buttons.show') !!}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
@endsection
