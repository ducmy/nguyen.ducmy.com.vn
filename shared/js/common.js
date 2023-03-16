$(function() {
  scrollTop("pageTop", 500);

  let $win = $(window),
    $header = $("header"),
    animationClass = "is-animation",
    header_height = $header.height();

  $("body").css("margin-top", header_height);

  const winW = $(window).width();
  const devW = 767;

  if (winW > devW) {
    $win.on("load scroll", function() {
      var value = $(this).scrollTop();
      if (value > header_height) {
        $header.addClass(animationClass);
      } else {
        $header.removeClass(animationClass);
      }
    });
  }
});

function openNav() {
  $(".overlay").addClass("myNav_opne");
}

function closeNav() {
  $(".overlay").removeClass("myNav_opne");
}

function scrollTop(elem, duration) {
  let target = document.getElementById(elem);
  target.addEventListener("click", function() {
    let currentY = window.pageYOffset;
    let step = duration / currentY > 1 ? 10 : 100;
    let timeStep = (duration / currentY) * step;
    let intervalID = setInterval(scrollUp, timeStep);
    function scrollUp() {
      currentY = window.pageYOffset;
      if (currentY === 0) {
        clearInterval(intervalID);
      } else {
        scrollBy(0, -step);
      }
    }
  });
}

$(function() {
  var topBtn = $("#pageTop");
  topBtn.hide();
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      topBtn.fadeIn();
    } else {
      topBtn.fadeOut();
    }
  });
  topBtn.click(function() {
    $("body,html").animate(
      {
        scrollTop: 0
      },
      500
    );
    return false;
  });
});
