<?php
/**
 * Author: Farai Zihove
 * Mobile: +263778234258
 * Email: zihovem@gmail.com
 * Date: 13/7/2023
 * Time: 15:05
 */
?>
@extends('layouts.app')
@section('content')

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Add Subscription</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Subscription</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="card-title text-white">Subscription Details</h5>
                </div>
                <div class="card-body">
                    <form id="payment-form" data-secret="{{ $intent->client_secret }}"
                          action="{{route('service.subscription')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row m-b-30">
                                            <div class="col-md-3">
                                                <div class="new-arrival-product">
                                                    <div class="new-arrivals-img-contnent">
                                                        <img class="img-fluid"
                                                             src="{{asset('images/courses/pic1.jpg')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="new-arrival-content position-relative">
                                                    <h4>Choose your preferred package</h4>

                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="form-group row">
                                                            @foreach($plans as $plan)
                                                                <label class="radio-inline col-lg-3">
                                                                    <input type="radio" name="package"
                                                                           value="{{$plan->stripe_key}}">
                                                                    <p>{{$plan->name}}</p>
                                                                    <p class="price">
                                                                        ${{number_format($plan->amount)}}</p></label>
                                                            @endforeach

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Card Holder Name</label>
                                                            <input id="card-holder-name" type="text"
                                                                   value="{{old('name')}}"
                                                                   class="form-control @error('name') is-invalid @enderror"
                                                                   name="name">
                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!-- Stripe Elements Placeholder -->
                                                    <div class="col-md-8 p-4" id="card-element"></div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <button type="submit" class="btn btn-primary" id="card-button">
                                                            Subscribe
                                                        </button>
                                                        <a href="{{route('dashboard')}}"
                                                           class="btn btn-danger">Cancel</a>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>

        <script>
            const stripeKey = '{{ env('STRIPE_KEY') }}';
            const stripe = Stripe(stripeKey);

            const elements = stripe.elements();
            const cardElement = elements.create('card');

            cardElement.mount('#card-element');

            const form = document.getElementById('payment-form')
            const cardButton = document.getElementById('card-button')
            const cardHolderName = document.getElementById('card-holder-name');
            const clientSecret = form.dataset.secret;

            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const {setupIntent, error} = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: {name: cardHolderName.value}
                        }
                    }
                );

                if (error) {
                    console.log(error.message);
                } else {
                    // The card has been verified successfully...
                    stripeTokenHandler(setupIntent);
                }
            });

            function stripeTokenHandler(setupIntent) {
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', setupIntent.payment_method);
                form.appendChild(hiddenInput);
                form.submit();
            }
        </script>
    @endpush
@endsection

