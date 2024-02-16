export default function stickyVideo() {
    const stickyClass = document.querySelector(".videoContainer");
    const videoRect = stickyClass?.getBoundingClientRect();

    const offsetTop = videoRect?.top + window?.pageYOffset
    const offsetBottom = offsetTop + videoRect?.height;

    function handleScroll() {
        const viewportTop = window.pageYOffset;
        const viewportBottom = viewportTop + window.innerHeight;

        if (offsetBottom < viewportTop) {
            stickyClass.classList.add("allowSticky");
        }
        if (offsetBottom > viewportTop && offsetTop < viewportBottom) {
            stickyClass.classList.remove("allowSticky");
        } 
    }
    if(stickyClass){
        document.addEventListener("scroll", handleScroll);
    }
    
}