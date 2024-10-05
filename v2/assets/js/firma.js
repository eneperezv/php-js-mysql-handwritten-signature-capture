document.addEventListener('DOMContentLoaded', function () {
    var canvas = document.getElementById('signature-pad');
    var ctx = canvas.getContext('2d');
    var drawing = false;

    function startDrawing(e) {
        drawing = true;
        ctx.beginPath();
        ctx.moveTo(e.offsetX || e.touches[0].clientX - canvas.offsetLeft, e.offsetY || e.touches[0].clientY - canvas.offsetTop);
    }

    function draw(e) {
        if (drawing) {
            ctx.lineTo(e.offsetX || e.touches[0].clientX - canvas.offsetLeft, e.offsetY || e.touches[0].clientY - canvas.offsetTop);
            ctx.stroke();
        }
    }

    function stopDrawing() {
        drawing = false;
    }

    // Mouse events
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);

    // Touch events
    canvas.addEventListener('touchstart', startDrawing);
    canvas.addEventListener('touchmove', draw);
    canvas.addEventListener('touchend', stopDrawing);
    canvas.addEventListener('touchcancel', stopDrawing);

    document.getElementById('clear').addEventListener('click', function () {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    });
});