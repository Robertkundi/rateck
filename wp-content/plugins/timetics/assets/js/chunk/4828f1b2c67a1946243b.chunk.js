"use strict";
/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
(self["webpackChunktimetics"] = self["webpackChunktimetics"] || []).push([["assets_src_admin_pages_customers_index_js"],{

/***/ "./assets/src/admin/pages/customers/index.js":
/*!***************************************************!*\
  !*** ./assets/src/admin/pages/customers/index.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-router-dom */ \"./node_modules/react-router/dist/index.js\");\n/* harmony import */ var _settings_hook_useSettings__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../settings/hook/useSettings */ \"./assets/src/admin/pages/settings/hook/useSettings.js\");\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ \"react\");\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);\n\n\n\nvar Skeleton = window.antd.Skeleton;\nvar __ = wp.i18n.__;\nfunction Customers() {\n  var _useSettings = (0,_settings_hook_useSettings__WEBPACK_IMPORTED_MODULE_0__[\"default\"])(),\n    getSettingsData = _useSettings.getSettingsData,\n    error = _useSettings.error,\n    loading = _useSettings.loading;\n  (0,react__WEBPACK_IMPORTED_MODULE_1__.useEffect)(function () {\n    getSettingsData();\n    return function () {};\n  }, []);\n  return /*#__PURE__*/React.createElement(React.Fragment, null, loading ? /*#__PURE__*/React.createElement(Skeleton, {\n    active: true\n  }) : /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(\"div\", {\n    className: \"tt-customer-list\"\n  }, /*#__PURE__*/React.createElement(react_router_dom__WEBPACK_IMPORTED_MODULE_2__.Outlet, null))));\n}\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Customers);\n\n//# sourceURL=webpack://timetics/./assets/src/admin/pages/customers/index.js?");

/***/ })

}]);