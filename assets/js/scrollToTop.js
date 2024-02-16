export default function scrollToTop() {
    function isElementVisible (element) {
        const { top, bottom } = element.getBoundingClientRect();
        const windowHeight = window.innerHeight;
      
        return (
          (top > 0 || bottom > 0) &&
            top < windowHeight
        );
    }
    
    window.addEventListener("scroll", () => {
        let footer = document.querySelector(".footer");
        let scrollTop = document.getElementById("scrollTop");

        if (window.scrollY < window.outerHeight) {
            scrollTop.style.display = "none";
        } else if (isElementVisible(footer)) {
            scrollTop.style.display = "block";
            scrollTop.style.position = "absolute";
            scrollTop.style.transform = "translateY(0px)";
        } else {
            scrollTop.style.transform = "translateY(-80px)";
            scrollTop.style.display = "block";
            scrollTop.style.position = "fixed";
        }

        scrollTop.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });
    });
}
