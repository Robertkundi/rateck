"use strict";
/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
(self["webpackChunktimetics"] = self["webpackChunktimetics"] || []).push([["assets_src_admin_pages_staff_Create_js"],{

/***/ "./assets/src/admin/pages/staff/Create.js":
/*!************************************************!*\
  !*** ./assets/src/admin/pages/staff/Create.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! react-router-dom */ \"./node_modules/react-router/dist/index.js\");\n/* harmony import */ var _libs_staffLib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../libs/staffLib */ \"./assets/src/admin/libs/staffLib.js\");\n/* harmony import */ var _FormField__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./FormField */ \"./assets/src/admin/pages/staff/FormField.js\");\n/* harmony import */ var _components_MainPageHeader__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../components/MainPageHeader */ \"./assets/src/admin/components/MainPageHeader.js\");\n/* harmony import */ var _actionCreators_common__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../actionCreators/common */ \"./assets/src/admin/actionCreators/common.js\");\n/* harmony import */ var _utils_dummyData__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../utils/dummyData */ \"./assets/src/admin/utils/dummyData.js\");\n/* harmony import */ var _context_provider__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../context/provider */ \"./assets/src/admin/context/provider.js\");\n/* harmony import */ var _actionCreators_actions__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../actionCreators/actions */ \"./assets/src/admin/actionCreators/actions.js\");\n/* harmony import */ var _settings_hook_useSettings__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../settings/hook/useSettings */ \"./assets/src/admin/pages/settings/hook/useSettings.js\");\nfunction _typeof(obj) { \"@babel/helpers - typeof\"; return _typeof = \"function\" == typeof Symbol && \"symbol\" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && \"function\" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? \"symbol\" : typeof obj; }, _typeof(obj); }\nfunction _regeneratorRuntime() { \"use strict\"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, defineProperty = Object.defineProperty || function (obj, key, desc) { obj[key] = desc.value; }, $Symbol = \"function\" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || \"@@iterator\", asyncIteratorSymbol = $Symbol.asyncIterator || \"@@asyncIterator\", toStringTagSymbol = $Symbol.toStringTag || \"@@toStringTag\"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, \"\"); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return defineProperty(generator, \"_invoke\", { value: makeInvokeMethod(innerFn, self, context) }), generator; } function tryCatch(fn, obj, arg) { try { return { type: \"normal\", arg: fn.call(obj, arg) }; } catch (err) { return { type: \"throw\", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { [\"next\", \"throw\", \"return\"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if (\"throw\" !== record.type) { var result = record.arg, value = result.value; return value && \"object\" == _typeof(value) && hasOwn.call(value, \"__await\") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke(\"next\", value, resolve, reject); }, function (err) { invoke(\"throw\", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke(\"throw\", error, resolve, reject); }); } reject(record.arg); } var previousPromise; defineProperty(this, \"_invoke\", { value: function value(method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(innerFn, self, context) { var state = \"suspendedStart\"; return function (method, arg) { if (\"executing\" === state) throw new Error(\"Generator is already running\"); if (\"completed\" === state) { if (\"throw\" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if (\"next\" === context.method) context.sent = context._sent = context.arg;else if (\"throw\" === context.method) { if (\"suspendedStart\" === state) throw state = \"completed\", context.arg; context.dispatchException(context.arg); } else \"return\" === context.method && context.abrupt(\"return\", context.arg); state = \"executing\"; var record = tryCatch(innerFn, self, context); if (\"normal\" === record.type) { if (state = context.done ? \"completed\" : \"suspendedYield\", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } \"throw\" === record.type && (state = \"completed\", context.method = \"throw\", context.arg = record.arg); } }; } function maybeInvokeDelegate(delegate, context) { var method = delegate.iterator[context.method]; if (undefined === method) { if (context.delegate = null, \"throw\" === context.method) { if (delegate.iterator[\"return\"] && (context.method = \"return\", context.arg = undefined, maybeInvokeDelegate(delegate, context), \"throw\" === context.method)) return ContinueSentinel; context.method = \"throw\", context.arg = new TypeError(\"The iterator does not provide a 'throw' method\"); } return ContinueSentinel; } var record = tryCatch(method, delegate.iterator, context.arg); if (\"throw\" === record.type) return context.method = \"throw\", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, \"return\" !== context.method && (context.method = \"next\", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = \"throw\", context.arg = new TypeError(\"iterator result is not an object\"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = \"normal\", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: \"root\" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if (\"function\" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) { if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; } return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, defineProperty(Gp, \"constructor\", { value: GeneratorFunctionPrototype, configurable: !0 }), defineProperty(GeneratorFunctionPrototype, \"constructor\", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, \"GeneratorFunction\"), exports.isGeneratorFunction = function (genFun) { var ctor = \"function\" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || \"GeneratorFunction\" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, \"GeneratorFunction\")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, \"Generator\"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, \"toString\", function () { return \"[object Generator]\"; }), exports.keys = function (val) { var object = Object(val), keys = []; for (var key in object) { keys.push(key); } return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = \"next\", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) { \"t\" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); } }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if (\"throw\" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = \"throw\", record.arg = exception, context.next = loc, caught && (context.method = \"next\", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if (\"root\" === entry.tryLoc) return handle(\"end\"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, \"catchLoc\"), hasFinally = hasOwn.call(entry, \"finallyLoc\"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error(\"try statement without catch or finally\"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, \"finallyLoc\") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && (\"break\" === type || \"continue\" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = \"next\", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if (\"throw\" === record.type) throw record.arg; return \"break\" === record.type || \"continue\" === record.type ? this.next = record.arg : \"return\" === record.type ? (this.rval = this.arg = record.arg, this.method = \"return\", this.next = \"end\") : \"normal\" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, \"catch\": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if (\"throw\" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error(\"illegal catch attempt\"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, \"next\" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }\nfunction ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }\nfunction _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }\nfunction _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }\nfunction asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }\nfunction _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, \"next\", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, \"throw\", err); } _next(undefined); }); }; }\nfunction _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }\nfunction _nonIterableRest() { throw new TypeError(\"Invalid attempt to destructure non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); }\nfunction _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === \"string\") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === \"Object\" && o.constructor) n = o.constructor.name; if (n === \"Map\" || n === \"Set\") return Array.from(o); if (n === \"Arguments\" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }\nfunction _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }\nfunction _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== \"undefined\" && arr[Symbol.iterator] || arr[\"@@iterator\"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i[\"return\"] != null) _i[\"return\"](); } finally { if (_d) throw _e; } } return _arr; }\nfunction _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }\n\n\n\n\n\n\n\n\n\nvar _window$antd = window.antd,\n  Button = _window$antd.Button,\n  Form = _window$antd.Form,\n  message = _window$antd.message;\nvar __ = wp.i18n.__;\nvar _window$React = window.React,\n  useState = _window$React.useState,\n  useEffect = _window$React.useEffect;\nfunction CreateStaff() {\n  var _settings$nicheData, _settings$nicheData$t, _settings$nicheData$t2, _settings$nicheData2, _settings$nicheData2$, _settings$nicheData2$2, _settings$nicheData3, _settings$nicheData3$, _settings$nicheData3$2;\n  var _useStateValue = (0,_context_provider__WEBPACK_IMPORTED_MODULE_5__.useStateValue)(),\n    _useStateValue2 = _slicedToArray(_useStateValue, 2),\n    _useStateValue2$ = _useStateValue2[0],\n    meetingReducer = _useStateValue2$.meeting,\n    staff = _useStateValue2$.staff,\n    settingsReducer = _useStateValue2$.settings,\n    dispatch = _useStateValue2[1];\n  var _useSettings = (0,_settings_hook_useSettings__WEBPACK_IMPORTED_MODULE_7__[\"default\"])(),\n    getSettingsData = _useSettings.getSettingsData;\n  var _useState = useState(false),\n    _useState2 = _slicedToArray(_useState, 2),\n    loading = _useState2[0],\n    setLoading = _useState2[1];\n  var _Form$useForm = Form.useForm(),\n    _Form$useForm2 = _slicedToArray(_Form$useForm, 1),\n    form = _Form$useForm2[0];\n  var navigate = (0,react_router_dom__WEBPACK_IMPORTED_MODULE_8__.useNavigate)();\n  var schedules = meetingReducer.schedules,\n    timeCompareError = meetingReducer.timeCompareError,\n    editAvailability = meetingReducer.editAvailability;\n  var settings = settingsReducer.settings;\n  var staffs = staff.staffs;\n  useEffect(function () {\n    var loadData = /*#__PURE__*/function () {\n      var _ref = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {\n        var _yield$getSettingsDat, _schedules;\n        return _regeneratorRuntime().wrap(function _callee$(_context) {\n          while (1) {\n            switch (_context.prev = _context.next) {\n              case 0:\n                _context.next = 2;\n                return getSettingsData();\n              case 2:\n                _yield$getSettingsDat = _context.sent;\n                _schedules = _yield$getSettingsDat.availability;\n                // let _schedules = {};\n                // const startTime = \"09:00 AM\";\n                // const meetingDuration = 60; // meetingDuratoin here is in minuts\n\n                // _schedules[\"staff\"] = dummySchedules({\n                //     startTime,\n                //     duration: meetingDuration,\n                // });\n\n                // dispatch({\n                //     type: actions.SET_STAFF_SCHEDULE,\n                //     payload: data?.data?.schedule,\n                // });\n\n                (0,_actionCreators_common__WEBPACK_IMPORTED_MODULE_3__.setState)({\n                  dispatch: dispatch,\n                  name: \"schedules\",\n                  value: _objectSpread({}, _schedules)\n                });\n              case 5:\n              case \"end\":\n                return _context.stop();\n            }\n          }\n        }, _callee);\n      }));\n      return function loadData() {\n        return _ref.apply(this, arguments);\n      };\n    }();\n    loadData();\n    return function () {};\n  }, []);\n  useEffect(function () {\n    return function () {\n      (0,_actionCreators_common__WEBPACK_IMPORTED_MODULE_3__.setState)({\n        dispatch: dispatch,\n        name: \"editAvailability\",\n        value: false\n      });\n    };\n  }, []);\n\n  /**\n   * On finish method that can handle staff create\n   * @param {Object} values\n   */\n  var onFinish = /*#__PURE__*/function () {\n    var _ref2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2(values) {\n      var staffData, res;\n      return _regeneratorRuntime().wrap(function _callee2$(_context2) {\n        while (1) {\n          switch (_context2.prev = _context2.next) {\n            case 0:\n              if (!(timeCompareError !== null && timeCompareError !== void 0 && timeCompareError.hasError)) {\n                _context2.next = 2;\n                break;\n              }\n              return _context2.abrupt(\"return\", false);\n            case 2:\n              setLoading(true);\n\n              //check if availability edited or not, if not sent empty to api and use default one from settings\n              staffData = _objectSpread(_objectSpread({}, values), {}, {\n                schedule: schedules[\"staff\"]\n              });\n              if (!editAvailability) {\n                staffData = _objectSpread({}, values);\n              }\n              _context2.next = 7;\n              return (0,_libs_staffLib__WEBPACK_IMPORTED_MODULE_0__.createStaffApi)(staffData);\n            case 7:\n              res = _context2.sent;\n              form.resetFields();\n              setLoading(false);\n              navigate(\"/staff\");\n            case 11:\n            case \"end\":\n              return _context2.stop();\n          }\n        }\n      }, _callee2);\n    }));\n    return function onFinish(_x) {\n      return _ref2.apply(this, arguments);\n    };\n  }();\n\n  /**\n   * On finish faild method that can handle staff create faild\n   * @param {Object} values\n   */\n  var onFinishFailed = function onFinishFailed(errorInfo) {\n    message.error(errorInfo);\n  };\n  return /*#__PURE__*/React.createElement(\"div\", {\n    className: \"staff-form-wrapper\"\n  }, /*#__PURE__*/React.createElement(\"div\", null, /*#__PURE__*/React.createElement(_components_MainPageHeader__WEBPACK_IMPORTED_MODULE_2__[\"default\"], {\n    title: __(\"Add New\" + \" \" + (settings === null || settings === void 0 ? void 0 : (_settings$nicheData = settings.nicheData) === null || _settings$nicheData === void 0 ? void 0 : (_settings$nicheData$t = _settings$nicheData.title) === null || _settings$nicheData$t === void 0 ? void 0 : (_settings$nicheData$t2 = _settings$nicheData$t.employee) === null || _settings$nicheData$t2 === void 0 ? void 0 : _settings$nicheData$t2.singular), \"timetics\")\n  })), /*#__PURE__*/React.createElement(\"div\", {\n    className: \"tt-container-wrapper\"\n  }, /*#__PURE__*/React.createElement(Button, {\n    className: \"tt-mb-30\",\n    size: \"large\",\n    onClick: function onClick() {\n      navigate(\"/staff\");\n    }\n  }, __(\"Back to \" + (settings === null || settings === void 0 ? void 0 : (_settings$nicheData2 = settings.nicheData) === null || _settings$nicheData2 === void 0 ? void 0 : (_settings$nicheData2$ = _settings$nicheData2.title) === null || _settings$nicheData2$ === void 0 ? void 0 : (_settings$nicheData2$2 = _settings$nicheData2$.employee) === null || _settings$nicheData2$2 === void 0 ? void 0 : _settings$nicheData2$2.plural) + \" List\", \"timetics\")), /*#__PURE__*/React.createElement(Form, {\n    className: \"tt-form-container\",\n    form: form,\n    name: \"staff_create_form\",\n    layout: \"vertical\",\n    autoComplete: \"off\",\n    onFinish: onFinish,\n    onFinishFailed: onFinishFailed\n  }, /*#__PURE__*/React.createElement(_FormField__WEBPACK_IMPORTED_MODULE_1__[\"default\"], null), /*#__PURE__*/React.createElement(Button, {\n    type: \"primary\",\n    block: true,\n    htmlType: \"submit\",\n    size: \"large\",\n    loading: loading\n  }, __(\"Invite A\" + \" \" + (settings === null || settings === void 0 ? void 0 : (_settings$nicheData3 = settings.nicheData) === null || _settings$nicheData3 === void 0 ? void 0 : (_settings$nicheData3$ = _settings$nicheData3.title) === null || _settings$nicheData3$ === void 0 ? void 0 : (_settings$nicheData3$2 = _settings$nicheData3$.employee) === null || _settings$nicheData3$2 === void 0 ? void 0 : _settings$nicheData3$2.singular), \"timetics\")))));\n}\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (CreateStaff);\n\n//# sourceURL=webpack://timetics/./assets/src/admin/pages/staff/Create.js?");

/***/ }),

/***/ "./assets/src/admin/pages/staff/FormField.js":
/*!***************************************************!*\
  !*** ./assets/src/admin/pages/staff/FormField.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var react_phone_input_2_lib_style_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react-phone-input-2/lib/style.css */ \"./node_modules/react-phone-input-2/lib/style.css\");\n/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! react-router-dom */ \"./node_modules/react-router-dom/dist/index.js\");\n/* harmony import */ var _common_CountryPhoneInput__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../common/CountryPhoneInput */ \"./assets/src/common/CountryPhoneInput.js\");\n/* harmony import */ var _common_TextInput__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../common/TextInput */ \"./assets/src/common/TextInput.js\");\n/* harmony import */ var _actionCreators_common__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../actionCreators/common */ \"./assets/src/admin/actionCreators/common.js\");\n/* harmony import */ var _components_ScheduleMode__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../components/ScheduleMode */ \"./assets/src/admin/components/ScheduleMode.js\");\n/* harmony import */ var _components_SingleDaySchedule__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../components/SingleDaySchedule */ \"./assets/src/admin/components/SingleDaySchedule.js\");\n/* harmony import */ var _context_provider__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../context/provider */ \"./assets/src/admin/context/provider.js\");\nfunction ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }\nfunction _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }\nfunction _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }\nfunction _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }\nfunction _nonIterableRest() { throw new TypeError(\"Invalid attempt to destructure non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); }\nfunction _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === \"string\") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === \"Object\" && o.constructor) n = o.constructor.name; if (n === \"Map\" || n === \"Set\") return Array.from(o); if (n === \"Arguments\" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }\nfunction _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }\nfunction _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== \"undefined\" && arr[Symbol.iterator] || arr[\"@@iterator\"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i[\"return\"] != null) _i[\"return\"](); } finally { if (_d) throw _e; } } return _arr; }\nfunction _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }\n\n\n\n\n\n\n\n\nvar _window$antd = window.antd,\n  Row = _window$antd.Row,\n  Col = _window$antd.Col,\n  Form = _window$antd.Form,\n  Button = _window$antd.Button;\nvar timeticsObj = window.timetics;\nvar useState = window.React.useState;\nvar __ = wp.i18n.__;\nfunction FormField() {\n  var _schedules$staff;\n  var _useSearchParams = (0,react_router_dom__WEBPACK_IMPORTED_MODULE_7__.useSearchParams)(),\n    _useSearchParams2 = _slicedToArray(_useSearchParams, 1),\n    searchParams = _useSearchParams2[0];\n  var _useState = useState(\"\"),\n    _useState2 = _slicedToArray(_useState, 2),\n    phone = _useState2[0],\n    setPhone = _useState2[1];\n  var id = searchParams.get(\"id\") ? searchParams.get(\"id\") : timeticsObj === null || timeticsObj === void 0 ? void 0 : timeticsObj.current_user_id;\n  var _useStateValue = (0,_context_provider__WEBPACK_IMPORTED_MODULE_6__.useStateValue)(),\n    _useStateValue2 = _slicedToArray(_useStateValue, 2),\n    _useStateValue2$ = _useStateValue2[0],\n    meetingReducer = _useStateValue2$.meeting,\n    staff = _useStateValue2$.staff,\n    dispatch = _useStateValue2[1];\n  var schedules = meetingReducer.schedules,\n    editAvailability = meetingReducer.editAvailability;\n  var editAvailabilityHandler = function editAvailabilityHandler(status) {\n    (0,_actionCreators_common__WEBPACK_IMPORTED_MODULE_3__.setState)({\n      dispatch: dispatch,\n      name: \"editAvailability\",\n      value: status\n    });\n  };\n  return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(Row, {\n    gutter: [16, 0]\n  }, /*#__PURE__*/React.createElement(Col, {\n    sm: 12,\n    xs: 24\n  }, /*#__PURE__*/React.createElement(_common_TextInput__WEBPACK_IMPORTED_MODULE_2__[\"default\"], {\n    label: __(\"First Name\", \"timetics\"),\n    name: \"first_name\",\n    type: \"text\",\n    size: \"small\",\n    rules: [{\n      required: true,\n      message: __(\"First name is required!\", \"timetics\")\n    }],\n    placeholder: __(\"Enter your first name\", \"timetics\")\n  })), /*#__PURE__*/React.createElement(Col, {\n    sm: 12,\n    xs: 24\n  }, /*#__PURE__*/React.createElement(_common_TextInput__WEBPACK_IMPORTED_MODULE_2__[\"default\"], {\n    label: __(\"Last Name\", \"timetics\"),\n    name: \"last_name\",\n    type: \"text\",\n    size: \"small\",\n    placeholder: __(\"Enter your last name\", \"timetics\")\n  }))), /*#__PURE__*/React.createElement(Row, {\n    gutter: [16, 0]\n  }, /*#__PURE__*/React.createElement(Col, {\n    sm: 12,\n    xs: 24\n  }, /*#__PURE__*/React.createElement(_common_TextInput__WEBPACK_IMPORTED_MODULE_2__[\"default\"], {\n    label: __(\"Email\", \"timetics\"),\n    name: \"email\",\n    size: \"small\",\n    rules: [{\n      type: \"email\",\n      message: __(\"That doesn't look like an email address\", \"timetics\")\n    }, {\n      required: true,\n      message: __(\"Email is required!\", \"timetics\")\n    }],\n    placeholder: __(\"Enter your email\", \"timetics\")\n  })), /*#__PURE__*/React.createElement(Col, {\n    sm: 12,\n    xs: 24\n  }, /*#__PURE__*/React.createElement(_common_CountryPhoneInput__WEBPACK_IMPORTED_MODULE_1__[\"default\"], {\n    label: __(\"Phone\", \"timetics\"),\n    name: \"phone\",\n    type: \"number\",\n    size: \"small\",\n    className: \"timetics-input\"\n  }))), !id && /*#__PURE__*/React.createElement(Form.Item, {\n    className: \"timetics-input \",\n    label: __(\"working hours\", \"timetics\"),\n    labelCol: 24,\n    wrapperCol: 24\n    // name={name}\n    // rules={rules}\n  }, /*#__PURE__*/React.createElement(\"div\", {\n    className: \"tt-schedules-container\"\n  }, /*#__PURE__*/React.createElement(\"div\", {\n    className: \"tt-form-container\"\n  }, /*#__PURE__*/React.createElement(_components_ScheduleMode__WEBPACK_IMPORTED_MODULE_4__[\"default\"], null), schedules && ((_schedules$staff = schedules[\"staff\"]) === null || _schedules$staff === void 0 ? void 0 : _schedules$staff.map(function (schedule, schduleIndex) {\n    return /*#__PURE__*/React.createElement(React.Fragment, {\n      key: \"schedule-item-\".concat(schduleIndex)\n    }, /*#__PURE__*/React.createElement(_components_SingleDaySchedule__WEBPACK_IMPORTED_MODULE_5__[\"default\"], {\n      schedule: _objectSpread({}, schedule)\n      // key={`schdule-item-${index}`}\n      ,\n      scheduleIndex: schduleIndex,\n      schedules: schedules[\"staff\"],\n      staffId: \"staff\"\n    }));\n  }))))));\n}\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (FormField);\n\n//# sourceURL=webpack://timetics/./assets/src/admin/pages/staff/FormField.js?");

/***/ })

}]);