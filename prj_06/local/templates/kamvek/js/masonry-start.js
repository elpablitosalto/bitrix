
var smallestBlock = '.bigBlockS',
    blockClass = '.bigBlock',
    imageBlockClass = blockClass;

var MASONRY_TYPE_INSPIRATION = "Inspiration",
    MASONRY_TYPE_BIGTEASER = "BigTeaser";
var MasonryType = MASONRY_TYPE_BIGTEASER;

if ($("#InspirationsTeaser").length){
  MasonryType = MASONRY_TYPE_INSPIRATION;
  smallestBlock = ".inspirationsBild.iTS",
  blockClass = ".inspirationsBild",
  imageBlockClass = ".teaserImg";
}
$(document).ready(function(){
  setTimeout(mason, 250);
  setTimeout(checkNewsTeaser,800);
});

$(window).scroll(function (){
  setTimeout(mason, 150);

  checkNewsTeaser();
});

$("#ProductReferenceContentBlock .sectionTitle").click(function(){
  setTimeout(mason, 150);
});
var mason = function(){
  var $container = $('.bigBlocks');
  if (MasonryType === MASONRY_TYPE_BIGTEASER){
    if ($(".bigBlockS").length === 0){
      smallestBlock = '.bigBlock:not(.bigBlockXL)';
    }
  }
  if (MasonryType === MASONRY_TYPE_INSPIRATION){
    $container = $("#InspirationsTeaser");
  }

  $container.each(function(){
    if (MasonryType === MASONRY_TYPE_BIGTEASER){
      smallestBlock = '.bigBlockS';
      if ($(this).find(".bigBlockS").length === 0){
        smallestBlock = '.bigBlock:not(.bigBlockXL)';
      }
    }
    $(this).masonry({
    columnWidth: smallestBlock,
    itemSelector: blockClass
  });
});

};
//
// var LAZY_GAP_MASON = 60;
// $.fn.isOnScreenMason = function(){
//     var viewport = {};
//     viewport.top = $(window).scrollTop();
//     viewport.bottom = viewport.top + $(window).height();
//     var bounds = {};
//     bounds.top = this.offset().top;
//     bounds.bottom = bounds.top + this.outerHeight();
//     return ((bounds.top <= viewport.bottom + LAZY_GAP_MASON) && (bounds.bottom >= viewport.top - LAZY_GAP_MASON));
// };

// Quadrate setzen
$(".bigBlock.contentBlock .text li").each(function(){
  $(this).addClass("icon-square");
});

var newsHeadlinesInit = 0;
 function checkNewsTeaser(){
   if (!newsHeadlinesInit && $("#BigBlocks .bigBlock.news").length){
     if ($("#BigBlocks .bigBlock.news").isOnScreen()){
       $("#BigBlocks .bigBlock.news .newsHeadline a").each(function(i){
         var delay = (i*1900) + 20;
         var $elem = $(this);
         setTimeout(function(){
           $elem.addClass("init");
        }, delay);
       });
       newsHeadlinesInit = 1;
     }
   }
 }
