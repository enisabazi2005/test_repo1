export default function takeoverBlockScripts() {
    if (screen.width > 1439) {
        let rightBanner = document.querySelector(".right-banner");
        let leftBanner = document.querySelector(".left-banner");
        let desktopBanner = document.querySelector(".takeover");
        let container = document.querySelector(".container");

        leftBanner.style.display = "inline";
        rightBanner.style.display = "inline";
        leftBanner.style.left = container.offsetLeft - leftBanner.offsetWidth - 10 + "px";
        rightBanner.style.left = container.offsetLeft + container.offsetWidth + 10 + "px";
        
        window.addEventListener("resize", () => {
            leftBanner.style.left = container.offsetLeft - leftBanner.offsetWidth - 5 + "px";
            rightBanner.style.left = container.offsetLeft + container.offsetWidth + "px";
        });

        window.addEventListener("scroll", () => {
            let footer = document.querySelector(".footer");
            let main = document.querySelector("main");
            let body = document.querySelector("body");
            let scrollY = window.scrollY;

            if (scrollY > body.offsetHeight - footer.offsetHeight - leftBanner.offsetHeight - 80) {
                leftBanner.style.position = "absolute";
                rightBanner.style.position = "absolute";
                leftBanner.style.top = "auto";
                leftBanner.style.bottom = "70px";
                rightBanner.style.top = "auto";
                rightBanner.style.bottom = "70px";
            } else if (scrollY > (main.offsetTop + desktopBanner.offsetHeight + 60 )) {
                leftBanner.style.position = "fixed";
                rightBanner.style.position = "fixed";
                leftBanner.style.top = "10px";
                rightBanner.style.top = "10px";
            } else {
                leftBanner.style.position = "absolute";
                rightBanner.style.position = "absolute";
                leftBanner.style.bottom = "unset";
                leftBanner.style.top = "unset";
                rightBanner.style.bottom = "unset";
                rightBanner.style.top = "unset";
            }
        })
    }
}
