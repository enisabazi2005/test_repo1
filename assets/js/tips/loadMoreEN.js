export default function loadMoreEN() {
    let currentPage = 2;
    const load_button = document.getElementById("en_tips");
  
    if (load_button === null) {
      return;
    }
  
    const step = load_button.getAttribute("data-typeId");
    const terms = load_button.getAttribute("data-sec_number");
    const features = document.querySelector(".features_en");
  
    load_button.addEventListener("click", function () {
      currentPage++;
  
      const xhr = new XMLHttpRequest();
      xhr.open("POST", ajax_var.url, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
          const res = JSON.parse(xhr.responseText);
          if (currentPage == res.max) {
            load_button.style.display = "none";
          }
          features.insertAdjacentHTML("beforeend", res.html);
        }
      };
      xhr.onerror = function () {
        console.log("Request failed");
      };
      xhr.send(`action=load_more_en_tips&paged=${currentPage}&step=${step}&terms=${terms}`);
    });
  }