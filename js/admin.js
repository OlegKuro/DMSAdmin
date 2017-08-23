/**
 * Created by kuro on 22.08.17.
 */
var t = $(".grid li");

t.click(function () {
    var frame = document.getElementById("chartFrame");
    $("#chartFrame2").hide();

    frame.src = "frame.php?cluster=" + this.id;

    $('#servFrame').show();
    var serverframe = document.getElementById("servFrame");
    serverframe.src = "frame0.php?server=" + this.id;
});

$(document).ready(function () {
    var frame = document.getElementById("chartFrame");
    $("#chartFrame").show();
    frame.src = "frame.php?cluster=world";
    setInterval(function () {
        document.getElementById("chartFrame").src += '';
    }, 240000);
    setInterval(function () {
        var t = document.getElementById("mas-label");
        t.src += '';
    }, 5000);
});

function resizeIframe(obj) {
    obj.style.height = 0;
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    obj.style.width = 0;
    obj.style.width = obj.contentWindow.document.body.scrollWidth + 'px';
}


function suchiyFrame(obj) {
    obj.style.height = 0;
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    obj.style.width = 0;
    obj.style.width = 156 + 'px';
}

function resizeServ(obj) {
    obj.style.height = 0;
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
}
function fadeOut(el) {
    el.style.opacity = 1;

    (function fade() {
        if ((el.style.opacity -= .1) < 0) {
            el.style.display = "none";
        } else {
            requestAnimationFrame(fade);
        }
    })();
}

// fade in

function fadeIn(el, display) {
    el.style.opacity = 0;
    el.style.display = display || "block";

    (function fade() {
        var val = parseFloat(el.style.opacity);
        if (!((val += .1) > 1)) {
            el.style.opacity = val;
            requestAnimationFrame(fade);
        }
    })();
}

