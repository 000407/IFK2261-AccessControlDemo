@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>{{ __('Checkout') }}</h3></div>
                <div class="card-body">
                    <div class="row g-5">
                      <div class="col-md-5 col-lg-4 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                          <span class="text-primary">Your cart</span>
                          <span class="badge bg-primary rounded-pill">3</span>
                        </h4>
                        <ul class="list-group mb-3">
                          <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                              <h6 class="my-0">Product name</h6>
                              <small class="text-body-secondary">Brief description</small>
                            </div>
                            <span class="text-body-secondary">$12</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                              <h6 class="my-0">Second product</h6>
                              <small class="text-body-secondary">Brief description</small>
                            </div>
                            <span class="text-body-secondary">$8</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                              <h6 class="my-0">Third item</h6>
                              <small class="text-body-secondary">Brief description</small>
                            </div>
                            <span class="text-body-secondary">$5</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                            <div class="text-success">
                              <h6 class="my-0">Promo code</h6>
                              <small>EXAMPLECODE</small>
                            </div>
                            <span class="text-success">−$5</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>$20</strong>
                          </li>
                        </ul>

                        <!-- <form class="card p-2">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Promo code">
                            <button type="submit" class="btn btn-secondary">Redeem</button>
                          </div>
                        </form> -->
                      </div>
                      <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3">Billing address</h4>
                        <form class="needs-validation" novalidate="" action="{{ route('process_payment') }}" method="POST">
                          @csrf
                          <div class="row g-3">
                            <div class="col-sm-6">
                              <label for="firstName" class="form-label">First name</label>
                              <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required="">
                              <div class="invalid-feedback">
                                Valid first name is required.
                              </div>
                            </div>

                            <div class="col-sm-6">
                              <label for="lastName" class="form-label">Last name</label>
                              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required="">
                              <div class="invalid-feedback">
                                Valid last name is required.
                              </div>
                            </div>

                            <div class="col-12">
                              <label for="email" class="form-label">Email <span class="text-body-secondary">(Optional)</span></label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
                              <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                              </div>
                            </div>

                            <div class="col-12">
                              <label for="address" class="form-label">Address</label>
                              <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required="">
                              <div class="invalid-feedback">
                                Please enter your shipping address.
                              </div>
                            </div>

                            <div class="col-12">
                              <label for="address2" class="form-label">Address 2 <span class="text-body-secondary">(Optional)</span></label>
                              <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment or suite">
                            </div>

                            <div class="col-md-5">
                              <label for="country" class="form-label">Country</label>
                              <select class="form-select" id="country" name="country" required="">
                                <option value="">Choose...</option>
                                <option>United States</option>
                              </select>
                              <div class="invalid-feedback">
                                Please select a valid country.
                              </div>
                            </div>

                            <div class="col-md-4">
                              <label for="state" class="form-label">State</label>
                              <select class="form-select" id="state" name="state" required="">
                                <option value="">Choose...</option>
                                <option>California</option>
                              </select>
                              <div class="invalid-feedback">
                                Please provide a valid state.
                              </div>
                            </div>

                            <div class="col-md-3">
                              <label for="zip" class="form-label">Zip</label>
                              <input type="text" class="form-control" id="zip" name="zip" placeholder="" required="">
                              <div class="invalid-feedback">
                                Zip code required.
                              </div>
                            </div>
                          </div>

                          <hr class="my-4">

                          <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="same-address id="nameme-address">
                            <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
                          </div>

                          <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="saveInfo"> name="saveInfo">
                            <label class="form-check-label" for="saveInfo">Save this information for next time</label>
                          </div>

                          <hr class="my-4">

                          <h4 class="mb-3">Payment</h4>

                          <div class="my-3">
                            <div class="form-check">
                              <input id="card_mastercard" name="cardType" type="radio" value="MASTERCARD" class="form-check-input">
                              <label class="form-check-label" for="card_mastercard">MasterCard</label>
                            </div>
                            <div class="form-check">
                              <input id="card_visa" name="cardType" type="radio" value="VISA" class="form-check-input">
                              <label class="form-check-label" for="card_mastercard">Visa</label>
                            </div>
                          </div>

                          <div class="row gy-3">
                            <div class="col-md-6">
                              <label for="cardNumber" class="form-label">Card Number</label>
                              <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="" required="">
                              <div class="invalid-feedback">
                                Credit card number is required
                              </div>
                            </div>

                            <div class="col-md-6">
                              <label for="nameOnCard" class="form-label">Name on card</label>
                              <input type="text" class="form-control" id="nameOnCard" name="nameOnCard" placeholder="" required="">
                              <small class="text-body-secondary">Full name as displayed on card</small>
                              <div class="invalid-feedback">
                                Name on card is required
                              </div>
                            </div>

                            <div class="col-md-3">
                              <label for="cardExpiration" class="form-label">Expiration</label>
                              <input type="text" class="form-control" id="cardExpiration" name="cardExpiration" placeholder="" required="">
                              <div class="invalid-feedback">
                                Expiration date required
                              </div>
                            </div>

                            <div class="col-md-3">
                              <label for="cardCvv" class="form-label">CVV</label>
                              <input type="text" class="form-control" id="cardCvv" name="cardCvv" placeholder="" required="">
                              <div class="invalid-feedback">
                                Security code required
                              </div>
                            </div>
                          </div>

                          <hr class="my-4">

                          <button class="w-100 btn btn-primary btn-lg" type="submit">Confirm & Pay</button>
                        </form>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection