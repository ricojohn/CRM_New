<?php
header('Content-Type: text/xml');

$to = $_POST['To'] ?? '+639957802471'; // Default to a test number if not provided
?>
<Response>
    <Dial callerId="+17816509262"><?= htmlspecialchars($to) ?></Dial>
</Response>