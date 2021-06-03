$(document).ready(function() {

    // $("#featured-products").owlCarousel({

    //     autoPlay: 3000, //Set AutoPlay to 3 seconds

    //     items: 4,
    //     itemsDesktop: [1199, 3],
    //     itemsDesktopSmall: [979, 3]

    // });

    $('#featured-products, #our-brands').owlCarousel({
        autoPlay: 3000,
        center: true,
        items: 1,
        loop: true,
        dots: true,
        margin: 10,
        responsive: {
            350: {
                items: 2,
                dots: true,
            },
            600: {
                items: 3,
                dots: true,
            },
            1000: {
                items: 4,
                dots: true,
            },
            1500: {
                items: 5,
                dots: true,
            },
            2000: {
                items: 6,
                dots: true,
            }
        }
    });

});

// Initialize and add the map
function initMap() {
    // The location of Uluru
    const aptech = { lat: 6.564422916997364, lng: 3.367537584276403 };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 4,
        center: aptech,
    });
    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
        position: aptech,
        map: map,
    });
}

window.Livewire.on('cartCount', cartCount => {
    document.getElementById('cartNumber').textContent = cartCount;
});

window.livewire.on('profileInformationUpdated', payload => {
    usernameElements = document.getElementsByClassName('authUsername');
    emailElements = document.getElementsByClassName('authEmail');

    // Update username
    for(let i = 0; i < usernameElements.length; i++) {
        usernameElements[i].innerHTML = payload['username'];
    };

    // Update email address
    for(let i = 0; i < emailElements.length; i++) {
        emailElements[i].innerHTML = payload['email'];
    };
});

window.Livewire.on('info', (message) => {
    toastr.info(message);
});

window.Livewire.on('warning', (message) => {
    toastr.warning(message);
});

window.Livewire.on('success', (message) => {
    toastr.success(message);
});

window.Livewire.on('error', (message) => {
    toastr.error(message);
});

window.Livewire.on('danger', (message) => {
    toastr.error(message);
});