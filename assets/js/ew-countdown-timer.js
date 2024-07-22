jQuery(document).ready(function($) {
    $('.ew-product-countdown').each(function() {
        var endDate = $(this).data('end-date');
        var endDateObj = new Date(endDate).getTime();
        var $this = $(this);

        var countdownTimer = setInterval(function() {
            var now = new Date().getTime();
            var distance = endDateObj - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            $this.find('.countdown-timer').html(days + 'روز ' + hours + 'ساعت ' + minutes + 'دقیقه ' + seconds + 'ثانیه ');

            if (distance < 0) {
                clearInterval(countdownTimer);
                $this.find('.countdown-timer').hide();
                $this.find('.expired-message').show();
            }
        }, 1000);
    });
});
