@extends('layouts.app')

@section('content')
<div class="page-wrapper">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">{{trans('lang.area_admin_plural')}}</h3>
		</div>
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
				<li class="breadcrumb-item"><a href= "{!! route('users') !!}" >{{trans('lang.area_admin_plural')}}</a></li>
				<li class="breadcrumb-item active">{{trans('lang.user_create')}}</li>
			</ol>
		</div>
    </div>

    <div class="area-admin-form">
        @if (Session::has('message'))
            <div class="alert alert-error">{{Session::get('message')}}</div>
        @endif
        <div class="card-body">
            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
            <div class="column">
                <form method="post" action="{{ route('users.area_admin.store') }}">
                    @csrf
                    <div class="row restaurant_payout_create">
                        <div class="restaurant_payout_create-inner">
                            <fieldset>
                                <legend>{{trans('lang.area_admin_details')}}</legend>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.area_name')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control area_name" name="area_name">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.area_name_help") }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.area_admin_name')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control area_admin_name" name="area_admin_name">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.area_admin_name_help") }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.area_admin_email')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control area_admin_email" name="area_admin_email">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.area_admin_email_help") }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.area_admin_password')}}</label>
                                    <div class="col-7">
                                        <input type="password" class="form-control area_admin_password" name="area_admin_password">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.area_admin_password_help") }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.area_admin_user_name')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control area_admin_user_name" name="area_admin_user_name">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.area_admin_user_name_help") }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.area_admin_phone')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control area_admin_phone" name="area_admin_phone">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.area_admin_phone_help") }}
                                        </div>
                                    </div>
                                </div>

{{--                                <div class="form-group row width-100">--}}
{{--                                    <label class="col-3 control-label">{{trans('lang.restaurant_image')}}</label>--}}
{{--                                    <input type="file" onChange="handleFileSelect(event)" class="col-7">--}}
{{--                                    <div class="placeholder_img_thumb user_image"></div>--}}
{{--                                    <div id="uploding_image"></div>--}}
{{--                                </div>--}}
                            </fieldset>

                            {{--                    <fieldset>--}}
                            {{--                        <legend>{{trans('lang.address')}}</legend>--}}

                            {{--                        <div class="form-group row width-50">--}}
                            {{--                            <label class="col-3 control-label">{{trans('lang.address_line1')}}</label>--}}
                            {{--                            <div class="col-7">--}}
                            {{--                                <input type="text" class="form-control address_line1">--}}
                            {{--                                <div class="form-text text-muted w-50">--}}
                            {{--                                    {{ trans("lang.address_line1_help") }}--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}

                            {{--                        <div class="form-group row width-50">--}}
                            {{--                            <label class="col-3 control-label">{{trans('lang.address_line2')}}</label>--}}
                            {{--                            <div class="col-7">--}}
                            {{--                                <input type="text" class="form-control address_line2">--}}
                            {{--                                <div class="form-text text-muted w-50">--}}
                            {{--                                    {{ trans("lang.address_line2_help") }}--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}

                            {{--                        <div class="form-group row width-50">--}}
                            {{--                            <label class="col-3 control-label">{{trans('lang.city')}}</label>--}}
                            {{--                            <div class="col-7">--}}
                            {{--                                <input type="text" class="form-control city">--}}
                            {{--                                <div class="form-text text-muted w-50">--}}
                            {{--                                    {{ trans("lang.city_help") }}--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}

                            {{--                        <div class="form-group row width-50">--}}
                            {{--                            <label class="col-3 control-label">{{trans('lang.country')}}</label>--}}
                            {{--                            <div class="col-7">--}}
                            {{--                                <input type="text" class="form-control country">--}}
                            {{--                                <div class="form-text text-muted w-50">--}}
                            {{--                                    {{ trans("lang.country_help") }}--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}

                            {{--                        <div class="form-group row width-50">--}}
                            {{--                            <label class="col-3 control-label">{{trans('lang.postalcode')}}</label>--}}
                            {{--                            <div class="col-7">--}}
                            {{--                                <input type="text" class="form-control postalcode">--}}
                            {{--                                <div class="form-text text-muted w-50">--}}
                            {{--                                    {{ trans("lang.postalcode_help") }}--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}

                            {{--                        <div class="form-group row width-100">--}}
                            {{--                          <div class="col-12">--}}
                            {{--                            <h6>{{ trans("lang.know_your_cordinates") }}<a target="_blank" href="https://www.latlong.net/">{{ trans("lang.latitude_and_longitude_finder") }}</a></h6>--}}
                            {{--                          </div>--}}
                            {{--                        </div>--}}

                            {{--                        <div class="form-group row width-50">--}}
                            {{--                            <label class="col-3 control-label">{{trans('lang.user_latitude')}}</label>--}}
                            {{--                            <div class="col-7">--}}
                            {{--                                <input type="text" class="form-control user_latitude">--}}
                            {{--                                <div class="form-text text-muted w-50">--}}
                            {{--                                    {{ trans("lang.user_latitude_help") }}--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}

                            {{--                        <div class="form-group row width-50">--}}
                            {{--                            <label class="col-3 control-label">{{trans('lang.user_longitude')}}</label>--}}
                            {{--                            <div class="col-7">--}}
                            {{--                                <input type="text" class="form-control user_longitude">--}}
                            {{--                                <div class="form-text text-muted w-50">--}}
                            {{--                                    {{ trans("lang.user_longitude_help") }}--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                            {{--                    </fieldset>--}}
                        </div>
                    </div>
                    <div class="form-group col-12 text-center btm-btn" >
                        <button type="submit" class="btn btn-primary  save_user_btn" id="save_user_btn" ><i class="fa fa-save"></i> {{ trans('lang.save')}}</button>
                        <a href="{!! route('dashboard') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
                    </div>
                </form>
            </div>
        </div>

	</div>
</div>

@endsection
