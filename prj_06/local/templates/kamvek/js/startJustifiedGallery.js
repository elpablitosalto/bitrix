$(window).on("load",function(){setTimeout(startJustifiedGallery,20);setTimeout(justGalResizeHeight,1000)});$(document).ready(function(){setTimeout(startJustifiedGallery,600)});$(window).resize(function(){setTimeout(startJustifiedGallery,60)});var justGalInit=0;var $LeftPosElement=$("#Logo");var $gal=$("#JustifiedGallery");var defaultRowHeight=290;var defaultRowHeightMax=420;var JustGal;function startJustifiedGallery(){if($gal.length){var rowHeight=defaultRowHeight;var maxRowHeight=defaultRowHeightMax;var winHeight=$(window).height();if(winHeight<900){rowHeight=(winHeight/3)-10;maxRowHeight=rowHeight+100}
var maxRowsCount=3;if($(".gallerySwitch").hasClass("open")){maxRowsCount=0}
if($(".gallerySwitch").hasClass("closed")){maxRowsCount=3}
JustGal=$gal.justifiedGallery({rowHeight:rowHeight,maxRowHeight:maxRowHeight,maxRowsCount:maxRowsCount,margins:7,border:7,captions:!1})}
justGalInit=1}
function justGalResizeHeight(){var anzahlBilder=$("#cs-Galerie .jg-entry").length;var anzahlSichtbareBilder=$("#cs-Galerie .jg-entry-visible").length;if(anzahlSichtbareBilder<anzahlBilder){$("#cs-Galerie .gallerySwitch").addClass("active").addClass("closed")}}
$('body').on('click','.gallerySwitch',function(){$(this).toggleClass("open").toggleClass("closed");startJustifiedGallery()});$("#GalerieFilter span").click(function(){var type=$(this).attr("data-type");if(type!="alle"){$(".inspirationsBild[data-"+type+"=1]").fadeIn(120);$(".inspirationsBild").not("[data-"+type+"=1]").fadeOut(80)}else{$(".inspirationsBild").fadeIn(120)}
startJustifiedGallery()});
