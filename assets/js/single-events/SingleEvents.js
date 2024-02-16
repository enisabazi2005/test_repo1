export default function singleEvents() {
  const descriptionBtns = document.querySelectorAll('.js-event-more');
  const activeClass = 'is-open';

  descriptionBtns.forEach(function (descriptionBtn) {
    descriptionBtn.addEventListener('click', function (e) {
      const target = e.target;
      const card = target.closest('.event-card');
      const description = card.querySelector('.event-card__description');
      if (!card.classList.contains(activeClass)) {
        card.classList.add(activeClass);
        description.style.display = 'block';
      } else {
        card.classList.remove(activeClass);
        description.style.display = 'none';
      }
    });
  });

  const transformDivs = document.querySelectorAll('div.transform');
  transformDivs.forEach(function (transformDiv) {
    transformDiv.addEventListener('click', function () {
      transformDiv.classList.toggle('transform');
    });
  });
}
