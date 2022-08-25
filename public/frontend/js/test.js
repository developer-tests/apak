(function (n, t, i) {
    function u(n, i) {
        var r = t(n);
        r.length !== 0 &&
            (i
                ? (r.find(".collapse-indicator-collapsed").addClass("hidden"), r.find(".collapse-indicator-shown").removeClass("hidden"))
                : (r.find(".collapse-indicator-collapsed").removeClass("hidden"), r.find(".collapse-indicator-shown").addClass("hidden")));
    }
    function f(i) {
        n.scroll(0, t(i).offset().top - this.$options.scrollMargin);
    }
    function e(n) {
        var i = t(this),
            u = i.data("details-accordion-plugin"),
            f = t.extend({}, r.DEFAULTS, i.data(), typeof n == "object" && n);
        u || i.data("details-accordion-plugin", (u = new r(this, f)));
    }
    var r = function (n, i) {
        var r = this,
            f,
            u;
        this.$element = t(n);
        this.$options = i;
        f = r.$element.find('[data-toggle="collapse"]');
        f.addClass("collapsed");
        r.$element.find(".collapse-indicator-collapsed").removeClass("hidden");
        r.$element.find(".collapse-indicator-shown").addClass("hidden");
        u = t(i.defaultPanel).closest(".panel");
        u.length === 0 && (u = r.$element.find(".panel").first());
        u.length > 0 && (u.find('[data-toggle="collapse"]').removeClass("collapsed"), u.find(".panel-collapse").addClass("in"), r._updateCollapseIndicator(u, !0));
        this.$element.on("shown.bs.collapse", function (n) {
            var u = t(n.target).closest(".panel");
            i.scrollToPanelOnExpand && r._scrollPanelIntoView(u);
            r._updateCollapseIndicator(u, !0);
        });
        this.$element.on("hidden.bs.collapse", function (n) {
            var i = t(n.target).closest(".panel");
            r._updateCollapseIndicator(i, !1);
        });
    };
    r.DEFAULTS = { defaultPanel: i, scrollToPanelOnExpand: !0, scrollMargin: 8 };
    r.prototype._updateCollapseIndicator = u;
    r.prototype._scrollPanelIntoView = f;
    t.fn.detailsAccordion = e;
    t.fn.detailsAccordion.Constructor = r;
})(window, jQuery),
    (function (n, t, i) {
        function h(t, i) {
            if (t == null || t == "" || t.match("s/g") != null) return !1;
            var r = o(n(i).closest("form"));
            return r && t.indexOf("***") == 0 ? !0 : t.match("[^0-9]") != null ? !1 : l(t);
        }
        function c(t, i) {
            var r = n(i).closest("form"),
                e = o(r),
                u,
                f;
            return e && t.indexOf("***") == 0 ? !0 : ((u = s(t)), (f = r.find(".payment-types")), f.find('img[data-type="' + u + '"]').length == 0) ? !1 : !0;
        }
        function o(n) {
            return n.find("[name=isedit]").val() == "true" ? !0 : !1;
        }
        function s(n) {
            var t = "";
            return n.match(f.VISA) != null ? (t = u.VISA) : n.match(f.MASTERCARD) != null ? (t = u.MASTERCARD) : n.match(f.AMERICAN_EXPRESS) != null ? (t = u.AMERICAN_EXPRESS) : n.match(f.DISCOVER) != null && (t = u.DISCOVER), t;
        }
        function l(n) {
            for (var f, u = 0, t = 0, i = !1, r = n.length - 1; r >= 0; r--) (f = n.charAt(r)), (t = parseInt(f, 10)), i && (t *= 2) > 9 && (t -= 9), (u += t), (i = !i);
            return u % 10 == 0;
        }
        function e(t, u) {
            return this.each(function () {
                var f = n(this),
                    e = f.data("credit-card-type-plugin"),
                    o = n.extend({}, u, f.data());
                return e || f.data("credit-card-type-plugin", (e = new r(f))), e[t] != i ? e[t](o) : void 0;
            });
        }
        function a(t) {
            var i = n(this);
            return e.call(i, "keyPress", t);
        }
        function v(t) {
            var i = n(this);
            e.call(i, "keyUp", t);
        }
        var u = { VISA: "Visa", MASTERCARD: "Mastercard", AMERICAN_EXPRESS: "American Express", DISCOVER: "Discover" },
            f = { VISA: "^4", MASTERCARD: "(^5[1-5])|(^2[2-7])", AMERICAN_EXPRESS: "^3[47]", DISCOVER: "^6(?:011|5)" },
            r = function (t) {
                this.$input = n(t);
                this.$types = this.$input.closest("form").find(".payment-types");
            };
        r.prototype.setType = function () {
            var n = this.$input.val(),
                t = s(n);
            this.$types
                .find("img:not(.hidden)")
                .addClass("hidden")
                .end()
                .find('img[data-type="' + t + '"]')
                .removeClass("hidden");
                console.log(t);
            $("#card_type").val(t);
        };
        r.prototype.keyPress = function (n) {
            var t = n.charCode ? n.charCode : n.which;
            return ((t = t == 0 ? n.keyCode : t), String.fromCharCode(t).match("[0-9]") == null) ? (n.preventDefault(), !1) : !0;
        };
        r.prototype.keyUp = function () {
            this.setType();
        };
        n.fn.creditCardType = e;
        n.fn.creditCardType.Constructor = r;
        n(document).on("keypress.bidopia.creditCardType.data-api", ".credit-card-type", a);
        n(document).on("keyup.bidopia.creditCardType.data-api", ".credit-card-type", v);
        n.validator.addMethod("bidopiacreditcard", h);
        n.validator.addMethod("bidopiacreditcardtype", c);
        n.validator.unobtrusive.adapters.add("bidopiacreditcard", function (n) {
            n.rules.bidopiacreditcard = !0;
            n.messages.bidopiacreditcard = n.message;
        });
        n.validator.unobtrusive.adapters.add("bidopiacreditcardtype", function (n) {
            n.rules.bidopiacreditcardtype = !0;
            n.messages.bidopiacreditcardtype = n.message;
        });
    })(jQuery),
    
    (function (n) {
        var t = n("#payment-methods-accordion");
        t.detailsAccordion();
    })(jQuery);
