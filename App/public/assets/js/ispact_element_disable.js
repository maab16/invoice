  document.oncontextmenu = function(e) {
        var t = e || window.event;
        var n = t.target || t.srcElement;
        if (n.nodeName != "A") return false
    };
    document.ondragstart = function() {
        return false
    };


    function disableSelection(e) {
        if (typeof e.onselectstart != "undefined") e.onselectstart = function() {
            return false
        };
        else if (typeof e.style.MozUserSelect != "undefined") e.style.MozUserSelect = "none";
        else e.onmousedown = function() {
            return false
        };
        e.style.cursor = "default"
    }
    window.onload = function() {
        disableSelection(document.body)
    }