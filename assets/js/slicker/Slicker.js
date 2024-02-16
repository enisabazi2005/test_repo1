export default function slicker($){
    if (typeof $ == 'undefined') {
        var $ = jQuery;
    }

        // offer-bookmaker slider
        const $slideshow = $('.js-vcos-slider')
      
        jQuery.event.special.touchstart = {
          setup: function (_, ns, handle) {
            this.addEventListener('touchstart', handle, { passive: (!!ns.includes('noPreventDefault')) })
          }
        }
      
        jQuery.event.special.touchmove = {
          setup: function (_, ns, handle) {
            this.addEventListener('touchmove', handle, { passive: (!!ns.includes('noPreventDefault')) })
          }
        }
        
        if($slideshow) {

          $slideshow.slick({
            fade: true,
            infinite: true,
            dots: true,
            dotsClass: 'vcos-slider__dots',
            customPaging: function (slider, i) {
              const $slide = $(slider.$slides[i]).find('.vcos__slide')
              const dotsColor = $slide.attr('data-color')
              return `<button class="vcos-slider__dots-button" style="background-color: ${dotsColor}"></button>`
            },
            arrows: false,
            autoplay: true,
            autoplaySpeed: 4000,
            focusOnSelect: true,
            mobileFirst: true,
            responsive: [
              {
                breakpoint: 767,
                settings: {
                  customPaging (slider, i) {
                    const $slide = $(slider.$slides[i]).find('.vcos__slide')
                    const href = $slide.attr('data-link')
                    const text = $slide.attr('data-thumb')
                    const target = $slide.attr('data-target')
                    const dotsColor = $slide.attr('data-color')
                    const linkClass = $slide.attr('data-class') ? `vcos__link ${$slide.attr('data-class')}` : 'vcos__link';
                    return `<a href='${href}' class='${linkClass}' target="${target}" rel="noopener noreferrer"><span class="vcos__link-dots" style="background-color: ${dotsColor}"></span>${text}</a>`
                  }
                }
              }
            ]
          })

        }
      
        let slickTimeOut = null
        $('.vcos-slider__dots li').each(function (index) {
          const $this = $(this)
          $this.on('mouseenter', function () {
            if (slickTimeOut) {
              clearTimeout(slickTimeOut)
              slickTimeOut = null
            }
            slickTimeOut = setTimeout(function () {
              $this.click()
            }, 100)
          })
        })
      
        // hover on offer-bookmaker boxs
        $('.vcos-bookie__holder').each(function () {
          const $this = $(this)
          $this.click(function () {
            $this.toggleClass('is-active')
          })
          $(document).click(function (e) {
            if (!this.contains(e.target)) {
              $this.removeClass('is-active')
            }
          }.bind(this))
        })
        $('.latest-news__holder__other__wrapper').slick({
          dots: true,
          infinite: false,
          speed: 300,
          slidesToShow: 2,
          slidesToScroll: 1,
          prevArrow: false,
          nextArrow: false,
      
          responsive: [
            {
              breakpoint: 520,
              settings: {
                slidesToShow: 1.5,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 3000,
              settings: {
                dots: false,
              }
            }
        
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        });
      };