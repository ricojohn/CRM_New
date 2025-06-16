<?php
header('Content-Type: text/xml');

$to = $_POST['To'] ?? '+639957802471'; // Default to a test number if not provided
?>
<Response>
    <Dial callerId="+13375105318"><?= htmlspecialchars($to) ?></Dial>
</Response>