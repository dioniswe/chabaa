@extends('management.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{__('management/church.header')}}</h2>
                </div>
                <div class="card-body">
                    <form name="management-church" method="post" action="church">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4><label for="name">{{__('management/church.name')}}:</label></h4>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="name" placeholder="{{__("management/church.name")}}"
                                           value="{{\Illuminate\Support\Arr::get($config, 'management.church.name')}}"
                                           class="align-center form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4><label for="street">{{__('management/church.street')}}:</label></h4>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="street" placeholder="{{__("management/church.street")}}"
                                           value="{{\Illuminate\Support\Arr::get($config, 'management.church.street')}}"
                                           class="align-center form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4><label for="zip">{{__('management/church.zip')}}:</label></h4>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="zip" placeholder="{{__("management/church.zip")}}"
                                           value="{{\Illuminate\Support\Arr::get($config, 'management.church.zip')}}"
                                           class="align-center form-control input-sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4><label class="form-check-label" for="zip">{{__('management/church.city')}}
                                            :</label></h4>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="city" placeholder="{{__("management/church.city")}}"
                                           value="{{\Illuminate\Support\Arr::get($config, 'management.church.city')}}"
                                           class="align-center form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
