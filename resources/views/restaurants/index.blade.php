@extends('layouts.app')

<?php
error_reporting(E_ALL ^ E_NOTICE);
?>

@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.restaurant_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item">{{trans('lang.restaurant_plural')}}</li>
                <li class="breadcrumb-item active">{{trans('lang.restaurant_table')}}</li>
            </ol>
        </div>
        <div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.restaurants_table')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('restaurants.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.create_restaurant')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div id="users-table_filter" class="pull-right">
                            <label>{{trans('lang.search_by')}}</label>
                            <select name="selected_search" id="selected_search" class="form-control input-sm">
                                <option value="title">{{trans('lang.title')}}</option>
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
                                    <th>{{trans('lang.restaurant_image')}}</th>
                                    <th>{{trans('lang.restaurant_name')}}</th>
                                    <th class="address-list">{{trans('lang.restaurant_address')}}</th>
                                    <th>{{trans('lang.restaurant_phone')}}</th>
                                    <th>{{trans('lang.order_transactions')}}</th>
                                    <th>{{trans('lang.wallet_history')}}</th>
                                    <th>{{trans('lang.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody id="append_restaurants">
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

    var id = <?php echo $id; ?>;
    var role = "<?php echo $role; ?>";

    var database = firebase.firestore();
    var offest = 1;
    var pagesize = 10;
    var end = null;
    var endarray = [];
    var start = null;
    var user_number = [];
    var refData = database.collection('vendors');
    if (role == 'area') {
        refData = refData.where("admin_id", "==", id);
    }
    var ref = refData.orderBy('createdAt','desc');
    var append_list = '';

    var placeholderImage = '';
    var placeholder = database.collection('settings').doc('placeHolderImage');

    placeholder.get().then(async function (snapshotsimage) {
        var placeholderImageData = snapshotsimage.data();
        placeholderImage = placeholderImageData.image;
    })

    $(document).ready(function () {

        var inx = parseInt(offest) * parseInt(pagesize);
        jQuery("#data-table_processing").show();

        append_list = document.getElementById('append_restaurants');
        append_list.innerHTML = '';
        ref.limit(pagesize).get().then(async function (snapshots) {
            if (snapshots.docs.length == 0) {
                alert("no match");
            } else {
                html = '';
                html = await buildHTML(snapshots);
                jQuery("#data-table_processing").hide();
                if (html != '') {
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    endarray.push(snapshots.docs[0]);
                    if (snapshots.docs.length < pagesize) {
                        jQuery("#data-table_paginate").hide();
                    }
                    disableClick();
                }
            }
        });
    })

    function buildHTML(snapshots) {
        if (snapshots.docs.length < pagesize) {
            jQuery("#data-table_paginate").hide();
        }
        var html = '';
        var number = [];
        var count = 0;

        snapshots.docs.forEach((listval) => {
            try {
                var listval = listval.data();
                var val = listval;

                html = html + '<tr>';
                newdate = '';
                var id = val.id;
                var route1 = '{{route("restaurants.edit",":id")}}';
                route1 = route1.replace(':id', id);

                var route_view = '{{route("restaurants.view",":id")}}';
                route_view = route_view.replace(':id', id);

                // var route1 = "#";
                if (val.photo != '') {
                    html = html + '<td><img alt="" width="100%" style="width:70px;height:70px;" src="' + val.photo + '" alt="image"></td>';
                } else {
                    html = html + '<td><img alt="" width="100%" style="width:70px;height:70px;" src="' + placeholderImage + '" alt="image"></td>';
                }

                html = html + '<td>' + val.title + '</td>';
                if (val.hasOwnProperty("location") != '') {
                    html = html + '<td class="address-list">' + val.location + '</td>';
                } else {
                    html = html + '<td></td>';
                }
                const phone = userPhone(val.author);
                if (val.hasOwnProperty('phonenumber')) {
                    html = html + '<td>' + val.phonenumber + '</td>';
                } else {
                    html = html + '<td></td>';
                }

                var trroute1 = '{{route("order_transactions.index",":id")}}';
                trroute1 = trroute1.replace(':id', 'vendorId=' + id);

                html = html + '<td data-url="' + trroute1 + '" class="redirecttopage">{{trans("lang.order_transactions")}}</td>';

                var payoutRequests = '{{route("payoutRequests.restaurants.view",":id")}}';
                payoutRequests = payoutRequests.replace(':id', id);

                html = html + '<td data-url="' + payoutRequests + '" class="redirecttopage">{{trans("lang.wallet_history")}}</td>';

                var active = val.isActive;

                html = html + '<td class="vendor-action-btn"><a href="' + route_view + '"><i class="fa fa-eye"></i></a><a href="' + route1 + '"><i class="fa fa-edit"></i></a><a id="' + val.id + '" author="' + val.author + '" name="vendor-delete" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';
                html = html + '</tr>';
                count = count + 1;
            } catch (error) {
            }
        });
        return html;
    }

    $(document.body).on('click', '.redirecttopage', function () {
        var url = $(this).attr('data-url');
        window.location.href = url;
    });

    async function userPhone(author) {
        var userPhones = '';
        await database.collection('users').where("id", "==", author).get().then(async function (snapshotss) {

            if (snapshotss.docs[0]) {
                var user = snapshotss.docs[0].data();
                userPhones = user.phoneNumber;
                if (user.isActive) {
                    jQuery(".active_restaurant_" + author + " span").addClass('badge-danger');
                    jQuery(".active_restaurant_" + author + " span").text('No');
                } else {
                    jQuery(".active_restaurant_" + author + " span").addClass('badge-success');
                    jQuery(".active_restaurant_" + author + " span").text('Yes');
                }
            } else {
                jQuery(".phone_" + author).html('');
                jQuery(".active_restaurant_" + author + " span").addClass('badge-success');
                jQuery(".active_restaurant_" + author + " span").text('Yes');
            }
        });
        return userPhones;
    }

    async function next() {
        if (start != undefined || start != null) {
            jQuery("#data-table_processing").hide();

            if (jQuery("#selected_search").val() == 'title' && jQuery("#search").val().trim() != '') {
                console.log(jQuery("#selected_search").val());
                listener = refData.orderBy('title').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();
            } else {
                listener = ref.startAfter(start).limit(pagesize).get();
            }
            listener.then(async (snapshots) => {
                html = '';
                html = await buildHTML(snapshots);
                console.log(snapshots);
                jQuery("#data-table_processing").hide();
                if (html != '') {
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    if (endarray.indexOf(snapshots.docs[0]) != -1) {
                        endarray.splice(endarray.indexOf(snapshots.docs[0]), 1);
                    }
                    endarray.push(snapshots.docs[0]);
                }
            });
        }
    }

    async function prev() {
        if (endarray.length == 1) {
            return false;
        }
        end = endarray[endarray.length - 2];

        if (end != undefined || end != null) {
            jQuery("#data-table_processing").show();
            if (jQuery("#selected_search").val() == 'title' && jQuery("#search").val().trim() != '') {

                listener = refData.orderBy('title').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();
            } else {
                listener = ref.startAt(end).limit(pagesize).get();
            }

            listener.then(async (snapshots) => {
                html = '';
                html = await buildHTML(snapshots);
                jQuery("#data-table_processing").hide();
                if (html != '') {
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    endarray.splice(endarray.indexOf(endarray[endarray.length - 1]), 1);

                    if (snapshots.docs.length < pagesize) {
                        jQuery("#users_table_previous_btn").hide();
                    }
                }
            });
        }
    }

    function searchtext() {

        jQuery("#data-table_processing").show();

        append_list.innerHTML = '';

        if (jQuery("#selected_search").val() == 'title' && jQuery("#search").val().trim() != '') {
            console.log(jQuery("#search").val());
            wherequery = refData.orderBy('title').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();
        } else {
            wherequery = ref.limit(pagesize).get();
        }

        wherequery.then((snapshots) => {
            html = '';
            html = buildHTML(snapshots);
            jQuery("#data-table_processing").hide();
            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
                if (snapshots.docs.length < pagesize) {

                    jQuery("#data-table_paginate").hide();
                } else {

                    jQuery("#data-table_paginate").show();
                }
            }
        });
    }

    function searchclear() {
        jQuery("#search").val('');
        searchtext();
    }

    function disableClick() {
        var is_disable_delete = "<?php echo env('IS_DISABLE_DELETE'); ?>";
        if (is_disable_delete == 1) {
            jQuery("a.do_not_delete").removeAttr("name");
            jQuery("a.do_not_delete").attr("name", "alert_demo");
        }
    }

    $(document).on("click", "a[name='vendor-delete']", function (e) {
        var id = this.id;
        var author = $(this).attr('author');
        var is_disable_delete = "<?php echo env('IS_DISABLE_DELETE'); ?>";
        if (is_disable_delete == 1) {
            alert(doNotDeleteAlert);
            return false;
        }
        database.collection('users').doc(author).delete().then(function () {
        });
        database.collection('vendors').doc(id).delete().then(function () {
            window.location.reload();
        });
    });
</script>
@endsection
