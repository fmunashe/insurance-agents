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
                                                        <img class="img-fluid" src="images/product/2.jpg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="new-arrival-content position-relative">
                                                    <h4>Solid Women's V-neck Dark T-Shirt</h4>
                                                    <p class="price">$320.00</p>
                                                    <p>Availability: <span class="item"> In stock <i
                                                                class="fa fa-check-circle text-success"></i></span></p>
                                                    <p>Product code: <span class="item">0405689</span></p>
                                                    <p>Brand: <span class="item">Lee</span></p>
                                                    <p class="text-content">There are many variations of passages of Lorem Ipsum available,
                                                        but the majority have suffered alteration in some form, by injected humour, or
                                                        randomised words which don't look even slightly believable. If you
                                                        are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything
                                                        embarrassing.</p>
                                                    <div class="comment-review star-rating text-right">
                                                        <ul>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star-half-empty"></i></li>
                                                            <li><i class="fa fa-star-half-empty"></i></li>
                                                        </ul>
                                                        <span class="review-text">(34 reviews) / </span><a class="product-review" href="">Write
                                                            a review?</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Card Holder Name</label>
                                    <input id="card-holder-name" type="text" value="{{old('name')}}"
                                           class="form-control @error('name') is-invalid @enderror" name="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Stripe Elements Placeholder -->
                            <div class="col-md-6 p-4" id="card-element"></div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-primary" id="card-button">Subscribe
                                </button>
                                <a href="{{route('dashboard')}}" class="btn btn-danger">Cancel</a>
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

                console.log('setup intent is');
                console.log(setupIntent)

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

