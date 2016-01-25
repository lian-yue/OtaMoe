/*!
 * Name   : OTAMOE
 * Version: 1.0.0
 * Author : LianYue
 * URL    : http://www.lianyue.org
 */
(function(){

	if (!Array.prototype.indexOf) {
		Array.prototype.indexOf = function(searchElement, fromIndex) {
			var k;
			if (this == null) {
				throw new TypeError('"this" is null or not defined');
			}
			var o = Object(this);
			var len = o.length >>> 0;
			if (len === 0) {
				return -1;
			}
			var n = +fromIndex || 0;

			if (Math.abs(n) === Infinity) {
				n = 0;
			}
			if (n >= len) {
				return -1;
			}
			k = Math.max(n >= 0 ? n : len - Math.abs(n), 0);
			while (k < len) {
				if (k in o && o[k] === searchElement) {
					return k;
				}
				k++;
			}
			return -1;
		};
	}


	var addEvent = function(element, type, listener) {
		if (!element) {
			return false;
		}
		if (element.addEventListener) {
			return element.addEventListener(type, listener, false);
		}
		if (element.attachEvent) {
			return element.attachEvent("on" + type, function(e) {
				return listener.call(element, e);
			});
		}
		return false;
	};

	var querySelectorAll = function(selector, context) {
		if (!context) {
			context = document;
		}
		if (context.querySelectorAll) {
			return context.querySelectorAll(selector);
		}
		return Sizzle(selector, context);
	};
	var querySelector = function(selector, context) {
		if (!context) {
			context = document;
		}
		if (context.querySelector) {
			return context.querySelector(selector);
		}
		var elements = Sizzle(selector, context);
		return elements && elements.length ? elements[0] : null;
	};



	var animation = function(element, ms, init, progress, complete) {
		var beginTimestamp = (new Date()).valueOf();
		var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame || function(callback){ setTimeout(function(){ callback.call(element, beginTimestamp - (new Date()).valueOf())}, 16.7)};
		var cancelAnimationFrame = window.cancelAnimationFrame || window.mozCancelAnimationFrame || window.webkitCancelAnimationFrame || window.CancelRequestAnimationFrame || window.webkitCancelRequestAnimationFrame || window.clearTimeout;

		init && init.call(element);
		var request = requestAnimationFrame(function() {
			var msProgress = ((new Date()).valueOf() - beginTimestamp) / ms;
			if (msProgress >= 1) {
				msProgress = 1;
			}
			var res = progress.call(element, msProgress);
			if (msProgress == 1 || res === false) {
				complete && complete.call(element, msProgress == 1);
				cancelAnimationFrame(request);
				return false;
			}
			requestAnimationFrame(arguments.callee);
		});
	};



	var classList = {
		add: function(context, name) {
			if (!context) {
				return false;
			}
			if (context.classList) {
				context.classList.add(name);
				return true;
			}
			if (context.className) {
				var names = context.className.split(/[\r\t\n ]+/);
				if (names.indexOf(name) == -1) {
					names.push(name);
				}
				context.className = names.join(' ');
				return true;
			}

			context.className = name;
			return true;
		},
		remove: function(context, name) {
			if (!context) {
				return false;
			}
			if (context.classList) {
				return context.classList.remove(name);
			}
			if (!context.className) {
				return true;
			}
			if (context.className == name) {
				context.className = '';
				return true;
			}

			var names = context.className.split(/[\r\t\n ]+/);
			var index = names.indexOf(name);
			if (index == -1) {
				return true;
			}
			delete names[index];
			context.className = names.join(' ');
			return true;
		},

		contains: function(context, name) {
			if (!context) {
				return false;
			}
			if (context.classList) {
				return context.classList.contains(name);
			}
			if (!context.className) {
				return false;
			}
			return context.className.split(/[\r\t\n ]+/).indexOf(name) != -1;
		}
	}


	var DOMContentLoaded = function() {
		(function() {


			// 隐藏动画
			var hide = function(element) {
				classList.remove(element, "active");
				animation(element, 200, function(){
					classList.add(element, "animation");
					element.style.display = 'block';
					element.style.overflow = 'hidden';
					element._clientHeight = element.clientHeight;
				}, function(progress) {
					element.style.height = (element._clientHeight * (1 - progress)) + 'px';
				}, function() {
					classList.remove(element, "animation");
					element.style.height = element.style.overflow = element.style.display = '';

				});
			};

			// 显示动画
			var show = function(element) {
				classList.add(element, "active");
				animation(element, 200, function(){
					classList.add(element, "animation");
					element.style.display = 'block';
					element.style.overflow = 'hidden';
					element._clientHeight = element.clientHeight;
					element.style.height = '0px';
				}, function(progress) {
					element.style.height = (element._clientHeight * progress) + 'px';
				}, function() {
					classList.remove(element, "animation");
					element.style.height = element.style.overflow = element.style.display = '';
				});
			};





			// 全部组
			var panelGroup = querySelectorAll('.panel-group');
			for (var i = 0; i < panelGroup.length; i++) {
				(function(group) {
					var panels = querySelectorAll('.panel', group);
					var panelsHeading = querySelectorAll('.panel-heading', group);
					var panelsCollapse = querySelectorAll('.panel-collapse', group);
					for (var i = 0; i < panels.length; i++) {
						(function(panel) {
							var panelHeading = querySelector('.panel-heading', panel);
							addEvent(querySelector('a', panelHeading), 'click', function(e) {
								var id = this.hash || this.href || this.getAttribute('href') || this.getAttribute('data-href');
								if (!id || id == '#' || this.hash.substr(0, 1) != '#') {
									return true;
								}
								id = id.substr(1);
								if (!classList.contains(panelHeading, "active")) {
									for (var i = 0; i < panelsHeading.length; i++) {
										classList.remove(panelsHeading, "active");
									}
									classList.add(panelHeading, "active");
								}
								for (var i = 0; i < panelsCollapse.length; i++) {
									var panelCollapse = panelsCollapse[i];
									if (panelCollapse.id == id && !classList.contains(panelCollapse, "active")) {
										show(panelCollapse);
									} else if (classList.contains(panelCollapse, "active")) {
										hide(panelCollapse);
									}
								}
								e.preventDefault && e.preventDefault();
								return false;
							});
						})(panels[i]);
					};
				})(panelGroup[i]);
			}
		})();


		(function() {
			// tab 全部组
			var tabsGroup = querySelectorAll('.tabs');
			for (var i = 0; i < tabsGroup.length; i++) {
				(function(tabs) {
					// tab 表头
					var navTabs = querySelectorAll('.nav-tabs li', tabs);

					// tab 表内容
					var paneTabs = querySelectorAll('.tab-pane', tabs);

					for (var i = 0; i < navTabs.length; i++) {
						(function(navTab) {
							addEvent(querySelector('a', navTab), 'click', function(e) {
								var id = this.hash || this.href || this.getAttribute('href') || this.getAttribute('data-href');
								if (!id || id == '#' || this.hash.substr(0, 1) != '#') {
									return true;
								}
								id = id.substr(1);
								if (!classList.contains(navTab, "active")) {
									for (var i = 0; i < navTabs.length; i++) {
										classList.remove(navTabs[i], "active");
									}
									classList.add(navTab, "active");
									for (var i = 0; i < paneTabs.length; i++) {
										if (paneTabs[i].id == id) {
											classList.add(paneTabs[i], "active");
										} else {
											classList.remove(paneTabs[i], "active");
										}
									}
								}
								e.preventDefault && e.preventDefault();
								return false;
							});
						})(navTabs[i]);
					}
				})(tabsGroup[i]);
			}
		})();


		// 导航切换
		(function() {
			var container = querySelector('#header .menu-container');
			addEvent(querySelector('#header .menu-toggle'), 'click', function(){
				if (!classList.contains(container, "active")) {
					classList.add(container, "active");
				} else {
					classList.remove(container, "active");
				}
			});
		})();

		// 最低高度
		(function() {
			var listener = function(){
				querySelector('#main').style.minHeight = (document.documentElement.clientHeight - querySelector('#header').clientHeight - querySelector('#footer').clientHeight).toString() + 'px';
			};
			addEvent(window, 'resize', listener);
			listener();
		})();






	};



	if (window.addEventListener) {
		document.addEventListener('DOMContentLoaded', DOMContentLoaded, false);
	} else if (window.attachEvent) {
		(function () {
			try {
				document.documentElement.doScroll('left');
			} catch (err) {
				setTimeout(arguments.callee, 16.7);
				return;
			}
			DOMContentLoaded();
		})();
	}
})();