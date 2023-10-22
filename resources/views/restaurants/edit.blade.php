@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.restaurant_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a
                        href="{!! route('restaurants') !!}">{{trans('lang.restaurant_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.restaurant_edit')}}</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="resttab-sec">
                    <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                    <div class="error_top"></div>
                    <div class="row restaurant_payout_create">
                        <div class="restaurant_payout_create-inner">
                            @if ($role == trans('lang.role_super'))
                            <fieldset>
                                <legend>{{trans('lang.area_admin')}}</legend>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.area_admin_email')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control area_admin_email">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.area_admin_email_help") }}
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            @endif

                            <fieldset>
                                <legend>{{trans('lang.admin_area')}}</legend>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.first_name')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control user_first_name" required>
                                        <div class="form-text text-muted">
                                            {{ trans("lang.user_first_name_help") }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.last_name')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control user_last_name">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.user_last_name_help") }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.email')}}</label>
                                    <div class="col-7">
                                        <input type="email" class="form-control user_email" required>
                                        <div class="form-text text-muted">
                                            {{ trans("lang.user_email_help") }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.password')}}</label>
                                    <div class="col-7">
                                        <input type="password" class="form-control user_password" required>
                                        <div class="form-text text-muted">
                                            {{ trans("lang.user_password_help") }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.user_phone')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control user_phone">
                                        <div class="form-text text-muted w-50">
                                            {{ trans("lang.user_phone_help") }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_image')}}</label>
                                    <input type="file" onChange="handleFileSelectowner(event,'vendor')"
                                           class="col-7">
                                    <div id="uploding_image_owner"></div>
                                    <div class="uploaded_image_owner" style="display:none;">
                                        <img id="uploaded_image_owner" src="" width="150px" height="150px;">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>{{trans('lang.restaurant_details')}}</legend>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_name')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control restaurant_name">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.restaurant_name_help") }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_cuisines')}}</label>
                                    <div class="col-7">
                                        <select id='restaurant_cuisines' class="form-control">
                                            <option value="">Select Cuisines</option>
                                        </select>
                                        <div class="form-text text-muted">
                                            {{ trans("lang.restaurant_cuisines_help") }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_phone')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control restaurant_phone">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.restaurant_phone_help") }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_address')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control restaurant_address">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.restaurant_address_help") }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-100">
                                    <div class="col-12">
                                        <h6>
                                            * Don't Know your cordinates ? use
                                            <a target="_blank" href="https://www.latlong.net/">Latitude and Longitude Finder</a>
                                        </h6>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_latitude')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control restaurant_latitude">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.restaurant_latitude_help") }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_longitude')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control restaurant_longitude">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.restaurant_longitude_help") }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-100">
                                    <label class="col-3 control-label ">{{trans('lang.restaurant_description')}}</label>
                                    <div class="col-7">
                                        <textarea rows="7" class="restaurant_description form-control" id="restaurant_description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_image')}}</label>
                                    <div class="col79">
                                        <input type="file" onChange="handleFileSelect(event,'photo')">
                                        <div id="uploding_image"></div>
                                        <div class="uploaded_image" style="display:none;">
                                            <img id="uploaded_image" src="" width="150px" height="150px;">
                                        </div>
                                        <div class="form-text text-muted">
                                            {{ trans("lang.restaurant_image_help") }}
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>{{trans('lang.gallery')}}</legend>
                                <div class="form-group row width-50 restaurant_image">
                                    <div class="">
                                        <div id="photos"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div>
                                        <input type="file" onChange="handleFileSelect(event,'photos')">
                                        <div id="uploding_image_photos"></div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>{{trans('lang.services')}}</legend>
                                <div class="form-group row">
                                    <div class="form-check width-100">
                                        <input type="checkbox" id="Free_Wi_Fi">
                                        <label class="col-3 control-label" for="Free_Wi_Fi">Free Wi-Fi</label>
                                    </div>
                                    <div class="form-check width-100">
                                        <input type="checkbox" id="Good_for_Breakfast">
                                        <label class="col-3 control-label" for="Good_for_Breakfast">Good for Breakfast</label>
                                    </div>
                                    <div class="form-check width-100">
                                        <input type="checkbox" id="Good_for_Dinner">
                                        <label class="col-3 control-label" for="Good_for_Dinner">Good for Dinner</label>
                                    </div>
                                    <div class="form-check width-100">
                                        <input type="checkbox" id="Good_for_Lunch">
                                        <label class="col-3 control-label" for="Good_for_Lunch">Good for Lunch</label>
                                    </div>
                                    <div class="form-check width-100">
                                        <input type="checkbox" id="Live_Music">
                                        <label class="col-3 control-label" for="Live_Music">Live Music</label>
                                    </div>
                                    <div class="form-check width-100">
                                        <input type="checkbox" id="Outdoor_Seating">
                                        <label class="col-3 control-label" for="Outdoor_Seating">Outdoor Seating</label>
                                    </div>
                                    <div class="form-check width-100">
                                        <input type="checkbox" id="Takes_Reservations">
                                        <label class="col-3 control-label" for="Takes_Reservations">Takes Reservations</label>
                                    </div>
                                    <div class="form-check width-100">
                                        <input type="checkbox" id="Vegetarian_Friendly">
                                        <label class="col-3 control-label" for="Vegetarian_Friendly">Vegetarian Friendly</label>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>{{trans('lang.timing')}}</legend>
                                <div class="form-group row">
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                        <div class="col-7">
                                            <input type="time" class="form-control" id="opentime" required>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                        <div class="col-7">
                                            <input type="time" class="form-control" id="closetime" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>{{trans('lang.restaurant_status')}}</legend>
                                <div class="form-group row">
                                    <div class="form-group row width-50">
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="is_open">
                                            <label class="col-3 control-label" for="is_open">{{trans('lang.Is_Open')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>{{trans('restaurant')}} {{trans('lang.active_deactive')}}</legend>
                                <div class="form-group row">
                                    <div class="form-group row width-50">
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="is_active">
                                            <label class="col-3 control-label" for="is_active">{{trans('lang.active')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>{{trans('lang.dine_in_future_setting')}}</legend>
                                <div class="form-group row">
                                    <div class="form-group row width-100">
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="dine_in_feature" class="">
                                            <label class="col-3 control-label" for="dine_in_feature">{{trans('lang.enable_dine_in_feature')}}</label>
                                        </div>
                                    </div>
                                    <div class="divein_div" style="display:none">
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                            <div class="col-7">
                                                <input type="time" class="form-control" id="openDineTime" required>
                                            </div>
                                        </div>

                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                            <div class="col-7">
                                                <input type="time" class="form-control" id="closeDineTime" required>
                                            </div>
                                        </div>
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">Cost</label>
                                            <div class="col-7">
                                                <input type="number" class="form-control restaurant_cost" required>
                                            </div>
                                        </div>
                                        <div class="form-group row width-100 restaurant_image">
                                            <label class="col-3 control-label">Menu Card Images</label>
                                            <div class="">
                                                <div id="photos_menu_card"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div>
                                                <input type="file" onChange="handleFileSelectMenuCard(event)">
                                                <div id="uploaded_image_menu"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>{{trans('lang.deliveryCharge')}}</legend>

                                <div class="form-group row">
                                    <div class="form-group row width-100">
                                        <label class="col-4 control-label">{{ trans('lang.delivery_charges_per_km')}}</label>
                                        <div class="col-7">
                                            <input type="number" class="form-control" id="delivery_charges_per_km">
                                        </div>
                                    </div>
                                    <div class="form-group row width-100">
                                        <label class="col-4 control-label">{{ trans('lang.minimum_delivery_charges')}}</label>
                                        <div class="col-7">
                                            <input type="number" class="form-control" id="minimum_delivery_charges">
                                        </div>
                                    </div>
                                    <div class="form-group row width-100">
                                        <label class="col-4 control-label">{{ trans('lang.minimum_delivery_charges_within_km')}}</label>
                                        <div class="col-7">
                                            <input type="number" class="form-control" id="minimum_delivery_charges_within_km">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>{{trans('lang.bankdetails')}}</legend>
                                <div class="form-group row">
                                    <div class="form-group row width-100">
                                        <label class="col-4 control-label">{{ trans('lang.bank_name') }}</label>
                                        <div class="col-7">
                                            <input type="text" name="bank_name" class="form-control" id="bankName">
                                        </div>
                                    </div>
                                    <div class="form-group row width-100">
                                        <label class="col-4 control-label">{{ trans('lang.branch_name') }}</label>
                                        <div class="col-7">
                                            <input type="text" name="branch_name" class="form-control" id="branchName">
                                        </div>
                                    </div>
                                    <div class="form-group row width-100">
                                        <label class="col-4 control-label">{{ trans('lang.holer_name') }}</label>
                                        <div class="col-7">
                                            <input type="text" name="holer_name" class="form-control" id="holderName">
                                        </div>
                                    </div>
                                    <div class="form-group row width-100">
                                        <label class="col-4 control-label">{{ trans('lang.account_number') }}</label>
                                        <div class="col-7">
                                            <input type="text" name="account_number" class="form-control" id="accountNumber">
                                        </div>
                                    </div>
                                    <div class="form-group row width-100">
                                        <label class="col-4 control-label">{{ trans('lang.other_information') }}</label>
                                        <div class="col-7">
                                            <input type="text" name="other_information" class="form-control" id="otherDetails">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-12 text-center btm-btn">
                <button type="button" class="btn btn-primary  save_restaurant_btn"><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
                <a href="{!! route('restaurants') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/compressorjs/1.1.1/compressor.min.js"
        integrity="sha512-VaRptAfSxXFAv+vx33XixtIVT9A/9unb1Q8fp63y1ljF+Sbka+eMJWoDAArdm7jOYuLQHVx5v60TQ+t3EA8weA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script>
    var id = "<?php echo $id;?>";
    var role = "<?php echo $role; ?>";
    var area_admins = <?php echo $area_admins; ?>;
    var admin_id;

    var database = firebase.firestore();
    var ref_deliverycharge = database.collection('settings').doc("DeliveryCharge");
    var ref = database.collection('vendors').where("id", "==", id);
    var photo = "";
    var restaurnt_photos = "";
    var restaurantOwnerId = "";
    var restaurantOwnerOnline = false;
    var photocount = 0;
    var restaurantPhoto = '';
    var ownerPhoto = '';
    var ownerId = '';
    var menuPhotoCount = 0;
    var restaurantMenuPhotos = "";
    var restaurant_menu_photos = [];
    var placeholderImage = '';
    var placeholder = database.collection('settings').doc('placeHolderImage');
    placeholder.get().then(async function (snapshotsimage) {
        var placeholderImageData = snapshotsimage.data();
        placeholderImage = placeholderImageData.image;
    })


    ref_deliverycharge.get().then(async function (snapshots_charge) {
        var deliveryChargeSettings = snapshots_charge.data();
        try {
            if (deliveryChargeSettings.vendor_can_modify) {
                $("#delivery_charges_per_km").val(deliveryChargeSettings.delivery_charges_per_km);
                $("#minimum_delivery_charges").val(deliveryChargeSettings.minimum_delivery_charges);
                $("#minimum_delivery_charges_within_km").val(deliveryChargeSettings.minimum_delivery_charges_within_km);
            } else {
                $("#delivery_charges_per_km").val(deliveryChargeSettings.delivery_charges_per_km);
                $("#minimum_delivery_charges").val(deliveryChargeSettings.minimum_delivery_charges);
                $("#minimum_delivery_charges_within_km").val(deliveryChargeSettings.minimum_delivery_charges_within_km);
                $("#delivery_charges_per_km").prop('disabled', true);
                $("#minimum_delivery_charges").prop('disabled', true);
                $("#minimum_delivery_charges_within_km").prop('disabled', true);
            }
        } catch (error) {

        }
    });

    $(document).ready(function () {
        jQuery("#data-table_processing").show();
        ref.get().then(async function (snapshots) {
            try {
                var restaurant = snapshots.docs[0].data();

                admin_id = restaurant.admin_id;
                if (role == 'super') {
                    for (i = 0 ; i < area_admins.length ; i ++) {
                        if (admin_id == area_admins[i].id) {
                            $(".area_admin_email").val(area_admins[i].email);
                        }
                    }
                }

                $(".restaurant_name").val(restaurant.title);
                if (restaurant.filters) {
                    $(".restaurant_cuisines").val(restaurant.filters.Cuisine);
                }
                $(".restaurant_address").val(restaurant.location);
                $(".restaurant_latitude").val(restaurant.latitude);
                $(".restaurant_longitude").val(restaurant.longitude);
                $(".restaurant_description").val(restaurant.description);
                if (restaurant.photo) {
                    if (restaurant.photo != '') {
                        $("#uploaded_image").attr('src', restaurant.photo);
                        $(".uploaded_image").show();
                    } else {
                        $("#uploaded_image").attr('src', placeholderImage);
                        $(".uploaded_image").show();
                    }
                } else {
                    $("#uploaded_image").attr('src', placeholderImage);
                    $(".uploaded_image").show();
                }

                if (restaurant.opentime) {
                    restaurant.opentime = moment(restaurant.opentime, 'hh:mm A').format('HH:mm');
                }

                if (restaurant.closetime) {
                    restaurant.closetime = moment(restaurant.closetime, 'hh:mm A').format('HH:mm');
                }
                $("#opentime").val(restaurant.opentime);
                $("#closetime").val(restaurant.closetime);

                if (restaurant.openDineTime) {
                    restaurant.openDineTime = moment(restaurant.openDineTime, 'hh:mm A').format('HH:mm');
                }

                if (restaurant.closeDineTime) {
                    restaurant.closeDineTime = moment(restaurant.closeDineTime, 'hh:mm A').format('HH:mm');
                }
                $("#openDineTime").val(restaurant.openDineTime);
                $("#closeDineTime").val(restaurant.closeDineTime);


                if (restaurant.reststatus) {
                    $("#is_open").prop("checked", true);
                }

                if (restaurant.hasOwnProperty('enabledDiveInFuture')) {
                    if (restaurant.enabledDiveInFuture) {
                        $("#dine_in_feature").prop("checked", true);
                    }
                }

                restaurantPhoto = restaurant.photo;
                if (restaurant.hasOwnProperty('restaurantMenuPhotos')) {
                    restaurantMenuPhotos = restaurant.restaurantMenuPhotos;
                }

                if (restaurant.hasOwnProperty('restaurantCost')) {
                    $(".restaurant_cost").val(restaurant.restaurantCost);
                }

                for (var key in restaurant.filters) {

                    if (key == "Free Wi-Fi" && restaurant.filters[key] == "Yes") {
                        $("#Free_Wi_Fi").prop("checked", true);
                    }
                    if (key == "Good for Breakfast" && restaurant.filters[key] == "Yes") {
                        $("#Good_for_Breakfast").prop("checked", true);
                    }
                    if (key == "Good for Dinner" && restaurant.filters[key] == "Yes") {
                        $("#Good_for_Dinner").prop("checked", true);
                    }
                    if (key == "Good for Lunch" && restaurant.filters[key] == "Yes") {
                        $("#Good_for_Lunch").prop("checked", true);
                    }
                    if (key == "Live Music" && restaurant.filters[key] == "Yes") {
                        $("#Live_Music").prop("checked", true);
                    }
                    if (key == "Outdoor Seating" && restaurant.filters[key] == "Yes") {
                        $("#Outdoor_Seating").prop("checked", true);
                    }
                    if (key == "Takes Reservations" && restaurant.filters[key] == "Yes") {
                        $("#Takes_Reservations").prop("checked", true);
                    }
                    if (key == "Vegetarian Friendly" && restaurant.filters[key] == "Yes") {
                        $("#Vegetarian_Friendly").prop("checked", true);
                    }

                }

                restaurnt_photos = restaurant.photos;
                var photos = '';
                var menuCardPhotos = ''
                restaurant.photos.forEach((photo) => {
                    photocount++;
                    photos = photos + '<span class="image-item" id="photo_' + photocount + '"><span class="remove-btn remove-photo-btn" data-id="' + photocount + '" data-img="' + photo + '"><i class="fa fa-remove"></i></span><img width="100px" id="" height="auto" src="' + photo + '"></span>';
                })
                if (photos) {
                    $("#photos").html(photos);
                } else {
                    $("#photos").html('<p>photos not available.</p>');
                }
                if (restaurant.hasOwnProperty('restaurantMenuPhotos')) {
                    restaurant_menu_photos = restaurant.restaurantMenuPhotos;
                    restaurant.restaurantMenuPhotos.forEach((photo) => {
                        menuPhotoCount++;
                        menuCardPhotos = menuCardPhotos + '<span class="image-item" id="photo_menu' + menuPhotoCount + '"><span class="remove-btn remove-menu-btn" data-id="' + menuPhotoCount + '" data-img="' + photo + '"><i class="fa fa-remove"></i></span><img width="100px" id="" height="auto" src="' + photo + '"></span>';
                    })
                }

                if (menuCardPhotos) {
                    $("#photos_menu_card").html(menuCardPhotos);
                } else {
                    $("#photos_menu_card").html('<p>Menu card photos not available.</p>');
                }

                restaurantOwnerOnline = restaurant.isActive;
                if (restaurant.hasOwnProperty('enabledDiveInFuture') && restaurant.enabledDiveInFuture == true) {
                    $(".divein_div").show();
                }

                photo = restaurant.photo;
                restaurantOwnerId = restaurant.author;
                await database.collection('users').where("id", "==", restaurant.author).get().then(async function (snapshots) {
                    snapshots.docs.forEach((listval) => {
                        var user = listval.data();
                        // $(".restaurant_owners").val(user.firstName+" "+user.lastName);
                        ownerId = user.id;
                        ownerphoto = user.profilePictureURL
                        $(".user_first_name").val(user.firstName);
                        $(".user_last_name").val(user.lastName);
                        $(".user_email").val(user.email);
                        $(".user_phone").val(user.phoneNumber);
                        if (user.profilePictureURL != '') {
                            $("#uploaded_image_owner").attr('src', user.profilePictureURL);
                            $(".uploaded_image_owner").show();
                        } else {
                            $("#uploaded_image_owner").attr('src', placeholderImage);
                            $(".uploaded_image_owner").show();
                        }

                        if (user.active) {
                            restaurant_active = true;
                            $("#is_active").prop("checked", true);
                        }

                        if (user.userBankDetails) {
                            if (user.userBankDetails.bankName != undefined) {
                                $("#bankName").val(user.userBankDetails.bankName);
                            }
                            if (user.userBankDetails.branchName != undefined) {
                                $("#branchName").val(user.userBankDetails.branchName);
                            }
                            if (user.userBankDetails.holderName != undefined) {
                                $("#holderName").val(user.userBankDetails.holderName);
                            }
                            if (user.userBankDetails.accountNumber != undefined) {
                                $("#accountNumber").val(user.userBankDetails.accountNumber);
                            }
                            if (user.userBankDetails.otherDetails != undefined) {
                                $("#otherDetails").val(user.userBankDetails.otherDetails);
                            }
                        }
                    })
                });

                await database.collection('vendor_categories').get().then(async function (snapshots) {
                    snapshots.docs.forEach((listval) => {
                        var data = listval.data();
                        if (data.id == restaurant.categoryID) {
                            $('#restaurant_cuisines').append($("<option selected></option>")
                                .attr("value", data.id)
                                .text(data.title));
                        } else {
                            $('#restaurant_cuisines').append($("<option></option>")
                                .attr("value", data.id)
                                .text(data.title));
                        }
                    })

                });

                if (restaurant.hasOwnProperty('phonenumber')) {
                    $(".restaurant_phone").val(restaurant.phonenumber);
                }
                if (restaurant.DeliveryCharge) {
                    $("#delivery_charges_per_km").val(restaurant.DeliveryCharge.delivery_charges_per_km);
                    $("#minimum_delivery_charges").val(restaurant.DeliveryCharge.minimum_delivery_charges);
                    $("#minimum_delivery_charges_within_km").val(restaurant.DeliveryCharge.minimum_delivery_charges_within_km);
                }
            } catch (error) {
            }
            jQuery("#data-table_processing").hide();
        })

        $(".save_restaurant_btn").click(function () {

            var is_disable_delete = "<?php echo env('IS_DISABLE_DELETE', 0); ?>";
            if (is_disable_delete == 1) {
                alert("Do not alllow to change in demo content !");
                return false;
            }

            var restaurantname = $(".restaurant_name").val();
            var cuisines = $("#restaurant_cuisines option:selected").val();
            var address = $(".restaurant_address").val();
            var latitude = parseFloat($(".restaurant_latitude").val());
            var longitude = parseFloat($(".restaurant_longitude").val());
            var description = $(".restaurant_description").val();
            var phonenumber = $(".restaurant_phone").val();
            var categoryTitle = $("#restaurant_cuisines option:selected").text();

            var userFirstName = $(".user_first_name").val();
            var userLastName = $(".user_last_name").val();
            var email = $(".user_email").val();
            var userPhone = $(".user_phone").val();
            var enabledDiveInFuture = $("#dine_in_feature").is(':checked');
            var reststatus = false;
            var restaurantCost = $(".restaurant_cost").val();

            if ($("#is_open").is(':checked')) {
                reststatus = true;
            }
            var restaurant_active = false;
            if ($("#is_active").is(':checked')) {
                restaurant_active = true;
            }

            var opentime = $("#opentime").val();
            var opentime_val = $("#opentime").val();
            if (opentime) {
                opentime = new Date('1970-01-01T' + opentime + 'Z')
                    .toLocaleTimeString('en-US',
                        {timeZone: 'UTC', hour12: true, hour: 'numeric', minute: 'numeric'}
                    );
            }

            var closetime = $("#closetime").val();
            var closetime_val = $("#closetime").val();
            if (closetime) {
                closetime = new Date('1970-01-01T' + closetime + 'Z')
                    .toLocaleTimeString('en-US',
                        {timeZone: 'UTC', hour12: true, hour: 'numeric', minute: 'numeric'}
                    );
            }

            var openDineTime = $("#openDineTime").val();
            var openDineTime_val = $("#openDineTime").val();
            if (openDineTime) {
                openDineTime = new Date('1970-01-01T' + openDineTime + 'Z')
                    .toLocaleTimeString('en-US',
                        {timeZone: 'UTC', hour12: true, hour: 'numeric', minute: 'numeric'}
                    );
            }

            var closeDineTime = $("#closeDineTime").val();
            var closeDineTime_val = $("#closeDineTime").val();
            if (closeDineTime) {
                closeDineTime = new Date('1970-01-01T' + closeDineTime + 'Z')
                    .toLocaleTimeString('en-US',
                        {timeZone: 'UTC', hour12: true, hour: 'numeric', minute: 'numeric'}
                    );
            }

            // coordinates=new firebase.firestore.GeoPoint(latitude,longitude);

            var Free_Wi_Fi = "No";
            if ($("#Free_Wi_Fi").is(':checked')) {
                Free_Wi_Fi = "Yes";
            }
            var Good_for_Breakfast = "No";
            if ($("#Good_for_Breakfast").is(':checked')) {
                Good_for_Breakfast = "Yes";
            }
            var Good_for_Dinner = "No";
            if ($("#Good_for_Dinner").is(':checked')) {
                Good_for_Dinner = "Yes";
            }
            var Good_for_Lunch = "No";
            if ($("#Good_for_Lunch").is(':checked')) {
                Good_for_Lunch = "Yes";
            }
            var Live_Music = "No";
            if ($("#Live_Music").is(':checked')) {
                Live_Music = "Yes";
            }
            var Outdoor_Seating = "No";
            if ($("#Outdoor_Seating").is(':checked')) {
                Outdoor_Seating = "Yes";
            }
            var Takes_Reservations = "No";
            if ($("#Takes_Reservations").is(':checked')) {
                Takes_Reservations = "Yes";
            }
            var Vegetarian_Friendly = "No";
            if ($("#Vegetarian_Friendly").is(':checked')) {
                Vegetarian_Friendly = "Yes";
            }

            var filters_new = {
                "Free Wi-Fi": Free_Wi_Fi,
                "Good for Breakfast": Good_for_Breakfast,
                "Good for Dinner": Good_for_Dinner,
                "Good for Lunch": Good_for_Lunch,
                "Live Music": Live_Music,
                "Outdoor Seating": Outdoor_Seating,
                "Takes Reservations": Takes_Reservations,
                "Vegetarian Friendly": Vegetarian_Friendly
            };

            if (userFirstName == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.enter_owners_name_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (userPhone == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.enter_owners_phone')}}</p>");
                window.scrollTo(0, 0);
            } else if (restaurantname == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.restaurant_name_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (cuisines == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.restaurant_cuisine_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (phonenumber == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.restaurant_phone_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (address == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.restaurant_address_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (isNaN(latitude)) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.restaurant_lattitude_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (latitude < -90 || latitude > 90) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.restaurant_lattitude_limit_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (isNaN(longitude)) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.restaurant_longitude_error')}}</p>");
                window.scrollTo(0, 0);

            } else if (longitude < -180 || longitude > 180) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.restaurant_longitude_limit_error')}}</p>");
                window.scrollTo(0, 0);

            } else if (description == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.restaurant_description_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (opentime == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.restaurant_opentime_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (closetime == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.restaurant_closetime_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (opentime_val > closetime_val) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.restaurant_opentime_closetime_error')}}</p>");
                window.scrollTo(0, 0);
            } else {
                var bankName = $("#bankName").val();
                var branchName = $("#branchName").val();
                var holderName = $("#holderName").val();
                var accountNumber = $("#accountNumber").val();
                var otherDetails = $("#otherDetails").val();
                var userBankDetails = {
                    'bankName': bankName,
                    'branchName': branchName,
                    'holderName': holderName,
                    'accountNumber': accountNumber,
                    'accountNumber': accountNumber,
                    'otherDetails': otherDetails,
                };

                var delivery_charges_per_km = parseInt($("#delivery_charges_per_km").val());
                var minimum_delivery_charges = parseInt($("#minimum_delivery_charges").val());
                var minimum_delivery_charges_within_km = parseInt($("#minimum_delivery_charges_within_km").val());
                var DeliveryCharge = {
                    'delivery_charges_per_km': delivery_charges_per_km,
                    'minimum_delivery_charges': minimum_delivery_charges,
                    'minimum_delivery_charges_within_km': minimum_delivery_charges_within_km
                };
                coordinates = new firebase.firestore.GeoPoint(latitude, longitude);

                database.collection('users').doc(ownerId).update({
                    'firstName': userFirstName,
                    'lastName': userLastName,
                    'email': email,
                    'phoneNumber': userPhone,
                    'profilePictureURL': ownerphoto,
                    'active': restaurant_active,
                    'userBankDetails': userBankDetails
                }).then(function (result) {

                    if (role == 'super') {
                        for (i = 0 ; i < area_admins.length ; i ++) {
                            if ($(".area_admin_email").val() == area_admins[i].email) {
                                admin_id = area_admins[i].id;
                                break;
                            }
                        }
                    }

                    geoFirestore.collection('vendors').doc(id).update({
                        'title': restaurantname,
                        'description': description,
                        'latitude': latitude,
                        'longitude': longitude,
                        'location': address,
                        'photo': restaurantPhoto,
                        'photos': restaurnt_photos,
                        'categoryID': cuisines,
                        'phonenumber': phonenumber,
                        'categoryTitle': categoryTitle,
                        'coordinates': coordinates,
                        'filters': filters_new,
                        'reststatus': reststatus,
                        'closetime': closetime,
                        'closetime': closetime,
                        'opentime': opentime,
                        'createdAt': createdAt,
                        'enabledDiveInFuture': enabledDiveInFuture,
                        'restaurantMenuPhotos': restaurant_menu_photos,
                        'restaurantCost': restaurantCost,
                        'openDineTime': openDineTime,
                        'closeDineTime': closeDineTime,
                        'DeliveryCharge': DeliveryCharge,
                        'admin_id': admin_id
                    }).then(function (result) {
                        window.location.href = '{{ route("restaurants")}}';
                    });
                })
            }
        })
    })

    $(document).on("click", ".remove-photo-btn", function () {
        var id = $(this).attr('data-id');
        var photo_remove = $(this).attr('data-img');
        $("#photo_" + id).remove();
        index = restaurnt_photos.indexOf(photo_remove);
        if (index > -1) {
            restaurnt_photos.splice(index, 1); // 2nd parameter means remove one item only
        }
    });

    $(document).on("click", ".remove-menu-btn", function () {
        var id = $(this).attr('data-id');
        var photo_remove = $(this).attr('data-img');
        $("#photo_menu" + id).remove();
        index = restaurant_menu_photos.indexOf(photo_remove);
        if (index > -1) {
            restaurant_menu_photos.splice(index, 1); // 2nd parameter means remove one item only
        }
    });

    function removeImage(photo_remove, photocount) {

        $("#photo_" + photocount).remove();
        index = restaurnt_photos.indexOf(photo_remove);
        if (index > -1) {
            restaurnt_photos.splice(index, 1); // 2nd parameter means remove one item only
        }
        //restaurnt_photos
    }

    var storageRef = firebase.storage().ref('images');

    function handleFileSelect(evt, type) {
        var f = evt.target.files[0];
        var reader = new FileReader();

        new Compressor(f, {
            quality: <?php echo env('IMAGE_COMPRESSOR_QUALITY', 0.8); ?>,
            success(result) {
                f = result;
                reader.onload = (function (theFile) {
                    return function (e) {
                        var filePayload = e.target.result;
                        var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
                        var val = f.name;
                        var ext = val.split('.')[1];
                        var docName = val.split('fakepath')[1];
                        var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                        var timestamp = Number(new Date());
                        var uploadTask = storageRef.child(filename).put(theFile);
                        uploadTask.on('state_changed', function (snapshot) {
                            var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                            if (type == "photo") {
                                jQuery("#uploding_image_restaurant").text("Image is uploading...");
                            } else {
                                jQuery("#uploding_image_photos").text("Image is uploading...");
                            }
                        }, function (error) {
                        }, function () {
                            uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                                if (type == "photo") {
                                    jQuery("#uploding_image_restaurant").text("Upload is completed");
                                } else {
                                    jQuery("#uploding_image_photos").text("Upload is completed");
                                }
                                photo = downloadURL;
                                if (type == "photo") {
                                    restaurantPhoto = downloadURL;
                                }
                                if (photo) {
                                    if (type == 'photo') {
                                        $("#uploaded_image").attr('src', photo);
                                        $(".uploaded_image").show();
                                    } else if (type == 'photos') {
                                        photocount++;
                                        photos_html = '<span class="image-item" id="photo_' + photocount + '"><span class="remove-btn remove-photo-btn" data-id="' + photocount + '" data-img="' + photo + '"><i class="fa fa-remove"></i></span><img width="100px" id="" height="auto" src="' + photo + '"></span>';
                                        $("#photos").append(photos_html);
                                        restaurnt_photos.push(photo);
                                    }
                                }
                            });
                        });
                    };
                })(f);
                reader.readAsDataURL(f);
            },
            error(err) {
                console.log(err.message);
            },
        });
    }

    function handleFileSelectowner(evt) {
        var f = evt.target.files[0];
        var reader = new FileReader();

        new Compressor(f, {
            quality: <?php echo env('IMAGE_COMPRESSOR_QUALITY', 0.8); ?>,
            success(result) {
                f = result;
                reader.onload = (function (theFile) {
                    return function (e) {
                        var filePayload = e.target.result;
                        var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
                        var val = f.name;
                        var ext = val.split('.')[1];
                        var docName = val.split('fakepath')[1];
                        var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                        var timestamp = Number(new Date());
                        var uploadTask = storageRef.child(filename).put(theFile);
                        uploadTask.on('state_changed', function (snapshot) {

                            var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                            jQuery("#uploding_image_owner").text("Image is uploading...");
                        }, function (error) {
                        }, function () {
                            uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                                jQuery("#uploding_image_owner").text("Upload is completed");
                                ownerphoto = downloadURL;
                                console.log(ownerphoto);
                                console.log("ownerphoto");
                                $("#uploaded_image_owner").attr('src', ownerphoto);
                                $(".uploaded_image_owner").show();

                            });
                        });
                    };
                })(f);
                reader.readAsDataURL(f);
            },
            error(err) {
                console.log(err.message);
            },
        });
    }

    function handleFileSelectMenuCard(evt) {
        var f = evt.target.files[0];
        var reader = new FileReader();

        new Compressor(f, {
            quality: <?php echo env('IMAGE_COMPRESSOR_QUALITY', 0.8); ?>,
            success(result) {
                f = result;

                reader.onload = (function (theFile) {
                    return function (e) {
                        var filePayload = e.target.result;
                        var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
                        var val = f.name;
                        var ext = val.split('.')[1];
                        var docName = val.split('fakepath')[1];
                        var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                        var timestamp = Number(new Date());
                        var uploadTask = storageRef.child(filename).put(theFile);
                        uploadTask.on('state_changed', function (snapshot) {
                            var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                            jQuery("#uploaded_image_menu").text("Image is uploading...");
                        }, function (error) {
                        }, function () {
                            uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                                jQuery("#uploaded_image_menu").text("Upload is completed");
                                photo = downloadURL;
                                if (photo) {
                                    menuPhotoCount++;
                                    photos_html = '<span class="image-item" id="photo_menu' + menuPhotoCount + '"><span class="remove-btn remove-menu-btn" data-id="' + menuPhotoCount + '" data-img="' + photo + '"><i class="fa fa-remove"></i></span><img width="100px" id="" height="auto" src="' + photo + '"></span>';
                                    $("#photos_menu_card").append(photos_html);
                                    restaurant_menu_photos.push(photo);
                                }
                            });
                        });
                    };
                })(f);
                reader.readAsDataURL(f);
            },
            error(err) {
                console.log(err.message);
            },
        });

    }

    $("#dine_in_feature").change(function () {
        if (this.checked) {
            $(".divein_div").show();
        } else {
            $(".divein_div").hide();
        }
    });
</script>
@endsection
