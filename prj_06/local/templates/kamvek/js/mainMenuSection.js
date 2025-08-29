var menuSectionTimer = null;

function clearMenuSectionTimer() {
	clearTimeout(menuSectionTimer);
	menuSectionTimer = null
}

var NewMenuIsActive = !1;
var IsResponsiveSmallScreen = !1;
$(document).ready(function () {
	if ($("body.headMenu ").length) {
		NewMenuIsActive = !0;
		if ($("#MainMenuButton").is(':visible')) {
			IsResponsiveSmallScreen = !0
		}
	}
});
$(window).on('load', function () {
	if ($("#MainMenuButton").is(':visible')) {
		IsResponsiveSmallScreen = !0
	} else {
		IsResponsiveSmallScreen = !1
	}
});
$(window).resize(function () {
	if (NewMenuIsActive) {
		if (IsResponsiveSmallScreen == !0 && !$("#MainMenuButton").is(':visible')) {
			IsResponsiveSmallScreen = !1;
			openMainMenu()
		} else if (IsResponsiveSmallScreen == !1 && $("#MainMenuButton").is(':visible')) {
			IsResponsiveSmallScreen = !0;
			closeMainMenu()
		}
	}
});
$('.menuSectionLinkButton').click(function (e) {
	e.preventDefault();
	e.stopPropagation();
	var $secLink = $(this).parents(".menuSectionLink");
	if ($secLink.siblings(".menuSectionArea").hasClass("visible")) {
		closeMenuSection($(this).parents(".menuSection"))
	} else {
		$(".menuSectionArea").hide().removeClass("visible");
		$('.menuSectionLinkButton').removeClass("visible");
		openMenuSection($(this).parents(".menuSection"))
	}
});
$('.menuSectionLink.lv1').mouseenter(function () {
	if ($(this).siblings(".menuSectionArea").hasClass("visible")) {
	} else {
		if (!IsResponsiveSmallScreen) {
			$(".menuSectionArea").hide().removeClass("visible");
			$('.menuSectionLinkButton').removeClass("visible");
			openMenuSection($(this).parents(".menuSection"))
		}
	}
});
$('.menuSection').mouseover(function () {
	clearMenuSectionTimer()
});
$('.menuSection').mouseleave(function () {
	if ($("#MainMenuButton").is(':visible')) {
		return
	}
	if (menuSectionTimer) {
		clearMenuSectionTimer()
	}
	$element = $(this);
	menuSectionTimer = setTimeout(function () {
		closeMenuSection($element)
	}, 800)
});
var openMenuSection = function ($menuSection) {
	$menuSection.find(".menuSectionLinkButton").addClass("visible");
	$menuSection.find(".menuSectionArea").slideDown().addClass("visible")
};

function closeMenuSection($menuSection) {
	$menuSection.find(".menuSectionLinkButton").removeClass("visible");
	$menuSection.find(".menuSectionArea.visible").slideUp().removeClass("visible")
}

var mainMenuCloseAll = function () {
	$(".menuSectionArea").hide().removeClass("visible");
	$('.menuSectionLinkButton').removeClass("visible")
};
var openMainMenu = function () {
	$("#MainMenuWrapper").addClass("show");
	$(".menuBlockSubmenu").show()
};
var closeMainMenu = function () {
	$("#MainMenuWrapper").removeClass("show")
};
$(".menuBlockToggler").click(function () {
	if ($(this).attr("data-class")) {
		var dataclass = $(this).attr("data-class");
		var area = $(this).parents(".menuSectionArea");
		area.find(".menuBlockSubmenu[data-class=" + dataclass + "]").slideToggle().toggleClass("visible")
	} else {
		$(this).parents(".mainMenuBlock").find(".menuBlockSubmenu").slideToggle().toggleClass("visible")
	}
	$(this).toggleClass("visible")
});
