<!-- About Us Page for Jo Hotel -->
@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg" style="background-image: url('https://cache.marriott.com/content/dam/marriott-digital/mc/emea/hws/a/ammjr/en_us/photo/unlimited/assets/ammjr-exterior-0132.jpg'); background-size: cover; background-position: center; height: 300px; position: relative;">
        <div class="container h-100 d-flex justify-content-center align-items-center">
        
            </div>
        </div>
    </div>
</div>

<div class="page-content py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <h3 class="mb-3" style="font-weight: bold; color: #E75542;">Welcome to Jo Hotel</h3>
                <p>Located in the heart of Amman, Jo Hotel offers an unmatched blend of comfort, luxury, and authentic Jordanian hospitality. Whether you're here for business, leisure, or a family vacation, we strive to provide a memorable stay with modern amenities and exceptional service.</p>
                <p>Our hotel features elegantly designed rooms, top-notch facilities, and easy access to the city's cultural and historical attractions. Enjoy your stay with us and discover why Jo Hotel is the preferred choice for travelers from around the globe.</p>
                <p><strong>Your comfort is our priority:</strong></p>
                <ul class="list-unstyled mb-4">
                    <li><i class="fa fa-check-circle" style="color: #E75542; margin-right: 5px;"></i> 24-hour room service</li>
                    <li><i class="fa fa-check-circle" style="color: #E75542; margin-right: 5px;"></i> Modern fitness center</li>
                    <li><i class="fa fa-check-circle" style="color: #E75542; margin-right: 5px;"></i> Rooftop swimming pool</li>
                    <li><i class="fa fa-check-circle" style="color: #E75542; margin-right: 5px;"></i> High-speed internet access</li>
                    <li><i class="fa fa-check-circle" style="color: #E75542; margin-right: 5px;"></i> Luxurious spa and wellness center</li>
                </ul>
            </div>

            <div class="col-lg-6 mb-4">
                <img src="https://www.twowanderingsoles.com/wp-content/uploads/2022/09/IMG_0652.jpg" class="img-fluid rounded shadow" alt="Jo Hotel Room">
            </div>
        </div>
    </div>
</div>

<div class="bg-light py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h3 class="mb-4" style="font-weight: bold; color: #E75542;">Experience the Essence of Jordan</h3>
                <p>From the ancient ruins of Petra to the vibrant streets of Amman, Jo Hotel is your gateway to discovering the best of Jordan. Our concierge is always ready to assist in planning your adventures and ensuring a seamless stay.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary mt-3" style="background-color: #E75542; border-color: #E75542;">Contact Us</a>
            </div>
        </div>
    </div>
</div>

@endsection
