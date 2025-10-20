<?php
// DEPRECATED: This legacy public script has been disabled for security reasons.
// Please POST JSON to the secure Laravel API endpoint: /api/contact

http_response_code(410);
header('Content-Type: application/json');
echo json_encode([
    'error' => 'deprecated',
    'message' => 'This endpoint is disabled. Use POST /api/contact with JSON payload {name,email,subject,message}.',
]);
exit;
?>