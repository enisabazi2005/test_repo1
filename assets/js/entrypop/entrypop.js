export default function EntryPop() {
  var entrypopLayout = document.querySelector(".entrypop-layout");
  var entrypop = document.querySelector(".entrypop");
  var closeEntryPopButton = document.querySelector("#close-entrypop");
  var showMessageButton = document.querySelector("#show-message");
  var entryMessage = document.querySelector(".entry-message");

  if (entrypopLayout && entrypop && closeEntryPopButton && showMessageButton && entryMessage) {
    closeEntryPopButton.addEventListener("click", function () {
      entrypopLayout.style.height = "0";
      entrypop.style.display = "none";
      document.body.style.overflowY = "auto";
    });

    showMessageButton.addEventListener("click", function () {
      entryMessage.style.display = "block";
    });

    // Check session storage and show entrypop if necessary
    if (sessionStorage.getItem("validAge") === null) {
      window.addEventListener("load", function () {
        setTimeout(function open(event) {
          entrypopLayout.style.height = "100vh";
          document.body.style.overflowY = "hidden";
          entrypop.style.display = "flex";
        }, 100);
      });

      // Set session storage when close button is clicked
      closeEntryPopButton.addEventListener("click", function () {
        sessionStorage.setItem('validAge', 'valid');
      });
    }
  }
}
