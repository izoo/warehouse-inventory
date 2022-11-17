
(function (b) {
    var n = b(window),
        p = b("body"),
        g = "rtl" === b("html").attr("dir") ? !0 : !1,
        m = b(".preloader");
    m.length && m.fakeLoader({ spinner: "spinner2", bgColor: !1 });
    var d = function (b, a) {
        return "undefined" === typeof b ? a : b;
    };
    b(function () {
        var c = b(".banner--section"),
            a = c.find(".banner--slider"),
            h = c.find(".banner--content"),
            f = c.find(".banner--form");
        a.on("initialized.owl.carousel", function (b) {
            c.css("min-height", h.outerHeight());
            f.css("margin-top", h.outerHeight() - 80);
        });
        a = b(".products--section").find(".product--item-img");
        a.length && a.directionalHover({ overlay: ".product--item-img-info" });
        b(".product-single--section")
            .find(".product--single-gallery .thumbnails")
            .on("shown.bs.tab", '[data-toggle="tab"]', function (a) {
                b(a.target)
                    .addClass("active")
                    .parent()
                    .siblings()
                    .children()
                    .removeClass("active");
            });
      
        var e = b("#map");
        e.length &&
            (function () {
                var b = new google.maps.Map(e[0], {
                    center: {
                        lat: e.data("map-latitude"),
                        lng: e.data("map-longitude"),
                    },
                    zoom: e.data("map-zoom"),
                    scrollwheel: !1,
                    disableDefaultUI: !0,
                    zoomControl: !0,
                    styles: [
                        {
                            featureType: "landscape",
                            stylers: [
                                { hue: "#FFBB00" },
                                { saturation: 43.400000000000006 },
                                { lightness: 37.599999999999994 },
                                { gamma: 1 },
                            ],
                        },
                        {
                            featureType: "road.highway",
                            stylers: [
                                { hue: "#FFC200" },
                                { saturation: -61.8 },
                                { lightness: 45.599999999999994 },
                                { gamma: 1 },
                            ],
                        },
                        {
                            featureType: "road.arterial",
                            stylers: [
                                { hue: "#FF0300" },
                                { saturation: -100 },
                                { lightness: 51.19999999999999 },
                                { gamma: 1 },
                            ],
                        },
                        {
                            featureType: "road.local",
                            stylers: [
                                { hue: "#FF0300" },
                                { saturation: -100 },
                                { lightness: 52 },
                                { gamma: 1 },
                            ],
                        },
                        {
                            featureType: "water",
                            stylers: [
                                { hue: "#0078FF" },
                                { saturation: -13.200000000000003 },
                                { lightness: 2.4000000000000057 },
                                { gamma: 1 },
                            ],
                        },
                        {
                            featureType: "poi",
                            stylers: [
                                { hue: "#00FF6A" },
                                { saturation: -1.0989010989011234 },
                                { lightness: 11.200000000000017 },
                                { gamma: 1 },
                            ],
                        },
                    ],
                });
                if ("undefined" !== typeof e.data("map-marker")) {
                    var a = e.data("map-marker"),
                        c = 0;
                    for (c; c < a.length; c++)
                        new google.maps.Marker({
                            position: { lat: a[c][0], lng: a[c][1] },
                            map: b,
                            animation: google.maps.Animation.DROP,
                            draggable: !0,
                        });
                }
            })();
        b(".back-to-top-btn").on("click", "a", function (a) {
            a.preventDefault();
            b("html, body").animate({ scrollTop: 0 }, 800);
        });
        b("[data-bg-img]").each(function () {
            var a = b(this);
            a.css("background-image", "url(" + a.data("bg-img") + ")")
                .addClass("bg--img bg--overlay")
                .attr("data-rjs", 2)
                .removeAttr("data-bg-img");
        });
        retinajs();
        b('[data-trigger="sticky"]').each(function () {
            b(this).sticky({ zIndex: 999 });
        });
      
      
        var a = b('input[type="file"]'),
            k = a.siblings(".file-status");
        a.on("change", function () {
            var a = b(this).val().split("\\");
            return (a = a[a.length - 1]) ? k.text(a) : "";
        });
        a = b('[data-toggle="tooltip"]');
        a.length && a.tooltip();
        b('[data-trigger="spinner"]').each(function () {
            var a = b(this);
            a.spinner({ min: a.data("min"), max: a.data("max") });
        });
        a = b('[data-trigger="date"]');
        a.length &&
            a.datepicker({
                showOtherMonths: !0,
                selectOtherMonths: !0,
                isRTL: g,
            });
        var l = b('[data-trigger="time"]');
        a.length && l.timepicker();
        b(".owl-carousel").each(function () {
            var a = b(this);
            a.owlCarousel({
                rtl: g,
                items: d(a.data("owl-items"), 1),
                margin: d(a.data("owl-margin"), 0),
                loop: d(a.data("owl-loop"), !0),
                smartSpeed: 1200,
                autoplaySpeed: 800,
                autoplay: d(a.data("owl-autoplay"), !0),
               
                nav: false,
                navText: [
                    '<i class="fa  fa-arrow-left"></i>',
                    '<i class="fa flm fa-arrow-right"></i>',
                ],
                
                responsive: d(a.data("owl-responsive"), {}),
            });
        });
        a = b('[data-popup="img"]');
        a.length && a.magnificPopup({ type: "image" });
        a = b('[data-popup="video"]');
        a.length && a.magnificPopup({ type: "iframe" });
        a = b('[data-counter-up="numbers"]');
        a.length && a.counterUp({ delay: 10, time: 1e3 });
        b("[data-countdown]").each(function () {
            var a = b(this);
            a.countdown(a.data("countdown"), function (a) {
                b(this).html(
                    "<ul>" +
                        a.strftime(
                            "<li><strong>%D</strong><span>Days</span></li><li><strong>%H</strong><span>Hours</span></li><li><strong>%M</strong><span>Minutes</span></li><li><strong>%S</strong><span>Seconds</span></li>"
                        ) +
                        "</ul>"
                );
            });
        });
     
    });
    n.on("load", function () {
        var c = function () {
            1 < n.scrollTop()
                ? p.addClass("isScrolling")
                : p.removeClass("isScrolling");
        };
        c();
        n.on("scroll", c);
        c = b(".AdjustRow");
        c.length &&
            c.isotope({ layoutMode: "fitRows", originLeft: g ? !1 : !0 });
        c = b(".MasonryRow");
        c.length && c.isotope({ originLeft: g ? !1 : !0 });
        var a = b(".header--section"),
            c = a.find(".header--navbar-top"),
            h = a.find(".header--navbar"),
            f = h.find(".megamenu"),
            a = function () {
                var a =
                        h.children(".container").outerWidth() -
                        f.position().left,
                    b = f.find(".dropdown-menu").width();
                return a < b ? "0" : "auto";
            };
        c.length &&
            c
                .find(
                    ".logo, .header--navbar-top-btn, .header--navbar-top-info"
                )
                .css("height", c.outerHeight());
        f.length && f.find(".dropdown-menu").css("left", a);
        var c = b(".services--section"),
            e = c.find(".service--item");
        c.find(".service--item .dot").each(function () {
            var a = b(this);
            a.css({
                top: d(a.data("position-top"), "auto"),
                left: d(a.data("position-left"), "auto"),
                right: d(a.data("position-right"), "auto"),
            });
        });
        e.on("click", '[data-toggle="tab"]', function (a) {
            a.preventDefault();
        }).on("mouseenter", function (a) {
            e.removeClass("active");
            b(this).addClass("active").find('[data-toggle="tab"]').tab("show");
        });
        b(".extra-services--section")
            .find(".extra-service--info")
            .each(function () {
                var a = b(this);
                a.css("top", a.outerHeight() - 67);
            });
        var c = b(".gallery--section"),
            k = c.find(".gallery--items"),
            a = c.find(".gallery--filter-nav"),
            l = c.find(".gallery--img");
        l.length &&
            (l.directionalHover({ overlay: ".gallery--info" }),
            c.find('[data-popup="img"]').on("mfpClose", function (a) {
                l.directionalHover({ overlay: ".gallery--info" });
            }));
        k.length &&
            k.isotope({
                animationEngine: "best-available",
                itemSelector: ".gallery--item",
                originLeft: g ? !1 : !0,
            });
        a.on("click", "li", function (a) {
            a.preventDefault();
            a = b(this);
            var c = a.data("target");
            k.isotope({ filter: "*" !== c ? '[data-cat~="' + c + '"]' : c });
            a.addClass("active").siblings().removeClass("active");
        });
        var c = b(".experts--section"),
            m = c.find(".expert--members");
        c.find(".expert--members-nav").on("click", "button", function () {
            m.trigger(b(this).data("trigger"));
        });
        var c = b(".footer--section"),
            a = c.find(".footer--about .logo"),
            q = c.find(".widget--title");
        a.length && q.css("margin-top", a.outerHeight() - 30);
        a = c.find(".footer--copyright");
        c = c.find(".footer--copyright-border");
        c.length && c.css("top", a.position().top);
    });
})(jQuery);
