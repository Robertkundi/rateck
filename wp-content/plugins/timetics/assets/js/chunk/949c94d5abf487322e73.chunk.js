"use strict";
/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
(self["webpackChunktimetics"] = self["webpackChunktimetics"] || []).push([["assets_src_admin_pages_bookings_Create_js"],{

/***/ "./assets/src/admin/pages/bookings/Create.js":
/*!***************************************************!*\
  !*** ./assets/src/admin/pages/bookings/Create.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var dayjs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! dayjs */ \"./node_modules/dayjs/dayjs.min.js\");\n/* harmony import */ var dayjs__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(dayjs__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! react-router-dom */ \"./node_modules/react-router-dom/dist/index.js\");\n/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! react-router-dom */ \"./node_modules/react-router/dist/index.js\");\n/* harmony import */ var _libs_bookingLib__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../libs/bookingLib */ \"./assets/src/admin/libs/bookingLib.js\");\n/* harmony import */ var _FormField__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./FormField */ \"./assets/src/admin/pages/bookings/FormField.js\");\n/* harmony import */ var _common_CreateOrUpdate__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../common/CreateOrUpdate */ \"./assets/src/common/CreateOrUpdate.js\");\n/* harmony import */ var _components_MainPageHeader__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../components/MainPageHeader */ \"./assets/src/admin/components/MainPageHeader.js\");\n/* harmony import */ var _services_meetings__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../services/meetings */ \"./assets/src/admin/services/meetings.js\");\n/* harmony import */ var _actionCreators_meeting__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../actionCreators/meeting */ \"./assets/src/admin/actionCreators/meeting.js\");\n/* harmony import */ var _context_provider__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../context/provider */ \"./assets/src/admin/context/provider.js\");\n/* harmony import */ var _actionCreators_actions__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../actionCreators/actions */ \"./assets/src/admin/actionCreators/actions.js\");\n/* harmony import */ var _frontend_utils_helper__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../../../frontend/utils/helper */ \"./assets/src/frontend/utils/helper.js\");\nfunction _typeof(obj) { \"@babel/helpers - typeof\"; return _typeof = \"function\" == typeof Symbol && \"symbol\" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && \"function\" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? \"symbol\" : typeof obj; }, _typeof(obj); }\nfunction ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }\nfunction _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }\nfunction _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }\nfunction _regeneratorRuntime() { \"use strict\"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, defineProperty = Object.defineProperty || function (obj, key, desc) { obj[key] = desc.value; }, $Symbol = \"function\" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || \"@@iterator\", asyncIteratorSymbol = $Symbol.asyncIterator || \"@@asyncIterator\", toStringTagSymbol = $Symbol.toStringTag || \"@@toStringTag\"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, \"\"); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return defineProperty(generator, \"_invoke\", { value: makeInvokeMethod(innerFn, self, context) }), generator; } function tryCatch(fn, obj, arg) { try { return { type: \"normal\", arg: fn.call(obj, arg) }; } catch (err) { return { type: \"throw\", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { [\"next\", \"throw\", \"return\"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if (\"throw\" !== record.type) { var result = record.arg, value = result.value; return value && \"object\" == _typeof(value) && hasOwn.call(value, \"__await\") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke(\"next\", value, resolve, reject); }, function (err) { invoke(\"throw\", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke(\"throw\", error, resolve, reject); }); } reject(record.arg); } var previousPromise; defineProperty(this, \"_invoke\", { value: function value(method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(innerFn, self, context) { var state = \"suspendedStart\"; return function (method, arg) { if (\"executing\" === state) throw new Error(\"Generator is already running\"); if (\"completed\" === state) { if (\"throw\" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if (\"next\" === context.method) context.sent = context._sent = context.arg;else if (\"throw\" === context.method) { if (\"suspendedStart\" === state) throw state = \"completed\", context.arg; context.dispatchException(context.arg); } else \"return\" === context.method && context.abrupt(\"return\", context.arg); state = \"executing\"; var record = tryCatch(innerFn, self, context); if (\"normal\" === record.type) { if (state = context.done ? \"completed\" : \"suspendedYield\", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } \"throw\" === record.type && (state = \"completed\", context.method = \"throw\", context.arg = record.arg); } }; } function maybeInvokeDelegate(delegate, context) { var method = delegate.iterator[context.method]; if (undefined === method) { if (context.delegate = null, \"throw\" === context.method) { if (delegate.iterator[\"return\"] && (context.method = \"return\", context.arg = undefined, maybeInvokeDelegate(delegate, context), \"throw\" === context.method)) return ContinueSentinel; context.method = \"throw\", context.arg = new TypeError(\"The iterator does not provide a 'throw' method\"); } return ContinueSentinel; } var record = tryCatch(method, delegate.iterator, context.arg); if (\"throw\" === record.type) return context.method = \"throw\", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, \"return\" !== context.method && (context.method = \"next\", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = \"throw\", context.arg = new TypeError(\"iterator result is not an object\"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = \"normal\", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: \"root\" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if (\"function\" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) { if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; } return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, defineProperty(Gp, \"constructor\", { value: GeneratorFunctionPrototype, configurable: !0 }), defineProperty(GeneratorFunctionPrototype, \"constructor\", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, \"GeneratorFunction\"), exports.isGeneratorFunction = function (genFun) { var ctor = \"function\" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || \"GeneratorFunction\" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, \"GeneratorFunction\")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, \"Generator\"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, \"toString\", function () { return \"[object Generator]\"; }), exports.keys = function (val) { var object = Object(val), keys = []; for (var key in object) { keys.push(key); } return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = \"next\", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) { \"t\" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); } }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if (\"throw\" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = \"throw\", record.arg = exception, context.next = loc, caught && (context.method = \"next\", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if (\"root\" === entry.tryLoc) return handle(\"end\"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, \"catchLoc\"), hasFinally = hasOwn.call(entry, \"finallyLoc\"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error(\"try statement without catch or finally\"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, \"finallyLoc\") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && (\"break\" === type || \"continue\" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = \"next\", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if (\"throw\" === record.type) throw record.arg; return \"break\" === record.type || \"continue\" === record.type ? this.next = record.arg : \"return\" === record.type ? (this.rval = this.arg = record.arg, this.method = \"return\", this.next = \"end\") : \"normal\" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, \"catch\": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if (\"throw\" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error(\"illegal catch attempt\"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, \"next\" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }\nfunction asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }\nfunction _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, \"next\", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, \"throw\", err); } _next(undefined); }); }; }\nfunction _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }\nfunction _nonIterableRest() { throw new TypeError(\"Invalid attempt to destructure non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); }\nfunction _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === \"string\") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === \"Object\" && o.constructor) n = o.constructor.name; if (n === \"Map\" || n === \"Set\") return Array.from(o); if (n === \"Arguments\" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }\nfunction _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }\nfunction _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== \"undefined\" && arr[Symbol.iterator] || arr[\"@@iterator\"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i[\"return\"] != null) _i[\"return\"](); } finally { if (_d) throw _e; } } return _arr; }\nfunction _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }\n\n\n\n\n\n\n\n\n\n\n\nvar _window$antd = window.antd,\n  Button = _window$antd.Button,\n  Form = _window$antd.Form,\n  message = _window$antd.message,\n  Skeleton = _window$antd.Skeleton;\nvar __ = wp.i18n.__;\nvar _React = React,\n  useState = _React.useState,\n  useEffect = _React.useEffect;\nfunction CreateBooking() {\n  var _settings$nicheData, _settings$nicheData$t, _settings$nicheData$t2, _settings$nicheData2, _settings$nicheData2$, _settings$nicheData2$2, _settings$nicheData3, _settings$nicheData3$, _settings$nicheData3$2, _settings$nicheData4, _settings$nicheData4$, _settings$nicheData4$2;\n  var _useStateValue = (0,_context_provider__WEBPACK_IMPORTED_MODULE_7__.useStateValue)(),\n    _useStateValue2 = _slicedToArray(_useStateValue, 2),\n    _useStateValue2$ = _useStateValue2[0],\n    meetingReducer = _useStateValue2$.meeting,\n    bookingReducer = _useStateValue2$.booking,\n    settingsReducer = _useStateValue2$.settings,\n    dispatch = _useStateValue2[1];\n  var _useState = useState([]),\n    _useState2 = _slicedToArray(_useState, 2),\n    seats = _useState2[0],\n    setSeats = _useState2[1];\n  var _useState3 = useState(false),\n    _useState4 = _slicedToArray(_useState3, 2),\n    loading = _useState4[0],\n    setLoading = _useState4[1];\n  var _useState5 = useState(),\n    _useState6 = _slicedToArray(_useState5, 2),\n    meetingData = _useState6[0],\n    setMeetingData = _useState6[1];\n  var _Form$useForm = Form.useForm(),\n    _Form$useForm2 = _slicedToArray(_Form$useForm, 1),\n    form = _Form$useForm2[0];\n  var _useSearchParams = (0,react_router_dom__WEBPACK_IMPORTED_MODULE_10__.useSearchParams)(),\n    _useSearchParams2 = _slicedToArray(_useSearchParams, 1),\n    searchParams = _useSearchParams2[0];\n  var navigate = (0,react_router_dom__WEBPACK_IMPORTED_MODULE_11__.useNavigate)();\n  var id = searchParams.get(\"id\");\n  var selectedDate = bookingReducer.selectedDate,\n    meetingToBook = bookingReducer.meetingToBook,\n    selectedStaffIdToBook = bookingReducer.selectedStaffIdToBook,\n    _bookingReducer$booki = bookingReducer.booking,\n    booking = _bookingReducer$booki === void 0 ? {} : _bookingReducer$booki,\n    location_type = bookingReducer.location_type,\n    location = bookingReducer.location;\n  var settings = settingsReducer.settings;\n\n  /**\n   * get booking data\n   */\n  useEffect(function () {\n    var loadData = /*#__PURE__*/function () {\n      var _ref = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {\n        var _res$data, _res$data$data;\n        var res, items, _data$data, _data$data$appointmen, _data$data2, _data$data2$staff, _data$data3, _data$data4, _data$data4$staff, _data$data5, _data$data6, _data$data7, _data$data7$customer, _data$data8, _data$data8$customer, _data$data9, _data$data9$staff, _data$data10, _data$data11, _data$data12, _data$data13, _data$data14, _yield$getSingleBooki, data, meetingId, _getBookingData, staffs, meeting, selectedScheduleBasedOnStaff, offDays;\n        return _regeneratorRuntime().wrap(function _callee$(_context) {\n          while (1) {\n            switch (_context.prev = _context.next) {\n              case 0:\n                _context.next = 2;\n                return fetchMeetingList(-1, 1);\n              case 2:\n                res = _context.sent;\n                items = res === null || res === void 0 ? void 0 : (_res$data = res.data) === null || _res$data === void 0 ? void 0 : (_res$data$data = _res$data.data) === null || _res$data$data === void 0 ? void 0 : _res$data$data.items;\n                setMeetingData(items);\n                (0,_actionCreators_meeting__WEBPACK_IMPORTED_MODULE_6__.setMeetings)({\n                  dispatch: dispatch,\n                  value: items\n                });\n                if (!(id && items !== null && items !== void 0 && items.length)) {\n                  _context.next = 18;\n                  break;\n                }\n                setLoading(true);\n                _context.next = 10;\n                return (0,_libs_bookingLib__WEBPACK_IMPORTED_MODULE_1__.getSingleBookingApi)(id);\n              case 10:\n                _yield$getSingleBooki = _context.sent;\n                data = _yield$getSingleBooki.data;\n                meetingId = data === null || data === void 0 ? void 0 : (_data$data = data.data) === null || _data$data === void 0 ? void 0 : (_data$data$appointmen = _data$data.appointment) === null || _data$data$appointmen === void 0 ? void 0 : _data$data$appointmen.id;\n                _getBookingData = getBookingData({\n                  meetingId: meetingId,\n                  items: items\n                }), staffs = _getBookingData.staffs, meeting = _getBookingData.meeting;\n                selectedScheduleBasedOnStaff = meeting === null || meeting === void 0 ? void 0 : meeting.schedule[data === null || data === void 0 ? void 0 : (_data$data2 = data.data) === null || _data$data2 === void 0 ? void 0 : (_data$data2$staff = _data$data2.staff) === null || _data$data2$staff === void 0 ? void 0 : _data$data2$staff.id];\n                offDays = (0,_frontend_utils_helper__WEBPACK_IMPORTED_MODULE_9__.getDayNumbers)(selectedScheduleBasedOnStaff);\n                dispatch({\n                  type: _actionCreators_actions__WEBPACK_IMPORTED_MODULE_8__.actions.SET_BOOKING_STATE,\n                  payload: {\n                    selectedMeetingId: data === null || data === void 0 ? void 0 : (_data$data3 = data.data) === null || _data$data3 === void 0 ? void 0 : _data$data3.id,\n                    selectedStaffIdToBook: data === null || data === void 0 ? void 0 : (_data$data4 = data.data) === null || _data$data4 === void 0 ? void 0 : (_data$data4$staff = _data$data4.staff) === null || _data$data4$staff === void 0 ? void 0 : _data$data4$staff.id,\n                    meetingStaffs: staffs,\n                    meetingStaff: data === null || data === void 0 ? void 0 : (_data$data5 = data.data) === null || _data$data5 === void 0 ? void 0 : _data$data5.staff,\n                    meetingToBook: meeting,\n                    selectedDate: dayjs__WEBPACK_IMPORTED_MODULE_0___default()(data === null || data === void 0 ? void 0 : (_data$data6 = data.data) === null || _data$data6 === void 0 ? void 0 : _data$data6.start_date).format(\"YYYY-MM-DD\"),\n                    unavailableDayNumber: offDays,\n                    booking: {\n                      first_name: data === null || data === void 0 ? void 0 : (_data$data7 = data.data) === null || _data$data7 === void 0 ? void 0 : (_data$data7$customer = _data$data7.customer) === null || _data$data7$customer === void 0 ? void 0 : _data$data7$customer.first_name,\n                      email: data === null || data === void 0 ? void 0 : (_data$data8 = data.data) === null || _data$data8 === void 0 ? void 0 : (_data$data8$customer = _data$data8.customer) === null || _data$data8$customer === void 0 ? void 0 : _data$data8$customer.email,\n                      appointment: meeting === null || meeting === void 0 ? void 0 : meeting.id,\n                      staff: data === null || data === void 0 ? void 0 : (_data$data9 = data.data) === null || _data$data9 === void 0 ? void 0 : (_data$data9$staff = _data$data9.staff) === null || _data$data9$staff === void 0 ? void 0 : _data$data9$staff.full_name,\n                      start_date: dayjs__WEBPACK_IMPORTED_MODULE_0___default()(data === null || data === void 0 ? void 0 : (_data$data10 = data.data) === null || _data$data10 === void 0 ? void 0 : _data$data10.start_date).format(\"YYYY-MM-DD\"),\n                      start_time: data === null || data === void 0 ? void 0 : (_data$data11 = data.data) === null || _data$data11 === void 0 ? void 0 : _data$data11.start_time,\n                      status: data === null || data === void 0 ? void 0 : (_data$data12 = data.data) === null || _data$data12 === void 0 ? void 0 : _data$data12.status,\n                      location_type: data === null || data === void 0 ? void 0 : (_data$data13 = data.data) === null || _data$data13 === void 0 ? void 0 : _data$data13.location_type,\n                      location: data === null || data === void 0 ? void 0 : (_data$data14 = data.data) === null || _data$data14 === void 0 ? void 0 : _data$data14.location\n                    }\n                  }\n                });\n                setLoading(false);\n              case 18:\n              case \"end\":\n                return _context.stop();\n            }\n          }\n        }, _callee);\n      }));\n      return function loadData() {\n        return _ref.apply(this, arguments);\n      };\n    }();\n    loadData();\n    return function () {};\n  }, []);\n\n  /**\n   * Meeting title on change get value\n   * @param {number} value selected value\n   */\n  useEffect(function () {\n    return function () {\n      dispatch({\n        type: _actionCreators_actions__WEBPACK_IMPORTED_MODULE_8__.actions.CLEAR_BOOKING_RELATED_DATA,\n        payload: {}\n      });\n    };\n  }, []);\n  var getBookingData = function getBookingData(_ref2) {\n    var _meeting$;\n    var meetingId = _ref2.meetingId,\n      items = _ref2.items;\n    var meeting = items === null || items === void 0 ? void 0 : items.filter(function (item) {\n      return item.id == meetingId;\n    });\n    var staffs = meeting === null || meeting === void 0 ? void 0 : (_meeting$ = meeting[0]) === null || _meeting$ === void 0 ? void 0 : _meeting$.staff;\n    return {\n      meeting: meeting[0],\n      staffs: staffs\n    };\n  };\n\n  /**\n   * fetch meetings to call api\n   * @param {number} per_page posts per pages\n   * @param {number} page page number\n   */\n  var fetchMeetingList = /*#__PURE__*/function () {\n    var _ref3 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2(per_page, page) {\n      var res;\n      return _regeneratorRuntime().wrap(function _callee2$(_context2) {\n        while (1) {\n          switch (_context2.prev = _context2.next) {\n            case 0:\n              _context2.next = 2;\n              return (0,_services_meetings__WEBPACK_IMPORTED_MODULE_5__.getAllMeetings)({\n                method: \"GET\",\n                params: {\n                  per_page: per_page,\n                  paged: page\n                }\n              });\n            case 2:\n              res = _context2.sent;\n              return _context2.abrupt(\"return\", res);\n            case 4:\n            case \"end\":\n              return _context2.stop();\n          }\n        }\n      }, _callee2);\n    }));\n    return function fetchMeetingList(_x, _x2) {\n      return _ref3.apply(this, arguments);\n    };\n  }();\n\n  /**\n   * On finish method that can handle booking create\n   * @param {Object} values\n   */\n  var onFinish = /*#__PURE__*/function () {\n    var _ref4 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee3(values) {\n      var res, _res;\n      return _regeneratorRuntime().wrap(function _callee3$(_context3) {\n        while (1) {\n          switch (_context3.prev = _context3.next) {\n            case 0:\n              if (location && location_type) {\n                values.location = location;\n                values.location_type = location_type;\n              }\n              setLoading(true);\n              if (!id) {\n                _context3.next = 8;\n                break;\n              }\n              _context3.next = 5;\n              return (0,_libs_bookingLib__WEBPACK_IMPORTED_MODULE_1__.updateBookingApi)({\n                id: id,\n                values: _objectSpread(_objectSpread({}, values), {}, {\n                  meeting_date: selectedDate,\n                  staff: selectedStaffIdToBook,\n                  start_date: selectedDate,\n                  end_time: addTime({\n                    startTime: values.start_time,\n                    duration: meetingToBook.duration\n                  })\n                })\n              });\n            case 5:\n              res = _context3.sent;\n              _context3.next = 13;\n              break;\n            case 8:\n              _context3.next = 10;\n              return (0,_libs_bookingLib__WEBPACK_IMPORTED_MODULE_1__.createBookingApi)({\n                values: _objectSpread(_objectSpread({}, values), {}, {\n                  staff: selectedStaffIdToBook,\n                  start_date: selectedDate,\n                  date: selectedDate,\n                  end_time: addTime({\n                    startTime: values.start_time,\n                    duration: meetingToBook.duration\n                  })\n                })\n              });\n            case 10:\n              _res = _context3.sent;\n              dispatch({\n                type: _actionCreators_actions__WEBPACK_IMPORTED_MODULE_8__.actions.CLEAR_BOOKING_RELATED_DATA,\n                payload: {}\n              });\n              form.resetFields();\n            case 13:\n              setLoading(false);\n              navigate(\"/bookings\");\n            case 15:\n            case \"end\":\n              return _context3.stop();\n          }\n        }\n      }, _callee3);\n    }));\n    return function onFinish(_x3) {\n      return _ref4.apply(this, arguments);\n    };\n  }();\n\n  /**\n   * On finish faild method that can handle booking create faild\n   * @param {Object} values\n   */\n  var onFinishFailed = function onFinishFailed(errorInfo) {\n    message.error(errorInfo);\n  };\n  if (loading) {\n    return /*#__PURE__*/React.createElement(Skeleton, {\n      active: true\n    });\n  }\n  return /*#__PURE__*/React.createElement(\"div\", {\n    className: \"booking-form-wrapper\"\n  }, /*#__PURE__*/React.createElement(_components_MainPageHeader__WEBPACK_IMPORTED_MODULE_4__[\"default\"], {\n    title: __(\"Add New\" + \" \" + (settings === null || settings === void 0 ? void 0 : (_settings$nicheData = settings.nicheData) === null || _settings$nicheData === void 0 ? void 0 : (_settings$nicheData$t = _settings$nicheData.title) === null || _settings$nicheData$t === void 0 ? void 0 : (_settings$nicheData$t2 = _settings$nicheData$t.event) === null || _settings$nicheData$t2 === void 0 ? void 0 : _settings$nicheData$t2.singular), \"timetics\")\n  }), /*#__PURE__*/React.createElement(\"div\", {\n    className: \"tt-container-wrapper\"\n  }, /*#__PURE__*/React.createElement(\"div\", null, /*#__PURE__*/React.createElement(Button, {\n    className: \"tt-mb-30\",\n    size: \"large\",\n    onClick: function onClick() {\n      navigate(\"/bookings\");\n    }\n  }, __(\"Back to \" + (settings === null || settings === void 0 ? void 0 : (_settings$nicheData2 = settings.nicheData) === null || _settings$nicheData2 === void 0 ? void 0 : (_settings$nicheData2$ = _settings$nicheData2.title) === null || _settings$nicheData2$ === void 0 ? void 0 : (_settings$nicheData2$2 = _settings$nicheData2$.event) === null || _settings$nicheData2$2 === void 0 ? void 0 : _settings$nicheData2$2.plural), \"timetics\"))), /*#__PURE__*/React.createElement(Form, {\n    form: form,\n    name: \"booking_create_form\",\n    className: \"tt-form-container\",\n    layout: \"vertical\",\n    autoComplete: \"off\",\n    onFinish: onFinish,\n    onFinishFailed: onFinishFailed\n    // TODO: need to implement update booking\n    ,\n    initialValues: _objectSpread(_objectSpread({}, booking), {}, {\n      seats: [],\n      invitee: \"0\"\n    })\n  }, /*#__PURE__*/React.createElement(_FormField__WEBPACK_IMPORTED_MODULE_2__[\"default\"], {\n    form: form,\n    meetingData: meetingData,\n    setSeats: setSeats\n  }), /*#__PURE__*/React.createElement(_common_CreateOrUpdate__WEBPACK_IMPORTED_MODULE_3__[\"default\"], {\n    id: id,\n    loading: loading,\n    type: \"primary\",\n    htmlType: \"submit\",\n    buttonText: id ? __(\"Update \" + (settings === null || settings === void 0 ? void 0 : (_settings$nicheData3 = settings.nicheData) === null || _settings$nicheData3 === void 0 ? void 0 : (_settings$nicheData3$ = _settings$nicheData3.title) === null || _settings$nicheData3$ === void 0 ? void 0 : (_settings$nicheData3$2 = _settings$nicheData3$.event) === null || _settings$nicheData3$2 === void 0 ? void 0 : _settings$nicheData3$2.singular), \"timetics\") : __(\"Create \" + (settings === null || settings === void 0 ? void 0 : (_settings$nicheData4 = settings.nicheData) === null || _settings$nicheData4 === void 0 ? void 0 : (_settings$nicheData4$ = _settings$nicheData4.title) === null || _settings$nicheData4$ === void 0 ? void 0 : (_settings$nicheData4$2 = _settings$nicheData4$.event) === null || _settings$nicheData4$2 === void 0 ? void 0 : _settings$nicheData4$2.singular), \"timetics\")\n  }))));\n}\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (CreateBooking);\nvar addTime = function addTime(_ref5) {\n  var _ref5$startTime = _ref5.startTime,\n    startTime = _ref5$startTime === void 0 ? \"10:30am\" : _ref5$startTime,\n    _ref5$duration = _ref5.duration,\n    duration = _ref5$duration === void 0 ? \"60 min\" : _ref5$duration;\n  var _duration$split = duration.split(\" \"),\n    _duration$split2 = _slicedToArray(_duration$split, 2),\n    num = _duration$split2[0],\n    type = _duration$split2[1];\n  if (type === \"hr\" || type === \"hour\") {\n    num = num * 60;\n  }\n  if (type === \"min\" || type === \"minute\") {\n    num = num;\n  }\n  var _startTime$split = startTime.split(\":\"),\n    _startTime$split2 = _slicedToArray(_startTime$split, 2),\n    hour = _startTime$split2[0],\n    minute = _startTime$split2[1];\n  var ampm = minute.substring(minute.length - 2);\n  var min = parseInt(minute);\n  var totalMin = parseInt(hour) * 60 + parseInt(min) + parseInt(num);\n  var newHour = Math.floor(totalMin / 60);\n  var newMin = totalMin % 60;\n  var newTime = \"\".concat(newHour, \":\").concat(newMin).concat(ampm);\n  return newTime;\n};\n\n//# sourceURL=webpack://timetics/./assets/src/admin/pages/bookings/Create.js?");

/***/ })

}]);