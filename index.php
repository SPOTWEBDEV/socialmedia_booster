<?php
include('server/connection.php');

$flashMessage = '';
$flashType    = 'success'; // success | error

if (isset($_POST['send_contact'])) {
    $fullname   = trim($_POST['fullname'] ?? '');
    $phone      = trim($_POST['phone'] ?? '');
    $social_url = trim($_POST['social_url'] ?? '');
    $message    = trim($_POST['message'] ?? '');

    if (empty($fullname) || empty($message)) {
        $flashMessage = "Please fill in your name and message before sending.";
        $flashType = 'error';
    } else {

        // This reuses the same `support_messages` table that powers the logged-in
        // user's support ticket system (id, user, message, reply, created_at, status).
        // There are no dedicated columns for name/phone/social link, so we fold the
        // contact details into the message body itself, and leave `user` NULL to
        // mark this as a guest submission from the public landing page (as opposed
        // to a ticket tied to a real user id).
        $composedMessage = "From: " . $fullname;
        if (!empty($phone)) {
            $composedMessage .= "\nPhone: " . $phone;
        }
        if (!empty($social_url)) {
            $composedMessage .= "\nSocial link: " . $social_url;
        }
        $composedMessage .= "\n\n" . $message;

        $stmt = $connection->prepare("
            INSERT INTO support_messages (user, message, status)
            VALUES (NULL, ?, 'pending')
        ");
        $stmt->bind_param("s", $composedMessage);

        if ($stmt->execute()) {
            $flashMessage = "Thanks, ".htmlspecialchars($fullname)."! We've received your message and will get back to you soon.";
            $flashType = 'success';
        } else {
            $flashMessage = "Something went wrong sending your message. Please try again.";
            $flashType = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme-mode="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($sitename ?? 'Boost Yard'); ?> - Welcome</title>
  <link rel="icon" href="<?php echo $domain ?>assets/images/brand-logos/favicon.ico" type="image/x-icon">

  <link href="<?php echo $domain ?>assets/css/icons.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-u-bg text-u-text">

  <!-- Nav -->
  <header class="sticky top-0 z-40 bg-u-card/90 backdrop-blur border-b border-u-line">
    <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
      <a href="#home" class="flex items-center gap-2">
        <img src="<?php echo $domain ?>assets/images/logo.png" alt="<?php echo htmlspecialchars($sitename ?? 'Boost Yard'); ?>" class="h-[100px]">
      </a>

      <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-u-muted">
        <a href="#home" class="hover:text-u-text transition">Home</a>
        <a href="#about" class="hover:text-u-text transition">About</a>
        <a href="#services" class="hover:text-u-text transition">Services</a>
        <a href="#testimonials" class="hover:text-u-text transition">Reviews</a>
        <a href="#faqs" class="hover:text-u-text transition">FAQ's</a>
        <a href="#contact" class="hover:text-u-text transition">Contact us</a>
      </nav>

      <div class="hidden md:flex items-center gap-3">
        <a href="<?php echo $domain . 'auth/'; ?>"
          class="text-sm font-semibold px-4 py-2 rounded-xl border border-u-line text-u-text hover:bg-u-surface transition">
          Sign up
        </a>
        <a href="<?php echo $domain . 'auth/'; ?>"
          class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-4 py-2 rounded-xl transition shadow-sm">
          Login
        </a>
      </div>

      <button id="mobileMenuBtn" class="md:hidden text-u-text text-xl">
        <i class="bi bi-list"></i>
      </button>
    </div>

    <!-- Mobile menu -->
    <div id="mobileMenu" class="hidden md:hidden border-t border-u-line px-6 py-4 space-y-3 bg-u-card">
      <a href="#home" class="block text-sm text-u-muted hover:text-u-text">Home</a>
      <a href="#about" class="block text-sm text-u-muted hover:text-u-text">About</a>
      <a href="#services" class="block text-sm text-u-muted hover:text-u-text">Services</a>
      <a href="#testimonials" class="block text-sm text-u-muted hover:text-u-text">Reviews</a>
      <a href="#faqs" class="block text-sm text-u-muted hover:text-u-text">FAQ's</a>
      <a href="#contact" class="block text-sm text-u-muted hover:text-u-text">Contact us</a>
      <div class="flex gap-3 pt-2">
        <a href="<?php echo $domain . 'auth/'; ?>" class="flex-1 text-center text-sm font-semibold px-4 py-2 rounded-xl border border-u-line">Sign up</a>
        <a href="<?php echo $domain . 'auth/'; ?>" class="flex-1 text-center text-sm font-semibold px-4 py-2 rounded-xl bg-blue-600 text-white">Login</a>
      </div>
    </div>
  </header>

  <!-- Hero -->
  <section id="home" class="bg-gradient-to-br from-blue-600 to-indigo-700 text-white">
    <div class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-10 items-center">
      <div>
        <p class="text-sm font-semibold uppercase tracking-wider text-blue-100 mb-3">Boost your social presence</p>
        <h1 class="font-display text-4xl sm:text-5xl font-bold mb-4 leading-tight">
          Grow your influence effortlessly with Boost Yard
        </h1>
        <p class="text-blue-100 text-base mb-8 leading-relaxed">
          Boost Yard helps you increase followers, views, engagement, and overall visibility
          across all major social media platforms — fast, reliable, and secure.
        </p>
        <div class="flex flex-wrap gap-3">
          <a href="<?php echo $domain; ?>auth/"
            class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-6 py-3 rounded-xl hover:bg-blue-50 transition shadow-sm">
            Explore services <i class="bi bi-arrow-right"></i>
          </a>
          <a href="#contact"
            class="inline-flex items-center gap-2 border border-white/40 text-white text-sm font-semibold px-6 py-3 rounded-xl hover:bg-white/10 transition">
            Talk to us
          </a>
        </div>
      </div>
      <div class="hidden md:block">
        <img src="<?php echo $domain ?>assets/images/media/landing/1.png" alt="Boost Yard" class="w-full">
      </div>
    </div>
  </section>

  <!-- Stats -->
  <section class="border-b border-u-line bg-u-card">
    <div class="max-w-6xl mx-auto px-6 py-10 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
      <div>
        <p class="font-display text-2xl sm:text-3xl font-bold text-u-text">50k+</p>
        <p class="text-xs text-u-muted mt-1">Orders delivered</p>
      </div>
      <div>
        <p class="font-display text-2xl sm:text-3xl font-bold text-u-text">15k+</p>
        <p class="text-xs text-u-muted mt-1">Happy clients</p>
      </div>
      <div>
        <p class="font-display text-2xl sm:text-3xl font-bold text-u-text">24/7</p>
        <p class="text-xs text-u-muted mt-1">Support availability</p>
      </div>
      <div>
        <p class="font-display text-2xl sm:text-3xl font-bold text-u-text">99.9%</p>
        <p class="text-xs text-u-muted mt-1">Delivery reliability</p>
      </div>
    </div>
  </section>

  <!-- About -->
  <section id="about" class="max-w-6xl mx-auto px-6 py-20">
    <div class="text-center max-w-2xl mx-auto mb-12">
      <p class="text-xs font-semibold uppercase tracking-wider text-blue-600 mb-2">About</p>
      <h2 class="font-display text-2xl sm:text-3xl font-bold text-u-text mb-3">
        Powerful tools to grow your social influence
      </h2>
      <p class="text-u-muted text-sm">Boost Yard helps you build real momentum across all your social platforms.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
      <div class="bg-u-card border border-u-line rounded-2xl p-6 shadow-sm">
        <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 text-xl mb-4">
          <i class="bi bi-lightbulb"></i>
        </div>
        <h3 class="font-semibold text-u-text mb-2">Smart growth services</h3>
        <p class="text-sm text-u-muted">Boost your followers, views, and engagement with fast and reliable growth tools.</p>
      </div>
      <div class="bg-u-card border border-u-line rounded-2xl p-6 shadow-sm">
        <div class="w-12 h-12 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 text-xl mb-4">
          <i class="bi bi-chat-dots"></i>
        </div>
        <h3 class="font-semibold text-u-text mb-2">24/7 customer support</h3>
        <p class="text-sm text-u-muted">Our support team is always available to help you with orders, issues, or questions.</p>
      </div>
      <div class="bg-u-card border border-u-line rounded-2xl p-6 shadow-sm">
        <div class="w-12 h-12 rounded-full bg-amber-50 flex items-center justify-center text-amber-600 text-xl mb-4">
          <i class="bi bi-people"></i>
        </div>
        <h3 class="font-semibold text-u-text mb-2">Professional team</h3>
        <p class="text-sm text-u-muted">Our experienced staff ensures fast delivery and consistent quality for all services.</p>
      </div>
    </div>
  </section>

  <!-- Services -->
  <section id="services" class="bg-u-surface/40 py-20">
    <div class="max-w-6xl mx-auto px-6">
      <div class="text-center max-w-2xl mx-auto mb-12">
        <p class="text-xs font-semibold uppercase tracking-wider text-blue-600 mb-2">Services</p>
        <h2 class="font-display text-2xl sm:text-3xl font-bold text-u-text mb-3">Boosting services we provide</h2>
        <p class="text-u-muted text-sm">Powerful tools to boost your followers, views, engagement, and overall social reach.</p>
      </div>

      <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-5">
        <?php
        $services = [
          ['bi-instagram', 'Instagram growth', 'Boost your Instagram followers, likes, comments, and reach with fast delivery.'],
          ['bi-tiktok', 'TikTok boosting', 'Increase your TikTok views, likes, and followers to expand your visibility instantly.'],
          ['bi-youtube', 'YouTube engagement', 'Get more views, subscribers, and watch time to accelerate your channel growth.'],
          ['bi-facebook', 'Facebook promotion', 'Boost your Facebook page likes, post engagement, and overall social credibility.'],
          ['bi-twitter-x', 'Twitter/X influence', 'Get more followers, retweets, and impressions to grow your presence.'],
          ['bi-envelope', 'Email promotion', 'Promote your brand or social media pages through targeted email outreach.'],
          ['bi-person-check', 'Personal branding', 'Build your online identity with consistent engagement and broad coverage.'],
          ['bi-calendar-check', 'Campaign planning', 'Plan and execute powerful multi-platform campaigns to boost performance.'],
        ];
        foreach ($services as $s):
        ?>
          <div class="bg-u-card border border-u-line rounded-2xl p-6 text-center shadow-sm">
            <div class="w-12 h-12 mx-auto rounded-full bg-blue-50 flex items-center justify-center text-blue-600 text-xl mb-4">
              <i class="bi <?php echo $s[0]; ?>"></i>
            </div>
            <h3 class="font-semibold text-u-text mb-1"><?php echo $s[1]; ?></h3>
            <p class="text-xs text-u-muted"><?php echo $s[2]; ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Why choose us -->
  <section id="expectations" class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-10 items-center">
    <div>
      <img src="<?php echo $domain ?>assets/images/media/landing/2.png" alt="" class="rounded-2xl w-full">
    </div>
    <div>
      <p class="text-xs font-semibold uppercase tracking-wider text-blue-600 mb-2">Boost with confidence</p>
      <h2 class="font-display text-2xl sm:text-3xl font-bold text-u-text mb-4">Exceed your social media goals</h2>
      <p class="text-u-muted text-sm mb-6 leading-relaxed">
        Welcome to Boost Yard — the platform designed to help you grow faster, reach more people, and
        strengthen your social influence. Experience premium, reliable, and tailored boosting solutions
        built to deliver real results.
      </p>
      <ul class="space-y-3">
        <?php
        $points = [
          "Trusted expertise in social media growth and digital influence.",
          "A dedicated team focused on delivering fast and effective boost services.",
          "Personalized boosting options tailored to each user's social needs.",
          "Smooth and stress-free order process — quick, simple, and convenient.",
          "24/7 customer support ready to assist you any day, anytime.",
        ];
        foreach ($points as $point):
        ?>
          <li class="flex items-start gap-3 text-sm text-u-text">
            <i class="bi bi-check-circle-fill text-blue-600 mt-0.5 shrink-0"></i>
            <span><?php echo $point; ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <!-- Process -->
  <section id="workflow" class="bg-u-surface/40 py-20">
    <div class="max-w-6xl mx-auto px-6">
      <div class="text-center max-w-2xl mx-auto mb-12">
        <p class="text-xs font-semibold uppercase tracking-wider text-blue-600 mb-2">Boost Yard process</p>
        <h2 class="font-display text-2xl sm:text-3xl font-bold text-u-text mb-3">How we boost your social media influence</h2>
        <p class="text-u-muted text-sm">Our process begins as soon as you schedule a boost with us.</p>
      </div>

      <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-u-card border border-u-line rounded-2xl p-6 shadow-sm text-center">
          <div class="w-12 h-12 mx-auto rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 text-xl mb-4">
            <i class="bi bi-speedometer2"></i>
          </div>
          <span class="inline-block text-xs font-semibold text-blue-600 mb-2">01</span>
          <h3 class="font-semibold text-u-text mb-2">Maximize efficiency</h3>
          <p class="text-sm text-u-muted">Our workflow is designed to get your social media tasks done quickly.</p>
        </div>
        <div class="bg-u-card border border-u-line rounded-2xl p-6 shadow-sm text-center">
          <div class="w-12 h-12 mx-auto rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 text-xl mb-4">
            <i class="bi bi-sliders"></i>
          </div>
          <span class="inline-block text-xs font-semibold text-blue-600 mb-2">02</span>
          <h3 class="font-semibold text-u-text mb-2">Flexible boosting</h3>
          <p class="text-sm text-u-muted">Our approach adapts to your needs, responding to trends and opportunities.</p>
        </div>
        <div class="bg-u-card border border-u-line rounded-2xl p-6 shadow-sm text-center">
          <div class="w-12 h-12 mx-auto rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 text-xl mb-4">
            <i class="bi bi-patch-check"></i>
          </div>
          <span class="inline-block text-xs font-semibold text-blue-600 mb-2">03</span>
          <h3 class="font-semibold text-u-text mb-2">Quality engagement</h3>
          <p class="text-sm text-u-muted">We ensure every boost delivers authentic engagement and high-quality interactions.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section id="testimonials" class="max-w-6xl mx-auto px-6 py-20">
    <div class="text-center max-w-2xl mx-auto mb-12">
      <p class="text-xs font-semibold uppercase tracking-wider text-blue-600 mb-2">Reviews</p>
      <h2 class="font-display text-2xl sm:text-3xl font-bold text-u-text mb-3">What our clients say</h2>
      <p class="text-u-muted text-sm">A few words from people who've grown their accounts with Boost Yard.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
      <?php
      $testimonials = [
        ["Amara O.", "Content creator", "My engagement picked up within a couple of days of my first order. The dashboard makes it easy to track everything."],
        ["Daniel K.", "Small business owner", "Support responded quickly whenever I had a question about an order. Straightforward process from deposit to delivery."],
        ["Grace T.", "Influencer", "I like being able to see order status and history in one place. Made it easy to plan around a launch."],
      ];
      foreach ($testimonials as $t):
      ?>
        <div class="bg-u-card border border-u-line rounded-2xl p-6 shadow-sm">
          <div class="flex text-amber-400 text-sm mb-3">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p class="text-sm text-u-text mb-4 leading-relaxed">"<?php echo htmlspecialchars($t[2]); ?>"</p>
          <p class="text-sm font-semibold text-u-text"><?php echo htmlspecialchars($t[0]); ?></p>
          <p class="text-xs text-u-muted"><?php echo htmlspecialchars($t[1]); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FAQ -->
  <section id="faqs" class="bg-u-surface/40 py-20">
    <div class="max-w-5xl mx-auto px-6">
      <div class="text-center max-w-2xl mx-auto mb-12">
        <p class="text-xs font-semibold uppercase tracking-wider text-blue-600 mb-2">F.A.Q</p>
        <h2 class="font-display text-2xl sm:text-3xl font-bold text-u-text mb-3">Frequently asked questions</h2>
        <p class="text-u-muted text-sm">Common questions about Boost Yard and how to boost your social media accounts effectively.</p>
      </div>

      <div class="grid md:grid-cols-2 gap-4" id="faqAccordion">
        <?php
        $faqs = [
          ["How do I boost my Instagram account with Boost Yard?", "Select your desired boost package and follow the simple steps. Your growth is organic and safe."],
          ["Can I boost multiple social media accounts at the same time?", "Yes! Boost Yard allows you to manage and boost multiple accounts across Instagram, TikTok, and Facebook simultaneously, all from a single dashboard."],
          ["Is Boost Yard safe to use?", "Boost Yard uses safe methods to boost your social media, aiming to keep your accounts compliant with platform guidelines."],
          ["How quickly will I see results?", "Most packages start showing results within 24-48 hours, but full effects depend on the package and your account activity."],
          ["Can I cancel a boost or get a refund?", "Boost Yard offers refunds in certain cases according to our refund policy. Please check the terms before purchasing a package."],
          ["What social media platforms does Boost Yard support?", "Boost Yard supports Instagram, TikTok, Facebook, and Twitter/X. We are continuously adding more platforms."],
          ["Do I need an account to use Boost Yard?", "Yes, you need to create an account to manage boosts and track your progress. Registration is quick and free."],
          ["How can I pay for a boost?", "Boost Yard accepts payments via bank transfer and crypto, processed securely."],
          ["Can I track the progress of my boosts?", "Yes! Boost Yard provides order tracking so you can monitor the status of your boosted posts."],
          ["Is customer support available?", "Yes! Boost Yard offers support through the in-app support ticket system to assist you whenever needed."],
        ];
        foreach ($faqs as $i => $faq):
        ?>
          <div class="bg-u-card border border-u-line rounded-2xl overflow-hidden shadow-sm">
            <button type="button" class="faq-toggle w-full text-left px-5 py-4 flex items-center justify-between gap-3">
              <span class="text-sm font-semibold text-u-text"><?php echo htmlspecialchars($faq[0]); ?></span>
              <i class="bi bi-chevron-down text-u-muted text-xs shrink-0 transition-transform"></i>
            </button>
            <div class="faq-panel hidden px-5 pb-4">
              <p class="text-sm text-u-muted"><?php echo htmlspecialchars($faq[1]); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- CTA banner -->
  <section class="max-w-6xl mx-auto px-6 py-4">
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl px-8 py-12 text-center text-white">
      <h2 class="font-display text-2xl sm:text-3xl font-bold mb-3">Ready to grow your social media presence?</h2>
      <p class="text-blue-100 text-sm mb-6 max-w-xl mx-auto">
        Create a free account and place your first order in minutes.
      </p>
      <a href="<?php echo $domain; ?>auth/"
        class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-6 py-3 rounded-xl hover:bg-blue-50 transition shadow-sm">
        Get started <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </section>

  <!-- Contact -->
  <section id="contact" class="max-w-6xl mx-auto px-6 py-20">
    <div class="text-center max-w-2xl mx-auto mb-12">
      <p class="text-xs font-semibold uppercase tracking-wider text-blue-600 mb-2">Contact us</p>
      <h2 class="font-display text-2xl sm:text-3xl font-bold text-u-text mb-3">
        Have any questions about Boost Yard?
      </h2>
      <p class="text-u-muted text-sm">
        Reach out to us anytime for questions about packages, account setup, or social media boosting tips.
      </p>
    </div>

    <?php if (!empty($flashMessage)): ?>
      <div class="max-w-3xl mx-auto mb-6">
        <?php if ($flashType === 'error'): ?>
          <div class="flex items-center gap-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl px-4 py-3 text-sm">
            <i class="bi bi-exclamation-circle-fill text-rose-500 shrink-0"></i>
            <span><?php echo $flashMessage; ?></span>
          </div>
        <?php else: ?>
          <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl px-4 py-3 text-sm">
            <i class="bi bi-check-circle-fill text-emerald-500 shrink-0"></i>
            <span><?php echo $flashMessage; ?></span>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <div class="grid md:grid-cols-2 gap-6">
      <div class="bg-u-card border border-u-line rounded-2xl overflow-hidden shadow-sm">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d30444.274596168965!2d78.54114692513858!3d17.48198883339408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d17.4886524!2d78.5495041!4m5!1s0x3bcb9c7ec139a15d%3A0x326d1c90786b2ab6!2sspruko%20technologies!3m2!1d17.474805099999998!2d78.570258!5e0!3m2!1sen!2sin!4v1670225507254!5m2!1sen!2sin"
          class="w-full h-full min-h-[320px] border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <form method="POST" class="bg-u-card border border-u-line rounded-2xl p-6 shadow-sm space-y-4">
        <div class="grid sm:grid-cols-2 gap-4">
          <div>
            <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Full name</label>
            <input type="text" name="fullname" required placeholder="Enter your name"
              class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text placeholder-u-muted/60 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
          </div>
          <div>
            <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Phone number</label>
            <input type="text" name="phone" placeholder="Enter phone number"
              class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text placeholder-u-muted/60 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
          </div>
        </div>
        <div>
          <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Social media profile link</label>
          <input type="text" name="social_url" placeholder="Paste your profile link"
            class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text placeholder-u-muted/60 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition bg-u-bg">
        </div>
        <div>
          <label class="text-xs font-semibold text-u-muted uppercase tracking-wider mb-2 block">Message</label>
          <textarea name="message" required rows="4" placeholder="Write your message or inquiry"
            class="w-full border border-u-line rounded-xl px-4 py-3 text-sm text-u-text placeholder-u-muted/60 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition resize-none bg-u-bg"></textarea>
        </div>
        <button type="submit" name="send_contact"
          class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white text-sm font-semibold px-5 py-3 rounded-xl transition shadow-sm">
          <i class="bi bi-send"></i> Send message
        </button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-300">
    <div class="max-w-6xl mx-auto px-6 py-16 grid sm:grid-cols-2 md:grid-cols-4 gap-10">
      <div>
        <img src="<?php echo $domain ?>assets/images/logo.png" alt="Boost Yard" class="h-[100px] w-auto mb-4">
        <p class="text-sm text-gray-400 leading-relaxed">
          Boost Yard helps you grow your social media presence quickly and safely — followers,
          likes, and engagement, delivered efficiently.
        </p>
      </div>
      <div>
        <h4 class="text-white text-sm font-semibold uppercase tracking-wider mb-4">Pages</h4>
        <ul class="space-y-2 text-sm text-gray-400">
          <li><a href="#home" class="hover:text-white transition">Dashboard</a></li>
          <li><a href="#services" class="hover:text-white transition">Packages</a></li>
          <li><a href="#services" class="hover:text-white transition">Pricing</a></li>
          <li><a href="#workflow" class="hover:text-white transition">How it works</a></li>
          <li><a href="#faqs" class="hover:text-white transition">FAQ</a></li>
        </ul>
      </div>
      <div>
        <h4 class="text-white text-sm font-semibold uppercase tracking-wider mb-4">Info</h4>
        <ul class="space-y-2 text-sm text-gray-400">
          <li><a href="#about" class="hover:text-white transition">About Boost Yard</a></li>
          <li><a href="#contact" class="hover:text-white transition">Contact us</a></li>
          <li><a href="#" class="hover:text-white transition">Privacy policy</a></li>
          <li><a href="#" class="hover:text-white transition">Terms &amp; conditions</a></li>
        </ul>
      </div>
      <div>
        <h4 class="text-white text-sm font-semibold uppercase tracking-wider mb-4">Contact</h4>
        <ul class="space-y-3 text-sm text-gray-400">
          <li class="flex items-start gap-2"><i class="bi bi-geo-alt mt-0.5"></i> 123 Boost Yard Lane, Social City, US</li>
          <li class="flex items-start gap-2"><i class="bi bi-envelope mt-0.5"></i> support@boostyard.com</li>
          <li class="flex items-start gap-2"><i class="bi bi-telephone mt-0.5"></i> +234 9164687839</li>
        </ul>
      </div>
    </div>
    <div class="border-t border-gray-800 py-5 text-center text-xs text-gray-500">
      Copyright © <span id="year">2025</span> Boost Yard. All rights reserved.
    </div>
  </footer>

<script>
document.getElementById("year").textContent = new Date().getFullYear();

// Mobile nav
const mobileMenuBtn = document.getElementById("mobileMenuBtn");
const mobileMenu = document.getElementById("mobileMenu");
mobileMenuBtn.addEventListener("click", () => mobileMenu.classList.toggle("hidden"));
mobileMenu.querySelectorAll("a").forEach(a => a.addEventListener("click", () => mobileMenu.classList.add("hidden")));

// FAQ accordion
document.querySelectorAll(".faq-toggle").forEach(function (btn) {
  btn.addEventListener("click", function () {
    const panel = btn.nextElementSibling;
    const icon = btn.querySelector("i");
    const isOpen = !panel.classList.contains("hidden");

    document.querySelectorAll(".faq-panel").forEach(p => p.classList.add("hidden"));
    document.querySelectorAll(".faq-toggle i").forEach(i => i.style.transform = "rotate(0deg)");

    if (!isOpen) {
      panel.classList.remove("hidden");
      icon.style.transform = "rotate(180deg)";
    }
  });
});
</script>

</body>
</html>