"use strict";
(self["webpackChunkbettingpro"] = self["webpackChunkbettingpro"] || []).push([["assets_js_tips_CategoryFeaures_js"],{

/***/ "./assets/js/tips/CategoryFeaures.js":
/*!*******************************************!*\
  !*** ./assets/js/tips/CategoryFeaures.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
function loadMore(e) {
  var tips = _toConsumableArray(document.querySelectorAll(".features__block"));
  var button = document.getElementById("loadMore");
  var steps = loadMore.getAttribute("data-typeId");
  tips.splice(0, steps).forEach(function (elem) {
    return elem.classList.remove("hidden");
  });
  if (tips.length == 0) {
    button.classList.add("hidden");
    button.classList.remove("load");
  }
  button.addEventListener("click", function (e) {
    e.preventDefault();
    tips.splice(0, steps).forEach(function (elem) {
      return elem.classList.remove("hidden");
    });
    if (tips.length == 0) {
      button.classList.add("hidden");
      button.classList.remove("load");
    }
  });
}
;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (loadMore);

/***/ })

}]);