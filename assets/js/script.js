import loadMore from "./tips/CategoryFeaures";
import loadMoreES from "./tips/loadMoreES";
import moreGuides from "./guides/Guides";
import Navbar from "./navigation";
import singleEvents from "./single-events/SingleEvents";
import slicker from "./slicker/Slicker";
import lazyLoading from "./lazy-loading/LazyLoading";
import internalData from "./internal-data/InternalData";
import DemonotizedTemplate from "./bookmakers/DemonotizedTemplate";
import stickyVideo from "./sticky-video/StickyVideo";
import socialSharing from "./social-sharing/SocialSharing";
import takeoverBlockScripts from "./blocks/Takeover";
import scrollToTop from "./scrollToTop";
import authorBox from "./author-box/authorBox";
import loadMoreEN from "./tips/loadMoreEN";
import readMore from "./read-more/ReadMore";
import EntryPop from "./entrypop/entrypop";
document.addEventListener("DOMContentLoaded", function () {
  const slider = document.querySelectorAll(".js-vcos-slider,  .latest-news__holder__other__wrapper");
  if (slider.length > 0) {
    slicker();
  }

  const takeover = document.querySelectorAll(".takeover");
  if (takeover.length > 0) {
    takeoverBlockScripts();
  }

  const sharingSection = document.querySelectorAll(".social-sharing");
  if (sharingSection.length > 0) {
    socialSharing();
  }
  authorBox();
  scrollToTop();
  loadMore();
  loadMoreES();
  moreGuides();
  loadMoreEN();
  readMore();
  EntryPop();
  // Test on dev 
  setTimeout(() => {
    Navbar();
  }, 1000);

  lazyLoading(); 
  internalData();
  DemonotizedTemplate();

  const descriptionBtns = document.querySelectorAll('.js-event-more');
  if (descriptionBtns.length > 0) {
    singleEvents();
  }

  const stickyClass = document.querySelectorAll(".videoContainer");
  if (stickyClass.length > 0) {
    stickyVideo();
  }
});
