function convertHex(e, t) {
  return (
    (e = e.replace("#", "")),
    (r = parseInt(e.substring(0, 2), 16)),
    (g = parseInt(e.substring(2, 4), 16)),
    (b = parseInt(e.substring(4, 6), 16)),
    (result = "rgba(" + r + ", " + g + ", " + b + ", " + t + ")"),
    result
  );
}
!(function (n) {
  "use strict";
  n(document).on("ready", function () {
    var e, t, a, i, s;
    o(),
      n("*[data-pattern-overlay-darkness-opacity]").each(function () {
        var e = n(this).data("pattern-overlay-darkness-opacity");
        n(this).css("background-color", convertHex("#000000", e));
      }),
      n("*[data-pattern-overlay-background-image]").each(function () {
        "none" == n(this).data("pattern-overlay-background-image")
          ? n(this).css("background-image", "none")
          : "yes" == n(this).data("pattern-overlay-background-image") &&
            n(this).css("background-image");
      }),
      n("*[data-remove-pattern-overlay]").each(function () {
        "yes" == n(this).data("remove-pattern-overlay") &&
          n(this).css("background", "none");
      }),
      n("*[data-bg-color]").each(function () {
        var e = n(this).data("bg-color");
        n(this).css("background-color", e);
      }),
      n("*[data-bg-color-opacity]").each(function () {
        var e = n(this).data("bg-color-opacity"),
          t = n(this).css("background-color"),
          a = t.replace("rgb", "rgba").replace(")", ", " + e + ")");
        n(this).css("background-color", a);
      }),
      n("*[data-bg-img]").each(function () {
        var e = n(this).data("bg-img");
        n(this).css("background-image", "url('" + e + "')");
      }),
      n("*[data-parallax-bg-img]").each(function () {
        var e = n(this).data("parallax-bg-img");
        n(this).css(
          "background-image",
          "url('./images/files/parallax-bg/" + e + "')"
        );
      }),
      c(),
      n(".img-bg").each(function () {
        var e = n(this),
          t = e.find("img").attr("src");
        if (e.parent(".section-image").length)
          e.css("background-image", "url('" + t + "')");
        else {
          e.prepend("<div class='bg-element'></div>");
          var a = e.find(".bg-element");
          a.css("background-image", "url('" + t + "')");
        }
        e.find("img").css({ opacity: 0, visibility: "hidden" });
      }),
      n("#full-container").fitVids(),
      n(".video-background").each(function () {
        n(this).YTPlayer({
          mute: !1,
          autoPlay: !1,
          opacity: 1,
          containment: ".video-background",
          showControls: !1,
          startAt: 0,
          addRaster: !0,
          showYTLogo: !1,
          stopMovieOnBlur: !1,
        });
      }),
      n(".lightbox-img").magnificPopup({
        type: "image",
        gallery: { enabled: !1 },
        mainClass: "mfp-fade",
        removalDelay: 160,
        preloader: !1,
        fixedContentPos: !1,
      }),
      n(".lightbox-gallery").magnificPopup({
        type: "image",
        gallery: { enabled: !0 },
        mainClass: "mfp-fade",
        removalDelay: 160,
        preloader: !1,
        fixedContentPos: !1,
      }),
      n(".lightbox-iframe").magnificPopup({
        type: "iframe",
        mainClass: "mfp-fade",
        removalDelay: 160,
        preloader: !1,
        fixedContentPos: !1,
      }),
      (e = n(".header-bar.sticky")),
      (t = e.height()),
      (a = e ? t : 0),
      n(".scroll-to").on("click", function (e) {
        e.preventDefault();
        var t = n(this);
        n("html, body")
          .stop()
          .animate(
            { scrollTop: n(t.attr("href")).offset().top - a },
            1200,
            "easeInOutExpo"
          );
      }),
      n(".counter-stats").each(function () {
        var e = n(this),
          t = e.text(),
          a = t
            .toString()
            .replace(
              /(\d)/g,
              "<span class='digit'><span class='digit-value'>$1</span></span>"
            );
        e.html(a + "<div class='main'>" + t + "</span>"),
          e.find(".digit").each(function () {
            var e = n(this),
              t = e.find(".digit-value").text();
            e.append(
              "<div class='counter-animator' data-value='" +
                t +
                "'><ul><li>0</li><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li><li>8</li><li>9</li></ul></div>"
            );
          });
      }),
      n(".counter-stats").each(function (t) {
        var a = n(this);
        new Waypoint({
          element: a,
          handler: function (e) {
            setTimeout(function () {
              setTimeout(function () {
                1 < n(window).width() &&
                  a.find(".counter-animator").each(function () {
                    var e = n(this),
                      t = 10 * e.data("value");
                    e.find("ul").css({
                      transform: "translateY(-" + t + "%)",
                      "-webkit-transform": "translateY(-" + t + "%)",
                      "-moz-transform": "translateY(-" + t + "%)",
                      "-ms-transform": "translateY(-" + t + "%)",
                      "-o-transform": "translateY(-" + t + "%)",
                    });
                  });
              }, 0 * t);
            }, 0);
          },
          offset: "90%",
        });
      }),
      d(),
      (i = n(".banner-parallax")),
      (s = i.children("img:first-child").attr("src")),
      i.prepend("<div class='bg-element'></div>"),
      i
        .find("> .bg-element")
        .css("background-image", "url('" + s + "')")
        .attr("data-stellar-background-ratio", 0.2),
      n(".parallax-section").each(function () {
        var e = n(this),
          t = e.children("img:first-child").attr("src");
        e.prepend("<div class='bg-element'></div>");
        var a = e.find("> .bg-element");
        a.css("background-image", "url('" + t + "')").attr(
          "data-stellar-background-ratio",
          0.2
        );
      }),
      n(".slider-services > .owl-carousel").owlCarousel({
        rtl: r,
        autoplay: 4e3,
        autoplaySpeed: 500,
        autoplayTimeout: 5e3,
        dragEndSpeed: 400,
        autoplayHoverPause: !0,
        loop: !1,
        slideBy: 1,
        margin: 30,
        stagePadding: 0,
        nav: !1,
        dots: !1,
        navText: [
          '<i class="fa fa-angle-left"></i>',
          '<i class="fa fa-angle-right"></i>',
        ],
        responsive: {
          0: { items: 1 },
          480: { items: 1 },
          600: { items: 2 },
          768: { items: 2 },
          1024: { items: 2 },
        },
        autoHeight: !0,
        autoWidth: !1,
        navRewind: !0,
        center: !1,
        dotsEach: 1,
        dotData: !1,
        lazyLoad: !1,
        smartSpeed: 600,
        fluidSpeed: 5e3,
        navSpeed: 400,
        dotsSpeed: 400,
      }),
      n(".slider-clients > .owl-carousel").owlCarousel({
        items: 6,
        rtl: r,
        autoplay: 3e3,
        autoplaySpeed: 500,
        autoplayTimeout: 3e3,
        dragEndSpeed: 400,
        autoplayHoverPause: !0,
        loop: !0,
        slideBy: 1,
        margin: 30,
        stagePadding: 0,
        nav: !1,
        dots: !1,
        navText: [
          '<i class="fa fa-angle-left"></i>',
          '<i class="fa fa-angle-right"></i>',
        ],
        responsive: {
          0: { items: 2 },
          480: { items: 3 },
          768: { items: 4 },
          992: { items: 5 },
          1200: { items: 6 },
        },
        autoHeight: !1,
        autoWidth: !1,
        navRewind: !0,
        center: !1,
        dotsEach: 1,
        dotData: !1,
        lazyLoad: !1,
        smartSpeed: 600,
        fluidSpeed: 5e3,
        navSpeed: 400,
        dotsSpeed: 400,
      }),
      n(".slider-testimonials > .owl-carousel").owlCarousel({
        rtl: r,
        autoplay: 4e3,
        autoplaySpeed: 500,
        autoplayTimeout: 5e3,
        dragEndSpeed: 400,
        autoplayHoverPause: !0,
        loop: !0,
        slideBy: 1,
        margin: 30,
        stagePadding: 0,
        nav: !1,
        dots: !1,
        navText: [
          '<i class="fa fa-angle-left"></i>',
          '<i class="fa fa-angle-right"></i>',
        ],
        responsive: {
          0: { items: 1 },
          480: { items: 1 },
          600: { items: 2 },
          768: { items: 2 },
          1024: { items: 3 },
        },
        autoHeight: !0,
        autoWidth: !1,
        navRewind: !0,
        center: !1,
        dotsEach: 1,
        dotData: !1,
        lazyLoad: !1,
        smartSpeed: 600,
        fluidSpeed: 5e3,
        navSpeed: 400,
        dotsSpeed: 400,
      }),
      (function () {
        n("#form-cta-subscribe-1").validate({
          rules: { cs1Email: { required: !0, email: !0 } },
        });
        var e = n(".cs-notifications").data("error-msg"),
          i = e || "Please Follow Error Messages and Complete as Required";
        n("#form-cta-subscribe-1").on("submit", function (e) {
          if (e.isDefaultPrevented()) {
            var t = '<i class="cs-error-icon fa fa-close"></i>' + i;
            h(!1, t), u();
          } else
            e.preventDefault(),
              (a = n("#cs1Email").val()),
              n.ajax({
                type: "POST",
                url: "./php/cs1-process.php",
                data: "&cs1Email=" + a,
                success: function (e) {
                  var t, a;
                  "success" == e
                    ? ((t = n(".cs-notifications").data("success-msg")),
                      (a = t || "Thank you for your submission :)"),
                      n("#form-cta-subscribe-1")[0].reset(),
                      h(!0, '<i class="cs-success-icon fa fa-check"></i>' + a),
                      n(".cs-notifications-content").addClass("sent"),
                      n(".cs-notifications").css("opacity", 0),
                      n(".cs-notifications")
                        .slideDown(300)
                        .animate({ opacity: 1 }, 300)
                        .delay(5e3)
                        .slideUp(400))
                    : (u(), h(!1, e));
                },
              });
          var a;
        });
      })(),
      (function () {
        n("#form-cta-subscribe-2").validate({
          rules: {
            cs2Name: { required: !0, minlength: 3 },
            cs2Email: { required: !0, email: !0 },
          },
        });
        var e = n(".cs-notifications").data("error-msg"),
          s = e || "Please Follow Error Messages and Complete as Required";
        n("#form-cta-subscribe-2").on("submit", function (e) {
          if (e.isDefaultPrevented()) {
            var t = '<i class="cs-error-icon fa fa-close"></i>' + s;
            p(!1, t), f();
          } else
            e.preventDefault(),
              (a = n("#cs2Name").val()),
              (i = n("#cs2Email").val()),
              n.ajax({
                type: "POST",
                url: "./backend/api/save.php",
                data: "cs2Name=" + a + "&cs2Email=" + i,
                success: function (e) {
                  var t, a;
                  "success" == e
                    ? ((t = n(".cs-notifications").data("success-msg")),
                      (a = t || "Thank you for your submission 😎"),
                      n("#form-cta-subscribe-2")[0].reset(),
                      p(!0, '<i class="cs-success-icon fa fa-check"></i>' + a),
                      n(".cs-notifications-content").addClass("sent"),
                      n(".cs-notifications").css("opacity", 0),
                      n(".cs-notifications")
                        .slideDown(300)
                        .animate({ opacity: 1 }, 300)
                        .delay(5e3)
                        .slideUp(400))
                    : (f(), p(!1, e));
                },
                error: function(xhr, status, error) {
                  console.error("AJAX Error:", status, error);
              },
              });
          var a, i;
        });
      })(),
      l();
  }),
    n(window).on("load", function () {
      a(),
        i(),
        (function () {
          n("<div class='style-switcher'></div>").insertAfter(
            "#full-container"
          ),
            n(
              "<link href='css/skins/preview/skin-default.css' rel='stylesheet'>"
            ).appendTo(n("head"));
          n(".style-switcher").load("switcher.html", function () {
            n(this).append(
              "<img class='dp-img' src='images/files/style-switcher/img-1.jpg'>"
            ),
              setTimeout(function () {
                // n(".style-switcher").addClass("show"),
                  n(".ss-icon").toggleClass("rotating");
              }, 2e3),
              n(".demos-preview li a").each(function () {
                var t = n(this);
                t.hover(function () {
                  var e = t.find("img").attr("src");
                  n(".dp-img").attr("src", e).toggleClass("appeared");
                });
              }),
              n(".ss-icon").on("click", function (e) {
                e.preventDefault(),
                  n(".style-switcher").toggleClass("show"),
                  n(this).toggleClass("rotating");
              }),
              n(".colors-skins li button").each(function () {
                n(this).on("click", function () {
                  n("[href*='css/skins/preview']").attr(
                    "href",
                    "css/skins/preview/skin-" + n(this).attr("class") + ".css"
                  ),
                    n(".colors-skins li button").removeClass("active"),
                    n(this).addClass("active");
                });
              }),
              n(".switch-button").each(function () {
                n(this).on("click", function () {
                  n(this).toggleClass("active"),
                    n(this).next().toggleClass("active"),
                    n(this).prev().toggleClass("active");
                }),
                  n(this)
                    .prev("span")
                    .on("click", function () {
                      n(this).addClass("active"),
                        n(this).nextAll().removeClass("active");
                    }),
                  n(this)
                    .next("span")
                    .on("click", function () {
                      n(this).addClass("active"),
                        n(this)
                          .prev(".switch-button")
                          .addClass("active")
                          .prevAll("span:first-child")
                          .removeClass("active");
                    });
              }),
              n(".logo-option .switch-button").each(function () {
                n(this).on("click", function () {
                  n(".logo").toggleClass("logo-text");
                }),
                  n(this)
                    .prev("span")
                    .on("click", function () {
                      n(".logo").removeClass("logo-text");
                    }),
                  n(this)
                    .next("span")
                    .on("click", function () {
                      n(".logo").addClass("logo-text");
                    });
              }),
              n(".hb2-color-option .switch-button").each(function () {
                n(this).on("click", function () {
                  n("#header-bar-2").toggleClass("text-white");
                }),
                  n(this)
                    .prev("span")
                    .on("click", function () {
                      n("#header-bar-2").removeClass("text-white");
                    }),
                  n(this)
                    .next("span")
                    .on("click", function () {
                      n("#header-bar-2").addClass("text-white");
                    });
              }),
              n(".header-position-option .switch-button").each(function () {
                n(this).on("click", function () {
                  n(this).toggleClass("is-active"),
                    n(this).hasClass("is-active")
                      ? n("#header").insertAfter("#banner")
                      : n("#header").insertBefore("#banner");
                }),
                  n(this)
                    .prev("span")
                    .on("click", function () {
                      n("#header").insertBefore("#banner");
                    }),
                  n(this)
                    .next("span")
                    .on("click", function () {
                      n("#header").insertAfter("#banner");
                    });
              }),
              n(".hb-reverse-option .switch-button").each(function () {
                n(this).on("click", function () {
                  n(this).toggleClass("is-active"),
                    n(this).hasClass("is-active")
                      ? n("#header-bar-1").insertAfter("#header-bar-2")
                      : n("#header-bar-1").insertBefore("#header-bar-2");
                }),
                  n(this)
                    .prev("span")
                    .on("click", function () {
                      n("#header-bar-1").insertBefore("#header-bar-2");
                    }),
                  n(this)
                    .next("span")
                    .on("click", function () {
                      n("#header-bar-1").insertAfter("#header-bar-2");
                    });
              }),
              n(".header-option .switch-button").each(function () {
                n(this).on("click", function () {
                  n("#header").toggle(0), stickyNav();
                }),
                  n(this)
                    .prev("span")
                    .on("click", function () {
                      n("#header").hide(0), stickyNav();
                    }),
                  n(this)
                    .next("span")
                    .on("click", function () {
                      n("#header").show(0), stickyNav();
                    });
              }),
              n(".page-width-option .switch-button").each(function () {
                n(this).on("click", function () {
                  n("body").toggleClass("boxed");
                }),
                  n(this)
                    .prev("span")
                    .on("click", function () {
                      n("body").removeClass("boxed");
                    }),
                  n(this)
                    .next("span")
                    .on("click", function () {
                      n("body").addClass("boxed");
                    });
              });
            var e = document.querySelector(".style-switcher-content");
            SimpleScrollbar.initEl(e);
          });
        })();
    }),
    n(window).on("resize", function () {
      o(), c(), a();
    }),
    n(window).on("scroll", function () {
      d(), l(), i();
    }),
    n(window).on("load", function () {
      n(window).on("scroll", function () {});
    });
  (n = jQuery.noConflict())(window), n(this);
  var e = n("body");
  function o() {
    jRespond([
      { label: "smallest", enter: 0, exit: 479 },
      { label: "handheld", enter: 480, exit: 767 },
      { label: "tablet", enter: 768, exit: 991 },
      { label: "laptop", enter: 992, exit: 1199 },
      { label: "desktop", enter: 1200, exit: 1e4 },
    ]).addFunc([
      {
        breakpoint: "desktop",
        enter: function () {
          e.addClass("device-lg");
        },
        exit: function () {
          e.removeClass("device-lg");
        },
      },
      {
        breakpoint: "laptop",
        enter: function () {
          e.addClass("device-md");
        },
        exit: function () {
          e.removeClass("device-md");
        },
      },
      {
        breakpoint: "tablet",
        enter: function () {
          e.addClass("device-sm");
        },
        exit: function () {
          e.removeClass("device-sm");
        },
      },
      {
        breakpoint: "handheld",
        enter: function () {
          e.addClass("device-xs");
        },
        exit: function () {
          e.removeClass("device-xs");
        },
      },
      {
        breakpoint: "smallest",
        enter: function () {
          e.addClass("device-xxs");
        },
        exit: function () {
          e.removeClass("device-xxs");
        },
      },
    ]);
  }
  function c() {
    n(".fullscreen, #home-header, #home-banner").css(
      "height",
      n(window).height()
    ),
      n("#banner.fullscreen").css("height", n(window).height());
  }
  n(".banner-parallax").each(function () {
    var e = n(this).data("banner-height"),
      t = n(this).find(".row > [class*='col-']");
    n(this).css("min-height", e), n(t).css("min-height", e);
  }),
    n("body").waitForImages({
      finished: function () {
        setTimeout(function () {
          n(".lp-content, #loading-progress .logo").css({ opacity: 0 }),
            n("#loading-progress").addClass("hide-it"),
            setTimeout(function () {}, 1300);
        }, 0);
      },
      each: function (e, t, a) {
        var i = Math.floor(((e + 1) / t) * 100);
        n("#lp-counter").animate(
          { $this: i },
          {
            duration: 150,
            easing: "",
            queue: !1,
            step: function (e) {
              var t = Math.round(e);
              n("#lp-counter").text(t + "%");
            },
          }
        ),
          n("#lp-bar").animate({ width: i + "%" }, 0);
      },
      waitForAll: !0,
    });
  var r,
    t = n("html").css("direction");
  function a() {
    n(function () {
      (e.hasClass("device-lg") ||
        e.hasClass("device-md") ||
        e.hasClass("device-sm")) &&
        n.stellar({
          horizontalScrolling: !1,
          verticalOffset: 0,
          responsive: !0,
        });
    });
  }
  function l() {
    n(window).scrollTop();
    800 < n(window).scrollTop()
      ? n(".scroll-top-icon").addClass("show")
      : n(".scroll-top-icon").removeClass("show");
  }
  function i() {
    var e = n(document).height() - n(window).height(),
      t = n(document).scrollTop() / (e / 100);
    n("#scroll-progress .scroll-progress").width(t + "%"),
      n(".scroll-percent").text(t.toFixed(0) + "%");
  }
  (r = "rtl" == t),
    n(".scroll-top").on("click", function (e) {
      e.preventDefault(),
        n("html, body").animate({ scrollTop: 0 }, 1200, "easeInOutExpo");
    });
  var s = n(".logo-header img");
  s.attr("src"), s.data("logo-alt");
  function d() {
    var t = n(window).scrollTop();
    n(".header-bar").each(function () {
      var e = n(this);
      e.hasClass("sticky") &&
        (t > e.offset().top
          ? e.addClass("is-sticky")
          : (e.removeClass("is-sticky"), e.hasClass("text-white")));
    });
  }
  function u() {
    n(".cs-notifications").css("opacity", 0),
      n(".cs-notifications").slideDown(300).animate({ opacity: 1 }, 300),
      n(".cs-notifications-content").removeClass("sent");
  }
  function h(e, t) {
    var a;
    (a = "shake animated"),
      n(".cs-notifications")
        .delay(300)
        .addClass(a)
        .one(
          "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
          function () {
            n(this).removeClass("shake bounce animated");
          }
        ),
      n(".cs-notifications").children(".cs-notifications-content").html(t);
  }
  function f() {
    n(".cs-notifications").css("opacity", 0),
      n(".cs-notifications").slideDown(300).animate({ opacity: 1 }, 300),
      n(".cs-notifications-content").removeClass("sent");
  }
  function p(e, t) {
    var a;
    (a = "shake animated"),
      n(".cs-notifications")
        .delay(300)
        .addClass(a)
        .one(
          "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
          function () {
            n(this).removeClass("shake bounce animated");
          }
        ),
      n(".cs-notifications").children(".cs-notifications-content").html(t);
  }
  n(".scroll-to").on("click", function (e) {
    e.preventDefault();
    var t = n(this);
    n("html, body")
      .stop()
      .animate(
        { scrollTop: n(t.attr("href")).offset().top },
        1200,
        "easeInOutExpo"
      );
  }),
    n(".popup-btn, .popup-bg, .popup-close").on("click", function (e) {
      e.preventDefault(),
        n(".popup-preview").toggleClass("viewed"),
        n("body").toggleClass("scroll-lock");
    }),
    n("#form-cta-subscribe-3").ajaxChimp({
      callback: function (e) {
        var t = n(".cs-notifications");
        "success" === e.result
          ? (n("#form-cta-subscribe-3")[0].reset(),
            t
              .children(".cs-notifications-content")
              .html('<i class="cs-success-icon fa fa-check"></i>' + e.msg)
              .addClass("sent shake animated")
              .one(
                "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
                function () {
                  n(this).removeClass("shake bounce animated");
                }
              ),
            t.css("opacity", 0),
            t
              .slideDown(300)
              .animate({ opacity: 1 }, 300)
              .delay(8e3)
              .slideUp(400))
          : "error" === e.result &&
            (t
              .children(".cs-notifications-content")
              .html('<i class="cs-error-icon fa fa-close"></i>' + e.msg)
              .removeClass("sent")
              .addClass("bounce animated")
              .one(
                "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
                function () {
                  n(this).removeClass("shake bounce animated");
                }
              ),
            t.css("opacity", 0),
            t.slideDown(300).animate({ opacity: 1 }, 300));
      },
      url: "https://themeforest.us12.list-manage.com/subscribe/post?u=271ee03ffa4f5e3888d79125e&amp;id=163f4114e2",
    }),
    jQuery("https://moradhamdy.com/morad/leadmark-demo/img.svg").each(
      function () {
        var a = jQuery(this),
          i = a.attr("id"),
          s = a.attr("class"),
          e = a.attr("src");
        jQuery.get(
          e,
          function (e) {
            var t = jQuery(e).find("svg");
            void 0 !== i && (t = t.attr("id", i)),
              void 0 !== s && (t = t.attr("class", s + " replaced-svg")),
              (t = t.removeAttr("xmlns:a")),
              a.replaceWith(t);
          },
          "xml"
        );
      }
    );
})(jQuery);
