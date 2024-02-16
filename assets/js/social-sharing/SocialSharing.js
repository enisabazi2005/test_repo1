export default function socialSharing() {
  const sharingSection = document.querySelector(".social-sharing");
  const shareContainer = sharingSection;
  const url = document.location.href;
  const copyLink = document.querySelector(".copy-link");
  const tooltip = document.querySelector(".tooltip");

  const last = document.querySelector(".last");
  const check = document.querySelector(".check");
  const winWidth = window.outerWidth;

  copyLink.addEventListener("click", function () {
    navigator.clipboard.writeText(url);

    if (winWidth > 1023) {

      last.style.width = "0";
      check.style.width = "16px";
      check.style.display = "block";

      setTimeout(function () {
        last.style.width = "";
        check.style.width = "0";
        check.style.display = "none";
      }, 300);
    }

    setTimeout(function () {
      tooltip.style.visibility = "hidden";
    }, 2000);
  });

  setTimeout(() => {
    if (winWidth < 1023) {
      shareContainer.classList.remove("hide");
      shareContainer.classList.add("show");
    }
  }, 300);
}
