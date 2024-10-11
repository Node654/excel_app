<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Resources\Payment\PaymentResource;
use App\Models\Payment;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function index(Project $project)
    {
        return Inertia::render('Payment/Index', ['payments' => PaymentResource::collection($project->payments()->paginate(5))]);
    }
}
