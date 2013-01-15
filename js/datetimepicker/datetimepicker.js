/*jslint browser: true, white: true, onevar: true, undef: true, regexp: true, plusplus: true, bitwise: true, newcap: true, maxerr: 50, indent: 4 */
/*global $, Date, String, isNaN, jQuery, parseInt */
/*properties BACKSPACE, DELETE, DOWN, LEFT, RIGHT, TAB, UP, Widget, 
    _create, _date, _focusInHandler, _focusOutHandler, _formatNumber, 
    _inputDate, _inputHours, _inputMinutes, _inputMonth, _inputValidator, 
    _inputYear, _inputs, _keyDownHandler, _keyUpHandler, _setOption, add, 
    addClass, append, apply, caret, children, concat, date, dateDelimiter, 
    dateTimeDelimier, destroy, element, focusin, focusout, getDate, 
    getFullYear, getHours, getMinutes, getMonth, getTime, hasClass, hide, 
    keyCode, keydown, keyup, length, next, not, onChange, options, parent, 
    prev, preventDefault, prototype, remove, removeClass, show, start, 
    timeDelimiter, ui, unwrap, val, value, widget, wrap, yearMax, yearMin
*/

/*
 * TODO:
 * - multiple formats for input date (Date, ms, ISO)
 * - localization of layout d/M/y or M/d/y
 * - optional seconds
 * - validation of options
 *
 */
((function ($) {

	"use strict";
	
	$.widget("ui.datetimepicker", {

		// DOM elements
		_inputDate:    null, 
		_inputMonth:   null, 
		_inputYear:    null, 
		_inputHours:   null, 
		_inputMinutes: null,
		_inputs:       [],
		// state
		_date: null,
		
		// default options
		options: {
			date:             new Date(),
			yearMin:          2000,
			yearMax:          2099,
			dateDelimiter:    "-",
			dateTimeDelimier: " ",
			timeDelimiter:    ":",
			change:           null
		},

		_formatNumber: function (value) {
			if (value < 10) {
				return "0" + String(value); 
			} else {
				return String(value);
			}
		},

		_inputValidator: function (self, input) {
			var d, m, y, h, n, dt, v;
			// validation
			v = parseInt(input.val(), 10);
			if (input.hasClass("date") && (v < 1 || v > 31 || isNaN(v))) {
				input.val(self._formatNumber(self._date.getDate()));
			} else if (input.hasClass("month") && (v < 1 || v > 12 || isNaN(v))) {
				input.val(self._formatNumber(self._date.getMonth() + 1));
			} else if (input.hasClass("year") && (v < self.options.yearMin || v > self.options.yearMax || isNaN(v))) {
				input.val(self._date.getFullYear());
			} else if (input.hasClass("hours") && (v < 0 || v > 23 || isNaN(v))) {
				input.val(self._formatNumber(self._date.getHours()));
			} else if (input.hasClass("minutes") && (v < 0 || v > 59 || isNaN(v))) {
				input.val(self._formatNumber(self._date.getMinutes()));
			} 
			
			// new date from values
			y = parseInt(self._inputYear.val(),    10);
			m = parseInt(self._inputMonth.val(),   10);
			d = parseInt(self._inputDate.val(),    10);
			h = parseInt(self._inputHours.val(),   10);
			n = parseInt(self._inputMinutes.val(), 10);
			
			// validate form values match
			dt = new Date(y, m - 1, d, h, n);
			
			if (y !== dt.getFullYear() || m - 1 !== dt.getMonth() || d !== dt.getDate() || h !== dt.getHours() || n !== dt.getMinutes()) {
				// reset form values
				self._inputYear.val(dt.getFullYear());
				self._inputMonth.val(self._formatNumber(dt.getMonth() + 1));
				self._inputDate.val(self._formatNumber(dt.getDate()));
				self._inputHours.val(self._formatNumber(dt.getHours()));
				self._inputMinutes.val(self._formatNumber(dt.getMinutes()));
			}
			
			if (dt.getTime() !== self._date.getTime()) {
				self._date = dt;
				self.element.val(dt);		
				/*
				if ("function" === typeof self.options.onChange) {
					self.options.onChange(dt);
				}
				*/
				self.element.trigger("datetimepickerchange", [dt]);
			}
		},

		_keyDownHandler: function (self, input, e) {
			var v, prev, selectionStart;
			
			v = parseInt(input.val(), 10);
			
			switch (e.keyCode) {
			case $.ui.keyCode.LEFT:
				// select previous control
				selectionStart = input.caret().start; 
				if (0 === selectionStart) {
					//console.log("LEFT, selecting prev");
					prev = input.prevAll("input").not(".value").eq(0);
					if (0 !== prev.length) {
						e.preventDefault();
						prev.caret(prev.val().length + 1, prev.val().length + 1); // caret() sets focus
					}
				}
				break;
				
			case $.ui.keyCode.RIGHT:
				// select next control
				selectionStart = input.caret().start; //input.attr("selectionStart");
				if (input.val().length === selectionStart) {
					e.preventDefault();
					//console.log("RIGHT, selecting next");
					input.nextAll("input").not(".value").eq(0).caret(1, 1); // caret() sets focus
				}
				break;
				
			case $.ui.keyCode.UP:
				// increment number
				v = v + 1;
				if (input.hasClass("date") && (isNaN(v) || v > 31)) {
					v = 1;
				} else if (input.hasClass("month") && (isNaN(v) || v > 12)) {
					v = 1;
				} else if (input.hasClass("year") && (isNaN(v) || v > self.options.yearMax)) {
					v = self.options.yearMin;
				} else if (input.hasClass("hours") && (isNaN(v) || v > 23)) {
					v = 0;
				} else if (input.hasClass("minutes") && (isNaN(v) || v > 59)) {
					v = 0;
				} 
				input.val(self._formatNumber(v));
				break;
				
			case $.ui.keyCode.DOWN:
				// decrement number
				v = v - 1;
				if (input.hasClass("date") && (isNaN(v) || v < 1)) {
					v = 31;
				} else if (input.hasClass("month") && (isNaN(v) || v < 1)) {
					v = 12;
				} else if (input.hasClass("year") && (isNaN(v) || v < self.options.yearMin)) {
					v = self.options.yearMax;
				} else if (input.hasClass("hours") && (isNaN(v) || v < 0)) {
					v = 23;
				} else if (input.hasClass("minutes") && (isNaN(v) || v < 0)) {
					v = 59;
				} 
				input.val(self._formatNumber(v));
				break;
				
//#JSCOVERAGE_IF 0
			case $.ui.keyCode.BACKSPACE:
			case $.ui.keyCode.DELETE:
				// allow backspace and delete
				break;
				
			default:
				if ($.ui.keyCode.TAB !== e.keyCode && (e.keyCode < 48 /* 0 */ || e.keyCode > 57 /* 9 */)) {
					// if not TAB or [0 - 9] then prevent
					e.preventDefault();
				}
//#JSCOVERAGE_ENDIF
			}			
		},
		
		_keyUpHandler: function (self, input, e) {
			if (e.keyCode === $.ui.keyCode.UP || e.keyCode === $.ui.keyCode.DOWN) {
				self._inputValidator(self, input);
			}
		},
		
		_focusInHandler: function (input) {
			input.addClass("selected");
		},
		
		_focusOutHandler: function (self, input) {
			input.removeClass("selected");
			self._inputValidator(self, input);
		},
		
		_configureChangeEvent: function (handler) {
			this.element.unbind("datetimepickerchange");
			if ("function" === typeof handler) {
				this.options.change = handler;
				this.element.bind("datetimepickerchange", function (e, dt) {
					handler(e, dt);
				});
			} else {
				this.options.change = null;
			}
		},
		
		_create: function () {
			var self = this;
			self._date = self.options.date;
			self._inputYear    = $("<input type=\"text\" name=\"yearinput\" class=\"year\"    value=\"" + self._formatNumber(self.options.date.getFullYear())   + "\" maxlength=\"4\"/>");
			self._inputMonth   = $("<input type=\"text\" name=\"monthinput\" class=\"month\"   value=\"" + self._formatNumber(self.options.date.getMonth() + 1)  + "\" maxlength=\"2\"/>");
			self._inputDate    = $("<input type=\"text\" name=\"dateinput\" class=\"date\"    value=\"" + self._formatNumber(self.options.date.getDate())       + "\" maxlength=\"2\"/>");
			self._inputHours   = $("<input type=\"text\" name=\"hourinput\" class=\"hours\"   value=\"" + self._formatNumber(self.options.date.getHours())      + "\" maxlength=\"2\"/>");
			self._inputMinutes = $("<input type=\"text\" name=\"minuteinput\" class=\"minutes\" value=\"" + self._formatNumber(self.options.date.getMinutes())    + "\" maxlength=\"2\"/>");
			self._inputs = [self._inputYear, self._inputMonth, self._inputDate, self._inputHours, self._inputMinutes];

			this.element
			// set default value
			.val(self._date)
			// remove all classes
			.removeClass()
			// add class to indicate this is the value field
			.addClass("value")
			// hide original input
			.hide()
			// wrap in div
			.wrap("<div class=\"datetimepicker\"><\/div>")	
			// add other items as siblings to original input
			.parent()
			.append(self._inputYear)
			.append("<span>".concat(self.options.dateDelimiter, "<\/span>"))
			.append(self._inputMonth)
			.append("<span>".concat(self.options.dateDelimiter, "<\/span>"))
			.append(self._inputDate)
			.append("<span>".concat(self.options.dateTimeDelimier, "<\/span>"))
			.append(self._inputHours)
			.append("<span>".concat(self.options.timeDelimiter, "<\/span>"))
			.append(self._inputMinutes);
			
			self._inputDate
			.add(self._inputMonth) 
			.add(self._inputYear)
			.add(self._inputHours) 
			.add(self._inputMinutes)
			.keydown(function (e) {
				self._keyDownHandler(self, $(this), e);
			})
			.keyup(function (e) {
				self._keyUpHandler(self, $(this), e);
			})
			.focusin(function () {
				self._focusInHandler($(this));
			})
			.focusout(function () {
				self._focusOutHandler(self, $(this));
			});
			
			self._configureChangeEvent(self.options.change);
		},
		
		_setOption: function (key, value) {
			if ("date" === key && value instanceof Date) {
				this._date = value;
				this.element.val(value);
				this._inputYear.val(value.getFullYear());
				this._inputMonth.val(this._formatNumber(value.getMonth() + 1));
				this._inputDate.val(this._formatNumber(value.getDate()));
				this._inputHours.val(this._formatNumber(value.getHours()));
				this._inputMinutes.val(this._formatNumber(value.getMinutes()));
			} else if ("change" === key) {	
				this._configureChangeEvent(value);
			}
		},
		
		value: function () {
			// calculate some value and return it
			return this._date;
		},

		destroy: function () {
			$.Widget.prototype.destroy.apply(this, arguments); // default destroy
			// now do other stuff particular to this widget
			this.element.parent().children().not(this.element).remove();
			this.element.unwrap().removeClass("value").show();
		}
	});
	
}(jQuery)));