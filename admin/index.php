<?php
include_once '../server/connection.php';
echo "<script>window.location.href = './dashboard/';</script>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($sitename ?? 'Boost Yard'); ?> - Welcome</title>

<!-- Standard Favicon (for browsers) -->
<link rel="icon" href="<?php echo $domain; ?>assets/images/logo.png">

<!-- Open Graph Meta Tags (For WhatsApp, Facebook, LinkedIn) -->
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo htmlspecialchars($sitename ?? 'Boost Yard'); ?> - Boost Your Social Presence">
<meta property="og:description" content="Supercharge your social media accounts. Safely boost your followers, likes, views, and engagement instantly with Boost Yard.">
<meta property="og:url" content="<?php echo $domain; ?>">
<!-- The image MUST be an absolute URL (with http:// or https://) -->
<meta property="og:image" content="<?php echo $domain; ?>assets/images/logo.png">

<!-- Twitter Card Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo htmlspecialchars($sitename ?? 'Boost Yard'); ?> - Boost Your Social Presence">
<meta name="twitter:description" content="Supercharge your social media accounts. Safely boost your followers, likes, views, and engagement instantly with Boost Yard.">
<meta name="twitter:image" content="<?php echo $domain; ?>assets/images/logo.png">

</head>
<body>
    
</body>
</html>