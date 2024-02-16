export default function authorBox() {
    const authorName = document.querySelector(".single-tips__author-box__wrapper__users__author-name");
    const reviewerName = document.querySelector(".reviewer-name");
    const box = document.querySelector(".publisher_desc");
    const box2 = document.querySelector(".reviewer-desc");

    authorName?.addEventListener('click', function() {
        box.classList.toggle('show');
        box2.classList.remove('show');
    });

    reviewerName?.addEventListener('click', function() {
        box.classList.remove('show');
        box2.classList.toggle('show');
    });
}
