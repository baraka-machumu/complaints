<?php

namespace App\Http\Controllers;

use App\Complainer;
use App\Complaint;
use App\ComplaintType;
use App\Http\Controllers\Complaints\ComplaintsController;
use App\Letter;
use App\MembershipStatus;
use App\Response;
use App\ResponseType;
use App\Scheme;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ErrorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function errorRedirect()
    {
        return view('error');
    }

}
