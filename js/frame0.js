/**
 * Created by kuro on 23.08.17.
 */

var t = $(".grid li");

t.click(function () {
    var frame = window.parent.document.getElementById("chartFrame");
    $(parent.document).find("#chartFrame2").hide();

    frame.src = "frame.php?cluster=" + this.id;
});