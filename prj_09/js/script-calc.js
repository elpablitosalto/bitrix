var showPanelService = true;
var selectService = new Array();
//var specialistDeparture = false;
var installationSpec = false;
var summService = 0;
var arsummService = new Array();
var arsummСomplex = new Array();
var arDesign = new Array();

(function($) {

function calcbranding(){
  summService = 0;
  if(typeof arsummСomplex["cost"] !== "undefined") summService = arsummСomplex["cost"];
  if(showPanelService == true){
    if(installationSpec == true) summService = summService + parseInt($("#type2item1i").attr("data-cost"));
    selectService.forEach(function(item, i, arr) {
      //console.log(item);
      //console.log(i);
      //console.log(arr);
      if(installationSpec == true) summService = summService + parseInt(item.installation);
      summService = summService + parseInt(item.cost);

    });

  }

  $("#SUMM_FID11").val(summService)
  $(".calc-summ span").text(summService);
}

  if($(".calc-branding1").length>0){

  }

  $(document).on("change", ".TYPELIST1 input:not(.type1d)", function() {
    var _self = $(this);
    $('.TYPELIST1 input:checked').each(function(){
	      if($(this).attr('id')!=_self.attr('id')) $(this).prop('checked', false);
    });
    if($(this).is(':checked')){
      arsummСomplex = [];
      $(".calc-item-service").hide();
      //$(".TYPELIST1D").hide();
      showPanelService = false;
      //specialistDeparture = false;
      selectService = [];
      summService = 0;
      arsummService = new Array();
      $('.TYPELIST2 input').each(function(){
        $(this).prop('checked', false);
      });
      installationSpec = false;
      arsummСomplex["id"] = _self.attr("data-itemid");
      arsummСomplex["cost"] = _self.attr("data-cost");
    }  else {
      arsummСomplex = [];
      $(".calc-item-service").show();
      //$(".TYPELIST1D").show();
      showPanelService = true;
      // if ($(".TYPELIST1D").is(':hidden')) {
      //   $(".TYPELIST1D").show();
      //   specialistDeparture = false;
      // }
    }
    calcbranding();
  });

  $(document).on("change", ".TYPELIST1 input.type1d", function() {
    //console.log(selectService);
    if ($(this).is(':checked')){
      $(".calc-item-service").hide();
      showPanelService = false;
      selectService = [];
      $('.TYPELIST2 input').each(function(){
        $(this).prop('checked', false);
      });
      //specialistDeparture = true;
    } else {
      $(".calc-item-service").show();
      showPanelService = true;
      //specialistDeparture = false;
    }
    calcbranding();
  });

  $(document).on("change", ".TYPELIST2 input:not(.type2i)", function() {
    var _self = $(this);

    if ($(this).is(':checked')){
      var tmp = new Array();
      tmp.id = _self.attr("data-itemid");
      tmp.cost = _self.attr("data-cost");
      tmp.installation = _self.attr("data-installation");
      //console.log(tmp);
      selectService[tmp.id] = tmp;
    } else {
      delete selectService[_self.attr("data-itemid")];
    }

    calcbranding();
    //console.log(selectService);
  });

  $(document).on("change", ".TYPELIST2 input.type2i", function() {
    if ($(this).is(':checked')){
      installationSpec = true;
      //$(".TYPELIST1D").hide();
      //specialistDeparture = false;
    } else {
      installationSpec = false;
      //$(".TYPELIST1D").show();
      //specialistDeparture = false;
    }
    calcbranding();
  });

  $(document).on("change", ".TYPELIST3 input", function() {
    var _self = $(this);
    $('.TYPELIST3 input:checked').each(function(){
	      if($(this).attr('id')!=_self.attr('id')) $(this).prop('checked', false);
    });
    if ($(this).is(':checked')){
      arDesign = [];
      arDesign["id"] = _self.attr("data-itemid");
    } else {

    }

    calcbranding();
    //console.log(selectService);
  });
  $('#dialogcalc').dialog({
    autoOpen: false,
    modal: true,
    minWidth: 320,
    title: "Заявка на просчет",
  });
  $(document).on("click", ".vc_custom_238 button", function() {
    //console.log("ff");
    $(".linkservicelist").remove();
    //$("#f_feedback_FID1").prepend( '<input type="hidden" class="linkservicelist" name="FIELDS[LINKSERVICE_FID1][]" value="4434">' );
    $('.TYPELIST1 input, .TYPELIST2 input, .TYPELIST3 input').each(function(i,elem) {
      if ($(this).is(':checked')){
        $("#f_feedback_FID1").prepend( '<input type="hidden" class="linkservicelist" name="FIELDS[LINKSERVICE_FID1][]" value="'+$(this).attr("data-itemid")+'">' );
      }
    });
    $('#dialogcalc').dialog("open");
  });
}(jQuery));
