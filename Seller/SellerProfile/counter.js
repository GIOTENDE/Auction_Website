

function getTimeLeft($date){
    var countDownDate = new Date('$date').getTime();

                // Update the count down every 1 second
                var x = setInterval(function() {

                // Today's date
                var now = new Date().getTime();

                // Find the difference between now an the count down date
                var difference = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(difference / (1000 * 60 * 60 * 24));
                var hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((difference % (1000 * 60)) / 1000);

                // Output the result in an element with id='countdown'
                document.getElementById('countdown').innerHTML = days + 'd ' + hours + 'h '
                + minutes + 'm ' + seconds + 's ';

                // If the count down is over, write some text 
                if (difference < 0) {
                clearInterval(x);
                document.getElementById('countdown').innerHTML = 'EXPIRED';
                }
                }, 1000);
            }