<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<?php
function showToast($message, $type = "success") {
    // Define background colors based on type
    $bgColor = match($type) {
        "success" => "#4CAF50",  // green
        "error"   => "#F44336",  // red
        "warning" => "#FFC107",  // amber
        default   => "#4CAF50",  // default to green
    };

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Toastify({
                text: '$message',
                duration: 3000,
                close: true,
                gravity: 'top',
                position: 'right',
                backgroundColor: '$bgColor',
            }).showToast();
        });
    </script>";
}
?>



<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>