$(function () {
    "use strict";
    $(function () {
        $(".preloader").fadeOut()
    }), jQuery(document).on("click", ".mega-dropdown", function (s) {
        s.stopPropagation()
    });
    var s = function () {
        1170 > (window.innerWidth > 0 ? window.innerWidth : this.screen.width) ? ($("body").addClass("mini-sidebar"), $(".navbar-brand span").hide(), $(".scroll-sidebar, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible"), $(".sidebartoggler i").addClass("ti-menu")) : ($("body").removeClass("mini-sidebar"), $(".navbar-brand span").show(), $(".sidebartoggler i").removeClass("ti-menu"));
        var s = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 1;
        1 > (s -= 70) && (s = 1), s > 70 && $(".page-wrapper").css("min-height", s + "px")
    };
    $(window).ready(s), $(window).on("resize", s), $(".sidebartoggler").on("click", function () {
        $("body").hasClass("mini-sidebar") ? ($("body").trigger("resize"), $(".scroll-sidebar, .slimScrollDiv").css("overflow", "hidden").parent().css("overflow", "visible"), $("body").removeClass("mini-sidebar"), $(".navbar-brand span").show(), $(".sidebartoggler i").addClass("ti-menu")) : ($("body").trigger("resize"), $(".scroll-sidebar, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible"), $("body").addClass("mini-sidebar"), $(".navbar-brand span").hide(), $(".sidebartoggler i").removeClass("ti-menu"))
    }), $(".fix-header .topbar").stick_in_parent({}), $(".nav-toggler").click(function () {
        $("body").toggleClass("show-sidebar"), $(".nav-toggler i").toggleClass("ti-menu"), $(".nav-toggler i").addClass("ti-close")
    }), $(".sidebartoggler").on("click", function () {
        $(".sidebartoggler i").toggleClass("ti-menu")
    }), $(".right-side-toggle").on("click", function () {
        $(".right-sidebar").slideDown(50), $(".right-sidebar").toggleClass("shw-rside")
    }), $(function () {
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]',
            trigger: 'hover'
        })
    }), $(function () {
        $('[data-toggle="popover"]').popover()
    }), $(function () {
        $("#sidebarnav").metisMenu()
    }), $(".scroll-sidebar").slimScroll({
        position: "left",
        size: "5px",
        height: "100%",
        color: "#dcdcdc"
    }), $(".message-center").slimScroll({
        position: "right",
        size: "5px",
        color: "#dcdcdc"
    }), $(".aboutscroll").slimScroll({
        position: "right",
        size: "5px",
        height: "80",
        color: "#dcdcdc"
    }), $(".message-scroll").slimScroll({
        position: "right",
        size: "5px",
        height: "570",
        color: "#dcdcdc"
    }), $(".chat-box").slimScroll({
        position: "right",
        size: "5px",
        height: "470",
        color: "#dcdcdc"
    }), $(".slimscrollright").slimScroll({
        height: "100%",
        position: "right",
        size: "5px",
        color: "#dcdcdc"
    }), $("body").trigger("resize"), $(".list-task li label").click(function () {
        $(this).toggleClass("task-done")
    }), $("#to-back-recover").on("click", function () {
        $("#login-form").slideDown(), $("#recover-form").fadeOut()
    }), $("#to-recover").on("click", function () {
        $("#login-form").slideUp(), $("#recover-form").fadeIn()
    }), $(document).on("click", ".card-actions a", function (s) {
        s.preventDefault(), $(this).hasClass("btn-close") && $(this).parent().parent().parent().fadeOut()
    }),
        function (s, o, e) {
            var t = '[data-perform="card-collapse"]';
            s(t).each(function () {
                var o = s(this),
                    e = o.closest(".card"),
                    t = e.find(".card-block"),
                    n = {
                        toggle: !1
                    };
                t.length || (t = e.children(".card-heading").nextAll().wrapAll("<div/>").parent().addClass("card-block"), n = {}), t.collapse(n).on("hide.bs.collapse", function () {
                    o.children("i").removeClass("ti-minus").addClass("ti-plus")
                }).on("show.bs.collapse", function () {
                    o.children("i").removeClass("ti-plus").addClass("ti-minus")
                })
            }), s(e).on("click", t, function (o) {
                o.preventDefault(), s(this).closest(".card").find(".card-block").collapse("toggle")
            })
        }(jQuery, window, document)
});
$(window).scroll(function () {
    $(this).scrollTop() > 100 ? $(".to-top").fadeIn() : $(".to-top").fadeOut()
});
$(".to-top").click(function (s) {
    $("html, body").animate({
        scrollTop: 0
    }, 500)
});
$(document).ready(function () {
    let currentTheme = $('#theme').data('current-theme');

    setButtonTheme(currentTheme);

    $('#themecolors li').find(`.${currentTheme}-theme`).addClass('working')

    function setButtonTheme(currentStyle) {
        switch (currentStyle) {
            case 'blue-dark':
            case 'blue':
                $('.to-top').css('cssText', 'border: 2px solid #009efb !important')
                    .hover(function () {
                        $(this).css('background-color', '#009efb')
                    }, function () {
                        $(this).css('background-color', 'transparent');
                    })
                $('.to-top i').css('cssText', 'color: #009efb !important')
                    .hover(function () {
                        $(this).css({
                            'color': '#fff'
                        }, {
                            'display': 'block'
                        })
                    }, function () {
                        $(this).css({
                            'color': '#009efb'
                        }, {
                            'display': 'none'
                        })
                    })
                $('.btn-service-panel').removeClass('btn-primary btn-secondary btn-success btn-info btn-warning btn-danger btn-light btn-dark btn-megna')
                    .addClass('btn-info')
                break;
            case 'default-dark':
            case 'default':
                $('.to-top').css('cssText', 'border: 2px solid #868e96 !important')
                    .hover(function () {
                        $(this).css('background-color', '#868e96')
                    }, function () {
                        $(this).css('background-color', 'transparent');
                    })
                $('.to-top i').css('cssText', 'color: #868e96 !important')
                    .hover(function () {
                        $(this).css({
                            'color': '#fff'
                        }, {
                            'display': 'block'
                        })
                    }, function () {
                        $(this).css({
                            'color': '#868e96'
                        }, {
                            'display': 'none'
                        })
                    })
                $('.btn-service-panel').removeClass('btn-primary btn-secondary btn-success btn-info btn-warning btn-danger btn-light btn-dark btn-megna')
                    .addClass('btn-secondary')
                break;
            case 'green-dark':
            case 'green':
                $('.to-top').css('cssText', 'border: 2px solid #5ec58c !important')
                    .hover(function () {
                        $(this).css('background-color', '#5ec58c')
                    }, function () {
                        $(this).css('background-color', 'transparent');
                    })
                $('.to-top i').css('cssText', 'color: #5ec58c !important')
                    .hover(function () {
                        $(this).css({
                            'color': '#fff'
                        }, {
                            'display': 'block'
                        })
                    }, function () {
                        $(this).css({
                            'color': '#5ec58c'
                        }, {
                            'display': 'none'
                        })
                    })
                $('.btn-service-panel').removeClass('btn-primary btn-secondary btn-success btn-info btn-warning btn-danger btn-light btn-dark btn-megna')
                    .addClass('btn-success')
                break;
            case 'megna-dark':
            case 'megna':
                $('.to-top').css('cssText', 'border: 2px solid #01c0c8 !important')
                    .hover(function () {
                        $(this).css('background-color', '#01c0c8')
                    }, function () {
                        $(this).css('background-color', 'transparent');
                    })
                $('.to-top i').css('cssText', 'color: #01c0c8 !important')
                    .hover(function () {
                        $(this).css({
                            'color': '#fff'
                        }, {
                            'display': 'block'
                        })
                    }, function () {
                        $(this).css({
                            'color': '#01c0c8'
                        }, {
                            'display': 'none'
                        })
                    })
                $('.btn-service-panel').removeClass('btn-primary btn-secondary btn-success btn-info btn-warning btn-danger btn-light btn-dark btn-megna')
                    .addClass('btn-megna')
                break;
            case 'purple-dark':
            case 'purple':
                $('.to-top').css('cssText', 'border: 2px solid #7460ee !important')
                    .hover(function () {
                        $(this).css('background-color', '#7460ee')
                    }, function () {
                        $(this).css('background-color', 'transparent');
                    })
                $('.to-top i').css('cssText', 'color: #7460ee !important')
                    .hover(function () {
                        $(this).css({
                            'color': '#fff'
                        }, {
                            'display': 'block'
                        })
                    }, function () {
                        $(this).css({
                            'color': '#7460ee'
                        }, {
                            'display': 'none'
                        })
                    })
                $('.btn-service-panel').removeClass('btn-primary btn-secondary btn-success btn-info btn-warning btn-danger btn-light btn-dark btn-megna')
                    .addClass('btn-primary')
                break;
            case 'red-dark':
            case 'red':
                $('.to-top').css('cssText', 'border: 2px solid #f62d51 !important')
                    .hover(function () {
                        $(this).css('background-color', '#f62d51')
                    }, function () {
                        $(this).css('background-color', 'transparent');
                    })
                $('.to-top i').css('cssText', 'color: #f62d51 !important')
                    .hover(function () {
                        $(this).css({
                            'color': '#fff'
                        }, {
                            'display': 'block'
                        })
                    }, function () {
                        $(this).css({
                            'color': '#f62d51'
                        }, {
                            'display': 'none'
                        })
                    })
                $('.btn-service-panel').removeClass('btn-primary btn-secondary btn-success btn-info btn-warning btn-danger btn-light btn-dark btn-megna')
                    .addClass('btn-danger')
                break;

            default:
                break;
        }
    }

    function store(name, val) {
        if (typeof (Storage) !== "undefined") {
            localStorage.setItem(name, val);
        } else {
            window.alert('Please use a modern browser to properly view this template!');
        }
    }
    $("*[data-theme]").click(function (e) {
        e.preventDefault();
        var currentStyle = $(this).attr('data-theme');

        store('theme', currentStyle);

        setButtonTheme(currentStyle);

        $(".right-sidebar").slideDown(50),
            $(".right-sidebar").toggleClass("shw-rside")

        $('#theme').attr({
            href: baseUrl('assets/css/colors/' + currentStyle + '.css')
        })

        let route = $('body').data('route')

        let args = {
            user_theme: currentStyle
        }

        FUNC._ajaxPost('general/change-theme', FUNC._jsonToQueryString(args)).done(res => {
            if (res.success) {
                FUNC._toastr(res.message)
                return true
            } else {
                FUNC._toastr(res.message, 'warning')
                return false
            }
        })
    });

    $('#themecolors').on('click', 'a', function () {
        $('#themecolors li a').removeClass('working');
        $(this).addClass('working')
    });

    var idle_timer;
    (function () {
        $('#timeout-activate').click(function () {
            if (+$('#timeout-count').val()) {
                activate(+$('#timeout-count').val());
            }
        });

        $('#timeout-reset').click(function () {
            reset();
        });

        function reset() {
            $(document).idleTimer("destroy");
            if (idle_timer) clearTimeout(idle_timer);
            $('#session-dialog').modal('hide');
            $('#timeout .notify').removeClass('active');
            $('#timeout-reset-box').hide();
            $('#timeout-activate-box').show();
        }

        function activate(count) {
            $('#session-dialog').modal('hide');
            $('#timeout-reset-box').show();
            $('#timeout-activate-box').hide();
            $(document).idleTimer(count * 60000);

            setTimeout(function () {
                $('#timeout .notify').addClass('active');
            }, (count - 1) * 60000);

            $(document).on("idle.idleTimer", function (event, elem, obj) {
                // function you want to fire when the user goes idle
                toastr.warning('Your session is about to expire. The page will redirect after 5 seconds with no activity.', 'Session Timeout Notification', {
                    "progressBar": true,
                    "timeOut": 5000,
                });
                idle_timer = setTimeout(function () {
                    reset()
                    localStorage.clear();
                    document.location.assign($('.logout-route').href)
                }, 5000);
            });

            $(document).on("active.idleTimer", function (event, elem, obj, triggerevent) {
                // function you want to fire when the user becomes active again
                clearTimeout(idle_timer);
                $(document).idleTimer("reset");
                toastr.clear();
                toastr.success('You returned to the active mode.', 'You are back.');
            });
        }
    })();

    $('#timeout-form').validate({
        errorClass: "invalid-feedback",
        rules: {
            timeout_count: { required: true, digits: true },
        },
        highlight: function (e) {
            $(e).addClass("invalid").closest('.timeout-modal').addClass("invalid").closest('.form-group').addClass("invalid")
        },
        unhighlight: function (e) {
            $(e).removeClass("invalid").closest('.timeout-modal').removeClass("invalid").closest('.form-group').removeClass("invalid")
        },
    });

    // Pre Copy to clipboard
    if ($(".clipboard-copy").length > 0) {
        new Clipboard('.clipboard-copy', {
            target: function (t) {
                return t.nextElementSibling;
            }
        }).on('success', function (e) {
            e.clearSelection();
            e.trigger.textContent = 'Copied';
            window.setTimeout(function () {
                e.trigger.textContent = 'Copy';
            }, 2000);
        });
    }

    // Print action
    $("[data-action='print']").click(function () {
        var target = $(this).attr('data-target');

        if ($(target).length) {
            $(target).printMe({
                path: [
                    'assets/vendors/bootstrap/dist/css/bootstrap.min.css',
                    'assets/css/main.css'
                ]
            });
        }
    });

});
