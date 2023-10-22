@extends('layouts.app')

<?php
error_reporting(E_ALL ^ E_NOTICE);
$zero = 0;
?>

@section('content')
    <div id="main-wrapper" class="page-wrapper" style="min-height: 207px;">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.statistics')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.statistics')}}</li>
                </ol>
            </div>
            <div></div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.statistics_general')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div id="users-table_filter" class="pull-right">
                                <label>{{trans('lang.search_by')}}</label>
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="title">{{trans('lang.area_name')}}</option>
                                    <option value="title">{{trans('lang.area_admin_name')}}</option>
                                </select>
                                <div class="form-group">
                                    <input type="search" id="search" class="search form-control" placeholder="Search">
                                    <button onclick="searchtext();" class="btn btn-warning btn-flat">{{trans('lang.search')}}</button>
                                    <button onclick="searchclear();" class="btn btn-warning btn-flat">{{trans('lang.clear')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive m-t-10">
                            <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{trans('lang.area_name')}}</th>
                                        <th>{{trans('lang.area_admin_name')}}</th>
                                        <th>{{trans('lang.added_restaurants')}}</th>
                                        <th>{{trans('lang.added_drivers')}}</th>
                                    </tr>
                                </thead>
                                <tbody id="table_general">
                                </tbody>
                            </table>
                            <div class="data-table_paginate">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item ">
                                            <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn"
                                               onclick="prev()" data-dt-idx="0" tabindex="0">
                                                {{trans('lang.previous')}}
                                            </a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);" id="users_table_next_btn"
                                               onclick="next()" data-dt-idx="2" tabindex="0">
                                                {{trans('lang.next')}}
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.statistics_restaurant')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div id="users-table_filter" class="pull-right">
                                <label>{{trans('lang.search_by')}}</label>
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="title">{{trans('lang.area_name')}}</option>
                                    <option value="title">{{trans('lang.area_admin_name')}}</option>
                                </select>
                                <div class="form-group">
                                    <input type="search" id="search" class="search form-control" placeholder="Search">
                                    <button onclick="searchtext();" class="btn btn-warning btn-flat">{{trans('lang.search')}}</button>
                                    <button onclick="searchclear();" class="btn btn-warning btn-flat">{{trans('lang.clear')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive m-t-10">
                            <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{trans('lang.area_name')}}</th>
                                        <th>{{trans('lang.admin_name')}}</th>
                                        <th>{{trans('lang.statistics_restaurant_name')}}</th>
                                        <th># {{trans('lang.tab_orders')}}</th>
                                        <th>$ {{trans('lang.tab_orders')}}</th>
                                        <th>{{trans('lang.statistics_super_commission')}}</th>
                                        <th>{{trans('lang.statistics_area_commission')}}</th>
                                        <th>{{trans('lang.statistics_total_pay')}}</th>
                                        <th>{{trans('lang.payment_plural')}}</th>
                                        <th>{{trans('lang.statistics_remaining_payments')}}</th>
                                    </tr>
                                </thead>
                                <tbody id="table_restaurant">
                                </tbody>
                            </table>
                            <div class="data-table_paginate">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item ">
                                            <a class="page-link" href="javascript:void(0);"
                                               id="users_table_previous_btn" onclick="prev()" data-dt-idx="0"
                                               tabindex="0">{{trans('lang.previous')}}</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);" id="users_table_next_btn"
                                               onclick="next()" data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.statistics_driver')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div id="users-table_filter" class="pull-right">
                                <label>{{trans('lang.search_by')}}</label>
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="title">{{trans('lang.area_name')}}</option>
                                    <option value="title">{{trans('lang.area_admin_name')}}</option>
                                </select>
                                <div class="form-group">
                                    <input type="search" id="search" class="search form-control" placeholder="Search">
                                    <button onclick="searchtext();" class="btn btn-warning btn-flat">{{trans('lang.search')}}</button>
                                    <button onclick="searchclear();" class="btn btn-warning btn-flat">{{trans('lang.clear')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive m-t-10">
                            <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{trans('lang.area_name')}}</th>
                                        <th>{{trans('lang.admin_name')}}</th>
                                        <th>{{trans('lang.statistics_driver_name')}}</th>
                                        <th># {{trans('lang.tab_orders')}}</th>
                                        <th>$ {{trans('lang.tab_orders')}}</th>
                                        <th>{{trans('lang.statistics_super_commission')}}</th>
                                        <th>{{trans('lang.statistics_area_commission')}}</th>
                                        <th>{{trans('lang.statistics_total_pay')}}</th>
                                        <th>{{trans('lang.payment_plural')}}</th>
                                        <th>{{trans('lang.statistics_remaining_payments')}}</th>
                                    </tr>
                                </thead>
                                <tbody id="table_driver">
                                </tbody>
                            </table>
                            <div class="data-table_paginate">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item ">
                                            <a class="page-link" href="javascript:void(0);"
                                               id="users_table_previous_btn" onclick="prev()" data-dt-idx="0"
                                               tabindex="0">{{trans('lang.previous')}}</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);" id="users_table_next_btn"
                                               onclick="next()" data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>

    var area_admins = <?php echo $area_admins; ?>;
    var role = "<?php echo $role; ?>";
    console.log(area_admins);
    var general_added_res_total = 0, general_added_driver_total = 0;

    var database = firebase.firestore();
    var adminCommission = database.collection('settings').doc('AdminCommission');
    var super_commission = 0, area_commission = 0;
    adminCommission.get().then(async function (snapshots) {
        super_commission = snapshots.data().super_commission;
        area_commission = snapshots.data().area_commission;
    });
    var currentCurrency ='';
    var currencyAtRight = false;
    var refCurrency = database.collection('currencies').where('isActive', '==' , true);
    refCurrency.get().then( async function(snapshots){
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;
    });

    var data = [];
    var table_general = '', table_restaurant = '', table_driver = '';

    function getResData(id) {
        return database.collection('vendors').where("admin_id", "==", parseInt(id));
    }

    function getDriverData(id) {
        return database.collection('users').where("role", "==", "driver").where("admin_id", "==", parseInt(id));
    }

    $(document).ready(function () {

        // jQuery("#data-table_processing").show();

        table_general = document.getElementById('table_general');
        table_restaurant = document.getElementById('table_restaurant');
        table_driver = document.getElementById('table_driver');

        getTableGeneralData().then(function (res) {
            table_general.innerHTML = res;
        });
        getTableRestaurantData().then(function (res) {
            table_restaurant.innerHTML = res;
        });
        getTableDriverData().then(function (res) {
            table_driver.innerHTML = res;
        });
    })

    function getDataFromSnapShots(snapshots) {
        snapshots.docs.forEach((listval) => {
            data.push(listval.data());
        });
    }

    async function getTableGeneralData() {
        var html = '', i;
        for (i = 0 ; i < area_admins.length ; i ++) {
            html += '<tr>';
            html += '<td>' + area_admins[i].area_name + '</td>';
            html += '<td>' + area_admins[i].area_admin_name + '</td>';

            let refResData = await getResData(area_admins[i].id);
            let refDriverData = await getDriverData(area_admins[i].id);

            await refResData.get().then(function (snapshots) {
                general_added_res_total += snapshots.docs.length;
                html += '<td>' + snapshots.docs.length + '</td>';
            });

            await refDriverData.get().then(function (snapshots) {
                general_added_driver_total += snapshots.docs.length;
                html += '<td>' + snapshots.docs.length + '</td>';
            });
            html += '</tr>';
        }

        return html;
    }

    function getResOrderAmount(snapshotsProducts) {

        var discount = snapshotsProducts.discount;
        var tip_amount = snapshotsProducts.tip_amount;
        var products = snapshotsProducts.products;
        var deliveryCharge = snapshotsProducts.deliveryCharge;
        var totalProductPrice=0;
        var total_price = 0;

        var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

        if (products) {
            products.forEach((product) => {
                var val=product;
                if (val.price){
                    /*if(val.hasOwnProperty('discountPrice') && val.discountPrice != '' && !isNaN(val.discountPrice)){
                        price_item=parseFloat(val.discountPrice).toFixed(2);
                    }else{*/
                    price_item = parseFloat(val.price).toFixed(2);
                    /*}*/
                    extras_price_item = 0;
                    if (val.extras_price && !isNaN(extras_price_item) && !isNaN(val.quantity)) {
                        extras_price_item = (parseFloat(val.extras_price) * parseInt(val.quantity)).toFixed(2);
                    }
                    if (!isNaN(price_item) && !isNaN(val.quantity)) {
                        totalProductPrice =  parseFloat(price_item) * parseInt(val.quantity);
                    }
                    var extras_price = 0;
                    if (parseFloat(extras_price_item) != NaN && val.extras_price != undefined) {
                        extras_price = extras_price_item;
                    }
                    totalProductPrice = parseFloat(extras_price) + parseFloat(totalProductPrice);
                    totalProductPrice = parseFloat(totalProductPrice).toFixed(2);
                    if (!isNaN(totalProductPrice)) {
                        total_price += parseFloat(totalProductPrice);
                    }
                }
            });
        }

        if ((intRegex.test(discount) || floatRegex.test(discount)) && !isNaN(discount)) {

            discount = parseFloat(discount).toFixed(2);
            total_price -= parseFloat(discount);
            if (currencyAtRight) {
                discount_val = discount+""+currentCurrency;
            } else {
                discount_val = currentCurrency+""+discount;
            }
        }

        tax = 0;
        if (snapshotsProducts.hasOwnProperty('taxSetting')) {
            if (snapshotsProducts.taxSetting.type && snapshotsProducts.taxSetting.tax) {
                if (snapshotsProducts.taxSetting.type == "percent"){
                    tax = (snapshotsProducts.taxSetting.tax * total_price) / 100;
                } else {
                    tax = snapshotsProducts.taxSetting.tax;
                }
            }
        }

        if (!isNaN(tax)) {
            total_price = total_price + tax;
        }

        if ((intRegex.test(deliveryCharge) || floatRegex.test(deliveryCharge)) && !isNaN(deliveryCharge)) {

            deliveryCharge = parseFloat(deliveryCharge).toFixed(2);
            total_price += parseFloat(deliveryCharge);

            if (currencyAtRight) {
                deliveryCharge_val = deliveryCharge + "" + currentCurrency;
            } else {
                deliveryCharge_val = currentCurrency + "" + deliveryCharge;
            }
        }

        if (intRegex.test(tip_amount) || floatRegex.test(tip_amount) && !isNaN(tip_amount)) {

            tip_amount = parseFloat(tip_amount).toFixed(2);
            total_price += parseFloat(tip_amount);
            total_price = parseFloat(total_price).toFixed(2);

            if (currencyAtRight) {
                tip_amount_val = tip_amount + "" + currentCurrency;
            } else {
                tip_amount_val = currentCurrency + "" + tip_amount;
            }
        }

        return total_price;
    }

    async function resData(vendorID){

        var paid_price = 0;
        var total_price = 0;
        var remaining = 0;
        var order_count = 0;
        var order_amount = 0;

        await database.collection('payouts').where('vendorID', '==', vendorID).where('paymentStatus','==','Success').get().then( async function(payoutSnapshots){
            payoutSnapshots.docs.forEach((payout)=>{
                var payoutData = payout.data();
                paid_price = parseFloat(paid_price) + parseFloat(payoutData.amount);
            })
            await database.collection('users').where('vendorID','==',vendorID).get().then( async function(vendorSnapshots){
                var vendor = [];
                var wallet_amount = 0;
                if (vendorSnapshots.docs.length) {
                    vendor = vendorSnapshots.docs[0].data();
                    if (isNaN(vendor.wallet_amount) || vendor.wallet_amount == undefined) {
                        wallet_amount = 0;
                    } else {
                        wallet_amount = vendor.wallet_amount;
                    }
                }
                remaining = wallet_amount;
                total_price = wallet_amount + paid_price;
                if (Number.isNaN(paid_price)) { paid_price=0; }
                if (Number.isNaN(total_price)) { total_price=0; }
                if (Number.isNaN(remaining)) { remaining=0; }
                if (currencyAtRight) {
                    total_price_val = total_price+""+currentCurrency;
                    paid_price_val = paid_price+""+currentCurrency;
                    remaining_val = remaining+""+currentCurrency;
                } else {
                    total_price_val = currentCurrency+""+total_price;
                    paid_price_val = currentCurrency+""+paid_price;
                    remaining_val = currentCurrency+""+remaining;
                }

                jQuery(".res_total_"+vendorID).html(total_price_val);
                jQuery(".res_name_"+vendorID).html(paid_price_val);
                jQuery(".res_remaining_"+vendorID).html(remaining_val);
            });

        });
        await database.collection('restaurant_orders').where('vendorID', '==', vendorID).where('status', 'in', ["Order Completed"]).get().then(async function(orderSnapShots) {
            order_count = orderSnapShots.docs.length;
            if (order_count == 0) {
                order_amount = 0;
            } else {
                orderSnapShots.docs.forEach((doc) => {
                    order_amount += parseFloat(getResOrderAmount(doc.data()));
                });
            }

            if (Number.isNaN(order_count)) { order_count = 0; }
            if (Number.isNaN(order_amount)) { order_amount = 0; }

            if (currencyAtRight){
                order_count_val = order_count;
                order_amount_val = order_amount + "" + currentCurrency;
            } else {
                order_count_val = order_count;
                order_amount_val = currentCurrency + " " + order_amount;
            }
            jQuery(".res_order_count_" + vendorID).html(order_count_val);
            jQuery(".res_order_amount_" + vendorID).html(order_amount_val);
        });
        return remaining;

    }

    function buildResHTML(area_name, area_admin_name) {
        let html = '';

        for (let i = 0 ; i < data.length ; i ++) {
            let res = resData(data[i].id);

            html += '<tr>';
            html += '<td>' + area_name + '</td>';
            html += '<td>' + area_admin_name + '</td>';
            html += '<td>' + data[i].title + '</td>';
            html += '<td class="res_order_count_' + data[i].id + '"></td>';
            html += '<td class="res_order_amount_' + data[i].id + '"></td>';
            html += '<td>' + super_commission + '</td>';
            html += '<td>' + area_commission + '</td>';
            html += '<td class="res_total_' + data[i].id + '"></td>';
            html += '<td class="res_name_' + data[i].id + '"></td>';
            html += '<td class="res_remaining_' + data[i].id + '"></td>';
            html += '</tr>';
        }
        return html;
    }

    async function getTableRestaurantData() {
        let html = '', i;
        for (i = 0 ; i < area_admins.length ; i ++) {
            let area_name = area_admins[i].area_name;
            let area_admin_name = area_admins[i].area_admin_name;
            let refResData = await getResData(area_admins[i].id);

            await refResData.get().then(async function (snapshots) {
                data = [];
                await getDataFromSnapShots(snapshots);
                html += await buildResHTML(area_name, area_admin_name);
            });
        }
        return html;
    }

    async function driverData(driverID){

        var paid_price = 0;
        var total_price = 0;
        var remaining = 0;
        var order_count = 0;
        var order_amount = 0;

        await database.collection('driver_payouts').where('driverID', '==', driverID).get().then( async function(payoutSnapshots) {
            payoutSnapshots.docs.forEach((payout) => {
                var payoutData = payout.data();
                paid_price = parseFloat(paid_price) + parseFloat(payoutData.amount);
            })
            await database.collection('users').where('id','==',driverID).get().then( async function(driverSnapshots) {
                var driver = [];
                var wallet_amount = 0;
                if (driverSnapshots.docs.length) {
                    driver = driverSnapshots.docs[0].data();
                    if (isNaN(driver.wallet_amount) || driver.wallet_amount == undefined) {
                        wallet_amount=0;
                    } else {
                        wallet_amount=driver.wallet_amount;
                    }
                }
                remaining = wallet_amount;
                total_price = wallet_amount + paid_price;
                if (Number.isNaN(paid_price)) {
                    paid_price=0;
                }
                if (Number.isNaN(total_price)) {
                    total_price=0;
                }
                if (Number.isNaN(remaining)) {
                    remaining=0;
                }

                if (currencyAtRight) {
                    total_price_val = total_price + "" + currentCurrency;
                    paid_price_val = paid_price + "" + currentCurrency;
                    remaining_val = remaining + "" + currentCurrency;
                } else {
                    total_price_val = currentCurrency + "" + total_price;
                    paid_price_val = currentCurrency + "" + paid_price;
                    remaining_val = currentCurrency + "" + remaining;
                }
                jQuery(".drv_total_" + driverID).html(total_price_val);
                jQuery(".drv_name_" + driverID).html(paid_price_val);
                jQuery(".drv_remaining_" + driverID).html(remaining_val);
            });
        });
        await database.collection('order_transaction').where('driverID', '==', driverID).get().then( async function(orderSnapShots) {
            order_count = orderSnapShots.docs.length;
            if (order_count == 0) {
                order_amount = 0;
            } else {
                orderSnapShots.docs.forEach((doc) => {
                    order_amount += doc.data().driverAmount;
                });
            }

            if (Number.isNaN(order_count)){
                order_count = 0;
            }
            if (Number.isNaN(order_amount)){
                order_amount = 0;
            }

            if (currencyAtRight){
                order_count_val = order_count;
                order_amount_val = order_amount + "" + currentCurrency;
            } else {
                order_count_val = order_count;
                order_amount_val = currentCurrency + " " + order_amount;
            }
            jQuery(".drv_order_count_" + driverID).html(order_count_val);
            jQuery(".drv_order_amount_" + driverID).html(order_amount_val);
        })
        return remaining;
    }

    function buildDriverHTML(area_name, area_admin_name) {
        let html = '';

        for (let i = 0 ; i < data.length ; i ++) {
            let driver = driverData(data[i].id);

            html += '<tr>';
            html += '<td>' + area_name + '</td>';
            html += '<td>' + area_admin_name + '</td>';
            html += '<td>' + data[i].firstName + ' ' + data[i].lastName + '</td>';
            html += '<td class="drv_order_count_' + data[i].id + '"></td>';
            html += '<td class="drv_order_amount_' + data[i].id + '"></td>';
            html += '<td>' + super_commission + '</td>';
            html += '<td>' + area_commission + '</td>';
            html += '<td class="drv_total_' + data[i].id + '"></td>';
            html += '<td class="drv_name_' + data[i].id + '"></td>';
            html += '<td class="drv_remaining_' + data[i].id + '"></td>';
            html += '</tr>';
        }
        return html;
    }

    async function getTableDriverData() {
        let html = '', i;
        for (i = 0 ; i < area_admins.length ; i ++) {
            let area_name = area_admins[i].area_name;
            let area_admin_name = area_admins[i].area_admin_name;
            let refDriverData = await getDriverData(area_admins[i].id);

            await refDriverData.get().then(async function (snapshots) {
                data = [];
                await getDataFromSnapShots(snapshots);
                html += await buildDriverHTML(area_name, area_admin_name);
            });
        }

        return html;
    }

</script>
@endsection

