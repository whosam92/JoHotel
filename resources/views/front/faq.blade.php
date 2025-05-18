@extends('front.layout.app')

@section('main_content')
<div class="page-top">
            <div class="bg"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>FAQ</h2>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
 How can I modify or cancel my reservation?
                                </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
You can modify or cancel your reservation by visiting the "Contact Us" page on our website and send us a message or find the phone number up in the Navbar in our website so our team will help you .                                      </p>
                                        <p>
Make sure you have your booking reference number on the invoices that you can share with our team and email it on info@JoHotel.com to change, or cancel your reservation as per our cancellation policy.                                          </p>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Is my credit card charged at the time of booking?
                                </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                              Yes, if you enter your Card Details at the checkout page and choose to complete  booking a room select, our website will process your request and go with immediate payment to your card. 
                                        </p>
                                        <p>
Please check the payment terms during the booking process for specific details before you submit your request.                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Are taxes and fees included in the room rate?
                                </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
total amount displayed during booking includes applicable taxes and fees.                                       </p>
                                        <p>
                                             Additional charges, such as resort fees or city taxes, may apply and will be clearly stated during the booking process. 
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection