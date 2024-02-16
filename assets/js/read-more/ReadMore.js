export default function readMore() {
  const readMoreLink = document.querySelectorAll('.bookmaker__disclosure__text__read-more');
  const readLessLink = document.querySelectorAll('.bookmaker__disclosure__text__read-less');
  const cutString = document.querySelectorAll('.bookmaker__disclosure__text__first');
  const wholeString = document.querySelectorAll('.bookmaker__disclosure__text__second');

  if (readMoreLink.length > 0 && readLessLink.length > 0) {
    readMoreLink.forEach((element, index) => {
      element.addEventListener("click", function () {
        element.style.display = "none";
        readLessLink[index].style.display = "inline-block";
        cutString[index].style.display = "none";
        wholeString[index].style.display = "inline";
      });
    });

    readLessLink.forEach((element, index) => {
      element.addEventListener("click", function () {
        element.style.display = "none";
        readMoreLink[index].style.display = "inline-block";
        wholeString[index].style.display = "none";
        cutString[index].style.display = "inline";
      });
    });
  }
}
  
  