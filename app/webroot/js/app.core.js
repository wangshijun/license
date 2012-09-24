var app = {};

$.extend(app, {
	/**
	 * 根据当前访问的URI延迟加载对应的脚本
	 *
	 * @access public
	 * @return void
	 */
	initialize: function () {
		// Validate form based on meta data and jquery validation plugin
		this.validate();

		// IE6 x-browser bugfix
		var ie6 = $.browser.msie && $.browser.version.slice(0,1) == '6';
		if (ie6) {
			$('div.input input[type=text], div.input input[type=password]').addClass('text');
			$('div.submit input[type=submit], ').addClass('submit');
		}
	},

	validate: function () {
		if (!$.validator) { return false; }
		if (!$.metadata) { return false; }
		$.metadata.setType('attr', 'validate');
		$.extend($.validator, {
			messages: {
				required: "这里是必填字段",
				remote: "抱歉,数据库中存在重复的记录",
				email: "请输入有效的邮箱地址, 如username@domain.com",
				url: "请输入合法的URL地址, 如http://www.google.com",
				date: "请输入合法的日期,如2011-07-10",
				dateISO: "Please enter a valid date (ISO).",
				number: "请输入有效的数字",
				digits: "请输入有效的小数",
				creditcard: "Please enter a valid credit card number.",
				equalTo: "Please enter the same value again.",
				accept: "Please enter a value with a valid extension.",
				maxlength: $.validator.format("这里至多输入{0}个字符"),
				minlength: $.validator.format("这里至少输入{0}个字符"),
				rangelength: $.validator.format("Please enter a value between {0} and {1} characters long."),
				range: $.validator.format("请输入{0}和{1}之间的值"),
				max: $.validator.format("请输入不大于{0}的值"),
				min: $.validator.format("请输入不小于{0}的值")
			}
		});
		$('form').each(function () {
			$(this).validate(app.options.validate);
		});
	},

	/**
	 * 通知用户消息, 停留几秒钟然后自己消失
	 *
	 * @param string message 要通知的消息
	 * @param string type 通知类别 success | error | default | confirm
	 * @access public
	 * @return DOMElement
	 */
	notify: function (message, type, duration) {
		var type = type || 'default';
		var duration = duration || 5000;

		//console.log('app.notify.' + type + ': ' + message);
		var element = $('<div class="message""></div>').hide();
		$('#container').append(element.addClass(type));
		element.text(message).css({
			left: (($(window).width() - element.width()) / 2) + 'px',
			top: '12px'
		}).fadeIn('fast');

		var timeout = window.setTimeout(function () {
			element.fadeOut('fast', function () {
				//element.remove();
			});
		}, duration);

		return [element, timeout];
	},

	/**
	 * 创建富文本编辑器
	 *
	 * @param string element 元素DOMID
	 * @param string finder CKFinder的路径, false时不启用
	 * @param string toolbar 工具栏配置, 可取, basic, advanced
	 * @return DOMElement
	 */
    ckeditor: function(element, finder, toolbar){
        if (!$('#' + element).size() || !CKEDITOR) { return false; }
        var toolbar = toolbar || 'basic', finder = finder || false;
        var editor = CKEDITOR.replace(element, app.options.ckeditor[toolbar]);
        if (finder && CKFinder) {
            CKFinder.setupCKEditor(editor, finder);
        }
    },

	/**
	 * 表单验证的全局配置
	 */
	options: {
		validate: {	// form validation options
			//meta: "validate",
			errorElement : "em",
			errorPlacement : function(error, element) {
				element.nextAll('em').remove();
				error.insertAfter(element);
			},
			success: function (label) {
				label.prevAll('em').remove();
				label.nextAll('em').remove();
				label.removeClass('error').addClass('success').text('好');
			}
		},
		notify: $('<div class="message""></div>'),
		ckeditor: {
			advanced: {
				height: 360,
				toolbar: [
					['Source', '-', 'Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat', '-', 'Maximize', 'ShowBlocks', '-', 'Link','Unlink','Anchor', '-', 'Image','Table','HorizontalRule'],
					'/',
					['Bold','Italic','Underline','Strike','TextColor','BGColor', '-','NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Outdent','Indent','Blockquote', 'Styles','Format','Font','FontSize']
				]
			},
			basic: {
				toolbar: [[
					'Bold','Italic','Underline','Strike', 'TextColor','BGColor', '-',
					'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock', '-',
					'NumberedList','BulletedList', '-',
					'Format','Font','FontSize'
				]]
			}
		}

	}

});