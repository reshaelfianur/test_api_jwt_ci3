exec = {
    init() {
        var controller = $('body').attr('data-controller')
        var method = $('body').attr('data-method')

        $('#sidebarnav').find('.active').removeClass('active')

        $('#sidebarnav').find(`#${controller}SubNav a`)
            .addClass('active')
            .parentsUntil('#sidebarnav')
            .addClass('active')

        if (typeof window[controller]['__construct'] === 'function') {
            window[controller].__construct()
        }

        window[controller][method].init()
    }

}

$(exec.init);