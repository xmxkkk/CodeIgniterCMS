/*jslint white: true, onevar: true, browser: true, undef: true, nomen: true, regexp: true, plusplus: true, bitwise: true, newcap: true, maxerr: 50, indent: 4 */
/*global $, jQuery */
/*properties caret, collapse, createRange, createTextRange, duplicate, 
    end, extend, floor, fn, focus, lastIndexOf, length, moveEnd, moveStart, 
    select, selection, selectionEnd, selectionStart, start, text, val
*/
((function ($) {
	$.extend($.fn, {
		caret: function (start, end) {
			var element, val, range;
			element = this[0];
			if (element) {			
				if (undefined === start) {
					// get
					if (undefined !== element.selectionStart) {
						start = element.selectionStart;
						end   = element.selectionEnd;
						
//#JSCOVERAGE_IF 0
					} else if (undefined !== document.selection) {
						val   = this.val();
						range = document.selection.createRange().duplicate();
						range.moveEnd("character", val.length);
						start = (0 === range.text.length ? val.length : val.lastIndexOf(range.text));
						range = document.selection.createRange().duplicate();
						range.moveStart("character", -val.length);
						end = range.text.length;
//#JSCOVERAGE_ENDIF
					}
					//console.log("GET selection = " + start + " to " + end);
					
				} else {
					// set
					//console.log("call SET selection = " + start + " to " + end);
					val = this.val();

					if ("number" !== typeof start || start < 0) {
						start = 0;
					} else {
						start = Math.floor(start);
					}
					if ("number" !== typeof end || end < 0) {
						end = 0;
					} else {
						end = Math.floor(end);
					}
					if (start > val.length) {
						start = val.length;
					}
					if (end > val.length) {
						end = val.length;
					}
					if (end < start) {
						end = start;
					}
					element.focus();

					if (undefined !== element.selectionStart) {
						element.selectionStart = start;
						element.selectionEnd   = end;
//#JSCOVERAGE_IF 0
					} else if (document.selection) {
						range = element.createTextRange();
						range.collapse(true);
						range.moveStart("character", start);
						range.moveEnd("character", end - start);
						range.select();
//#JSCOVERAGE_ENDIF
					}
					//console.log("return SET selection = " + start + " to " + end);
				}
			}

			return {
				start: start, 
				end:   end
			};
		}
	});
})(jQuery));