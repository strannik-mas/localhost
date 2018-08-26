/* Добавление обработчика */
function addHandler(element, event_name, handler) {
	if (element.addEventListener) {
		element.addEventListener(event_name, handler, false);
	} else {
		element.attachEvent('on' + event_name, handler);
	}
}
/* Удаление обработчика */
function removeHandler(element, event_name, handler) {
	if (element.removeEventListener) {
		element.removeEventListener(event_name, handler, false);
	} else {
		element.detachEvent('on' + event_name, handler);
	}
}
/* Отмена действия по умолчанию */
function cancelEvent(e) {
	try {
		e.preventDefault();
	} catch(x) {
		e.returnValue = false;
	}
}
/* Отмена всплытия */
function stopEvent(e) {
	try {
		e.stopPropagation();
	} catch(x) {
		e.cancelBubble = true;
	}
}