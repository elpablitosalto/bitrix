$(document).ready(function(){
  if ($("body#Home").length){
    return;
  }
  if ($("#ProductFilterSection").length ){
  // if ($("body.sect_gh").length){
  //     if ($("body.dap").length || $('html').attr('lang') != 'de' ){
  //         return;
  //     }
    if ($("body.sect_gh").length){
      loadProductFilter();
    }
  }
});
var getCanonicalHref = function(){
  var url = $("link[rel='canonical']").attr("href");
  if (url[url.length -1] !== "/"){
      url += "/";
  }
  return url;
}
var loadProductFilter = function() {
  //var url = getCanonicalHref();
  //url = url.split('?')[0] ;
  //url += "/include/AjaxProductFilter";
  var url = "/include/AjaxProductFilter";
  $.ajax({
    url: url,
      type: "POST",
    success : function (response) {
      if ($('#ProductFilterSection').length){
        $('#ProductFilterSection').append(response);
        var $pageFilterItems = $("#PageFilterItems");
        if ($pageFilterItems.length){
          var idString = $pageFilterItems.data("items");
          var idArray = idString.split(",");
          if (idArray.length){
            $.each(idArray,function(){
              $("#ProductFilterGroups #pfi-"+this).prop( "checked", true );
            });
          }

        }
      }

        else{
          $('#Main').before(response);
        }
        // $("#ProductFilterContent").hide();
    }
  });
};

$("body").on("click", "#ProductFilterButton",function(){
  var $ProductFilterWrapper = $("#ProductFilterWrapper");
  var url = $(this).attr('data-href')+"AjaxFilterSearchProducts";
  var qString = "";
  var itemString = "";
  var allItemString = "";
  var ImgRelItemsString = "";
  var q = [];
  var detailListe = 0;
  var groupIsRelevant;
  // Loading
//$('#ProductFilterResults').contents().fadeOut(150, function(){$('#ProductFilterResults').html("<p id='ProductFilterResultLoading'></p>");});
  $('#ProductFilterResults').addClass("init");
  $('#ProductFilterResults').prepend("<p id='ProductFilterResultLoading'></p>");

  if ($("#FilterExtras #Details").prop("checked") === true){
    detailListe = 1;
  }
  $(".productFilterGroup").each(function(){
    itemString = "";
    groupIsRelevant = false;
    if ($(this).attr("data-relimg") === "1"){
        groupIsRelevant = true;
    }
    $(this).find(".productFilterItem").each(function(){
        if ($(this).find(".checkbox").prop("checked") === true){
            var item = $(this).attr("data-id")+",";
            itemString += item;
            allItemString += item;
            // Eigenschaft auch relevant für die Auswahl des Teaserbildes ??
            if ( groupIsRelevant || $(this).attr("data-relimg") === "1" ){
                ImgRelItemsString += item;
            }
        }
    });
    if (itemString.length){

      qString += "Group-"+$(this).attr("data-id")+":"+itemString+";";
    }
  });

  q = { "Groups" : qString, "ImgRelItems": ImgRelItemsString, "Details" : detailListe, "AllItems" : allItemString };
  $.ajax({
    url: url,
      data: q,
      datatype: "text",
      type: "POST",
    success : function (response) {
// DEBUG
// alert("Hallo "+response);
      $('#ProductFilterResults').contents().fadeOut(250, function(){
        $('#ProductFilterResults').html(response);
        var filterHeight = $ProductFilterWrapper.height();
        $("#Main").css({"min-height":filterHeight+"px"});
        $(".filterResultTeaser[data-aqua='1'] .props").append("<div class='prop aqua'></div>");
        $(".filterResultTeaser[data-cleantop='1'] .props").append("<div class='prop cleantop'></div>");
      });


    },
    fail : function (xhr) {
//      alert('Error: ' + xhr.responseText);
      }
    });
});


// $("body").on("click", "#FilterTitle",function(){
//   if ($(this).hasClass("open")){
//     $("#ProductFilterOverlay").removeClass("visible");
//   }
//   else{
//     $("#ProductFilterOverlay").addClass("visible");
//   }
// });

$("body").on("click", "#ProductFilterClose",function(){
  if ($("#ProductFilterOverlay").hasClass("visible")){
    productFilterClose();
    $('html, body').animate({
      scrollTop:$("#BreadcrumbTrails").offset().top
  },'slow');
  }
});
$("body").on("click", "#FilterButton",function(){
  // var $antwort = $('#ProductFilterContent');
  // akkordeonToggle($antwort);

  $("#FilterTitle").toggleClass("open");

  relationMenuClose();
  mainMenuClose();
  if ($("#ProductFilterOverlay").hasClass("visible")){
    productFilterClose();
  }
  else{
    productFilterOpen();
  }
});

function productFilterOpen(){
  // $('#ProductFilterContent').show();
  $("#FilterButton").addClass("visible");
  $("#ProductFilterOverlay").addClass("visible");
}
function productFilterClose(){
  // $('#ProductFilterContent').hide();
  $("#FilterButton").removeClass("visible");
  $("#ProductFilterOverlay").removeClass("visible");
}


$("body").on("click", ".filterResultTeaser",function(e){
  // e.preventDefault();
  var href = $(this).attr("href");
  var abfrageID = $('#PFResultContent').attr("data-abfrageid");
  if (!isNaN(abfrageID)){
    var prodID = $(this).attr("data-id");
    var imgID = $(this).find(".image").attr("data-imgid");
    var url = getCanonicalHref();

  url += "AjaxFinderTeaser";
    q = { "Product" : prodID, "Image": imgID, "Abfrage":abfrageID};
    $.ajax({
    url: url,
      data: q,
      datatype: "text",
      type: "POST",
    success : function (response) {
      // window.location.href = href;


    },
    fail : function (xhr) {
//      alert('Error: ' + xhr.responseText);
      }
    });
  }




});
