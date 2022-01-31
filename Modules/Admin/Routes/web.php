<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function() {
    Route::get('manageinviteall','PermissionController@manageInviteAll');
    Route::get('manage_invites','PermissionController@manageInvites')->middleware('verified');
    Route::post('/getadminpermission','PermissionController@getAdminPermission');
    Route::get('manageinvites/{value}', 'PermissionController@manageInvitesFilter')->name('manageInvitesFilter');
    Route::get('invitesfilter/{account_type}', 'PermissionController@invitesFilter')->name('invitesFilter');
    Route::get('/add_manageinvites','PermissionController@addManageInvites');
    Route::post('store_invites', array('uses' => 'PermissionController@storeInvites'));
    Route::post('approve_invites', array('uses' => 'PermissionController@approveInvites'));
    Route::post('block_invites', array('uses' => 'PermissionController@blockInvites'));
    Route::post('resend_invites', array('uses' => 'PermissionController@resendInvites'));
    Route::get('/adminpersonnel', 'PermissionController@adminPersonnel')->middleware('verified');
    Route::get('edit_adminpersonnel/{id}', 'PermissionController@editAdminPersonel')->name('editadminpersonel');
    Route::get('/adminpermissions', 'PermissionController@adminPermissions')->middleware('verified');
    Route::post('save_permission', 'PermissionController@savePermission');
    Route::post('save_usergroup', 'PermissionController@saveUserGroup');
    Route::post('resend_staffinvites', array('uses' => 'PermissionController@resendStaffInvites'));
    Route::post('save_agentpermission', 'PermissionController@saveAgentPermission');
});
