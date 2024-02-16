export default function internalData() {
  var divs = document.querySelectorAll(".bookmaker");
  var count = 1;

  divs.forEach(function(div) {
    var anchors = div.querySelectorAll(".bookmaker-offer__btn");

    anchors.forEach(function(anchor) {
      anchor.setAttribute("data-experiment-id", count);
    });

    count++;
  });

  var sliderDivs = document.querySelectorAll(".vcos-wrapper");
  var countSliders = 1;

  sliderDivs.forEach(function(div) {
    var sliderAnchors = div.querySelectorAll(".vcos__content");
  
    sliderAnchors.forEach(function(anchor) {
      anchor.setAttribute("data-experiment-id", countSliders);
    });
    countSliders++;
  });
}
