<?php
/**
 * email_template.php
 * Wraps the admin's plain message text into a branded HTML email.
 *
 * Usage:
 *   $html = buildEmailHtml($subject, $messageText, $recipientName);
 *   smtpmailer($to, $subject, $html);
 */

function buildEmailHtml(string $subject, string $messageText, string $recipientName = ''): string
{
    // Preserve line breaks from the plain text the admin typed, but escape HTML first.
    $safeMessage = nl2br(htmlspecialchars($messageText, ENT_QUOTES, 'UTF-8'));
    $safeName    = htmlspecialchars($recipientName, ENT_QUOTES, 'UTF-8');
    $safeSubject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
    $greeting    = $safeName !== '' ? "Hi {$safeName}," : "Hi there,";
    $year        = date('Y');

    return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{$safeSubject}</title>
</head>
<body style="margin:0; padding:0; background-color:#0B1120; font-family:'Segoe UI', Helvetica, Arial, sans-serif;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#0B1120; padding:40px 16px;">
    <tr>
      <td align="center">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:560px; background-color:#F8FAFC; border-radius:16px; overflow:hidden;">

          <!-- Header / brand bar -->
          <tr>
            <td style="background:linear-gradient(135deg,#3B82F6,#6366F1); padding:28px 32px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="font-family:'Segoe UI', Helvetica, Arial, sans-serif; font-size:20px; font-weight:700; color:#ffffff; letter-spacing:-0.3px;">
                    Boost Yard   
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="padding:36px 32px 8px 32px;">
              <p style="margin:0 0 4px 0; font-size:13px; font-weight:600; letter-spacing:0.06em; text-transform:uppercase; color:#3B82F6;">
                {$safeSubject}
              </p>
              <h1 style="margin:6px 0 20px 0; font-size:22px; line-height:1.3; color:#0B1120; font-weight:700;">
                {$greeting}
              </h1>
              <div style="font-size:15px; line-height:1.7; color:#334155;">
                {$safeMessage}
              </div>
            </td>
          </tr>

          <!-- Divider -->
          <tr>
            <td style="padding:24px 32px 0 32px;">
              <div style="border-top:1px solid #E2E8F0;"></div>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding:20px 32px 32px 32px;">
              <p style="margin:0 0 6px 0; font-size:13px; color:#94A3B8;">
                This message was sent to you by Boost Yard support.
              </p>
              <p style="margin:0; font-size:13px; color:#94A3B8;">
                Need help? Reply to this email or reach us at
                <a href="mailto:support@boostyard.com.yahhh44.com" style="color:#3B82F6; text-decoration:none;">support@boostyard.com.yahhh44.com</a>
              </p>
            </td>
          </tr>

        </table>

        <!-- Sub-footer outside the card -->
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:560px; margin-top:16px;">
          <tr>
            <td align="center" style="font-size:12px; color:#475569; padding:0 16px;">
              &copy; {$year} Boost Yard. All rights reserved.
            </td>
          </tr>
        </table>

      </td>
    </tr>
  </table>
</body>
</html>
HTML;
}
