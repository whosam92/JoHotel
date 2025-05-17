

(function ($) {
    "use strict";

    $(".scroll-top").hide();
    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 300) {
            $(".scroll-top").fadeIn();
        } else {
            $(".scroll-top").fadeOut();
        }
    });
    $(".scroll-top").on("click", function () {
        $("html, body").animate({ scrollTop: 0 }, 700);
    });

    $(document).ready(function () {
        $(".select2").select2({
            theme: "bootstrap",
        });

        $("#checkShipping").on("change", function () {
            $(".shipping-form").toggle();
        });

        $(".paypal").hide();
        $(".stripe").hide();

        $("#paymentMethodChange").on("change", function () {
            if ($("#paymentMethodChange").val() == "PayPal") {
                $(".paypal").show();
                $(".stripe").hide();
            } else if ($("#paymentMethodChange").val() == "Stripe") {
                $(".paypal").hide();
                $(".stripe").show();
            } else {
                $(".paypal").hide();
                $(".stripe").hide();
            }
        });
    });

    new WOW().init();

    $(".video-button").magnificPopup({
        type: "iframe",
        gallery: {
            enabled: true,
        },
    });

    $(".magnific").magnificPopup({
        type: "image",
        gallery: {
            enabled: true,
        },
    });

    $(".slide-carousel").owlCarousel({
        loop: true,
        autoplay: false,
        autoplayHoverPause: true,
        margin: 0,
        mouseDrag: false,
        animateIn: "fadeIn",
        animateOut: "fadeOut",
        nav: true,
        navText: [
            "<i class='fa fa-caret-left'></i>",
            "<i class='fa fa-caret-right'></i>",
        ],
        responsive: {
            0: { items: 1 },
            600: { items: 1 },
            1000: { items: 1 },
        },
    });

    $(".testimonial-carousel").owlCarousel({
        loop: true,
        autoplay: true,
        autoplayHoverPause: true,
        autoplaySpeed: 1500,
        smartSpeed: 1500,
        margin: 30,
        nav: false,
        animateIn: "fadeIn",
        animateOut: "fadeOut",
        responsive: {
            0: { items: 1, dots: false, nav: true },
            768: { items: 1 },
            992: { items: 1 },
        },
    });

    $(".room-detail-carousel").owlCarousel({
        loop: true,
        autoplay: false,
        autoplayHoverPause: true,
        margin: 0,
        mouseDrag: false,
        animateIn: "fadeIn",
        animateOut: "fadeOut",
        nav: true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        responsive: {
            0: { items: 1 },
            600: { items: 1 },
            1000: { items: 1 },
        },
    });

    jQuery(".mean-menu").meanmenu({
        meanScreenWidth: "991",
    });

    // Global variable to hold booked dates
    var bookedDates = [];

    // Function to initialize the date range picker
    function initializeDateRangePicker() {
        $(".daterange1").daterangepicker({
            autoUpdateInput: false,
            minDate: new Date(),
            showDropdowns: false,
            locale: {
                format: "DD/MM/YYYY",
                cancelLabel: "Clear",
            },
            isInvalidDate: function (date) {
                var formattedDate = date.format("DD/MM/YYYY");

                // Check if date is a booked date
                if (bookedDates.includes(formattedDate)) {
                    return true;
                }

                // 🔥 New Logic: Disable single-day availability
                var prevDate = date
                    .clone()
                    .subtract(1, "days")
                    .format("DD/MM/YYYY");
                var nextDate = date.clone().add(1, "days").format("DD/MM/YYYY");

                // If previous and next dates are booked, disable the date as it is a single-day availability
                if (
                    bookedDates.includes(prevDate) &&
                    bookedDates.includes(nextDate)
                ) {
                    return true;
                }

                return false;
            },
        });

        $(".daterange1").on("apply.daterangepicker", function (ev, picker) {
            var startDate = picker.startDate.format("DD/MM/YYYY");
            var endDate = picker.endDate.format("DD/MM/YYYY");

            // Ensure that the selected range is at least 2 days
            var start = picker.startDate;
            var end = picker.endDate;
            var diffDays = end.diff(start, "days");

            if (diffDays < 1) {
                $(this).val("");
                Swal.fire({
                    icon: "warning",
                    title: "Booking Error",
                    text: "You must select at least two days for booking.",
                    confirmButtonColor: "#FF8800",
                    background: "#fff3e0",
                    customClass: {
                        popup: "swal-custom-popup",
						
                    },
                });
                return;
            }

            $(this).val(startDate + " - " + endDate);
        });

        $(".daterange1").on("cancel.daterangepicker", function () {
            $(this).val("");
        });
    }

    // Function to fetch booked dates for a specific room
    function fetchBookedDates(roomId) {
        if (!roomId) {
            console.log("Room ID is missing.");
            bookedDates = [];
            $(".daterange1").data("daterangepicker").remove();
            initializeDateRangePicker();
            return;
        }

        $.ajax({
            url: "/get-booked-dates",
            method: "POST",
            data: {
                room_id: roomId,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                bookedDates = response.booked_dates;
                console.log("Booked Dates Updated:", bookedDates);

                // Reinitialize the date range picker with updated dates
                $(".daterange1").data("daterangepicker").remove();
                initializeDateRangePicker();
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", error);
            },
        });
    }

    // Initialize the date range picker on page load
    function applyRoomSelectionListener() {
        $("select[name='room_id']").on("change", function () {
            var roomId = $(this).val();
            if (roomId) {
                fetchBookedDates(roomId);
            }
        });

        // If we are in the room detail page, trigger the fetch immediately using the room ID from the hidden input field
        var roomDetailPageRoomId = $("input[name='room_id']").val();
        if (roomDetailPageRoomId) {
            fetchBookedDates(roomDetailPageRoomId);
        }
    }

    $(document).ready(function () {
        initializeDateRangePicker();
        applyRoomSelectionListener();
    });

    if ($(window).width() > 767) {
        $("#sticky_sidebar").stickit({ top: 80 });
    }
})(jQuery);

