import { contains } from "jquery";

export default function Navbar() {
    const language_openers = document.querySelectorAll(".language-opener");
    const language_menu = document.querySelector(".language-menu");
    const all_states = document.querySelectorAll('.all-states');
    const winWidth = window.outerWidth;
    let flag;
    const back = document.querySelectorAll(".menu-back-list");
    const searchBar = document.querySelector(".searchBar");

    if (winWidth < 1023) {
        initMobileNav();
    }

   

    document?.addEventListener("click", (e) => {
        if (e.target?.closest(".language-switcher") === null) {
            language_menu?.classList.remove("active");
            all_states.classList.remove("active");
        }
        e.stopPropagation();
    });

    language_openers.forEach(language_opener => {
        language_opener.addEventListener("click", () => {
            const language_menu = language_opener.nextElementSibling;
            language_menu?.classList.toggle("active");
            searchBar.style.display = "none";
        });
    });


    const navToggle = document.querySelector(".js_nav-toggle");
    const overlayOnNavOpen = document.querySelector(".overlay");
    const headerNavList = document.querySelector(".header_nav-list");
    const showCategory = document.querySelector(".show-category");
    const navMenu = document.querySelector(".nav-menu");
    navToggle?.addEventListener("click", (element) => {
        overlayOnNavOpen?.classList.toggle("activated-nav");
        element.currentTarget.classList.toggle("active");
        searchBar.style.display = "none";
        if (headerNavList.style.display === "" || headerNavList.style.display === "none") {
            headerNavList.style.display = "block";
        } else {
            headerNavList.style.display = "none";
        }
        headerNavList.classList.toggle("menu-active");
        showCategory?.classList.remove("active");
        navMenu.classList.remove("nav-active");
    });

    let mobileNavIsActive = false;

    function initMobileNav() {
        mobileNavIsActive = true;
        const itemWithChildren = document.querySelectorAll(".js-menu li.menu-item-has-children");
        if (itemWithChildren.length) {
            itemWithChildren.forEach(function (item, index) {
                const openererLink = item.querySelector("a");
                openererLink.classList.add("js-category-opener");
                // openererLink.setAttribute("href", "javascript:;");

                var newDivWrapper = document.createElement("div");
                newDivWrapper.className = "click-sub-items";

                openererLink.insertAdjacentElement('afterend', newDivWrapper);

                newDivWrapper.addEventListener("click", (element) => {
                    if (winWidth < 1023) {
                        element.target.closest(".js-menu").classList.add("move-out");
                        if (element.target.closest("li").classList.contains("move-in")) {
                            element.target.closest("li").classList.remove("move-in");
                        }
                        if (element.target.closest("li").classList.contains("move-in")) {
                            element.target.closest("li").classList.remove("move-in");
                            if (element.target.parentNode.children.item(1).classList.contains("menu-1")) element.target.parentNode.children.item(1).style.display = "none";
                        } else {
                            element.target.closest("li").classList.add("move-in");
                            if (element.target.parentNode.children.item(1).classList.contains("menu-1")) element.target.parentNode.children.item(1).style.display = "flex";
                        }
                    }
                });

                // if (openererLink.getAttribute('data-default-href').length) {
                //     const cloneHref = openererLink.getAttribute('data-default-href');
                //     const clone = openererLink.cloneNode(true);
                //     clone.setAttribute('href', cloneHref);
                //     const subMenu = openererLink.nextElementSibling;
                //     const dublItem = document.createElement('li');
                //     dublItem.classList.add('dublItem');
                //     subMenu.insertBefore(dublItem, subMenu.children[1]);
                //     // dublItem.appendChild(clone);
                // }
                // if (openererLink2.filter('[data-default-href]').length) {
                //     const cloneHref = openererLink.data('default-href')
                //     const clone = openererLink.clone().attr('href', cloneHref)
                //     const subMenu = openererLink.next('.sub-menu')
                //     subMenu.find('li:first-child').after('<li class="dublItem"></li>')
                //     subMenu.find('.dublItem').append(clone)
                // }
            });
        }
        back.forEach((e) => {
            e.addEventListener("click", function () {
                backFoo();
            });
        });
    }

    function backFoo() {
        const jsMenuLists = document.querySelectorAll(".js-menu li");
        const jsMenu = document.querySelectorAll(".js-menu");

        jsMenuLists.forEach((e) => {
            e.classList.remove("move-in");
        });
        jsMenu.forEach((e) => {
            e.classList.remove("move-out");
        });

        flag = 0;
    }
    window.addEventListener("resize", function () {
        const linkList = document.querySelectorAll(".js-menu li.menu-item-has-children > a");

        if (winWidth < 1023) {
            linkList.forEach(function (link) {
                link.setAttribute("href", "javascript:;");
            });
        } else {
            linkList.forEach(function (link) {
                const dataHref = link.getAttribute("data-default-href");
                link.setAttribute("href", dataHref);
            });
        }
    });
    const searchIcon = document.querySelector(".searchIcon");

    searchBar.style.display = "none";
    searchIcon.addEventListener("click", function () {
        if (
          searchBar.style.display === "none" ||
          searchBar.style.display === ""
        ) {
          searchBar.style.display = "block";
        } else {
          searchBar.style.display = "none";
        }
    });

    const scrollTop = document.getElementById("scrollTop");
    const winHeight = window.outerHeight;

    scrollTop.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });

    const scrollbarCustom = document.querySelector(".scrollbar_custom");
    const htmlElement = document.documentElement;
    const headerWrap = document.querySelector(".header__wrap");
    const body = document.querySelector("body");
    const searchWrapperForm = document.querySelector('.searchWrapper form');
    const menuLangSwitcher = document.querySelectorAll('.language-menu');
    const allStates = document.querySelectorAll('.all-states');
    let lastScrollTop = 0;

    if (window.scrollY > 100) {
      scrollbarCustom.classList.add("hide");
    }

    window.addEventListener("resize", function () {
        // headerWrap.classList.remove("header_close");
        // scrollbarCustom.classList.add("hide");
    });
  
    window.addEventListener("scroll", () => {
      if (
        window.innerWidth < 1023 &&
        scrollbarCustom.classList.contains("scrollbar_active")
      ) {
        const maxScroll = htmlElement.scrollHeight - htmlElement.clientHeight;
        const currentScroll = htmlElement.scrollTop;
        const scrollPercentage = (currentScroll / maxScroll) * 100;
        const scrollTopOnly =
          window.scrollY || document.documentElement.scrollTop;

        scrollbarCustom.style.width = scrollPercentage + "%";

        if (currentScroll > 100) {
          if (
            !headerWrap.classList.contains("header_close") &&
            scrollbarCustom.classList.contains("hide")
          ) {
            headerWrap.classList.add("header_close");
            scrollbarCustom.classList.remove("hide");
          }
        } else {
          headerWrap.classList.remove("header_close");
          scrollbarCustom.classList.add("hide");
        }

        if (scrollTopOnly < lastScrollTop) {
          headerWrap.classList.remove("header_close");
          if (scrollbarCustom.classList.contains("hide") === false) {
            scrollbarCustom.classList.add("hide");
          }
        }

        if (
          body.classList.contains("activated-nav") || 
          searchWrapperForm.style.display == "block" ||
          menuLangSwitcher.classList.contains("active") || 
          allStates.classList.contains("active") 
        ) {
          scrollbarCustom.classList.add("hide");
          headerWrap.classList.remove("header_close");
        }

        scrollbarCustom.style.width = scrollPercentage + "%";
        lastScrollTop = scrollTopOnly;
      }

      let scrollY = window.scrollY;

      if (scrollY > winHeight) {
        scrollTop.style.display = "block";
      } else {
        scrollTop.style.display = "none";
      }
    });
}