<footer>
<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSearchInput() {
      const searchInput = document.querySelector('.search-input');
      searchInput.classList.toggle('active');
      if (searchInput.classList.contains('active')) {
        searchInput.focus();
      } else {
        searchInput.blur();
      }
    }

   

  </script>
  
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        on: {
            slideChangeTransitionEnd: function () {
                // Remove the 'animate__zoomIn' class from all slides
                document.querySelectorAll('.swiper-slide').forEach(function (slide) {
                    slide.querySelector('.slc').classList.remove('animate__zoomIn');
                });

                // Add the 'animate__zoomIn' class to the current slide
                this.slides[this.activeIndex].querySelector('.slc').classList.add('animate__zoomIn');
            },
        },
    });
</script>

</footer>