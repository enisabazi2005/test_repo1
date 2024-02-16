document.addEventListener("DOMContentLoaded", function () {
    function handleInlineEditorAdded(mutationsList, observer) {
        for (const mutation of mutationsList) {
            if (mutation.type === "childList") {
                const addedNodes = mutation.addedNodes;
                for (const node of addedNodes) {
                    if (node.nodeType === 1 && node.classList.contains("inline-editor")) {
                        var parentCheckboxes = document.querySelectorAll('.geo_location-checklist > li:has(ul.children) > label > input[type="checkbox"]');

                        parentCheckboxes.forEach(function (checkbox) {
                            var childCheckboxes = checkbox.closest("li").querySelectorAll('ul.children li label input[type="checkbox"]');
                            childCheckboxes.forEach(function (childCheckbox) {
                                childCheckbox.addEventListener("click", function () {
                                    var parentCheckbox = this.closest("ul.children").parentNode.querySelector('label input[type="checkbox"]');

                                    var uncheckedChild = Array.from(childCheckboxes).find((child) => !child.checked);
                                    parentCheckbox.checked = !uncheckedChild;
                                });
                            });
                            checkbox.addEventListener("click", function () {
                                var parentLi = this.closest("li");

                                var childCheckboxes = parentLi.querySelectorAll('ul.children li label input[type="checkbox"]');

                                childCheckboxes.forEach(function (childCheckbox) {
                                    childCheckbox.checked = checkbox.checked;
                                });
                            });
                        });
                    }
                }
            }
        }
    }

    const observer = new MutationObserver(handleInlineEditorAdded);

    const targetNode = document.body; // You can specify a more specific target if needed
    const config = { childList: true, subtree: true };

    observer.observe(targetNode, config);
});
