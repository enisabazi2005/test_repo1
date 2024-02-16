export default function lazyLoading() {
  function isElementInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }
  const allImages = document.querySelectorAll('img');
  
  allImages.forEach(function(img) {
    if (isElementInViewport(img)) {
      img.loading = "eager";
    }
    else{
      img.loading = "lazy";
    }
  });
}

