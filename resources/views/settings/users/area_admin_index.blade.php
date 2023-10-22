@extends('layouts.app')

<?php
error_reporting(E_ALL ^ E_NOTICE);
?>

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.area_admin_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.area_admin_plural')}}</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.area_admin_plural')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('users.area_admin.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.area_admin_create')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                        <div id="users-table_filter" class="pull-right">
                            <label>{{ trans('lang.search_by')}}</label>
                            <select name="selected_search" id="selected_search" class="form-control input-sm">
                                <option value="first_name">{{ trans('lang.first_name')}}</option>
                                <option value="last_name">{{ trans('lang.last_name')}}</option>
                                <option value="email">{{ trans('lang.email')}}</option>
                            </select>
                            <div class="form-group">
                                <input type="search" id="search" class="search form-control" placeholder="Search" aria-controls="users-table" />
                                <button onclick="searchtext();" class="btn btn-warning btn-flat">Search</button>
                                <button onclick="searchclear();" class="btn btn-warning btn-flat">Clear</button>
                            </div>
                        </div>
                        <div class="table-responsive m-t-10">
                            <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{trans('lang.area_name')}}</th>
                                        <th>{{trans('lang.area_admin_name')}}</th>
                                        <th>{{trans('lang.area_admin_user_name')}}</th>
                                        <th>{{trans('lang.area_admin_phone')}}</th>
                                        <th>{{trans('lang.area_admin_email')}}</th>
                                        <th>{{trans('lang.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($area_admins as $area_admin)
                                    <tr>
                                        <td>{{$area_admin->area_name}}</td>
                                        <td>{{$area_admin->area_admin_name}}</td>
                                        <td>{{$area_admin->name}}</td>
                                        <td>{{$area_admin->area_admin_phone}}</td>
                                        <td>{{$area_admin->email}}</td>
                                        <td class="action-btn">
                                            <a href="{{ route('users.area_admin.edit', $area_admin->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a id="{{ $area_admin->id }}" href="javascript:void(0)" name="area-admin-delete" >
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item ">
                                        <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn" onclick="prev()"  data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);" id="users_table_next_btn" onclick="next()"  data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
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
    var database = firebase.firestore();
    // var refResData = database.collection('vendors');
    // var refDriverData = database.collection('users');
    var deleted_admin_id = 0;

    function getResData(id) {
        return database.collection('vendors').where("admin_id", "==", parseInt(id));
    }

    function getDriverData(id) {
        return database.collection('users').where("role", "==", "driver").where("admin_id", "==", parseInt(id));
    }

    $(document).on("click", "a[name='area-admin-delete']", function (e) {
        var id = this.id;
        var len1 = 0, len2 = 0;
        console.log(typeof id);

        e.preventDefault();

        var refResData = getResData(id);
        var refDriverData = getDriverData(id);

        refResData.get().then(function (snapshots) {
            console.log(snapshots.docs.length);
            len1 = snapshots.docs.length;
            snapshots.docs.forEach((listval) => {
                database.collection('vendors').doc(listval.id).update({'admin_id': deleted_admin_id}).then(function (result) { len1--; });
            })
        }).catch(function (err) {
            console.log(err);
        });

        refDriverData.get().then(function (snapshots) {
            console.log(snapshots.docs.length);
            len2 = snapshots.docs.length;
            snapshots.docs.forEach((listval) => {
                database.collection('users').doc(listval.id).update({'admin_id': deleted_admin_id}).then(function (result) {
                    len2--;
                    if (len1 + len2 == 0) {
                        window.location.href = document.URL + '/delete/' + id;
                    }
                });
            })
        }).catch(function (err) {
            console.log(err);
        });

    })
</script>
@endsection
