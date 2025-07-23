<?php
    session_start();
    session_destroy();
    echo "Logged out successfully.";
?>

<script language="javascript">
    document.location="index.php";
</script>
