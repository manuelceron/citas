<?php

namespace App\Http\Controllers;

//use App\Http\Requests\StoreStripeRequest;
//use App\Http\Requests\UpdateStripeRequest;
use App\Models\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;


class StripeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('stripe_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stripes = Stripe::all();

        return view('modules.stripe.index', compact('stripes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stripe  $stripe
     * @return \Illuminate\Http\Response
     */
    public function show(Stripe $stripe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stripe  $stripe
     * @return \Illuminate\Http\Response
     */
    public function edit(Stripe $stripe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stripe  $stripe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stripe $stripe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stripe  $stripe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stripe $stripe)
    {
        //
    }
}
