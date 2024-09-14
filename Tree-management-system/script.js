$(document).ready(function(){
    $('.recent-review').owlCarousel({
      loop: true, // Loop through the testimonials
      margin: 10, // Space between items
      nav: true, // Show navigation arrows
      dots: true, // Show dots
      autoplay: true, // Enable automatic sliding
      autoplayTimeout: 5000, // 5 seconds for each testimonial
      autoplayHoverPause: true, // Pause on hover
      items: 1, // Show one testimonial at a time
      animateOut: 'fadeOut', // Animation effect when sliding out
      animateIn: 'fadeIn', // Animation effect when sliding in
    });
  });