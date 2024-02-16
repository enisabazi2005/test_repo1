let mix = require("laravel-mix");
const path = require("path"); // Import the 'path' module

mix.sass("assets/styles/styles.scss", "build/css/index.css");

// critical css
mix.sass("assets/styles/common/_base.scss", "build/css/base.css");
mix.sass("assets/styles/pages/_footer.scss", "build/css/footer.css");

// pages
mix.sass("assets/styles/pages/_author.scss", "build/css/author.css");
mix.sass("assets/styles/pages/_single-tips.scss", "build/css/single-tips.css");
mix.sass(
  "assets/styles/pages/_single-bookmakers.scss",
  "build/css/single-bookmakers.css"
);
mix.sass("assets/styles/pages/_404.scss", "build/css/404.css");
mix.sass(
  "assets/styles/pages/_sub-affiliate-page.scss",
  "build/css/sub-affiliate-page.css"
);
mix.sass(
  "assets/styles/pages/_authors-list.scss",
  "build/css/authors-list.css"
);

// blocks
// mix.sass("assets/styles/blocks/_categoryfeatures.scss", "build/css/categoryfeatures.css");
mix.sass("assets/styles/blocks/_countdown.scss", "build/css/countdown.css");
mix.sass(
  "assets/styles/blocks/_cta-bookmaker-block.scss",
  "build/css/cta-bookmaker-block.css"
);
// mix.sass("assets/styles/blocks/_events.scss", "build/css/events.css");
mix.sass("assets/styles/blocks/_guides.scss", "build/css/guides.css");
mix.sass(
  "assets/styles/blocks/_imageIframeWidget.scss",
  "build/css/imageIframeWidget.css"
);
mix.sass("assets/styles/blocks/_latest-news.scss", "build/css/latest-news.css");
mix.sass(
  "assets/styles/blocks/_list-highlights.scss",
  "build/css/list-highlights.css"
);
mix.sass("assets/styles/blocks/_more-tips.scss", "build/css/more-tips.css");
mix.sass(
  "assets/styles/blocks/_related-bets.scss",
  "build/css/related-bets.css"
);
mix.sass("assets/styles/blocks/_sidebar.scss", "build/css/sidebar.css");
mix.sass("assets/styles/blocks/_slicker.scss", "build/css/slicker.css");
mix.sass(
  "assets/styles/blocks/_sticky-video.scss",
  "build/css/sticky-video.css"
);
mix.sass(
  "assets/styles/blocks/_table-highlights.scss",
  "build/css/table-highlights.css"
);
mix.sass(
  "assets/styles/blocks/_table-review-analysis.scss",
  "build/css/table-review-analysis.css"
);
mix.sass("assets/styles/blocks/_takeover.scss", "build/css/takeover.css");
// mix.sass("assets/styles/blocks/_tips-widget.scss", "build/css/tips-widget.css");
// mix.sass("assets/styles/blocks/_todays-bets.scss", "build/css/todays-bets.css");
// mix.sass("assets/styles/blocks/_toptips.scss", "build/css/toptips.css");
mix.sass("assets/styles/blocks/_ad-banner.scss", "build/css/ad-banner.css");
mix.sass("assets/styles/blocks/_banners.scss", "build/css/banners.css");
mix.sass(
  "assets/styles/blocks/_bookmaker-comparison.scss",
  "build/css/bookmaker-comparison.css"
);
mix.sass(
  "assets/styles/blocks/_bookmaker-sidebar.scss",
  "build/css/bookmaker-sidebar.css"
);
mix.sass(
  "assets/styles/blocks/_bookmaker-toplist.scss",
  "build/css/bookmaker-toplist.css"
);

mix.js("assets/js/script.js", "/build/js/index.js");

mix.options({
  processCssUrls: false, // Disable URL processing for fonts in your CSS
});
mix.webpackConfig({
  resolve: {
    alias: {
      // Create an alias for the fonts directory to simplify font path references
      "@fonts": path.resolve(__dirname, "bettingpro/fonts"),
    },
  },
  module: {
    rules: [
      {
        test: "/.(woff|woff2|eot|ttf|otf)$",
        use: [
          {
            loader: "file-loader",
            options: {
              name: "fonts/[name].[ext]",
            },
          },
        ],
      },
    ],
  },
});
