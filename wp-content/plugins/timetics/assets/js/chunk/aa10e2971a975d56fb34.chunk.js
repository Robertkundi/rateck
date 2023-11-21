"use strict";
/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
(self["webpackChunktimetics"] = self["webpackChunktimetics"] || []).push([["assets_src_admin_pages_staff_staffList_js"],{

/***/ "./assets/src/admin/pages/staff/HeaderAction.js":
/*!******************************************************!*\
  !*** ./assets/src/admin/pages/staff/HeaderAction.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var _common_icons_Icons__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../common/icons/Icons */ \"./assets/src/common/icons/Icons.js\");\n/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react-router-dom */ \"./node_modules/react-router/dist/index.js\");\n/* harmony import */ var _common_SelectInput__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../common/SelectInput */ \"./assets/src/common/SelectInput.js\");\n/* harmony import */ var _context_provider__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../context/provider */ \"./assets/src/admin/context/provider.js\");\n/* harmony import */ var _services_exportImportApi__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../services/exportImportApi */ \"./assets/src/admin/services/exportImportApi.js\");\n/* harmony import */ var _helper_helpers__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../helper/helpers */ \"./assets/src/helper/helpers.js\");\nfunction _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }\nfunction _nonIterableRest() { throw new TypeError(\"Invalid attempt to destructure non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); }\nfunction _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === \"string\") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === \"Object\" && o.constructor) n = o.constructor.name; if (n === \"Map\" || n === \"Set\") return Array.from(o); if (n === \"Arguments\" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }\nfunction _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }\nfunction _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== \"undefined\" && arr[Symbol.iterator] || arr[\"@@iterator\"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i[\"return\"] != null) _i[\"return\"](); } finally { if (_d) throw _e; } } return _arr; }\nfunction _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }\n\n\nvar __ = wp.i18n.__;\n\n\n\n\nvar _antd = antd,\n  Button = _antd.Button,\n  Row = _antd.Row,\n  Col = _antd.Col,\n  Form = _antd.Form,\n  Input = _antd.Input;\nfunction HeaderAction(_ref) {\n  var _settings$nicheData, _settings$nicheData$t, _settings$nicheData$t2, _timetics;\n  var searchHandler = _ref.searchHandler,\n    _ref$loading = _ref.loading,\n    loading = _ref$loading === void 0 ? false : _ref$loading;\n  var navigate = (0,react_router_dom__WEBPACK_IMPORTED_MODULE_5__.useNavigate)();\n  var _useStateValue = (0,_context_provider__WEBPACK_IMPORTED_MODULE_2__.useStateValue)(),\n    _useStateValue2 = _slicedToArray(_useStateValue, 1),\n    _useStateValue2$ = _useStateValue2[0],\n    settingsReducer = _useStateValue2$.settings,\n    staff = _useStateValue2$.staff;\n  var settings = settingsReducer.settings;\n  var staffs = staff.staffs;\n  return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(\"div\", {\n    className: \"tt-submenu-action-wrapper tt-mb-30\"\n  }, /*#__PURE__*/React.createElement(Button, {\n    onClick: function onClick() {\n      navigate(\"create-new\");\n    },\n    size: \"large\",\n    type: \"primary\",\n    disabled: loading || (0,_helper_helpers__WEBPACK_IMPORTED_MODULE_4__.getFieldLimit)({\n      uid: \"staffs-limit\"\n    }) <= (staffs === null || staffs === void 0 ? void 0 : staffs.length)\n  }, __(\"Add New \" + (settings === null || settings === void 0 ? void 0 : (_settings$nicheData = settings.nicheData) === null || _settings$nicheData === void 0 ? void 0 : (_settings$nicheData$t = _settings$nicheData.title) === null || _settings$nicheData$t === void 0 ? void 0 : (_settings$nicheData$t2 = _settings$nicheData$t.employee) === null || _settings$nicheData$t2 === void 0 ? void 0 : _settings$nicheData$t2.singular), \"timetics\")), /*#__PURE__*/React.createElement(\"div\", {\n    className: \"tt-header-action-wrapper\"\n  }, /*#__PURE__*/React.createElement(\"div\", {\n    className: \"input-search-field\"\n  }, /*#__PURE__*/React.createElement(Form.Item, null, /*#__PURE__*/React.createElement(Input, {\n    type: \"text\",\n    suffix: /*#__PURE__*/React.createElement(_common_icons_Icons__WEBPACK_IMPORTED_MODULE_0__.SearchIcon, null),\n    placeholder: __(\"Search\", \"timetics\"),\n    onChange: function onChange(e) {\n      searchHandler(e.target.value);\n    }\n  }))), ((_timetics = timetics) === null || _timetics === void 0 ? void 0 : _timetics.timeticsPro) && /*#__PURE__*/React.createElement(\"div\", {\n    className: \"tt-data-import-export\",\n    id: \"staff-export-and-import\"\n  }, wp.hooks.applyFilters(\"dataExport\", _services_exportImportApi__WEBPACK_IMPORTED_MODULE_3__.staffsExport, \"staffs\"), wp.hooks.applyFilters(\"dataImport\", _services_exportImportApi__WEBPACK_IMPORTED_MODULE_3__.staffsImport, _services_exportImportApi__WEBPACK_IMPORTED_MODULE_3__.staffsParams)))));\n}\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (HeaderAction);\n\n//# sourceURL=webpack://timetics/./assets/src/admin/pages/staff/HeaderAction.js?");

/***/ }),

/***/ "./assets/src/admin/pages/staff/TableHeader.js":
/*!*****************************************************!*\
  !*** ./assets/src/admin/pages/staff/TableHeader.js ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-router-dom */ \"./node_modules/react-router/dist/index.js\");\n/* harmony import */ var _common_icons_Icons__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../common/icons/Icons */ \"./assets/src/common/icons/Icons.js\");\nvar React = window.React;\nvar _antd = antd,\n  Button = _antd.Button,\n  Space = _antd.Space;\nvar __ = wp.i18n.__;\n\n\nfunction TableHeader(_ref) {\n  var showDeleteConfirm = _ref.showDeleteConfirm;\n  var navigate = (0,react_router_dom__WEBPACK_IMPORTED_MODULE_1__.useNavigate)();\n  /**\r\n   *Handler for edit Staff\r\n   * @param {staff} e js staff Object.\r\n   * @param {Object} staff single staff object.\r\n   */\n  var editStaff = function editStaff(record) {\n    navigate(\"update?id=\".concat(record.id));\n  };\n\n  /**\r\n   *   Staff data table column set\r\n   */\n  var columns = [{\n    title: __(\"ID\", \"timetics\"),\n    dataIndex: \"id\",\n    key: \"id\"\n  }, {\n    title: __(\"Name\", \"timetics\"),\n    dataIndex: \"full_name\",\n    key: \"full_name\"\n  }, {\n    title: __(\"Email\", \"timetics\"),\n    dataIndex: \"email\",\n    key: \"email\"\n  }, {\n    title: __(\"Phone\", \"timetics\"),\n    dataIndex: \"phone\",\n    key: \"phone\"\n  }, {\n    title: \"Action\",\n    key: \"action\",\n    render: function render(_, record) {\n      var _timetics;\n      return /*#__PURE__*/React.createElement(Space, {\n        className: \"tt-action-wrap\",\n        wrap: true\n      }, (record === null || record === void 0 ? void 0 : record.status) == 1 || ((_timetics = timetics) === null || _timetics === void 0 ? void 0 : _timetics.current_user_id) == record.id ? /*#__PURE__*/React.createElement(Button, {\n        onClick: function onClick() {\n          editStaff(record);\n        }\n      }, /*#__PURE__*/React.createElement(Space, null, /*#__PURE__*/React.createElement(_common_icons_Icons__WEBPACK_IMPORTED_MODULE_0__.EditIcon, null), __(\"Manage\", \"timetics\"))) : /*#__PURE__*/React.createElement(Button, {\n        disabled: true,\n        type: \"warning\"\n      }, __(\"Invitation pending\", \"timetics\")), /*#__PURE__*/React.createElement(Button, {\n        onClick: function onClick() {\n          showDeleteConfirm(record === null || record === void 0 ? void 0 : record.id);\n        },\n        danger: true\n      }, /*#__PURE__*/React.createElement(Space, null, /*#__PURE__*/React.createElement(_common_icons_Icons__WEBPACK_IMPORTED_MODULE_0__.DeleteIcon, null), __(\"Remove\", \"timetics\"))));\n    }\n  }];\n  return {\n    columns: columns\n  };\n}\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (TableHeader);\n\n//# sourceURL=webpack://timetics/./assets/src/admin/pages/staff/TableHeader.js?");

/***/ }),

/***/ "./assets/src/admin/pages/staff/staffList.js":
/*!***************************************************!*\
  !*** ./assets/src/admin/pages/staff/staffList.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var _services_staffs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../services/staffs */ \"./assets/src/admin/services/staffs.js\");\n/* harmony import */ var _common_icons_Icons__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../common/icons/Icons */ \"./assets/src/common/icons/Icons.js\");\n/* harmony import */ var _context_provider__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../context/provider */ \"./assets/src/admin/context/provider.js\");\n/* harmony import */ var _actionCreators_actions__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../actionCreators/actions */ \"./assets/src/admin/actionCreators/actions.js\");\n/* harmony import */ var _components_MainPageHeader__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../components/MainPageHeader */ \"./assets/src/admin/components/MainPageHeader.js\");\n/* harmony import */ var _hooks_useBulkDelete__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../hooks/useBulkDelete */ \"./assets/src/admin/hooks/useBulkDelete.js\");\n/* harmony import */ var _hooks_useDebounceSearch__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../hooks/useDebounceSearch */ \"./assets/src/admin/hooks/useDebounceSearch.js\");\n/* harmony import */ var _TableHeader__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./TableHeader */ \"./assets/src/admin/pages/staff/TableHeader.js\");\n/* harmony import */ var _HeaderAction__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./HeaderAction */ \"./assets/src/admin/pages/staff/HeaderAction.js\");\nfunction _typeof(obj) { \"@babel/helpers - typeof\"; return _typeof = \"function\" == typeof Symbol && \"symbol\" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && \"function\" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? \"symbol\" : typeof obj; }, _typeof(obj); }\nfunction ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }\nfunction _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }\nfunction _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }\nfunction _regeneratorRuntime() { \"use strict\"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, defineProperty = Object.defineProperty || function (obj, key, desc) { obj[key] = desc.value; }, $Symbol = \"function\" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || \"@@iterator\", asyncIteratorSymbol = $Symbol.asyncIterator || \"@@asyncIterator\", toStringTagSymbol = $Symbol.toStringTag || \"@@toStringTag\"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, \"\"); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return defineProperty(generator, \"_invoke\", { value: makeInvokeMethod(innerFn, self, context) }), generator; } function tryCatch(fn, obj, arg) { try { return { type: \"normal\", arg: fn.call(obj, arg) }; } catch (err) { return { type: \"throw\", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { [\"next\", \"throw\", \"return\"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if (\"throw\" !== record.type) { var result = record.arg, value = result.value; return value && \"object\" == _typeof(value) && hasOwn.call(value, \"__await\") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke(\"next\", value, resolve, reject); }, function (err) { invoke(\"throw\", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke(\"throw\", error, resolve, reject); }); } reject(record.arg); } var previousPromise; defineProperty(this, \"_invoke\", { value: function value(method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(innerFn, self, context) { var state = \"suspendedStart\"; return function (method, arg) { if (\"executing\" === state) throw new Error(\"Generator is already running\"); if (\"completed\" === state) { if (\"throw\" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if (\"next\" === context.method) context.sent = context._sent = context.arg;else if (\"throw\" === context.method) { if (\"suspendedStart\" === state) throw state = \"completed\", context.arg; context.dispatchException(context.arg); } else \"return\" === context.method && context.abrupt(\"return\", context.arg); state = \"executing\"; var record = tryCatch(innerFn, self, context); if (\"normal\" === record.type) { if (state = context.done ? \"completed\" : \"suspendedYield\", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } \"throw\" === record.type && (state = \"completed\", context.method = \"throw\", context.arg = record.arg); } }; } function maybeInvokeDelegate(delegate, context) { var method = delegate.iterator[context.method]; if (undefined === method) { if (context.delegate = null, \"throw\" === context.method) { if (delegate.iterator[\"return\"] && (context.method = \"return\", context.arg = undefined, maybeInvokeDelegate(delegate, context), \"throw\" === context.method)) return ContinueSentinel; context.method = \"throw\", context.arg = new TypeError(\"The iterator does not provide a 'throw' method\"); } return ContinueSentinel; } var record = tryCatch(method, delegate.iterator, context.arg); if (\"throw\" === record.type) return context.method = \"throw\", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, \"return\" !== context.method && (context.method = \"next\", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = \"throw\", context.arg = new TypeError(\"iterator result is not an object\"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = \"normal\", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: \"root\" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if (\"function\" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) { if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; } return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, defineProperty(Gp, \"constructor\", { value: GeneratorFunctionPrototype, configurable: !0 }), defineProperty(GeneratorFunctionPrototype, \"constructor\", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, \"GeneratorFunction\"), exports.isGeneratorFunction = function (genFun) { var ctor = \"function\" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || \"GeneratorFunction\" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, \"GeneratorFunction\")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, \"Generator\"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, \"toString\", function () { return \"[object Generator]\"; }), exports.keys = function (val) { var object = Object(val), keys = []; for (var key in object) { keys.push(key); } return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = \"next\", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) { \"t\" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); } }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if (\"throw\" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = \"throw\", record.arg = exception, context.next = loc, caught && (context.method = \"next\", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if (\"root\" === entry.tryLoc) return handle(\"end\"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, \"catchLoc\"), hasFinally = hasOwn.call(entry, \"finallyLoc\"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error(\"try statement without catch or finally\"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, \"finallyLoc\") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && (\"break\" === type || \"continue\" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = \"next\", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if (\"throw\" === record.type) throw record.arg; return \"break\" === record.type || \"continue\" === record.type ? this.next = record.arg : \"return\" === record.type ? (this.rval = this.arg = record.arg, this.method = \"return\", this.next = \"end\") : \"normal\" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, \"catch\": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if (\"throw\" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error(\"illegal catch attempt\"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, \"next\" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }\nfunction asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }\nfunction _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, \"next\", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, \"throw\", err); } _next(undefined); }); }; }\nfunction _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }\nfunction _nonIterableRest() { throw new TypeError(\"Invalid attempt to destructure non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); }\nfunction _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === \"string\") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === \"Object\" && o.constructor) n = o.constructor.name; if (n === \"Map\" || n === \"Set\") return Array.from(o); if (n === \"Arguments\" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }\nfunction _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }\nfunction _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== \"undefined\" && arr[Symbol.iterator] || arr[\"@@iterator\"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i[\"return\"] != null) _i[\"return\"](); } finally { if (_d) throw _e; } } return _arr; }\nfunction _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }\n\n\n\n\n\n\n\n\n\n\nvar _React = React,\n  useState = _React.useState,\n  useEffect = _React.useEffect;\nvar _antd = antd,\n  Table = _antd.Table,\n  Button = _antd.Button,\n  Modal = _antd.Modal,\n  Skeleton = _antd.Skeleton,\n  Empty = _antd.Empty,\n  Space = _antd.Space;\nvar confirm = Modal.confirm;\nvar __ = wp.i18n.__;\nfunction StaffList() {\n  var _settings$nicheData, _settings$nicheData$t, _settings$nicheData$t2;\n  var _useStateValue = (0,_context_provider__WEBPACK_IMPORTED_MODULE_2__.useStateValue)(),\n    _useStateValue2 = _slicedToArray(_useStateValue, 2),\n    _useStateValue2$ = _useStateValue2[0],\n    staff = _useStateValue2$.staff,\n    settingsReducer = _useStateValue2$.settings,\n    dispatch = _useStateValue2[1];\n  var _useState = useState(true),\n    _useState2 = _slicedToArray(_useState, 2),\n    loading = _useState2[0],\n    setLoading = _useState2[1];\n  var staffData = staff.staffs;\n  var settings = settingsReducer.settings;\n  var _useState3 = useState(1),\n    _useState4 = _slicedToArray(_useState3, 2),\n    pageNumber = _useState4[0],\n    setPageNumber = _useState4[1];\n  var _useState5 = useState(20),\n    _useState6 = _slicedToArray(_useState5, 2),\n    perPage = _useState6[0],\n    setPerPage = _useState6[1];\n  var _useState7 = useState(),\n    _useState8 = _slicedToArray(_useState7, 2),\n    count = _useState8[0],\n    setCount = _useState8[1];\n\n  /**\r\n   * get all staff\r\n   */\n  var fetchAllStaffs = /*#__PURE__*/function () {\n    var _ref = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {\n      var _res$data, _res$data$data, _res$data2, _res$data2$data;\n      var res;\n      return _regeneratorRuntime().wrap(function _callee$(_context) {\n        while (1) {\n          switch (_context.prev = _context.next) {\n            case 0:\n              _context.next = 2;\n              return (0,_services_staffs__WEBPACK_IMPORTED_MODULE_0__.getAllStaff)({\n                method: \"GET\",\n                params: {\n                  per_page: perPage,\n                  paged: pageNumber\n                }\n              });\n            case 2:\n              res = _context.sent;\n              setLoading(false);\n              dispatch({\n                type: _actionCreators_actions__WEBPACK_IMPORTED_MODULE_3__.actions.SET_STAFFS,\n                payload: res === null || res === void 0 ? void 0 : (_res$data = res.data) === null || _res$data === void 0 ? void 0 : (_res$data$data = _res$data.data) === null || _res$data$data === void 0 ? void 0 : _res$data$data.items\n              });\n              setCount(res === null || res === void 0 ? void 0 : (_res$data2 = res.data) === null || _res$data2 === void 0 ? void 0 : (_res$data2$data = _res$data2.data) === null || _res$data2$data === void 0 ? void 0 : _res$data2$data.total);\n            case 6:\n            case \"end\":\n              return _context.stop();\n          }\n        }\n      }, _callee);\n    }));\n    return function fetchAllStaffs() {\n      return _ref.apply(this, arguments);\n    };\n  }();\n\n  // bulk delete custom hooks call\n  var _useBulkDelete = (0,_hooks_useBulkDelete__WEBPACK_IMPORTED_MODULE_5__[\"default\"])({\n      setLoading: setLoading,\n      deleteAPi: _services_staffs__WEBPACK_IMPORTED_MODULE_0__.bulkDeleteStaffs,\n      data: staffData,\n      fetchAllData: fetchAllStaffs,\n      action_type: _actionCreators_actions__WEBPACK_IMPORTED_MODULE_3__.actions.SET_STAFFS\n    }),\n    rowSelection = _useBulkDelete.rowSelection,\n    selectedRowKeys = _useBulkDelete.selectedRowKeys,\n    bulkDelete = _useBulkDelete.bulkDelete;\n  var hasSelected = selectedRowKeys.length > 0;\n\n  // search debounce custom hooks call\n  var _useDebounceSearch = (0,_hooks_useDebounceSearch__WEBPACK_IMPORTED_MODULE_6__[\"default\"])({\n      SearchApi: _services_staffs__WEBPACK_IMPORTED_MODULE_0__.staffSearch,\n      setLoading: setLoading,\n      perPage: perPage,\n      pageNumber: pageNumber,\n      action_type: _actionCreators_actions__WEBPACK_IMPORTED_MODULE_3__.actions.SET_STAFFS,\n      setCount: setCount\n    }),\n    searchHandler = _useDebounceSearch.searchHandler;\n\n  /**\r\n   *  api call for get all staff\r\n   */\n  useEffect(function () {\n    fetchAllStaffs();\n  }, [pageNumber, perPage]);\n\n  /**\r\n   * single staff delete\r\n   * @param {*} id staff id\r\n   */\n  var deleteSingleStaff = /*#__PURE__*/function () {\n    var _ref2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2(id) {\n      var _res$data3;\n      var res;\n      return _regeneratorRuntime().wrap(function _callee2$(_context2) {\n        while (1) {\n          switch (_context2.prev = _context2.next) {\n            case 0:\n              _context2.next = 2;\n              return (0,_services_staffs__WEBPACK_IMPORTED_MODULE_0__.deleteStaff)({\n                method: \"DELETE\"\n              }, id);\n            case 2:\n              res = _context2.sent;\n              if ((res === null || res === void 0 ? void 0 : (_res$data3 = res.data) === null || _res$data3 === void 0 ? void 0 : _res$data3.status_code) == 200) {\n                dispatch({\n                  type: _actionCreators_actions__WEBPACK_IMPORTED_MODULE_3__.actions.SET_STAFFS,\n                  payload: staffData.filter(function (item) {\n                    return item.id != id;\n                  })\n                });\n              }\n            case 4:\n            case \"end\":\n              return _context2.stop();\n          }\n        }\n      }, _callee2);\n    }));\n    return function deleteSingleStaff(_x) {\n      return _ref2.apply(this, arguments);\n    };\n  }();\n\n  /**\r\n   * @param id\r\n   * Modal open when click delete button\r\n   */\n  var showDeleteConfirm = function showDeleteConfirm(id) {\n    confirm({\n      title: __(\"Are you sure delete this staff?\", \"timetics\"),\n      okText: __(\"Yes\", \"timetics\"),\n      okType: \"danger\",\n      cancelText: __(\"No\", \"timetics\"),\n      onOk: function onOk() {\n        deleteSingleStaff(id);\n      }\n    });\n  };\n  var _TableHeader = (0,_TableHeader__WEBPACK_IMPORTED_MODULE_7__[\"default\"])({\n      showDeleteConfirm: showDeleteConfirm\n    }),\n    columns = _TableHeader.columns;\n  return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(_components_MainPageHeader__WEBPACK_IMPORTED_MODULE_4__[\"default\"], {\n    title: __(settings === null || settings === void 0 ? void 0 : (_settings$nicheData = settings.nicheData) === null || _settings$nicheData === void 0 ? void 0 : (_settings$nicheData$t = _settings$nicheData.title) === null || _settings$nicheData$t === void 0 ? void 0 : (_settings$nicheData$t2 = _settings$nicheData$t.employee) === null || _settings$nicheData$t2 === void 0 ? void 0 : _settings$nicheData$t2.plural, \"timetics\")\n  }), /*#__PURE__*/React.createElement(_HeaderAction__WEBPACK_IMPORTED_MODULE_8__[\"default\"], {\n    searchHandler: searchHandler,\n    loading: loading\n  }), hasSelected && /*#__PURE__*/React.createElement(Space, {\n    className: \"tt-bulk-delete tt-mb-20\"\n  }, /*#__PURE__*/React.createElement(Button, {\n    danger: true,\n    onClick: function onClick(e) {\n      confirm({\n        title: __(\"Are you sure delete selected staffs?\", \"timetics\"),\n        okText: __(\"Yes\", \"timetics\"),\n        okType: \"danger\",\n        cancelText: __(\"No\", \"timetics\"),\n        onOk: function onOk() {\n          bulkDelete();\n        }\n      });\n    },\n    loading: loading\n  }, __(\"Bulk Delete\", \"timetics\")), /*#__PURE__*/React.createElement(\"span\", null, selectedRowKeys.length, \" \", __(\"items selected\", \"timetics\"))), /*#__PURE__*/React.createElement(Table, {\n    rowSelection: _objectSpread({\n      columnWidth: 40\n    }, rowSelection),\n    rowClassName: function rowClassName(record) {\n      return record.status == 0 && \"disabled-row\";\n    },\n    columns: columns,\n    dataSource: staffData,\n    rowKey: function rowKey(record) {\n      return record.id;\n    },\n    loading: loading,\n    locale: {\n      emptyText: loading ? /*#__PURE__*/React.createElement(Skeleton, {\n        active: true\n      }) : /*#__PURE__*/React.createElement(Empty, null)\n    },\n    sticky: true,\n    scroll: {\n      x: 1024,\n      y: \"calc(100vh - 250px)\"\n    }\n    // tableLayout=\"auto\"\n    ,\n    pagination: {\n      total: count,\n      defaultPageSize: perPage,\n      showSizeChanger: true,\n      pageSizeOptions: [\"10\", \"20\", \"50\", \"100\"],\n      className: [\"tt-ant-pagination\"],\n      onChange: function onChange(page_no, perPage) {\n        setPageNumber(page_no);\n        setPerPage(perPage);\n        setLoading(true);\n      }\n    }\n  }));\n}\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (StaffList);\n\n//# sourceURL=webpack://timetics/./assets/src/admin/pages/staff/staffList.js?");

/***/ })

}]);