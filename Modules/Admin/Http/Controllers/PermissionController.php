<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Staffinvites;
use App\Permissionmenu;
use Modules\Admin\Entities\UserPermission;
use Modules\University\Entities\UniversityPermission;
use Modules\Admin\Entities\ManageInvites;
use Modules\Admin\Entities\AdminGroup;
use Modules\Admin\Entities\MainLevel;
use App\User;
use App\Agentstaffinvites;
use App\Agentpermission;
use App\Agent;
use DB;
use Mail;
use Session;

class PermissionController extends ApiBaseController
{
    public function store(Request $request)
    {
        print_r($request->all());   exit;
    }

    public function manageInvites(Request $request)
    {
        try {
            $data['invites'] = ManageInvites::leftJoin('admin_usergroup', 'admin_user_invites.account_type', '=', 'admin_usergroup.id')
                        ->select('admin_user_invites.*','admin_user_invites.status as approve_status','admin_usergroup.usergroup_name',
                        DB::raw('CASE WHEN admin_user_invites.is_blocked = 0 THEN "Blocked" WHEN admin_user_invites.status = 1 THEN "Active" WHEN admin_user_invites.status = 2 THEN "
                        Pending" WHEN admin_user_invites.status = 4 THEN "Approved"  ELSE "Inactive" END as status'),'admin_user_invites.status as status_id' )
                        ->orderBy('admin_user_invites.id', 'DESC')->get();
            $data['account_type'] =AdminGroup::all();
            $data['account_types'] =AdminGroup::all();
            $data['approvedstatus'] = 0;
            $data['acc_type'] = 0;
            return view('admin::manageinvites',['result' => $data]);
        } catch (\Exception $ex) {
            return redirect(config('constant.home_route'))->with('failure', config('constant.default_error_message'));
        }    
    }
    
    public function manageInviteAll(Request $request)
    {
        try {
            $data = ManageInvites::leftJoin('admin_usergroup', 'admin_user_invites.account_type', '=', 'admin_usergroup.id')
                        ->select('admin_user_invites.*','admin_user_invites.status as approve_status','admin_usergroup.usergroup_name',
                        DB::raw('CASE WHEN admin_user_invites.is_blocked = 0 THEN "Blocked" WHEN admin_user_invites.status = 1 THEN "Active" WHEN admin_user_invites.status = 2 THEN "
                        Pending" WHEN admin_user_invites.status = 4 THEN "Approved"  ELSE "Inactive" END as status'),'admin_user_invites.status as status_id' )
                        ->orderBy('admin_user_invites.id', 'DESC')->get();
            echo json_encode($data);
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('User not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }      
    }

    public function manageInvitesFilter(Request $request,$value)
    {
        try {
            $type='status';
            if($value=="4") {
                $data['invites'] = ManageInvites::leftJoin('admin_usergroup', 'admin_user_invites.account_type', '=', 'admin_usergroup.id')
                            ->select('admin_user_invites.*','admin_user_invites.status as approve_status','admin_usergroup.usergroup_name',
                            DB::raw('CASE WHEN admin_user_invites.is_blocked = 0 THEN "Blocked" WHEN admin_user_invites.status = 1 THEN "Active" WHEN admin_user_invites.status = 2 THEN "
                            Pending" WHEN admin_user_invites.status = 4 THEN "Approved"  ELSE "Inactive" END as status'),'admin_user_invites.status as status_id' )
                            ->where('admin_user_invites.'.$type,$value)
                            ->orderBy('admin_user_invites.id', 'DESC')->get();
            } else {
                $data['invites'] = ManageInvites::leftJoin('admin_usergroup', 'admin_user_invites.account_type', '=', 'admin_usergroup.id')
                            ->select('admin_user_invites.*','admin_user_invites.status as approve_status','admin_usergroup.usergroup_name',
                            DB::raw('CASE WHEN admin_user_invites.is_blocked = 0 THEN "Blocked" WHEN admin_user_invites.status = 1 THEN "Active" WHEN admin_user_invites.status = 2 THEN "
                            Pending" WHEN admin_user_invites.status = 4 THEN "Approved"  ELSE "Inactive" END as status'),'admin_user_invites.status as status_id' )
                            ->whereNotIn('admin_user_invites.'.$type,[4])
                            ->orderBy('admin_user_invites.id', 'DESC')->get();
            }
            $data['approved_status'] = 0;
            $data['acc_type'] = 0;
            $data['status'] =DB::table('status')->get();
            $data['account_types'] = AdminGroup::all();
            return view('permission.manageinvites',['result' => $data]);
        } catch (\Exception $ex) {
            return redirect(config('constant.home_route'))->with('failure', config('constant.default_error_message'));
        }     
    }

    public function invitesFilter(Request $request,$param)
    {
        try {
            $exp = explode('-',$param);
            $account_type = $exp[0];
            $status = $exp[1];
            $type='status';
            $accounttype='account_type';
            if($status !='0') {
                if($status=="4") {
                    $data['invites'] = ManageInvites::leftJoin('admin_usergroup', 'admin_user_invites.account_type', '=', 'admin_usergroup.id')
                                ->select('admin_user_invites.*','admin_user_invites.status as approve_status','admin_usergroup.usergroup_name',
                                DB::raw('CASE WHEN admin_user_invites.is_blocked = 0 THEN "Blocked" WHEN admin_user_invites.status = 1 THEN "Active" WHEN admin_user_invites.status = 2 THEN "
                                Pending" WHEN admin_user_invites.status = 4 THEN "Approved"  ELSE "Inactive" END as status'),'admin_user_invites.status as status_id' )
                                ->where('admin_user_invites.'.$type,$status)
                                ->orderBy('admin_user_invites.id', 'DESC')->get();
                } else {
                    $data['invites'] = ManageInvites::leftJoin('admin_usergroup', 'admin_user_invites.account_type', '=', 'admin_usergroup.id')
                                ->select('admin_user_invites.*','admin_user_invites.status as approve_status','admin_usergroup.usergroup_name',
                                DB::raw('CASE WHEN admin_user_invites.is_blocked = 0 THEN "Blocked" WHEN admin_user_invites.status = 1 THEN "Active" WHEN admin_user_invites.status = 2 THEN "
                                Pending" WHEN admin_user_invites.status = 4 THEN "Approved"  ELSE "Inactive" END as status'),'admin_user_invites.status as status_id' )
                                ->whereNotIn('admin_user_invites.'.$type,[4])
                                ->orderBy('admin_user_invites.id', 'DESC')->get();
                }
            }
            if($account_type !='0') {
                $data['invites'] = ManageInvites::leftJoin('admin_usergroup', 'admin_user_invites.account_type', '=', 'admin_usergroup.id')
                            ->select('admin_user_invites.*','admin_user_invites.status as approve_status','admin_usergroup.usergroup_name',
                            DB::raw('CASE WHEN admin_user_invites.is_blocked = 0 THEN "Blocked" WHEN admin_user_invites.status = 1 THEN "Active" WHEN admin_user_invites.status = 2 THEN "
                            Pending" WHEN admin_user_invites.status = 4 THEN "Approved"  ELSE "Inactive" END as status'),'admin_user_invites.status as status_id' )
                            ->where('admin_user_invites.'.$accounttype,$account_type)
                            ->orderBy('id', 'DESC')->get();
            }
            if(($account_type !='0') & ($status !='0')) {
                if($status=="4") {
                    $data['invites'] = ManageInvites::leftJoin('admin_usergroup', 'admin_user_invites.account_type', '=', 'admin_usergroup.id')
                                ->select('admin_user_invites.*','admin_user_invites.status as approve_status','admin_usergroup.usergroup_name',
                                DB::raw('CASE WHEN admin_user_invites.is_blocked = 0 THEN "Blocked" WHEN admin_user_invites.status = 1 THEN "Active" WHEN admin_user_invites.status = 2 THEN "
                                Pending" WHEN admin_user_invites.status = 4 THEN "Approved"  ELSE "Inactive" END as status'),'admin_user_invites.status as status_id' )
                                ->where('admin_user_invites.'.$accounttype,$account_type)
                                ->where('admin_user_invites.'.$type,$status)
                                ->orderBy('id', 'DESC')->get();
                } else {
                    $data['invites'] = ManageInvites::leftJoin('admin_usergroup', 'admin_user_invites.account_type', '=', 'admin_usergroup.id')
                                ->select('admin_user_invites.*','admin_user_invites.status as approve_status','admin_usergroup.usergroup_name',
                                DB::raw('CASE WHEN admin_user_invites.is_blocked = 0 THEN "Blocked" WHEN admin_user_invites.status = 1 THEN "Active" WHEN admin_user_invites.status = 2 THEN "
                                Pending" WHEN admin_user_invites.status = 4 THEN "Approved"  ELSE "Inactive" END as status'),'admin_user_invites.status as status_id' )
                                ->where('admin_user_invites.'.$accounttype,$account_type)
                                ->whereNotIn('admin_user_invites.'.$type,[4])
                                ->orderBy('id', 'DESC')->get();
                }
            }
            if(($account_type =='0') & ($status =='0')) {
                $data['invites'] = ManageInvites::leftJoin('admin_usergroup', 'admin_user_invites.account_type', '=', 'admin_usergroup.id')
                            ->select('admin_user_invites.*','admin_user_invites.status as approve_status','admin_usergroup.usergroup_name',
                            DB::raw('CASE WHEN admin_user_invites.is_blocked = 0 THEN "Blocked" WHEN admin_user_invites.status = 1 THEN "Active" WHEN admin_user_invites.status = 2 THEN "
                            Pending" WHEN admin_user_invites.status = 4 THEN "Approved"  ELSE "Inactive" END as status'),'admin_user_invites.status as status_id' )
                            ->orderBy('admin_user_invites.id', 'DESC')->get();
            }
            $data['approvedstatus'] = $status;
            $data['acc_type'] = $account_type;
            $data['status'] =DB::table('status')->get();
            $data['account_type'] = AdminGroup::all();
            return view('admin::manageinvites',['result' => $data]);
        } catch (\Exception $ex) {
            return redirect(config('constant.home_route'))->with('failure', config('constant.default_error_message'));
        }       
    }

    public function manageInvitesFilter1(Request $request,$type,$value)
    {
        try {
            if($type=="account_type") {
                if($value!="all") {
                    $data['invites'] = ManageInvites::leftJoin('admin_group', 'admin_user_invites.account_type', '=', 'admin_group.id')
                                ->select('admin_user_invites.*','admin_user_invites.status as approve_status','admin_group.group_name',
                                DB::raw('CASE WHEN admin_user_invites.status = 1 THEN "Active" WHEN admin_user_invites.status = 2 THEN "
                                Pending" WHEN admin_user_invites.status = 4 THEN "Approved"  ELSE "Inactive" END as status') )
                                ->where($type,$value)
                                ->orderBy('id', 'DESC')->get();
                } else {
                    $data['invites'] = ManageInvites::leftJoin('admin_group', 'admin_user_invites.account_type', '=', 'admin_group.id')
                                ->select('admin_user_invites.*','admin_user_invites.status as approve_status','admin_group.group_name',
                                DB::raw('CASE WHEN admin_user_invites.status = 1 THEN "Active" WHEN admin_user_invites.status = 2 THEN "
                                Pending" WHEN admin_user_invites.status = 4 THEN "Approved"  ELSE "Inactive" END as status') )
                                ->orderBy('id', 'DESC')->get();
                }
            }
            if($type=="status") {
                if($value=="4") {
                    $data['invites'] = ManageInvites::leftJoin('admin_usergroup', 'admin_user_invites.account_type', '=', 'admin_usergroup.id')
                                ->select('admin_user_invites.*','admin_user_invites.status as approve_status','admin_usergroup.usergroup_name',
                                DB::raw('CASE WHEN admin_user_invites.is_blocked = 0 THEN "Blocked" WHEN admin_user_invites.status = 1 THEN "Active" WHEN admin_user_invites.status = 2 THEN "
                                Pending" WHEN admin_user_invites.status = 4 THEN "Approved"  ELSE "Inactive" END as status'),'admin_user_invites.status as status_id' )
                                ->where('admin_user_invites.'.$type,$value)
                                ->orderBy('admin_user_invites.id', 'DESC')->get();
                } else {
                    $data['invites'] = ManageInvites::leftJoin('admin_usergroup', 'admin_user_invites.account_type', '=', 'admin_usergroup.id')
                                ->select('admin_user_invites.*','admin_user_invites.status as approve_status','admin_usergroup.usergroup_name',
                                DB::raw('CASE WHEN admin_user_invites.is_blocked = 0 THEN "Blocked" WHEN admin_user_invites.status = 1 THEN "Active" WHEN admin_user_invites.status = 2 THEN "
                                Pending" WHEN admin_user_invites.status = 4 THEN "Approved"  ELSE "Inactive" END as status'),'admin_user_invites.status as status_id' )
                                ->whereNotIn('admin_user_invites.'.$type,[4])
                                ->orderBy('admin_user_invites.id', 'DESC')->get();
                }
            }
            if($type=="days") {
                $date = \Carbon\Carbon::today()->subDays($value);
                $data['invites'] = ManageInvites::leftJoin('admin_group', 'admin_user_invites.account_type', '=', 'admin_group.id')
                            ->select('admin_user_invites.*','admin_user_invites.status as approve_status','admin_group.group_name',
                            DB::raw('CASE WHEN admin_user_invites.status = 1 THEN "Active" WHEN admin_user_invites.status = 2 THEN "
                            Pending" WHEN admin_user_invites.status = 4 THEN "Approved"  ELSE "Inactive" END as status') )
                            ->where('created_date', '>=', $date)
                            ->orderBy('id', 'DESC')->get();
            }
            $data['account_types'] = AdminGroup::all();
            return view('permission.manageinvites',['result' => $data]);
        } catch (\Exception $ex) {
            return redirect(config('constant.home_route'))->with('failure', config('constant.default_error_message'));
        }       
    }

    public function addManageInvites(Request $request)
    {
        try {
            $main_level = MainLevel::get();
            $data['account_type'] = AdminGroup::all();
            $data['mainlevel'] =$main_level;
            return view('permission.add_manageinvites',['result' => $data]);
        } catch (\Exception $ex) {
            return redirect(config('constant.home_route'))->with('failure', config('constant.default_error_message'));
        }       
    }

    public function storeInvites(Request $request)
    {
        try {
            $inv = ManageInvites::where('email',$request->email)->first();
            $inv_usr = User::where('email',$request->email)->first();
            if(empty($inv_usr)) {
                if(empty($inv)) {
                    $code = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890",5)),0,8 );
                    $password = Hash::make($code);
                    $maninv = new ManageInvites();
                    $maninv->name = $request->name;
                    $maninv->email = $request->email;
                    $maninv->account_type = $request->account_type;
                    $maninv->message = $request->txtmsg;
                    $maninv->password = $password;
                    $maninv->is_blocked = 1;
                    $maninv->status = 2;
                    $maninv->created_date = date('Y-m-d h:i:s');
                    $maninv->approved_date = date('Y-m-d h:i:s');
                    $maninv->save();
                    if($maninv->id) {
                        $user=new User();
                        $user->name = $request->name;
                        $user->email = $request->email;
                        $user->account_type = $request->account_type;
                        $user->status = 1;
                        $user->password = Hash::make($code);
                        $user->save();
                        $data['name'] = $request->name;
                        $data['code'] = $code;
                        $mail['to'] = $request->email;
                        $mail['name'] = $request->name;
                        $mail['code']=$code;
                        Mail::send('emails.invites', $data, function($message)use($mail) {
                                    $message->to($mail['to'], $mail['name'])->subject('Manage Invites');
                                });
                        return $this->sendSuccessResponse('Invites Sent Successfully');
                    }
                    else {
                        return $this->sendFailureResponse('Error in save Invites');
                    }
                } else {
                    return $this->sendFailureResponse('Already invivted this Email');
                }
            } else {
                return $this->sendFailureResponse('Email Already Exists');
            }
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('User not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }      
    }

    public function approveInvites(Request $request)
    {
        try {
            $mi = ManageInvites::findOrFail($_POST['id']);
            $mi->status = $_POST['status'];
            $mi->approved_date = date('Y-m-d h:i:s');
            $mi->save();
            if($mi->id) {
                return $this->sendSuccessResponse('Status Updated Successfully');
            } else {
                return $this->sendFailureResponse('Error in Update status');
            }
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('User not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }      
    }

    public function adminPersonnel(Request $request)
    {
        try {
            $data['invites'] = ManageInvites::leftJoin('admin_usergroup', 'admin_user_invites.account_type', '=', 'admin_usergroup.id')
                        ->select('admin_user_invites.*','admin_user_invites.status as approve_status','admin_usergroup.usergroup_name',
                        DB::raw('CASE WHEN admin_user_invites.status = 1 THEN "Active" WHEN admin_user_invites.status = 2 THEN "
                        Pending" WHEN admin_user_invites.status = 4 THEN "Approved"  ELSE "Inactive" END as status') )
                        ->orderBy('admin_user_invites.id', 'DESC')->get();
            $data['account_types'] = AdminGroup::all();
            return view('admin::view_adminpersonel',['result' => $data]);
        } catch (\Exception $ex) {
            return redirect(config('constant.home_route'))->with('failure', config('constant.default_error_message'));
        }       
    }

    public function editAdminPersonel(Request $request,$id)
    {
        try {
            $data['account_type'] = AdminGroup::all();
            $data['invite'] = ManageInvites::findOrFail($id);
            return view('admin::edit_adminpersonel',['result' => $data]);
        } catch (\Exception $ex) {
            return redirect(config('constant.home_route'))->with('failure', config('constant.default_error_message'));
        }        
    }


    public function updateInvites(Request $request)
    {
        try {
            $maninv = ManageInvites::findOrFail($request->id);
            $maninv->name = $request->name;
            $maninv->email = $request->email;
            $maninv->account_type = $request->account_type;
            $maninv->message = $request->message;
            $maninv->status = 2;
            $maninv->created_date = date('Y-m-d h:i:s');
            $maninv->approved_date = date('Y-m-d h:i:s');
            $maninv->save();

            if($maninv->id) {
                return $this->sendSuccessResponse('Invites Updated Successfully');
            } else {
                return $this->sendFailureResponse('Error in Update Invites');
            }
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('User not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }      
    }

    public function blockInvites(Request $request)
    {
        try {
            $mi = ManageInvites::findOrFail($_POST['id']);
            $mi->is_blocked = $_POST['status'];
            $mi->approved_date = date('Y-m-d h:i:s');
            $mi->save();
            if($mi->id) {
                $user = User::where('email', $mi->email )->first();
                if($user) {
                    $updatedUser = User::where('email', $mi->email)->update(['status' => $_POST['status']]);
                }
                return $this->sendSuccessResponse('Status Updated Successfully');
            } else {
                return $this->sendFailureResponse('Error in Update status');
            }
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('User not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }        
    }

    public function resendInvites(Request $request)
    {
        try {
            $code = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890",5)),0,8 );
            $password = Hash::make($code);
            $mi = ManageInvites::findOrFail($_POST['id']);
            $mi->created_date = date('Y-m-d h:i:s');
            $mi->password = $password;
            $mi->save();
            if($mi->id) {
                $updatedUser = User::where('email', $mi->email)->update(['password' => Hash::make($code)]);
                $data['name'] = $mi->name;
                $data['code'] = $code;
                $mail['to'] = $mi->email;
                $mail['name'] = $mi->name;
                Mail::send('emails.invites', $data, function($message)use($mail) {
                                $message->to($mail['to'], $mail['name'])->subject('Resend Invites');
                            });
                return $this->sendSuccessResponse('Status Updated Successfully');
            } else {
                return $this->sendFailureResponse('Error in Update status');
            }
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('User not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }       
    }

    public function adminPermissions()
    {
        try {
            $data['account_types'] = AdminGroup::all()->sortByDesc("id");
            $data['permission_menu'] = Permissionmenu::all()->sortByDesc("id");
            $data['users'] =User::all()->sortByDesc("id");
            return view('admin::view_adminpermission',['result' => $data]);
        } catch (\Exception $ex) {
            return redirect(config('constant.home_route'))->with('failure', config('constant.default_error_message'));
        }       
    }

    public function savePermission(Request $request)
    {
        try {
            $user = Session::get('user');
            if($request->get('id')) {
                $per_chk1 = UserPermission::where('user_group_id', '=', $request->user_group_id)->where('id', '!=', $request->get('id'))->first();
                if(empty($per_chk1)) {
                    $userper = UserPermission::findOrFail($request->get('id'));
                    $userper->user_id = $user->id;
                    $userper->user_group_id = $request->user_group_id;
                    $userper->user_access = $request->user_access;
                    $userper->heading = $request->heading;
                    $userper->supervisor_id = $request->supervisor_id;
                    $userper->subordinate_id = $request->subordinate_id;
                    $userper->modified_by	 = $user->id;//get by session
                    $userper->status = 1;
                    $userper->created_date = date('Y-m-d h:i:s');
                    $userper->modified_date = date('Y-m-d h:i:s');
                    $userper->save();
                    return $this->sendSuccessResponse('User Permission Updated');
                } else {
                    return $this->sendFailureResponse('User Permission Already Exists');
                }
            } else {
                $per_chk  = UserPermission::where('user_group_id', '=', $request->user_group_id)->first();
                if(empty($per_chk)) {
                    $userper = new UserPermission();
                    $userper->user_id = $user->id;
                    $userper->user_group_id = $request->user_group_id;
                    $userper->user_access = $request->user_access;
                    $userper->heading = $request->heading;
                    $userper->supervisor_id = $request->supervisor_id;
                    $userper->subordinate_id = $request->subordinate_id;
                    $userper->modified_by	 = $user->id;//get by session
                    $userper->status = 1;
                    $userper->created_date = date('Y-m-d h:i:s');
                    $userper->modified_date = date('Y-m-d h:i:s');
                    $userper->save();
                    return $this->sendSuccessResponse('User Permission Added');
                } else {
                    return $this->sendFailureResponse('User Permission Already Exists');
                }
            }
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('User not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }       
    }

    public function saveUserGroup(Request $request)
    {
        try {
            $per_chk  = AdminGroup::where('usergroup_name', '=', $request->group_name)->first();
            if(empty($per_chk)) {
                $userper = new AdminGroup();
                $userper->usergroup_name = $request->group_name;
                $userper->status = 1;
                $userper->created_datetime = date('Y-m-d h:i:s');
                $userper->modified_datetime = date('Y-m-d h:i:s');
                $userper->save();
                return $this->sendSuccessResponse('User Group Added Successfully');
            } else {
                return $this->sendFailureResponse('User Group Already Exists');
            }
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('User not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }        
    }

    public function getAdminPermission(Request $request)
    {
        try {
            $data['permission'] = UserPermission::where('user_group_id',$_POST['id'])->first();
            if(empty($data['permission'])) {
                $data['status_code'] ='100';
            } else {
                $data['status_code'] ='200';
            }
            return $this->sendSuccessResponse('Permission found', $data);
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('Permission not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }         
    }

    public function blockStaffInvites(Request $request)
    {
        try {
            $mi = Staffinvites::findOrFail($request->id);
            $mi->is_blocked = $request->stat;
            $mi->approved_date = date('Y-m-d h:i:s');
            $mi->save();
            if($mi->id) {
                $univ = University::where('email', $mi->email )->first();
                if($univ) {
                    $updatedUniv = University::where('email', $mi->email)->update(['status' => $request->stat]);
                }
                return $this->sendSuccessResponse('Status Updated Successfully');
            } else {
                return $this->sendFailureResponse('Error in Update status');
            }
            return ($data);
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('User not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }        
    }
    // Agent staff invites
    public function blockAgentStaffInvites(Request $request)
    {
        try {
            $mi = Agentstaffinvites::findOrFail($request->id);
            $mi->is_blocked = $request->stat;
            $mi->approved_date = date('Y-m-d h:i:s');
            $mi->save();
            if($mi->id) {
                $univ = Agent::where('email', $mi->email )->first();
                if($univ) {
                    $updatedUniv = Agent::table('agent')->where('email', $mi->email)->update(['status' => $request->stat]);
                }
                return $this->sendSuccessResponse('Status Updated Successfully');
            } else {
                return $this->sendFailureResponse('Error in Update status');
            }
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('User not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }       
    }

    public function resendStaffInvites(Request $request)
    {
        try {
            $code = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890",5)),0,8 );
            $password = Hash::make($code);
            $mi = Staffinvites::findOrFail($request->id);
            $mi->created_date = date('Y-m-d h:i:s');
            $mi->password = $password;
            $mi->save();
            if($mi->id) {
                $updatedUniv = University::where('email', $mi->email)->update(['password' => Hash::make($code)]);
                $data['name'] = $mi->name;
                $data['code'] = $code;
                $mail['to'] = $mi->email;
                $mail['name'] = $mi->name;
                Mail::send('emails.staffinvites', $data, function($message)use($mail) {
                                $message->to($mail['to'], $mail['name'])->subject('Resend Invites');
                            });
                return $this->sendSuccessResponse('Invites sent Successfully');
            } else {
                return $this->sendFailureResponse('Error in Update status');
            }
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('User not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }           
    }
    // Agent resend invites
    public function resendAgentStaffInvites(Request $request)
    {
        try {
            $code = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890",5)),0,8 );
            $password = Hash::make($code);
            $mi = Agentstaffinvites::findOrFail($request->id);
            $mi->created_date = date('Y-m-d h:i:s');
            $mi->password = $password;
            $mi->save();
            if($mi->id) {
                $updatedUniv = DB::table('agent')
                    ->where('email', $mi->email)
                    ->update(['password' => Hash::make($code)]);
                $data['name'] = $mi->name;
                $data['code'] = $code;
                $mail['to'] = $mi->email;
                $mail['name'] = $mi->name;
                Mail::send('emails.agentstaffinvites', $data, function($message)use($mail) {
                                $message->to($mail['to'], $mail['name'])->subject('Resend Invites');
                            });
                return $this->sendSuccessResponse('Invites sent Successfully');
            } else {
                return $this->sendFailureResponse('Error in Update status');
            }
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('User not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }       
    }

    public function saveUniversityPermission(Request $request)
    {
        try {
            $user = Session::get('user');
            if($request->get('id')) {
                $per_chk1    = UniversityPermission::where('university_id', '=', $request->university_id)->where('user_group_id', '=', $request->user_group_id)->where('id', '!=', $request->get('id'))->first();
                if(empty($per_chk1)) {
                    $userper = UniversityPermission::findOrFail($request->get('id'));
                    $userper->university_id = $request->university_id;
                    $userper->user_group_id = $request->user_group_id;
                    $userper->user_access = $request->user_access;
                    $userper->heading = $request->heading;
                    $userper->supervisor_id = $request->supervisor_id;
                    $userper->subordinate_id = $request->subordinate_id;
                    $userper->modified_by	 = $request->university_id;//get by session
                    $userper->status = 1;
                    $userper->created_date = date('Y-m-d h:i:s');
                    $userper->modified_date = date('Y-m-d h:i:s');
                    $userper->save();
                    return $this->sendSuccessResponse('University Permission Updated');
                } else {
                    return $this->sendFailureResponse('University Permission Already Exists');
                }
            } else {
                $per_chk    = UniversityPermission::where('university_id', '=', $request->university_id)->where('user_group_id', '=', $request->user_group_id)->first();
                if(empty($per_chk)) {
                    $userper = new UniversityPermission();
                    $userper->university_id = $request->university_id;
                    $userper->user_group_id = $request->user_group_id;
                    $userper->user_access = $request->user_access;
                    $userper->heading = $request->heading;
                    $userper->supervisor_id = $request->supervisor_id;
                    $userper->subordinate_id = $request->subordinate_id;
                    $userper->modified_by	 = $request->university_id;//get by session
                    $userper->status = 1;
                    $userper->created_date = date('Y-m-d h:i:s');
                    $userper->modified_date = date('Y-m-d h:i:s');
                    $userper->save();
                    return $this->sendSuccessResponse('University Permission Added');
                } else {
                    return $this->sendFailureResponse('University Permission Already Exists');
                }
            }
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('Permission not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }       
    }
    // Save Agent permission
    public function saveAgentPermission(Request $request)
    {
        try {
            $agent = Session::get('agent');
            $parent_count = Agent::where('id', '=', $request->agent_id)->get();
            $type = $parent_count[0]->type;    // if type-> 0 parent  else 1
            if($type == 0) {
                $agent_id = $request->agent_id;
            }
            if($type == 1) {
                $db = Agentstaffinvites::leftJoin('agent', 'agent_staff_invites.email', '=', 'agent.email')
                            ->select('agent_staff_invites.*','agent.*')
                            ->where('agent.id', '=', $request->agent_id)
                            ->orderBy('agent.id', 'DESC')->get();
                $agent_id = $db[0]->agent_id;
            }
            if($request->get('id')) {
                $per_chk1    = Agentpermission::where('agent_id', '=', $agent_id)->where('user_group_id', '=', $request->user_group_id)->where('id', '!=', $request->get('id'))->first();
                if(empty($per_chk1)) {
                    $userper = Agentpermission::findOrFail($request->get('id'));
                    $userper->agent_id = $agent_id;
                    $userper->user_group_id = $request->user_group_id;
                    $userper->user_access = $request->user_access;
                    $userper->heading = $request->heading;
                    $userper->supervisor_id = $request->supervisor_id;
                    $userper->subordinate_id = $request->subordinate_id;
                    $userper->modified_by	 = $request->agent_id;//get by session
                    $userper->status = 1;
                    $userper->created_date = date('Y-m-d h:i:s');
                    $userper->modified_date = date('Y-m-d h:i:s');
                    $userper->save();
                    return $this->sendSuccessResponse('Agent Permission Updated');
                } else {
                    return $this->sendFailureResponse('Agent Permission Already Exists');
                }
            } else {
                $per_chk    = Agentpermission::where('agent_id', '=', $agent_id)->where('user_group_id', '=', $request->user_group_id)->first();
                if(empty($per_chk)) {
                    $userper = new Agentpermission();
                    $userper->agent_id = $agent_id;
                    $userper->user_group_id = $request->user_group_id;
                    $userper->user_access = $request->user_access;
                    $userper->heading = $request->heading;
                    $userper->supervisor_id = $request->supervisor_id;
                    $userper->subordinate_id = $request->subordinate_id;
                    $userper->modified_by	 = $request->agent_id;//get by session
                    $userper->status = 1;
                    $userper->created_date = date('Y-m-d h:i:s');
                    $userper->modified_date = date('Y-m-d h:i:s');
                    $userper->save();
                    return $this->sendSuccessResponse('Agent Permission Added');
                } else {
                    return $this->sendFailureResponse('Agent Permission Already Exists');
                }
            }
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('Permission not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }      
    }

    public function saveAgentPermission11(Request $request)
    {
        try {
            $agent = Session::get('agent');
            $agent_id = $request->agent_id;
            $inv_count = Agentstaffinvites::where('agent_id', '=', $request->agent_id)->get();
            if(count($inv_count) == 0) {
                $parent_count = Agent::where('id', '=', $request->agent_id)->get();
                if($request->get('id')) {
                    $per_chk1 = Agentpermission::where('agent_id', '=', $request->agent_id)->where('user_group_id', '=', $request->user_group_id)->where('id', '!=', $request->get('id'))->first();
                    if(empty($per_chk1)) {
                        $userper = Agentpermission::findOrFail($request->get('id'));
                        $userper->agent_id = $request->agent_id;
                        $userper->user_group_id = $request->user_group_id;
                        $userper->user_access = $request->user_access;
                        $userper->heading = $request->heading;
                        $userper->supervisor_id = $request->supervisor_id;
                        $userper->subordinate_id = $request->subordinate_id;
                        $userper->modified_by	 = $request->agent_id;//get by session
                        $userper->status = 1;
                        $userper->created_date = date('Y-m-d h:i:s');
                        $userper->modified_date = date('Y-m-d h:i:s');
                        $userper->save();
                        return $this->sendSuccessResponse('Agent Permission Updated');
                    } else {
                        return $this->sendFailureResponse('Agent Permission Already Exists');
                    }
                } else {
                    $per_chk    = Agentpermission::where('agent_id', '=', $request->agent_id)->where('user_group_id', '=', $request->user_group_id)->first();
                    if(empty($per_chk)) {
                        $userper = new Agentpermission();
                        $userper->agent_id = $request->agent_id;
                        $userper->user_group_id = $request->user_group_id;
                        $userper->user_access = $request->user_access;
                        $userper->heading = $request->heading;
                        $userper->supervisor_id = $request->supervisor_id;
                        $userper->subordinate_id = $request->subordinate_id;
                        $userper->modified_by	 = $request->agent_id;//get by session
                        $userper->status = 1;
                        $userper->created_date = date('Y-m-d h:i:s');
                        $userper->modified_date = date('Y-m-d h:i:s');
                        $userper->save();
                        return $this->sendSuccessResponse('Agent Permission Added');
                    } else {
                        return $this->sendFailureResponse('Agent Permission Already Exists');
                    }
                }
            } else if(count($inv_count) > 0) {
                $inv_email = Agentstaffinvites::where('email', '=', $inv_count[0]->email)->get();
                echo $inv_email[0]->agent_id;
                $parent_agent_id = Agent::where('email', '=', $inv_count[0]->email)->get();
                $parent_agent = $parent_agent_id[0]->id;
                $data['inv_name'] = Agentstaffinvites::where('agent_id',$request->agent_id)->orderBy('id','desc')->get();
                $db = Agentstaffinvites::leftJoin('agent', 'agent_staff_invites.email', '=', 'agent.email')
                            ->select('agent_staff_invites.*','agent.*')
                            ->where('agent_staff_invites.agent_id', '=', $request->agent_id)
                            ->orderBy('agent.id', 'DESC')->get();
                $tot_agent_id = array();
                $parent_agent_id = array();
                foreach($db as $key=>$val) {
                    echo $val->agent_id;
                    echo $val->id;
                    $tot_agent_id[] = $val->id;
                    $parent_agent_id[]= $val->agent_id;
                }
                $org_agent = array_merge($parent_agent_id,$tot_agent_id);
                echo '<pre>'; print_R($org_agent); echo '</pre>';
                if($request->get('id')) {
                    foreach($org_agent as $key=>$val) {
                        $per_chk1 = Agentpermission::where('agent_id', '=', $val)->where('user_group_id', '=', $request->user_group_id)->where('id', '!=', $request->get('id'))->first();
                        if(empty($per_chk1)) {
                            $userper = Agentpermission::findOrFail($request->get('id'));
                            $userper->agent_id = $request->agent_id;
                            $userper->user_group_id = $request->user_group_id;
                            $userper->user_access = $request->user_access;
                            $userper->heading = $request->heading;
                            $userper->supervisor_id = $request->supervisor_id;
                            $userper->subordinate_id = $request->subordinate_id;
                            $userper->modified_by	 = $request->agent_id;//get by session
                            $userper->status = 1;
                            $userper->created_date = date('Y-m-d h:i:s');
                            $userper->modified_date = date('Y-m-d h:i:s');
                            $userper->save();
                            return $this->sendSuccessResponse('Agent Permission Updated');
                        } else {
                            return $this->sendFailureResponse('Agent Permission Already Exists');
                        }
                    }
                } else {
                    foreach($org_agent as $key=>$val) {
                        $per_chk    = Agentpermission::where('agent_id', '=', $val)->where('user_group_id', '=', $request->user_group_id)->first();
                        if(empty($per_chk)) {
                            $userper = new Agentpermission();
                            $userper->agent_id = $val;
                            $userper->user_group_id = $request->user_group_id;
                            $userper->user_access = $request->user_access;
                            $userper->heading = $request->heading;
                            $userper->supervisor_id = $request->supervisor_id;
                            $userper->subordinate_id = $request->subordinate_id;
                            $userper->modified_by	 = $request->agent_id;//get by session
                            $userper->status = 1;
                            $userper->created_date = date('Y-m-d h:i:s');
                            $userper->modified_date = date('Y-m-d h:i:s');
                            $userper->save();
                            return $this->sendSuccessResponse('Agent Permission Added');
                        } else {
                            return $this->sendFailureResponse('Agent Permission Already Exists');
                        }
                    }
                }
            }
            if(count($inv_count) > 0) {
                if($request->get('id')) {
                    foreach($org_agent as $key=>$val) {
                        $per_chk1 = Agentpermission::where('agent_id', '=', $val)->where('user_group_id', '=', $request->user_group_id)->where('id', '!=', $request->get('id'))->first();
                        if(empty($per_chk1)) {
                            $userper = Agentpermission::findOrFail($request->get('id'));
                            $userper->agent_id = $request->agent_id;
                            $userper->user_group_id = $request->user_group_id;
                            $userper->user_access = $request->user_access;
                            $userper->heading = $request->heading;
                            $userper->supervisor_id = $request->supervisor_id;
                            $userper->subordinate_id = $request->subordinate_id;
                            $userper->modified_by	 = $request->agent_id;//get by session
                            $userper->status = 1;
                            $userper->created_date = date('Y-m-d h:i:s');
                            $userper->modified_date = date('Y-m-d h:i:s');
                            $userper->save();
                            return $this->sendSuccessResponse('Agent Permission Updated');
                        } else {
                            return $this->sendFailureResponse('Agent Permission Already Exists');
                        }
                    }
                } else {
                    foreach($org_agent as $key=>$val) {
                        $per_chk    = Agentpermission::where('agent_id', '=', $val)->where('user_group_id', '=', $request->user_group_id)->first();
                        if(empty($per_chk)) {
                            $userper = new Agentpermission();
                            $userper->agent_id = $val;
                            $userper->user_group_id = $request->user_group_id;
                            $userper->user_access = $request->user_access;
                            $userper->heading = $request->heading;
                            $userper->supervisor_id = $request->supervisor_id;
                            $userper->subordinate_id = $request->subordinate_id;
                            $userper->modified_by	 = $request->agent_id;//get by session
                            $userper->status = 1;
                            $userper->created_date = date('Y-m-d h:i:s');
                            $userper->modified_date = date('Y-m-d h:i:s');
                            $userper->save();
                            return $this->sendSuccessResponse('Agent Permission Added');
                        } else {
                            return $this->sendFailureResponse('Agent Permission Already Exists');
                        }
                    }
                }
            }
            if(count($inv_count) == 0) {
                if($request->get('id')) {
                    $per_chk1 = Agentpermission::where('agent_id', '=', $request->agent_id)->where('user_group_id', '=', $request->user_group_id)->where('id', '!=', $request->get('id'))->first();
                    if(empty($per_chk1)) {
                        $userper = Agentpermission::findOrFail($request->get('id'));
                        $userper->agent_id = $request->agent_id;
                        $userper->user_group_id = $request->user_group_id;
                        $userper->user_access = $request->user_access;
                        $userper->heading = $request->heading;
                        $userper->supervisor_id = $request->supervisor_id;
                        $userper->subordinate_id = $request->subordinate_id;
                        $userper->modified_by	 = $request->agent_id;//get by session
                        $userper->status = 1;
                        $userper->created_date = date('Y-m-d h:i:s');
                        $userper->modified_date = date('Y-m-d h:i:s');
                        $userper->save();
                        return $this->sendSuccessResponse('Agent Permission Updated');
                    } else {
                        return $this->sendFailureResponse('Agent Permission Already Exists');
                    }
                } else {
                    $per_chk    = Agentpermission::where('agent_id', '=', $request->agent_id)->where('user_group_id', '=', $request->user_group_id)->first();
                    if(empty($per_chk)) {
                        $userper = new Agentpermission();
                        $userper->agent_id = $request->agent_id;
                        $userper->user_group_id = $request->user_group_id;
                        $userper->user_access = $request->user_access;
                        $userper->heading = $request->heading;
                        $userper->supervisor_id = $request->supervisor_id;
                        $userper->subordinate_id = $request->subordinate_id;
                        $userper->modified_by	 = $request->agent_id;//get by session
                        $userper->status = 1;
                        $userper->created_date = date('Y-m-d h:i:s');
                        $userper->modified_date = date('Y-m-d h:i:s');
                        $userper->save();
                        return $this->sendSuccessResponse('Agent Permission Added');
                    } else {
                        return $this->sendFailureResponse('Agent Permission Already Exists');
                    }
                }
            }
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('Permission not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }        
    }

    public function saveAgentPermissionOrg(Request $request)
    {
        try {
            $agent = Session::get('agent');
            $agent_id = $request->agent_id;
            $inv_count = Agentstaffinvites::where('agent_id', '=', $request->agent_id)->get();
            $inv_count = Agentstaffinvites::where('email', '=', $request->agent_id)->get();
            echo "count_".count($inv_count);
            if(count($inv_count) == 0) {
                echo 'invite  only available in agent';
            } else {
                echo 'Available in Agent and agent staff invite';
            }
            echo $agent_id = $request->agent_id;  exit;
            if($request->get('id')) {
                $per_chk1 = Agentpermission::where('agent_id', '=', $request->agent_id)->where('user_group_id', '=', $request->user_group_id)->where('id', '!=', $request->get('id'))->first();
                if(empty($per_chk1)) {
                    $userper = Agentpermission::findOrFail($request->get('id'));
                    $userper->agent_id = $request->agent_id;
                    $userper->user_group_id = $request->user_group_id;
                    $userper->user_access = $request->user_access;
                    $userper->heading = $request->heading;
                    $userper->supervisor_id = $request->supervisor_id;
                    $userper->subordinate_id = $request->subordinate_id;
                    $userper->modified_by	 = $request->agent_id;//get by session
                    $userper->status = 1;
                    $userper->created_date = date('Y-m-d h:i:s');
                    $userper->modified_date = date('Y-m-d h:i:s');
                    $userper->save();
                    return $this->sendSuccessResponse('Agent Permission Updated');
                } else {
                    return $this->sendFailureResponse('Agent Permission Already Exists');
                }
            } else {
                $per_chk = Agentpermission::where('agent_id', '=', $request->agent_id)->where('user_group_id', '=', $request->user_group_id)->first();
                if(empty($per_chk)) {
                    $userper = new Agentpermission();
                    $userper->agent_id = $request->agent_id;
                    $userper->user_group_id = $request->user_group_id;
                    $userper->user_access = $request->user_access;
                    $userper->heading = $request->heading;
                    $userper->supervisor_id = $request->supervisor_id;
                    $userper->subordinate_id = $request->subordinate_id;
                    $userper->modified_by	 = $request->agent_id;//get by session
                    $userper->status = 1;
                    $userper->created_date = date('Y-m-d h:i:s');
                    $userper->modified_date = date('Y-m-d h:i:s');
                    $userper->save();
                    return $this->sendSuccessResponse('Agent Permission Added');
                } else {
                    return $this->sendFailureResponse('Agent Permission Already Exists');
                }
            }
        } catch (ModelNotFoundException $ex) {
            return $this->sendFailureResponse('Permission not found');		
        } catch (Exception $ex) {
            return $this->sendFailureDefaultResponse();
        }      
    }
}
