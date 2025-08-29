(function utm() {
	window.utm = {
		fields: [
			{
				name: 'utm_referrer',
				value: window.location.href
			},
			{
				name: 'utm_source',
			},
			{
				name: 'utm_medium',
			},
			{
				name: 'utm_campaign',
			},
			{
				name: 'utm_term',
			},
			{
				name: 'utm_content',
			},
		],
		getCookie: function (name) {
			var matches = document.cookie.match(new RegExp(
				"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
			));
			return matches ? decodeURIComponent(matches[1]) : undefined;
		},
		getCookieName: function (name) {
			let cookie = document.cookie;
			let search = name + "=";
			let result = "";
			let offset = end = 0 ;

			if (cookie.length > 0) {
				offset = cookie.indexOf(search);
				if (offset !== -1) {
					offset += search.length;
					end = cookie.indexOf(";", offset)
					if (end === -1) {
						end = cookie.length;
					}
					result = unescape(cookie.substring(offset, end));
				}
			}

			return result;
		},
		addFields: function (form) {
			if (!form) {
				return;
			}

			window.utm.fields.forEach(function (field) {
				if (!field.value) {
					field.value = window.utm.getCookieName(field.name) || 'not_set';
				}

				if (field.value) {
					let input = window.utm.createEl(
							'INPUT',
							false,
							[
								{
									name: 'type',
									value: 'hidden'
								},
								{
									name: 'name',
									value: field.name
								},
								{
									name: 'value',
									value: field.value
								},
							]
						);

					form.prepend(input);
				}
			});
		},
		createEl: function (tag, className, attrArr) {
			let result = document.createElement(tag);

			if (className) {
				result.setAttribute('class', className);
			}

			if (attrArr) {
				for (var i = 0; i < attrArr.length; i++) {
					result.setAttribute(attrArr[i].name, attrArr[i].value);
				}
			}

			return result;
		},
	};

	if (window.utm.getCookie("utm_source") == undefined) {
		var utmCookie = {
				cookieNamePrefix: "",
				utmParams: [
					"utm_source",
					"utm_medium",
					"utm_campaign",
					"utm_content",
					"utm_term"
				],
				cookieExpiryDays: 30,

				// From http://www.quirksmode.org/js/cookies.html
				createCookie: function(name, value, days) {
					if (days) {
						var date = new Date();
						date.setTime(date.getTime()+(days*24*60*60*1000));
						var expires = "; expires="+date.toGMTString();
					} else {
						var expires = "";
					}

					document.cookie = this.cookieNamePrefix + name + "=" + value + expires + "; path=/";
				},

				readCookie: function(name) {
					var nameEQ = this.cookieNamePrefix + name + "=";
					var ca = document.cookie.split(';');
					for (var i=0 ; i < ca.length; i++) {
						var c = ca[i];
						while (c.charAt(0)==' ') c = c.substring(1,c.length);
						if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
					}
					return null;
				},

				eraseCookie: function(name) {
					this.createCookie(name,"",-1);
				},

				getParameterByName: function(name) {
					name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
					var regexS = "[\\?&]" + name + "=([^&#]*)";
					var regex = new RegExp(regexS);
					var results = regex.exec(window.location.search);
					if(results == null) {
						return "";
					} else {
						return decodeURIComponent(results[1].replace(/\+/g, " "));
					}
				},

				utmPresentInUrl: function() {
					var present = false;
					for (var i = 0 ; i < this.utmParams.length; i++) {
						var param = this.utmParams[i];
						var value = this.getParameterByName(param);
						if (value != "" && value != undefined) {
							present = true;
						}
					}
					return present;
				},

				writeUtmCookieFromParams: function() {
					for (var i = 0 ; i < this.utmParams.length; i++) {
						var param = this.utmParams[i];
						var value = this.getParameterByName(param);
						this.createCookie(param, value, this.cookieExpiryDays)
					}
				},

				writeCookieOnce: function(name, value) {
					var existingValue = this.readCookie(name);
					if (!existingValue) {
						this.createCookie(name, value, this.cookieExpiryDays);
					}
				},

				writeReferrerOnce: function() {
					value = document.referrer;
					if (value === "" || value === undefined) {
						this.writeCookieOnce("referrer", "direct");
					} else {
						this.writeCookieOnce("referrer", value);
					}
				},

				referrer: function() {
					return this.readCookie("referrer");
				}
			};

		utmCookie.writeReferrerOnce();

		if (utmCookie.utmPresentInUrl()) {
			utmCookie.writeUtmCookieFromParams();
		}
	}

	if(window.utm.getCookie("utm_source") == undefined) {
		if (document.referrer == "https://www.google.com/") {
			utm_source = "google";
			utm_medium = "organic";
			utm_campaign = "not_set";
		} else if (document.referrer == "https://yandex.ru/") {
			utm_source = "yandex";
			utm_medium = "organic";
			utm_campaign = "not_set";
		} else if (document.referrer == "https://go.mail.ru/") {
			utm_source = "mail";
			utm_medium = "organic";
			utm_campaign = "not_set";
		} else if (document.referrer == "https://away.vk.com/") {
			utm_source = "vk";
			utm_medium = "social";
			utm_campaign = "not_set";
		} else if (document.referrer == "http://away.vk.com/") {
			utm_source = "vk";
			utm_medium = "social";
			utm_campaign = "not_set";
		} else if (document.referrer == "https://l.instagram.com/") {
			utm_source = "instagram";
			utm_medium = "social";
			utm_campaign = "not_set";
		} else if (document.referrer == "https://web.facebook.com/") {
			utm_source = "facebook";
			utm_medium = "social";
			utm_campaign = "not_set";
		} else if (document.referrer == "https://www.youtube.com/") {
			utm_source = "youtube";
			utm_medium = "social";
			utm_campaign = "not_set";
		} else if (document.referrer == undefined) {
			utm_source = "(direct)";
			utm_medium = "type_in";
			utm_campaign = "not_set";
			} else {
			utm_source = document.referrer;
			utm_medium = "referral";
			utm_campaign = "not_set";
		}
		if(utm_source) {document.cookie = 'utm_source=' + utm_source + '; path=/; max-age=2592000';}
		if(utm_medium) {document.cookie = 'utm_medium=' + utm_medium + '; path=/; max-age=2592000';}
		if(utm_campaign) {document.cookie = 'utm_campaign=' + utm_campaign + '; path=/; max-age=2592000';}
		console.log("Куки перезаписаны!");
	} else {
		console.log("Куки есть, ничего не изменилось.");
	}
})();