$(document).ready(function () {
  // setTimeout(sliderBilderLaden,500);
  startMySlider();
});
function sliderBilderLaden() {
  var url = $("#Slideshow").attr("data-base");
  url += "AjaxSliderBilderLaden";
  $.ajax({
    url: url,
    // type: "POST",
    success: function (response) {
      if ($('#Slideshow').length) {
        $('#Slideshow').append(response);
      }
    }
  });
}

function startMySlider() {
  if ($('#Slideshow .slide').length > 0) {
    $('#Slideshow').css({ display: 'block' });
  }
  if ($('#Slideshow .slide').length > 1) {
    // $("#Slideshow  .slide:gt(0)").hide();
    setInterval(function () {
      $('#Slideshow .slide').css({ "display": "block" });
      $('#Slideshow  .slide:first')
        .fadeOut(1300)
        .next().fadeIn(1300)
        .end()
        .insertAfter('#Slideshow .slide:last');
    }, 5600);
  }
}
