/*
 * Copyright (c) 2018.
 * @author Antony [leantony] Chacha
 */

'use strict';

const Toastr = {
  renderTitle: function (title) {
    var $titleToast = $('<b />', { class: 'mr-auto toast-title' }).text(title);
    return $titleToast;
  },
  renderHeader: function (title, color, icon) {
    var $iconHeader = $('<i />', { class: 'bi ' + icon });
    var $imgHeader = $('<span />', { class: 'rounded mr-2 mb-0 h5 text-' + color }).append($iconHeader);
    var $toastHeader = $('<div />', { class: 'toast-header' });
    var $btnClose = $('<button />', {
      type: 'button',
      class: 'ml-2 mb-1 close',
      'data-dismiss': 'toast',
      'aria-label': 'Close'
    }).html('<span aria-hidden="true">&times;</span>')
    $toastHeader.append($imgHeader).append(this.renderTitle(title)).append($btnClose);
    return $toastHeader;
  },
  renderBody: function (content) {
    var $bodyToast = $('<div />', { class: 'toast-body' });
    $bodyToast.html(content);
    return $bodyToast;
  },
  render: function (title, content, color, icon) {
    var $toast = $('<div />', {
      class: 'toast',
      role: 'alert',
      'aria-live': 'assertive',
      'aria-atomic': 'true',
      'data-delay': '5000'
    });
    $toast.append(this.renderHeader(title, color, icon)).append(this.renderBody(content));
    $("#popupToast").html($toast);
    return $toast;
  },
  showSuccess: function (title, content) {
    return this.render(title, content, 'success', 'bi-check-circle-fill').toast('show');
  },
  showError: function (title, content) {
    return this.render(title, content, 'danger', 'bi-x-circle-fill').toast('show');
  }
};

function downloadFilePath(filePath) {
  if (_.isNil(filePath) || _.isEmpty(filePath)) {
    Toastr.showError('Notification', 'File not found!')
  }
  $.fileDownload(filePath)
    .done(function () {
      Toastr.showSuccess('Notification', 'Download is successfull')
    })
    .fail(function () {
      Toastr.showError('Notification', 'Download is fail')
    });
}

const FormUtils = {
  showAlert: function (message) {
    if (typeof Toastr !== 'undefined') {
      Toastr.showSuccess('Message', message);
    }
  },
  /**
   * Return html that can be used to render a bootstrap alert on the form
   *
   * @param type
   * @param response
   * @returns {string}
   */
  renderAlert: function (type, response) {
    var validTypes = ['success', 'error', 'notice'];
    var html = '';
    if (typeof type === 'undefined' || $.inArray(type, validTypes) < 0) {
      type = validTypes[0];
    }
    if (type === 'success') {
      html += '<div class="alert alert-success">';
    } else if (type === 'error') {
      html += '<div class="alert alert-danger">';
    } else {
      html += '<div class="alert alert-warning">';
    }
    html += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    // add a heading
    if (type === 'error') {
      if (response.serverError) {
        html += response.serverError.message || 'A server error occurred.';
        html = '<strong>' + html + '</strong>';
        return html;
      } else {
        html += response.message || 'Please fix the following errors';
        html = '<strong>' + html + '</strong>';
        var errs = this.genarateValidationErrors(response);
        return html + errs + '</div>';
      }
    } else {
      return html + response + '</div>';
    }
  },
  genarateValidationErrors: function (response) {
    let listErr = response.errors || response.validation || {}
    let errorsHtml = this.getValidationErrors(listErr);
    this.showFormValidationErrors(listErr);
    return errorsHtml;
  },
  /**
   * process validation errors from json to html
   * @param response
   * @returns {string}
   */
  getValidationErrors: function (response) {
    var errorsHtml = '';
    $.each(response, function (key, value) {
      if (_.isArray(value)) {
        errorsHtml += _.join(_.map(value, function (item) {
          return '<li>' + item + '</li>'
        }), '');
      }
      else
        errorsHtml += '<li>' + value + '</li>';
    });
    return errorsHtml;
  },
  showFormValidationErrors: function (response) {
    this.clearFormValidationErrors();
    $.each(response, function (key, value) {
      let form = $('[name="' + key + '"]').parents('form');
      let element = form.addClass('was-validated').find('[name="' + key + '"]:visible');
      if (element.length > 0) {
        let elementTarget = element[0].tagName == 'INPUT' ? element[0] : (element.find('input:visible')[0] || element.find('select')[0]);
        elementTarget.setCustomValidity(value);
        $(element).addClass('is-invalid').next().html(value);
      }
    });
  },
  clearFormValidationErrors: function () {
    let formValid = $('.needs-validation');
    formValid.find('.form-control').each(function (key, item) {
      $(item).removeClass('is-invalid').next().html('');
      if (item.tagName == 'INPUT' || item.tagName == 'SELECT')
        item.setCustomValidity('')
    });
  },
  /**
   * Form submission from a modal dialog
   *
   * @param formId
   * @param modal
   */
  handleFormSubmission: function (formId, modal, options) {
    var form = $('#' + formId);
    var submitButton = form.find(':submit');
    var data = new FormData(document.getElementById(formId));
    var textEditor = form.find('textarea');
    if (textEditor && typeof CKEDITOR != 'undefined') {
      var ckeditorElement = CKEDITOR.instances[textEditor.attr('id')];
      if (ckeditorElement) {
        var textEditorData = ckeditorElement.getData();
        data.set(textEditor.attr('name'), textEditorData);
      }
    }
    var action = form.attr('action');
    var method = form.attr('method') || 'POST';
    var originalButtonHtml = $(submitButton).html();
    var pjaxTarget = form.data('pjax-target');
    var notification = form.data('notification-el') || 'modal-notification';
    var _this = this;

    if (!Util.showConfirmMessage(submitButton)) {
      return;
    }

    Api._callApi(method, action, data, _.merge({
      targetLoading: submitButton,
      onSuccess: function (response) {
        if (response.success) {
          var message = '<i class=\"fa fa-check\"></i> ';
          message += response.message;
          $('#' + notification).html(_this.renderAlert('success', message));
          // if a redirect is required...
          if (response.redirectTo) {
            setTimeout(function () {
              window.location = response.redirectTo;
            }, response.redirectTimeout || 500);
          } else {
            // hide the modal after 1000 ms
            setTimeout(function () {
              modal.modal('hide');
              if (pjaxTarget) {
                // reload a pjax container
                $.pjax.reload({ container: pjaxTarget });
              }
            }, 500);
          }
        } else {
          // display message and hide modal
          var el = $(notification);
          el.html(_this.renderAlert('error', response.message));
          setTimeout(function () {
            modal.modal('hide');
          }, 500);
        }
      },
      onError: function (data) {
        var msg = void 0;
        // error handling
        switch (data.status) {
          case 500:
            msg = _this.renderAlert('error', { serverError: { message: "An error occurred on the server." } });
            break;
          default:
            msg = _this.renderAlert('error', data.responseJSON);
            break;
        }
        if (data.status != 422) {
          // display errors
          var el = $('#' + notification);
          el.html(msg);
        }
      }
    }, options));
  }
};

const Api = {
  _callApi: function (apiMethod, apiUrl, apiData, options) {
    let apiContentType = _.get(options, 'contentType', false);
    let targetLoading = _.get(options, 'targetLoading', null);
    let loadingText = null;
    let btnTarget = null;
    if (targetLoading) {
      loadingText = $(targetLoading).data('loading');
      btnTarget = $(targetLoading).html();
    }
    $.ajax({
      method: apiMethod,
      url: apiUrl,
      data: apiData,
      dataType: 'json',
      contentType: apiContentType,
      processData: false,
      beforeSend: function beforeSend() {
        if (_.has(options, 'beforeSend')) {
          options.beforeSend.call(this);
        }
        if (targetLoading) {
          $(targetLoading).attr('disabled', 'disabled').addClass('disabled').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;' + loadingText);
        }
      },
      complete: function complete() {
        if (_.has(options, 'onComplete')) {
          options.onComplete.call(this);
        }
        if (targetLoading) {
          $(targetLoading).html(btnTarget).removeAttr('disabled').removeClass('disabled');
        }
      },
      success: function success(data) {
        FormUtils.clearFormValidationErrors();
        if (_.has(options, 'onSuccess')) {
          options.onSuccess.call(this, data);
        } else {
          if (_.has(options, 'pjaxContainer') && !_.isNil(options.pjaxContainer)) {
            $.pjax.reload({ container: options.pjaxContainer });
          }
          if (typeof Toastr !== 'undefined') {
            if (_.get(data, 'success')) {
              Toastr.showSuccess('Message', '<p>' + _.get(data, 'message') + '</p>');
            }
          }
        }
      },
      error: function error(data) {
        if (_.has(options, 'onError')) {
          options.onError.call(this, data);
        } else {
          if (typeof Toastr !== 'undefined') {
            let err = FormUtils.genarateValidationErrors(data.responseJSON);
            Toastr.showError('Message', '<ul>' + err + '</ul>');
          } else {
            alert('An error occurred');
          }
        }
      }
    });
  },
  get: function (url, params, options) {
    if (url == '') return;
    params = params || {};
    var urlSearch = new URLSearchParams();
    _.forIn(Object.entries(params), function (value, key) {
      urlSearch.append(key, value);
    });

    this._callApi('GET', url + '?' + urlSearch.toString(), null, options)
  },
  post: function (url, data, options) {
    if (url == '') return;
    // options = Object.assign({ contentType: 'application/json' }, options);
    this._callApi('POST', url, data, options);
  },
  put: function (url, data, options) {
    if (url == '') return;
    options = Object.assign({ contentType: 'application/json' }, options);
    this._callApi('PUT', url, data, options);
  },
  delete: function (url, data, options) {
    if (url == '') return;
    options = Object.assign({ contentType: 'application/json' }, options);
    this._callApi('DELETE', url, data, options);
  }
};

const Util = {
  /**
   * Handle an ajax request from a button, form, link, etc
   *
   * @param element
   * @param event
   * @param options
   */
  handleAjaxRequest: function (element, event, options) {
    event = event || 'click';
    if (element.length < 1) return;

    element.each(function (i, obj) {
      obj = $(obj);
      var pjaxContainer = obj.data('pjax-target');
      var refresh = obj.data('refresh-page');
      let frmTarget = obj.data('form-id') ? $('#' + obj.data('form-id')) : null;
      var isForm = obj.is('form');
      var ajaxMethod = obj.data('method') || 'POST';
      var ajaxUrl = obj.attr('href') || obj.data('action');
      var ajaxData = obj.data('value');
      if (_.isObject(ajaxData)) {
        ajaxData = JSON.stringify(ajaxData);
      }
      if (isForm || frmTarget) {
        let tmpForm = isForm ? obj : frmTarget;
        ajaxMethod = tmpForm.attr('method');
        ajaxUrl = tmpForm.attr('action');
        ajaxData = JSON.stringify(tmpForm.serializeObject());
      }

      obj.on(event, function (e) {
        e.preventDefault();
        if (!Util.showConfirmMessage(obj)) {
          return;
        }
        if (isForm || frmTarget) {
          let tmpForm = isForm ? obj : frmTarget;
          ajaxData = JSON.stringify(tmpForm.serializeObject());
        }
        Api._callApi(ajaxMethod, ajaxUrl, ajaxData, _.merge({
          contentType: 'application/json',
          targetLoading: obj,
          pjaxContainer: pjaxContainer
        }, options))
      });
    });
  },
  /**
   * Linkable rows on tables (rows that can be clicked to navigate to a location)
   */
  tableLinks: function (options) {
    if (!options) {
      console.warn('No options defined.');
    } else {
      var elements = $(options.element);
      elements.each(function (i, obj) {
        var el = $(obj);
        var link = el.data('url');
        el.css({ 'cursor': 'pointer' });
        el.click(function (e) {
          setTimeout(function () {
            window.location = link;
          }, options.navigationDelay || 100);
        });
      });
    }
  },
  /*
  * return object
  * Widths of each thead cell and tbody cell for the first rows.
  * Used in fixing widths for the fixed header and optional footer.
  */
  _getTableProps: function ($obj) {
    var tableProp = {
      thead: {},
      tbody: {},
      tfoot: {},
      border: 0
    };
    // borderCollapse = 1;

    // tableProp.border = ($obj.find('th:first-child').outerWidth() - $obj.find('th:first-child').innerWidth()) / borderCollapse;

    $obj.find('thead tr:first-child > *').each(function (index) {
      tableProp.thead[index] = $(this).outerWidth() + tableProp.border;
    });

    $obj.find('tfoot tr:first-child > *').each(function (index) {
      tableProp.tfoot[index] = $(this).outerWidth() + tableProp.border;
    });

    $obj.find('tbody tr:first-child > *').each(function (index) {
      tableProp.tbody[index] = $(this).outerWidth() + tableProp.border;
    });

    return tableProp;
  },
  getProgressButton: function (target, success) {
    if (target) {
      let loadingText = $(target).data('loading');
      let btnTarget = $(target).data('text');

      if (success) {
        $(target).attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;' + loadingText);
      } else {
        $(target).html(btnTarget).removeAttr('disabled');
      }
    }
  },
  filterMultiSelect: function (element, params, options) {
    if (element.length < 1) return;

    element.each(function (i, obj) {
      $(obj).multiselect(_.merge({
        nonSelectedText: _.get(params, 'nonSelectedText'),
        selectAllText: _.get(params, 'selectAllText'),
        includeSelectAllOption: true,
        numberDisplayed: _.get(params, 'numberDisplay'),
        onInitialized: function (select, container) {
          $(container).find('.form-check-label').addClass('custom-control-label').removeClass('form-check-label');
          if (_.has(params, 'onInitialized')) {
            params.onInitialized.call(select, container);
          }
        }
      }, options));
      $(obj).off('change').on('change', function () {
        let elelemts = [
          { 'name': $(obj).attr('name'), 'value': $(obj).val().join(',') }
        ];
        Util.callDoActionQuery(_.get(params, 'routeLink'), elelemts)
      });
    });
  },
  initMultiSelect: function (element, params, options) {
    if (element.length < 1) return;

    element.each(function (i, obj) {
      $(obj).multiselect(_.merge({
        buttonTextAlignment: 'left',
        nonSelectedText: _.get(params, 'nonSelectedText'),
        selectAllText: _.get(params, 'selectAllText'),
        includeSelectAllOption: true,
        numberDisplayed: _.get(params, 'numberDisplay'),
        onInitialized: function (select, container) {
          // $(container).find('.form-check-label').addClass('custom-control-label').removeClass('form-check-label');
          if (_.has(params, 'onInitialized')) {
            params.onInitialized.call(select, container);
          }
        }
      }, options));
    });
  },
  initCustomDatalist: function (element) {
    if (element.length < 1) return;

    element.each(function (i, obj) {
      let elementInput = $(obj);
      let elementDatalist = $(obj).next();
      $(obj).attr('list', '').attr('data-toggle', 'dropdown');
      $(elementDatalist).addClass('dropdown-menu');

      $(elementInput).on('focus', function() {
          $(elementDatalist).find('option').css('display', 'block')
      }).on('input', function() {
          let inputVal = $(this).val().toLowerCase();
          $(elementDatalist).find('option').each(function(key, item) {
              if (item.value.toLowerCase().indexOf(inputVal) > -1) {
                  item.style.display = 'block';
              } else {
                  item.style.display = 'none';
              }
          })
      })
      $(elementDatalist).find('option').each(function(key, item) {
          item.onclick = function() {
              $(obj).val(item.value);
              $(elementInput).dropdown('hide');
          }
      });
    });
  },
  callDoActionQuery: function (routeLink, elements, isReset) {
    let params = new URLSearchParams(location.search)
    params.forEach(function (val, key) {
      if (isReset)
        params.delete(key);
      else if (key == 'page')
        params.delete(key);
    });

    $.each(elements, function (idx, item) {
      if (item.value) {
        params.set(item.name, item.value)
      } else {
        params.delete(item.name)
      }
    });
    let url = params.toString() == '' ? '' : '?' + params.toString();
    let fullUrl = new URL(url, routeLink);
    window.location.replace(fullUrl.toString());
  },
  showConfirmMessage: function (btnTarget) {
    var confirmation = btnTarget.data('trigger-confirm');
    var confirmationMessage = btnTarget.data('confirmation-msg') || 'Are you sure?';

    if (confirmation) {
      return confirm(confirmationMessage);
    }

    return true;
  },
  stickyHeaderTable: function () {
    let tableElement = $('#data-table');
    var tableProps = Util._getTableProps(tableElement);
    let parent = tableElement.parent();

    tableElement.find('thead tr:first-child th').each(function (i, item) {
      $(item).css('min-width', tableProps.thead[i] + 'px');
    });

    if (!parent.closest('.table-wrapper').length) {
      parent.wrap('<div class="table-wrapper"></div>');
    }

    let headerTable = tableElement.clone().wrap('<div class="table-responsive sticky-table sticky-top"></div>');
    headerTable.find('tbody').remove();
    if (headerTable.find('thead tr').length > 1) {
      headerTable.find('thead tr:last-child').remove();
    }
    headerTable.closest('.sticky-table').insertBefore(parent);

    tableElement.addClass('content-table');

    parent.scroll(function () {
      headerTable.closest('.sticky-table').scrollLeft(parent.scrollLeft())
    });

    $(window).resize(function () {
      var tableProps = Util._getTableProps(tableElement);
      tableElement.find('thead tr:first-child th').each(function (i, item) {
        $(item).css('min-width', tableProps.thead[i] + 'px');
      });
      headerTable.find('thead tr:first-child th').each(function (i, item) {
        $(item).css('min-width', tableProps.thead[i] + 'px');
      });
    });
  },
  showLoading: function () {
    setTimeout(function() {
      let preloaderElement = $('.preloader');
      preloaderElement.removeAttr('style');
      preloaderElement.children().show();
    }, 200);
  },
  hideLoading: function () {
    setTimeout(function() {
      let preloaderElement = $('.preloader');
      preloaderElement.css('height', 0);
      preloaderElement.children().hide();
    }, 200);
  },
  showModalDialog: function (btnTarget, onShownModal = null, onHiddenModal = null) {
    var btn = $(btnTarget);
    var btnHtml = btn.html();
    var modalDialog = $('#bootstrap_modal');
    var modalSize = btn.data('modal-size');

    if (!Util.showConfirmMessage(btn)) {
      return;
    }

    // show spinner as soon as user click is triggered
    btn.attr('disabled', 'disabled').addClass('disabled').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;loading');

    // load the modal into the container put on the html
    $('.modal-content').load(btn.attr('href') || btn.data('href'), function (response, status, xhr) {
      // check authenication
      if (status == 'error' && xhr.status == 401) {
        let res = JSON.parse(response);
        location.href = res.redirect;
      }
      // show the modal
      $('#bootstrap_modal').modal({ show: true });
      $('.modal-content').parent('div').addClass('modal-dialog-centered');
      // alter size
      if (modalSize) {
        $('.modal-content').parent('div').addClass(modalSize);
      }
    });

    // revert button to original content, once the modal is shown
    modalDialog.on('shown.bs.modal', function (e) {
      $(btn).html(btnHtml).removeAttr('disabled').removeClass('disabled');
      if (_.isFunction(onShownModal)) {
        onShownModal(e);
      }
    });

    // destroy the modal
    modalDialog.on('hidden.bs.modal', function (e) {
      $(this).modal('dispose');
      $('.modal-content').html('')
      if (_.isFunction(onHiddenModal)) {
        onHiddenModal(e);
      }
    });
  }
};

const configPjax = {
  init: function(container, target, options) {
    if ($.support.pjax) {
      $.pjax.defaults.timeout = _.get(options, 'timeout', 7000); // time in milliseconds
      $(document).on('pjax:send', function() {
        Util.showLoading();
      })
      configPjax.afterPjax();
      $(document).on('pjax:complete', function() {
        Util.hideLoading();
      });

      //Form
      configPjax.initEvent('submit', 'form[data-pjax]', '#pjax-content-container');
      configPjax.initPjax(target, container, options);
    }
  },
  initEvent: function (eventName, element, container) {
    $(document).on(eventName, element, function(event) {
      if (eventName == 'submit')
        $.pjax.submit(event, container);
      else if (eventName == 'click')
        $.pjax.click(event, container);
    });
  },
  initPjax: function (target, container, options) {
    $(document).pjax(target, container, options);
  },
  afterPjax: function (callback) {
    $(document).on('pjax:complete', function (event) {
      if (_.isFunction(callback)) {
        callback($(event.target));
      }
      Util.hideLoading();
    });
  },
  redirectPjax: function (url = '') {
    if(!url) return false;

    $.pjax({url: url, container: '#pjax-content-container'});
  }
};

const Grid = function (opts) {
  var defaults = {
    /**
     * The ID of the html element containing the grid
     */
    id: '#some-grid',
    /**
     * The ID of the html element containing the filter form
     */
    filterForm: undefined,
    /**
     * The ID of the html element containing the search form
     */
    searchForm: undefined,
    /**
     *
     */
    pagerDropdown: undefined,
    /**
     * The CSS class of the columns that are sortable
     */
    sortLinks: 'data-sort',
    /**
     * The selector of a date range filter
     */
    dateRangeSelector: '.date-range',
    /**
     * PJAX
     */
    pjax: {
      /**
       * Any extra pjax plugin options
       */
      pjaxOptions: {},

      /**
       * Something to do once the PJAX request has been finished
       */
      afterPjax: function afterPjax(e) { }
    }
  };
  this.opts = $.extend({}, defaults, opts || {});
};
Grid.prototype = {
  constructor: Grid,
  setupPjax: function (container, target, afterPjax, options) {
    options.timeout = options.timeout || 3000;
    configPjax.init(container, target, options)
    configPjax.afterPjax(afterPjax);
  },
  bindPjax: function () {
    this.setupPjax(this.opts.id, 'a[data-trigger-pjax]', this.opts.pjax.afterPjax, this.opts.pjax.pjaxOptions);

    // setupDateRangePicker(this);

    Util.stickyHeaderTable();
  },
  filter: function () {
    let btnFilter = $(this.opts.filterForm.btnName);
    var form = $(this.opts.filterForm.target).find('.form-control');
    let routeLink = this.opts.filterForm.routeLink;

    if (form.length > 0) {
      btnFilter.click(function () {
        Util.callDoActionQuery(routeLink, form)
      });
    }
  },
  search: function () {
    var form = $(this.opts.searchForm);

    if (form.length > 0) {
      $(document).on('submit', this.opts.searchForm, function (event) {
        $.pjax.submit(event, this.opts.id, this.opts.pjax.pjaxOptions);
      });
    }
  },
  pager: function () {
    let target = $(this.opts.pagerDropdown.target);
    let routeLink = this.opts.filterForm.routeLink;
    target.change(function (e) {
      Util.callDoActionQuery(routeLink, [e.target]);
    });
  }
};

const MyModal = function (opts) {
  var defaultOptions = {};
  this.options = $.extend({}, defaultOptions, opts || {});
};
MyModal.prototype = {
  constructor: MyModal,
  show: function () {
    $('.show_modal_form').on('click', function (e) {
      e.preventDefault();
      Util.showModalDialog(this, function(e) {
        Util.initMultiSelect($('[data-toggle="multiple"]'))
        Util.initCustomDatalist($('input[list="data-choices"]'))
      });
    });
  }
};

const DataModal = {
  init: function (opts) {
    var mymodal = new MyModal(opts);
    mymodal.show();
  }
};

const DataGrid = {
  initGrid: function (opts) {
    var grid = new Grid(opts);
    grid.bindPjax();
    grid.search();
    grid.filter();
    grid.pager();
  },
  init: function (opts) {
    DataGrid.initGrid(opts);
    DataModal.init({})
    Util.tableLinks({ element: '.linkable', navigationDelay: 100 });
    Util.handleAjaxRequest($('.data-remote'), 'click', {});
  }
};

const MainMenu = {
  selectElement: function (target) {
    return $(target);
  },
  deactivated: function(target) {
    let menu = MainMenu.selectElement(target);
    menu.find('.nav-link').removeClass('active');
  },
  activated: function(target) {
    let menu = MainMenu.selectElement(target);
    menu.find('.nav-link').addClass('active');
  },
};

const ServiceInstance = {
  initEvent: function(target, eventName, callback = null) {
    Util.handleAjaxRequest($(target), 'click');
  },
  init: function () {
    ServiceInstance.initEvent('.btn-start', 'click');
    ServiceInstance.initEvent('.btn-stop', 'click');
    ServiceInstance.initEvent('.btn-restart', 'click');
  }
};

(function ($) {
  if (typeof $ === 'undefined') {
    throw new Error('Requires jQuery');
  }
  $.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
      if (o[this.name]) {
        if (!o[this.name].push) {
          o[this.name] = [o[this.name]];
        }
        o[this.name].push(this.value || '');
      } else {
        o[this.name] = this.value || '';
      }
    });
    return o;
  };

  $('#bootstrap_modal').off('click', '#modal_form button[type="submit"]').on('click', '#modal_form button[type="submit"]', function (e) {
    e.preventDefault();
    // process forms on the modal
    FormUtils.handleFormSubmission('modal_form', $('#bootstrap_modal'));
  });

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $(document).on('ajaxSend', function() {
    Util.showLoading();
  }).on('ajaxComplete', function() {
    Util.hideLoading();
  }).on('ajaxError', function() {
    Util.hideLoading();
  });

  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('.back-to-top').addClass('active');
    } else {
      $('.back-to-top').removeClass('active');
    }
  });
  if (!$('#navbarNavDropdown').hasClass('show')) {
    $('.main-content').removeClass('col-md-9');
  }

  $('.back-to-top').click(function () {
    $('html, body').animate({
      scrollTop: 0
    }, 1500);
    return false;
  });

  $('#navbarNavDropdown').on('show.bs.collapse', function () {
    $('.main-content').addClass('col-md-9')
  }).on('hidden.bs.collapse', function () {
    if (!$(this).hasClass('show')) {
      $('.main-content').removeClass('col-md-9')
    }
  });

  $('.btn-download').click(function (e) {
    e.preventDefault();
    let filePath = $(this).data('file');
    downloadFilePath(filePath);
  });

  configPjax.initPjax('nav[data-pjax] .nav-sidebar a', '#pjax-content-container');
  configPjax.afterPjax(function() {
    if (_.isFunction(loadInitDataGrid)) {
      loadInitDataGrid();
    }
  });
  window.addEventListener('DOMContentLoaded', function() {
    Util.hideLoading();
  });
})(jQuery);
