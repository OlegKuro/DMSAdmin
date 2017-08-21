/**
 * Created by kuro on 21.08.17.
 */
function myfunc(f) {
    if (document.getElementById("log").value != "" && document.getElementById("pass").value != "") {
        f.submit();
        return true;
    } else {
        document.getElementById("smallauth").innerHTML = "empty login or pass";
        return false;
    }
}