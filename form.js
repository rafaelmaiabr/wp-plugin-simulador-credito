!(function (e) {
  "function" == typeof define && define.amd ? define([], e) : "object" == typeof exports ? (module.exports = e()) : (window.wNumb = e());
})(function () {
  "use strict";
  var o = ["decimals", "thousand", "mark", "prefix", "suffix", "encoder", "decoder", "negativeBefore", "negative", "edit", "undo"];
  function w(e) {
    return e.split("").reverse().join("");
  }
  function h(e, t) {
    return e.substring(0, t.length) === t;
  }
  function f(e, t, n) {
    if ((e[t] || e[n]) && e[t] === e[n]) throw new Error(t);
  }
  function x(e) {
    return "number" == typeof e && isFinite(e);
  }
  function n(e, t, n, r, i, o, f, u, s, c, a, p) {
    var d,
      l,
      h,
      g = p,
      v = "",
      m = "";
    return (
      o && (p = o(p)),
      !!x(p) &&
      (!1 !== e && 0 === parseFloat(p.toFixed(e)) && (p = 0),
        p < 0 && ((d = !0), (p = Math.abs(p))),
        !1 !== e &&
        (p = (function (e, t) {
          return (e = e.toString().split("e")), (+((e = (e = Math.round(+(e[0] + "e" + (e[1] ? +e[1] + t : t)))).toString().split("e"))[0] + "e" + (e[1] ? e[1] - t : -t))).toFixed(t);
        })(p, e)),
        -1 !== (p = p.toString()).indexOf(".") ? ((h = (l = p.split("."))[0]), n && (v = n + l[1])) : (h = p),
        t && (h = w((h = w(h).match(/.{1,3}/g)).join(w(t)))),
        d && u && (m += u),
        r && (m += r),
        d && s && (m += s),
        (m += h),
        (m += v),
        i && (m += i),
        c && (m = c(m, g)),
        m)
    );
  }
  function r(e, t, n, r, i, o, f, u, s, c, a, p) {
    var d,
      l = "";
    return (
      a && (p = a(p)),
      !(!p || "string" != typeof p) &&
      (u && h(p, u) && ((p = p.replace(u, "")), (d = !0)),
        r && h(p, r) && (p = p.replace(r, "")),
        s && h(p, s) && ((p = p.replace(s, "")), (d = !0)),
        i &&
        (function (e, t) {
          return e.slice(-1 * t.length) === t;
        })(p, i) &&
        (p = p.slice(0, -1 * i.length)),
        t && (p = p.split(t).join("")),
        n && (p = p.replace(n, ".")),
        d && (l += "-"),
        "" !== (l = (l += p).replace(/[^0-9\.\-.]/g, "")) && ((l = Number(l)), f && (l = f(l)), !!x(l) && l))
    );
  }
  function i(e, t, n) {
    var r,
      i = [];
    for (r = 0; r < o.length; r += 1) i.push(e[o[r]]);
    return i.push(n), t.apply("", i);
  }
  return function e(t) {
    if (!(this instanceof e)) return new e(t);
    "object" == typeof t &&
      ((t = (function (e) {
        var t,
          n,
          r,
          i = {};
        for (void 0 === e.suffix && (e.suffix = e.postfix), t = 0; t < o.length; t += 1)
          if (void 0 === (r = e[(n = o[t])])) "negative" !== n || i.negativeBefore ? ("mark" === n && "." !== i.thousand ? (i[n] = ".") : (i[n] = !1)) : (i[n] = "-");
          else if ("decimals" === n) {
            if (!(0 <= r && r < 8)) throw new Error(n);
            i[n] = r;
          } else if ("encoder" === n || "decoder" === n || "edit" === n || "undo" === n) {
            if ("function" != typeof r) throw new Error(n);
            i[n] = r;
          } else {
            if ("string" != typeof r) throw new Error(n);
            i[n] = r;
          }
        return f(i, "mark", "thousand"), f(i, "prefix", "negative"), f(i, "prefix", "negativeBefore"), i;
      })(t)),
        (this.to = function (e) {
          return i(t, n, e);
        }),
        (this.from = function (e) {
          return i(t, r, e);
        }));
  };
});
/*! rangeslider.js - v2.3.0 | (c) 2016 @andreruffert | MIT license | https://github.com/andreruffert/rangeslider.js */
!(function (a) {
  "use strict";
  "function" == typeof define && define.amd ? define(["jquery"], a) : "object" == typeof exports ? (module.exports = a(require("jquery"))) : a(jQuery);
})(function (a) {
  "use strict";
  function b() {
    var a = document.createElement("input");
    return a.setAttribute("type", "range"), "text" !== a.type;
  }
  function c(a, b) {
    var c = Array.prototype.slice.call(arguments, 2);
    return setTimeout(function () {
      return a.apply(null, c);
    }, b);
  }
  function d(a, b) {
    return (
      (b = b || 100),
      function () {
        if (!a.debouncing) {
          var c = Array.prototype.slice.apply(arguments);
          (a.lastReturnVal = a.apply(window, c)), (a.debouncing = !0);
        }
        return (
          clearTimeout(a.debounceTimeout),
          (a.debounceTimeout = setTimeout(function () {
            a.debouncing = !1;
          }, b)),
          a.lastReturnVal
        );
      }
    );
  }
  function e(a) {
    return a && (0 === a.offsetWidth || 0 === a.offsetHeight || a.open === !1);
  }
  function f(a) {
    for (var b = [], c = a.parentNode; e(c);) b.push(c), (c = c.parentNode);
    return b;
  }
  function g(a, b) {
    function c(a) {
      "undefined" != typeof a.open && (a.open = !a.open);
    }
    var d = f(a),
      e = d.length,
      g = [],
      h = a[b];
    if (e) {
      for (var i = 0; i < e; i++)
        (g[i] = d[i].style.cssText),
          d[i].style.setProperty ? d[i].style.setProperty("display", "block", "important") : (d[i].style.cssText += ";display: block !important"),
          (d[i].style.height = "0"),
          (d[i].style.overflow = "hidden"),
          (d[i].style.visibility = "hidden"),
          c(d[i]);
      h = a[b];
      for (var j = 0; j < e; j++) (d[j].style.cssText = g[j]), c(d[j]);
    }
    return h;
  }
  function h(a, b) {
    var c = parseFloat(a);
    return Number.isNaN(c) ? b : c;
  }
  function i(a) {
    return a.charAt(0).toUpperCase() + a.substr(1);
  }
  function j(b, e) {
    if (
      ((this.$window = a(window)),
        (this.$document = a(document)),
        (this.$element = a(b)),
        (this.options = a.extend({}, n, e)),
        (this.polyfill = this.options.polyfill),
        (this.orientation = this.$element[0].getAttribute("data-orientation") || this.options.orientation),
        (this.onInit = this.options.onInit),
        (this.onSlide = this.options.onSlide),
        (this.onSlideEnd = this.options.onSlideEnd),
        (this.DIMENSION = o.orientation[this.orientation].dimension),
        (this.DIRECTION = o.orientation[this.orientation].direction),
        (this.DIRECTION_STYLE = o.orientation[this.orientation].directionStyle),
        (this.COORDINATE = o.orientation[this.orientation].coordinate),
        this.polyfill && m)
    )
      return !1;
    (this.identifier = "js-" + k + "-" + l++),
      (this.startEvent = this.options.startEvent.join("." + this.identifier + " ") + "." + this.identifier),
      (this.moveEvent = this.options.moveEvent.join("." + this.identifier + " ") + "." + this.identifier),
      (this.endEvent = this.options.endEvent.join("." + this.identifier + " ") + "." + this.identifier),
      (this.toFixed = (this.step + "").replace(".", "").length - 1),
      (this.$fill = a('<div class="' + this.options.fillClass + '" />')),
      (this.$handle = a('<div class="' + this.options.handleClass + '" />')),
      (this.$range = a('<div class="' + this.options.rangeClass + " " + this.options[this.orientation + "Class"] + '" id="' + this.identifier + '" />')
        .insertAfter(this.$element)
        .prepend(this.$fill, this.$handle)),
      this.$element.css({ position: "absolute", width: "1px", height: "1px", overflow: "hidden", opacity: "0" }),
      (this.handleDown = a.proxy(this.handleDown, this)),
      (this.handleMove = a.proxy(this.handleMove, this)),
      (this.handleEnd = a.proxy(this.handleEnd, this)),
      this.init();
    var f = this;
    this.$window.on(
      "resize." + this.identifier,
      d(function () {
        c(function () {
          f.update(!1, !1);
        }, 300);
      }, 20)
    ),
      this.$document.on(this.startEvent, "#" + this.identifier + ":not(." + this.options.disabledClass + ")", this.handleDown),
      this.$element.on("change." + this.identifier, function (a, b) {
        if (!b || b.origin !== f.identifier) {
          var c = a.target.value,
            d = f.getPositionFromValue(c);
          f.setPosition(d);
        }
      });
  }
  Number.isNaN =
    Number.isNaN ||
    function (a) {
      return "number" == typeof a && a !== a;
    };
  var k = "rangeslider",
    l = 0,
    m = b(),
    n = {
      polyfill: !0,
      orientation: "horizontal",
      rangeClass: "rangeslider",
      disabledClass: "rangeslider--disabled",
      activeClass: "rangeslider--active",
      horizontalClass: "rangeslider--horizontal",
      verticalClass: "rangeslider--vertical",
      fillClass: "rangeslider__fill",
      handleClass: "rangeslider__handle",
      startEvent: ["mousedown", "touchstart", "pointerdown"],
      moveEvent: ["mousemove", "touchmove", "pointermove"],
      endEvent: ["mouseup", "touchend", "pointerup"],
    },
    o = { orientation: { horizontal: { dimension: "width", direction: "left", directionStyle: "left", coordinate: "x" }, vertical: { dimension: "height", direction: "top", directionStyle: "bottom", coordinate: "y" } } };
  return (
    (j.prototype.init = function () {
      this.update(!0, !1), this.onInit && "function" == typeof this.onInit && this.onInit();
    }),
    (j.prototype.update = function (a, b) {
      (a = a || !1),
        a &&
        ((this.min = h(this.$element[0].getAttribute("min"), 0)),
          (this.max = h(this.$element[0].getAttribute("max"), 100)),
          (this.value = h(this.$element[0].value, Math.round(this.min + (this.max - this.min) / 2))),
          (this.step = h(this.$element[0].getAttribute("step"), 1))),
        (this.handleDimension = g(this.$handle[0], "offset" + i(this.DIMENSION))),
        (this.rangeDimension = g(this.$range[0], "offset" + i(this.DIMENSION))),
        (this.maxHandlePos = this.rangeDimension - this.handleDimension),
        (this.grabPos = this.handleDimension / 2),
        (this.position = this.getPositionFromValue(this.value)),
        this.$element[0].disabled ? this.$range.addClass(this.options.disabledClass) : this.$range.removeClass(this.options.disabledClass),
        this.setPosition(this.position, b);
    }),
    (j.prototype.handleDown = function (a) {
      if (
        (a.preventDefault(),
          this.$document.on(this.moveEvent, this.handleMove),
          this.$document.on(this.endEvent, this.handleEnd),
          this.$range.addClass(this.options.activeClass),
          !((" " + a.target.className + " ").replace(/[\n\t]/g, " ").indexOf(this.options.handleClass) > -1))
      ) {
        var b = this.getRelativePosition(a),
          c = this.$range[0].getBoundingClientRect()[this.DIRECTION],
          d = this.getPositionFromNode(this.$handle[0]) - c,
          e = "vertical" === this.orientation ? this.maxHandlePos - (b - this.grabPos) : b - this.grabPos;
        this.setPosition(e), b >= d && b < d + this.handleDimension && (this.grabPos = b - d);
      }
    }),
    (j.prototype.handleMove = function (a) {
      a.preventDefault();
      var b = this.getRelativePosition(a),
        c = "vertical" === this.orientation ? this.maxHandlePos - (b - this.grabPos) : b - this.grabPos;
      this.setPosition(c);
    }),
    (j.prototype.handleEnd = function (a) {
      a.preventDefault(),
        this.$document.off(this.moveEvent, this.handleMove),
        this.$document.off(this.endEvent, this.handleEnd),
        this.$range.removeClass(this.options.activeClass),
        this.$element.trigger("change", { origin: this.identifier }),
        this.onSlideEnd && "function" == typeof this.onSlideEnd && this.onSlideEnd(this.position, this.value);
    }),
    (j.prototype.cap = function (a, b, c) {
      return a < b ? b : a > c ? c : a;
    }),
    (j.prototype.setPosition = function (a, b) {
      var c, d;
      void 0 === b && (b = !0),
        (c = this.getValueFromPosition(this.cap(a, 0, this.maxHandlePos))),
        (d = this.getPositionFromValue(c)),
        (this.$fill[0].style[this.DIMENSION] = d + this.grabPos + "px"),
        (this.$handle[0].style[this.DIRECTION_STYLE] = d + "px"),
        this.setValue(c),
        (this.position = d),
        (this.value = c),
        b && this.onSlide && "function" == typeof this.onSlide && this.onSlide(d, c);
    }),
    (j.prototype.getPositionFromNode = function (a) {
      for (var b = 0; null !== a;) (b += a.offsetLeft), (a = a.offsetParent);
      return b;
    }),
    (j.prototype.getRelativePosition = function (a) {
      var b = i(this.COORDINATE),
        c = this.$range[0].getBoundingClientRect()[this.DIRECTION],
        d = 0;
      return (
        "undefined" != typeof a.originalEvent["client" + b]
          ? (d = a.originalEvent["client" + b])
          : a.originalEvent.touches && a.originalEvent.touches[0] && "undefined" != typeof a.originalEvent.touches[0]["client" + b]
            ? (d = a.originalEvent.touches[0]["client" + b])
            : a.currentPoint && "undefined" != typeof a.currentPoint[this.COORDINATE] && (d = a.currentPoint[this.COORDINATE]),
        d - c
      );
    }),
    (j.prototype.getPositionFromValue = function (a) {
      var b, c;
      return (b = (a - this.min) / (this.max - this.min)), (c = Number.isNaN(b) ? 0 : b * this.maxHandlePos);
    }),
    (j.prototype.getValueFromPosition = function (a) {
      var b, c;
      return (b = a / (this.maxHandlePos || 1)), (c = this.step * Math.round((b * (this.max - this.min)) / this.step) + this.min), Number(c.toFixed(this.toFixed));
    }),
    (j.prototype.setValue = function (a) {
      (a === this.value && "" !== this.$element[0].value) || this.$element.val(a).trigger("input", { origin: this.identifier });
    }),
    (j.prototype.destroy = function () {
      this.$document.off("." + this.identifier),
        this.$window.off("." + this.identifier),
        this.$element
          .off("." + this.identifier)
          .removeAttr("style")
          .removeData("plugin_" + k),
        this.$range && this.$range.length && this.$range[0].parentNode.removeChild(this.$range[0]);
    }),
    (a.fn[k] = function (b) {
      var c = Array.prototype.slice.call(arguments, 1);
      return this.each(function () {
        var d = a(this),
          e = d.data("plugin_" + k);
        e || d.data("plugin_" + k, (e = new j(this, b))), "string" == typeof b && e[b].apply(e, c);
      });
    }),
    "rangeslider.js is available in jQuery context e.g $(selector).rangeslider(options);"
  );
});
!(function (n, a) {
  (a.lcalc = a.lcalc || {}),
    (a.behaviors.landingSlider = {
      attach: function (t, e) {
        n("#amount-slider", t).once(function () {
          var t = n(this),
            l = n("[name=pl_amount]");
          function r(a, t) {
            var l = e.masterTravel_currency,
              r = e.masterTravel_thousands_sep,
              o = wNumb({ decimals: 0, thousand: r, prefix: "- " + l + " ", suffix: " +" });
            n(a).html(o.to(t));
          }
          t.rangeslider({
            polyfill: !1,
            onInit: function () {
              ($handle = n(".rangeslider__handle", this.$range)), r($handle[0], this.value), a.lcalc.updateLoanInfoPL();
            },
            onSlide: function () {
              r(".form-item-pl-amount-range .rangeslider__handle", this.value), l.val(this.value), a.lcalc.updateLoanInfoPL();
            },
          });
        }),
          n("#term-slider", t).once(function () {
            var t = n(this),
              e = n("[name=pl_term]");
            function l(t, e) {
              (e = parseInt(e)), (text = a.formatPlural(e, "1 month", "@count months")), (e = "- " + text + " +"), n(t).html(e);
            }
            t.rangeslider({
              polyfill: !1,
              onInit: function () {
                ($handle = n(".rangeslider__handle", this.$range)), l($handle[0], this.value);
              },
              onSlide: function () {
                l(".form-item-pl-term-range .rangeslider__handle", this.value), e.val(this.value), a.lcalc.updateLoanInfoPL();
              },
            });
          });
      },
    }),
    (a.lcalc.format_money = function (n, t) {
      var e = a.settings.masterTravel_thousands_sep,
        l = a.settings.masterTravel_dec_point,
        r = a.settings.masterTravel_currency;
      return (t = void 0 !== t ? t : a.settings.masterTravel_money_decimals), wNumb({ mark: l, decimals: t, thousand: e, prefix: r }).to(n);
    }),
    (a.lcalc.updateLoanInfoPL = function () {
      var t,
        e = n("[name=pl_amount]").val(),
        l = n("[name=pl_term]").val(),
        r = a.settings.calc.pl.loan_table;
      if (!isNaN(e) && !isNaN(l)) {
        var o = e + "-" + l;
        if (o in r) {
          (t = r[o].monthlyPayment), n(".plcalc-replace-monthly-payment").html(a.lcalc.format_money(t, 2));
          var i = n(".form-with-slider #boxes-box-loan_info_pt .calc-number");
          i.length && ((e = parseFloat(e.toString())), i.eq(0).html(a.lcalc.format_money(e, 2)), i.eq(1).html(a.formatPlural(l, "1 month", "@count months")), i.eq(2).html(a.lcalc.format_money(t, 2)));
        }
      }
    });
})(jQuery, Drupal);
