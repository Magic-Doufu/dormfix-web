function bg_draw() {
    var pattern = Trianglify({
        height: window.innerHeight,
        width: window.innerWidth,
        cell_size: 100,
        x_colors: 'Spectral'
    });
    $(".background-image").first().css("backgroundImage","url(" + pattern.png() + ")");
}
function hideScrollBar() {
    $('.noscrollbar').css("marginBottom",  getScrollBarWidth()).parent().css("overflow", "hidden");
}
$(document).ready(function() {
    hideScrollBar();
    bg_draw();
})