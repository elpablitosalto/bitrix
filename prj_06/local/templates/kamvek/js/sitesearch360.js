var siteSearchWrapper = $("#SiteSearch360Wrapper");
var ss360ScriptLoaded = false;

$('#SiteSearchSwitch').click(function(){
  //loadSiteSearchScript();
  mainMenuCloseAll();
  if (siteSearchWrapper.hasClass("visible")){
    siteSearchClose();
  }
  else{
    siteSearchOpen();
    $("#searchBox").focus();
  }

});
$("#SiteSearchOffSwitch").click(function(){
  siteSearchClose();

});
siteSearchWrapper.click(function(){
  siteSearchClose();
});
var loadSiteSearchScript = function(){
  if (ss360ScriptLoaded === false){
    $.getScript("/js/sitesearch360-v14.min.js");
    ss360ScriptLoaded = true;
  }
}
var siteSearchClose = function(){
  siteSearchWrapper.removeClass("visible").fadeOut();
};
var siteSearchOpen = function(){
  siteSearchWrapper.addClass("visible").fadeIn();
};
$("#searchBox").click(function(e){
  e.stopPropagation();
});

$( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) { // ESC
        $("#SiteSearch360Wrapper.visible").removeClass("visible").fadeOut();
    }
});
