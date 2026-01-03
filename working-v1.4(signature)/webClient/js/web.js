$(function () {
  const $header = $('body > header');
  let isScrolled = false;

  $(window).on('scroll', function () {
    const y = window.scrollY;

    /* Seuils distincts */
    if (!isScrolled && y > 300) {
      $header.addClass('scrolled');
      isScrolled = true;
    }
    else if (isScrolled && y < 1) {
      $header.removeClass('scrolled');
      isScrolled = false;
    }
  });
});

