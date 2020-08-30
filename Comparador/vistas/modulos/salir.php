<?php
session_destroy();
$url = Ruta::ctrlRuta();
echo '
<script>
    window.location = "'.$url.'";
</script>
';