! function(t) {
    "use strict";
    var i = function() {};
    i.prototype.send = function(i, o, e, n, a, s, r, c) {
        s || (s = 3e3), r || (r = 1);
        var p = { heading: i, text: o, position: e, loaderBg: n, icon: a, hideAfter: s, stack: r };
        c && (p.showHideTransition = c), t.toast().reset("all"), t.toast(p)
    }, t.NotificationApp = new i, t.NotificationApp.Constructor = i
}(window.jQuery),
function(t) {
    "use strict";
    t("#toastr-one").on("click", function(i) {
        t.NotificationApp.send("Heads up!", "This alert needs your attention, but it is not super important.", "top-right", "#3b98b5", "info")
    }), t("#toastr-two").on("click", function(i) { t.NotificationApp.send("Heads up!", "Check below fields please.", "top-center", "#da8609", "warning") }), t("#toastr-three").on("click", function(i) { t.NotificationApp.send("Well Done!", "You successfully read this important alert message", "top-right", "#5ba035", "success") }), t("#toastr-four").on("click", function(i) { t.NotificationApp.send("Oh snap!", "Change a few things up and try submitting again.", "top-right", "#bf441d", "error") }), t("#toastr-five").on("click", function(i) { t.NotificationApp.send("How to contribute?", ["Fork the repository", "Improve/extend the functionality", "Create a pull request"], "top-right", "#1ea69a", "info") }), t("#toastr-six").on("click", function(i) { t.NotificationApp.send("Can I add <em>icons</em>?", "Yes! check this <a href='https://github.com/kamranahmedse/jquery-toast-plugin/commits/master'>update</a>.", "top-right", "#1ea69a", "info", !1) }), t("#toastr-seven").on("click", function(i) { t.NotificationApp.send("", "Set the `hideAfter` property to false and the toast will become sticky.", "top-right", "#1ea69a", "") }), t("#toastr-eight").on("click", function(i) { t.NotificationApp.send("", "Set the `showHideTransition` property to fade|plain|slide to achieve different transitions.", "top-right", "#1ea69a", "info", 3e3, 1, "fade") }), t("#toastr-nine").on("click", function(i) { t.NotificationApp.send("Slide transition", "Set the `showHideTransition` property to fade|plain|slide to achieve different transitions.", "top-right", "#1ea69a", "info", 3e3, 1, "slide") }), t("#toastr-ten").on("click", function(i) { t.NotificationApp.send("Plain transition", "Set the `showHideTransition` property to fade|plain|slide to achieve different transitions.", "top-right", "#3b98b5", "info", 3e3, 1, "plain") })
}(window.jQuery);