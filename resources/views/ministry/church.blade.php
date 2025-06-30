@extends('ministry.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{__('servantry/church.header')}}</h2>
                </div>
                <div class="card-body">
                    <form name="servantry-church" method="post" action="church">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4><label for="name">{{__('servantry/church.name')}}:</label></h4>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="name" placeholder="{{__("servantry/church.name")}}"
                                           value="{{\Illuminate\Support\Arr::get($config, 'servantry.church.name')}}"
                                           class="align-center form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4><label for="street">{{__('servantry/church.street')}}:</label></h4>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="street" placeholder="{{__("servantry/church.street")}}"
                                           value="{{\Illuminate\Support\Arr::get($config, 'servantry.church.street')}}"
                                           class="align-center form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4><label for="zip">{{__('servantry/church.zip')}}:</label></h4>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="zip" placeholder="{{__("servantry/church.zip")}}"
                                           value="{{\Illuminate\Support\Arr::get($config, 'servantry.church.zip')}}"
                                           class="align-center form-control input-sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4><label class="form-check-label" for="city">{{__('servantry/church.city')}}
                                            :</label></h4>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="city" placeholder="{{__("servantry/church.city")}}"
                                           value="{{\Illuminate\Support\Arr::get($config, 'servantry.church.city')}}"
                                           class="align-center form-control input-sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4><label class="form-check-label" for="phone">{{__('servantry/church.phone')}}
                                            :</label></h4>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="phone" placeholder="{{__("servantry/church.phone")}}"
                                           value="{{\Illuminate\Support\Arr::get($config, 'servantry.church.phone')}}"
                                           class="align-center form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4><label class="form-check-label" for="email">{{__('servantry/church.email')}}
                                            :</label></h4>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="email" placeholder="{{__("servantry/church.email")}}"
                                           value="{{\Illuminate\Support\Arr::get($config, 'servantry.church.email')}}"
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
