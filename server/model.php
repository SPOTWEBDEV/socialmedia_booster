<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<?php
function showToast($message, $bgColor = "#4CAF50") {
    echo "
    <script>
        window.addEventListener('load', function() {
            Toastify({
                text: \"$message\",
                duration: 4000,
                close: true,
                gravity: 'top',
                position: 'right',
                backgroundColor: '$bgColor'
            }).showToast();
        });
    </script>
    ";
}
?>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>