@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $page_data->contact_heading }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <form action="{{ route('contact_send_email') }}" method="post" class="form_contact_ajax">
                    @csrf
                    <div class="contact-form">
                        <div class="mb-3">
                            <label for="" class="form-label">Name *</label>
                            <input type="text" class="form-control" name="name">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email Address *</label>
                            <input type="text" class="form-control" name="email">
                            <span class="text-danger error-text email_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Message *</label>
                            <textarea class="form-control" rows="3" name="message"></textarea>
                            <span class="text-danger error-text message_error"></span>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary bg-website">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="map">
                    {{-- {!! $page_data->contact_map !!} --}}
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d597.8591283913545!2d35.74410525870612!3d32.04213862017727!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151ca2aa6c9505af%3A0xc1d8fa75aade030f!2sSalt%20Institute%20for%20careers%20traditional%20crafts!5e0!3m2!1sen!2sjo!4v1743993363178!5m2!1sen!2sjo" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    (function($){
        $(".form_contact_ajax").on('submit', function(e){
            e.preventDefault();
            $('#loader').show();
            var form = this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $(form).find('span.error-text').text('');
                },
                success:function(data)
                {
                    $('#loader').hide();
                    if(data.code == 0)
                    {
                        $.each(data.error_message, function(prefix, val) {
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                        });
                    }
                    else if(data.code == 1)
                    {
                        $(form)[0].reset();
                        iziToast.success({
                            title: '',
                            position: 'topRight',
                            message: data.success_message,
                        });
                    }
                    
                }
            });
        });
    })(jQuery);
</script>
<div id="loader"></div>
@endsection